{{-- filepath: resources/views/admin/company/banners/index.blade.php --}}
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
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-image"></i>
                            </div>
                            <span class="breadcrumb-text">Company Banners</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Filter/Search Form -->
        <form method="GET" class="row g-3 align-items-end mb-4">
            <div class="col-md-4">
                <label for="company" class="form-label">Search by Company</label>
                <input type="text" name="company" id="company" class="form-control"
                       value="{{ request('company') }}" placeholder="Enter company name">
            </div>
            <div class="col-md-4">
                <label for="section" class="form-label">Filter by Banner Section</label>
                <select name="section" id="section" class="form-select">
                    <option value="">All Sections</option>
                    <option value="FEATURED" {{ request('section') == 'FEATURED' ? 'selected' : '' }}>FEATURED</option>
                    <option value="TOP LISTED" {{ request('section') == 'TOP LISTED' ? 'selected' : '' }}>TOP LISTED</option>
                    <option value="LISTED" {{ request('section') == 'LISTED' ? 'selected' : '' }}>LISTED</option>
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-search"></i> Search
                </button>
                <a href="{{ route('admin.company.banners.index') }}" class="btn btn-secondary">
                    <i class="bx bx-reset"></i> Reset
                </a>
            </div>
        </form>

        <!-- Banners Section -->
        <div class="enterprise-section">
            <div class="section-header-wrapper">
                <div class="section-header-content">
                    <div class="section-icon-badge banners-badge">
                        <i class="bx bx-image-alt"></i>
                    </div>
                    <div class="section-title-group">
                        <h2 class="section-primary-title">Company Advertisement Banners</h2>
                        <p class="section-description">Overview of all company promotional banners and their status</p>
                    </div>
                </div>
                <div class="banners-summary">
                    <div class="summary-stat">
                        <span class="stat-number">{{ $banners->count() }}</span>
                        <span class="stat-label">Total Banners</span>
                    </div>
                </div>
            </div>

            <div class="professional-table-wrapper">
                <div class="table-container">
                    <table class="enterprise-data-table">
                        <thead class="table-header-section">
                            <tr>
                                <th class="table-header-cell no-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-hash header-icon"></i>
                                        <span>No.</span>
                                    </div>
                                </th>
                                <th class="table-header-cell order-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-sort header-icon"></i>
                                        <span>Banner Order</span>
                                    </div>
                                </th>
                                <th class="table-header-cell section-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-layout header-icon"></i>
                                        <span>Banner Section</span>
                                    </div>
                                </th>
                                <th class="table-header-cell company-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-buildings header-icon"></i>
                                        <span>Company</span>
                                    </div>
                                </th>
                                <th class="table-header-cell image-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-image header-icon"></i>
                                        <span>Banner Image</span>
                                    </div>
                                </th>
                                <th class="table-header-cell status-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-check-shield header-icon"></i>
                                        <span>Status</span>
                                    </div>
                                </th>
                                <th class="table-header-cell actions-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-cog header-icon"></i>
                                        <span>Actions</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-body-section">
                            @forelse($banners as $i => $banner)
                                <tr class="table-data-row">
                                    <td class="table-data-cell no-cell">
                                        <div class="number-display">
                                            <span class="row-number">{{ $i + 1 }}</span>
                                        </div>
                                    </td>
                                    <td class="table-data-cell order-cell">
                                        <div class="order-display">
                                            <div class="order-badge">
                                                <i class="bx bx-sort-alt-2"></i>
                                                <span class="order-number">{{ $banner->order }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell section-cell">
                                        <div class="section-display">
                                            <div class="section-tag">
                                                <i class="bx bx-layout"></i>
                                                <span class="section-name">{{ $banner->section }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell company-cell">
                                        <div class="company-display">
                                            <div class="company-avatar">
                                                <i class="bx bx-buildings"></i>
                                            </div>
                                            <div class="company-info">
                                                <div class="company-name">{{ $banner->company->company_name ?? 'N/A' }}</div>
                                                <div class="company-type">Client</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell image-cell">
                                        <div class="banner-image-display">
                                            @if($banner->image)
                                                <div class="image-container">
                                                    <img src="{{ asset('theme/assets/images/company_banner/' . $banner->image) }}"
                                                         alt="Banner Image"
                                                         class="banner-thumbnail"
                                                         onclick="openImageModal('{{ asset('theme/assets/images/company_banner/' . $banner->image) }}', '{{ $banner->company->company_name ?? 'Banner' }}')"
                                                         title="Click to view full image">
                                                    <div class="image-overlay">
                                                        <i class="bx bx-expand"></i>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="no-image-placeholder">
                                                    <i class="bx bx-image-add"></i>
                                                    <span>No Image</span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-data-cell status-cell">
                                        <div class="status-display">
                                            @php
                                                $statusClass = match(strtolower($banner->status)) {
                                                    'active' => 'status-active',
                                                    'inactive' => 'status-inactive',
                                                    'pending' => 'status-pending',
                                                    default => 'status-default'
                                                };
                                                $statusIcon = match(strtolower($banner->status)) {
                                                    'active' => 'bx-check-circle',
                                                    'inactive' => 'bx-x-circle',
                                                    'pending' => 'bx-time-five',
                                                    default => 'bx-help-circle'
                                                };
                                            @endphp
                                            <div class="status-badge {{ $statusClass }}">
                                                <i class="bx {{ $statusIcon }}"></i>
                                                <span>{{ ucfirst($banner->status) }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell actions-cell">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('admin.company.edit', $banner->company_id) }}"
                                               class="action-button edit-button"
                                               data-tooltip="Edit Company">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <button class="action-button view-button"
                                                    data-tooltip="View Details"
                                                    onclick="viewBannerDetails({{ json_encode($banner) }})">
                                                <i class="bx bx-show"></i>
                                            </button>
                                            <form action="#" method="POST" style="display:inline;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        class="action-button delete-button disabled"
                                                        data-tooltip="Delete Banner (Disabled)"
                                                        disabled>
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-state-row">
                                    <td colspan="7" class="empty-state-cell">
                                        <div class="professional-empty-state">
                                            <div class="empty-state-icon banners-empty-icon">
                                                <i class="bx bx-image"></i>
                                            </div>
                                            <h3 class="empty-state-title">No Banners Found</h3>
                                            <p class="empty-state-message">Start promoting companies by adding advertisement banners.</p>

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

    <!-- Image Modal -->
    <div id="imageModal" class="image-modal" onclick="closeImageModal()">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Banner Image</h5>
                <button class="modal-close" onclick="closeImageModal()">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Banner Image" class="modal-image">
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
    background: linear-gradient(90deg, #7c3aed 0%, var(--primary-color) 100%);
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
    background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
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

/* Enterprise Section */
.enterprise-section {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-elevated);
    border: 1px solid var(--border-primary);
    overflow: hidden;
    transition: var(--transition-medium);
}

.enterprise-section:hover {
    box-shadow: var(--shadow-floating);
}

.section-header-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-lg) var(--spacing-xl);
    background: linear-gradient(135deg, #f1f5f9 0%, #f8fafc 100%);
    border-bottom: 1px solid var(--border-primary);
}

.section-header-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
}

.section-icon-badge {
    width: 48px;
    height: 48px;
    border-radius: var(--border-radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    border: 2px solid;
}

.banners-badge {
    background: rgba(124, 58, 237, 0.1);
    color: #7c3aed;
    border-color: rgba(124, 58, 237, 0.2);
}

.section-title-group {
    flex: 1;
}

.section-primary-title {
    margin: 0 0 0.25rem 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.3;
}

.section-description {
    margin: 0;
    font-size: 0.875rem;
    color: var(--text-secondary);
    line-height: 1.4;
}

/* Banners Summary */
.banners-summary {
    display: flex;
    gap: var(--spacing-lg);
}

.summary-stat {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: #7c3aed;
    line-height: 1.2;
}

.stat-label {
    display: block;
    font-size: 0.75rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-top: 0.25rem;
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

.btn-primary {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.btn-primary:hover {
    background: var(--primary-hover);
    border-color: var(--primary-hover);
    color: white;
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

/* Professional Table */
.professional-table-wrapper {
    background: var(--surface-elevated);
}

.table-container {
    overflow-x: auto;
}

.enterprise-data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}

.table-header-section {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.table-header-cell {
    padding: 1.25rem 1rem;
    text-align: left;
    font-weight: 700;
    color: var(--text-primary);
    font-size: 0.8125rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid var(--border-primary);
    white-space: nowrap;
}

.header-cell-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
}

.header-icon {
    color: #7c3aed;
    font-size: 1rem;
}

/* Column Sizing */
.no-column { width: 8%; }
.order-column { width: 12%; }
.section-column { width: 15%; }
.company-column { width: 20%; }
.image-column { width: 20%; }
.status-column { width: 12%; }
.actions-column { width: 13%; }

.table-body-section {
    background: var(--surface-elevated);
}

.table-data-row {
    transition: var(--transition-fast);
    border-bottom: 1px solid rgba(226, 232, 240, 0.5);
}

.table-data-row:hover {
    background: rgba(248, 250, 252, 0.8);
}

.table-data-cell {
    padding: 1rem;
    vertical-align: middle;
    color: var(--text-primary);
}

/* Number Display */
.number-display {
    display: flex;
    justify-content: center;
}

.row-number {
    width: 32px;
    height: 32px;
    background: var(--primary-light);
    color: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
}

/* Order Display */
.order-display {
    display: flex;
    justify-content: center;
}

.order-badge {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    background: rgba(8, 145, 178, 0.1);
    color: var(--info-color);
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    border: 1px solid rgba(8, 145, 178, 0.2);
}

.order-number {
    font-size: 0.875rem;
}

/* Section Display */
.section-display {
    display: flex;
    justify-content: center;
}

.section-tag {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    background: rgba(124, 58, 237, 0.1);
    color: #7c3aed;
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    border: 1px solid rgba(124, 58, 237, 0.2);
}

.section-name {
    font-size: 0.875rem;
}

/* Company Display */
.company-display {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
}

.company-avatar {
    width: 36px;
    height: 36px;
    background: var(--info-light);
    color: var(--info-color);
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    border: 2px solid rgba(8, 145, 178, 0.2);
    flex-shrink: 0;
}

.company-info {
    flex: 1;
}

.company-name {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
    margin-bottom: 0.125rem;
}

.company-type {
    font-size: 0.75rem;
    color: var(--text-muted);
    line-height: 1.2;
}

/* Banner Image Display */
.banner-image-display {
    display: flex;
    justify-content: center;
    align-items: center;
}

.image-container {
    position: relative;
    cursor: pointer;
    border-radius: var(--border-radius-sm);
    overflow: hidden;
    transition: var(--transition-fast);
}

.image-container:hover {
    transform: scale(1.05);
    box-shadow: var(--shadow-medium);
}

.banner-thumbnail {
    width: 120px;
    height: 60px;
    object-fit: cover;
    border-radius: var(--border-radius-sm);
    border: 2px solid var(--border-primary);
    transition: var(--transition-fast);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition-fast);
    color: white;
    font-size: 1.25rem;
}

.image-container:hover .image-overlay {
    opacity: 1;
}

.no-image-placeholder {
    width: 120px;
    height: 60px;
    background: var(--secondary-light);
    border: 2px dashed var(--border-primary);
    border-radius: var(--border-radius-sm);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 0.25rem;
    color: var(--text-muted);
}

.no-image-placeholder i {
    font-size: 1.25rem;
}

.no-image-placeholder span {
    font-size: 0.75rem;
    font-weight: 500;
}

/* Status Display */
.status-display {
    display: flex;
    justify-content: center;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border: 1px solid;
}

.status-active {
    background: var(--success-light);
    color: var(--success-color);
    border-color: rgba(5, 150, 105, 0.2);
}

.status-inactive {
    background: var(--danger-light);
    color: var(--danger-color);
    border-color: rgba(220, 38, 38, 0.2);
}

.status-pending {
    background: var(--warning-light);
    color: var(--warning-color);
    border-color: rgba(217, 119, 6, 0.2);
}

.status-default {
    background: var(--secondary-light);
    color: var(--secondary-color);
    border-color: rgba(100, 116, 139, 0.2);
}

/* Action Buttons */
.action-buttons-group {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    justify-content: center;
}

.action-button {
    width: 36px;
    height: 36px;
    border-radius: var(--border-radius-sm);
    border: 2px solid;
    background: var(--surface-elevated);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition-fast);
    text-decoration: none;
}

.edit-button {
    color: var(--warning-color);
    border-color: rgba(217, 119, 6, 0.3);
}

.edit-button:hover {
    background: var(--warning-light);
    border-color: var(--warning-color);
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

.view-button {
    color: var(--info-color);
    border-color: rgba(8, 145, 178, 0.3);
}

.view-button:hover {
    background: var(--info-light);
    border-color: var(--info-color);
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

.delete-button {
    color: var(--danger-color);
    border-color: rgba(220, 38, 38, 0.3);
}

.delete-button:hover:not(.disabled) {
    background: var(--danger-light);
    border-color: var(--danger-color);
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

.delete-button.disabled {
    opacity: 0.5;
    cursor: not-allowed;
    color: var(--text-muted);
    border-color: var(--border-primary);
}

/* Professional Empty State */
.professional-empty-state {
    text-align: center;
    padding: var(--spacing-2xl) var(--spacing-md);
    max-width: 480px;
    margin: 0 auto;
}

.empty-state-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto var(--spacing-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 2.5rem;
}

.banners-empty-icon {
    background: rgba(124, 58, 237, 0.1);
    color: #7c3aed;
}

.empty-state-title {
    margin: 0 0 var(--spacing-md) 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
}

.empty-state-message {
    margin: 0 0 var(--spacing-lg) 0;
    color: var(--text-secondary);
    line-height: 1.6;
    font-size: 0.9375rem;
}

/* Image Modal */
.image-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    backdrop-filter: blur(4px);
}

.modal-content {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-md);
    max-width: 90vw;
    max-height: 90vh;
    overflow: hidden;
    box-shadow: var(--shadow-floating);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-md) var(--spacing-lg);
    border-bottom: 1px solid var(--border-primary);
}

.modal-title {
    margin: 0;
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: var(--border-radius-sm);
    transition: var(--transition-fast);
    color: var(--text-secondary);
}

.modal-close:hover {
    background: var(--secondary-light);
    color: var(--text-primary);
}

.modal-body {
    padding: var(--spacing-lg);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-image {
    max-width: 100%;
    max-height: 70vh;
    object-fit: contain;
    border-radius: var(--border-radius-sm);
}

/* Tooltips */
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
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: var(--border-radius-sm);
    font-size: 0.75rem;
    font-weight: 500;
    white-space: nowrap;
    z-index: 1000;
    opacity: 1;
    animation: tooltipFadeIn 0.2s ease-out;
}

@keyframes tooltipFadeIn {
    from {
        opacity: 0;
        transform: translateX(-50%) translateY(4px);
    }
    to {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .section-header-wrapper {
        flex-direction: column;
        gap: var(--spacing-lg);
        align-items: flex-start;
    }

    .compact-header-card {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-md);
    }

    .compact-header-actions {
        align-self: stretch;
    }

    .enterprise-btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .professional-bg {
        padding: var(--spacing-md) 0;
    }

    .compact-header-card {
        padding: var(--spacing-md);
    }

    .compact-header-content {
        gap: var(--spacing-sm);
    }

    .compact-header-icon {
        width: 40px;
        height: 40px;
        font-size: 1.25rem;
    }

    .compact-page-title {
        font-size: 1.125rem;
    }

    .table-header-cell,
    .table-data-cell {
        padding: var(--spacing-sm);
        font-size: 0.8125rem;
    }

    .company-display {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-xs);
    }

    .action-buttons-group {
        flex-direction: column;
        gap: 0.25rem;
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

    .banner-thumbnail {
        width: 80px;
        height: 40px;
    }

    .no-image-placeholder {
        width: 80px;
        height: 40px;
    }
}

/* Focus States for Accessibility */
.enterprise-btn:focus,
.action-button:focus,
.breadcrumb-link:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}
</style>
@endpush

@push('scripts')
<script>
function openImageModal(imageSrc, title) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');

    modalImage.src = imageSrc;
    modalTitle.textContent = title + ' - Banner Image';
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

function viewBannerDetails(banner) {
    alert('Banner Details:\n\n' +
          'Order: ' + banner.order + '\n' +
          'Section: ' + banner.section + '\n' +
          'Company: ' + (banner.company ? banner.company.company_name : 'N/A') + '\n' +
          'Status: ' + banner.status);
}

// Close modal on escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeImageModal();
    }
});

$(document).ready(function() {
    // Smooth scroll animations
    $('.table-data-row').each(function(index) {
        $(this).css('animation-delay', (index * 0.05) + 's');
    });
});
</script>
@endpush
