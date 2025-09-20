{{-- filepath: resources/views/admin/company/index.blade.php --}}
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
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-buildings"></i>
                            </div>
                            <span class="breadcrumb-text">Companies</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="modern-professional-card">
            <div class="card-header modern-header">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bx bx-buildings"></i>
                    </div>
                    <div class="header-text">
                        <h5 class="header-title">Companies Management</h5>
                        <p class="header-subtitle">Manage company accounts and permissions</p>
                    </div>
                </div>
                <div class="header-actions">
                    <a href="{{ route('admin.company.register.step', 1) }}" class="modern-btn modern-btn-white">
                        <i class="bx bx-plus"></i>
                        <span>Add Company</span>
                    </a>
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
                    </div>
                @endif

                <!-- Enhanced Search Filter -->
                <div class="search-filter-section">
                    <form method="GET" action="{{ route('admin.company.index') }}" class="modern-search-form">
                        <div class="search-row">
                            <div class="search-input-group">
                                <div class="search-icon">
                                    <i class="bx bx-search"></i>
                                </div>
                                <input type="text"
                                       name="search"
                                       class="modern-search-input"
                                       placeholder="Search companies by name..."
                                       value="{{ request('search') }}">
                            </div>
                            <div class="search-actions">
                                <button type="submit" class="modern-btn modern-btn-primary">
                                    <i class="bx bx-search"></i>
                                    <span>Search</span>
                                </button>
                                <a href="{{ route('admin.company.index') }}" class="modern-btn modern-btn-outline-secondary">
                                    <i class="bx bx-refresh"></i>
                                    <span>Reset</span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modern Data Table -->
                <div class="modern-table-container">
                    <div class="table-responsive">
                        <table class="modern-data-table">
                            <thead>
                                <tr>
                                    <th class="table-header-logo">Logo</th>
                                    <th class="table-header-company">Company Details</th>
                                    <th class="table-header-activity">Activity Stats</th>
                                    <th class="table-header-admin">Admin Access</th>
                                    <th class="table-header-actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($companies as $company)
                                <tr class="table-row">
                                    <td class="table-cell-logo">
                                        <div class="company-logo-wrapper">
                                            @if(!empty($company->company_logo))
                                                <img src="{{ asset('theme/assets/images/company_logo/' . $company->company_logo) }}"
                                                     alt="{{ $company->company_name }} Logo"
                                                     class="company-logo">
                                            @else
                                                <div class="logo-placeholder">
                                                    <i class="bx bx-building"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-cell-company">
                                        <div class="company-info">
                                            <h6 class="company-name">{{ $company->company_name }}</h6>
                                            <p class="last-login">
                                                <i class="bx bx-time"></i>
                                                {{ $company->last_login ? $company->last_login->format('d M Y, h:i A') : 'Never Logged In' }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="table-cell-activity">
                                        <div class="activity-stats">
                                            <div class="stat-item">
                                                <span class="stat-value">{{ $company->resume_viewed ?? 0 }}</span>
                                                <span class="stat-label">Viewed</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-value">{{ $company->resume_downloads ?? 0 }}</span>
                                                <span class="stat-label">Downloaded</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-cell-admin">
                                        <div class="admin-actions">
                                            <a href="{{ route('admin.company.superadmin.edit', $company->id) }}"
                                               class="admin-btn admin-btn-superadmin"
                                               data-tooltip="Manage Superadmin">
                                                <i class="bx bx-crown"></i>
                                                <span>Superadmin</span>
                                            </a>
                                            <a href="{{ route('admin.company.subadmins.edit', $company->id) }}"
                                               class="admin-btn admin-btn-subadmin"
                                               data-tooltip="Manage Subadmins">
                                                <i class="bx bx-group"></i>
                                                <span>Subadmins</span>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="table-cell-actions">
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.company.edit', $company->id) }}"
                                               class="action-btn action-btn-edit"
                                               data-tooltip="Edit Company">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.company.destroy', $company->id) }}"
                                                  method="POST"
                                                  style="display:inline;"
                                                  onsubmit="return confirm('Are you sure you want to delete this company?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="action-btn action-btn-delete"
                                                        data-tooltip="Delete Company">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr class="empty-row">
                                    <td colspan="5" class="empty-cell">
                                        <div class="empty-state">
                                            <div class="empty-icon">
                                                <i class="bx bx-buildings"></i>
                                            </div>
                                            <h6 class="empty-title">No Companies Found</h6>
                                            <p class="empty-message">
                                                @if(request('search'))
                                                    No companies match your search criteria.
                                                @else
                                                    Get started by adding your first company.
                                                @endif
                                            </p>
                                            @if(!request('search'))
                                                <a href="{{ route('admin.company.register.step', 1) }}" class="modern-btn modern-btn-primary">
                                                    <i class="bx bx-plus"></i>
                                                    <span>Add First Company</span>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modern Pagination -->
                @if($companies->hasPages())
                    <div class="modern-pagination-wrapper">
                        {{ $companies->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
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
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
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

.header-actions {
    position: relative;
    z-index: 1;
}

/* Body Styling */
.modern-body {
    padding: 2.5rem;
    background: var(--card-background);
}

/* Modern Alert */
.modern-alert {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem 1.5rem;
    border-radius: var(--border-radius-sm);
    border: 1px solid;
    margin-bottom: 1.5rem;
}

.modern-alert-success {
    background: rgba(16, 185, 129, 0.1);
    border-color: var(--success-color);
    color: var(--success-color);
}

.alert-icon {
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: var(--success-color);
    color: white;
}

.alert-content strong {
    font-weight: 600;
    display: block;
    margin-bottom: 0.25rem;
}

/* Search Filter Section */
.search-filter-section {
    background: linear-gradient(145deg, #fafbff 0%, #f1f5f9 100%);
    border: 1px solid rgba(99, 102, 241, 0.1);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.modern-search-form {
    margin: 0;
}

.search-row {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.search-input-group {
    flex: 1;
    position: relative;
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    z-index: 2;
}

.modern-search-input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    color: var(--text-primary);
    background: white;
    border: 2px solid var(--border-color);
    border-radius: var(--border-radius-sm);
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.modern-search-input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.search-actions {
    display: flex;
    gap: 0.5rem;
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

.modern-btn-white {
    background: white;
    color: var(--header-text);
    border-color: rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
}

.modern-btn-white:hover {
    background: rgba(255, 255, 255, 0.9);
    color: var(--primary-color);
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
}

/* Modern Data Table */
.modern-table-container {
    background: white;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-color);
}

.modern-data-table {
    width: 100%;
    margin: 0;
    border-collapse: collapse;
}

.modern-data-table thead tr {
    background: linear-gradient(135deg, #f9fafb 0%, #f1f5f9 100%);
}

.modern-data-table th {
    padding: 1.25rem 1rem;
    text-align: left;
    font-weight: 700;
    color: var(--text-primary);
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid var(--border-color);
}

.modern-data-table td {
    padding: 1.25rem 1rem;
    vertical-align: middle;
    border-bottom: 1px solid rgba(229, 231, 235, 0.5);
}

.table-row {
    transition: var(--transition);
}

.table-row:hover {
    background: rgba(99, 102, 241, 0.02);
}

/* Company Logo */
.company-logo-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
}

.company-logo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: var(--border-radius-sm);
    border: 2px solid var(--border-color);
}

.logo-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    border-radius: var(--border-radius-sm);
    border: 2px dashed var(--border-color);
    color: var(--text-muted);
    font-size: 1.5rem;
}

/* Company Info */
.company-info {
    min-width: 200px;
}

.company-name {
    margin: 0 0 0.5rem 0;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
}

.last-login {
    margin: 0;
    font-size: 0.8rem;
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.last-login i {
    font-size: 0.875rem;
}

/* Activity Stats */
.activity-stats {
    display: flex;
    gap: 1.5rem;
}

.stat-item {
    text-align: center;
}

.stat-value {
    display: block;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary-color);
    line-height: 1.2;
}

.stat-label {
    display: block;
    font-size: 0.75rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-top: 0.25rem;
}

/* Admin Actions */
.admin-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    min-width: 120px;
}

.admin-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    border-radius: var(--border-radius-sm);
    transition: var(--transition);
    border: 2px solid;
}

.admin-btn-superadmin {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success-color);
    border-color: var(--success-color);
}

.admin-btn-superadmin:hover {
    background: var(--success-color);
    color: white;
}

.admin-btn-subadmin {
    background: rgba(99, 102, 241, 0.1);
    color: var(--primary-color);
    border-color: var(--primary-color);
}

.admin-btn-subadmin:hover {
    background: var(--primary-color);
    color: white;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: var(--border-radius-sm);
    border: 2px solid;
    background: white;
    cursor: pointer;
    transition: var(--transition);
    text-decoration: none;
}

.action-btn-edit {
    color: var(--warning-color);
    border-color: var(--warning-color);
}

.action-btn-edit:hover {
    background: var(--warning-color);
    color: white;
    transform: translateY(-1px);
}

.action-btn-delete {
    color: var(--danger-color);
    border-color: var(--danger-color);
}

.action-btn-delete:hover {
    background: var(--danger-color);
    color: white;
    transform: translateY(-1px);
}

/* Empty State */
.empty-cell {
    padding: 3rem 1rem;
    text-align: center;
}

.empty-state {
    max-width: 400px;
    margin: 0 auto;
}

.empty-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    border-radius: 50%;
    color: var(--text-muted);
    font-size: 2rem;
}

.empty-title {
    margin: 0 0 0.5rem 0;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
}

.empty-message {
    margin: 0 0 1.5rem 0;
    color: var(--text-secondary);
    line-height: 1.6;
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

/* Responsive Design */
@media (max-width: 992px) {
    .modern-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .activity-stats {
        flex-direction: column;
        gap: 0.75rem;
    }

    .admin-actions {
        flex-direction: row;
        flex-wrap: wrap;
    }
}

@media (max-width: 768px) {
    .modern-body {
        padding: 1.5rem;
    }

    .search-row {
        flex-direction: column;
        align-items: stretch;
    }

    .search-actions {
        justify-content: center;
    }

    .modern-btn {
        width: 100%;
        justify-content: center;
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

/* Focus States for Accessibility */
.modern-search-input:focus,
.modern-btn:focus,
.breadcrumb-link:focus,
.admin-btn:focus,
.action-btn:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}
</style>
@endpush
