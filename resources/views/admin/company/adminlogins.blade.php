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
                                <i class="bx bx-group"></i>
                            </div>
                            <span class="breadcrumb-text">Admin Logins</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Compact Professional Page Header -->
        <div class="compact-header-section mb-4">
            <div class="compact-header-card">
                <div class="compact-header-content">
                    <div class="compact-header-icon">
                        <i class="bx bx-group"></i>
                    </div>
                    <div class="compact-header-text">
                        <h1 class="compact-page-title">Admin Logins for {{ $company->company_name }}</h1>
                        <p class="compact-page-subtitle">Manage superadmin and subadmin access accounts</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Superadmin Management Section -->
        <div class="enterprise-section mb-4">
            <div class="section-header-wrapper">
                <div class="section-header-content">
                    <div class="section-icon-badge superadmin-badge">
                        <i class="bx bx-crown"></i>
                    </div>
                    <div class="section-title-group">
                        <h2 class="section-primary-title">Superadmin Account</h2>
                        <p class="section-description">Primary administrator with full access</p>
                    </div>
                </div>
                @if(!$superadmin)
                    <div class="section-action-buttons">
                        <a href="{{ route('admin.company.superadmin.edit', $company->id) }}" class="enterprise-btn btn-success">
                            <i class="bx bx-plus"></i>
                            <span>Add Superadmin</span>
                        </a>
                    </div>
                @endif
            </div>

            <div class="professional-table-wrapper">
                <div class="table-container">
                    <table class="enterprise-data-table">
                        <thead class="table-header-section">
                            <tr>
                                <th class="table-header-cell name-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-user header-icon"></i>
                                        <span>Name</span>
                                    </div>
                                </th>
                                <th class="table-header-cell username-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-at header-icon"></i>
                                        <span>Username</span>
                                    </div>
                                </th>
                                <th class="table-header-cell email-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-envelope header-icon"></i>
                                        <span>Email</span>
                                    </div>
                                </th>
                                <th class="table-header-cell mobile-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-phone header-icon"></i>
                                        <span>Mobile</span>
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
                            @if($superadmin)
                                <tr class="table-data-row">
                                    <td class="table-data-cell name-cell">
                                        <div class="user-profile-display">
                                            <div class="profile-avatar superadmin-avatar">
                                                <i class="bx bx-crown"></i>
                                            </div>
                                            <div class="profile-info">
                                                <div class="profile-name">{{ $superadmin->first_name }} {{ $superadmin->last_name }}</div>
                                                <div class="profile-role superadmin-role">Superadmin</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell username-cell">
                                        <div class="data-display">
                                            <span class="username-text">{{ $superadmin->username }}</span>
                                        </div>
                                    </td>
                                    <td class="table-data-cell email-cell">
                                        <div class="data-display">
                                            @if($superadmin->email)
                                                <span class="email-text">{{ $superadmin->email }}</span>
                                            @else
                                                <span class="no-data-text">Not set</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-data-cell mobile-cell">
                                        <div class="data-display">
                                            <span class="mobile-text">{{ $superadmin->country_code }} {{ $superadmin->mobile }}</span>
                                        </div>
                                    </td>
                                    <td class="table-data-cell actions-cell">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('admin.company.superadmin.edit', $company->id) }}"
                                               class="action-button edit-button"
                                               data-tooltip="Edit Superadmin">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.company.adminlogins.logs', ['company' => $company->id, 'user' => $superadmin->id]) }}"
                                               class="action-button logs-button"
                                               data-tooltip="View Superadmin Logs">
                                                <i class="bx bx-list-ul"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                <tr class="empty-state-row">
                                    <td colspan="5" class="empty-state-cell">
                                        <div class="professional-empty-state">
                                            <div class="empty-state-icon superadmin-empty-icon">
                                                <i class="bx bx-crown"></i>
                                            </div>
                                            <h3 class="empty-state-title">No Superadmin Found</h3>
                                            <p class="empty-state-message">A superadmin account is required to manage this company.</p>
                                            <a href="{{ route('admin.company.superadmin.edit', $company->id) }}" class="enterprise-btn btn-success">
                                                <i class="bx bx-plus"></i>
                                                <span>Add Superadmin</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Subadmins Management Section -->
        <div class="enterprise-section">
            <div class="section-header-wrapper">
                <div class="section-header-content">
                    <div class="section-icon-badge subadmin-badge">
                        <i class="bx bx-user-plus"></i>
                    </div>
                    <div class="section-title-group">
                        <h2 class="section-primary-title">Subadmin Accounts</h2>
                        <p class="section-description">Additional administrators with limited access</p>
                    </div>
                </div>
                <div class="section-action-buttons">
                    <a href="{{ route('admin.company.subadmins.edit', $company->id) }}" class="enterprise-btn btn-primary">
                        <i class="bx bx-plus"></i>
                        <span>Add Subadmin</span>
                    </a>
                </div>
            </div>

            <div class="professional-table-wrapper">
                <div class="table-container">
                    <table class="enterprise-data-table">
                        <thead class="table-header-section">
                            <tr>
                                <th class="table-header-cell name-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-user header-icon"></i>
                                        <span>Name</span>
                                    </div>
                                </th>
                                <th class="table-header-cell username-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-at header-icon"></i>
                                        <span>Username</span>
                                    </div>
                                </th>
                                <th class="table-header-cell email-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-envelope header-icon"></i>
                                        <span>Email</span>
                                    </div>
                                </th>
                                <th class="table-header-cell mobile-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-phone header-icon"></i>
                                        <span>Mobile</span>
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
                            @forelse($subadmins as $subadmin)
                                @if($subadmin->user)
                                <tr class="table-data-row">
                                    <td class="table-data-cell name-cell">
                                        <div class="user-profile-display">
                                            <div class="profile-avatar subadmin-avatar">
                                                <i class="bx bx-user"></i>
                                            </div>
                                            <div class="profile-info">
                                                <div class="profile-name">{{ $subadmin->user->first_name }} {{ $subadmin->user->last_name }}</div>
                                                <div class="profile-role subadmin-role">Subadmin</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell username-cell">
                                        <div class="data-display">
                                            <span class="username-text">{{ $subadmin->user->username }}</span>
                                        </div>
                                    </td>
                                    <td class="table-data-cell email-cell">
                                        <div class="data-display">
                                            @if($subadmin->user->email)
                                                <span class="email-text">{{ $subadmin->user->email }}</span>
                                            @else
                                                <span class="no-data-text">Not set</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-data-cell mobile-cell">
                                        <div class="data-display">
                                            <span class="mobile-text">{{ $subadmin->user->country_code }} {{ $subadmin->user->mobile }}</span>
                                        </div>
                                    </td>
                                    <td class="table-data-cell actions-cell">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('admin.company.subadmins.edit', $company->id) }}"
                                               class="action-button edit-button"
                                               data-tooltip="Edit Subadmins">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.company.adminlogins.logs', ['company' => $company->id, 'user' => $subadmin->user->id]) }}"
                                               class="action-button logs-button"
                                               data-tooltip="View Subadmin Logs">
                                                <i class="bx bx-list-ul"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            @empty
                                <tr class="empty-state-row">
                                    <td colspan="5" class="empty-state-cell">
                                        <div class="professional-empty-state">
                                            <div class="empty-state-icon subadmin-empty-icon">
                                                <i class="bx bx-user-plus"></i>
                                            </div>
                                            <h3 class="empty-state-title">No Subadmins Found</h3>
                                            <p class="empty-state-message">Add subadmin accounts to delegate administrative tasks.</p>
                                            <a href="{{ route('admin.company.subadmins.edit', $company->id) }}" class="enterprise-btn btn-primary">
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
        </div>
    </div>
