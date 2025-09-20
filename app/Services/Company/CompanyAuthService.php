<?php

namespace App\Services\Company;

use App\Models\User;
use App\Models\CompanyOtp;
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
}
