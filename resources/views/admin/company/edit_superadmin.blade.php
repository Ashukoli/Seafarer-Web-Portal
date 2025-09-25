{{-- filepath: resources/views/admin/company/edit_superadmin.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<main class="page-content professional-bg">
    <div class="container">
        <!-- Enhanced Breadcrumb with Dashboard -->
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="modern-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-home-alt"></i>
                                </div>
                                <span class="breadcrumb-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.company.index') }}" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-buildings"></i>
                                </div>
                                <span class="breadcrumb-text">Companies</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.company.adminlogins', $company->id) }}" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-group"></i>
                                </div>
                                <span class="breadcrumb-text">Admin Logins</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-user-circle"></i>
                            </div>
                            <span class="breadcrumb-text">Edit Superadmin</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.company.superadmin.update', $company->id) }}" class="modern-professional-card">
            @csrf
            <div class="card-header modern-header">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bx bx-user-circle"></i>
                    </div>
                    <div class="header-text">
                        <h5 class="header-title">Superadmin Configuration</h5>
                        <p class="header-subtitle">Configure company superadmin account settings</p>
                    </div>
                </div>
            </div>

            <div class="card-body modern-body">
                     
                @if(session('success'))
                    <div class="modern-alert modern-alert-success mb-4">
                        <div class="alert-icon">
                            <i class="bx bx-check-circle"></i>
                        </div>
                        <div class="alert-content">
                            <strong>Success!</strong>
                            {{ session('success') }}
                        </div>
                        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="modern-alert modern-alert-error mb-4">
                        <div class="alert-icon">
                            <i class="bx bx-error-circle"></i>
                        </div>
                        <div class="alert-content">
                            <strong>Error!</strong>
                            {{ session('error') }}
                        </div>
                        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="modern-alert modern-alert-error mb-4">
                        <div class="alert-icon">
                            <i class="bx bx-error-circle"></i>
                        </div>
                        <div class="alert-content">
                            <strong>Validation Errors:</strong>
                            <ul class="error-list">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>
                @endif

                <div class="modern-form-container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="modern-form-group">
                                <label class="modern-form-label">
                                    <span class="label-text">Username</span>
                                    <span class="required-indicator">*</span>
                                </label>
                                <input type="text"
                                       name="superadmin_username"
                                       class="modern-form-control"
                                       value="{{ old('superadmin_username', $superadmin->username ?? '') }}"
                                       placeholder="Enter username"
                                       required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="modern-form-group">
                                <label class="modern-form-label">
                                    <span class="label-text">Full Name</span>
                                    <span class="required-indicator">*</span>
                                </label>
                                <input type="text"
                                       name="superadmin_name"
                                       class="modern-form-control"
                                       value="{{ old('superadmin_name', $superadmin->first_name ?? '') }}"
                                       placeholder="Enter full name"
                                       required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="modern-form-group">
                                <label class="modern-form-label">
                                    <span class="label-text">Designation</span>
                                    <span class="required-indicator">*</span>
                                </label>
                               <input type="text"
                                    name="superadmin_designation"
                                    class="modern-form-control"
                                    value="{{ old('superadmin_designation', $superadmin->designation ?? '') }}"
                                    placeholder="Enter designation"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="modern-form-group">
                                <label class="modern-form-label">
                                    <span class="label-text">Mobile Number</span>
                                    <span class="required-indicator">*</span>
                                </label>
                                <div class="modern-input-group">
                                    <select name="superadmin_country_code"
                                            class="modern-form-control modern-form-select country-select"
                                            required>
                                        @foreach($countryCodes as $code)
                                            <option value="{{ $code->dial_code }}"
                                                {{ old(
                                                    'superadmin_country_code',
                                                    $superadmin->country_code ?? $company->superadmin_country_code ?? '+91'
                                                ) == $code->dial_code ? 'selected' : '' }}>
                                                {{ $code->dial_code }} ({{ $code->country_code }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="text"
                                           name="superadmin_mobile"
                                           class="modern-form-control mobile-input"
                                           value="{{ old(
                                               'superadmin_mobile',
                                               $superadmin->mobile ?? $company->superadmin_mobile ?? ''
                                           ) }}"
                                           placeholder="Mobile number"
                                           required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="modern-form-group">
                                <label class="modern-form-label">
                                    <span class="label-text">Password</span>
                                    @if(!isset($superadmin))
                                        <span class="required-indicator">*</span>
                                    @endif
                                </label>
                                <div class="password-input-wrapper">
                                    <input type="password"
                                           name="superadmin_password"
                                           class="modern-form-control password-input"
                                           placeholder="Enter password"
                                           {{ isset($superadmin) ? '' : 'required' }}
                                           autocomplete="new-password">
                                    <button type="button" class="password-toggle" tabindex="-1">
                                        <i class="bx bx-show"></i>
                                    </button>
                                </div>
                                <small class="form-hint">Leave blank to keep current password</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="modern-form-group">
                                <label class="modern-form-label">
                                    <span class="label-text">Email</span>
                                    <span class="optional-indicator">(Optional)</span>
                                </label>
                                <input type="email"
                                       name="superadmin_email"
                                       class="modern-form-control"
                                       value="{{ old('superadmin_email', $superadmin->email ?? '') }}"
                                       placeholder="email@company.com">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer modern-footer">
                <div class="footer-actions">
                    <a href="{{ route('admin.company.index') }}" class="modern-btn modern-btn-outline-secondary">
                        <i class="bx bx-left-arrow-alt"></i>
                        <span>Back to Companies</span>
                    </a>
                    <button type="submit" class="modern-btn modern-btn-primary">
                        <i class="bx bx-save"></i>
                        <span>Update Configuration</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection

@push('styles')
<style>
/* Modern Professional Styling with Eye-Friendly Colors */
:root {
    --primary-color: #6366f1;
    --primary-hover: #4f46e5;
    --secondary-color: #6b7280;
    --success-color: #10b981;
    --danger-color: #ef4444;
    --warning-color: #f59e0b;
    --background-color: #f8fafc;
    --card-background: #ffffff;
    --border-color: #e5e7eb;
    --text-primary: #111827;
    --text-secondary: #6b7280;
    --text-muted: #9ca3af;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    --border-radius: 12px;
    --border-radius-sm: 8px;
    --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);

    /* New Eye-Friendly Header Colors */
    --header-primary: #e0e7ff;
    --header-secondary: #c7d2fe;
    --header-accent: #a5b4fc;
    --header-text: #3730a3;
    --header-text-light: #4338ca;
}

