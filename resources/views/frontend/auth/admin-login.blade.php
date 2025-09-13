{{-- resources/views/frontend/auth/admin-login.blade.php --}}
@extends('layouts.frontend.app')

@section('title', 'Admin Login')

@section('content')
  <div class="login-box" aria-labelledby="login-heading">
    <h2 id="login-heading">Admin Login</h2>
    <div class="title-underline" aria-hidden="true"></div>

    <form id="adminLoginForm" method="POST" action="{{ route('admin.login') }}">
      @csrf

      {{-- global error flash (not preferred; field errors shown inline) --}}
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <div class="mb-3">
        <label for="username" class="form-label">
          <i class="fa fa-user" style="color:#197a91;"></i> Username
        </label>
        <input
          type="text"
          class="form-control @error('username') is-invalid @enderror"
          id="username"
          name="username"
          value="{{ old('username') }}"
          placeholder="Username (case-sensitive)"
          autocomplete="username"
        >
        @error('username')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3 password-wrap">
        <label for="password" class="form-label">
          <i class="fa fa-lock" style="color:#197a91;"></i> Password
        </label>

        <div class="position-relative">
          <input
            type="password"
            class="form-control @error('password') is-invalid @enderror"
            id="password"
            name="password"
            placeholder="Enter your password"
            autocomplete="current-password"
          >
          <button type="button" class="toggle-eye btn btn-sm" aria-label="Toggle password visibility" style="position:absolute;top:50%;right:8px;transform:translateY(-50%);">
            <i class="fa fa-eye"></i>
          </button>
        </div>

        @error('password')
          <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
      </div>

      <div class="remember-row mb-3">
        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember" style="margin:0; font-weight:600; color:#555;">
          Remember me for 30 days
        </label>
      </div>

      <button type="submit" id="adminLoginSubmit" class="login-submit">
        <i class="fa fa-right-to-bracket" style="margin-right:10px;"></i> Login
      </button>
    </form>

    <div class="login-links mt-3">
      <a href="{{ route('admin.password.request') }}"><i class="fa fa-key"></i> Forgot Password?</a>
    </div>
  </div>
@endsection

@push('scripts')
<script>
(function () {
  'use strict';

  const form = document.getElementById('adminLoginForm');
  const submitBtn = document.getElementById('adminLoginSubmit');
  const pwdToggle = document.querySelector('.toggle-eye');
  const pwd = document.getElementById('password');

  if (pwdToggle && pwd) {
    pwdToggle.addEventListener('click', function (e) {
      e.preventDefault();
      const icon = this.querySelector('i');
      if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        pwd.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    });
  }

  function validate() {
    let ok = true;
    const username = (form.querySelector('[name="username"]').value || '').trim();
    const password = (form.querySelector('[name="password"]').value || '');

    function setInvalid(el, msg) {
      el.classList.add('is-invalid');
      let fb = el.parentNode.querySelector('.invalid-feedback');
      if (!fb) {
        fb = document.createElement('div');
        fb.className = 'invalid-feedback d-block';
        el.parentNode.appendChild(fb);
      }
      fb.textContent = msg;
    }
    function clearInvalid(el) {
      el.classList.remove('is-invalid');
      const fb = el.parentNode.querySelector('.invalid-feedback');
      if (fb && !fb.dataset.server) fb.textContent = '';
    }

    // username
    const userEl = form.querySelector('[name="username"]');
    if (!username) { setInvalid(userEl, 'Please enter your username.'); ok = false; }
    else { clearInvalid(userEl); }

    // password
    const passEl = form.querySelector('[name="password"]');
    if (!password) { setInvalid(passEl, 'Please enter your password.'); ok = false; }
    else if (password.length < 6) { setInvalid(passEl, 'Password must be at least 6 characters.'); ok = false; }
    else { clearInvalid(passEl); }

    return ok;
  }

  form.addEventListener('submit', function (e) {
    if (!validate()) {
      e.preventDefault();
      e.stopPropagation();
      const first = form.querySelector('.is-invalid');
      if (first) first.focus();
      return false;
    }

    // disable button to avoid double submits
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin" style="margin-right:8px;"></i> Logging in...';
    // allow form submit to server
  }, true);
})();
</script>
@endpush
