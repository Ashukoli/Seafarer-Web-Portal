<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminAuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    protected AdminAuthService $authService;

    public function __construct(AdminAuthService $authService)
    {
        $this->authService = $authService;

        // guests can see login form & attempt login; logged-in users can logout
        $this->middleware('guest')->only(['showLoginForm', 'login']);
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('frontend.auth.admin-login'); // your blade
    }

    /**
     * Handle login (no FormRequest; server-side validation inline).
     */
    public function login(Request $request)
    {
        // Basic validation here (same rules as candidate)
        $data = $request->validate([
            'username' => 'required|string|min:3|max:100',
            'password' => 'required|string|min:6',
            'remember' => 'sometimes|boolean',
        ], [
            'username.required' => 'Please enter your username.',
            'username.min' => 'Username must be at least :min characters.',
            'password.required' => 'Please enter your password.',
            'password.min' => 'Password must be at least :min characters.',
        ]);

        try {
            // Service will throw ValidationException on failure
            $this->authService->login($data, $request);

            // redirect to intended or to admin dashboard route (set that route in web.php)
            return redirect()->intended(route('admin.dashboard', []));
        } catch (ValidationException $e) {
            // attach validation errors produced by service (e.g. invalid credentials)
            return back()
                ->withInput($request->only('username', 'remember'))
                ->withErrors($e->errors());
        } catch (\Throwable $e) {
            // Generic fallback error (do not expose internal exception)
            return back()
                ->withInput($request->only('username', 'remember'))
                ->withErrors(['username' => 'Login failed. Please try again.']);
        }
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);

        // After logout redirect to admin login page
        return redirect()->route('admin.login.form');
    }

    // Optional password reset placeholders (avoid route not defined errors if linked)
    public function showForgotForm()
    {
        return view('frontend.auth.admin-password-email'); // optional view
    }

    public function sendResetLink(Request $request)
    {
        // stub: implement later if needed
        return back()->with('status','If the account exists, a reset link was sent.');
    }
}