.professional-bg {
    background: linear-gradient(135deg, #f8fafc 0%, #e5e7eb 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

/* Modern Alert Styling */
.modern-alert {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem 1.5rem;
    border-radius: var(--border-radius-sm);
    border: 1px solid;
    position: relative;
    box-shadow: var(--shadow-sm);
    animation: slideInDown 0.3s ease-out;
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modern-alert-success {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(16, 185, 129, 0.05) 100%);
    border-color: rgba(16, 185, 129, 0.2);
    color: #065f46;
}

.modern-alert-error {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.08) 0%, rgba(239, 68, 68, 0.05) 100%);
    border-color: rgba(239, 68, 68, 0.2);
    color: #7f1d1d;
}

.alert-icon {
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1rem;
}

.modern-alert-success .alert-icon {
    background: var(--success-color);
    color: white;
}

.modern-alert-error .alert-icon {
    background: var(--danger-color);
    color: white;
}

.alert-content {
    flex: 1;
    line-height: 1.5;
}

.alert-content strong {
    font-weight: 600;
    display: block;
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
}

.error-list {
    margin: 0.5rem 0 0 0;
    padding-left: 1.25rem;
    list-style-type: disc;
}

.error-list li {
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
    line-height: 1.4;
}

.alert-close {
    position: absolute;
    top: 0.75rem;
    right: 1rem;
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: var(--transition);
    opacity: 0.7;
}

.alert-close:hover {
    opacity: 1;
    background: rgba(0, 0, 0, 0.1);
}

.alert-close i {
    font-size: 1rem;
}

/* Modern Breadcrumb Styling */
.modern-breadcrumb {
    display: flex;
    align-items: center;
    background: var(--card-background);
    padding: 1rem 1.5rem;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
    margin: 0;
    list-style: none;
    gap: 0.75rem;
}

