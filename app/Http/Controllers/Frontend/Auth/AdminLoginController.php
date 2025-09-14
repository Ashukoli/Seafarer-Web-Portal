<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminAuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

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
        $credentials = $request->validate([
            'email' => 'required|email',   // or use 'username' if you want
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Please enter your email.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
            'password.min' => 'Password must be at least :min characters.',
        ]);
        if (Auth::guard('admin')->attempt(
            ['email' => $credentials['email'], 'password' => $credentials['password']],
            $request->filled('remember')
        )) {
            $user = Auth::guard('admin')->user();
            if (! in_array($user->user_type, ['super_admin', 'subadmin', 'executive'])) {
                Auth::guard('admin')->logout();
                throw ValidationException::withMessages([
                    'email' => 'You are not authorized to access the admin panel.',
                ]);
            }
            return redirect()->intended(route('admin.dashboard'));
        }
        throw ValidationException::withMessages([
            'email' => 'Invalid email or password.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
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
