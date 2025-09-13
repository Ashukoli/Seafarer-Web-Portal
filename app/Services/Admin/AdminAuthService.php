<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminAuthService
{
    protected int $maxAttempts = 3;
    protected int $lockMinutes = 30;

    /**
     * Attempt login for admin by case-sensitive username.
     *
     * @param array $credentials ['username','password']
     * @param Request $request
     * @return User
     * @throws ValidationException
     */
    public function login(array $credentials, Request $request): User
    {
        $username = trim((string) ($credentials['username'] ?? ''));
        $password = (string) ($credentials['password'] ?? '');

        if ($username === '' || $password === '') {
            throw ValidationException::withMessages(['username' => 'Invalid credentials.']);
        }

        // Case-sensitive username search using BINARY
        $user = User::whereRaw('BINARY `username` = ?', [$username])
                    ->where('user_type', 'admin')
                    ->first();

        if (! $user) {
            throw ValidationException::withMessages(['username' => 'No admin account found with this username.']);
        }

        // Locked out?
        if ($this->isLockedOut($user)) {
            throw ValidationException::withMessages(['username' => 'Account locked. Please try again later.']);
        }

        // Status check
        if ($user->status !== 'active') {
            throw ValidationException::withMessages(['username' => 'Your account is not active.']);
        }

        // Defensive: ensure password exists
        if (empty($user->password)) {
            throw ValidationException::withMessages(['password' => 'Invalid credentials.']);
        }

        // Check password
        if (! Hash::check($password, $user->password)) {
            $this->incrementFailedAttempts($user);

            // compute remaining attempts (informational)
            $remaining = max(0, $this->maxAttempts - ($user->failed_login_attempts ?? 0));
            $msg = 'Invalid credentials.';
            if ($remaining === 0) {
                $msg .= " Account locked for {$this->lockMinutes} minutes.";
            }

            throw ValidationException::withMessages(['password' => $msg]);
        }

        // Success: reset counters & update last login
        $this->resetLockout($user);

        $user->last_login_at = Carbon::now();
        $user->last_login_ip = $request->ip();
        $user->save();

        $remember = (bool) ($request->filled('remember') ?? false);
        Auth::login($user, $remember); // default guard 'web'

        return $user;
    }

    public function logout(Request $request): void
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    protected function isLockedOut(User $user): bool
    {
        if (empty($user->locked_until)) return false;
        return Carbon::now()->lessThanOrEqualTo(Carbon::parse($user->locked_until));
    }

    protected function incrementFailedAttempts(User $user): void
    {
        $user->failed_login_attempts = ($user->failed_login_attempts ?? 0) + 1;

        if ($user->failed_login_attempts >= $this->maxAttempts) {
            $user->locked_until = Carbon::now()->addMinutes($this->lockMinutes);
            $user->failed_login_attempts = 0;
        }

        $user->save();
    }

    protected function resetLockout(User $user): void
    {
        $user->failed_login_attempts = 0;
        $user->locked_until = null;
        $user->save();
    }
}