.breadcrumb-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.breadcrumb-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    padding: 0.5rem 0.75rem;
    border-radius: var(--border-radius-sm);
    transition: var(--transition);
    background: transparent;
}

.breadcrumb-link:hover {
    color: var(--primary-color);
    background: rgba(99, 102, 241, 0.1);
    text-decoration: none;
}

.breadcrumb-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    border-radius: 4px;
    background: rgba(99, 102, 241, 0.1);
    color: var(--primary-color);
    font-size: 0.875rem;
}

.breadcrumb-link:hover .breadcrumb-icon {
    background: var(--primary-color);
    color: white;
}

.breadcrumb-text {
    font-weight: 500;
}

.breadcrumb-separator {
    color: var(--text-muted);
    font-size: 0.75rem;
    display: flex;
    align-items: center;
}

.breadcrumb-item.active {
    color: var(--text-primary);
    font-weight: 600;
}

.breadcrumb-item.active .breadcrumb-icon {
    background: var(--primary-color);
    color: white;
}

/* Card Styling */
.modern-professional-card {
    background: var(--card-background);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-color);
    overflow: hidden;
    transition: var(--transition);
}

.modern-professional-card:hover {
    box-shadow: var(--shadow-xl);
}

/* Eye-Friendly Header Styling */
.modern-header {
    background: linear-gradient(135deg, var(--header-primary) 0%, var(--header-secondary) 50%, var(--header-accent) 100%);
    color: var(--header-text);
    padding: 2rem;
    border: none;
    position: relative;
    overflow: hidden;
}

.modern-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="softgrain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="0.5" fill="rgba(99,102,241,0.08)"/><circle cx="75" cy="75" r="0.5" fill="rgba(99,102,241,0.08)"/></pattern></defs><rect width="100" height="100" fill="url(%23softgrain)"/></svg>');
    opacity: 1;
}

.header-content {
    display: flex;
    align-items: center;
    gap: 1rem;
    position: relative;
    z-index: 1;
}

.header-icon {
    background: rgba(99, 102, 241, 0.15);
    padding: 1rem;
    border-radius: var(--border-radius-sm);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(99, 102, 241, 0.2);
}

.header-icon i {
    font-size: 1.5rem;
    color: var(--header-text);
}

.header-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    letter-spacing: -0.025em;
    color: var(--header-text);
}

.header-subtitle {
    margin: 0;
    font-size: 0.875rem;
    color: var(--header-text-light);
    font-weight: 400;
}

/* Body Styling */
.modern-body {
    padding: 2.5rem;
    background: var(--card-background);
}

.modern-form-container {
    background: linear-gradient(145deg, #fafbff 0%, #f1f5f9 100%);
    border: 1px solid rgba(99, 102, 241, 0.1);
    border-radius: var(--border-radius);
    padding: 2rem;
    transition: var(--transition);
    position: relative;
}

.modern-form-container:hover {
    box-shadow: var(--shadow-md);
    border-color: rgba(99, 102, 241, 0.2);
}

.modern-form-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, var(--primary-color) 0%, var(--header-accent) 100%);
    border-radius: 2px 0 0 2px;
    opacity: 0;
    transition: var(--transition);
}

.modern-form-container:hover::before {
    opacity: 1;
}

/* Form Groups */
.modern-form-group {
    margin-bottom: 0;
    position: relative;
}

.modern-form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
}

.label-text {
    color: var(--text-primary);
}

.required-indicator {
    color: var(--danger-color);
    font-weight: 700;
}

.optional-indicator {
    color: var(--text-muted);
    font-weight: 400;
    font-size: 0.75rem;
}

/* Form Controls */
.modern-form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    font-size: 0.875rem;
    line-height: 1.5;
    color: var(--text-primary);
    background: white;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.modern-form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    background: white;
}

.modern-form-control::placeholder {
    color: var(--text-muted);
    opacity: 1;
}

.modern-form-control:hover {
    border-color: var(--text-secondary);
}

/* Input Groups */
.modern-input-group {
    display: flex;
    gap: 0;
    position: relative;
}

.modern-form-select.country-select {
    max-width: 130px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-right: none;
    background: #fafbff;
}

