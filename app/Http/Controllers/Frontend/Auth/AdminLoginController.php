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
        $this->middleware('guest:admin')->only(['showLoginForm', 'login']);
        $this->middleware('auth:admin')->only('logout');
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

        // Build credential array; include user_type filter so only admin rows match
        $credentials = [
            'username'  => $data['username'],
            'password'  => $data['password'],
            'user_type' => 'admin',
        ];

        // Attempt login using admin guard (which uses users provider)
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            // Authentication passed
            $admin = Auth::guard('admin')->user();

            // Optional additional role check (if you use `role` column to restrict)
            $allowedRoles = ['super_admin', 'subadmin', 'executive']; // adjust to your values
            $role = strtolower($admin->role ?? '');

            if (! in_array($role, $allowedRoles, true)) {
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                throw ValidationException::withMessages([
                    'username' => 'You are not authorized to access the admin panel.',
                ]);
            }

            // Regenerate session and redirect
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        // Authentication failed
        throw ValidationException::withMessages([
            'username' => 'Invalid username or password.',
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
