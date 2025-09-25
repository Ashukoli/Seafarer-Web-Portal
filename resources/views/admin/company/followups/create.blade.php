{{-- resources/views/admin/company/followups/create.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<main class="page-content professional-bg">
    <div class="container-fluid px-4">
        <!-- Enhanced Breadcrumb -->
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
                            <a href="{{ route('admin.company.followups.index') }}" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-phone-call"></i>
                                </div>
                                <span class="breadcrumb-text">Follow-Ups</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-plus"></i>
                            </div>
                            <span class="breadcrumb-text">Add Follow-Up</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Modern Form Card -->
        <form method="POST" action="{{ route('admin.company.followups.store') }}" class="modern-professional-card mb-4">
            @csrf
            <div class="card-header modern-header">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bx bx-plus"></i>
                    </div>
                    <div class="header-text">
                        <h5 class="header-title">Add Company Follow-Up</h5>
                        <p class="header-subtitle">Create a new follow-up record for company communication tracking</p>
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
                    <!-- Company Details Section -->
                    <div class="form-section">
                        <h6 class="section-title">
                            <i class="bx bx-buildings"></i>
                            Company Information
                        </h6>
                        <div class="row g-4">
                            <div class="col-12">
                                <input type="hidden" name="company_id" value="{{ $company->id }}">
                                <div class="company-info-card">
                                    <div class="company-header">
                                        <div class="company-avatar">
                                            <i class="bx bx-buildings"></i>
                                        </div>
                                        <div class="company-details">
                                            <h6 class="company-name">{{ $company->company_name }}</h6>
                                            <span class="company-type">Company</span>
                                        </div>
                                    </div>
                                    <div class="company-info-grid">
                                        <div class="info-item">
                                            <i class="bx bx-envelope info-icon"></i>
                                            <div class="info-content">
                                                <span class="info-label">Email</span>
                                                <span class="info-value">{{ $company->company_email ?: 'Not provided' }}</span>
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <i class="bx bx-phone info-icon"></i>
                                            <div class="info-content">
                                                <span class="info-label">Contact</span>
                                                <span class="info-value">{{ $company->company_contact_no ?: 'Not provided' }}</span>
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <i class="bx bx-map-pin info-icon"></i>
                                            <div class="info-content">
                                                <span class="info-label">Area</span>
                                                <span class="info-value">{{ $company->area ?: 'Not provided' }}</span>
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <i class="bx bx-location-plus info-icon"></i>
                                            <div class="info-content">
                                                <span class="info-label">Address</span>
                                                <span class="info-value">{{ $company->address ?: 'Not provided' }}</span>
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <i class="bx bx-user-check info-icon"></i>
                                            <div class="info-content">
                                                <span class="info-label">Directors</span>
                                                <span class="info-value">{{ $company->directors ?: 'Not provided' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Follow-Up Details and Previous Follow-Ups Side by Side -->
                    <div class="row g-4">
                        <!-- Follow-Up Details Form -->
                        <div class="col-12 col-md-6">
                            <div class="form-section">
                                <h6 class="section-title">
                                    <i class="bx bx-calendar-check"></i>
                                    Follow-Up Details
                                </h6>
                                <div class="row g-4">
                                    <div class="col-12">
                                        <div class="modern-form-group">
                                            <label class="modern-form-label">
                                                <span class="label-text">Next Follow Up Date</span>
                                                <span class="required-indicator">*</span>
                                            </label>
                                            <div class="input-container">
                                                <input type="text"
                                                       name="next_follow_up_date"
                                                       id="next_follow_up_date"
                                                       class="modern-form-control @error('next_follow_up_date') is-invalid @enderror"
                                                       value="{{ old('next_follow_up_date') }}"
                                                       placeholder="DD-MM-YYYY"
                                                       autocomplete="off"
                                                       required>
                                                <div class="validation-icon">
                                                    <i class="bx bx-check-circle valid-icon"></i>
                                                    <i class="bx bx-error-circle invalid-icon"></i>
                                                </div>
                                            </div>
                                            @error('next_follow_up_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="modern-form-group">
                                            <label class="modern-form-label">
                                                <span class="label-text">Message</span>
                                                <span class="required-indicator">*</span>
                                            </label>
                                            <div class="input-container">
                                                <textarea name="message"
                                                          class="modern-form-control modern-textarea @error('message') is-invalid @enderror"
                                                          rows="4"
                                                          placeholder="Enter follow-up message or notes"
                                                          required>{{ old('message') }}</textarea>
                                                <div class="validation-icon">
                                                    <i class="bx bx-check-circle valid-icon"></i>
                                                    <i class="bx bx-error-circle invalid-icon"></i>
                                                </div>
                                            </div>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Action Buttons Below Message -->
                                    <div class="col-12">
                                        <div class="form-actions">
                                            <a href="{{ route('admin.company.followups.index') }}" class="modern-btn modern-btn-outline-secondary">
                                                <i class="bx bx-left-arrow-alt"></i>
                                                <span>Cancel</span>
                                            </a>
                                            <button type="submit" class="modern-btn modern-btn-success">
                                                <i class="bx bx-save"></i>
                                                <span>Save Follow-Up</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Previous Follow-Ups Table -->
                        <div class="col-12 col-md-6">
                            <div class="form-section">
                                <h6 class="section-title">
                                    <i class="bx bx-history"></i>
                                    Previous Follow-Ups
                                </h6>
                                <div class="previous-followups-container">
                                    <div class="table-responsive">
                                        <table class="professional-table">
                                            <thead class="table-header">
                                                <tr>
                                                    <th class="th-number">#</th>
                                                    <th class="th-date">Date</th>
                                                    <th class="th-executive">Executive</th>
                                                    <th class="th-message">Message</th>
                                                    <th class="th-next">Next Follow Up</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-body">
                                                @forelse($previousFollowups as $i => $followup)
                                                    <tr class="table-row">
                                                        <td class="td-number">
                                                            <span class="row-number">{{ $i + 1 }}</span>
                                                        </td>
                                                        <td class="td-date">
                                                            <div class="date-display">
                                                                <span class="date-primary">
                                                                    {{ \Carbon\Carbon::parse($followup->follow_up_date)->format('d-m-Y') }}
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="td-executive">
                                                            <span class="executive-name">{{ $followup->executive }}</span>
                                                        </td>
                                                        <td class="td-message">
                                                            <div class="message-content" title="{{ $followup->message }}">
                                                                {{ Str::limit($followup->message, 30) }}
                                                            </div>
                                                        </td>
                                                        <td class="td-next">
                                                            @if($followup->next_follow_up_date)
                                                                <span class="next-date">
                                                                    {{ \Carbon\Carbon::parse($followup->next_follow_up_date)->format('d-m-Y') }}
                                                                </span>
                                                            @else
                                                                <span class="no-data">-</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="empty-row">
                                                        <td colspan="5" class="empty-cell">
                                                            <div class="empty-state">
                                                                <div class="empty-icon">
                                                                    <i class="bx bx-history"></i>
                                                                </div>
                                                                <span class="empty-text">No previous follow-ups found</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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

/* Eye-Friendly Header Styling */
.modern-header {
    background: linear-gradient(135deg, var(--warning-light) 0%, #fefce8 100%);
    color: var(--warning-color);
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
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="softgrain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="0.5" fill="rgba(217,119,6,0.08)"/><circle cx="75" cy="75" r="0.5" fill="rgba(217,119,6,0.08)"/></pattern></defs><rect width="100" height="100" fill="url(%23softgrain)"/></svg>');
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
    background: rgba(217, 119, 6, 0.15);
    padding: var(--spacing-md);
    border-radius: var(--border-radius-sm);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(217, 119, 6, 0.2);
}

.header-icon i {
    font-size: 1.5rem;
    color: var(--warning-color);
}

.header-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    letter-spacing: -0.025em;
    color: var(--warning-color);
}

.header-subtitle {
    margin: 0;
    font-size: 0.875rem;
    color: var(--warning-hover);
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
    border: 1px solid rgba(217, 119, 6, 0.1);
    border-radius: var(--border-radius-md);
    padding: var(--spacing-xl);
    transition: var(--transition-fast);
    position: relative;
}

.modern-form-container:hover {
    box-shadow: var(--shadow-medium);
    border-color: rgba(217, 119, 6, 0.2);
}

.modern-form-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, var(--warning-color) 0%, var(--warning-hover) 100%);
    border-radius: 2px 0 0 2px;
    opacity: 0;
    transition: var(--transition-fast);
}

.modern-form-container:hover::before {
    opacity: 1;
}

/* Professional Company Info Card */
.company-info-card {
    background: var(--surface-elevated);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-md);
    padding: var(--spacing-lg);
    box-shadow: var(--shadow-subtle);
    transition: var(--transition-fast);
}

.company-info-card:hover {
    box-shadow: var(--shadow-medium);
}

.company-header {
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

.company-name {
    margin: 0 0 0.25rem 0;
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.3;
}

.company-type {
    font-size: 0.75rem;
    color: var(--info-color);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
}

.company-info-grid {
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
    color: var(--warning-color);
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

.optional-indicator {
    color: var(--text-muted);
    font-weight: 400;
    font-size: 0.75rem;
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
    min-height: 120px;
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

/* Form Actions Below Message */
.form-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: var(--spacing-md);
    margin-top: var(--spacing-lg);
    padding-top: var(--spacing-lg);
    border-top: 2px dashed rgba(217, 119, 6, 0.2);
    background: linear-gradient(135deg, rgba(217, 119, 6, 0.02) 0%, rgba(217, 119, 6, 0.05) 100%);
    border-radius: var(--border-radius-sm);
    padding: var(--spacing-md);
}

/* Professional Table for Previous Follow-ups */
.previous-followups-container {
    background: var(--surface-elevated);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-subtle);
}

.professional-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.8125rem;
}

.table-header {
    background: linear-gradient(135deg, var(--info-color) 0%, var(--info-hover) 100%);
}

.table-header th {
    padding: var(--spacing-sm) var(--spacing-xs);
    text-align: left;
    font-weight: 600;
    color: white;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    white-space: nowrap;
}

.th-number { width: 8%; }
.th-date { width: 18%; }
.th-executive { width: 20%; }
.th-message { width: 34%; }
.th-next { width: 20%; }

.table-body {
    background: var(--surface-elevated);
}

.table-row {
    transition: var(--transition-fast);
    border-bottom: 1px solid rgba(226, 232, 240, 0.5);
}

.table-row:hover {
    background: rgba(248, 250, 252, 0.8);
}

.table-row td {
    padding: var(--spacing-sm) var(--spacing-xs);
    vertical-align: middle;
    color: var(--text-primary);
}

.row-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    background: var(--primary-light);
    color: var(--primary-color);
    border-radius: 50%;
    font-weight: 600;
    font-size: 0.75rem;
}

.date-display .date-primary {
    font-size: 0.8125rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
}

.executive-name {
    font-size: 0.8125rem;
    font-weight: 500;
    color: var(--text-primary);
}

.message-content {
    font-size: 0.8125rem;
    color: var(--text-primary);
    line-height: 1.4;
    cursor: help;
}

.next-date {
    font-size: 0.8125rem;
    font-weight: 500;
    color: var(--text-primary);
}

.no-data {
    font-size: 0.8125rem;
    color: var(--text-muted);
    font-style: italic;
}

/* Empty State for Table */
.empty-cell {
    padding: var(--spacing-xl) var(--spacing-md);
    text-align: center;
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--spacing-sm);
}

