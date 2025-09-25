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
                            <a href="{{ route('admin.company.adminlogins', $company->id) }}" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-group"></i>
                                </div>
                                <span class="breadcrumb-text">Admin Logins</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-time-five"></i>
                            </div>
                            <span class="breadcrumb-text">Login Logs</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Compact Header -->
        <div class="compact-header-section mb-4">
            <div class="compact-header-card">
                <div class="compact-header-content">
                    <div class="compact-header-icon">
                        <i class="bx bx-time-five"></i>
                    </div>
                    <div class="compact-header-text">
                        <h2 class="compact-page-title">Login Logs for {{ $user->first_name }} {{ $user->last_name }} ({{ $user->username }})</h2>
                    </div>
                </div>
                <div class="compact-header-actions">
                    <a href="{{ route('admin.company.adminlogins', $company->id) }}" class="enterprise-btn btn-secondary">
                        <i class="bx bx-arrow-back"></i> Back to Admin Logins
                    </a>
                </div>
            </div>
        </div>

        <!-- Professional Table Section -->
        <div class="enterprise-section">
            <div class="professional-table-wrapper">
                <div class="table-container">
                    <table class="enterprise-data-table">
                        <thead class="table-header-section">
                            <tr>
                                <th class="table-header-cell">
                                    <div class="header-cell-content">
                                        <i class="bx bx-log-in header-icon"></i>
                                        <span>Login At</span>
                                    </div>
                                </th>
                                <th class="table-header-cell">
                                    <div class="header-cell-content">
                                        <i class="bx bx-log-out header-icon"></i>
                                        <span>Logout At</span>
                                    </div>
                                </th>
                                <th class="table-header-cell">
                                    <div class="header-cell-content">
                                        <i class="bx bx-stopwatch header-icon"></i>
                                        <span>Duration (sec)</span>
                                    </div>
                                </th>
                                <th class="table-header-cell">
                                    <div class="header-cell-content">
                                        <i class="bx bx-network-chart header-icon"></i>
                                        <span>IP Address</span>
                                    </div>
                                </th>
                                <th class="table-header-cell">
                                    <div class="header-cell-content">
                                        <i class="bx bx-map header-icon"></i>
                                        <span>Location</span>
                                    </div>
                                </th>
                                <th class="table-header-cell">
                                    <div class="header-cell-content">
                                        <i class="bx bx-desktop header-icon"></i>
                                        <span>User Agent</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-body-section">
                            @forelse($logs as $log)
                                <tr class="table-data-row">
                                    <td class="table-data-cell">{{ $log->login_at }}</td>
                                    <td class="table-data-cell">{{ $log->logout_at ?? '-' }}</td>
                                    <td class="table-data-cell">{{ $log->duration_seconds ?? '-' }}</td>
                                    <td class="table-data-cell">
                                        <span class="ip-address">{{ $log->ip_address }}</span>
                                    </td>
                                    <td class="table-data-cell">
                                        @if(is_array($log->ip_location))
                                            {{ $log->ip_location['country'] ?? '' }},
                                            {{ $log->ip_location['region'] ?? '' }},
                                            {{ $log->ip_location['city'] ?? '' }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="table-data-cell agent-cell">
                                        <div class="user-agent-text">{{ $log->user_agent }}</div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-state-row">
                                    <td colspan="6" class="empty-state-cell">
                                        <div class="professional-empty-state">
                                            <div class="empty-state-icon">
                                                <i class="bx bx-time-five"></i>
                                            </div>
                                            <h3 class="empty-state-title">No logs found.</h3>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($logs->hasPages())
                <div class="modern-pagination-wrapper">
                    {{ $logs->links() }}
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
    --border-radius-sm: 8px;
    --border-radius-md: 12px;
    --transition-fast: all 0.15s ease;
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
    background: linear-gradient(90deg, #0891b2 0%, var(--primary-color) 100%);
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
    background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.compact-page-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
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
    background: var(--secondary-light);
    color: var(--secondary-color);
    border-color: var(--border-primary);
}

.btn-secondary:hover {
    background: var(--secondary-color);
    border-color: var(--secondary-color);
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

/* IP Address Styling */
.ip-address {
    font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
    background: rgba(79, 70, 229, 0.1);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.8125rem;
    font-weight: 600;
}

/* User Agent Cell */
.agent-cell {
    max-width: 200px;
}

.user-agent-text {
    word-break: break-all;
    line-height: 1.4;
    font-size: 0.8125rem;
}

/* Professional Empty State */
.professional-empty-state {
    text-align: center;
    padding: var(--spacing-xl) var(--spacing-md);
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
    background: #f0f9ff;
    color: #0891b2;
}

.empty-state-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-primary);
}

/* Modern Pagination */
.modern-pagination-wrapper {
    padding: var(--spacing-lg) var(--spacing-xl);
    border-top: 1px solid var(--border-primary);
    background: linear-gradient(135deg, #f1f5f9 0%, #f8fafc 100%);
}

/* Responsive Design */
@media (max-width: 768px) {
    .professional-bg {
        padding: var(--spacing-md) 0;
    }

    .compact-header-card {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-md);
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

    .compact-header-actions {
        align-self: stretch;
    }

    .enterprise-btn {
        width: 100%;
        justify-content: center;
    }

    .table-header-cell,
    .table-data-cell {
        padding: var(--spacing-sm);
        font-size: 0.8125rem;
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

/* Focus States for Accessibility */
.enterprise-btn:focus,
.breadcrumb-link:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}
</style>
@endpush
