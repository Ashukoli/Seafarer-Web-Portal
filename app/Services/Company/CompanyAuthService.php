<?php

namespace App\Services\Company;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CompanyAuthService
{
    protected int $otpTtlSeconds;
    protected int $maxOtpAttempts;
    protected int $lockMinutes;
    /** @var callable|null  signature: function(User $user, string $otp): bool */
    protected $smsSender;

    public function __construct(
        callable $smsSender = null,
        int $otpTtlSeconds = 600, // 10 minutes
        int $maxOtpAttempts = 3,
        int $lockMinutes = 30
    ) {
        $this->smsSender = $smsSender;
        $this->otpTtlSeconds = $otpTtlSeconds;
        $this->maxOtpAttempts = $maxOtpAttempts;
        $this->lockMinutes = $lockMinutes;
    }

    /**
     * Step 1: Validate username/password and send OTP to company phone via SMS.
     *
     * @param string  $username  Case-sensitive username
     * @param string  $password
     * @param Request $request
     * @return User
     *
     * @throws ValidationException
     */
    public function startLogin(string $username, string $password, Request $request): User
    {
        $username = trim($username);
        $password = (string) $password;

        if ($username === '' || $password === '') {
            throw ValidationException::withMessages(['username' => 'Invalid credentials.']);
        }

        // find company user (case-sensitive username)
        $user = User::whereRaw('BINARY `username` = ?', [$username])
                    ->where('user_type', 'company')
                    ->first();

        if (! $user) {
            throw ValidationException::withMessages(['username' => 'No company account found with this username.']);
        }

        // locked?
        if ($this->isLockedOut($user)) {
            throw ValidationException::withMessages(['username' => 'Account is locked. Please try again later.']);
        }

        // status check
        if ($user->status !== 'active') {
            throw ValidationException::withMessages(['username' => 'Your account is not active.']);
        }

        // password check
        if (! Hash::check($password, $user->password)) {
            // increment failed_login_attempts (in users table) OR you can track separately
            $this->incrementUserFailedAttempts($user);
            throw ValidationException::withMessages(['password' => 'Invalid credentials.']);
        }

        // success so far — create OTP, cache it hashed and send via SMS
        $otp = $this->generateOtp();
        $hashed = Hash::make($otp);

        Cache::put($this->otpCacheKey($user->id), $hashed, $this->otpTtlSeconds);
        // reset attempts counter for OTP verification
        Cache::put($this->attemptsCacheKey($user->id), 0, $this->otpTtlSeconds + 60);

        // send SMS
        $this->sendSmsOrThrow($user, $otp);

        return $user;
    }

    /**
     * Verify the OTP for the given pending user id.
     *
     * On success this will log the user in via the default guard and return the user model.
     *
     * @param int $userId
     * @param string $otp
     * @param Request $request
     * @param bool $loginOnSuccess default true
     * @return User
     *
     * @throws ValidationException
     */
    public function verifyOtp(int $userId, string $otp, Request $request, bool $loginOnSuccess = true): User
    {
        $otp = trim($otp);
        if ($otp === '') {
            throw ValidationException::withMessages(['otp' => 'Please enter the OTP.']);
        }

        $user = User::find($userId);
        if (! $user || $user->user_type !== 'company') {
            throw ValidationException::withMessages(['otp' => 'Invalid OTP session. Please login again.']);
        }

        // check attempts
        $attempts = Cache::get($this->attemptsCacheKey($userId), 0);
        if ($attempts >= $this->maxOtpAttempts) {
            // lock the user account
            $user->locked_until = Carbon::now()->addMinutes($this->lockMinutes);
            $user->save();

            // clean up OTP keys
            Cache::forget($this->otpCacheKey($userId));
            Cache::forget($this->attemptsCacheKey($userId));

            throw ValidationException::withMessages(['otp' => 'Maximum OTP attempts exceeded. Account locked.']);
        }

        $hashed = Cache::get($this->otpCacheKey($userId));
        if (! $hashed) {
            throw ValidationException::withMessages(['otp' => 'OTP expired. Please login again.']);
        }

        // verify OTP against hashed value
        if (! Hash::check($otp, $hashed)) {
            // increment attempts
            $attempts++;
            Cache::put($this->attemptsCacheKey($userId), $attempts, $this->otpTtlSeconds + 60);

            $remaining = max(0, $this->maxOtpAttempts - $attempts);
            $msg = 'Invalid OTP.';
            if ($remaining === 0) $msg .= ' Account locked for '.$this->lockMinutes.' minutes.';

            if ($attempts >= $this->maxOtpAttempts) {
                // lock the user as above
                $user->locked_until = Carbon::now()->addMinutes($this->lockMinutes);
                $user->save();

                Cache::forget($this->otpCacheKey($userId));
                Cache::forget($this->attemptsCacheKey($userId));
            }

            throw ValidationException::withMessages(['otp' => $msg]);
        }

        // OTP ok — clear cache keys
        Cache::forget($this->otpCacheKey($userId));
        Cache::forget($this->attemptsCacheKey($userId));

        // Reset any user-level failed_login_attempts/locked_until as needed
        $this->resetUserFailedAttempts($user);

        // Optionally log user in
        if ($loginOnSuccess) {
            $remember = (bool) ($request->boolean('remember', false));
            Auth::login($user, $remember);
            // update metadata
            $user->last_login_at = Carbon::now();
            $user->last_login_ip = $request->ip();
            $user->save();
        }

        return $user;
    }

