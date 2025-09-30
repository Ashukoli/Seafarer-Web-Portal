@extends('layouts.admin.app')

@section('title', 'Profile Delete Requests')

@section('content')
<main class="page-content modern-bg">
    <div class="container-fluid px-4">
        <!-- Professional Breadcrumb -->
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="professional-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a>
                        </li>
                        <li class="breadcrumb-separator">›</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.candidates.index') }}" class="breadcrumb-link">Candidates</a>
                        </li>
                        <li class="breadcrumb-separator">›</li>
                        <li class="breadcrumb-item active">Delete Requests</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Professional Header -->
        <div class="professional-header mb-4">
            <div class="header-left">
                <div class="header-title-group">
                    <h1 class="header-title">Profile Delete Requests</h1>
                    <div class="header-subtitle">
                        Manage candidate account deletion requests - <span class="status-label">{{ ucfirst($status ?? 'pending') }}</span>
                    </div>
                </div>
                <div class="header-stats">
                    <div class="status-stats">
                        <div class="stat-item pending">
                            <span class="stat-number">{{ $requests->where('status', 'pending')->count() }}</span>
                            <span class="stat-label">Pending</span>
                        </div>
                        <div class="stat-item processed">
                            <span class="stat-number">{{ $requests->where('status', 'processed')->count() }}</span>
                            <span class="stat-label">Processed</span>
                        </div>
                        <div class="stat-item total">
                            <span class="stat-number">{{ $requests->total() }}</span>
                            <span class="stat-label">Total</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-right">
                <div class="filter-tabs">
                    <a href="{{ route('admin.candidate.delete_requests.index', ['status' => 'pending']) }}"
                       class="filter-tab {{ ($status ?? 'pending') === 'pending' ? 'active' : '' }}">Pending</a>
                    <a href="{{ route('admin.candidate.delete_requests.index', ['status' => 'processed']) }}"
                       class="filter-tab {{ $status === 'processed' ? 'active' : '' }}">Processed</a>
                    <a href="{{ route('admin.candidate.delete_requests.index', ['status' => 'all']) }}"
                       class="filter-tab {{ $status === 'all' ? 'active' : '' }}">All</a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="professional-alert alert-success mb-4">
                <div class="alert-content">{{ session('success') }}</div>
                <button type="button" class="alert-dismiss" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif

        <!-- Professional Table -->
        <div class="professional-table-container">
            <div class="table-header-section">
                <div class="table-title">Delete Requests Management</div>
                <div class="table-actions d-flex gap-2">
                    <form method="GET" class="d-flex" action="{{ route('admin.candidate.delete_requests.index') }}">
                        <input type="hidden" name="status" value="{{ $status }}">
                        <input type="text" name="q" value="{{ $search ?? '' }}"
                               class="filter-input" placeholder="Search candidate, email or reason...">
                        <button class="professional-btn btn-primary ms-2" type="submit">Search</button>
                    </form>
                </div>
            </div>

            <div class="responsive-table-wrapper">
                <table class="professional-compact-table">
                    <thead class="table-head">
                        <tr>
                            <th class="th-id">ID</th>
                            <th class="th-candidate">CANDIDATE</th>
                            <th class="th-reason">REASON</th>
                            <th class="th-submitted">SUBMITTED</th>
                            <th class="th-status">STATUS</th>
                            <th class="th-actions">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @forelse($requests as $request)
                            <tr class="table-row {{ $request->status === 'pending' ? 'pending-row' : 'processed-row' }}">
                                <td class="td-id">
                                    <div class="id-wrapper">
                                        <div class="primary-id">{{ $request->id }}</div>
                                        <div class="request-type">DEL-REQ</div>
                                    </div>
                                </td>
                                <td class="td-candidate">
                                    <div class="candidate-wrapper">
                                        @if($request->candidate)
                                            <div class="candidate-name">{{ optional($request->candidate->profile)->first_name ?? 'N/A' }} {{ optional($request->candidate->profile)->last_name ?? '' }}</div>
                                            <div class="candidate-email">{{ \Illuminate\Support\Str::limit($request->candidate->email ?? 'N/A', 30) }}</div>
                                            <div class="candidate-id">ID: {{ $request->candidate->id }}</div>
                                        @else
                                            <div class="candidate-deleted">Candidate Deleted / Missing</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="td-reason">
                                    <div class="reason-wrapper">
                                        <div class="primary-reason">{{ $request->reason }}</div>
                                        @if($request->other_reason)
                                            <div class="other-reason">{{ \Illuminate\Support\Str::limit($request->other_reason, 60) }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="td-submitted">
                                    <div class="date-wrapper">
                                        <div class="primary-date">{{ optional($request->created_at)->format('M d, Y') }}</div>
                                        <div class="secondary-date">{{ optional($request->created_at)->format('H:i') }}</div>
                                        <div class="relative-date">{{ optional($request->created_at)->diffForHumans() }}</div>
                                    </div>
                                </td>
                                <td class="td-status">
                                    @if($request->status === 'pending')
                                        <div class="status-badge pending">
                                            <div class="status-indicator"></div>
                                            <span>Pending Review</span>
                                        </div>
                                    @elseif($request->status === 'processed')
                                        <div class="status-badge processed">
                                            <div class="status-indicator"></div>
                                            <span>Processed</span>
                                        </div>
                                    @else
                                        <div class="status-badge unknown">
                                            <div class="status-indicator"></div>
                                            <span>{{ ucfirst($request->status) }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="td-actions">
                                    <div class="action-group">
                                        <!-- View Details Icon -->
                                        <a href="{{ route('admin.candidate.delete_requests.show', $request->id) }}"
                                        class="action-btn view-btn"
                                        title="View Details"
                                        aria-label="View Details">
                                            <i class="bx bx-show" style="font-size:1.3em;vertical-align:middle;"></i>
                                        </a>

                                        @if($request->status === 'pending')
                                            <form method="POST"
                                                action="{{ route('admin.candidate.delete_requests.process', $request->id) }}"
                                                class="delete-form d-inline-block"
                                                data-request-id="{{ $request->id }}"
                                                data-candidate-name="{{ optional($request->candidate)->first_name ?? 'Unknown' }} {{ optional($request->candidate)->last_name ?? '' }}">
                                                @csrf
                                                <input type="hidden" name="confirm" value="yes">
                                                <button type="button"
                                                        class="action-btn danger-btn open-delete-modal"
                                                        title="Process Delete"
                                                        aria-label="Process Delete"
                                                        style="padding:0.375rem 0.7rem;">
                                                    <i class="bx bx-trash" style="font-size:1.3em;vertical-align:middle;"></i>
                                                </button>
                                            </form>
                                        @else
                                            <div class="action-info">
                                                <span class="processed-info">Completed</span>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row">
                                <td colspan="6" class="empty-cell">
                                    <div class="empty-state">
                                        <div class="empty-icon">📋</div>
                                        <div class="empty-title">No Delete Requests Found</div>
                                        <div class="empty-description">
                                            @if(($status ?? 'pending') === 'pending')
                                                No pending delete requests at the moment.
                                            @elseif($status === 'processed')
                                                No processed delete requests found.
                                            @else
                                                No delete requests have been submitted yet.
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($requests->hasPages())
                <div class="professional-pagination">
                    <div class="pagination-info">
                        <span class="showing-text">
                            Showing {{ $requests->firstItem() ?? 0 }}-{{ $requests->lastItem() ?? 0 }}
                            of {{ $requests->total() }} requests
                        </span>
                    </div>
                    <div class="pagination-nav">{{ $requests->withQueryString()->links() }}</div>
                </div>
            @endif
        </div>
    </div>
</main>

<!-- Professional Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content professional-modal">
            <div class="modal-header danger-header">
                <h5 class="modal-title">
                    <span class="modal-icon">⚠️</span>
                    Confirm Permanent Profile Deletion
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="danger-warning">
                    <div class="warning-icon">🚨</div>
                    <div class="warning-content">
                        <h6 class="warning-title">Critical Action Warning</h6>
                        <p class="warning-text">This action will permanently delete the candidate's profile and all associated data. This operation cannot be undone.</p>
                    </div>
                </div>
                <div class="data-deletion-info">
                    <h6 class="deletion-title">Data That Will Be Permanently Deleted:</h6>
                    <ul class="deletion-list">
                        <li>Complete candidate profile and personal information</li>
                        <li>Resume, certificates, and professional documents</li>
                        <li>Sea service records and work history</li>
                        <li>Account access and login credentials</li>
                        <li>All communication history and logs</li>
                    </ul>
                </div>

                <div class="confirmation-input">
                    <label for="confirmDeleteInput" class="form-label confirmation-label">
                        Security Verification Required
                    </label>
                    <p class="verification-instruction">Type <strong>DELETE</strong> exactly to enable the deletion button:</p>
                    <input id="confirmDeleteInput" type="text" class="form-control verification-input"
                           placeholder="Type DELETE to confirm">
                </div>

                <div class="alternative-actions">
                    <p class="alternative-text">
                        <strong>Alternative:</strong> You can also view the full request details before proceeding with deletion.
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="professional-btn btn-secondary" data-bs-dismiss="modal">
                    Cancel & Review
                </button>
                <button type="button" id="modalConfirmBtn" class="professional-btn btn-danger" disabled>
                    <span class="btn-icon">🗑️</span>
                    <span>Permanently Delete Profile</span>
                </button>
            </div>
        </div>
    </div>
</div>


@push('styles')
<style>
/* Modern Professional Design System */
:root {
    --primary: #4F46E5;
    --primary-hover: #4338CA;
    --primary-light: #EEF2FF;
    --success: #10B981;
    --success-light: #ECFDF5;
    --warning: #F59E0B;
    --warning-light: #FFFBEB;
    --danger: #EF4444;
    --danger-hover: #DC2626;
    --danger-light: #FEF2F2;
    --info: #3B82F6;
    --info-light: #EFF6FF;
    --pending: #F59E0B;
    --pending-light: #FFFBEB;
    --processed: #10B981;
    --processed-light: #ECFDF5;
    --gray-50: #F9FAFB;
    --gray-100: #F3F4F6;
    --gray-200: #E5E7EB;
    --gray-300: #D1D5DB;
    --gray-400: #9CA3AF;
    --gray-500: #6B7280;
    --gray-600: #4B5563;
    --gray-700: #374151;
    --gray-800: #1F2937;
    --gray-900: #111827;
    --white: #FFFFFF;
    --radius-sm: 6px;
    --radius-md: 8px;
    --radius-lg: 12px;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
    --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Base Styles */
* {
    box-sizing: border-box;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
    line-height: 1.5;
    color: var(--gray-800);
    background: var(--gray-50);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.modern-bg {
    background: linear-gradient(135deg, #fafbff 0%, var(--gray-50) 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

/* Professional Breadcrumb */
.professional-breadcrumb {
    display: flex;
    align-items: center;
    background: var(--white);
    padding: 1rem 1.5rem;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
    margin: 0;
    list-style: none;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.breadcrumb-link {
    text-decoration: none;
    color: var(--gray-600);
    font-size: 0.875rem;
    font-weight: 500;
    padding: 0.375rem 0.75rem;
    border-radius: var(--radius-sm);
    transition: var(--transition);
}

.breadcrumb-link:hover {
    color: var(--primary);
    background: var(--primary-light);
}

.breadcrumb-separator {
    color: var(--gray-400);
    font-size: 1rem;
}

.breadcrumb-item.active {
    color: var(--gray-900);
    font-weight: 600;
    font-size: 0.875rem;
}

/* Professional Header */
.professional-header {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--gray-200);
    padding: 2rem;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    position: relative;
    overflow: hidden;
}

.professional-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--danger) 0%, var(--warning) 50%, var(--primary) 100%);
}

.header-title {
    margin: 0 0 0.5rem 0;
    font-size: 2rem;
    font-weight: 700;
    color: var(--gray-900);
    letter-spacing: -0.025em;
}

.header-subtitle {
    font-size: 1rem;
    color: var(--gray-600);
    margin-bottom: 1.5rem;
}

.status-label {
    font-weight: 600;
    color: var(--primary);
    text-transform: capitalize;
}

.header-stats {
    margin-top: 1rem;
}

.status-stats {
    display: flex;
    gap: 2rem;
}

.stat-item {
    text-align: center;
    padding: 0.75rem 1rem;
    border-radius: var(--radius-md);
    border: 1px solid;
}

.stat-item.pending {
    background: var(--pending-light);
    border-color: var(--pending);
}

.stat-item.processed {
    background: var(--processed-light);
    border-color: var(--processed);
}

.stat-item.total {
    background: var(--info-light);
    border-color: var(--info);
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--gray-900);
}

.stat-label {
    display: block;
    font-size: 0.75rem;
    color: var(--gray-600);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Filter Tabs */
.filter-tabs {
    display: flex;
    background: var(--gray-100);
    border-radius: var(--radius-md);
    padding: 0.25rem;
    gap: 0.25rem;
}

.filter-tab {
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius-sm);
    text-decoration: none;
    color: var(--gray-600);
    font-weight: 600;
    font-size: 0.875rem;
    transition: var(--transition);
    white-space: nowrap;
}

.filter-tab:hover {
    color: var(--gray-800);
    background: var(--white);
}

.filter-tab.active {
    background: var(--primary);
    color: var(--white);
    box-shadow: var(--shadow-sm);
}

/* Professional Alerts */
.professional-alert {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.5rem;
    border-radius: var(--radius-md);
    border: 1px solid;
    position: relative;
    box-shadow: var(--shadow-sm);
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

.alert-success {
    background: var(--success-light);
    border-color: var(--success);
    color: var(--gray-800);
}

.alert-dismiss {
    background: none;
    border: none;
    font-size: 1.25rem;
    cursor: pointer;
    opacity: 0.7;
    transition: var(--transition);
}

.alert-dismiss:hover {
    opacity: 1;
}

/* Professional Table Container */
.professional-table-container {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--gray-200);
    overflow: hidden;
}

.table-header-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    background: linear-gradient(135deg, var(--gray-50) 0%, #fafbff 100%);
    border-bottom: 1px solid var(--gray-200);
}

.table-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--gray-900);
}

