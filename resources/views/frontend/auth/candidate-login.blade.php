{{-- resources/views/frontend/auth/login.blade.php --}}
@extends('layouts.frontend.app')

@section('title', 'Candidate Login')

@section('content')
  <!-- Candidate Login Form -->
  <div class="login-box" aria-labelledby="login-heading">
    <h2 id="login-heading">Candidate Login</h2>
    <div class="title-underline" aria-hidden="true"></div>

    <form id="loginForm" method="POST" action="{{ route('candidate.login') }}">
      @csrf

      {{-- Email --}}
      <div class="mb-3">
        <label for="email" class="form-label">
          <i class="fa fa-envelope text-primary"></i> Email Address
        </label>
        <input
          type="email"
          class="form-control @error('email') is-invalid @enderror"
          id="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="Enter your email"
          autocomplete="email"
        >
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Password --}}
      <div class="mb-3 password-wrap">
        <label for="password" class="form-label">
          <i class="fa fa-lock text-primary"></i> Password
        </label>
        <input
          type="password"
          class="form-control @error('password') is-invalid @enderror"
          id="password"
          name="password"
          placeholder="Enter your password"
          autocomplete="current-password"
        >
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Remember me --}}
      <div class="remember-row mb-3 d-flex align-items-center">
        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember" class="ms-2 fw-semibold text-muted">
          Remember me for 30 days
        </label>
      </div>

      {{-- Submit --}}
      <button type="submit" id="loginSubmit" class="login-submit btn btn-primary w-100">
        <i class="fa fa-right-to-bracket me-2"></i> Login
      </button>
    </form>

    <div class="login-links mt-3 text-center">
      {{-- Enable only if you have the route --}}
      {{-- <a href="{{ route('candidate.password.request') }}"><i class="fa fa-key"></i> Forgot Password?</a> --}}
      {{-- <a href="{{ route('candidate.register.form') }}"><i class="fa fa-user-plus"></i> New Registration</a> --}}
    </div>
  </div>
@endsection
