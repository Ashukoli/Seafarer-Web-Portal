@extends('layouts.candidate.app')
@section('content')
<main class="page-content professional-bg">
    <!--Enhanced Breadcrumb-->
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
                        <i class="bx bx-hide me-1"></i>Hide Resume
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container py-4">
        <!-- Hide Resume Section -->
        <div class="card mb-4 professional-card">
            <div class="card-header professional-header resume-privacy-header">
                <h5 class="mb-0 header-title">
                    <i class="bx bx-shield-check me-2"></i>Resume Privacy Settings
                </h5>
                <div class="header-stats">
                    <span class="stats-badge">
                        <i class="bx bx-lock me-1"></i>Privacy Control
                    </span>
                </div>
            </div>
            <div class="card-body p-4">
                <!-- Information Section -->
                <div class="info-section mb-4">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="bx bx-info-circle"></i>
                        </div>
                        <div class="info-content">
                            <h6 class="info-title">Why Hide Your Resume?</h6>
                            <p class="info-text">
                                You can hide your resume from specific companies to maintain privacy or avoid unwanted contact.
                                This is useful when you don't want certain employers to see your profile while keeping it visible to others.
                            </p>
                            <ul class="info-list">
                                <li>Your resume will be completely hidden from selected companies</li>
                                <li>You can select up to 5 companies at a time</li>
                                <li>This setting can be changed anytime</li>
                                <li>Hidden companies cannot view or download your profile</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Hide Resume Form -->
                <form method="POST" action="" id="hideResumeForm">
                    @csrf
                    <div class="form-section">
                        <div class="form-header mb-4">
                            <h6 class="section-title">
                                <i class="bx bx-buildings me-2"></i>Select Companies to Hide From
                            </h6>
                            <p class="section-subtitle">Choose up to 5 companies that should not be able to view your resume</p>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <label for="companies" class="form-label enhanced-label">
                                    <span class="label-text">
                                        <i class="bx bx-select-multiple me-2"></i>Companies
                                    </span>
                                    <small class="label-hint">Select companies from the dropdown (Maximum 5)</small>
                                </label>

                                <!-- Custom Multiselect Dropdown -->
                                <div class="multiselect-wrapper">
                                    <div class="multiselect-container" id="companiesMultiselect">
                                        <div class="multiselect-header" onclick="toggleDropdown()">
                                            <span class="selected-text">Select companies to hide from...</span>
                                            <div class="dropdown-arrow">
                                                <i class="bx bx-chevron-down"></i>
                                            </div>
                                        </div>
                                        <div class="multiselect-dropdown" id="companiesDropdown">
                                            <div class="dropdown-search">
                                                <input type="text" class="search-input" placeholder="Search companies..." onkeyup="filterCompanies(this.value)">
                                                <i class="bx bx-search search-icon"></i>
                                            </div>
                                            <div class="dropdown-options" id="companiesOptions">
                                                <div class="option-item" data-value="mas-ship-management">
                                                    <label class="option-label">
                                                        <input type="checkbox" name="companies[]" value="mas-ship-management" class="company-checkbox">
                                                        <div class="custom-checkbox">
                                                            <i class="bx bx-check"></i>
                                                        </div>
                                                        <img src="{{ asset('theme/assets/images/products/28.png') }}" alt="MAS" class="company-logo">
                                                        <span class="company-name">MAS Ship Management Pvt. Ltd</span>
                                                    </label>
                                                </div>
                                                <div class="option-item" data-value="oceanic-crew">
                                                    <label class="option-label">
                                                        <input type="checkbox" name="companies[]" value="oceanic-crew" class="company-checkbox">
                                                        <div class="custom-checkbox">
                                                            <i class="bx bx-check"></i>
                                                        </div>
                                                        <img src="{{ asset('theme/assets/images/products/100.jpg') }}" alt="Oceanic" class="company-logo">
                                                        <span class="company-name">Oceanic Crew Management</span>
                                                    </label>
                                                </div>
                                                <div class="option-item" data-value="global-maritime">
                                                    <label class="option-label">
                                                        <input type="checkbox" name="companies[]" value="global-maritime" class="company-checkbox">
                                                        <div class="custom-checkbox">
                                                            <i class="bx bx-check"></i>
                                                        </div>
                                                        <img src="{{ asset('theme/assets/images/products/download.png') }}" alt="Global" class="company-logo">
                                                        <span class="company-name">Global Maritime Services</span>
                                                    </label>
                                                </div>
                                                <div class="option-item" data-value="blue-wave-shipping">
                                                    <label class="option-label">
                                                        <input type="checkbox" name="companies[]" value="blue-wave-shipping" class="company-checkbox">
                                                        <div class="custom-checkbox">
                                                            <i class="bx bx-check"></i>
                                                        </div>
                                                        <img src="{{ asset('theme/assets/images/products/100.jpg') }}" alt="Blue Wave" class="company-logo">
                                                        <span class="company-name">Blue Wave Shipping</span>
                                                    </label>
                                                </div>
                                                <div class="option-item" data-value="ses-marine">
                                                    <label class="option-label">
                                                        <input type="checkbox" name="companies[]" value="ses-marine" class="company-checkbox">
                                                        <div class="custom-checkbox">
                                                            <i class="bx bx-check"></i>
                                                        </div>
                                                        <img src="{{ asset('theme/assets/images/products/28.png') }}" alt="SES" class="company-logo">
                                                        <span class="company-name">SES Marine Services</span>
                                                    </label>
                                                </div>
                                                <div class="option-item" data-value="tangar-ship">
                                                    <label class="option-label">
                                                        <input type="checkbox" name="companies[]" value="tangar-ship" class="company-checkbox">
                                                        <div class="custom-checkbox">
                                                            <i class="bx bx-check"></i>
                                                        </div>
                                                        <img src="{{ asset('theme/assets/images/products/download.png') }}" alt="Tangar" class="company-logo">
                                                        <span class="company-name">Tangar Ship Management Pvt. Ltd</span>
                                                    </label>
                                                </div>
                                                <div class="option-item" data-value="shreysun-global">
                                                    <label class="option-label">
                                                        <input type="checkbox" name="companies[]" value="shreysun-global" class="company-checkbox">
                                                        <div class="custom-checkbox">
                                                            <i class="bx bx-check"></i>
                                                        </div>
                                                        <img src="{{ asset('theme/assets/images/products/100.jpg') }}" alt="Shreysun" class="company-logo">
                                                        <span class="company-name">Shreysun Global Shipping Pvt. Ltd</span>
                                                    </label>
                                                </div>
                                                <div class="option-item" data-value="vr-maritime">
                                                    <label class="option-label">
                                                        <input type="checkbox" name="companies[]" value="vr-maritime" class="company-checkbox">
                                                        <div class="custom-checkbox">
                                                            <i class="bx bx-check"></i>
                                                        </div>
                                                        <img src="{{ asset('theme/assets/images/products/28.png') }}" alt="VR Maritime" class="company-logo">
                                                        <span class="company-name">VR Maritime Services Pvt. Ltd</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="selection-feedback">
                                        <div class="selected-count">
                                            <span id="selectedCount">0</span> of 5 companies selected
                                        </div>
                                        <div class="validation-message" id="validationMessage"></div>
                                    </div>
                                </div>

                                <!-- Selected Companies Display -->
                                <div class="selected-companies" id="selectedCompanies">
                                    <div class="selected-header">
                                        <h6 class="selected-title">
                                            <i class="bx bx-list-check me-2"></i>Selected Companies
                                        </h6>
                                    </div>
                                    <div class="selected-items" id="selectedItems">
                                        <div class="no-selection">
                                            <i class="bx bx-info-circle me-2"></i>
                                            No companies selected yet
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="help-sidebar">
                                    <div class="help-card">
                                        <div class="help-icon">
                                            <i class="bx bx-help-circle"></i>
                                        </div>
                                        <h6 class="help-title">Need Help?</h6>
                                        <ul class="help-list">
                                            <li>Click on the dropdown to see all companies</li>
                                            <li>Use checkboxes to select up to 5 companies</li>
                                            <li>Use the search box to find specific companies</li>
                                            <li>Selected companies will appear below the dropdown</li>
                                            <li>You can change your selections anytime</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="privacy-note">
                                    <i class="bx bx-shield-check me-2 text-success"></i>
                                    <small class="text-muted">Your privacy settings will be updated immediately</small>
                                </div>
                                <div class="action-buttons">
                                    <button type="button" class="btn btn-outline-secondary me-3" onclick="clearSelections()">
                                        <i class="bx bx-reset me-2"></i>Clear All
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="saveButton">
                                        <i class="bx bx-save me-2"></i>Save Privacy Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Current Hidden Companies -->
                <div class="current-settings mt-5 pt-4 border-top">
                    <h6 class="settings-title">
                        <i class="bx bx-eye-close me-2"></i>Currently Hidden From
                    </h6>
                    <div class="current-hidden" id="currentHidden">
                        <div class="no-hidden">
                            <i class="bx bx-info-circle me-2"></i>
                            Your resume is currently visible to all companies
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    /* Professional Background */
    .professional-bg {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        min-height: 100vh;
    }

    /* Enhanced Breadcrumb Styling */
    .enhanced-breadcrumb {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        padding: 14px 24px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    }

    .breadcrumb-link {
        color: #4f46e5;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .breadcrumb-link:hover {
        color: #3730a3;
        transform: translateX(2px);
    }

    .breadcrumb-title {
        font-weight: 600;
        color: #374151;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
    }

    .breadcrumb-item.active {
        color: #6b7280;
        font-weight: 500;
        display: flex;
        align-items: center;
    }

    /* Professional Card Styling */
    .professional-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    /* Resume Privacy Header */
    .resume-privacy-header {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border: none;
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-title {
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        margin: 0;
    }

    .header-title i {
        font-size: 1.2rem;
        opacity: 0.9;
    }

    .header-stats {
        display: flex;
        align-items: center;
    }

    .stats-badge {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: flex;
        align-items: center;
    }

    /* Information Section */
    .info-section {
        margin-bottom: 2rem;
    }

    .info-card {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 1px solid #bfdbfe;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        gap: 16px;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        background: #3b82f6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-icon i {
        color: #ffffff;
        font-size: 1.2rem;
    }

    .info-title {
        color: #1e40af;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .info-text {
        color: #1e3a8a;
        margin-bottom: 12px;
        line-height: 1.6;
    }

    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .info-list li {
        color: #1e40af;
        padding: 4px 0;
        display: flex;
        align-items: center;
    }

    .info-list li::before {
        content: '✓';
        color: #059669;
        font-weight: bold;
        margin-right: 8px;
    }

    /* Form Section */
    .form-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .section-title {
        color: #1e293b;
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .section-subtitle {
        color: #64748b;
        font-size: 0.9rem;
        margin: 0;
    }

    /* Enhanced Labels */
    .enhanced-label {
        display: flex;
        flex-direction: column;
        margin-bottom: 0.75rem;
    }

    .label-text {
        font-weight: 600;
        color: #1e293b;
        font-size: 1rem;
        display: flex;
        align-items: center;
        margin-bottom: 0.25rem;
    }

    .label-hint {
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 400;
        margin-top: 0.25rem;
    }

    /* Multiselect Dropdown */
    .multiselect-wrapper {
        position: relative;
        width: 100%;
    }

    .multiselect-container {
        position: relative;
        width: 100%;
    }

    .multiselect-header {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 16px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
        min-height: 52px;
    }

    .multiselect-header:hover {
        border-color: #cbd5e1;
        background: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .multiselect-header.active {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        background: #ffffff;
    }

    .selected-text {
        color: #64748b;
        font-weight: 500;
        flex: 1;
        display: flex;
        align-items: center;
    }

    .selected-text.has-selection {
        color: #374151;
    }

    .dropdown-arrow {
        color: #64748b;
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }

    .dropdown-arrow.rotated {
        transform: rotate(180deg);
    }

    .multiselect-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #ffffff;
        border: 2px solid #e2e8f0;
        border-top: none;
        border-radius: 0 0 12px 12px;
        max-height: 300px;
        overflow: hidden;
        z-index: 1000;
        display: none;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .multiselect-dropdown.show {
        display: block;
        animation: slideDown 0.3s ease-out;
    }

    .dropdown-search {
        padding: 12px;
        border-bottom: 1px solid #e2e8f0;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 8px 35px 8px 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.9rem;
        outline: none;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }

    .search-icon {
        position: absolute;
        right: 22px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 1rem;
    }

    .dropdown-options {
        max-height: 240px;
        overflow-y: auto;
    }

    .option-item {
        border-bottom: 1px solid #f1f5f9;
    }

    .option-item:last-child {
        border-bottom: none;
    }

    .option-label {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin: 0;
        gap: 12px;
    }

    .option-label:hover {
        background: #f8fafc;
    }

    .company-checkbox {
        display: none;
    }

    .custom-checkbox {
        width: 20px;
        height: 20px;
        border: 2px solid #d1d5db;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .custom-checkbox i {
        color: #ffffff;
        font-size: 0.8rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .company-checkbox:checked + .custom-checkbox {
        background: #3b82f6;
        border-color: #3b82f6;
    }

    .company-checkbox:checked + .custom-checkbox i {
        opacity: 1;
    }

    .company-logo {
        width: 32px;
        height: 32px;
        object-fit: contain;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        padding: 2px;
        background: #fafafa;
        flex-shrink: 0;
    }

    .company-name {
        color: #374151;
        font-weight: 500;
        font-size: 0.9rem;
        flex: 1;
    }

    /* Selection Feedback */
    .selection-feedback {
        margin-top: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .selected-count {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .validation-message {
        color: #dc2626;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .validation-message.success {
        color: #059669;
    }

    /* Selected Companies Display */
    .selected-companies {
        margin-top: 20px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px;
    }

    .selected-header {
        margin-bottom: 12px;
    }

    .selected-title {
        color: #374151;
        font-weight: 600;
        font-size: 1rem;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .selected-items {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .no-selection {
        color: #9ca3af;
        font-size: 0.9rem;
        font-style: italic;
        display: flex;
        align-items: center;
        padding: 12px 0;
    }

    .selected-item {
        background: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 8px 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .selected-item:hover {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .selected-item .company-logo {
        width: 24px;
        height: 24px;
    }

    .selected-item .company-name {
        font-size: 0.85rem;
    }

    .remove-item {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.7rem;
        transition: all 0.3s ease;
    }

    .remove-item:hover {
        background: #dc2626;
        color: #ffffff;
    }

    /* Help Sidebar */
    .help-sidebar {
        padding-left: 20px;
    }

    .help-card {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 20px;
    }

    .help-icon {
        width: 40px;
        height: 40px;
        background: #059669;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .help-icon i {
        color: #ffffff;
        font-size: 1.2rem;
    }

    .help-title {
        color: #065f46;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .help-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .help-list li {
        color: #047857;
        padding: 6px 0;
        font-size: 0.9rem;
        display: flex;
        align-items: flex-start;
    }

    .help-list li::before {
        content: '•';
        color: #059669;
        font-weight: bold;
        margin-right: 8px;
        margin-top: 2px;
    }

    /* Form Actions */
    .form-actions {
        background: #f9fafb;
        border-radius: 8px;
        padding: 20px;
        margin: 0 -20px -20px -20px;
    }

    .privacy-note {
        display: flex;
        align-items: center;
        color: #059669;
        font-weight: 500;
    }

    .action-buttons {
        display: flex;
        align-items: center;
    }

    .btn {
        padding: 10px 20px;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .btn-outline-secondary {
        color: #6b7280;
        border: 2px solid #6b7280;
    }

    .btn-outline-secondary:hover {
        background: #6b7280;
        color: #ffffff;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border: none;
        color: #ffffff;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    /* Current Settings */
    .current-settings {
        background: #f1f5f9;
        border-radius: 8px;
        padding: 20px;
        margin: 0 -20px -20px -20px;
    }

    .settings-title {
        color: #334155;
        font-weight: 600;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
    }

    .no-hidden {
        color: #64748b;
        font-style: italic;
        display: flex;
        align-items: center;
        padding: 12px 0;
    }

    /* Animations */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 767.98px) {
        .professional-bg {
            background: #f8fafc;
        }

        .info-card {
            flex-direction: column;
            text-align: center;
        }

        .help-sidebar {
            padding-left: 0;
            margin-top: 20px;
        }

        .form-actions {
            padding: 16px;
            margin: 20px -16px -16px -16px;
        }

        .form-actions .d-flex {
            flex-direction: column;
            gap: 16px;
            text-align: center;
        }

        .action-buttons {
            justify-content: center;
        }

        .breadcrumb-title {
            font-size: 1rem;
        }

        .enhanced-breadcrumb {
            padding: 12px 16px;
        }

        .resume-privacy-header {
            padding: 16px 20px;
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }

        .header-title {
            font-size: 1rem;
        }

        .current-settings {
            margin: 20px -16px -16px -16px;
            padding: 16px;
        }
    }

    /* Focus states for accessibility */
    .multiselect-header:focus,
    .search-input:focus,
    .btn:focus {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
    }

    .breadcrumb-link:focus {
        outline: 2px solid #4f46e5;
        outline-offset: 2px;
        border-radius: 4px;
    }

    /* Scrollbar styling */
    .dropdown-options::-webkit-scrollbar {
        width: 6px;
    }

    .dropdown-options::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    .dropdown-options::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    .dropdown-options::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<script>
let selectedCompanies = [];
const maxSelections = 5;

// Toggle dropdown visibility
function toggleDropdown() {
    const dropdown = document.getElementById('companiesDropdown');
    const arrow = document.querySelector('.dropdown-arrow');
    const header = document.querySelector('.multiselect-header');

    if (dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
        arrow.classList.remove('rotated');
        header.classList.remove('active');
    } else {
        dropdown.classList.add('show');
        arrow.classList.add('rotated');
        header.classList.add('active');
    }
}

// Filter companies based on search
function filterCompanies(searchTerm) {
    const options = document.querySelectorAll('.option-item');
    searchTerm = searchTerm.toLowerCase();

    options.forEach(option => {
        const companyName = option.querySelector('.company-name').textContent.toLowerCase();
        if (companyName.includes(searchTerm)) {
            option.style.display = 'block';
        } else {
            option.style.display = 'none';
        }
    });
}

// Handle company selection
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.company-checkbox');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            handleCompanySelection(this);
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const multiselect = document.getElementById('companiesMultiselect');
        if (!multiselect.contains(e.target)) {
            const dropdown = document.getElementById('companiesDropdown');
            const arrow = document.querySelector('.dropdown-arrow');
            const header = document.querySelector('.multiselect-header');

            dropdown.classList.remove('show');
            arrow.classList.remove('rotated');
            header.classList.remove('active');
        }
    });

    // Form submission
    const form = document.getElementById('hideResumeForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        if (selectedCompanies.length === 0) {
            alert('Please select at least one company to hide your resume from.');
            return;
        }

        // Show loading state
        const saveButton = document.getElementById('saveButton');
        const originalText = saveButton.innerHTML;
        saveButton.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i>Saving...';
        saveButton.disabled = true;

        // Simulate form submission (replace with actual form submission)
        setTimeout(() => {
            saveButton.innerHTML = '<i class="bx bx-check me-2"></i>Saved Successfully!';
            setTimeout(() => {
                saveButton.innerHTML = originalText;
                saveButton.disabled = false;

                // Show success message
                const validationMessage = document.getElementById('validationMessage');
                validationMessage.textContent = 'Privacy settings updated successfully!';
                validationMessage.classList.add('success');

                setTimeout(() => {
                    validationMessage.textContent = '';
                    validationMessage.classList.remove('success');
                }, 3000);

            }, 2000);
        }, 1500);
    });
});

function handleCompanySelection(checkbox) {
    const optionItem = checkbox.closest('.option-item');
    const companyValue = checkbox.value;
    const companyName = optionItem.querySelector('.company-name').textContent;
    const companyLogo = optionItem.querySelector('.company-logo').src;

    if (checkbox.checked) {
        // Check if we can add more selections
        if (selectedCompanies.length >= maxSelections) {
            checkbox.checked = false;
            showValidationMessage(`You can only select up to ${maxSelections} companies.`);
            return;
        }

        // Add to selected companies
        selectedCompanies.push({
            value: companyValue,
            name: companyName,
            logo: companyLogo
        });
    } else {
        // Remove from selected companies
        selectedCompanies = selectedCompanies.filter(company => company.value !== companyValue);
    }

    updateSelectedDisplay();
    updateHeaderText();
    updateSelectedCount();
}

function updateSelectedDisplay() {
    const selectedItems = document.getElementById('selectedItems');

    if (selectedCompanies.length === 0) {
        selectedItems.innerHTML = `
            <div class="no-selection">
                <i class="bx bx-info-circle me-2"></i>
                No companies selected yet
            </div>
        `;
    } else {
        selectedItems.innerHTML = selectedCompanies.map(company => `
            <div class="selected-item">
                <img src="${company.logo}" alt="${company.name}" class="company-logo">
                <span class="company-name">${company.name}</span>
                <button type="button" class="remove-item" onclick="removeCompany('${company.value}')">
                    <i class="bx bx-x"></i>
                </button>
            </div>
        `).join('');
    }
}

function updateHeaderText() {
    const selectedText = document.querySelector('.selected-text');

    if (selectedCompanies.length === 0) {
        selectedText.textContent = 'Select companies to hide from...';
        selectedText.classList.remove('has-selection');
    } else if (selectedCompanies.length === 1) {
        selectedText.textContent = `${selectedCompanies[0].name}`;
        selectedText.classList.add('has-selection');
    } else {
        selectedText.textContent = `${selectedCompanies.length} companies selected`;
        selectedText.classList.add('has-selection');
    }
}

function updateSelectedCount() {
    const selectedCount = document.getElementById('selectedCount');
    selectedCount.textContent = selectedCompanies.length;

    // Clear validation message if within limits
    if (selectedCompanies.length <= maxSelections) {
        const validationMessage = document.getElementById('validationMessage');
        validationMessage.textContent = '';
        validationMessage.classList.remove('success');
    }
}

function removeCompany(companyValue) {
    // Uncheck the checkbox
    const checkbox = document.querySelector(`input[value="${companyValue}"]`);
    if (checkbox) {
        checkbox.checked = false;
    }

    // Remove from selected companies
    selectedCompanies = selectedCompanies.filter(company => company.value !== companyValue);

    updateSelectedDisplay();
    updateHeaderText();
    updateSelectedCount();
}

function clearSelections() {
    // Uncheck all checkboxes
    const checkboxes = document.querySelectorAll('.company-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });

    // Clear selected companies array
    selectedCompanies = [];

    updateSelectedDisplay();
    updateHeaderText();
    updateSelectedCount();

    const validationMessage = document.getElementById('validationMessage');
    validationMessage.textContent = 'All selections cleared.';
    validationMessage.classList.add('success');

    setTimeout(() => {
        validationMessage.textContent = '';
        validationMessage.classList.remove('success');
    }, 2000);
}

function showValidationMessage(message) {
    const validationMessage = document.getElementById('validationMessage');
    validationMessage.textContent = message;
    validationMessage.classList.remove('success');

    setTimeout(() => {
        validationMessage.textContent = '';
    }, 3000);
}
</script>
@endsection
