<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Services\Candidate\CandidateAuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class CandidateLoginController extends Controller
{
    protected CandidateAuthService $authService;

    public function __construct(CandidateAuthService $authService)
    {
        $this->authService = $authService;

        $this->middleware('guest')->only(['showLoginForm', 'login']);
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('frontend.auth.candidate-login'); // your blade file
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|max:191',
            'password' => 'required|string|min:6',
        ], [
            'email.required'    => 'Please enter your email address.',
            'email.email'       => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
            'password.min'      => 'Password must be at least :min characters long.',
        ]);

        try {
            $this->authService->login($request->only('email', 'password'), $request);
            return redirect()->intended(route('candidate.dashboard'));
        } catch (ValidationException $e) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors($e->errors());
        } catch (\Throwable $e) {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'Login failed. Please try again.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout(); // or just auth()->logout()
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('candidate.login.form');
    }
}
