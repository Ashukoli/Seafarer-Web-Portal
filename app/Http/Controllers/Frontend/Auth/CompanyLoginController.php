<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Services\Company\CompanyAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyLoginController extends Controller
{
    protected CompanyAuthService $service;

    public function __construct(CompanyAuthService $service)
    {
        $this->service = $service;
        $this->middleware('guest:company')->except('logout');
    }

    /**
     * Show the company login form.
     */
    public function showLoginForm()
    {
        return view('frontend.auth.company-login');
    }

    /**
     * Handle AJAX username/password login.
     * On success, generates OTP and returns JSON.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $user = $this->service->attemptLogin($request);

        $this->service->generateAndSendOtp($user);

        return response()->json([
            'success' => true,
            'user_id' => $user->id,
        ]);
    }

    /**
     * Handle AJAX OTP verification.
     * On success, logs in the user and returns JSON.
     */
    public function ajaxVerifyOtp(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'otp' => 'required|digits:6',
        ]);

        $user = $this->service->findUserById($request->user_id);

        if (!$user || !$this->service->verifyOtp($user, $request->otp)) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired OTP.']);
        }

        Auth::guard('company')->login($user);

        return response()->json([
            'success' => true,
            'redirect' => route('company.dashboard'),
        ]);
    }

    /**
     * Log the company user out.
     */
    public function logout(Request $request)
    {
        Auth::guard('company')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('company.login.form');
    }
}
