<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyStartLoginRequest;
use App\Http\Requests\CompanyVerifyOtpRequest;
use App\Services\Company\CompanyAuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CompanyLoginController extends Controller
{
    protected CompanyAuthService $authService;

    // session key used to track pending OTP flows
    protected string $sessionOtpKey = 'company_otp_user_id';

    public function __construct(CompanyAuthService $authService)
    {
        $this->authService = $authService;

        // Only guests may access startLogin and showOtpForm/verifyOtp.
        // Logout should be allowed for authenticated users.
        $this->middleware('guest')->only(['showLoginForm', 'startLogin', 'showOtpForm', 'verifyOtp']);
        $this->middleware('auth')->only(['logout', 'dashboard']);
    }

    /**
     * Show the company username/password login form (step 1).
     */
    public function showLoginForm()
    {
        return view('frontend.auth.company-login');
    }

    /**
     * Handle username/password submission for company login.
     *
     * This validates username/password, checks the account (user_type=company),
     * and if OK, creates & sends an OTP and stores the pending user id in session.
     *
     * Uses CompanyStartLoginRequest for validation.
     */
    public function startLogin(CompanyStartLoginRequest $request)
    {
        $data = $request->only(['username', 'password']);
        $username = trim($data['username']);

        try {
            // authService->startLogin should:
            //  - verify username & password (case-sensitive for username)
            //  - ensure the user is company-type and active
            //  - create/store an OTP (hashed) with expiry
            //  - send OTP via SMS provider
            // It returns the user model (or at least the user id).
            $user = $this->authService->startLogin($username, $data['password'], $request);

            // store pending OTP flow user id in session (short-lived)
            session([$this->sessionOtpKey => $user->id]);

            // Redirect to OTP verification page (show form)
            return redirect()->route('company.login.verify.form')
                ->with('status', 'OTP sent to the company mobile number associated with this account. It will expire shortly.');
        } catch (ValidationException $e) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors($e->errors());
        } catch (\Throwable $e) {
            // Generic failure (don't expose internal errors)
            return back()
                ->withInput($request->only('username'))
                ->withErrors(['username' => 'Login failed. Please try again.']);
        }
    }

    /**
     * Show the OTP verification form (step 2).
     *
     * The session must contain the pending OTP user id. If not, redirect back
     * to the start login form.
     */
    public function showOtpForm(Request $request)
    {
        $pendingUserId = session($this->sessionOtpKey);

        if (empty($pendingUserId)) {
            // No pending OTP flow — go back to username/password login
            return redirect()->route('company.login.form')
                ->with('error', 'Please enter username and password first.');
        }

        return view('frontend.auth.company-otp-verify'); // make this blade
    }

    /**
     * Verify the OTP submitted by the user.
     *
     * Uses CompanyVerifyOtpRequest for validation.
     * On success: logs the user in (creates session) and removes pending session key.
     */
    public function verifyOtp(CompanyVerifyOtpRequest $request)
    {
        $otp = (string) $request->input('otp');
        $pendingUserId = session($this->sessionOtpKey);

        if (empty($pendingUserId)) {
            return redirect()->route('company.login.form')
                ->with('error', 'OTP session expired. Please login again.');
        }

        try {
            // CompanyAuthService::verifyOtp should:
            //  - validate OTP (hashed compare/attempts/expiry)
            //  - if valid, return the user model (or id)
            $user = $this->authService->verifyOtp((int)$pendingUserId, $otp, $request);

            // Log the user in (web guard). Company accounts use same users table.
            // If you used a specific guard for companies, change guard accordingly.
            auth()->login($user, $request->boolean('remember', false));

            // Clear the pending OTP session key
            $request->session()->forget($this->sessionOtpKey);

            // Redirect to company dashboard or intended URL
            return redirect()->intended(route('company.dashboard'));
        } catch (ValidationException $e) {
            // OTP invalid or attempts exceeded etc
            return back()
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Throwable $e) {
            // Generic failure
            return back()
                ->withInput()
                ->withErrors(['otp' => 'Unable to verify OTP. Please try again.']);
        }
    }

    /**
     * Resend OTP endpoint (optional).
     *
     * This will re-generate & re-send OTP for the pending user in session.
     */
    public function resendOtp(Request $request)
    {
        $pendingUserId = session($this->sessionOtpKey);

        if (empty($pendingUserId)) {
            return redirect()->route('company.login.form')->with('error', 'No pending login found.');
        }

        try {
            $this->authService->resendOtp((int)$pendingUserId, $request);
            return back()->with('status', 'OTP resent successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Throwable $e) {
            return back()->withErrors(['otp' => 'Unable to resend OTP. Please try again later.']);
        }
    }

    /**
     * Log the company user out.
     */
    public function logout(Request $request)
    {
        // delegate to service to handle session invalidation if needed
        $this->authService->logout($request);

        // Clear any pending OTP session keys to be safe
        $request->session()->forget($this->sessionOtpKey);

        return redirect()->route('company.login.form')->with('status', 'You have been logged out.');
    }

    /**
     * Example company dashboard method (requires auth middleware).
     */
    public function dashboard()
    {
        return view('company.dashboard'); // create view
    }
}
