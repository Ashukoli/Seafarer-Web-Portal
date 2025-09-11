{{-- resources/views/frontend/auth/company-login.blade.php --}}
@extends('layouts.frontend.app')

@section('title','Company Login')

@section('content')
<div class="company-login-wrap">
  <div class="company-card">
    <div class="top-accent"></div>

    <h2 class="company-title">Company Login</h2>
    <div class="small-underline" aria-hidden="true"></div>

    <div class="role-toggle" role="tablist" aria-label="Login type">
      <button id="tab-super" class="role-tab active" type="button" role="tab" aria-selected="true">SuperAdmin</button>
      <button id="tab-sub"   class="role-tab"           type="button" role="tab" aria-selected="false">Subadmin</button>
    </div>

    <!-- SuperAdmin form -->
    <form id="company-super-form" class="company-form" method="POST" action="#" novalidate>
      <label class="field-label"><i class="fa fa-envelope"></i> Email / Username</label>
      <input class="form-input" type="text" name="username" placeholder="admin@company.com" autocomplete="username">

      <label class="field-label mt-2"><i class="fa fa-lock"></i> Password</label>
      <div class="input-with-eye">
        <input class="form-input" id="super-password" type="password" name="password" placeholder="Enter your password" autocomplete="current-password">
        <button type="button" class="eye-btn" aria-label="Toggle password visibility"><i class="fa fa-eye"></i></button>
      </div>

      <div class="row align-items-center mt-2 gx-2">
        <div class="col-auto">
          <label class="remember">
            <input type="checkbox" name="remember"> Remember this device
          </label>
        </div>
        <div class="col text-end">
          <button type="submit" class="btn-login"> <i class="fa fa-right-to-bracket"></i> Login</button>
        </div>
      </div>
    </form>

    <!-- Subadmin form (design-only; second OTP step not shown here) -->
    <form id="company-sub-form" class="company-form d-none" method="POST" action="#" novalidate>
      <label class="field-label"><i class="fa fa-user"></i> Username</label>
      <input class="form-input" type="text" name="username_sub" placeholder="subadmin01">

      <label class="field-label mt-2"><i class="fa fa-lock"></i> Password</label>
      <div class="input-with-eye">
        <input class="form-input" id="sub-password" type="password" name="password_sub" placeholder="Enter your password">
        <button type="button" class="eye-btn" aria-label="Toggle password visibility"><i class="fa fa-eye"></i></button>
      </div>

      <div class="row align-items-center mt-2 gx-2">
        <div class="col-auto">
          <label class="remember">
            <input type="checkbox" name="remember_sub"> Remember this device
          </label>
        </div>
        <div class="col text-end">
          <button id="sub-continue" type="button" class="btn-login"> Continue</button>
        </div>
      </div>
    </form>

    <div class="links-row mt-3">
    <a href="#" class="link-small"><i class="fa fa-key"></i> Forgot Password?</a>
    <a href="#" class="link-small ms-3">
        <i class="fa fa-building"></i> Registration
    </a>
</div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  (function(){
    // Role tabs
    const tabSuper = document.getElementById('tab-super');
    const tabSub   = document.getElementById('tab-sub');
    const superForm = document.getElementById('company-super-form');
    const subForm   = document.getElementById('company-sub-form');
    const roleLabel = document.getElementById('roleLabel');

    function showSuper(){
      tabSuper.classList.add('active'); tabSuper.setAttribute('aria-selected','true');
      tabSub.classList.remove('active'); tabSub.setAttribute('aria-selected','false');
      superForm.classList.remove('d-none');
      subForm.classList.add('d-none');
      roleLabel.textContent = 'SuperAdmin';
    }

    function showSub(){
      tabSub.classList.add('active'); tabSub.setAttribute('aria-selected','true');
      tabSuper.classList.remove('active'); tabSuper.setAttribute('aria-selected','false');
      subForm.classList.remove('d-none');
      superForm.classList.add('d-none');
      roleLabel.textContent = 'Subadmin';
    }

    tabSuper.addEventListener('click', showSuper);
    tabSub.addEventListener('click', showSub);

    // eye toggle for password fields
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

  })();
</script>
@endpush
