{{-- resources/views/frontend/auth/company-login.blade.php --}}
@extends('layouts.frontend.app')

@section('title','Company Login')

@section('content')
<div class="company-login-wrap">
  <div class="company-card">
    <div class="top-accent"></div>
    <h2 class="company-title">Company Login</h2>
    <div class="small-underline" aria-hidden="true"></div>

    <div id="login-errors" class="alert alert-danger d-none"></div>

    <form id="companyLoginForm" method="POST" autocomplete="off">
      @csrf
      <div id="login-fields">
        <label class="field-label"><i class="fa fa-user"></i> Username</label>
        <input class="form-input" type="text" name="username" autocomplete="username" required>

        <label class="field-label mt-2"><i class="fa fa-lock"></i> Password</label>
        <div class="input-with-eye">
          <input class="form-input" id="password" type="password" name="password" autocomplete="current-password" required>
          <button type="button" class="eye-btn" aria-label="Toggle password visibility"><i class="fa fa-eye"></i></button>
        </div>

        <div class="row align-items-center mt-2 gx-2">
          <div class="col-auto">
            <label class="remember">
              <input type="checkbox" name="remember"> Remember this device
            </label>
          </div>
          <div class="col text-end">
            <button type="submit" id="login-btn" class="btn-login"><i class="fa fa-right-to-bracket"></i> Login</button>
          </div>
        </div>
      </div>

      <div id="otp-fields" class="d-none">
        <label class="field-label"><i class="fa fa-key"></i> Enter OTP</label>
        <input class="form-input" type="text" name="otp" maxlength="6" autocomplete="one-time-code" id="otp-input">
        <div class="d-flex justify-content-between mt-2">
          <button type="button" class="btn btn-secondary" id="back-to-login">
            <i class="fa fa-arrow-left"></i> Back
          </button>
          <button type="submit" id="otp-btn" class="btn-login"><i class="fa fa-check"></i> Verify OTP</button>
        </div>
      </div>
    </form>

    <div class="links-row mt-3">
      <a href="#" class="link-small"><i class="fa fa-key"></i> Forgot Password?</a>
      <a href="#" class="link-small ms-3"><i class="fa fa-building"></i> Registration</a>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // Password eye toggle
  document.querySelectorAll('.eye-btn').forEach(btn=>{
    btn.addEventListener('click', function(e){
      e.preventDefault();
      const input = this.parentElement.querySelector('input.form-input');
      const icon = this.querySelector('i');
      if(!input) return;
      if(input.type === 'password'){ input.type = 'text'; icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); }
      else { input.type = 'password'; icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); }
    });
  });

  const form = document.getElementById('companyLoginForm');
  const loginFields = document.getElementById('login-fields');
  const otpFields = document.getElementById('otp-fields');
  const errorDiv = document.getElementById('login-errors');
  const backBtn = document.getElementById('back-to-login');
  const otpInput = document.getElementById('otp-input');

  let step = 'login'; // or 'otp'
  let tempUserId = null;

  form.addEventListener('submit', function(e){
    e.preventDefault();
    errorDiv.classList.add('d-none');
    errorDiv.textContent = '';

    if(step === 'login') {
      otpInput.removeAttribute('required');
      // AJAX: Validate username/password
      fetch("{{ route('company.login') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          username: form.username.value,
          password: form.password.value,
          remember: form.remember.checked ? 1 : 0
        })
      })
      .then(res => res.json())
      .then(data => {
        if(data.success) {
          tempUserId = data.user_id; // Store for OTP step
          loginFields.classList.add('d-none');
          otpFields.classList.remove('d-none');
          step = 'otp';
          otpInput.setAttribute('required', 'required');
          otpInput.focus();
        } else {
          errorDiv.textContent = data.message || 'Invalid credentials';
          errorDiv.classList.remove('d-none');
        }
      })
      .catch(() => {
        errorDiv.textContent = 'Server error. Please try again.';
        errorDiv.classList.remove('d-none');
      });
    } else if(step === 'otp') {
      otpInput.setAttribute('required', 'required');
      // AJAX: Verify OTP
      fetch("{{ route('company.otp.verify') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          user_id: tempUserId,
          otp: form.otp.value
        })
      })
      .then(res => res.json())
      .then(data => {
        if(data.success) {
          window.location = data.redirect || "{{ route('company.dashboard') }}";
        } else {
          errorDiv.textContent = data.message || 'Invalid OTP';
          errorDiv.classList.remove('d-none');
        }
      })
      .catch(() => {
        errorDiv.textContent = 'Server error. Please try again.';
        errorDiv.classList.remove('d-none');
      });
    }
  });

  // Back button for OTP step
  backBtn.addEventListener('click', function(){
    otpFields.classList.add('d-none');
    loginFields.classList.remove('d-none');
    step = 'login';
    form.otp.value = '';
    otpInput.removeAttribute('required');
    errorDiv.classList.add('d-none');
    errorDiv.textContent = '';
  });
</script>
@endpush
