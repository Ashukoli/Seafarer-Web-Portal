{{-- resources/views/admin/shiptypes/edit.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Edit Ship Type')

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
                            <a href="#" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-cog"></i>
                                </div>
                                <span class="breadcrumb-text">Masters</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.shiptypes.index') }}" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-ship"></i>
                                </div>
                                <span class="breadcrumb-text">Ship Types</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-edit"></i>
                            </div>
                            <span class="breadcrumb-text">Edit Ship Type</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Professional Page Header -->
        <div class="compact-header-section mb-4">
            <div class="compact-header-card">
                <div class="compact-header-content">
                    <div class="compact-header-icon">
                        <i class="bx bx-edit"></i>
                    </div>
                    <div class="compact-header-text">
                        <h1 class="compact-page-title">Edit Ship Type</h1>
                        <p class="compact-page-subtitle">Modify vessel type details and classification for "{{ $shiptype->ship_name }}"</p>
                    </div>
                </div>
                <div class="compact-header-actions">
                    <a href="{{ route('admin.shiptypes.index') }}" class="enterprise-btn btn-secondary">
                        <i class="bx bx-list-ul"></i>
                        <span>View All Ship Types</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="modern-alert modern-alert-success mb-4">
                <div class="alert-icon">
                    <i class="bx bx-check-circle"></i>
                </div>
                <div class="alert-content">
                    <strong>Success!</strong>
                    <span>{{ session('success') }}</span>
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

        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <div class="modern-professional-card mb-4">
                    <div class="card-header modern-header">
                        <div class="header-content">
                            <div class="header-icon">
                                <i class="bx bx-edit"></i>
                            </div>
                            <div class="header-text">
                                <h5 class="header-title">Edit Ship Type Details</h5>
                                <p class="header-subtitle">Update vessel name and classification priority</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body modern-body">
                        <form id="editShipTypeForm" action="{{ route('admin.shiptypes.update', $shiptype->id) }}" method="POST" class="modern-form-container">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                <div class="col-md-8">
                                    <div class="modern-form-group">
                                        <label class="modern-form-label">
                                            <span class="label-text">Ship Type Name</span>
                                            <span class="required-indicator">*</span>
                                        </label>
                                        <div class="input-container">
                                            <input type="text"
                                                   name="ship_name"
                                                   id="ship_name"
                                                   class="modern-form-control @error('ship_name') is-invalid @enderror"
                                                   value="{{ old('ship_name', $shiptype->ship_name) }}"
                                                   placeholder="Enter ship type name"
                                                   required>
                                            <div class="validation-icon">
                                                <i class="bx bx-check-circle valid-icon"></i>
                                                <i class="bx bx-error-circle invalid-icon"></i>
                                            </div>
                                        </div>
                                        @error('ship_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-help-text">
                                            <i class="bx bx-info-circle"></i>
                                            <span>Enter the official vessel type name (e.g., Oil Tanker, Container Ship, Bulk Carrier)</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="modern-form-group">
                                        <label class="modern-form-label">
                                            <span class="label-text">Sort Order</span>
                                            <span class="optional-indicator">(Optional)</span>
                                        </label>
                                        <div class="input-container">
                                            <input type="number"
                                                   name="sort"
                                                   id="sort_order"
                                                   class="modern-form-control @error('sort') is-invalid @enderror"
                                                   value="{{ old('sort', $shiptype->sort) }}"
                                                   placeholder="0"
                                                   min="0"
                                                   max="999">
                                            <div class="validation-icon">
                                                <i class="bx bx-check-circle valid-icon"></i>
                                                <i class="bx bx-error-circle invalid-icon"></i>
                                            </div>
                                        </div>
                                        @error('sort')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-help-text">
                                            <i class="bx bx-sort-alt-2"></i>
                                            <span>Lower numbers appear first in listings</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <a href="{{ route('admin.shiptypes.index') }}" class="modern-btn modern-btn-outline-secondary">
                                    <i class="bx bx-x"></i>
                                    <span>Cancel</span>
                                </a>
                                <button type="submit" class="modern-btn modern-btn-success" id="updateBtn">
                                    <i class="bx bx-save"></i>
                                    <span>Update Ship Type</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('styles')
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

/* Compact Header */
.compact-header-section {
    margin-bottom: var(--spacing-lg);
}

.compact-header-card {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-subtle);
    border: 1px solid var(--border-primary);
    padding: var(--spacing-lg);
    position: relative;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.compact-header-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--info-color) 0%, var(--success-color) 100%);
}

.compact-header-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    flex: 1;
}

