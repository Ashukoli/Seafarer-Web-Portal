{{-- filepath: resources/views/admin/company/followups/index.blade.php --}}
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
                                <i class="bx bx-phone-call"></i>
                            </div>
                            <span class="breadcrumb-text">Follow-Ups</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>



        <!-- Follow-Ups Section -->
        <div class="enterprise-section">
            <div class="section-header-wrapper">
                <div class="section-header-content">
                    <div class="section-icon-badge followup-badge">
                        <i class="bx bx-list-ul"></i>
                    </div>
                    <div class="section-title-group">
                        <h2 class="section-primary-title">Company Follow-Ups</h2>
                        <p class="section-description">Comprehensive list of all follow-up activities</p>
                    </div>
                </div>
                <div class="followup-summary">
                    <div class="summary-stat">
                        <span class="stat-number">{{ $followups->total() }}</span>
                        <span class="stat-label">Total Follow-Ups</span>
                    </div>
                </div>
            </div>

            <div class="professional-table-wrapper">
                <div class="table-container">
                    <table class="enterprise-data-table">
                        <thead class="table-header-section">
                            <tr>
                                <th class="table-header-cell sr-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-hash header-icon"></i>
                                        <span>Sr.No</span>
                                    </div>
                                </th>
                                <th class="table-header-cell company-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-buildings header-icon"></i>
                                        <span>Company Name</span>
                                    </div>
                                </th>
                                <th class="table-header-cell executive-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-user header-icon"></i>
                                        <span>Executive</span>
                                    </div>
                                </th>
                                <th class="table-header-cell date-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-calendar header-icon"></i>
                                        <span>Follow Up Date</span>
                                    </div>
                                </th>
                                <th class="table-header-cell message-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-message-dots header-icon"></i>
                                        <span>Message</span>
                                    </div>
                                </th>
                                <th class="table-header-cell next-followup-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-calendar-event header-icon"></i>
                                        <span>Next Follow Up Date</span>
                                    </div>
                                </th>
                                <th class="table-header-cell actions-column">
                                    <div class="header-cell-content">
                                        <i class="bx bx-cog header-icon"></i>
                                        <span>Action</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-body-section">
                            @forelse($followups as $i => $followup)
                                <tr class="table-data-row">
                                    <td class="table-data-cell sr-cell">
                                        <div class="sr-display">
                                            <span class="sr-number">{{ $followups->firstItem() + $i }}</span>
                                        </div>
                                    </td>
                                    <td class="table-data-cell company-cell">
                                        <div class="company-display">
                                            <div class="company-avatar">
                                                <i class="bx bx-buildings"></i>
                                            </div>
                                            <div class="company-info">
                                                <div class="company-name">{{ $followup->company->company_name ?? '-' }}</div>
                                                <div class="company-type">Company</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell executive-cell">
                                        <div class="executive-display">
                                            <span class="executive-name">{{ $followup->executive }}</span>
                                        </div>
                                    </td>
                                    <td class="table-data-cell date-cell">
                                        <div class="date-display">
                                            @if($followup->follow_up_date)
                                                <div class="date-primary">
                                                    {{ \Carbon\Carbon::parse($followup->follow_up_date)->format('M d, Y') }}
                                                </div>
                                                <div class="date-secondary">
                                                    {{ \Carbon\Carbon::parse($followup->follow_up_date)->format('D') }}
                                                </div>
                                            @else
                                                <span class="no-data-text">Not Set</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-data-cell message-cell">
                                        <div class="message-display">
                                            <div class="message-text" title="{{ $followup->message }}">
                                                {{ Str::limit($followup->message, 60) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-data-cell next-followup-cell">
                                        <div class="next-followup-display">
                                            @if($followup->next_follow_up_date)
                                                {{ \Carbon\Carbon::parse($followup->next_follow_up_date)->format('M d, Y') }}
                                            @else
                                                <span class="no-data-text">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-data-cell actions-cell">
                                        <div class="action-buttons-group">
                                            <a href="{{ route('admin.company.followups.create', ['company_id' => $followup->company_id]) }}" class="action-button view-button" data-tooltip="Add Follow-up">
                                                <i class="bx bx-phone-call"></i>
                                            </a>
                                            <button class="action-button edit-button" data-tooltip="Edit Follow-up">
                                                <i class="bx bx-edit"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-state-row">
                                    <td colspan="7" class="empty-state-cell">
                                        <div class="professional-empty-state">
                                            <div class="empty-state-icon followup-empty-icon">
                                                <i class="bx bx-phone-call"></i>
                                            </div>
                                            <h3 class="empty-state-title">No Follow-Ups Found</h3>
                                            <p class="empty-state-message">Start managing your company relationships by adding your first follow-up.</p>
                                            <a href="{{ route('admin.company.followups.create') }}" class="enterprise-btn btn-success">
                                                <i class="bx bx-plus"></i>
                                                <span>Add First Follow-Up</span>
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
            @if($followups->hasPages())
                <div class="modern-pagination-wrapper">
                    <div class="pagination-info">
                        <span class="pagination-text">
                            Showing {{ $followups->firstItem() ?? 0 }} to {{ $followups->lastItem() ?? 0 }}
                            of {{ $followups->total() }} entries
                        </span>
                    </div>
                    <div class="pagination-controls">
                        {{ $followups->links() }}
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
    background: linear-gradient(90deg, #d97706 0%, var(--success-color) 100%);
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
    background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
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

.followup-badge {
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

/* Follow-up Summary */
.followup-summary {
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
.sr-column { width: 8%; }
.company-column { width: 20%; }
.executive-column { width: 12%; }
.date-column { width: 12%; }
.message-column { width: 25%; }
.next-followup-column { width: 12%; }
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

/* Serial Number Display */
.sr-display {
    display: flex;
    align-items: center;
    justify-content: center;
}

.sr-number {
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

/* Company Display */
.company-display {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
}

.company-avatar {
    width: 44px;
    height: 44px;
    background: var(--info-light);
    color: var(--info-color);
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    border: 2px solid rgba(8, 145, 178, 0.2);
}

.company-info {
    flex: 1;
}

.company-name {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
    margin-bottom: 0.25rem;
}

.company-type {
    font-size: 0.75rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Executive Display */
.executive-display {
    display: flex;
    align-items: center;
}

.executive-name {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text-primary);
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

/* Message Display */
.message-display {
    max-width: 250px;
}

.message-text {
    font-size: 0.875rem;
    color: var(--text-primary);
    line-height: 1.4;
    cursor: help;
}

/* Expiry Badge */
.expiry-display {
    display: flex;
    align-items: center;
}

.expiry-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.75rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
    border: 1px solid;
}

.expiry-badge.active {
    background: var(--success-light);
    color: var(--success-color);
    border-color: rgba(5, 150, 105, 0.2);
}

.expiry-badge.expiring-soon {
    background: var(--warning-light);
    color: var(--warning-color);
    border-color: rgba(217, 119, 6, 0.2);
}

.expiry-badge.expired {
    background: var(--danger-light);
    color: var(--danger-color);
    border-color: rgba(220, 38, 38, 0.2);
}

/* Location Display */
.location-display {
    display: flex;
    align-items: center;
    gap: 0.375rem;
}

.location-icon {
    color: var(--info-color);
    font-size: 1rem;
}

.location-text {
    font-size: 0.875rem;
    color: var(--text-primary);
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
}

.view-button {
    color: var(--info-color);
    border-color: rgba(8, 145, 178, 0.3);
}

.view-button:hover {
    background: var(--info-light);
    border-color: var(--info-color);
}

.edit-button {
    color: var(--warning-color);
    border-color: rgba(217, 119, 6, 0.3);
}

.edit-button:hover {
    background: var(--warning-light);
    border-color: var(--warning-color);
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

.followup-empty-icon {
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

    .modern-pagination-wrapper {
        flex-direction: column;
        gap: var(--spacing-md);
        text-align: center;
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