.filter-input {
    padding: 0.5rem 1rem;
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    background: var(--white);
    transition: var(--transition);
    width: 320px;
}

.filter-input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    outline: none;
}

/* Professional Buttons */
.professional-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 600;
    border-radius: var(--radius-md);
    border: 2px solid transparent;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition);
    white-space: nowrap;
}

.btn-primary {
    background: var(--primary);
    color: var(--white);
    border-color: var(--primary);
}

.btn-primary:hover {
    background: var(--primary-hover);
    border-color: var(--primary-hover);
    transform: translateY(-1px);
}

.btn-secondary {
    background: var(--gray-100);
    color: var(--gray-700);
    border-color: var(--gray-300);
}

.btn-secondary:hover {
    background: var(--gray-200);
    border-color: var(--gray-400);
}

.btn-danger {
    background: var(--danger);
    color: var(--white);
    border-color: var(--danger);
}

.btn-danger:hover {
    background: var(--danger-hover);
    border-color: var(--danger-hover);
    transform: translateY(-1px);
}

.professional-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none !important;
}

/* Professional Compact Table */
.responsive-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.professional-compact-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
    background: var(--white);
}

.table-head {
    background: var(--gray-50);
}

.table-head th {
    padding: 1rem 0.75rem;
    text-align: left;
    font-weight: 700;
    color: var(--gray-700);
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid var(--gray-200);
    position: sticky;
    top: 0;
    z-index: 10;
}