</main>
@endsection

@push('styles')
<style>
/* Enterprise-Grade Professional Design Variables */
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
    --background-primary: #f8fafc;
    --background-secondary: #ffffff;
    --background-tertiary: #f1f5f9;
    --surface-elevated: #ffffff;
    --border-primary: #e2e8f0;
    --border-secondary: #cbd5e1;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-tertiary: #64748b;
    --text-muted: #94a3b8;
    --text-disabled: #cbd5e1;
    --shadow-subtle: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-medium: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    --shadow-elevated: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
    --shadow-floating: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    --border-radius-sm: 8px;
    --border-radius-md: 12px;
    --border-radius-lg: 16px;
    --transition-fast: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
    --transition-medium: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    --spacing-xs: 0.5rem;
    --spacing-sm: 0.75rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --spacing-xl: 2rem;
    --spacing-2xl: 3rem;
}

.professional-bg {
    background: linear-gradient(135deg, var(--background-primary) 0%, var(--background-tertiary) 100%);
    min-height: 100vh;
    padding: var(--spacing-xl) 0;
}

/* Enhanced Professional Breadcrumb */
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

/* Compact Professional Header */
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
}

.compact-header-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-color) 0%, var(--success-color) 100%);
}

.compact-header-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
}

.compact-header-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.compact-header-text {
    flex: 1;
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

/* Professional Section Design */
.enterprise-section {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-lg);
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
    background: linear-gradient(135deg, var(--background-tertiary) 0%, #f8fafc 100%);
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

.superadmin-badge {
    background: var(--success-light);
    color: var(--success-color);
    border-color: rgba(5, 150, 105, 0.2);
}

.subadmin-badge {
    background: var(--primary-light);
    color: var(--primary-color);
    border-color: rgba(79, 70, 229, 0.2);
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

/* Enterprise Button Design */
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

/* Professional Table Design */
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
    padding: 1.25rem 1.5rem;
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
    color: var(--primary-color);
    font-size: 1rem;
}

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
    padding: 1.25rem 1.5rem;
    vertical-align: middle;
    color: var(--text-primary);
}

/* Column Responsive Widths */
.name-column { width: 30%; min-width: 200px; }
.username-column { width: 20%; min-width: 150px; }
.email-column { width: 25%; min-width: 180px; }
.mobile-column { width: 15%; min-width: 140px; }
.actions-column { width: 10%; min-width: 100px; }

/* User Profile Display */
.user-profile-display {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
}

.profile-avatar {
    width: 44px;
    height: 44px;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    border: 2px solid;
}

.superadmin-avatar {
    background: var(--success-light);
    color: var(--success-color);
    border-color: rgba(5, 150, 105, 0.3);
}

.subadmin-avatar {
    background: var(--primary-light);
    color: var(--primary-color);
    border-color: rgba(79, 70, 229, 0.3);
}

.profile-info {
    flex: 1;
}

.profile-name {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
    margin-bottom: 0.25rem;
}

.profile-role {
    font-size: 0.75rem;
    font-weight: 500;
    line-height: 1.2;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.superadmin-role {
    color: var(--success-color);
}

.subadmin-role {
    color: var(--primary-color);
}

/* Data Display Styling */
.data-display {
    display: flex;
    align-items: center;
}

.username-text,
.email-text,
.mobile-text {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text-primary);
}

.no-data-text {
    font-size: 0.875rem;
    color: var(--text-muted);
    font-style: italic;
}

/* Action Buttons */
.action-buttons-group {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
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

.logs-button {
    color: #6366f1;
    border-color: rgba(99, 102, 241, 0.3);
}

.logs-button:hover {
    background: #f0f4ff;
    border-color: #6366f1;
    color: #4338ca;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(99, 102, 241, 0.12);
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

.superadmin-empty-icon {
    background: var(--success-light);
    color: var(--success-color);
}

.subadmin-empty-icon {
    background: var(--primary-light);
    color: var(--primary-color);
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

/* Enhanced Tooltips */
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

/* Responsive adjustments for compact header */
@media (max-width: 768px) {
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

    .compact-page-subtitle {
        font-size: 0.8125rem;
    }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .section-header-wrapper {
        flex-direction: column;
        gap: var(--spacing-lg);
        align-items: flex-start;
    }

    .compact-header-content {
        flex-direction: column;
        text-align: center;
        gap: var(--spacing-md);
    }
}

@media (max-width: 768px) {
    .professional-bg {
        padding: var(--spacing-md) 0;
    }

    .table-header-cell,
    .table-data-cell {
        padding: var(--spacing-md) var(--spacing-sm);
        font-size: 0.8125rem;
    }

    .user-profile-display {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-sm);
    }

    .profile-avatar {
        width: 36px;
        height: 36px;
        font-size: 1rem;
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
}

@media (max-width: 640px) {
    .enterprise-btn {
        width: 100%;
        justify-content: center;
    }

    .action-buttons-group {
        justify-content: center;
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
