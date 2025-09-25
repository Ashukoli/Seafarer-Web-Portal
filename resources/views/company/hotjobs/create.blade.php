{{-- resources/views/company/hotjobs/create.blade.php --}}
@extends('layouts.company.app')

@section('content')
<main class="page-content professional-bg">
    <div class="container-fluid px-4">
        <!-- Enhanced Breadcrumb -->
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="modern-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('company.dashboard') }}" class="breadcrumb-link">
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
                            <a href="{{ route('company.hotjobs.index') }}" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-briefcase"></i>
                                </div>
                                <span class="breadcrumb-text">Hot Jobs</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-plus"></i>
                            </div>
                            <span class="breadcrumb-text">Create Hot Job</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Modern Form Card -->
        <form action="{{ route('company.hotjobs.store') }}" method="POST" class="modern-professional-card mb-4" autocomplete="off">
            @csrf
            <div class="card-header modern-header">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bx bx-briefcase"></i>
                    </div>
                    <div class="header-text">
                        <h5 class="header-title">Create New Hot Job</h5>
                        <p class="header-subtitle">Post an urgent maritime job opening to attract qualified seafarers</p>
                    </div>
                </div>
            </div>

            <div class="card-body modern-body">
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
                    <!-- Position & Vessel Requirements Section -->
                    <div class="form-section">
                        <h6 class="section-title">
                            <i class="bx bx-ship"></i>
                            Position & Vessel Requirements
                        </h6>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Rank/Position</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-container">
                                        <select name="rank_id" class="modern-form-control modern-form-select @error('rank_id') is-invalid @enderror" required>
                                            <option value="">Select Rank</option>
                                            @foreach($ranks as $rank)
                                                <option value="{{ $rank->id }}" {{ old('rank_id') == $rank->id ? 'selected' : '' }}>{{ $rank->rank }}</option>
                                            @endforeach
                                        </select>
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('rank_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Ship Type</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-container">
                                        <select name="ship_id" class="modern-form-control modern-form-select @error('ship_id') is-invalid @enderror" required>
                                            <option value="">Select Ship Type</option>
                                            @foreach($ships as $ship)
                                                <option value="{{ $ship->id }}" {{ old('ship_id') == $ship->id ? 'selected' : '' }}>{{ $ship->ship_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('ship_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 mt-2">
                            <div class="col-md-6">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Date of Joining</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-container">
                                        <input type="text"
                                               name="joiningdate"
                                               id="joiningdate"
                                               class="modern-form-control @error('joiningdate') is-invalid @enderror"
                                               value="{{ old('joiningdate') }}"
                                               placeholder="DD-MM-YYYY"
                                               required
                                               autocomplete="off">
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('joiningdate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Nationality</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-container">
                                        <select name="nationality" class="modern-form-control modern-form-select @error('nationality') is-invalid @enderror" required>
                                            <option value="">Select Nationality</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->country_name }}" {{ old('nationality', 'India') == $country->country_name ? 'selected' : '' }}>
                                                    {{ $country->country_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('nationality')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 mt-2">
                            <div class="col-md-6">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Minimum Rank Experience</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <select name="experience_count" class="modern-form-control @error('experience_count') is-invalid @enderror" required>
                                                <option value="">Select</option>
                                                @for($i=0; $i<=30; $i++)
                                                    <option value="{{ $i }}" {{ old('experience_count') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                            @error('experience_count')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <select name="experience_type" class="modern-form-control @error('experience_type') is-invalid @enderror" required>
                                                <option value="Months" {{ old('experience_type') == 'Months' ? 'selected' : '' }}>Months</option>
                                                <option value="Years" {{ old('experience_type', 'Years') == 'Years' ? 'selected' : '' }}>Years</option>
                                            </select>
                                            @error('experience_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Description & Settings Section -->
                    <div class="form-section">
                        <h6 class="section-title">
                            <i class="bx bx-file-blank"></i>
                            Job Description & Settings
                        </h6>
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Job Description</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-container">
                                        <textarea name="description"
                                                  class="modern-form-control modern-textarea @error('description') is-invalid @enderror"
                                                  rows="5"
                                                  placeholder="Enter detailed job description, requirements, benefits, and other relevant information"
                                                  required>{{ old('description') }}</textarea>
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Advertisement Expiry Date</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-container">
                                        <input type="text"
                                               name="expiry_date"
                                               id="expiry_date"
                                               class="modern-form-control @error('expiry_date') is-invalid @enderror"
                                               value="{{ old('expiry_date') }}"
                                               placeholder="DD-MM-YYYY"
                                               required
                                               autocomplete="off">
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('expiry_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Removed Job Status field -->
                            <input type="hidden" name="status" value="pending">
                            <div class="col-12">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Hot Job SMS Notification</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="compact-radio-group">
                                        <div class="compact-radio-option">
                                            <input type="radio"
                                                id="sms_yes"
                                                name="withsms"
                                                value="yes"
                                                class="compact-radio-input"
                                                {{ old('withsms') == 'yes' ? 'checked' : '' }}>
                                            <label for="sms_yes" class="compact-radio-label">
                                                <div class="radio-indicator">
                                                    <div class="radio-dot"></div>
                                                </div>
                                                <span class="radio-title">With SMS</span>
                                            </label>
                                        </div>
                                        <div class="compact-radio-option">
                                            <input type="radio"
                                                id="sms_no"
                                                name="withsms"
                                                value="no"
                                                class="compact-radio-input"
                                                {{ old('withsms', 'no') == 'no' ? 'checked' : '' }}>
                                            <label for="sms_no" class="compact-radio-label">
                                                <div class="radio-indicator">
                                                    <div class="radio-dot"></div>
                                                </div>
                                                <span class="radio-title">Without SMS</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="sms-service-notice">
                                        <div class="notice-icon">
                                            <i class="bx bx-info-circle"></i>
                                        </div>
                                        <div class="notice-content">
                                            <strong>SMS Service Activation:</strong>
                                            <span>To activate SMS notification service, please contact Seafarerjobs.com at <strong>+91-8454972214</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Posted By Information Section -->
                    <div class="form-section">
                        <h6 class="section-title">
                            <i class="bx bx-user-check"></i>
                            Contact Information
                        </h6>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Name</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <input type="text" name="posted_by_name" class="modern-form-control" value="{{ old('posted_by_name', $user->first_name . ' ' . $user->last_name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Email</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <input type="email" name="posted_by_email" class="modern-form-control" value="{{ old('posted_by_email', $user->email) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Mobile Number</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-container">
                                        <select name="posted_by_country_code" class="modern-form-control modern-form-select" style="max-width: 120px; display: inline-block;" required>
                                            @foreach($mobileCountryCodes as $code)
                                                <option value="{{ $code->dial_code }}" {{ old('posted_by_country_code', $user->country_code) == $code->dial_code ? 'selected' : '' }}>
                                                    {{ $code->country_name }} ({{ $code->dial_code }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="posted_by_mobile" class="modern-form-control" style="max-width: 180px; display: inline-block; margin-left: 8px;" value="{{ old('posted_by_mobile', $user->mobile) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('company.hotjobs.index') }}" class="modern-btn modern-btn-outline-secondary">
                            <i class="bx bx-left-arrow-alt"></i>
                            <span>Cancel</span>
                        </a>
                        <button type="submit" class="modern-btn modern-btn-success">
                            <i class="bx bx-save"></i>
                            <span>Create Hot Job</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
/* Professional Design Variables */
:root {
    --primary-color: #4f46e5;
    --primary-hover: #4338ca;
    --primary-light: #f0f4ff;
    --success-color: #059669;
    --success-hover: #047857;
    --success-light: #f0fdf9;
    --warning-color: #d97706;
    --warning-hover: #b45309;
    --warning-light: #fffbeb;
    --danger-color: #dc2626;
    --danger-hover: #b91c1c;
    --danger-light: #fef2f2;
    --info-color: #0891b2;
    --info-hover: #0e7490;
    --info-light: #f0f9ff;
    --secondary-color: #64748b;
    --secondary-hover: #475569;
    --secondary-light: #f8fafc;
    --background-primary: #f8fafc;
    --surface-elevated: #ffffff;
    --border-primary: #e2e8f0;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-muted: #94a3b8;
    --shadow-subtle: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-medium: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    --shadow-elevated: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
    --shadow-floating: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    --border-radius-sm: 8px;
    --border-radius-md: 12px;
    --border-radius-lg: 16px;
    --transition-fast: all 0.15s ease;
    --transition-medium: all 0.25s ease;
    --spacing-xs: 0.5rem;
    --spacing-sm: 0.75rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --spacing-xl: 2rem;

    /* Validation Colors */
    --valid-color: #059669;
    --valid-bg: rgba(5, 150, 105, 0.08);
    --valid-border: rgba(5, 150, 105, 0.25);
    --invalid-color: #dc2626;
    --invalid-bg: rgba(220, 38, 38, 0.08);
    --invalid-border: rgba(220, 38, 38, 0.25);
}

.professional-bg {
    background: linear-gradient(135deg, var(--background-primary) 0%, #f1f5f9 100%);
    min-height: 100vh;
    padding: var(--spacing-xl) 0;
}

/* Modern Breadcrumb */
.modern-breadcrumb {
    display: flex;
    align-items: center;
    background: var(--surface-elevated);
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-subtle);
    border: 1px solid var(--border-primary);
    margin: 0;
    list-style: none;
    gap: var(--spacing-sm);
    flex-wrap: wrap;
}

.breadcrumb-item {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
}

.breadcrumb-link {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    text-decoration: none;
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: var(--border-radius-sm);
    transition: var(--transition-fast);
}

.breadcrumb-link:hover {
    color: var(--primary-color);
    background: var(--primary-light);
    text-decoration: none;
}

.breadcrumb-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    border-radius: 4px;
    background: var(--primary-light);
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
}

.breadcrumb-item.active {
    color: var(--text-primary);
    font-weight: 600;
}

.breadcrumb-item.active .breadcrumb-icon {
    background: var(--primary-color);
    color: white;
}

/* Modern Professional Card */
.modern-professional-card {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-elevated);
    border: 1px solid var(--border-primary);
    overflow: hidden;
    transition: var(--transition-medium);
}

.modern-professional-card:hover {
    box-shadow: var(--shadow-floating);
}

/* Maritime-themed Header Styling */
.modern-header {
    background: linear-gradient(135deg, var(--info-light) 0%, #e0f7fa 100%);
    color: var(--info-color);
    padding: var(--spacing-xl);
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
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="waves" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M0 20 Q10 10 20 20 T40 20" stroke="rgba(8,145,178,0.1)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23waves)"/></svg>');
    opacity: 1;
}

.header-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    position: relative;
    z-index: 1;
}

.header-icon {
    background: rgba(8, 145, 178, 0.15);
    padding: var(--spacing-md);
    border-radius: var(--border-radius-sm);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(8, 145, 178, 0.2);
}

.header-icon i {
    font-size: 1.5rem;
    color: var(--info-color);
}

.header-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    letter-spacing: -0.025em;
    color: var(--info-color);
}

.header-subtitle {
    margin: 0;
    font-size: 0.875rem;
    color: var(--info-hover);
    font-weight: 400;
}

/* Body Styling */
.modern-body {
    padding: var(--spacing-xl);
    background: var(--surface-elevated);
}

/* Modern Alert Styling */
.modern-alert {
    display: flex;
    align-items: flex-start;
    gap: var(--spacing-md);
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: var(--border-radius-sm);
    border: 1px solid;
    position: relative;
    box-shadow: var(--shadow-subtle);
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

.modern-alert-error {
    background: linear-gradient(135deg, rgba(220, 38, 38, 0.08) 0%, rgba(220, 38, 38, 0.05) 100%);
    border-color: rgba(220, 38, 38, 0.2);
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
    top: var(--spacing-sm);
    right: var(--spacing-md);
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: var(--transition-fast);
    opacity: 0.7;
}

.alert-close:hover {
    opacity: 1;
    background: rgba(0, 0, 0, 0.1);
}

/* Form Container */
.modern-form-container {
    background: linear-gradient(145deg, #fafbff 0%, #f1f5f9 100%);
    border: 1px solid rgba(8, 145, 178, 0.1);
    border-radius: var(--border-radius-md);
    padding: var(--spacing-xl);
    transition: var(--transition-fast);
    position: relative;
}

.modern-form-container:hover {
    box-shadow: var(--shadow-medium);
    border-color: rgba(8, 145, 178, 0.2);
}

.modern-form-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, var(--info-color) 0%, var(--info-hover) 100%);
    border-radius: 2px 0 0 2px;
    opacity: 0;
    transition: var(--transition-fast);
}

.modern-form-container:hover::before {
    opacity: 1;
}

/* Form Sections */
.form-section {
    margin-bottom: var(--spacing-xl);
}

.form-section:last-child {
    margin-bottom: 0;
}

.section-title {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    margin-bottom: var(--spacing-lg);
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.section-title i {
    color: var(--info-color);
    font-size: 1.125rem;
}

/* Form Groups */
.modern-form-group {
    margin-bottom: 0;
    position: relative;
}

.modern-form-label {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    margin-bottom: var(--spacing-sm);
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

/* Enhanced Input Container for Validation */
.input-container {
    position: relative;
    display: flex;
    align-items: center;
}

/* Form Controls with Validation States */
.modern-form-control {
    width: 100%;
    padding: var(--spacing-sm) 2.5rem var(--spacing-sm) var(--spacing-md);
    font-size: 0.875rem;
    line-height: 1.5;
    color: var(--text-primary);
    background: white;
    border: 2px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    transition: var(--transition-fast);
    box-shadow: var(--shadow-subtle);
}

.modern-form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    background: white;
}

.modern-form-control::placeholder {
    color: var(--text-muted);
    opacity: 1;
}

.modern-form-control:hover {
    border-color: var(--text-secondary);
}

/* Textarea Specific */
.modern-textarea {
    resize: vertical;
    min-height: 140px;
}

/* Select Specific */
.modern-form-select {
    appearance: none;
    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236B7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 3rem;
}

/* Validation States */
.modern-form-control:valid:not(:placeholder-shown):not(:focus) {
    border-color: var(--valid-border);
    background: var(--valid-bg);
}

.modern-form-control:valid:not(:placeholder-shown):not(:focus) + .validation-icon .valid-icon {
    display: block;
}

.modern-form-control.is-invalid,
.modern-form-control:invalid:not(:placeholder-shown):not(:focus) {
    border-color: var(--invalid-border);
    background: var(--invalid-bg);
}

.modern-form-control.is-invalid + .validation-icon .invalid-icon,
.modern-form-control:invalid:not(:placeholder-shown):not(:focus) + .validation-icon .invalid-icon {
    display: block;
}

/* Validation Icons */
.validation-icon {
    position: absolute;
    right: var(--spacing-sm);
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    z-index: 2;
}

.valid-icon,
.invalid-icon {
    display: none;
    font-size: 1rem;
    transition: var(--transition-fast);
}

.valid-icon {
    color: var(--valid-color);
    animation: scaleIn 0.3s ease-out;
}

.invalid-icon {
    color: var(--invalid-color);
    animation: shake 0.5s ease-out;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-2px); }
    75% { transform: translateX(2px); }
}

/* Invalid Feedback Messages */
.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.375rem;
    padding: var(--spacing-sm) var(--spacing-sm);
    font-size: 0.8125rem;
    color: var(--invalid-color);
    background: var(--invalid-bg);
    border: 1px solid var(--invalid-border);
    border-radius: var(--border-radius-sm);
    line-height: 1.4;
    position: relative;
}

.invalid-feedback::before {
    content: '';
    position: absolute;
    top: -4px;
    left: var(--spacing-md);
    width: 8px;
    height: 8px;
    background: var(--invalid-bg);
    border-left: 1px solid var(--invalid-border);
    border-top: 1px solid var(--invalid-border);
    transform: rotate(45deg);
}

/* Compact Radio Buttons */
.compact-radio-group {
    display: flex;
    gap: var(--spacing-lg);
    align-items: center;
    flex-wrap: wrap;
}

.compact-radio-option {
    position: relative;
}

.compact-radio-input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.compact-radio-label {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    cursor: pointer;
    padding: var(--spacing-sm) var(--spacing-md);
    border: 2px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: white;
    transition: var(--transition-fast);
    white-space: nowrap;
}

.compact-radio-label:hover {
    border-color: var(--info-color);
    background: var(--info-light);
}

.compact-radio-input:checked + .compact-radio-label {
    border-color: var(--info-color);
    background: var(--info-light);
    box-shadow: 0 0 0 3px rgba(8, 145, 178, 0.1);
}

.compact-radio-option .radio-indicator {
    position: relative;
    width: 18px;
    height: 18px;
    border: 2px solid var(--border-primary);
    border-radius: 50%;
    background: white;
    transition: var(--transition-fast);
    flex-shrink: 0;
}

.compact-radio-input:checked + .compact-radio-label .radio-indicator {
    border-color: var(--info-color);
    background: var(--info-color);
}

.compact-radio-option .radio-dot {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: white;
    transition: var(--transition-fast);
}

.compact-radio-input:checked + .compact-radio-label .radio-dot {
    transform: translate(-50%, -50%) scale(1);
}

.compact-radio-option .radio-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
}

/* SMS Service Notice */
.sms-service-notice {
    display: flex;
    align-items: flex-start;
    gap: var(--spacing-sm);
    margin-top: var(--spacing-md);
    padding: var(--spacing-md);
    background: var(--info-light);
    border: 1px solid rgba(8, 145, 178, 0.2);
    border-radius: var(--border-radius-sm);
}

.notice-icon {
    flex-shrink: 0;
    color: var(--info-color);
    font-size: 1.125rem;
}

.notice-content {
    flex: 1;
    font-size: 0.8125rem;
    line-height: 1.4;
    color: var(--text-secondary);
}

.notice-content strong {
    color: var(--text-primary);
    font-weight: 600;
}

/* Company Information Display */
.company-info-display {
    background: var(--surface-elevated);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-md);
    padding: var(--spacing-lg);
    box-shadow: var(--shadow-subtle);
}

.info-header {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    margin-bottom: var(--spacing-lg);
    padding-bottom: var(--spacing-md);
    border-bottom: 2px dashed rgba(8, 145, 178, 0.2);
}

.company-avatar {
    width: 56px;
    height: 56px;
    background: var(--info-light);
    color: var(--info-color);
    border-radius: var(--border-radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    border: 2px solid rgba(8, 145, 178, 0.2);
}

.company-details {
    flex: 1;
}

.contact-name {
    margin: 0 0 0.25rem 0;
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.3;
}

.contact-role {
    font-size: 0.75rem;
    color: var(--info-color);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: var(--spacing-md);
}

.info-item {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-sm);
    background: rgba(8, 145, 178, 0.05);
    border-radius: var(--border-radius-sm);
}

.info-icon {
    color: var(--info-color);
    font-size: 1.125rem;
    flex-shrink: 0;
}

.info-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.125rem;
}

.info-label {
    font-size: 0.75rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
}

.info-value {
    font-size: 0.875rem;
    color: var(--text-primary);
    font-weight: 500;
    line-height: 1.3;
}

/* Form Actions */
.form-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: var(--spacing-md);
    margin-top: var(--spacing-xl);
    padding-top: var(--spacing-lg);
    border-top: 2px dashed rgba(8, 145, 178, 0.2);
    background: linear-gradient(135deg, rgba(8, 145, 178, 0.02) 0%, rgba(8, 145, 178, 0.05) 100%);
    border-radius: var(--border-radius-sm);
    padding: var(--spacing-md);
}

/* Modern Buttons */
.modern-btn {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-xs);
    padding: 0.75rem 1.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    line-height: 1;
    border-radius: var(--border-radius-sm);
    border: 2px solid transparent;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition-fast);
    white-space: nowrap;
    text-align: center;
    justify-content: center;
    min-width: auto;
    position: relative;
    overflow: hidden;
}

.modern-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.modern-btn-success {
    background: var(--success-color);
    color: white;
    border-color: var(--success-color);
}

.modern-btn-success:hover {
    background: var(--success-hover);
    border-color: var(--success-hover);
    color: white;
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

.modern-btn-outline-secondary {
    background: white;
    color: var(--secondary-color);
    border-color: var(--border-primary);
}

.modern-btn-outline-secondary:hover {
    background: var(--secondary-color);
    color: white;
    border-color: var(--secondary-color);
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
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

/* Better Validation Icon positioning for Selects */
.modern-form-select + .validation-icon {
    right: 2.5rem;
}

/* Flatpickr Styling */
.flatpickr-calendar {
    box-shadow: var(--shadow-elevated) !important;
    border: 1px solid var(--border-primary) !important;
    border-radius: var(--border-radius-sm) !important;
}

.flatpickr-day.selected {
    background: var(--primary-color) !important;
    border-color: var(--primary-color) !important;
}

.flatpickr-day:hover {
    background: var(--primary-light) !important;
    color: var(--primary-color) !important;
}

.flatpickr-months .flatpickr-month {
    background: var(--info-light) !important;
    color: var(--info-color) !important;
}

.flatpickr-current-month .flatpickr-monthDropdown-months {
    background: var(--info-light) !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-body {
        padding: var(--spacing-lg);
    }

    .modern-form-container {
        padding: var(--spacing-lg);
    }

    .header-content {
        flex-direction: column;
        text-align: center;
        gap: var(--spacing-sm);
    }

    .form-actions {
        flex-direction: column-reverse;
        gap: var(--spacing-md);
    }

    .modern-btn {
        width: 100%;
    }

    .modern-breadcrumb {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-xs);
        padding: var(--spacing-sm) var(--spacing-md);
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
        padding: var(--spacing-xs);
    }

    .compact-radio-group {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-sm);
    }

    .compact-radio-label {
        width: 100%;
        justify-content: flex-start;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .info-header {
        flex-direction: column;
        text-align: center;
        gap: var(--spacing-sm);
    }
}

/* Focus States for Accessibility */
.modern-form-control:focus,
.modern-btn:focus,
.breadcrumb-link:focus,
.compact-radio-input:focus + .compact-radio-label {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

/* Enhanced Focus for Radio Buttons */
.compact-radio-input:focus + .compact-radio-label {
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
$(function(){
    flatpickr("#joiningdate", {
        dateFormat: "d-m-Y",
        allowInput: true,
        defaultDate: "{{ old('joiningdate') }}"
    });
    flatpickr("#expiry_date", {
        dateFormat: "d-m-Y",
        allowInput: true,
        defaultDate: "{{ old('expiry_date') }}"
    });

    $('form').on('submit', function() {
        let $submitBtn = $(this).find('button[type="submit"]');
        $submitBtn.addClass('loading');
        $submitBtn.find('span').text('Creating Job...');
    });

    $(document).on('input blur change', '.modern-form-control', function() {
        validateField($(this));
    });

    function validateField($field) {
        const isValid = $field[0].checkValidity() && $field.val().trim() !== '';

        if (isValid) {
            $field.removeClass('is-invalid').addClass('is-valid');
        } else if ($field.val().trim() !== '') {
            $field.removeClass('is-valid').addClass('is-invalid');
        } else {
            $field.removeClass('is-valid is-invalid');
        }
    }

    $('form').on('submit', function(e) {
        let isValid = true;
        let firstInvalidField = null;

        $('.modern-form-control[required]').each(function() {
            const $field = $(this);
            if (!this.checkValidity() || $field.val().trim() === '') {
                $field.addClass('is-invalid');
                isValid = false;
                if (!firstInvalidField) {
                    firstInvalidField = $field;
                }
            }
        });

        if (!isValid) {
            e.preventDefault();
            if (firstInvalidField) {
                $('html, body').animate({
                    scrollTop: firstInvalidField.offset().top - 100
                }, 500);
                firstInvalidField.focus();
            }
            return false;
        }
    });

    $('.modern-alert').each(function() {
        const $alert = $(this);
        setTimeout(() => {
            $alert.fadeOut(300, () => $alert.remove());
        }, 5000);
    });

    $('.compact-radio-input').on('change', function() {
        $('.compact-radio-label').removeClass('selected');
        $(this).next('.compact-radio-label').addClass('selected');
    });
});
</script>
@endpush
