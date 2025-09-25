<?php

namespace App\Services\Company;

use App\Models\User;
use App\Models\CompanyOtp;
use App\Models\CompanySubadminLoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class CompanyAuthService
{
    /**
     * Attempt login with username and password for company user.
     * Throws ValidationException on failure.
     */
    public function attemptLogin(Request $request): User
    {
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            'user_type' => 'company',
        ];

        if (!Auth::guard('company')->validate($credentials)) {
            throw ValidationException::withMessages(['username' => 'Invalid username or password.']);
        }

        $user = User::where('username', $credentials['username'])
            ->where('user_type', 'company')
            ->firstOrFail();

        return $user;
    }

    /**
     * Generate a 6-digit OTP, store in DB, and (optionally) send to user.
     */
    public function generateAndSendOtp(User $user): void
    {
        $otp = random_int(100000, 999999);

        // Remove any previous OTPs for this user
        CompanyOtp::where('user_id', $user->id)->delete();

        // Store OTP in DB, valid for 5 minutes
        CompanyOtp::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(5),
        ]);

        // For now, just log the OTP (replace with SMS/email in production)
        Log::info("Company OTP for user {$user->id}: $otp");
    }

    /**
     * Find user by ID (for OTP step).
     */
    public function findUserById($id): ?User
    {
        return User::where('id', $id)->where('user_type', 'company')->first();
    }

    /**
     * Verify OTP for user from DB.
     */
    public function verifyOtp(User $user, string $otp): bool
    {
        $record = CompanyOtp::where('user_id', $user->id)
            ->where('otp', $otp)
            ->where('expires_at', '>', now())
            ->first();

        if ($record) {
            $record->delete(); // Invalidate OTP after use
            return true;
        }
        return false;
    }

    /**
     * Log company login event.
     */
    public function logLogin(User $user, Request $request): void
    {
        $ip = $request->ip();
        if ($ip === '127.0.0.1' || $ip === '::1') {
            $ip = '157.20.87.192'; // Google's public DNS for testing
        }

        $location = [];

        try {
            $response = @file_get_contents("http://ip-api.com/json/{$ip}?fields=status,country,regionName,city,lat,lon,timezone,query");
            $data = $response ? json_decode($response, true) : null;

            if ($data && $data['status'] === 'success') {
                $location = [
                    'country' => $data['country'] ?? null,
                    'region' => $data['regionName'] ?? null,
                    'city' => $data['city'] ?? null,
                    'lat' => $data['lat'] ?? null,
                    'lon' => $data['lon'] ?? null,
                    'timezone' => $data['timezone'] ?? null,
                    'provider' => 'ip-api.com',
                    'ip' => $data['query'] ?? $ip,
                ];
            }
        } catch (\Exception $e) {
            // Optionally log error
            $location = [];
        }

        $log = CompanySubadminLoginLog::create([
            'user_id' => $user->id,
            'company_id' => $user->company_id ?? null,
            'login_at' => now(),
            'ip_address' => $ip,
            'ip_location' => $location,
            'session_id' => session()->getId(),
            'user_agent' => $request->userAgent(),
        ]);
        session(['company_login_log_id' => $log->id]);
    }

    /**
     * Log company logout event.
     */
    public function logLogout(?User $user): void
    {
        $logId = session('company_login_log_id');
        if ($logId) {
            $log = CompanySubadminLoginLog::find($logId);
            if ($log && !$log->logout_at) {
                $log->logout_at = now();
                $log->duration_seconds = $log->logout_at->diffInSeconds($log->login_at);
                $log->save();
            }
            session()->forget('company_login_log_id');
        }
    }
}