.table-body {
    background: var(--white);
}

.table-row {
    transition: var(--transition);
    border-bottom: 1px solid var(--gray-100);
}

.table-row:hover {
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.02) 0%, rgba(79, 70, 229, 0.05) 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.pending-row {
    border-left: 4px solid var(--pending);
}

.processed-row {
    border-left: 4px solid var(--processed);
}

.table-row td {
    padding: 1rem 0.75rem;
    vertical-align: top;
    font-size: 0.875rem;
}

/* Cell Styling */
.id-wrapper {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.primary-id {
    font-weight: 700;
    color: var(--gray-900);
    font-size: 1rem;
}

.request-type {
    font-size: 0.6875rem;
    color: var(--danger);
    font-weight: 600;
    background: var(--danger-light);
    padding: 0.125rem 0.375rem;
    border-radius: 10px;
    display: inline-block;
    text-align: center;
    border: 1px solid var(--danger);
}

.candidate-wrapper {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    line-height: 1.3;
}

.candidate-name {
    font-weight: 600;
    color: var(--gray-900);
    font-size: 0.9375rem;
}

.candidate-email {
    font-size: 0.75rem;
    color: var(--gray-600);
}

.candidate-id {
    font-size: 0.6875rem;
    color: var(--gray-500);
    font-family: 'SF Mono', Monaco, 'Cascadia Code', monospace;
}

.candidate-deleted {
    padding: 0.5rem;
    background: var(--gray-100);
    border-radius: var(--radius-sm);
    text-align: center;
    color: var(--gray-500);
    font-style: italic;
    border: 1px solid var(--gray-300);
}

.reason-wrapper {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.primary-reason {
    font-weight: 600;
    color: var(--gray-800);
    text-transform: capitalize;
}

.other-reason {
    font-size: 0.8125rem;
    color: var(--gray-600);
    line-height: 1.4;
    font-style: italic;
}

.date-wrapper {
    display: flex;
    flex-direction: column;
    gap: 0.125rem;
}

.primary-date {
    font-weight: 600;
    color: var(--gray-800);
    font-size: 0.875rem;
}

.secondary-date {
    font-size: 0.75rem;
    color: var(--gray-600);
}

.relative-date {
    font-size: 0.6875rem;
    color: var(--gray-500);
}

/* Status Badges */
.status-badge {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    border-radius: var(--radius-md);
    font-weight: 600;
    font-size: 0.8125rem;
    border: 1px solid;
}

.status-badge.pending {
    background: var(--pending-light);
    color: var(--pending);
    border-color: var(--pending);
}

.status-badge.processed {
    background: var(--processed-light);
    color: var(--processed);
    border-color: var(--processed);
}

.status-badge.unknown {
    background: var(--gray-100);
    color: var(--gray-600);
    border-color: var(--gray-300);
}

.status-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
}

.status-badge.pending .status-indicator {
    background: var(--pending);
    animation: pulse 2s infinite;
}

.status-badge.processed .status-indicator {
    background: var(--processed);
}

.status-badge.unknown .status-indicator {
    background: var(--gray-400);
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

/* Action Buttons */
.action-group {
    display: flex;
    flex-direction: column;
    gap: 0.375rem;
}

.action-btn {
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
    font-weight: 600;
    border: 1px solid;
    border-radius: var(--radius-sm);
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition);
    display: inline-block;
    text-align: center;
    white-space: nowrap;
}

.view-btn {
    background: var(--info-light);
    color: var(--info);
    border-color: var(--info);
}

.view-btn:hover {
    background: var(--info);
    color: var(--white);
    transform: translateY(-1px);
}

.danger-btn {
    background: var(--danger-light);
    color: var(--danger);
    border-color: var(--danger);
}

.danger-btn:hover {
    background: var(--danger);
    color: var(--white);
    transform: translateY(-1px);
}

.processed-info {
    font-size: 0.75rem;
    color: var(--processed);
    font-weight: 600;
    text-align: center;
    padding: 0.375rem;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.empty-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--gray-700);
    margin-bottom: 0.5rem;
}

