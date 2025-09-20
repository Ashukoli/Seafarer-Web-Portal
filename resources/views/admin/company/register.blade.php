@extends('layouts.admin.app')

@push('styles')
<style>
/* Modern Professional Styling */
:root {
    --primary-color: #3b82f6;
    --primary-dark: #1e40af;
    --secondary-color: #64748b;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --light-bg: #f8fafc;
    --white: #ffffff;
    --border-color: #e2e8f0;
    --text-primary: #1e293b;
    --text-secondary: #64748b;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
}

.professional-bg {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

/* Enhanced Breadcrumb */
.enhanced-breadcrumb {
    background: var(--white);
    padding: 1rem 1.5rem;
    border-radius: 12px;
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-sm);
    margin-bottom: 2rem;
}

.breadcrumb-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.breadcrumb-link:hover {
    color: var(--primary-dark);
    transform: translateX(2px);
}

.breadcrumb-title {
    font-weight: 600;
    color: var(--text-primary);
    font-size: 1.125rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.breadcrumb-item.active {
    color: var(--text-secondary);
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

/* Modern Stepper */
.stepper-container {
    background: var(--white);
    padding: 1.5rem;
    border-radius: 16px;
    box-shadow: var(--shadow-md);
    margin-bottom: 2rem;
    overflow-x: auto;
}

.stepper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    min-width: 800px;
}

.stepper::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--border-color);
    z-index: 1;
}

.step {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    z-index: 2;
    background: var(--white);
    padding: 0 1rem;
    min-width: 120px;
    text-align: center;
}

.step-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    border: 3px solid var(--border-color);
    background: var(--white);
    color: var(--text-secondary);
}

.step.active .step-circle {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: var(--white);
    transform: scale(1.1);
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
}

.step.completed .step-circle {
    background: var(--success-color);
    border-color: var(--success-color);
    color: var(--white);
}

.step-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text-secondary);
    transition: color 0.3s ease;
}

.step.active .step-label {
    color: var(--primary-color);
    font-weight: 600;
}

/* Professional Card */
.professional-card {
    background: var(--white);
    border-radius: 16px;
    box-shadow: var(--shadow-lg);
    border: none;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.professional-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
}

.professional-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: var(--white);
    padding: 1.5rem;
    border-bottom: none;
}

