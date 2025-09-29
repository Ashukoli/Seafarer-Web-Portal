@extends('layouts.candidate.app')
@section('content')
<main class="page-content professional-bg">
    <!--Breadcrumb (unchanged)-->
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

    <div class="container py-4">
        <div class="card mb-4 professional-card">
            <div class="card-header professional-header resume-privacy-header">
                <h5 class="mb-0 header-title"><i class="bx bx-shield-check me-2"></i>Resume Privacy Settings</h5>
                <div class="header-stats"><span class="stats-badge"><i class="bx bx-lock me-1"></i>Privacy Control</span></div>
            </div>

            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('candidate.resume.hide') }}" id="hideResumeForm">
                    @csrf

                    <div class="form-header mb-4">
                        <h6 class="section-title"><i class="bx bx-buildings me-2"></i>Select Companies to Hide From</h6>
                        <p class="section-subtitle">Choose up to 5 companies that should not be able to view your resume</p>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <label class="form-label enhanced-label">
                                <span class="label-text"><i class="bx bx-select-multiple me-2"></i>Companies</span>
                                <small class="label-hint">Select companies from the dropdown (Maximum 5)</small>
                            </label>

                            <div class="multiselect-wrapper">
                                <div class="multiselect-container" id="companiesMultiselect">
                                    <div class="multiselect-header" onclick="toggleDropdown()">
                                        <span class="selected-text" id="headerSelected">Select companies to hide from...</span>
                                        <div class="dropdown-arrow"><i class="bx bx-chevron-down"></i></div>
                                    </div>

                                    <div class="multiselect-dropdown" id="companiesDropdown">
                                        <div class="dropdown-search">
                                            <input type="text" class="search-input" placeholder="Search companies..." onkeyup="filterCompanies(this.value)">
                                            <i class="bx bx-search search-icon"></i>
                                        </div>

                                        <div class="dropdown-options" id="companiesOptions">
                                            @foreach($companies as $company)
                                                @php
                                                    $cid = $company->id;
                                                    $checked = in_array($cid, $hiddenCompanies ?? []) ? 'checked' : '';
                                                    $logo = $company->company_logo ?? $company->logo ?? null;
                                                    // use company_logo folder inside public/theme/assets/images; accept absolute URLs or leading-slash paths
                                                    if ($logo) {
                                                        $logoUrl = \Illuminate\Support\Str::startsWith($logo, ['http', '/'])
                                                            ? $logo
                                                            : asset('theme/assets/images/company_logo/' . ltrim($logo, '/'));
                                                    } else {
                                                        $logoUrl = asset('theme/assets/images/company_logo/default.png');
                                                    }
                                                @endphp
                                                <div class="option-item" data-value="{{ $cid }}" data-logo-url="{{ $logoUrl }}">
                                                    <label class="option-label">
                                                        <input type="checkbox"
                                                               name="companies[]"
                                                               value="{{ $cid }}"
                                                               class="company-checkbox"
                                                               data-id="{{ $cid }}"
                                                               {{ $checked }}>
                                                        <div class="custom-checkbox"><i class="bx bx-check"></i></div>
                                                        <img src="{{ $logoUrl }}" alt="{{ $company->company_name ?? $company->name }}" class="company-logo">
                                                        <span class="company-name">{{ $company->company_name ?? $company->name }}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="selection-feedback">
                                    <div class="selected-count">
                                        <span id="selectedCount">{{ count($hiddenCompanies ?? []) }}</span> of 5 companies selected
                                    </div>
                                    <div class="validation-message" id="validationMessage"></div>
                                </div>
                            </div>

                            @error('companies')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <div class="help-sidebar">
                                <div class="help-card">
                                    <div class="help-icon"><i class="bx bx-help-circle"></i></div>
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

                    <div class="selected-companies mt-4" id="selectedCompanies">
                        <div class="selected-header">
                            <h6 class="selected-title"><i class="bx bx-list-check me-2"></i>Selected Companies</h6>
                        </div>
                        <div class="selected-items" id="selectedItems"></div>
                    </div>

                    <div class="form-actions mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="privacy-note"><i class="bx bx-shield-check me-2 text-success"></i><small class="text-muted">Your privacy settings will be updated immediately</small></div>
                            <div class="action-buttons">
                                <button type="button" class="btn btn-outline-secondary me-3" onclick="clearSelections()"><i class="bx bx-reset me-2"></i>Clear All</button>
                                <button type="submit" class="btn btn-primary" id="saveButton"><i class="bx bx-save me-2"></i>Save Privacy Settings</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="current-settings mt-5 pt-4 border-top">
                    <h6 class="settings-title"><i class="bx bx-eye-close me-2"></i>Currently Hidden From</h6>
                    <div class="current-hidden" id="currentHidden"></div>
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
    const maxSelections = 5;
    const companies = @json($companies);
    const initialHidden = @json($hiddenCompanies ?? []);
    // base path for relative company logo filenames stored in company_logo column
    const baseLogoPath = "{{ asset('theme/assets/images/company_logo') }}";

    let selectedCompanies = initialHidden.map(Number);

    // when building JS image src, prefer absolute/leading-slash values; otherwise prepend baseLogoPath
    function resolveLogoPath(raw) {
        if (!raw) return baseLogoPath + '/default.png';
        try {
            if (raw.startsWith('http') || raw.startsWith('/')) return raw;
        } catch(e) {}
        return baseLogoPath + '/' + raw.replace(/^\/+/, '');
    }

    function toggleDropdown() {
        const dd = document.getElementById('companiesDropdown');
        const arrow = document.querySelector('.dropdown-arrow');
        const header = document.querySelector('.multiselect-header');
        dd.classList.toggle('show');
        arrow.classList.toggle('rotated');
        header.classList.toggle('active');
    }

    function filterCompanies(term) {
        term = term.trim().toLowerCase();
        document.querySelectorAll('.option-item').forEach(opt => {
            const name = opt.querySelector('.company-name').textContent.toLowerCase();
            opt.style.display = name.includes(term) ? 'block' : 'none';
        });
    }

    function updateHeaderText() {
        const header = document.getElementById('headerSelected');
        if (selectedCompanies.length === 0) {
            header.textContent = 'Select companies to hide from...';
        } else if (selectedCompanies.length === 1) {
            const c = companies.find(x => x.id === selectedCompanies[0]);
            header.textContent = c ? (c.company_name || c.name) : '1 company selected';
        } else {
            header.textContent = `${selectedCompanies.length} companies selected`;
        }
        document.getElementById('selectedCount').textContent = selectedCompanies.length;
    }

    function updateSelectedDisplay() {
        const container = document.getElementById('selectedItems');
        const currentHidden = document.getElementById('currentHidden');
        if (selectedCompanies.length === 0) {
            const no = `<div class="no-selection"><i class="bx bx-info-circle me-2"></i>No companies selected</div>`;
            container.innerHTML = no;
            currentHidden.innerHTML = `<div class="no-hidden"><i class="bx bx-info-circle me-2"></i>Your resume is currently visible to all companies</div>`;
            return;
        }

        const html = selectedCompanies.map(id => {
            const c = companies.find(x => x.id === id);
            if (!c) return '';
            const rawLogo = c.company_logo || c.logo || null;
            const logo = resolveLogoPath(rawLogo);
            return `
                <div class="selected-item">
                    <img src="${logo}" alt="${c.company_name || c.name}" class="company-logo">
                    <span class="company-name">${c.company_name || c.name}</span>
                    <button type="button" class="remove-item" onclick="removeCompany(${id})"><i class="bx bx-x"></i></button>
                </div>
            `;
        }).join('');
        container.innerHTML = html;
        currentHidden.innerHTML = html;
    }

    function handleCheckboxChange(cb) {
        const id = Number(cb.value);
        if (cb.checked) {
            if (selectedCompanies.length >= maxSelections) {
                cb.checked = false;
                showValidationMessage(`You can only select up to ${maxSelections} companies.`);
                return;
            }
            if (!selectedCompanies.includes(id)) selectedCompanies.push(id);
        } else {
            selectedCompanies = selectedCompanies.filter(i => i !== id);
        }
        updateSelectedDisplay();
        updateHeaderText();
    }

    function removeCompany(id) {
        const cb = document.querySelector(`.company-checkbox[data-id="${id}"]`);
        if (cb) cb.checked = false;
        selectedCompanies = selectedCompanies.filter(i => i !== id);
        updateSelectedDisplay();
        updateHeaderText();
    }

    function clearSelections() {
        selectedCompanies = [];
        document.querySelectorAll('.company-checkbox').forEach(cb => cb.checked = false);
        updateSelectedDisplay();
        updateHeaderText();
    }

    function showValidationMessage(msg) {
        const el = document.getElementById('validationMessage');
        el.textContent = msg;
        setTimeout(()=> el.textContent = '', 3000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        // wire existing checkboxes and initial UI
        document.querySelectorAll('.company-checkbox').forEach(cb => {
            const id = Number(cb.value);
            // ensure checkbox state matches initialHidden (in case server set)
            if (initialHidden.includes(id)) cb.checked = true;
            cb.addEventListener('change', function() { handleCheckboxChange(this); });
        });

        updateHeaderText();
        updateSelectedDisplay();

        // validate on submit (server still validates)
        document.getElementById('hideResumeForm').addEventListener('submit', function(e) {
            if (selectedCompanies.length > maxSelections) {
                e.preventDefault();
                showValidationMessage(`You can only select up to ${maxSelections} companies.`);
                return false;
            }
            // allow form submit; selected checkboxes already present in DOM
        });

        // close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const multiselect = document.getElementById('companiesMultiselect');
            if (!multiselect.contains(e.target)) {
                document.getElementById('companiesDropdown').classList.remove('show');
                document.querySelector('.dropdown-arrow').classList.remove('rotated');
                document.querySelector('.multiselect-header').classList.remove('active');
            }
        });
    });
</script>
@endsection