.empty-icon {
    width: 48px;
    height: 48px;
    background: var(--info-light);
    color: var(--info-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.empty-text {
    font-size: 0.875rem;
    color: var(--text-muted);
    font-weight: 500;
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

/* Flatpickr Styling */
.flatpickr-calendar {
    box-shadow: var(--shadow-elevated) !important;
    border: 1px solid var(--border-primary) !important;
}

.flatpickr-day.selected {
    background: var(--primary-color) !important;
    border-color: var(--primary-color) !important;
}

.flatpickr-day:hover {
    background: var(--primary-light) !important;
    color: var(--primary-color) !important;
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

    .company-info-grid {
        grid-template-columns: 1fr;
    }

    .company-header {
        flex-direction: column;
        text-align: center;
        gap: var(--spacing-sm);
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

    .professional-table th,
    .professional-table td {
        padding: 0.375rem 0.25rem;
        font-size: 0.75rem;
    }
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
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
$(function(){
    // Initialize Flatpickr
    flatpickr("#next_follow_up_date", {
        dateFormat: "d-m-Y",
        allowInput: true,
        defaultDate: "{{ old('next_follow_up_date') }}",
        theme: "light"
    });

    // Form submission with loading state
    $('form').on('submit', function() {
        let $submitBtn = $(this).find('button[type="submit"]');
        $submitBtn.addClass('loading');
        $submitBtn.find('span').text('Saving...');
    });

    // Real-time validation
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

    // Form submission validation
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

            // Scroll to first invalid field
            if (firstInvalidField) {
                $('html, body').animate({
                    scrollTop: firstInvalidField.offset().top - 100
                }, 500);
                firstInvalidField.focus();
            }

            return false;
        }
    });

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