.empty-description {
    color: var(--gray-600);
    line-height: 1.5;
}

/* Professional Pagination */
.professional-pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    background: var(--gray-50);
    border-top: 1px solid var(--gray-200);
}

.showing-text {
    font-size: 0.875rem;
    color: var(--gray-600);
    font-weight: 500;
}

/* Professional Modal */
.professional-modal {
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    border: none;
    overflow: hidden;
}

.danger-header {
    background: linear-gradient(135deg, var(--danger) 0%, var(--danger-hover) 100%);
    color: var(--white);
    border-bottom: none;
    padding: 1.5rem 2rem;
}

.modal-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 700;
    font-size: 1.25rem;
}

.modal-icon {
    font-size: 1.5rem;
}

.modal-body {
    padding: 2rem;
}

.danger-warning {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    background: var(--danger-light);
    border: 1px solid var(--danger);
    border-radius: var(--radius-md);
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.warning-icon {
    font-size: 2rem;
    flex-shrink: 0;
}

.warning-title {
    font-weight: 700;
    color: var(--danger);
    margin: 0 0 0.5rem 0;
    font-size: 1.125rem;
}

.warning-text {
    color: var(--gray-800);
    margin: 0;
    line-height: 1.5;
}

.request-details {
    background: var(--gray-50);
    border-radius: var(--radius-md);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.details-title {
    font-weight: 700;
    color: var(--gray-900);
    margin: 0 0 1rem 0;
    font-size: 1rem;
}

.details-list {
    margin: 0;
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 0.5rem 1rem;
}

.details-list dt {
    font-weight: 600;
    color: var(--gray-600);
    font-size: 0.875rem;
}

.details-list dd {
    margin: 0;
    color: var(--gray-800);
    font-size: 0.875rem;
}

.data-deletion-info {
    background: var(--warning-light);
    border: 1px solid var(--warning);
    border-radius: var(--radius-md);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.deletion-title {
    font-weight: 700;
    color: var(--warning);
    margin: 0 0 1rem 0;
    font-size: 1rem;
}

.deletion-list {
    margin: 0;
    padding-left: 1.5rem;
    color: var(--gray-800);
}

.deletion-list li {
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
    line-height: 1.4;
}

.confirmation-input {
    margin-bottom: 1.5rem;
}

.confirmation-label {
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 0.5rem;
}

.verification-instruction {
    color: var(--gray-700);
    margin-bottom: 1rem;
    font-size: 0.9375rem;
}

.verification-input {
    padding: 0.75rem 1rem;
    border: 2px solid var(--gray-300);
    border-radius: var(--radius-md);
    font-size: 1rem;
    font-weight: 600;
    transition: var(--transition);
}

.verification-input:focus {
    border-color: var(--danger);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    outline: none;
}

.alternative-actions {
    background: var(--info-light);
    border: 1px solid var(--info);
    border-radius: var(--radius-md);
    padding: 1rem;
}

.alternative-text {
    margin: 0;
    color: var(--gray-800);
    font-size: 0.875rem;
}

.modal-footer {
    padding: 1.5rem 2rem;
    background: var(--gray-50);
    border-top: 1px solid var(--gray-200);
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

.btn-icon {
    font-size: 1rem;
}

/* Laravel Pagination Styling */
.pagination {
    display: flex;
    gap: 0.375rem;
    margin: 0;
    padding: 0;
    list-style: none;
}

.pagination .page-item {
    display: flex;
}

.pagination .page-link {
    padding: 0.625rem 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--gray-600);
    background: var(--white);
    border: 1px solid var(--gray-300);
    text-decoration: none;
    border-radius: var(--radius-md);
    transition: var(--transition);
}

.pagination .page-link:hover {
    background: var(--gray-50);
    color: var(--gray-800);
    border-color: var(--gray-400);
    transform: translateY(-1px);
}

.pagination .page-item.active .page-link {
    background: var(--primary);
    color: var(--white);
    border-color: var(--primary);
    box-shadow: var(--shadow-md);
}

.pagination .page-item.disabled .page-link {
    color: var(--gray-400);
    cursor: not-allowed;
    background: var(--gray-50);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .professional-header {
        flex-direction: column;
        gap: 1.5rem;
        align-items: flex-start;
        padding: 1.5rem;
    }

    .status-stats {
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: space-around;
        width: 100%;
    }

    .filter-tabs {
        width: 100%;
        justify-content: center;
    }

    .table-header-section {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
        padding: 1.5rem;
    }

    .filter-input {
        width: 100%;
    }
}

@media (max-width: 768px) {
    .modern-bg {
        padding: 1rem 0;
    }

    .professional-breadcrumb,
    .professional-header,
    .professional-table-container {
        margin-left: -0.5rem;
        margin-right: -0.5rem;
        border-radius: 0;
    }

    .table-head th,
    .table-row td {
        padding: 0.75rem 0.5rem;
        font-size: 0.8125rem;
    }

    /* Hide columns on mobile */
    .th-submitted, .td-submitted {
        display: none;
    }

    .professional-pagination {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
        padding: 1.5rem;
    }

    .action-group {
        flex-direction: row;
        gap: 0.25rem;
    }

    .action-btn {
        font-size: 0.6875rem;
        padding: 0.25rem 0.5rem;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        padding: 1rem 1.5rem;
        flex-direction: column;
    }

    .professional-btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    /* Hide more columns on very small screens */
    .th-reason, .td-reason {
        display: none;
    }

    .header-title {
        font-size: 1.5rem;
    }

    .status-stats {
        flex-direction: column;
        gap: 0.75rem;
    }

    .table-head th,
    .table-row td {
        padding: 0.5rem 0.375rem;
        font-size: 0.75rem;
    }

    .filter-tabs {
        flex-direction: column;
        padding: 0.5rem;
    }

    .filter-tab {
        text-align: center;
        padding: 0.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap modal
    const confirmModalEl = document.getElementById('confirmDeleteModal');
    const confirmModal = new bootstrap.Modal(confirmModalEl);
    const modalRequestId = document.getElementById('modalRequestId');
    const modalCandidateName = document.getElementById('modalCandidateName');
    const modalRequestedOn = document.getElementById('modalRequestedOn');
    const confirmInput = document.getElementById('confirmDeleteInput');
    const modalConfirmBtn = document.getElementById('modalConfirmBtn');

    let activeForm = null;

    // Handle delete modal opening
    document.querySelectorAll('.open-delete-modal').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            activeForm = this.closest('form.delete-form');
            if (!activeForm) return;

            // Populate modal data
            modalRequestId.textContent = activeForm.getAttribute('data-request-id') || '-';
            modalCandidateName.textContent = activeForm.getAttribute('data-candidate-name') || 'Unknown';

            const dateCell = activeForm.closest('tr')?.querySelector('.primary-date');
            modalRequestedOn.textContent = dateCell ? dateCell.textContent : '-';

            // Reset modal state
            confirmInput.value = '';
            modalConfirmBtn.disabled = true;
            modalConfirmBtn.innerHTML = '<span class="btn-icon">🗑️</span><span>Permanently Delete Profile</span>';

            // Show modal
            confirmModal.show();
        });
    });

    // Handle confirmation input validation
    confirmInput.addEventListener('input', function() {
        const isValid = this.value.trim() === 'DELETE';
        modalConfirmBtn.disabled = !isValid;

        if (isValid) {
            modalConfirmBtn.classList.add('pulse-effect');
        } else {
            modalConfirmBtn.classList.remove('pulse-effect');
        }
    });

    // Handle final confirmation
    modalConfirmBtn.addEventListener('click', function() {
        if (!activeForm || this.disabled) return;

        // Update button state
        this.disabled = true;
        this.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
            <span>Processing Deletion...</span>
        `;

        // Add processing class to form
        activeForm.classList.add('processing');

        // Submit form with slight delay for better UX
        setTimeout(() => {
            activeForm.submit();
        }, 500);
    });

    // Enhanced hover effects for action buttons
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            if (!this.disabled) {
                this.style.transform = 'translateY(-2px) scale(1.02)';
            }
        });

        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Auto-hide professional alerts
    document.querySelectorAll('.professional-alert').forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 350);
        }, 5000);
    });

    // Enhanced status badge hover effects
    document.querySelectorAll('.status-badge').forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });

        badge.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Professional button loading states
    document.querySelectorAll('.professional-btn[type="submit"]').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!this.disabled) {
                const originalContent = this.innerHTML;
                this.innerHTML = `
                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    <span>Processing...</span>
                `;
                this.disabled = true;

                // Restore if needed (fallback)
                setTimeout(() => {
                    if (this.disabled) {
                        this.innerHTML = originalContent;
                        this.disabled = false;
                    }
                }, 10000);
            }
        });
    });

    // Add CSS for pulse effect
    const style = document.createElement('style');
    style.textContent = `
        .pulse-effect {
            animation: pulseEffect 1.5s infinite;
        }

        @keyframes pulseEffect {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .processing {
            opacity: 0.7;
            pointer-events: none;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush
@endsection
