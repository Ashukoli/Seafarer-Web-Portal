{{-- filepath: resources/views/company/subadmin/list.blade.php --}}
@extends('layouts.company.app')

@section('title', 'Subadmin Management')

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
                            <a href="#" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-buildings"></i>
                                </div>
                                <span class="breadcrumb-text">Company</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-user-pin"></i>
                            </div>
                            <span class="breadcrumb-text">Subadmin Management</span>
                        </li>
                    </ol>
                </nav>
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

        @if(session('error'))
            <div class="modern-alert modern-alert-error mb-4">
                <div class="alert-icon">
                    <i class="bx bx-error-circle"></i>
                </div>
                <div class="alert-content">
                    <strong>Error!</strong>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                    <i class="bx bx-x"></i>
                </button>
            </div>
        @endif

        <!-- Subadmin Data Section -->
        <div class="enterprise-section">
            <div class="section-header-wrapper">
                <div class="section-header-content">
                    <div class="section-icon-badge subadmin-badge">
                        <i class="bx bx-user-check"></i>
                    </div>
                    <div class="section-title-group">
                        <h2 class="section-primary-title">Company Subadministrators</h2>
                        <p class="section-description">Complete list of authorized subadministrators with their roles and status</p>
                    </div>
                </div>
                <div class="subadmin-summary">
                    <div class="summary-stat">
                        <span class="stat-number">{{ $total ?? count($subadmins) }}</span>
                        <span class="stat-label">Total</span>
                    </div>
                    <div class="summary-stat">
                        <span class="stat-number">{{ $active ?? $subadmins->where('status', 'active')->count() }}</span>
                        <span class="stat-label">Active</span>
                    </div>
                    <div class="summary-stat">
                        <span class="stat-number">{{ ($total ?? count($subadmins)) - ($active ?? $subadmins->where('status', 'active')->count()) }}</span>
                        <span class="stat-label">Inactive</span>
                    </div>
                </div>
            </div>

            <div class="professional-table-wrapper">
                <div class="table-container">
                    <table class="enterprise-data-table" id="subadminTable">
                        <thead class="table-header-section">
                            <tr>
                                <th class="table-header-cell no-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-hash header-icon"></i>
                                        <span>#</span>
                                    </div>
                                </th>
                                <th class="table-header-cell user-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-user header-icon"></i>
                                        <span>User Information</span>
                                    </div>
                                </th>
                                <th class="table-header-cell designation-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-id-card header-icon"></i>
                                        <span>Designation</span>
                                    </div>
                                </th>
                                <th class="table-header-cell contact-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-phone header-icon"></i>
                                        <span>Contact</span>
                                    </div>
                                </th>
                                <th class="table-header-cell status-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-check-shield header-icon"></i>
                                        <span>Status</span>
                                    </div>
                                </th>
                                <th class="table-header-cell login-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-time header-icon"></i>
                                        <span>Last Login</span>
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
                            @forelse($subadmins as $i => $subadmin)
                                <tr class="table-data-row subadmin-row" data-subadmin-id="{{ $subadmin->id }}">
                                    <td class="table-data-cell no-cell">
                                        <div class="number-display">
                                            <span class="row-number">{{ $i + 1 }}</span>
                                        </div>
                                    </td>
                                    <td class="table-data-cell user-cell">
                                        <div class="user-display">
                                            <div class="user-avatar-wrapper">
                                                <div class="user-avatar {{ $subadmin->status == 'active' ? 'active' : 'inactive' }}">
                                                    @if($subadmin->profile_picture)
                                                        <img src="{{ asset('storage/' . $subadmin->profile_picture) }}" alt="{{ $subadmin->name }}">
                                                    @else
                                                        <i class="bx bx-user"></i>
                                                    @endif
                                                </div>
                                                <div class="status-indicator {{ $subadmin->status }}"></div>
                                            </div>
                                            <div class="user-info">
                                                <div class="user-name">{{ $subadmin->name }}</div>
                                                <div class="user-email">{{ $subadmin->email }}</div>
                                                <div class="user-id">ID: #{{ str_pad($subadmin->id, 4, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell designation-cell">
                                        <div class="designation-display">
                                            @php
                                                $designationClass = match(strtolower($subadmin->designation ?? 'staff')) {
                                                    'manager', 'senior manager' => 'manager',
                                                    'hr', 'human resources' => 'hr',
                                                    'admin', 'administrator' => 'admin',
                                                    'supervisor' => 'supervisor',
                                                    default => 'staff'
                                                };

                                                $designationIcon = match($designationClass) {
                                                    'manager' => 'bx-crown',
                                                    'hr' => 'bx-group',
                                                    'admin' => 'bx-shield-check',
                                                    'supervisor' => 'bx-user-check',
                                                    default => 'bx-user'
                                                };
                                            @endphp
                                            <div class="designation-badge {{ $designationClass }}">
                                                <i class="bx {{ $designationIcon }}"></i>
                                                <span class="designation-name">{{ $subadmin->designation ?? 'Staff' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell contact-cell">
                                        <div class="contact-display">
                                            <div class="contact-item mobile">
                                                <i class="bx bx-phone"></i>
                                                <span class="contact-value">{{ $subadmin->mobile ?? 'Not provided' }}</span>
                                            </div>
                                            @if($subadmin->phone)
                                                <div class="contact-item phone">
                                                    <i class="bx bx-phone-call"></i>
                                                    <span class="contact-value">{{ $subadmin->phone }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-data-cell status-cell">
                                        <div class="status-display">
                                            <div class="status-badge {{ $subadmin->status == 'active' ? 'active' : 'inactive' }}">
                                                <i class="bx {{ $subadmin->status == 'active' ? 'bx-check-circle' : 'bx-x-circle' }}"></i>
                                                <span class="status-text">{{ ucfirst($subadmin->status) }}</span>
                                            </div>
                                            <div class="status-info">
                                                {{ $subadmin->status == 'active' ? 'Authorized Access' : 'Access Suspended' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell login-cell">
                                        <div class="login-display">

                                            <a href="{{ route('company.subadmin.login-history', $subadmin->id) }}" class="login-history-btn">
                                                <i class="bx bx-history"></i>
                                                <span>View History</span>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="table-data-cell actions-cell">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('company.subadmin.login-history', $subadmin->id) }}" class="login-history-btn">
                                                <i class="bx bx-history"></i>
                                                <span>View History</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-state-row">
                                    <td colspan="7" class="empty-state-cell">
                                        <div class="professional-empty-state">
                                            <div class="empty-state-icon subadmin-empty-icon">
                                                <i class="bx bx-user-pin"></i>
                                            </div>
                                            <h3 class="empty-state-title">No Subadmins Found</h3>
                                            <p class="empty-state-message">Start building your team by adding the first subadministrator to help manage your company operations.</p>
                                            <a href="{{ route('company.add.subadmin') }}" class="enterprise-btn btn-success">
                                                <i class="bx bx-plus"></i>
                                                <span>Add First Subadmin</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modern Pagination -->
            @if(method_exists($subadmins, 'hasPages') && $subadmins->hasPages())
                <div class="modern-pagination-wrapper">
                    <div class="pagination-info">
                        <span class="pagination-text">
                            Showing {{ $subadmins->firstItem() ?? 0 }} to {{ $subadmins->lastItem() ?? 0 }}
                            of {{ $subadmins->total() }} subadmins
                        </span>
                    </div>
                    <div class="pagination-controls">
                        {{ $subadmins->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>

<!-- Status Toggle Modal -->
<div class="modal fade" id="statusToggleModal" tabindex="-1" aria-labelledby="statusToggleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modern-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="statusToggleModalLabel">
                    <i class="bx bx-toggle-left"></i>
                    Toggle Subadmin Status
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="confirmation-content">
                    <div class="confirmation-icon">
                        <i class="bx bx-question-mark"></i>
                    </div>
                    <div class="confirmation-text">
                        <p>Are you sure you want to change the status of this subadmin?</p>
                        <div class="status-change-info">
                            <span class="current-status">Current: <span id="currentStatus"></span></span>
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="new-status">New: <span id="newStatus"></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="modern-btn modern-btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="modern-btn modern-btn-warning" id="confirmToggle">Toggle Status</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modern-modal danger-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">
                    <i class="bx bx-trash"></i>
                    Delete Subadmin
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="confirmation-content">
                    <div class="confirmation-icon danger">
                        <i class="bx bx-error"></i>
                    </div>
                    <div class="confirmation-text">
                        <p>Are you sure you want to delete this subadmin?</p>
                        <div class="warning-text">
                            <strong>Warning:</strong> This action cannot be undone. The subadmin will lose access immediately.
                        </div>
                        <div class="subadmin-info" id="deleteSubadminInfo"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="modern-btn modern-btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="modern-btn modern-btn-danger" id="confirmDelete">Delete Subadmin</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Include all professional CSS from previous examples */
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

/* Modern Breadcrumb - Same as previous examples */
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

/* Compact Header - Same as previous examples */
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
    background: linear-gradient(90deg, var(--warning-color) 0%, var(--success-color) 100%);
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
    background: linear-gradient(135deg, var(--warning-color) 0%, var(--warning-hover) 100%);
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

/* Modern Alert Styling - Same as previous examples */
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
    display: inline;
    margin-right: 0.5rem;
    font-size: 0.875rem;
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

/* Enterprise Section - Same as previous examples */
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

.subadmin-badge {
    background: var(--warning-light);
    color: var(--warning-color);
    border-color: rgba(217, 119, 6, 0.2);
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

.subadmin-summary {
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
    color: var(--warning-color);
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

.btn-success {
    background: var(--success-color);
    color: white;
    border-color: var(--success-color);
}

.btn-success:hover {
    background: var(--success-hover);
    border-color: var(--success-hover);
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
    color: var(--warning-color);
    font-size: 1rem;
}

/* Column Sizing */
.no-column { width: 8%; }
.user-column { width: 25%; }
.designation-column { width: 15%; }
.contact-column { width: 15%; }
.status-column { width: 12%; }
.login-column { width: 15%; }
.actions-column { width: 10%; }

.table-body-section {
    background: var(--surface-elevated);
}

.table-data-row {
    transition: var(--transition-fast);
    border-bottom: 1px solid rgba(226, 232, 240, 0.5);
}

.table-data-row:hover {
    background: rgba(248, 250, 252, 0.8);
    transform: translateY(-1px);
    box-shadow: var(--shadow-subtle);
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
    background: var(--warning-light);
    color: var(--warning-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
}

/* User Display */
.user-display {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
}

.user-avatar-wrapper {
    position: relative;
    flex-shrink: 0;
}

.user-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    border: 3px solid;
    overflow: hidden;
    position: relative;
}

.user-avatar.active {
    background: var(--success-light);
    color: var(--success-color);
    border-color: rgba(5, 150, 105, 0.3);
}

.user-avatar.inactive {
    background: var(--secondary-light);
    color: var(--secondary-color);
    border-color: rgba(100, 116, 139, 0.3);
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.status-indicator {
    position: absolute;
    bottom: -2px;
    right: -2px;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    border: 2px solid white;
}

.status-indicator.active {
    background: var(--success-color);
}

.status-indicator.inactive {
    background: var(--secondary-color);
}

.user-info {
    flex: 1;
}

.user-name {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
    margin-bottom: 0.125rem;
}

.user-email {
    font-size: 0.8125rem;
    color: var(--text-secondary);
    line-height: 1.2;
    margin-bottom: 0.125rem;
}

.user-id {
    font-size: 0.75rem;
    color: var(--text-muted);
    font-family: 'Courier New', monospace;
}

/* Designation Display */
.designation-display {
    display: flex;
    justify-content: center;
}

.designation-badge {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    border: 1px solid;
    font-size: 0.8125rem;
}

.designation-badge.manager {
    background: var(--warning-light);
    color: var(--warning-color);
    border-color: rgba(217, 119, 6, 0.2);
}

.designation-badge.hr {
    background: var(--info-light);
    color: var(--info-color);
    border-color: rgba(8, 145, 178, 0.2);
}

.designation-badge.admin {
    background: var(--primary-light);
    color: var(--primary-color);
    border-color: rgba(79, 70, 229, 0.2);
}

.designation-badge.supervisor {
    background: var(--success-light);
    color: var(--success-color);
    border-color: rgba(5, 150, 105, 0.2);
}

.designation-badge.staff {
    background: var(--secondary-light);
    color: var(--secondary-color);
    border-color: rgba(100, 116, 139, 0.2);
}

/* Contact Display */
.contact-display {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.8125rem;
}

.contact-item i {
    color: var(--text-muted);
    font-size: 0.875rem;
}

.contact-value {
    color: var(--text-primary);
    font-weight: 500;
}

/* Status Display */
.status-display {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.25rem;
}

.status-badge {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    border: 1px solid;
    font-size: 0.8125rem;
}

.status-badge.active {
    background: var(--success-light);
    color: var(--success-color);
    border-color: rgba(5, 150, 105, 0.2);
}

.status-badge.inactive {
    background: var(--danger-light);
    color: var(--danger-color);
    border-color: rgba(220, 38, 38, 0.2);
}

.status-info {
    font-size: 0.75rem;
    color: var(--text-muted);
    text-align: center;
}

/* Login Display */
.login-display {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.login-time {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.8125rem;
}

.login-time i {
    color: var(--text-muted);
}

.login-date {
    color: var(--text-primary);
    font-weight: 500;
}

.login-hour {
    color: var(--text-secondary);
    font-size: 0.75rem;
}

.login-duration {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin-bottom: 0.25rem;
}

.no-login {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.8125rem;
    color: var(--text-muted);
    margin-bottom: 0.25rem;
}

.login-history-btn {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.75rem;
    color: var(--primary-color);
    text-decoration: none;
    transition: var(--transition-fast);
}

.login-history-btn:hover {
    color: var(--primary-hover);
    text-decoration: underline;
}

/* Action Buttons */
.action-buttons-group {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    justify-content: center;
    flex-wrap: wrap;
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

.toggle-button {
    color: var(--primary-color);
    border-color: rgba(79, 70, 229, 0.3);
}

.toggle-button:hover {
    background: var(--primary-light);
    border-color: var(--primary-color);
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

.delete-button {
    color: var(--danger-color);
    border-color: rgba(220, 38, 38, 0.3);
}

.delete-button:hover {
    background: var(--danger-light);
    border-color: var(--danger-color);
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

/* Professional Empty State */
.professional-empty-state {
    text-align: center;
    padding: var(--spacing-xl) var(--spacing-md);
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

.subadmin-empty-icon {
    background: var(--warning-light);
    color: var(--warning-color);
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

/* Modern Pagination */
.modern-pagination-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--spacing-lg) var(--spacing-xl);
    border-top: 1px solid var(--border-primary);
    background: linear-gradient(135deg, #f1f5f9 0%, #f8fafc 100%);
}

.pagination-info {
    flex: 1;
}

.pagination-text {
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.pagination-controls {
    flex-shrink: 0;
}

/* Modern Modal */
.modern-modal {
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-floating);
    border: none;
}

.modern-modal .modal-header {
    background: linear-gradient(135deg, var(--primary-light) 0%, #f8fafc 100%);
    border-bottom: 1px solid var(--border-primary);
    border-radius: var(--border-radius-md) var(--border-radius-md) 0 0;
    padding: var(--spacing-lg);
}

.modern-modal.danger-modal .modal-header {
    background: linear-gradient(135deg, var(--danger-light) 0%, #fef2f2 100%);
}

.modern-modal .modal-title {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    color: var(--text-primary);
    font-weight: 600;
}

.modern-modal .modal-body {
    padding: var(--spacing-xl);
}

.confirmation-content {
    display: flex;
    gap: var(--spacing-lg);
    align-items: flex-start;
}

.confirmation-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
    background: var(--warning-light);
    color: var(--warning-color);
}

.confirmation-icon.danger {
    background: var(--danger-light);
    color: var(--danger-color);
}

.confirmation-text {
    flex: 1;
}

.status-change-info {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    margin-top: var(--spacing-sm);
    padding: var(--spacing-sm);
    background: var(--secondary-light);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
}

.warning-text {
    margin-top: var(--spacing-sm);
    padding: var(--spacing-sm);
    background: var(--danger-light);
    border: 1px solid rgba(220, 38, 38, 0.2);
    border-radius: var(--border-radius-sm);
    color: var(--danger-color);
    font-size: 0.875rem;
}

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
}

.modern-btn-warning {
    background: var(--warning-color);
    color: white;
    border-color: var(--warning-color);
}

.modern-btn-warning:hover {
    background: var(--warning-hover);
    border-color: var(--warning-hover);
}

.modern-btn-danger {
    background: var(--danger-color);
    color: white;
    border-color: var(--danger-color);
}

.modern-btn-danger:hover {
    background: var(--danger-hover);
    border-color: var(--danger-hover);
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

    .subadmin-summary {
        justify-content: space-around;
        width: 100%;
    }
}

@media (max-width: 768px) {
    .professional-bg {
        padding: var(--spacing-md) 0;
    }

    .compact-header-card {
        padding: var(--spacing-md);
    }

    .table-header-cell,
    .table-data-cell {
        padding: var(--spacing-sm);
        font-size: 0.8125rem;
    }

    .user-display {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-xs);
    }

    .action-buttons-group {
        flex-direction: column;
        gap: 0.25rem;
    }

    .modern-pagination-wrapper {
        flex-direction: column;
        gap: var(--spacing-md);
        text-align: center;
    }

    .contact-display,
    .login-display {
        display: none;
    }
}
</style>
@endpush

@push('scripts')
<script>
function viewSubadminDetails(name, email, designation) {
    let details = `Subadmin Details:\n\n`;
    details += `Name: ${name}\n`;
    details += `Email: ${email}\n`;
    details += `Designation: ${designation}\n`;

    alert(details);
}

function toggleSubadminStatus(id, currentStatus) {
    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';

    document.getElementById('currentStatus').textContent = currentStatus;
    document.getElementById('newStatus').textContent = newStatus;

    document.getElementById('confirmToggle').onclick = function() {
        // Here you would make an AJAX call to toggle the status
        fetch(`/company/subadmin/${id}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error updating status');
            }
        })
        .catch(error => {
            alert('Error updating status');
        });

        bootstrap.Modal.getInstance(document.getElementById('statusToggleModal')).hide();
    };

    new bootstrap.Modal(document.getElementById('statusToggleModal')).show();
}

function confirmDelete(id, name) {
    document.getElementById('deleteSubadminInfo').innerHTML = `
        <strong>Subadmin:</strong> ${name}<br>
        <strong>ID:</strong> #${String(id).padStart(4, '0')}
    `;

    document.getElementById('confirmDelete').onclick = function() {
        // Here you would make an AJAX call to delete the subadmin
        fetch(`/company/subadmin/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting subadmin');
            }
        })
        .catch(error => {
            alert('Error deleting subadmin');
        });

        bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal')).hide();
    };

    new bootstrap.Modal(document.getElementById('deleteConfirmModal')).show();
}

$(document).ready(function() {
    // Auto-hide success/error alerts after 5 seconds
    $('.modern-alert').each(function() {
        const $alert = $(this);
        setTimeout(() => {
            $alert.fadeOut(300, () => $alert.remove());
        }, 5000);
    });

    // Enhanced table row interactions
    $('.table-data-row').hover(
        function() {
            $(this).addClass('hovered');
        },
        function() {
            $(this).removeClass('hovered');
        }
    );

    // Initialize tooltips if Bootstrap is available
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-tooltip]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});
</script>
@endpush