.header-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Enhanced Form Controls */
.form-label {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.form-control, .form-select {
    border: 2px solid var(--border-color);
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    background: var(--white);
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    outline: none;
}

.form-control:hover, .form-select:hover {
    border-color: var(--secondary-color);
}

/* Modern Buttons */
.btn {
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.025em;
    transition: all 0.3s ease;
    border: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: var(--white);
    box-shadow: var(--shadow-md);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    background: linear-gradient(135deg, var(--primary-dark) 0%, #1e3a8a 100%);
}

.btn-success {
    background: linear-gradient(135deg, var(--success-color) 0%, #059669 100%);
    color: var(--white);
    box-shadow: var(--shadow-md);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
}

.btn-warning {
    background: linear-gradient(135deg, var(--warning-color) 0%, #d97706 100%);
    color: var(--white);
    box-shadow: var(--shadow-md);
}

.btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
}

.btn-outline-secondary {
    background: transparent;
    border: 2px solid var(--border-color);
    color: var(--text-secondary);
}

.btn-outline-secondary:hover {
    background: var(--secondary-color);
    border-color: var(--secondary-color);
    color: var(--white);
    transform: translateY(-2px);
}

.btn-danger {
    background: linear-gradient(135deg, var(--danger-color) 0%, #dc2626 100%);
    color: var(--white);
}

.btn-outline-primary {
    background: transparent;
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
}

.btn-outline-primary:hover {
    background: var(--primary-color);
    color: var(--white);
    transform: translateY(-2px);
}

/* File Upload Styling */
.form-control[type="file"] {
    padding: 0.5rem;
    border: 2px dashed var(--border-color);
    background: var(--light-bg);
    transition: all 0.3s ease;
}

.form-control[type="file"]:hover {
    border-color: var(--primary-color);
    background: rgba(59, 130, 246, 0.05);
}

/* Multiselect Dropdown */
.multiselect-checkbox {
    position: relative;
}

.rankDropdownBtn {
    background: var(--white);
    border: 2px solid var(--border-color);
    color: var(--text-primary);
    text-align: left;
    cursor: pointer;
}

.rankDropdownBtn:hover {
    border-color: var(--primary-color);
}

.rankDropdownMenu {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: var(--white);
    border: 2px solid var(--border-color);
    border-radius: 8px;
    box-shadow: var(--shadow-lg);
    z-index: 1000;
    max-height: 220px;
    overflow-y: auto;
    display: none;
}

.rankDropdownMenu.show {
    display: block;
}

.dropdown-item {
    padding: 0.75rem 1rem;
    margin: 0;
    border: none;
    background: none;
    cursor: pointer;
    transition: background-color 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.dropdown-item:hover {
    background: var(--light-bg);
}

/* Dynamic Rows */
.dynamic-row {
    background: var(--light-bg);
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
    border: 1px solid var(--border-color);
}

/* Summary Section */
.summary-section {
    background: var(--light-bg);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid var(--border-color);
}

.summary-section h5 {
    color: var(--primary-color);
    font-weight: 700;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--border-color);
}

.summary-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.summary-section li {
    padding: 0.5rem 0;
    border-bottom: 1px solid rgba(226, 232, 240, 0.5);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.summary-section li:last-child {
    border-bottom: none;
}

.summary-section strong {
    color: var(--text-primary);
    font-weight: 600;
    min-width: 150px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stepper {
        flex-direction: column;
        gap: 1rem;
    }

    .stepper::before {
        display: none;
    }

    .step {
        width: 100%;
        flex-direction: row;
        justify-content: flex-start;
        padding: 1rem;
        background: var(--light-bg);
        border-radius: 8px;
    }

    .professional-bg {
        padding: 1rem 0;
    }
}

/* Loading Animation */
.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.btn.loading {
    position: relative;
    color: transparent;
}

.btn.loading::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    top: 50%;
    left: 50%;
    margin-left: -8px;
    margin-top: -8px;
    border: 2px solid transparent;
    border-top-color: currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Alert Messages */
.alert {
    border-radius: 8px;
    padding: 1rem 1.5rem;
    margin-bottom: 1rem;
    border: none;
    font-weight: 500;
}

.alert-success {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success-color);
    border-left: 4px solid var(--success-color);
}

.alert-danger {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger-color);
    border-left: 4px solid var,--danger-color);
}

.alert-warning {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning-color);
    border-left: 4px solid var(--warning-color);
}
</style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('content')
<main class="page-content professional-bg">
    <!-- Enhanced Breadcrumb -->
    <div class="container">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
            <div class="breadcrumb-title pe-3">
                <i class="bx bx-building me-2"></i>Admin
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0 enhanced-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('candidate.dashboard') }}" class="breadcrumb-link">
                                <i class="bx bx-home-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" class="breadcrumb-link">
                                <i class="bx bx-building"></i>Companies
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="bx bx-plus-circle"></i>
                            @if($step == 1) Company Details
                            @elseif($step == 2) Package Selection
                            @elseif($step == 3) Superadmin Setup
                            @elseif($step == 4) Subadmin Management
                            @elseif($step == 5) Banner Configuration
                            @elseif($step == 6) Advertisement Setup
                            @elseif($step == 7) Review & Confirm
                            @endif
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Modern Stepper -->
        <div class="stepper-container">
            <div class="stepper">
                <div class="step {{ $step >= 1 ? ($step == 1 ? 'active' : 'completed') : '' }}">
                    <div class="step-circle">
                        @if($step > 1)<i class="bx bx-check"></i>@else 1 @endif
                    </div>
                    <div class="step-label">Company Details</div>
                </div>
                <div class="step {{ $step >= 2 ? ($step == 2 ? 'active' : 'completed') : '' }}">
                    <div class="step-circle">
                        @if($step > 2)<i class="bx bx-check"></i>@else 2 @endif
                    </div>
                    <div class="step-label">Package Selection</div>
                </div>
                <div class="step {{ $step >= 3 ? ($step == 3 ? 'active' : 'completed') : '' }}">
                    <div class="step-circle">
                        @if($step > 3)<i class="bx bx-check"></i>@else 3 @endif
                    </div>
                    <div class="step-label">Superadmin Setup</div>
                </div>
                <div class="step {{ $step >= 4 ? ($step == 4 ? 'active' : 'completed') : '' }}">
                    <div class="step-circle">
                        @if($step > 4)<i class="bx bx-check"></i>@else 4 @endif
                    </div>
                    <div class="step-label">Subadmin Management</div>
                </div>
                <div class="step {{ $step >= 5 ? ($step == 5 ? 'active' : 'completed') : '' }}">
                    <div class="step-circle">
                        @if($step > 5)<i class="bx bx-check"></i>@else 5 @endif
                    </div>
                    <div class="step-label">Banner Configuration</div>
                </div>
                <div class="step {{ $step >= 6 ? ($step == 6 ? 'active' : 'completed') : '' }}">
                    <div class="step-circle">
                        @if($step > 6)<i class="bx bx-check"></i>@else 6 @endif
                    </div>
                    <div class="step-label">Advertisement Setup</div>
                </div>
                <div class="step {{ $step >= 7 ? 'active' : '' }}">
                    <div class="step-circle">7</div>
                    <div class="step-label">Review & Confirm</div>
                </div>
            </div>
        </div>

        {{-- Place this block at the top of your content section, before any form --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Step 1: Company Details -->
        @if($step == 1)
        <form method="POST" action="{{ route('admin.company.register.handle', $step) }}" enctype="multipart/form-data" class="professional-card">
            @csrf
            <div class="card-header professional-header">
                <h5 class="header-title">
                    <i class="bx bx-buildings"></i>Company Information
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Company Name <span class="text-danger">*</span></label>
                        <input type="text" name="company_name" class="form-control" placeholder="Enter company name" required
                            value="{{ old('company_name', $company['company_name'] ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Company Email <span class="text-danger">*</span></label>
                        <input type="email" name="company_email" class="form-control" placeholder="company@example.com" required
                            value="{{ old('company_email', $company['company_email'] ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                        <input type="text" name="company_contact_no" class="form-control" placeholder="Enter contact number" required
                            value="{{ old('company_contact_no', $company['company_contact_no'] ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Website URL</label>
                        <input type="url" name="website" class="form-control" placeholder="https://www.example.com"
                            value="{{ old('website', $company['website'] ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">RPSL Number</label>
                        <input type="text" name="rpsl_number" class="form-control" placeholder="Enter RPSL number"
                            value="{{ old('rpsl_number', $company['rpsl_number'] ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">RPSL Expiry Date</label>
                        <input type="text" name="rpsl_expiry" class="form-control datepicker" placeholder="Select expiry date" autocomplete="off"
                            value="{{ old('rpsl_expiry', $company['rpsl_expiry'] ?? '') }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Area/Location</label>
                        <textarea name="area" class="form-control" rows="2" placeholder="Enter area or location details">{{ old('area', $company['area'] ?? '') }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Full Address</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Enter complete address">{{ old('address', $company['address'] ?? '') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Company Type</label>
                        <select name="company_type" class="form-select">
                            <option value="">Select Company Type</option>
                            <option value="shipowner" {{ old('company_type', $company['company_type'] ?? '') == 'shipowner' ? 'selected' : '' }}>Shipowner / Ship Operator</option>
                            <option value="crewing" {{ old('company_type', $company['company_type'] ?? '') == 'crewing' ? 'selected' : '' }}>Crewing Company</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Account Type</label>
                        <select name="account_type" class="form-select">
                            <option value="">Select Account Type</option>
                            <option value="advertisement" {{ old('account_type', $company['account_type'] ?? '') == 'advertisement' ? 'selected' : '' }}>Advertisement</option>
                            <option value="database" {{ old('account_type', $company['account_type'] ?? '') == 'database' ? 'selected' : '' }}>Database</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tie-up Company</label>
                        <select name="tie_up_company" class="form-select">
                            <option value="0" {{ old('tie_up_company', $company['tie_up_company'] ?? '0') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('tie_up_company', $company['tie_up_company'] ?? '0') == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Listed in Banner</label>
                        <select name="listed_in_banner" class="form-select">
                            <option value="0" {{ old('listed_in_banner', $company['listed_in_banner'] ?? '0') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('listed_in_banner', $company['listed_in_banner'] ?? '0') == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Company Logo</label>
                        <input type="file" name="company_logo" class="form-control" accept="image/*">
                        <small class="text-muted mt-2 d-block">Upload logo (JPG/PNG, max 2MB)</small>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Directors Information</label>
                        <textarea name="directors" class="form-control" rows="3" placeholder="Enter directors information">{{ old('directors', $company['directors'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end p-4">
                <button type="submit" class="btn btn-primary">
                    Continue <i class="bx bx-right-arrow-alt"></i>
                </button>
            </div>
        </form>
        @endif

        <!-- Step 2: Package Selection -->
        @if($step == 2)
            <form method="POST" action="{{ route('admin.company.register.handle', $step) }}" class="professional-card">
                @csrf
                <div class="card-header professional-header">
                    <h5 class="header-title">
                        <i class="bx bx-package"></i>Package Selection
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label">Resume View Package</label>
                            <select name="resume_view_package_id" class="form-select">
                                <option value="">Select Package</option>
                                @foreach($packages as $pkg)
                                    <option value="{{ $pkg->id }}" {{ old('resume_view_package_id', $package['resume_view_package_id'] ?? '') == $pkg->id ? 'selected' : '' }}>
                                        {{ $pkg->package_count }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Resume Download Package</label>
                            <select name="resume_download_package_id" class="form-select">
                                <option value="">Select Package</option>
                                @foreach($packages as $pkg)
                                    <option value="{{ $pkg->id }}" {{ old('resume_download_package_id', $package['resume_download_package_id'] ?? '') == $pkg->id ? 'selected' : '' }}>
                                        {{ $pkg->package_count }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Hotjobs Package</label>
                            <select name="hotjobs_package_id" class="form-select">
                                <option value="">Select Package</option>
                                @foreach($packages as $pkg)
                                    <option value="{{ $pkg->id }}" {{ old('hotjobs_package_id', $package['hotjobs_package_id'] ?? '') == $pkg->id ? 'selected' : '' }}>
                                        {{ $pkg->package_count }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Package Expiry Date</label>
                            <input type="text" name="package_expiry" class="form-control datepicker" placeholder="Select expiry date"
                                value="{{ old('package_expiry', $package['package_expiry'] ?? '') }}">
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between p-4">
                    <a href="{{ route('admin.company.register.step', 1) }}" class="btn btn-outline-secondary">
                        <i class="bx bx-left-arrow-alt"></i> Back
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Continue <i class="bx bx-right-arrow-alt"></i>
                    </button>
                </div>
            </form>
        @endif

        <!-- Step 3: Superadmin Details -->
        @if($step == 3)
        <form method="POST" action="{{ route('admin.company.register.handle', $step) }}" class="professional-card">
            @csrf
            <div class="card-header professional-header">
                <h5 class="header-title">
                    <i class="bx bx-user-circle"></i>Superadmin Configuration
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" name="superadmin_username" class="form-control"
                            value="{{ old('superadmin_username', $superadmin['superadmin_username'] ?? '') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="superadmin_name" class="form-control"
                            value="{{ old('superadmin_name', $superadmin['superadmin_name'] ?? '') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Designation <span class="text-danger">*</span></label>
                        <input type="text" name="superadmin_designation" class="form-control"
                            value="{{ old('superadmin_designation', $superadmin['superadmin_designation'] ?? '') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select name="superadmin_country_code" class="form-select" required>
                                @foreach($countryCodes as $code)
                                    <option value="{{ $code->dial_code }}"

                                        {{ old('superadmin_country_code', $superadmin['superadmin_country_code'] ?? '') == $code->dial_code ? 'selected' : '' }}>
                                        {{ $code->dial_code }} ({{ $code->country_code }})
                                    </option>
                                @endforeach
                            </select>
                            <input type="text" name="superadmin_mobile" class="form-control"
                                value="{{ old('superadmin_mobile', $superadmin['superadmin_mobile'] ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="superadmin_password" class="form-control" required autocomplete="new-password">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email</label>
                        <input type="email" name="superadmin_email" class="form-control"
                            value="{{ old('superadmin_email', $superadmin['superadmin_email'] ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between p-4">
                <a href="{{ route('admin.company.register.step', 2) }}" class="btn btn-outline-secondary">
                    <i class="bx bx-left-arrow-alt"></i> Back
                </a>
                <div>
                    <a href="{{ route('admin.company.register.step', 4) }}" class="btn btn-warning me-2">
                        Skip <i class="bx bx-fast-forward"></i>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Continue <i class="bx bx-right-arrow-alt"></i>
                    </button>
                </div>
            </div>
        </form>
        @endif

        <!-- Step 4: Subadmins Details -->
        @if($step == 4)
        <form method="POST" action="{{ route('admin.company.register.handle', $step) }}" class="professional-card">
            @csrf
            <div class="card-header professional-header">
                <h5 class="header-title">
                    <i class="bx bx-user-plus"></i>Subadmin Management
                </h5>
            </div>
            <div class="card-body p-4">
                <div id="subadmins-wrapper">
                    @php
                        $oldSubadmins = old('subadmins', $subadmins ?? []);
                        if (empty($oldSubadmins)) {
                            $oldSubadmins = [[]]; // At least one row
                        }
                    @endphp
                    @foreach($oldSubadmins as $i => $sub)
                    <div class="dynamic-row subadmin-row">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label">Username <span class="text-danger">*</span></label>
                                <input type="text" name="subadmins[{{ $i }}][username]" class="form-control"
                                    value="{{ $sub['username'] ?? '' }}" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="subadmins[{{ $i }}][name]" class="form-control"
                                    value="{{ $sub['name'] ?? '' }}" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Designation <span class="text-danger">*</span></label>
                                <input type="text" name="subadmins[{{ $i }}][designation]" class="form-control"
                                    value="{{ $sub['designation'] ?? '' }}" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select name="subadmins[{{ $i }}][country_code]" class="form-select" required>
                                        @foreach($countryCodes as $code)
                                            <option value="{{ $code->dial_code }}"

                                                {{ ($sub['country_code'] ?? '+91') == $code->dial_code ? 'selected' : '' }}>
                                                {{ $code->dial_code }} ({{ $code->country_code }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="subadmins[{{ $i }}][mobile]" class="form-control"
                                        value="{{ $sub['mobile'] ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" name="subadmins[{{ $i }}][password]" class="form-control" required autocomplete="new-password">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Email</label>
                                <input type="email" name="subadmins[{{ $i }}][email]" class="form-control"
                                    value="{{ $sub['email'] ?? '' }}">
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger remove-subadmin {{ $loop->first && count($oldSubadmins) == 1 ? 'd-none' : '' }}">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-outline-primary mt-3" id="add-subadmin">
                    <i class="bx bx-plus"></i> Add Another Subadmin
                </button>
            </div>
            <div class="card-footer d-flex justify-content-between p-4">
                <a href="{{ route('admin.company.register.step', 3) }}" class="btn btn-outline-secondary">
                    <i class="bx bx-left-arrow-alt"></i> Back
                </a>
                <div>
                    <a href="{{ route('admin.company.register.step', 5) }}" class="btn btn-warning me-2">
                        Skip <i class="bx bx-fast-forward"></i>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Continue <i class="bx bx-right-arrow-alt"></i>
                    </button>
                </div>
            </div>
        </form>
        @endif

        <!-- Step 5: Banner Details -->
        @if($step == 5)
        <form method="POST" action="{{ route('admin.company.register.handle', $step) }}" enctype="multipart/form-data" class="professional-card">
            @csrf
            <div class="card-header professional-header">
                <h5 class="header-title">
                    <i class="bx bx-image-alt"></i>Banner Configuration
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Banner Image <span class="text-danger">*</span></label>
                        <input type="file" name="banner_image" class="form-control" accept="image/*" {{ !empty($banner['banner_image']) ? '' : 'required' }}>
                        <small class="text-muted mt-2 d-block">Recommended size: 1200x400px, max 2MB (JPG/PNG)</small>
                        @if(!empty($banner['banner_image']))
                            <div class="mt-2">
                                <strong>Current:</strong> {{ $banner['banner_image'] }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Banner Section <span class="text-danger">*</span></label>
                        <select name="banner_section" class="form-select" required>
                            <option value="">Select Section</option>
                            <option value="featured" {{ old('banner_section', $banner['banner_section'] ?? '') == 'featured' ? 'selected' : '' }}>Featured</option>
                            <option value="toplisted" {{ old('banner_section', $banner['banner_section'] ?? '') == 'toplisted' ? 'selected' : '' }}>Top Listed</option>
                            <option value="listed" {{ old('banner_section', $banner['banner_section'] ?? '') == 'listed' ? 'selected' : '' }}>Listed</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Display Order <span class="text-danger">*</span></label>
                        <input type="number" name="banner_order" class="form-control" min="1" placeholder="1" required
                            value="{{ old('banner_order', $banner['banner_order'] ?? '') }}">
                        <small class="text-muted mt-2 d-block">Lower number = higher priority</small>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Banner Status <span class="text-danger">*</span></label>
                        <select name="banner_status" class="form-select" required>
                            <option value="enabled" {{ old('banner_status', $banner['banner_status'] ?? '') == 'enabled' ? 'selected' : '' }}>Enabled</option>
                            <option value="disabled" {{ old('banner_status', $banner['banner_status'] ?? '') == 'disabled' ? 'selected' : '' }}>Disabled</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between p-4">
                <a href="{{ route('admin.company.register.step', 4) }}" class="btn btn-outline-secondary">
                    <i class="bx bx-left-arrow-alt"></i> Back
                </a>
                <div>
                    <a href="{{ route('admin.company.register.step', 6) }}" class="btn btn-warning me-2">
                        Skip <i class="bx bx-fast-forward"></i>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Continue <i class="bx bx-right-arrow-alt"></i>
                    </button>
                </div>
            </div>
        </form>
        @endif

        <!-- Step 6: Advertisement Details -->
        @if($step == 6)
        <form method="POST" action="{{ route('admin.company.register.handle', $step) }}" class="professional-card">
            @csrf
            <div class="card-header professional-header">
                <h5 class="header-title">
                    <i class="bx bx-bullhorn"></i>Advertisement Setup
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label">Advertisement Subject <span class="text-danger">*</span></label>
                        <input type="text" name="advertisement_subject" class="form-control" placeholder="Enter advertisement title" required
                            value="{{ old('advertisement_subject', $advertisement['advertisement_subject'] ?? '') }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Advertisement Description <span class="text-danger">*</span></label>
                        <textarea id="advertisement_description" name="advertisement_description" class="form-control" rows="6" placeholder="Enter detailed advertisement description" required>{{ old('advertisement_description', $advertisement['advertisement_description'] ?? '') }}</textarea>
                        <small class="text-muted mt-2 d-block">You can use rich text formatting, links, and lists.</small>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Ship Types & Ranks <span class="text-danger">*</span></label>
                        <div id="shiptype-rank-wrapper">
                            @php
                                $oldShiptypes = old('advertisement_shiptypes', $advertisement['advertisement_shiptypes'] ?? [[]]);
                                if (empty($oldShiptypes)) $oldShiptypes = [[]];
                            @endphp
                            @foreach($oldShiptypes as $idx => $shiptype)
                            <div class="dynamic-row shiptype-rank-row">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Ship Type</label>
                                        <select name="advertisement_shiptypes[{{ $idx }}][shiptype]" class="form-select" required>
                                            <option value="">Select Ship Type</option>
                                            @foreach($shipTypes as $type)
                                                <option value="{{ $type->id }}" {{ (old('advertisement_shiptypes.'.$idx.'.shiptype', $shiptype['shiptype'] ?? '') == $type->id) ? 'selected' : '' }}>{{ $type->ship_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Required Ranks</label>
                                        <div class="multiselect-checkbox position-relative">
                                            <button type="button" class="form-control text-start rankDropdownBtn">
                                                @php
                                                    $selectedRanks = old('advertisement_shiptypes.'.$idx.'.ranks', $shiptype['ranks'] ?? []);
                                                    $selectedRanksText = collect($ranks)->whereIn('id', (array)$selectedRanks)->pluck('rank')->implode(', ');
                                                @endphp
                                                {{ $selectedRanksText ?: 'Select Ranks' }}
                                            </button>
                                            <div class="dropdown-menu w-100 rankDropdownMenu">
                                                @foreach($ranks as $rank)
                                                <label class="dropdown-item">
                                                    <input type="checkbox" name="advertisement_shiptypes[{{ $idx }}][ranks][]" value="{{ $rank->id }}"
                                                        {{ in_array($rank->id, (array)$selectedRanks) ? 'checked' : '' }}>
                                                    {{ $rank->rank }}
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-outline-primary mt-3" id="add-shiptype-rank">
                            <i class="bx bx-plus"></i> Add More Ship Types
                        </button>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Advertisement Posted Date <span class="text-danger">*</span></label>
                        <input type="text" name="advertisement_posted_date" class="form-control datepicker" placeholder="Select posted date" autocomplete="off" required
                            value="{{ old('advertisement_posted_date', $advertisement['advertisement_posted_date'] ?? '') }}">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between p-4">
                <a href="{{ route('admin.company.register.step', 5) }}" class="btn btn-outline-secondary">
                    <i class="bx bx-left-arrow-alt"></i> Back
                </a>
                <div>
                    <a href="{{ route('admin.company.register.step', 7) }}" class="btn btn-warning me-2">
                        Skip <i class="bx bx-fast-forward"></i>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Continue <i class="bx bx-right-arrow-alt"></i>
                    </button>
                </div>
            </div>
        </form>
        @endif

        <!-- Step 7: Review & Confirm -->
        @if($step == 7)
        <form method="POST" action="{{ route('admin.company.register.handle', $step) }}" class="professional-card">
            @csrf
            <div class="card-header professional-header">
                <h5 class="header-title">
                    <i class="bx bx-list-check"></i>Review & Confirm Registration
                </h5>
            </div>
            <div class="card-body p-4">
                <!-- Company Details Summary -->
                <div class="summary-section">
                    <h5><i class="bx bx-buildings me-2"></i>Company Information</h5>
                    <ul>
                        <li><strong>Company Name:</strong> <span>{{ $company['company_name'] ?? 'Not provided' }}</span></li>
                        <li><strong>Email:</strong> <span>{{ $company['company_email'] ?? 'Not provided' }}</span></li>
                        <li><strong>Contact Number:</strong> <span>{{ $company['company_contact_no'] ?? 'Not provided' }}</span></li>
                        <li><strong>Website:</strong> <span>{{ $company['website'] ?? 'Not provided' }}</span></li>
                        <li><strong>RPSL Number:</strong> <span>{{ $company['rpsl_number'] ?? 'Not provided' }}</span></li>
                        <li><strong>RPSL Expiry:</strong> <span>{{ $company['rpsl_expiry'] ?? 'Not provided' }}</span></li>
                        <li><strong>Company Type:</strong> <span>{{ ucfirst($company['company_type'] ?? 'Not specified') }}</span></li>
                        <li><strong>Account Type:</strong> <span>{{ ucfirst($company['account_type'] ?? 'Not specified') }}</span></li>
                        <li><strong>Tie-up Company:</strong> <span>{{ !empty($company['tie_up_company']) ? 'Yes' : 'No' }}</span></li>
                        <li><strong>Listed in Banner:</strong> <span>{{ !empty($company['listed_in_banner']) ? 'Yes' : 'No' }}</span></li>
                    </ul>
                </div>

                <!-- Package Summary -->
                <div class="summary-section">
                    <h5><i class="bx bx-package me-2"></i>Package Configuration</h5>
                    <ul>
                        <li><strong>Resume Views Per Day:</strong> <span>{{ $package['resumes_view_per_day'] ?? 'Not selected' }}</span></li>
                        <li><strong>Resume Downloads Per Day:</strong> <span>{{ $package['resumes_download_per_day'] ?? 'Not selected' }}</span></li>
                        <li><strong>Hot Jobs Per Day:</strong> <span>{{ $package['hotjobs_per_day'] ?? 'Not selected' }}</span></li>
                    </ul>
                </div>

                <!-- Superadmin Summary -->
                @if(!empty($superadmin['superadmin_name']))
                <div class="summary-section">
                    <h5><i class="bx bx-user-circle me-2"></i>Superadmin Details</h5>
                    <ul>
                        <li><strong>Name:</strong> <span>{{ $superadmin['superadmin_name'] ?? 'Not provided' }}</span></li>
                        <li><strong>Email:</strong> <span>{{ $superadmin['superadmin_email'] ?? 'Not provided' }}</span></li>
                        <li><strong>Designation:</strong> <span>{{ $superadmin['superadmin_designation'] ?? 'Not provided' }}</span></li>
                        <li><strong>Mobile:</strong> <span>{{ ($superadmin['superadmin_country_code'] ?? '') . ' ' . ($superadmin['superadmin_mobile'] ?? '') }}</span></li>
                    </ul>
                </div>
                @endif

                <!-- Subadmins Summary -->
                @if(!empty($subadmins))
                <div class="summary-section">
                    <h5><i class="bx bx-user-plus me-2"></i>Subadmin Management</h5>
                    <ul>
                        @foreach($subadmins as $index => $sub)
                            @if(!empty($sub['name']))
                            <li>
                                <strong>Subadmin {{ $index + 1 }}:</strong>
                                <span>{{ $sub['name'] }} ({{ $sub['designation'] ?? 'No designation' }}) - {{ ($sub['country_code'] ?? '') . ' ' . ($sub['mobile'] ?? '') }}</span>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Banner Summary -->
                @if(!empty($banner['banner_section']))
                <div class="summary-section">
                    <h5><i class="bx bx-image-alt me-2"></i>Banner Configuration</h5>
                    <ul>
                        <li><strong>Section:</strong> <span>{{ ucfirst($banner['banner_section'] ?? 'Not specified') }}</span></li>
                        <li><strong>Display Order:</strong> <span>{{ $banner['banner_order'] ?? 'Not set' }}</span></li>
                        <li><strong>Status:</strong> <span>{{ ucfirst($banner['banner_status'] ?? 'Not set') }}</span></li>
                        @if(!empty($banner['banner_image']))
                        <li><strong>Banner Image:</strong> <span>{{ $banner['banner_image'] }}</span></li>
                        @endif
                    </ul>
                </div>
                @endif

                <!-- Advertisement Summary -->
                @if(!empty($advertisement['advertisement_subject']))
                <div class="summary-section">
                    <h5><i class="bx bx-bullhorn me-2"></i>Advertisement Details</h5>
                    <ul>
                        <li><strong>Subject:</strong> <span>{{ $advertisement['advertisement_subject'] ?? 'Not provided' }}</span></li>
                        <li><strong>Posted Date:</strong> <span>{{ $advertisement['advertisement_posted_date'] ?? 'Not set' }}</span></li>
                        @if(!empty($advertisement['advertisement_shiptypes']))
                        <li><strong>Ship Types & Ranks:</strong>
                            <ul class="mt-2">
                                @foreach($advertisement['advertisement_shiptypes'] as $shiptype)
                                <li class="ms-3">
                                    <strong>Ship Type:</strong>
                                    {{ optional($shipTypes->firstWhere('id', $shiptype['shiptype'] ?? null))->ship_name ?? ($shiptype['shiptype'] ?? 'Unknown') }}
                                    <br>
                                    <strong>Ranks:</strong>
                                    @if(!empty($shiptype['ranks']))
                                        {{ collect($shiptype['ranks'])->map(function($rid) use ($ranks) {
                                            return optional($ranks->firstWhere('id', $rid))->rank ?? $rid;
                                        })->implode(', ') }}
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
                @endif
            </div>
            <div class="card-footer d-flex justify-content-between p-4">
                <a href="{{ route('admin.company.register.step', 6) }}" class="btn btn-outline-secondary">
                    <i class="bx bx-left-arrow-alt"></i> Back
                </a>
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="bx bx-check-circle"></i> Complete Registration
                </button>
            </div>
        </form>
        @endif
    </div>
</main>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

<script>
$(function(){
    // Initialize datepicker
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    });

    // Initialize Summernote
    $('#advertisement_description').summernote({
        height: 250,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['view', ['undo', 'redo', 'codeview']]
        ],
        placeholder: 'Enter detailed advertisement description...'
    });

    // Multiselect Dropdown for Ranks
    $(document).on('click', '.rankDropdownBtn', function() {
        $(this).siblings('.rankDropdownMenu').toggleClass('show');
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.multiselect-checkbox').length) {
            $('.rankDropdownMenu').removeClass('show');
        }
    });

    $(document).on('change', '.rankDropdownMenu input[type="checkbox"]', function() {
        let $row = $(this).closest('.shiptype-rank-row');
        let selected = [];
        $row.find('input[type="checkbox"]:checked').each(function() {
            selected.push($(this).parent().text().trim());
        });
        $row.find('.rankDropdownBtn').text(selected.length ? selected.join(', ') : 'Select Ranks');
    });

    // Subadmin Management
    let subadminIndex = 1;
    $('#add-subadmin').on('click', function() {
        let html = `
        <div class="dynamic-row subadmin-row">
            <div class="row g-3">
                <div class="col-md-2">
                    <input type="text" name="subadmins[${subadminIndex}][username]" class="form-control" placeholder="Enter username" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="subadmins[${subadminIndex}][name]" class="form-control" placeholder="Enter full name" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="subadmins[${subadminIndex}][designation]" class="form-control" placeholder="Role" required>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <select name="subadmins[${subadminIndex}][country_code]" class="form-select" style="max-width:130px;" required>
                            @foreach($countryCodes as $code)
                                <option value="{{ $code->dial_code }}"
                                    {{ ($code->country_code == 'IN' || $code->dial_code == '+91') ? 'selected' : '' }}>
                                    {{ $code->dial_code }} ({{ $code->country_code }})
                                </option>
                            @endforeach
                        </select>
                        <input type="text" name="subadmins[${subadminIndex}][mobile]" class="form-control" placeholder="Mobile" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="password" name="subadmins[${subadminIndex}][password]" class="form-control" placeholder="Enter password" required autocomplete="new-password">
                </div>
                <div class="col-md-2">
                    <input type="email" name="subadmins[${subadminIndex}][email]" class="form-control" placeholder="email@company.com">
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger remove-subadmin">
                        <i class="bx bx-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        `;
        $('#subadmins-wrapper').append(html);
        subadminIndex++;
        updateRemoveButtons();
    });

    $(document).on('click', '.remove-subadmin', function() {
        $(this).closest('.subadmin-row').remove();
        updateRemoveButtons();
    });

    function updateRemoveButtons() {
        let rows = $('#subadmins-wrapper .subadmin-row');
        if (rows.length > 1) {
            rows.find('.remove-subadmin').removeClass('d-none');
        } else {
            rows.find('.remove-subadmin').addClass('d-none');
        }
    }

    // Shiptype & Rank Management
    let shiptypeRankIndex = 1;
    $('#add-shiptype-rank').on('click', function() {
        let html = `
        <div class="dynamic-row shiptype-rank-row">
            <div class="row g-3">
                <div class="col-md-6">
                    <select name="advertisement_shiptypes[${shiptypeRankIndex}][shiptype]" class="form-select" required>
                        <option value="">Select Ship Type</option>
                        @foreach($shipTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->ship_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="multiselect-checkbox position-relative">
                        <button type="button" class="form-control text-start rankDropdownBtn">
                            Select Ranks
                        </button>
                        <div class="dropdown-menu w-100 rankDropdownMenu">
                            @foreach($ranks as $rank)
                            <label class="dropdown-item">
                                <input type="checkbox" name="advertisement_shiptypes[${shiptypeRankIndex}][ranks][]" value="{{ $rank->id }}">
                                {{ $rank->rank }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        $('#shiptype-rank-wrapper').append(html);
        shiptypeRankIndex++;
    });

    // Initialize remove button state
    updateRemoveButtons();

    // Form submission loading state
    $('form').on('submit', function() {
        const $btn = $(this).find('button[type="submit"]');
        $btn.addClass('loading').prop('disabled', true);
    });
});
</script>
@endpush
