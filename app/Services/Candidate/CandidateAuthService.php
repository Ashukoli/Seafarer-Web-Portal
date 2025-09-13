<?php

namespace App\Services\Candidate;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CandidateAuthService
{
    protected int $maxAttempts = 3;
    protected int $lockMinutes = 30;
    protected string $guard = 'web'; // using default web guard

    public function login(array $credentials, Request $request): User
    {
        $email = trim((string) ($credentials['email'] ?? ''));
        $password = (string) ($credentials['password'] ?? '');

        if ($email === '' || $password === '') {
            throw ValidationException::withMessages([
                'email' => 'Please enter both email and password.'
            ]);
        }

        $user = User::where('email', $email)
                    ->where('user_type', 'candidate')
                    ->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => 'No candidate account found with this email.'
            ]);
        }

        if ($this->isLockedOut($user)) {
            throw ValidationException::withMessages([
                'email' => 'Account locked. Please try again later.'
            ]);
        }

        if ($user->status !== 'active') {
            throw ValidationException::withMessages([
                'email' => 'Your account is not active.'
            ]);
        }

        if (! Hash::check($password, $user->password)) {
            $this->incrementFailedAttempts($user);
            throw ValidationException::withMessages([
                'password' => 'Invalid credentials.'
            ]);
        }

        $this->resetLockout($user);

        $user->last_login_at = Carbon::now();
        $user->last_login_ip = $request->ip();
        $user->save();

        $remember = $request->boolean('remember');
        Auth::guard($this->guard)->login($user, $remember);

        return $user;
    }

    public function logout(Request $request): void
    {
        Auth::guard($this->guard)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    protected function isLockedOut(User $user): bool
    {
        return ! empty($user->locked_until) &&
               Carbon::now()->lessThanOrEqualTo(Carbon::parse($user->locked_until));
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
