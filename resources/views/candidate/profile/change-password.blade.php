@extends('layouts.app')
@section('content')
<main class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3">
            <i class="bx bx-user-circle me-2 text-primary"></i>Candidate
        </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 enhanced-breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('candidate.dashboard') }}" class="breadcrumb-link">
                            <i class="bx bx-home-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bx bx-lock-alt me-1"></i>Change Password
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-xl-12 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <div class="d-flex align-items-center">
                        <div class="card-title mb-0">
                            <i class="bx bx-user-circle text-primary me-2"></i>
                            <strong>Profile - Change Password</strong>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    {{-- Success and error messages can be added here if needed --}}
                    <form class="needs-validation" novalidate>
                        <!-- Email (Full Width) -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    Email Address
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input class="form-control" type="email" value="candidate@email.com" readonly>
                                    <span class="input-group-text text-success">
                                        <i class="bx bx-check-circle"></i>
                                    </span>
                                </div>
                                <small class="text-muted">This email is verified and cannot be changed</small>
                            </div>
                        </div>

                        <!-- Current Password & New Password (Two Fields in One Row) -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="form-label fw-semibold">
                                    Current Password <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bx bx-key"></i></span>
                                    <input class="form-control" type="password" id="currentPassword" placeholder="Enter current password" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('currentPassword', this)">
                                        <i class="bx bx-hide"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback">
                                    Please enter your current password.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    New Password <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bx bx-lock"></i></span>
                                    <input class="form-control" type="password" id="newPassword" placeholder="Enter new password" minlength="8" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('newPassword', this)">
                                        <i class="bx bx-hide"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Minimum 8 characters</small>
                                <div class="invalid-feedback">
                                    Password must be at least 8 characters long.
                                </div>
                            </div>
                        </div>

                        <!-- Confirm Password & Password Strength (Two Fields in One Row) -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="form-label fw-semibold">
                                    Confirm New Password <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bx bx-check-shield"></i></span>
                                    <input class="form-control" type="password" id="confirmPassword" placeholder="Re-enter new password" minlength="8" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirmPassword', this)">
                                        <i class="bx bx-hide"></i>
                                    </button>
                                </div>
                                <div class="password-match mt-1" id="passwordMatch" style="display: none;">
                                    <small class="text-success">
                                        <i class="bx bx-check-circle me-1"></i>Passwords match
                                    </small>
                                </div>
                                <div class="invalid-feedback">
                                    Passwords do not match.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Password Strength
                                </label>
                                <div class="password-strength-container">
                                    <div class="password-strength-bar">
                                        <div class="strength-bar-fill" id="strengthBar"></div>
                                    </div>
                                    <small class="strength-text" id="strengthText">Enter a password to see strength</small>
                                </div>
                                <div class="password-requirements mt-2">
                                    <small class="text-muted">Requirements:</small>
                                    <div class="requirement-list">
                                        <small class="req-item" id="req-length">
                                            <i class="bx bx-x text-danger"></i> 8+ characters
                                        </small>
                                        <small class="req-item" id="req-upper">
                                            <i class="bx bx-x text-danger"></i> Uppercase
                                        </small>
                                        <small class="req-item" id="req-lower">
                                            <i class="bx bx-x text-danger"></i> Lowercase
                                        </small>
                                        <small class="req-item" id="req-number">
                                            <i class="bx bx-x text-danger"></i> Number
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="border-top pt-3">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('candidate.dashboard') }}" class="btn btn-light btn-lg px-4">
                                    <i class="bx bx-x me-1"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-4" id="submitBtn">
                                    <span class="submit-text">
                                        <i class="bx bx-save me-1"></i>Update Password
                                    </span>
                                    <span class="submit-loading" style="display: none;">
                                        <i class="bx bx-loader-alt bx-spin me-1"></i>Updating...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.card-header {
    border-bottom: 1px solid #dee2e6;
}

.input-group-text {
    background-color: #f8f9fa;
    border-right: none;
    color: #6c757d;
}

.form-control:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.form-label.fw-semibold {
    color: #495057;
    margin-bottom: 0.5rem;
}

.text-primary {
    color: #0d6efd !important;
}

.btn-lg {
    padding: 0.5rem 1rem;
    font-size: 1rem;
    border-radius: 0.375rem;
}

small.text-muted {
    font-size: 0.775em;
}

/* Password Strength Styling */
.password-strength-container {
    padding: 12px;
    background: #f8f9fa;
    border-radius: 6px;
    border: 1px solid #e9ecef;
}

.password-strength-bar {
    width: 100%;
    height: 8px;
    background: #e9ecef;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 8px;
}

.strength-bar-fill {
    height: 100%;
    background: #e9ecef;
    transition: all 0.3s ease;
    width: 0%;
}

.strength-bar-fill.weak {
    background: #dc3545;
    width: 25%;
}

.strength-bar-fill.fair {
    background: #fd7e14;
    width: 50%;
}

.strength-bar-fill.good {
    background: #20c997;
    width: 75%;
}

.strength-bar-fill.strong {
    background: #198754;
    width: 100%;
}

.strength-text {
    font-weight: 500;
    color: #6c757d;
}

