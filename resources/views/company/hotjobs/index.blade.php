{{-- resources/views/company/hotjobs/index.blade.php --}}
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
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-briefcase"></i>
                            </div>
                            <span class="breadcrumb-text">Hot Jobs</span>
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
                        <i class="bx bx-briefcase"></i>
                    </div>
                    <div class="compact-header-text">
                        <h1 class="compact-page-title">My Hot Jobs Management</h1>
                        <p class="compact-page-subtitle">Manage your urgent maritime job postings and track applications</p>
                    </div>
                </div>
                <div class="compact-header-actions">
                    <a href="{{ route('company.hotjobs.create') }}" class="enterprise-btn btn-success">
                        <i class="bx bx-plus"></i>
                        <span>Post Hot Job</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Success Alert -->
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

        <!-- Hot Jobs Section -->
        <div class="enterprise-section">
            <div class="section-header-wrapper">
                <div class="section-header-content">
                    <div class="section-icon-badge hotjobs-badge">
                        <i class="bx bx-briefcase-alt-2"></i>
                    </div>
                    <div class="section-title-group">
                        <h2 class="section-primary-title">Your Hot Jobs Listing</h2>
                        <p class="section-description">All your posted maritime job openings and their current status</p>
                    </div>
                </div>
                <div class="hotjobs-summary">
                    <div class="summary-stat">
                        <span class="stat-number">{{ $hotjobs->total() }}</span>
                        <span class="stat-label">Total Jobs</span>
                    </div>
                    <div class="summary-stat">
                        <span class="stat-number">{{ $hotjobs->where('status', 'active')->count() }}</span>
                        <span class="stat-label">Active Jobs</span>
                    </div>
                    <div class="summary-stat">
                        <span class="stat-number">{{ $hotjobs->where('status', 'pending')->count() }}</span>
                        <span class="stat-label">Pending Jobs</span>
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
                                        <span>#</span>
                                    </div>
                                </th>
                                <th class="table-header-cell rank-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-crown header-icon"></i>
                                        <span>Rank</span>
                                    </div>
                                </th>
                                <th class="table-header-cell ship-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-ship header-icon"></i>
                                        <span>Ship Type</span>
                                    </div>
                                </th>
                                <th class="table-header-cell date-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-calendar header-icon"></i>
                                        <span>Joining Date</span>
                                    </div>
                                </th>
                                <th class="table-header-cell status-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-check-shield header-icon"></i>
                                        <span>Status</span>
                                    </div>
                                </th>
                                <th class="table-header-cell sms-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-message-dots header-icon"></i>
                                        <span>SMS</span>
                                    </div>
                                </th>
                                <th class="table-header-cell posted-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-user-check header-icon"></i>
                                        <span>Posted By</span>
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
                            @forelse($hotjobs as $i => $hotjob)
                                <tr class="table-data-row">
                                    <td class="table-data-cell no-cell">
                                        <div class="number-display">
                                            <span class="row-number">{{ $hotjobs->firstItem() + $i }}</span>
                                        </div>
                                    </td>
                                    <td class="table-data-cell rank-cell">
                                        <div class="rank-display">
                                            <div class="rank-badge">
                                                <i class="bx bx-crown"></i>
                                                <span class="rank-name">{{ $hotjob->rank->rank ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell ship-cell">
                                        <div class="ship-display">
                                            <div class="ship-badge">
                                                <i class="bx bx-ship"></i>
                                                <span class="ship-name">{{ $hotjob->ship->ship_name ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell date-cell">
                                        <div class="date-display">
                                            @if($hotjob->joiningdate)
                                                <div class="date-primary">
                                                    {{ \Carbon\Carbon::parse($hotjob->joiningdate)->format('M d, Y') }}
                                                </div>
                                                <div class="date-secondary">
                                                    {{ \Carbon\Carbon::parse($hotjob->joiningdate)->format('D') }}
                                                </div>
                                            @else
                                                <span class="no-data-text">Not Set</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-data-cell status-cell">
                                        <div class="status-display">
                                            @php
                                                $statusClass = match(strtolower($hotjob->status)) {
                                                    'active' => 'status-active',
                                                    'pending' => 'status-pending',
                                                    'expired' => 'status-expired',
                                                    default => 'status-default'
                                                };
                                                $statusIcon = match(strtolower($hotjob->status)) {
                                                    'active' => 'bx-check-circle',
                                                    'pending' => 'bx-time-five',
                                                    'expired' => 'bx-x-circle',
                                                    default => 'bx-help-circle'
                                                };
                                            @endphp
                                            <div class="status-badge {{ $statusClass }}">
                                                <i class="bx {{ $statusIcon }}"></i>
                                                <span>{{ ucfirst($hotjob->status) }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell sms-cell">
                                        <div class="sms-display">
                                            @php
                                                $smsClass = $hotjob->withsms === 'yes' ? 'sms-enabled' : 'sms-disabled';
                                                $smsIcon = $hotjob->withsms === 'yes' ? 'bx-check-circle' : 'bx-x-circle';
                                            @endphp
                                            <div class="sms-badge {{ $smsClass }}">
                                                <i class="bx {{ $smsIcon }}"></i>
                                                <span>{{ ucfirst($hotjob->withsms) }}</span>
                                            </div>
                                            @if($hotjob->withsms == 'yes')
                                                <div class="sms-service-info">
                                                    <small class="text-info">Contact +91-8454972214 to activate</small>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-data-cell posted-cell">
                                        <div class="posted-display">
                                            <div class="posted-avatar">
                                                <i class="bx bx-user-circle"></i>
                                            </div>
                                            <div class="posted-info">
                                                <div class="posted-name">{{ $hotjob->posted_by_name ?: 'N/A' }}</div>
                                                <div class="posted-email">{{ $hotjob->posted_by_email ?: 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell actions-cell">
                                        <div class="action-buttons-group">
                                            <button class="action-button view-button"
                                                    data-tooltip="View Details"
                                                    onclick="viewJobDetails({{ json_encode($hotjob) }})">
                                                <i class="bx bx-show"></i>
                                            </button>
                                            <form action="{{ route('company.hotjobs.destroy', $hotjob->id) }}"
                                                  method="POST"
                                                  style="display:inline;"
                                                  onsubmit="return confirm('Are you sure you want to delete this job posting?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="action-button delete-button"
                                                        data-tooltip="Delete Job">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-state-row">
                                    <td colspan="8" class="empty-state-cell">
                                        <div class="professional-empty-state">
                                            <div class="empty-state-icon hotjobs-empty-icon">
                                                <i class="bx bx-briefcase"></i>
                                            </div>
                                            <h3 class="empty-state-title">No Hot Jobs Posted</h3>
                                            <p class="empty-state-message">Start attracting qualified seafarers by posting your first urgent job opening.</p>
                                            <a href="{{ route('company.hotjobs.create') }}" class="enterprise-btn btn-success">
                                                <i class="bx bx-plus"></i>
                                                <span>Post First Hot Job</span>
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
            @if($hotjobs->hasPages())
                <div class="modern-pagination-wrapper">
                    <div class="pagination-info">
                        <span class="pagination-text">
                            Showing {{ $hotjobs->firstItem() ?? 0 }} to {{ $hotjobs->lastItem() ?? 0 }}
                            of {{ $hotjobs->total() }} jobs
                        </span>
                    </div>
                    <div class="pagination-controls">
                        {{ $hotjobs->links() }}
                    </div>
                </div>
            @endif
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

.modern-alert-success .alert-icon {
    background: var(--success-color);
    color: white;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1rem;
    flex-shrink: 0;
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

.hotjobs-badge {
    background: var(--info-light);
    color: var(--info-color);
    border-color: rgba(8, 145, 178, 0.2);
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

/* Hot Jobs Summary */
.hotjobs-summary {
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
    color: var(--info-color);
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
    color: var(--info-color);
    font-size: 1rem;
}

/* Column Sizing */
.no-column { width: 8%; }
.rank-column { width: 15%; }
.ship-column { width: 15%; }
.date-column { width: 12%; }
.status-column { width: 12%; }
.sms-column { width: 15%; }
.posted-column { width: 18%; }
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

/* Rank Display */
.rank-display {
    display: flex;
    justify-content: center;
}

.rank-badge {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    background: var(--warning-light);
    color: var(--warning-color);
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    border: 1px solid rgba(217, 119, 6, 0.2);
}

.rank-name {
    font-size: 0.8125rem;
}

/* Ship Display */
.ship-display {
    display: flex;
    justify-content: center;
}

.ship-badge {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    background: var(--secondary-light);
    color: var(--secondary-color);
    border-radius: var(--border-radius-sm);
    font-weight: 600;
    border: 1px solid var(--border-primary);
}

.ship-name {
    font-size: 0.8125rem;
}

/* Date Display */
.date-display {
    display: flex;
    flex-direction: column;
    gap: 0.125rem;
}

.date-primary {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
}

.date-secondary {
    font-size: 0.75rem;
    color: var(--text-muted);
    line-height: 1.2;
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

.status-pending {
    background: var(--warning-light);
    color: var(--warning-color);
    border-color: rgba(217, 119, 6, 0.2);
}

.status-expired {
    background: var(--danger-light);
    color: var(--danger-color);
    border-color: rgba(220, 38, 38, 0.2);
}

.status-default {
    background: var(--secondary-light);
    color: var(--secondary-color);
    border-color: rgba(100, 116, 139, 0.2);
}

/* SMS Display */
.sms-display {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.25rem;
}

.sms-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
    border: 1px solid;
}

.sms-enabled {
    background: var(--success-light);
    color: var(--success-color);
    border-color: rgba(5, 150, 105, 0.2);
}

.sms-disabled {
    background: var(--danger-light);
    color: var(--danger-color);
    border-color: rgba(220, 38, 38, 0.2);
}

.sms-service-info {
    text-align: center;
}

.sms-service-info small {
    font-size: 0.6875rem;
    line-height: 1.2;
    color: var(--info-color);
}

/* Posted By Display */
.posted-display {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
}

.posted-avatar {
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

.posted-info {
    flex: 1;
}

.posted-name {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
    margin-bottom: 0.125rem;
}

.posted-email {
    font-size: 0.75rem;
    color: var(--text-muted);
    line-height: 1.2;
    word-break: break-all;
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

.delete-button:hover {
    background: var(--danger-light);
    border-color: var(--danger-color);
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

.no-data-text {
    font-size: 0.875rem;
    color: var(--text-muted);
    font-style: italic;
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

.hotjobs-empty-icon {
    background: var(--info-light);
    color: var(--info-color);
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

    .hotjobs-summary {
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

    .posted-display {
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

    .modern-pagination-wrapper {
        flex-direction: column;
        gap: var(--spacing-md);
        text-align: center;
    }

    .posted-email {
        display: none;
    }

    .sms-service-info {
        display: none;
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
function viewJobDetails(job) {
    let details = 'Job Details:\n\n';
    details += 'Rank: ' + (job.rank ? job.rank.rank : 'N/A') + '\n';
    details += 'Ship: ' + (job.ship ? job.ship.ship_name : 'N/A') + '\n';
    details += 'Joining Date: ' + (job.joiningdate || 'N/A') + '\n';
    details += 'Nationality: ' + (job.nationality || 'N/A') + '\n';
    details += 'Experience: ' + (job.experience || 'N/A') + '\n';
    details += 'Status: ' + job.status + '\n';
    details += 'SMS: ' + job.withsms + '\n';
    details += 'Posted By: ' + (job.posted_by_name || 'N/A') + '\n';
    details += 'Email: ' + (job.posted_by_email || 'N/A') + '\n';
    if (job.description) {
        details += '\nDescription: ' + job.description;
    }

    alert(details);
}

$(document).ready(function() {
    // Smooth scroll animations
    $('.table-data-row').each(function(index) {
        $(this).css('animation-delay', (index * 0.05) + 's');
    });

    // Auto-hide success alerts after 5 seconds
    $('.modern-alert').each(function() {
        const $alert = $(this);
        setTimeout(() => {
            $alert.fadeOut(300, () => $alert.remove());
        }, 5000);
    });
});
</script>
@endpush