.compact-header-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, var(--info-color) 0%, var(--info-hover) 100%);
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.compact-page-title {
    margin: 0 0 0.25rem 0;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
}

.compact-page-subtitle {
    margin: 0;
    font-size: 0.875rem;
    color: var(--text-secondary);
    line-height: 1.4;
}

.compact-header-actions {
    flex-shrink: 0;
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

.modern-alert-success {
    background: linear-gradient(135deg, rgba(5, 150, 105, 0.08) 0%, rgba(5, 150, 105, 0.05) 100%);
    border-color: rgba(5, 150, 105, 0.2);
    color: #065f46;
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
    padding: var(--spacing-lg);
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

/* Danger Header */
.danger-header {
    background: linear-gradient(135deg, var(--danger-light) 0%, #fee2e2 100%);
    color: var(--danger-color);
    padding: var(--spacing-lg);
    border: none;
    position: relative;
    overflow: hidden;
}

.danger-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="warning" width="30" height="30" patternUnits="userSpaceOnUse"><path d="M15 5 L25 25 L5 25 Z" stroke="rgba(220,38,38,0.1)" stroke-width="1" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23warning)"/></svg>');
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

.danger-header .header-icon {
    background: rgba(220, 38, 38, 0.15);
    border: 1px solid rgba(220, 38, 38, 0.2);
}

.header-icon i {
    font-size: 1.5rem;
    color: var(--info-color);
}

.danger-header .header-icon i {
    color: var(--danger-color);
}

.header-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    letter-spacing: -0.025em;
    color: var(--info-color);
}

.danger-header .header-title {
    color: var(--danger-color);
}

.header-subtitle {
    margin: 0;
    font-size: 0.875rem;
    color: var(--info-hover);
    font-weight: 400;
}

.danger-header .header-subtitle {
    color: var(--danger-hover);
}

/* Body Styling */
.modern-body {
    padding: var(--spacing-xl);
    background: var(--surface-elevated);
}

/* Current Ship Type Information Display */
.ship-info-display {
    display: flex;
    align-items: center;
    gap: var(--spacing-lg);
    padding: var(--spacing-lg);
    background: linear-gradient(145deg, #fafbff 0%, #f1f5f9 100%);
    border: 1px solid rgba(8, 145, 178, 0.1);
    border-radius: var(--border-radius-md);
}

.ship-visual {
    flex-shrink: 0;
}

.ship-icon-large {
    width: 80px;
    height: 80px;
    border-radius: var(--border-radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    border: 3px solid;
}

.ship-icon-large.tanker {
    background: var(--info-light);
    color: var(--info-color);
    border-color: rgba(8, 145, 178, 0.3);
}

.ship-icon-large.container {
    background: var(--primary-light);
    color: var(--primary-color);
    border-color: rgba(79, 70, 229, 0.3);
}

.ship-icon-large.bulk {
    background: var(--warning-light);
    color: var(--warning-color);
    border-color: rgba(217, 119, 6, 0.3);
}

.ship-icon-large.passenger {
    background: var(--success-light);
    color: var(--success-color);
    border-color: rgba(5, 150, 105, 0.3);
}

.ship-icon-large.cargo {
    background: var(--secondary-light);
    color: var(--secondary-color);
    border-color: rgba(100, 116, 139, 0.3);
}

.ship-icon-large.offshore {
    background: var(--danger-light);
    color: var(--danger-color);
    border-color: rgba(220, 38, 38, 0.3);
}

.ship-icon-large.lng {
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    color: #0891b2;
    border-color: rgba(8, 145, 178, 0.3);
}

.ship-icon-large.general {
    background: var(--secondary-light);
    color: var(--secondary-color);
    border-color: rgba(100, 116, 139, 0.3);
}

.ship-details {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: var(--spacing-md);
}

.current-ship,
.current-sort,
.current-category {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.detail-label {
    font-size: 0.75rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
}

.detail-value {
    font-size: 1rem;
    color: var(--text-primary);
    font-weight: 600;
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
    font-style: italic;
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

/* Form Help Text */
.form-help-text {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    margin-top: var(--spacing-xs);
    font-size: 0.75rem;
    color: var(--text-muted);
    line-height: 1.4;
}

.form-help-text i {
    color: var(--info-color);
}

/* Category Preview Section */
.category-preview-section {
    background: linear-gradient(135deg, rgba(8, 145, 178, 0.05) 0%, rgba(8, 145, 178, 0.02) 100%);
    border: 1px solid rgba(8, 145, 178, 0.1);
    border-radius: var(--border-radius-sm);
    padding: var(--spacing-md);
}

.preview-title {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    margin: 0 0 var(--spacing-md) 0;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
}

.category-preview {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: var(--spacing-md);
}

.preview-ship-display {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    flex: 1;
}

.preview-ship-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    border: 2px solid;
    transition: var(--transition-fast);
}

.preview-ship-info {
    flex: 1;
}

.preview-ship-name {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
    margin-bottom: 0.125rem;
}

.preview-ship-category {
    font-size: 0.75rem;
    color: var(--text-muted);
    line-height: 1.2;
}

.preview-priority-badge {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    border: 1px solid;
    font-size: 0.8125rem;
    transition: var(--transition-fast);
}

/* Enterprise Button */
.enterprise-btn {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-xs);
    padding: 0.75rem 1.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    line-height: 1;
    border-radius: var(--border-radius-sm);
    border: 2px solid;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition-fast);
    white-space: nowrap;
}

.btn-secondary {
    background: var(--secondary-color);
    color: white;
    border-color: var(--secondary-color);
}

.btn-secondary:hover {
    background: var(--secondary-hover);
    border-color: var(--secondary-hover);
    color: white;
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
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

.modern-btn-danger {
    background: var(--danger-color);
    color: white;
    border-color: var(--danger-color);
}

.modern-btn-danger:hover {
    background: var(--danger-hover);
    border-color: var(--danger-hover);
    color: white;
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

/* Danger Zone Styling */
.danger-content {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-lg);
}

.danger-warning {
    display: flex;
    gap: var(--spacing-md);
    padding: var(--spacing-lg);
    background: linear-gradient(135deg, rgba(220, 38, 38, 0.05) 0%, rgba(220, 38, 38, 0.02) 100%);
    border: 1px solid rgba(220, 38, 38, 0.1);
    border-radius: var(--border-radius-sm);
}

.warning-icon {
    flex-shrink: 0;
    width: 48px;
    height: 48px;
    background: var(--danger-light);
    color: var(--danger-color);
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    border: 2px solid rgba(220, 38, 38, 0.2);
}

.warning-text {
    flex: 1;
}

.warning-title {
    margin: 0 0 var(--spacing-sm) 0;
    font-size: 1rem;
    font-weight: 700;
    color: var(--danger-color);
}

.warning-message {
    margin: 0 0 var(--spacing-md) 0;
    font-size: 0.875rem;
    color: var(--text-secondary);
    line-height: 1.5;
}

.warning-consequences {
    margin: 0;
    padding-left: var(--spacing-lg);
    list-style-type: disc;
}

.warning-consequences li {
    margin-bottom: 0.25rem;
    font-size: 0.8125rem;
    color: var(--text-secondary);
    line-height: 1.4;
}

.delete-form {
    display: flex;
    justify-content: flex-start;
}

/* Responsive Design */
@media (max-width: 768px) {
    .professional-bg {
        padding: var(--spacing-md) 0;
    }

    .modern-body {
        padding: var(--spacing-lg);
    }

    .modern-form-container {
        padding: var(--spacing-lg);
    }

    .compact-header-card {
        flex-direction: column;
        text-align: center;
        gap: var(--spacing-md);
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

    .ship-info-display {
        flex-direction: column;
        text-align: center;
        gap: var(--spacing-md);
    }

    .danger-warning {
        flex-direction: column;
        text-align: center;
        gap: var(--spacing-md);
    }

    .category-preview {
        flex-direction: column;
        gap: var(--spacing-md);
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
<script>
$(document).ready(function() {
    // Auto-hide success/error alerts after 5 seconds
    $('.modern-alert').each(function() {
        const $alert = $(this);
        setTimeout(() => {
            $alert.fadeOut(300, () => $alert.remove());
        }, 5000);
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

    // Update ship type preview based on name and sort order
    function updateShipTypePreview() {
        const shipName = $('#ship_name').val().toLowerCase();
        const sortValue = parseInt($('#sort_order').val()) || 999;

        const $previewIcon = $('#previewIcon');
        const $previewIconElement = $('#previewIconElement');
        const $previewName = $('#previewName');
        const $previewCategory = $('#previewCategory');
        const $previewPriority = $('#previewPriority');

        // Determine ship category based on name
        let category, icon, categoryName, iconClass;

        if (shipName.includes('tanker')) {
            category = 'tanker';
            icon = 'bx-droplet';
            categoryName = 'Tanker Vessel';
            iconClass = 'tanker';
        } else if (shipName.includes('container')) {
            category = 'container';
            icon = 'bx-cube';
            categoryName = 'Container Ship';
            iconClass = 'container';
        } else if (shipName.includes('bulk')) {
            category = 'bulk';
            icon = 'bx-category';
            categoryName = 'Bulk Carrier';
            iconClass = 'bulk';
        } else if (shipName.includes('cruise') || shipName.includes('passenger')) {
            category = 'passenger';
            icon = 'bx-group';
            categoryName = 'Passenger Vessel';
            iconClass = 'passenger';
        } else if (shipName.includes('cargo')) {
            category = 'cargo';
            icon = 'bx-package';
            categoryName = 'Cargo Vessel';
            iconClass = 'cargo';
        } else if (shipName.includes('offshore')) {
            category = 'offshore';
            icon = 'bx-cog';
            categoryName = 'Offshore Vessel';
            iconClass = 'offshore';
        } else if (shipName.includes('lng')) {
            category = 'lng';
            icon = 'bx-gas-pump';
            categoryName = 'LNG Carrier';
            iconClass = 'lng';
        } else {
            category = 'general';
            icon = 'bx-ship';
            categoryName = 'General Vessel';
            iconClass = 'general';
        }

        // Update preview icon
        $previewIcon.removeClass('tanker container bulk passenger cargo offshore lng general')
                   .addClass(iconClass);
        $previewIconElement.removeClass().addClass(`bx ${icon}`);

        // Update preview text
        $previewName.text($('#ship_name').val() || 'Ship Type Name');
        $previewCategory.text(categoryName);

        // Update priority badge
        let priorityClass, priorityText;
        if (sortValue <= 5) {
            priorityClass = 'high-priority';
            priorityText = 'High Priority';
        } else if (sortValue <= 10) {
            priorityClass = 'standard-priority';
            priorityText = 'Standard Priority';
        } else {
            priorityClass = 'general-priority';
            priorityText = 'General Priority';
        }

        $previewPriority.removeClass('high-priority standard-priority general-priority')
                       .addClass(priorityClass)
                       .text(priorityText);
    }

    // Initialize preview and update on changes
    updateShipTypePreview();
    $('#ship_name, #sort_order').on('input change', updateShipTypePreview);

    // Add priority styling
    const priorityStyles = {
        'high-priority': {
            background: 'var(--danger-light)',
            color: 'var(--danger-color)',
            borderColor: 'rgba(220, 38, 38, 0.2)'
        },
        'standard-priority': {
            background: 'var(--warning-light)',
            color: 'var(--warning-color)',
            borderColor: 'rgba(217, 119, 6, 0.2)'
        },
        'general-priority': {
            background: 'var(--secondary-light)',
            color: 'var(--secondary-color)',
            borderColor: 'rgba(100, 116, 139, 0.2)'
        }
    };

    function applyPreviewStyles() {
        const $previewPriority = $('#previewPriority');
        const priorityClass = ['high-priority', 'standard-priority', 'general-priority']
            .find(cls => $previewPriority.hasClass(cls));

        if (priorityClass && priorityStyles[priorityClass]) {
            const styles = priorityStyles[priorityClass];
            $previewPriority.css(styles);
        }
    }

    // Apply styles after each update
    $('#ship_name, #sort_order').on('input change', function() {
        setTimeout(applyPreviewStyles, 50);
    });

    // Initial style application
    setTimeout(applyPreviewStyles, 100);

    // Form submission with loading state
    $('#editShipTypeForm').on('submit', function() {
        const $submitBtn = $('#updateBtn');
        $submitBtn.addClass('loading');
        $submitBtn.find('span').text('Updating...');
    });

    // Form submission validation
    $('#editShipTypeForm').on('submit', function(e) {
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
});

// Enhanced deletion confirmation
function confirmDeletion() {
    const shipTypeName = '{{ $shiptype->ship_name }}';

    if (confirm(`⚠️ DANGER ZONE CONFIRMATION ⚠️\n\nYou are about to permanently delete the ship type "${shipTypeName}".\n\nThis action will:\n• Remove the ship type from the system permanently\n• Affect job postings using this ship type\n• Impact candidate profiles referencing this vessel type\n• Cannot be undone\n\nAre you absolutely sure you want to proceed?\n\nType "DELETE" in the next prompt to confirm.`)) {

        const confirmText = prompt(`To confirm deletion, please type "DELETE" (all caps):`);

        if (confirmText === 'DELETE') {
            document.getElementById('deleteForm').submit();
        } else {
            alert('Deletion cancelled. The text did not match "DELETE".');
        }
    }
}
</script>
@endpush
