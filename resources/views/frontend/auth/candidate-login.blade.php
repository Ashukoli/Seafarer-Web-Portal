{{-- resources/views/frontend/auth/login.blade.php --}}
@extends('layouts.frontend.app')

@section('title', 'Candidate Login')

@section('content')
  <!-- Candidate Login Form -->
  <div class="login-box" aria-labelledby="login-heading">
    <h2 id="login-heading">Candidate Login</h2>
    <div class="title-underline" aria-hidden="true"></div>

    <form id="loginForm" novalidate>
      <div class="mb-3">
        <label for="email" class="form-label">
          <i class="fa fa-envelope" style="color:#197a91;"></i> Email Address
        </label>
        <input type="email" class="form-control" id="email" placeholder="test@gmail.com" required>
      </div>

      <div class="mb-3 password-wrap">
        <label for="password" class="form-label">
          <i class="fa fa-lock" style="color:#197a91;"></i> Password
        </label>
        <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
        <button type="button" class="toggle-eye" aria-label="Toggle password visibility" title="Show / Hide password">
          <i class="fa fa-eye"></i>
        </button>
      </div>

      <div class="remember-row">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember" style="margin:0; font-weight:600; color:#555;">
          Remember me for 30 days
        </label>
      </div>

      <button type="submit" class="login-submit">
        <i class="fa fa-right-to-bracket" style="margin-right:10px;"></i> Login
      </button>
    </form>

    <div class="login-links">
      <a href="#"><i class="fa fa-key"></i> Forgot Password?</a>
      <a href="#"><i class="fa fa-user-plus"></i> New Registration</a>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  // Toggle password visibility
  (function(){
    const eyeBtn = document.querySelector('.toggle-eye');
    const pwd = document.getElementById('password');
    if(!eyeBtn || !pwd) return;

    eyeBtn.addEventListener('click', function(e){
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
  })();
</script>
@endpush
