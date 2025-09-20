@extends('layouts.admin.app')

@section('content')
<main class="page-content professional-bg">
    <div class="container">
        <!-- Breadcrumb -->
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
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-user-plus"></i>
                            </div>
                            <span class="breadcrumb-text">Edit Subadmins</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.company.subadmins.update', $company->id) }}" class="modern-professional-card">
            @csrf
            <div class="card-header modern-header">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bx bx-user-plus"></i>
                    </div>
                    <div class="header-text">
                        <h5 class="header-title">Edit Subadmins</h5>
                        <p class="header-subtitle">Manage company subadmin accounts and permissions</p>
                    </div>
                </div>
            </div>

            <div class="card-body modern-body">
                <div id="subadmins-wrapper" class="subadmins-container">
                    @php
                        $oldSubadmins = old('subadmins', $subadmins ?? []);
                        if (empty($oldSubadmins)) {
                            $oldSubadmins = [[]]; // At least one row
                        }
                    @endphp
                    @foreach($oldSubadmins as $i => $sub)
                    <div class="dynamic-row subadmin-row modern-form-row">
                        <input type="hidden" name="subadmins[{{ $i }}][id]" value="{{ $sub['id'] ?? '' }}">

                        <!-- Row Header with Delete Button -->
                        <div class="form-row-header">
                            <h6 class="subadmin-title">
                                <i class="bx bx-user"></i>
                                Subadmin {{ $i + 1 }}
                            </h6>
                            <button type="button"
                                    class="modern-btn modern-btn-danger-outline remove-subadmin"
                                    data-tooltip="Remove this subadmin">
                                <i class="bx bx-trash"></i>
                                <span class="btn-text">Remove</span>
                            </button>
                        </div>

                        <!-- Basic Information -->
                        <div class="form-section">
                            <h6 class="section-title">
                                <i class="bx bx-user-detail"></i>
                                Basic Information
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="modern-form-group">
                                        <label class="modern-form-label">
                                            <span class="label-text">Username</span>
                                            <span class="required-indicator">*</span>
                                        </label>
                                        <input type="text"
                                               name="subadmins[{{ $i }}][username]"
                                               class="modern-form-control"
                                               value="{{ $sub['username'] ?? '' }}"
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
                                               name="subadmins[{{ $i }}][name]"
                                               class="modern-form-control"
                                               value="{{ $sub['name'] ?? '' }}"
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
                                               name="subadmins[{{ $i }}][designation]"
                                               class="modern-form-control"
                                               value="{{ $sub['designation'] ?? '' }}"
                                               placeholder="Enter designation"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact & Security -->
                        <div class="form-section">
                            <h6 class="section-title">
                                <i class="bx bx-shield-check"></i>
                                Contact & Security
                            </h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="modern-form-group">
                                        <label class="modern-form-label">
                                            <span class="label-text">Mobile Number</span>
                                            <span class="required-indicator">*</span>
                                        </label>
                                        <div class="modern-input-group">
                                            <select name="subadmins[{{ $i }}][country_code]"
                                                    class="modern-form-control modern-form-select country-select"
                                                    required>
                                                @foreach($countryCodes as $code)
                                                    <option value="{{ $code->dial_code }}"
                                                        {{ ($sub['country_code'] ?? '+91') == $code->dial_code ? 'selected' : '' }}>
                                                        {{ $code->dial_code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="text"
                                                   name="subadmins[{{ $i }}][mobile]"
                                                   class="modern-form-control"
                                                   value="{{ $sub['mobile'] ?? '' }}"
                                                   placeholder="Enter mobile number"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="modern-form-group">
                                        <label class="modern-form-label">
                                            <span class="label-text">Password</span>
                                            @if(!isset($sub['id']))
                                                <span class="required-indicator">*</span>
                                            @endif
                                        </label>
                                        <div class="password-input-wrapper">
                                            <input type="password"
                                                   name="subadmins[{{ $i }}][password]"
                                                   class="modern-form-control"
                                                   placeholder="Enter password"
                                                   {{ isset($sub['id']) ? '' : 'required' }}
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
                                               name="subadmins[{{ $i }}][email]"
                                               class="modern-form-control"
                                               value="{{ $sub['email'] ?? '' }}"
                                               placeholder="email@company.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="add-subadmin-section">
                    <button type="button" class="modern-btn modern-btn-outline-primary" id="add-subadmin">
                        <i class="bx bx-plus"></i>
                        <span>Add Another Subadmin</span>
                    </button>
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
                        <span>Update Subadmins</span>
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

    /* Eye-Friendly Header Colors */
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

.subadmins-container {
    display: flex;
    flex-direction: column;
    gap: 2.5rem;
}

/* Enhanced Form Row with Better Structure */
.modern-form-row {
    background: linear-gradient(145deg, #fafbff 0%, #f1f5f9 100%);
    border: 1px solid rgba(99, 102, 241, 0.1);
    border-radius: var(--border-radius);
    padding: 2rem;
    transition: var(--transition);
    position: relative;
}

.modern-form-row:hover {
    box-shadow: var(--shadow-md);
    border-color: rgba(99, 102, 241, 0.2);
}

.modern-form-row::before {
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

.modern-form-row:hover::before {
    opacity: 1;
}

/* Form Row Header with Enhanced Delete Button */
.form-row-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px dashed rgba(99, 102, 241, 0.2);
}

.subadmin-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary);
}

.subadmin-title i {
    color: var(--primary-color);
    font-size: 1.2rem;
}

/* Form Sections */
.form-section {
    margin-bottom: 1.5rem;
}

.form-section:last-child {
    margin-bottom: 0;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.section-title i {
    color: var(--primary-color);
    font-size: 1rem;
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

/* Optimized Input Groups */
.modern-input-group {
    display: flex;
    gap: 0;
    position: relative;
}

.modern-form-select.country-select {
    min-width: 85px;
    max-width: 95px;
    width: 85px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-right: none;
    background: #fafbff;
    flex-shrink: 0;
}

.mobile-input {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    flex: 1;
    min-width: 0;
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

.modern-btn-outline-primary {
    background: white;
    color: var(--primary-color);
    border-color: var(--primary-color);
}

.modern-btn-outline-primary:hover {
    background: var(--primary-color);
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

/* Enhanced Delete Button */
.modern-btn-danger-outline {
    background: white;
    color: var(--danger-color);
    border-color: var(--danger-color);
    padding: 0.5rem 1rem;
    font-size: 0.8rem;
}

.modern-btn-danger-outline:hover {
    background: var(--danger-color);
    border-color: var(--danger-color);
    color: white;
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

.modern-btn-danger-outline .btn-text {
    display: none;
}

/* Add Subadmin Section */
.add-subadmin-section {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 2px dashed var(--border-color);
    text-align: center;
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

/* Tooltip */
[data-tooltip] {
    position: relative;
}

[data-tooltip]:hover::after {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 120%;
    left: 50%;
    transform: translateX(-50%);
    background: var(--text-primary);
    color: white;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    font-size: 0.75rem;
    white-space: nowrap;
    z-index: 1000;
    opacity: 1;
    animation: tooltipFade 0.2s ease-in;
}

@keyframes tooltipFade {
    from { opacity: 0; transform: translateX(-50%) translateY(4px); }
    to { opacity: 1; transform: translateX(-50%) translateY(0); }
}

/* Modern Select Styling */
.modern-form-select {
    appearance: none;
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1em 1em;
    padding-right: 2rem;
}

/* Responsive Design */
@media (max-width: 992px) {
    .modern-btn-danger-outline .btn-text {
        display: inline;
    }

    .form-row-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
}

@media (max-width: 768px) {
    .modern-body {
        padding: 1.5rem;
    }

    .modern-form-row {
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
        flex-direction: row;
        gap: 0;
    }

    .modern-form-select.country-select {
        min-width: 75px;
        max-width: 85px;
        width: 75px;
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
    let subadminIndex = {{ count($oldSubadmins) }};

    $('#add-subadmin').on('click', function() {
        let html = `
        <div class="dynamic-row subadmin-row modern-form-row">
            <input type="hidden" name="subadmins[${subadminIndex}][id]" value="">
            <div class="form-row-header">
                <h6 class="subadmin-title">
                    <i class="bx bx-user"></i>
                    Subadmin ${subadminIndex + 1}
                </h6>
                <button type="button"
                        class="modern-btn modern-btn-danger-outline remove-subadmin"
                        data-tooltip="Remove this subadmin">
                    <i class="bx bx-trash"></i>
                    <span class="btn-text">Remove</span>
                </button>
            </div>
            <div class="form-section">
                <h6 class="section-title">
                    <i class="bx bx-user-detail"></i>
                    Basic Information
                </h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="modern-form-group">
                            <label class="modern-form-label">
                                <span class="label-text">Username</span>
                                <span class="required-indicator">*</span>
                            </label>
                            <input type="text" name="subadmins[${subadminIndex}][username]" class="modern-form-control" placeholder="Enter username" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="modern-form-group">
                            <label class="modern-form-label">
                                <span class="label-text">Full Name</span>
                                <span class="required-indicator">*</span>
                            </label>
                            <input type="text" name="subadmins[${subadminIndex}][name]" class="modern-form-control" placeholder="Enter full name" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="modern-form-group">
                            <label class="modern-form-label">
                                <span class="label-text">Designation</span>
                                <span class="required-indicator">*</span>
                            </label>
                            <input type="text" name="subadmins[${subadminIndex}][designation]" class="modern-form-control" placeholder="Enter designation" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <h6 class="section-title">
                    <i class="bx bx-shield-check"></i>
                    Contact & Security
                </h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="modern-form-group">
                            <label class="modern-form-label">
                                <span class="label-text">Mobile Number</span>
                                <span class="required-indicator">*</span>
                            </label>
                            <div class="modern-input-group">
                                <select name="subadmins[${subadminIndex}][country_code]" class="modern-form-control modern-form-select country-select" required>
                                    @foreach($countryCodes as $code)
                                        <option value="{{ $code->dial_code }}"
                                            {{ ($code->country_code == 'IN' || $code->dial_code == '+91') ? 'selected' : '' }}>
                                            {{ $code->dial_code }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="text" name="subadmins[${subadminIndex}][mobile]" class="modern-form-control" placeholder="Enter mobile number" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="modern-form-group">
                            <label class="modern-form-label">
                                <span class="label-text">Password</span>
                                <span class="required-indicator">*</span>
                            </label>
                            <input type="password" name="subadmins[${subadminIndex}][password]" class="modern-form-control" placeholder="Enter password" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="modern-form-group">
                            <label class="modern-form-label">
                                <span class="label-text">Email</span>
                                <span class="optional-indicator">(Optional)</span>
                            </label>
                            <input type="email" name="subadmins[${subadminIndex}][email]" class="modern-form-control" placeholder="email@company.com">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        $('#subadmins-wrapper').append(html);
        subadminIndex++;
        updateRemoveButtons();
        updateSubadminTitles();
    });

    $(document).on('click', '.remove-subadmin', function() {
        const subadminTitle = $(this).closest('.subadmin-row').find('.subadmin-title').text().trim();
        if (confirm(`Are you sure you want to remove "${subadminTitle}"?\n\nThis action cannot be undone and will permanently delete the subadmin account.`)) {
            $(this).closest('.subadmin-row').slideUp(300, function() {
                $(this).remove();
                updateRemoveButtons();
                updateSubadminTitles();
            });
        }
    });

    function updateRemoveButtons() {
        let rows = $('#subadmins-wrapper .subadmin-row');
        if (rows.length > 1) {
            rows.find('.remove-subadmin').removeClass('d-none').show();
        } else {
            rows.find('.remove-subadmin').addClass('d-none').hide();
        }
    }

    function updateSubadminTitles() {
        $('#subadmins-wrapper .subadmin-row').each(function(index) {
            $(this).find('.subadmin-title').html(`
                <i class="bx bx-user"></i>
                Subadmin ${index + 1}
            `);
        });
    }
});
</script>
@endpush