    /**
     * Resend OTP for pending user id (re-generates OTP).
     *
     * @param int $userId
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function resendOtp(int $userId, Request $request): void
    {
        $user = User::find($userId);
        if (! $user || $user->user_type !== 'company') {
            throw ValidationException::withMessages(['otp' => 'No pending login found.']);
        }

        if ($this->isLockedOut($user)) {
            throw ValidationException::withMessages(['otp' => 'Account is locked. Please try later.']);
        }

        // regenerate OTP
        $otp = $this->generateOtp();
        $hashed = Hash::make($otp);
        Cache::put($this->otpCacheKey($userId), $hashed, $this->otpTtlSeconds);
        Cache::put($this->attemptsCacheKey($userId), 0, $this->otpTtlSeconds + 60);

        $this->sendSmsOrThrow($user, $otp);
    }

    /**
     * Logout the currently authenticated company (or any user).
     */
    public function logout(Request $request): void
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    /* -------------------------
     |  Helpers
     | ------------------------- */

    protected function otpCacheKey(int $userId): string
    {
        return "company_otp:{$userId}";
    }

    protected function attemptsCacheKey(int $userId): string
    {
        return "company_otp_attempts:{$userId}";
    }

    protected function generateOtp(): string
    {
        // 6 digit OTP
        return (string) random_int(100000, 999999);
    }

    protected function sendSmsOrThrow(User $user, string $otp): void
    {
        if (! is_callable($this->smsSender)) {
            // you should bind an sms sender callable when constructing this service
            throw new \RuntimeException('No SMS sender configured for CompanyAuthService.');
        }

        // prefer phone, fallback to email (you may change this)
        $dest = $user->phone ?? $user->mobile ?? $user->email ?? null;

        if (! $dest) {
            throw ValidationException::withMessages(['username' => 'No phone number found on this account to deliver OTP.']);
        }

        $sent = call_user_func($this->smsSender, $user, $otp);

        if (! $sent) {
            // If SMS provider indicates failure return an error
            throw ValidationException::withMessages(['username' => 'Unable to send OTP. Please try again later.']);
        }
    }

    protected function isLockedOut(User $user): bool
    {
        if (empty($user->locked_until)) return false;
        return Carbon::now()->lte(Carbon::parse($user->locked_until));
    }

    protected function incrementUserFailedAttempts(User $user): void
    {
        $user->failed_login_attempts = ($user->failed_login_attempts ?? 0) + 1;
        if ($user->failed_login_attempts >= 5) { // optional threshold for password attempts
            $user->locked_until = Carbon::now()->addMinutes($this->lockMinutes);
            $user->failed_login_attempts = 0;
        }
        $user->save();
    }

    protected function resetUserFailedAttempts(User $user): void
    {
        $user->failed_login_attempts = 0;
        $user->locked_until = null;
        $user->save();
    }
}