.strength-text.weak { color: #dc3545; }
.strength-text.fair { color: #fd7e14; }
.strength-text.good { color: #20c997; }
.strength-text.strong { color: #198754; }

/* Password Requirements */
.password-requirements {
    background: #f8f9fa;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #e9ecef;
}

.requirement-list {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4px;
    margin-top: 4px;
}

.req-item {
    display: flex;
    align-items: center;
    font-size: 0.75rem;
}

.req-item.met i {
    color: #198754 !important;
}

.req-item.met i::before {
    content: '\ea5c'; /* bx-check icon */
}

/* Toggle Password Button */
.btn-outline-secondary {
    border-left: none;
    background: #f8f9fa;
    border-color: #ced4da;
}

.btn-outline-secondary:hover {
    background: #e9ecef;
    border-color: #ced4da;
}

/* Password Match Indicator */
.password-match {
    transition: all 0.3s ease;
}

/* Form Validation */
.was-validated .form-control:invalid {
    border-color: #dc3545;
}

.was-validated .form-control:valid {
    border-color: #198754;
}

.invalid-feedback {
    display: none;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}

.was-validated .form-control:invalid ~ .invalid-feedback {
    display: block;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .requirement-list {
        grid-template-columns: 1fr;
    }
    
    .password-strength-container {
        margin-top: 1rem;
    }
}

/* Loading state */
.submit-loading {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

#submitBtn {
    position: relative;
}

#submitBtn:disabled {
    opacity: 0.6;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const newPasswordInput = document.getElementById('newPassword');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const currentPasswordInput = document.getElementById('currentPassword');
    const form = document.querySelector('form');
    
    // Password strength checker
    newPasswordInput.addEventListener('input', function() {
        checkPasswordStrength(this.value);
        checkPasswordMatch();
    });
    
    // Password match checker
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    
    // Form validation
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateForm()) {
            submitForm();
        }
        
        this.classList.add('was-validated');
    });
    
    function checkPasswordStrength(password) {
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');
        
        let score = 0;
        let feedback = 'Enter a password';
        
        if (password.length === 0) {
            strengthBar.className = 'strength-bar-fill';
            strengthText.textContent = feedback;
            strengthText.className = 'strength-text';
            updateRequirements(password);
            return;
        }
        
        // Check requirements
        const requirements = {
            length: password.length >= 8,
            uppercase: /[A-Z]/.test(password),
            lowercase: /[a-z]/.test(password),
            number: /[0-9]/.test(password)
        };
        
        updateRequirements(password);
        
        // Calculate score
        Object.values(requirements).forEach(met => {
            if (met) score++;
        });
        
        // Determine strength
        let level = '';
        if (score === 0) {
            level = '';
            feedback = 'Very weak';
        } else if (score <= 1) {
            level = 'weak';
            feedback = 'Weak password';
        } else if (score === 2) {
            level = 'fair';
            feedback = 'Fair password';
        } else if (score === 3) {
            level = 'good';
            feedback = 'Good password';
        } else {
            level = 'strong';
            feedback = 'Strong password';
        }
        
        strengthBar.className = `strength-bar-fill ${level}`;
        strengthText.textContent = feedback;
        strengthText.className = `strength-text ${level}`;
    }
    
    function updateRequirements(password) {
        const requirements = [
            { id: 'req-length', test: password.length >= 8 },
            { id: 'req-uppercase', test: /[A-Z]/.test(password) },
            { id: 'req-lowercase', test: /[a-z]/.test(password) },
            { id: 'req-number', test: /[0-9]/.test(password) }
        ];
        
        requirements.forEach(req => {
            const element = document.getElementById(req.id);
            if (req.test) {
                element.classList.add('met');
            } else {
                element.classList.remove('met');
            }
        });
    }
    
    function checkPasswordMatch() {
        const newPassword = newPasswordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        const matchIndicator = document.getElementById('passwordMatch');
        
        if (confirmPassword.length > 0) {
            if (newPassword === confirmPassword) {
                matchIndicator.style.display = 'block';
                confirmPasswordInput.setCustomValidity('');
            } else {
                matchIndicator.style.display = 'none';
                confirmPasswordInput.setCustomValidity('Passwords do not match');
            }
        } else {
            matchIndicator.style.display = 'none';
            confirmPasswordInput.setCustomValidity('');
        }
    }
    
    function validateForm() {
        const inputs = [currentPasswordInput, newPasswordInput, confirmPasswordInput];
        let isValid = true;
        
        inputs.forEach(input => {
            if (!input.checkValidity()) {
                isValid = false;
            }
        });
        
        // Check password strength
        const strengthBar = document.getElementById('strengthBar');
        if (!strengthBar.classList.contains('good') && !strengthBar.classList.contains('strong')) {
            isValid = false;
            // Could show additional error message here
        }
        
        return isValid;
    }
    
    function submitForm() {
        const submitBtn = document.getElementById('submitBtn');
        const submitText = submitBtn.querySelector('.submit-text');
        const submitLoading = submitBtn.querySelector('.submit-loading');
        
        // Show loading state
        submitText.style.display = 'none';
        submitLoading.style.display = 'block';
        submitBtn.disabled = true;
        
        // Simulate API call
        setTimeout(() => {
            // Reset button state
            submitText.style.display = 'block';
            submitLoading.style.display = 'none';
            submitBtn.disabled = false;
            
            // Show success message (you can implement this)
            alert('Password updated successfully!');
            
            // Redirect or reset form
            window.location.href = "{{ route('candidate.dashboard') }}";
        }, 2000);
    }
});

function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bx bx-show';
    } else {
        input.type = 'password';
        icon.className = 'bx bx-hide';
    }
}
</script>
@endsection