.mobile-input {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    flex: 1;
}

/* Password Input */
.password-input-wrapper {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--text-muted);
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: var(--transition);
}

.password-toggle:hover {
    color: var(--text-primary);
    background: rgba(0, 0, 0, 0.05);
}

/* Form Hints */
.form-hint {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin-top: 0.25rem;
    display: block;
}

/* Modern Buttons */
.modern-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    line-height: 1;
    border-radius: var(--border-radius-sm);
    border: 2px solid transparent;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition);
    white-space: nowrap;
    text-align: center;
    justify-content: center;
    min-width: auto;
    position: relative;
    overflow: hidden;
}

.modern-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.modern-btn-primary {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.modern-btn-primary:hover {
    background: var(--primary-hover);
    border-color: var(--primary-hover);
    color: white;
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

.modern-btn-outline-secondary {
    background: white;
    color: var(--secondary-color);
    border-color: var(--border-color);
}

.modern-btn-outline-secondary:hover {
    background: var(--secondary-color);
    color: white;
    border-color: var(--secondary-color);
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

/* Footer Styling */
.modern-footer {
    background: linear-gradient(135deg, #f9fafb 0%, #f1f5f9 100%);
    border-top: 1px solid var(--border-color);
    padding: 1.5rem 2.5rem;
}

.footer-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

/* Modern Select Styling */
.modern-form-select {
    appearance: none;
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-body {
        padding: 1.5rem;
    }

    .modern-form-container {
        padding: 1.5rem;
    }

    .header-content {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }

    .footer-actions {
        flex-direction: column-reverse;
        gap: 1rem;
    }

    .modern-btn {
        width: 100%;
    }

    .modern-input-group {
        flex-direction: column;
        gap: 0.5rem;
    }

    .modern-form-select.country-select {
        max-width: none;
        border-radius: var(--border-radius-sm);
        border-right: 2px solid var(--border-color);
    }

    .mobile-input {
        border-radius: var(--border-radius-sm);
    }

    .modern-breadcrumb {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .breadcrumb-separator {
        display: none;
    }

    .breadcrumb-item {
        width: 100%;
    }

    .breadcrumb-link {
        width: 100%;
        justify-content: flex-start;
    }

    .modern-alert {
        flex-direction: column;
        gap: 0.75rem;
    }

    .alert-close {
        position: static;
        align-self: flex-end;
        margin-top: -0.5rem;
    }
}

/* Loading Animation */
.modern-btn.loading {
    pointer-events: none;
    opacity: 0.7;
}

.modern-btn.loading::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    margin: auto;
    border: 2px solid transparent;
    border-top-color: currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Focus States for Accessibility */
.modern-form-control:focus,
.modern-btn:focus,
.breadcrumb-link:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}
</style>
@endpush

@push('scripts')
<script>
$(function(){
    // Password visibility toggle
    $('.password-toggle').on('click', function() {
        let $input = $(this).siblings('.password-input');
        let $icon = $(this).find('i');

        if ($input.attr('type') === 'password') {
            $input.attr('type', 'text');
            $icon.removeClass('bx-show').addClass('bx-hide');
        } else {
            $input.attr('type', 'password');
            $icon.removeClass('bx-hide').addClass('bx-show');
        }
    });

    // Form submission with loading state
    $('form').on('submit', function() {
        let $submitBtn = $(this).find('button[type="submit"]');
        $submitBtn.addClass('loading');
        $submitBtn.find('span').text('Updating...');
    });

    // Enhanced form validation feedback
    $('.modern-form-control').on('invalid', function() {
        $(this).addClass('is-invalid');
    }).on('input', function() {
        $(this).removeClass('is-invalid');
    });

    // Smooth scroll to form on validation errors
    if ($('.is-invalid').length > 0) {
        $('html, body').animate({
            scrollTop: $('.is-invalid:first').offset().top - 100
        }, 500);
    }

    // Auto-hide alerts after 5 seconds
    $('.modern-alert').each(function() {
        const $alert = $(this);
        setTimeout(() => {
            $alert.fadeOut(300, () => $alert.remove());
        }, 5000);
    });
});
</script>
@endpush
