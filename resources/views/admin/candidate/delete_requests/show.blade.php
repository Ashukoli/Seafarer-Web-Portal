@extends('layouts.admin.app')

@section('title', 'Delete Request Details')

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
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.candidate.delete_requests.index') }}" class="breadcrumb-link">Delete Requests</a>
                        </li>
                        <li class="breadcrumb-separator">›</li>
                        <li class="breadcrumb-item active">Request #{{ $req->id ?? 'N/A' }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Professional Header -->
        <div class="professional-detail-header mb-4">
            <div class="header-left">
                <div class="header-title-group">
                    <h1 class="header-title">
                        Delete Request #{{ $req->id ?? 'N/A' }}
                    </h1>
                    <div class="header-subtitle">
                        Candidate profile deletion request details and processing
                    </div>
                </div>
                <div class="header-meta">
                    <div class="request-status">
                        @if(($req->status ?? '') === 'pending')
                            <div class="status-badge pending">
                                <div class="status-indicator"></div>
                                <span>Pending Review</span>
                            </div>
                        @elseif(($req->status ?? '') === 'processed')
                            <div class="status-badge processed">
                                <div class="status-indicator"></div>
                                <span>Processed</span>
                            </div>
                        @else
                            <div class="status-badge unknown">
                                <div class="status-indicator"></div>
                                <span>{{ ucfirst($req->status ?? 'Unknown') }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="request-timeline">
                        <span class="timeline-item">
                            Submitted: {{ optional($req->created_at)->format('M d, Y') ?? 'N/A' }}
                        </span>
                        @if($req->processed_at)
                            <span class="timeline-separator">•</span>
                            <span class="timeline-item">
                                Processed: {{ $req->processed_at->format('M d, Y') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="header-right">
                <a href="{{ route('admin.candidate.delete_requests.index') }}" class="professional-btn btn-secondary">
                    Back to List
                </a>
            </div>
        </div>

        <!-- Success/Error Alerts -->
        @if(session('success'))
            <div class="professional-alert alert-success mb-4">
                <div class="alert-content">{{ session('success') }}</div>
                <button type="button" class="alert-dismiss" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif

        @if(session('error'))
            <div class="professional-alert alert-error mb-4">
                <div class="alert-content">{{ session('error') }}</div>
                <button type="button" class="alert-dismiss" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif

        <div class="row">
            <!-- Main Request Details -->
            <div class="col-lg-8 mb-4">
                <div class="professional-detail-card">
                    <div class="card-header">
                        <div class="card-title">
                            Request Information
                        </div>
                        <div class="card-actions">
                            <div class="urgency-indicator {{ ($req->status ?? '') === 'pending' ? 'urgent' : 'completed' }}">
                                {{ ($req->status ?? '') === 'pending' ? 'Action Required' : 'Completed' }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="details-grid">
                            <!-- Candidate Information -->
                            <div class="detail-section">
                                <div class="section-title">Candidate Details</div>
                                <div class="detail-group">
                                    <div class="detail-item">
                                        <div class="detail-label">Full Name</div>
                                        <div class="detail-value candidate-name">
                                            @if($req->candidate)
                                                {{ optional($req->candidate->profile)->first_name ?? 'N/A' }} {{ optional($req->candidate->profile)->last_name ?? '' }}
                                            @else
                                                <span class="deleted-candidate">Candidate Profile Deleted</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Email Address</div>
                                        <div class="detail-value">
                                            @if($req->candidate && $req->candidate->email)
                                                <a href="mailto:{{ $req->candidate->email }}" class="email-link">
                                                    {{ $req->candidate->email }}
                                                </a>
                                            @else
                                                <span class="no-data">N/A</span>
                                            @endif
                                        </div>
                                    </div>
                                    @if($req->candidate && $req->candidate->id)
                                        <div class="detail-item">
                                            <div class="detail-label">Candidate ID</div>
                                            <div class="detail-value candidate-id">
                                                #{{ $req->candidate->id }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Request Details -->
                            <div class="detail-section">
                                <div class="section-title">Deletion Request</div>
                                <div class="detail-group">
                                    <div class="detail-item">
                                        <div class="detail-label">Primary Reason</div>
                                        <div class="detail-value primary-reason">
                                            {{ $req->reason ?? 'Not specified' }}
                                        </div>
                                    </div>
                                    @if(!empty($req->other_reason))
                                        <div class="detail-item">
                                            <div class="detail-label">Additional Details</div>
                                            <div class="detail-value other-reason">
                                                {{ $req->other_reason }}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="detail-item">
                                        <div class="detail-label">Request Submitted</div>
                                        <div class="detail-value request-date">
                                            <div class="primary-date">
                                                {{ optional($req->created_at)->format('F d, Y') ?? 'N/A' }}
                                            </div>
                                            <div class="secondary-date">
                                                {{ optional($req->created_at)->format('g:i A') ?? '' }}
                                                @if($req->created_at)
                                                    ({{ $req->created_at->diffForHumans() }})
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Processing Information -->
                            <div class="detail-section">
                                <div class="section-title">Processing Status</div>
                                <div class="detail-group">
                                    <div class="detail-item">
                                        <div class="detail-label">Current Status</div>
                                        <div class="detail-value">
                                            @if(($req->status ?? '') === 'pending')
                                                <div class="status-indicator-text pending">
                                                    Awaiting administrative review and processing
                                                </div>
                                            @elseif(($req->status ?? '') === 'processed')
                                                <div class="status-indicator-text processed">
                                                    Request has been processed and candidate profile deleted
                                                </div>
                                            @else
                                                <div class="status-indicator-text unknown">
                                                    Status: {{ ucfirst($req->status ?? 'Unknown') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if($req->processed_at)
                                        <div class="detail-item">
                                            <div class="detail-label">Processed Date</div>
                                            <div class="detail-value processed-date">
                                                <div class="primary-date">
                                                    {{ $req->processed_at->format('F d, Y') }}
                                                </div>
                                                <div class="secondary-date">
                                                    {{ $req->processed_at->format('g:i A') }}
                                                    ({{ $req->processed_at->diffForHumans() }})
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(!empty($req->processed_by))
                                        <div class="detail-item">
                                            <div class="detail-label">Processed By</div>
                                            <div class="detail-value processor-info">
                                                {{ optional($req->processor)->first_name ?? 'N/A' }} {{ optional($req->processor)->last_name ?? '' }}
                                                @if($req->processor && $req->processor->email)
                                                    <div class="processor-email">{{ $req->processor->email }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Panel -->
            <div class="col-lg-4 mb-4">
                <div class="professional-action-panel">
                    <div class="panel-header">
                        <div class="panel-title">Available Actions</div>
                    </div>
                    <div class="panel-body">
                        @if(($req->status ?? '') === 'pending')
                            <!-- Pending Actions -->
                            <div class="action-section">
                                <div class="action-title danger">⚠️ Critical Action Required</div>
                                <div class="action-description">
                                    This request requires immediate attention. Processing will permanently delete the candidate profile and all associated data.
                                </div>

                                <div class="action-warning">
                                    <div class="warning-title">⚠️ Warning</div>
                                    <ul class="warning-list">
                                        <li>This action cannot be undone</li>
                                        <li>All candidate data will be permanently deleted</li>
                                        <li>Associated records (resume, certificates, etc.) will be removed</li>
                                        <li>The candidate will lose access to their account</li>
                                    </ul>
                                </div>

                                <div class="action-buttons">
                                    <button type="button"
                                            class="professional-btn btn-danger btn-block"
                                            id="openModernConfirmationBtn"
                                            data-candidate-name="{{ optional($req->candidate->profile)->first_name ?? 'Unknown' }} {{ optional($req->candidate->profile)->last_name ?? '' }}"
                                            data-request-id="{{ $req->id }}"
                                            data-action-url="{{ route('admin.candidate.delete_requests.process', $req->id) }}">
                                        <span class="btn-icon">🗑️</span>
                                        <span>Process & Delete Profile</span>
                                    </button>
                                </div>
                            </div>
                        @else
                            <!-- Processed Status -->
                            <div class="action-section completed">
                                <div class="action-title success">✅ Request Processed</div>
                                <div class="action-description">
                                    This deletion request has been successfully processed. The candidate profile and all associated data have been permanently removed from the system.
                                </div>

                                <div class="completion-info">
                                    <div class="completion-item">
                                        <span class="completion-label">Status:</span>
                                        <span class="completion-value">{{ ucfirst($req->status ?? 'Processed') }}</span>
                                    </div>
                                    @if($req->processed_at)
                                        <div class="completion-item">
                                            <span class="completion-label">Completed:</span>
                                            <span class="completion-value">{{ $req->processed_at->format('M d, Y g:i A') }}</span>
                                        </div>
                                    @endif
                                    @if($req->processed_by)
                                        <div class="completion-item">
                                            <span class="completion-label">By:</span>
                                            <span class="completion-value">{{ optional($req->processor)->first_name ?? $req->processed_by }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="action-buttons">
                                    <button class="professional-btn btn-secondary btn-block" disabled>
                                        <span class="btn-icon">✅</span>
                                        <span>Already {{ ucfirst($req->status ?? 'Processed') }}</span>
                                    </button>
                                </div>
                            </div>
                        @endif

                        <!-- Navigation Actions -->
                        <div class="navigation-actions">
                            <a href="{{ route('admin.candidate.delete_requests.index') }}" class="professional-btn btn-outline btn-block">
                                Back to Requests List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modern Confirmation Modal -->
<div id="modernConfirmationModal" class="modern-modal-overlay" style="display: none;">
    <div class="modern-modal-container">
        <div class="modern-modal-content">
            <!-- Modal Header -->
            <div class="modern-modal-header">
                <div class="modal-header-icon">
                    <div class="icon-circle danger">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                            <path d="M12 2L22 20H2L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 9V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 17H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="modal-header-content">
                    <h2 class="modal-title">Critical Profile Deletion</h2>
                    <p class="modal-subtitle">This action will permanently delete all candidate data</p>
                </div>
                <button type="button" class="modal-close-btn" id="closeModalBtn">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modern-modal-body">
                <!-- Alert Section -->
                <div class="modal-alert danger">
                    <div class="alert-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                            <path d="M15 9L9 15M9 9L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="alert-content">
                        <h4 class="alert-title">IRREVERSIBLE ACTION WARNING</h4>
                        <p class="alert-description">You are about to permanently delete a candidate profile. This operation cannot be undone and will result in complete data loss.</p>
                    </div>
                </div>

                <!-- Request Details -->
                <div class="modal-section">
                    <h5 class="section-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                            <path d="M12 16V12M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Request Information
                    </h5>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Request ID</span>
                            <span class="info-value" id="modalRequestId">-</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Candidate Name</span>
                            <span class="info-value" id="modalCandidateName">-</span>
                        </div>
                    </div>
                </div>

                <!-- Data Impact -->
                <div class="modal-section">
                    <h5 class="section-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M14 2H6A2 2 0 0 0 4 4V20A2 2 0 0 0 6 22H18A2 2 0 0 0 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Data That Will Be Permanently Deleted
                    </h5>
                    <div class="deletion-categories">
                        <div class="deletion-category">
                            <div class="category-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M20 21V19A4 4 0 0 0 16 15H8A4 4 0 0 0 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                            <div class="category-content">
                                <span class="category-title">Personal Information</span>
                                <ul class="category-items">
                                    <li>Complete candidate profile</li>
                                    <li>Contact details and addresses</li>
                                    <li>Personal documents</li>
                                </ul>
                            </div>
                        </div>
                        <div class="deletion-category">
                            <div class="category-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                    <line x1="8" y1="21" x2="16" y2="21" stroke="currentColor" stroke-width="2"/>
                                    <line x1="12" y1="17" x2="12" y2="21" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                            <div class="category-content">
                                <span class="category-title">Professional Data</span>
                                <ul class="category-items">
                                    <li>Resume and work experience</li>
                                    <li>Certifications and licenses</li>
                                    <li>Sea service records</li>
                                </ul>
                            </div>
                        </div>
                        <div class="deletion-category">
                            <div class="category-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                    <circle cx="12" cy="16" r="1" stroke="currentColor" stroke-width="2"/>
                                    <path d="M7 11V7A5 5 0 0 1 17 7V11" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                            <div class="category-content">
                                <span class="category-title">Account Access</span>
                                <ul class="category-items">
                                    <li>Login credentials</li>
                                    <li>Account permissions</li>
                                    <li>Session data</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Verification Section -->
                <div class="modal-section verification-section">
                    <h5 class="section-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2"/>
                        </svg>
                        Security Verification Required
                    </h5>
                    <div class="verification-content">
                        <p class="verification-instruction">
                            Type <strong>PERMANENT DELETE</strong> exactly to enable the deletion button:
                        </p>
                        <div class="verification-input-group">
                            <input type="text"
                                   id="confirmationInput"
                                   class="verification-input"
                                   placeholder="Type PERMANENT DELETE"
                                   autocomplete="off">
                            <div class="input-status" id="inputStatus">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                    <path d="M15 9L9 15M9 9L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="verification-hint">
                            Case sensitive - must match exactly: <code>PERMANENT DELETE</code>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modern-modal-footer">
                <div class="footer-info">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 16V12M12 8H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>This action will be logged and tracked for audit purposes</span>
                </div>
                <div class="footer-actions">
                    <button type="button" class="modern-btn btn-secondary" id="cancelBtn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Cancel & Review
                    </button>
                    <button type="button" class="modern-btn btn-danger" id="confirmDeleteBtn" disabled>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                            <polyline points="3,6 5,6 21,6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 6V4A2 2 0 0 1 10 2H14A2 2 0 0 1 16 4V6M19 6V20A2 2 0 0 1 17 22H7A2 2 0 0 1 5 20V6H19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Permanently Delete Profile
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Form for Submission -->
<form id="hiddenDeleteForm" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="confirm" value="yes">
</form>


@push('styles')
<style>
/* Modern Design System */
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

/* Professional Detail Header */
.professional-detail-header {
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

.professional-detail-header::before {
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

.header-meta {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.request-status {
    align-self: flex-start;
}

.request-timeline {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--gray-600);
    flex-wrap: wrap;
}

.timeline-separator {
    color: var(--gray-400);
}

/* Status Badges */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    border-radius: var(--radius-md);
    font-weight: 600;
    font-size: 0.875rem;
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

/* Professional Buttons */
.professional-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    border-radius: var(--radius-md);
    border: 2px solid transparent;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition);
    white-space: nowrap;
}

.btn-secondary {
    background: var(--gray-100);
    color: var(--gray-700);
    border-color: var(--gray-300);
}

.btn-secondary:hover {
    background: var(--gray-200);
    border-color: var(--gray-400);
    color: var(--gray-800);
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
    box-shadow: var(--shadow-lg);
}

.btn-outline {
    background: transparent;
    color: var(--gray-700);
    border-color: var(--gray-300);
}

.btn-outline:hover {
    background: var(--gray-50);
    border-color: var(--gray-400);
}

.btn-block {
    width: 100%;
}

.professional-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none !important;
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
}

.alert-success {
    background: var(--success-light);
    border-color: var(--success);
    color: var(--gray-800);
}

.alert-error {
    background: var(--danger-light);
    border-color: var(--danger);
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

/* Professional Detail Card */
.professional-detail-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--gray-200);
    overflow: hidden;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem;
    background: linear-gradient(135deg, var(--gray-50) 0%, #fafbff 100%);
    border-bottom: 1px solid var(--gray-200);
}

.card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--gray-900);
}

.urgency-indicator {
    padding: 0.375rem 0.75rem;
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.urgency-indicator.urgent {
    background: var(--danger-light);
    color: var(--danger);
    border: 1px solid var(--danger);
}

.urgency-indicator.completed {
    background: var(--success-light);
    color: var(--success);
    border: 1px solid var(--success);
}

.card-body {
    padding: 2rem;
}

/* Details Grid */
.details-grid {
    display: flex;
    flex-direction: column;
    gap: 2.5rem;
}

.detail-section {
    border-left: 4px solid var(--primary-light);
    padding-left: 1.5rem;
}

.section-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 1.5rem;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -0.5rem;
    left: 0;
    width: 2rem;
    height: 2px;
    background: var(--primary);
    border-radius: 1px;
}

.detail-group {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.detail-label {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--gray-600);
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.detail-value {
    font-size: 1rem;
    color: var(--gray-800);
    line-height: 1.5;
}

.candidate-name {
    font-weight: 600;
    font-size: 1.125rem;
    color: var(--gray-900);
}

.deleted-candidate {
    color: var(--danger);
    font-style: italic;
    font-weight: 500;
}

.email-link {
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
}

.email-link:hover {
    text-decoration: underline;
}

.candidate-id {
    font-family: 'SF Mono', Monaco, 'Cascadia Code', monospace;
    font-weight: 600;
    color: var(--gray-600);
}

.primary-reason {
    font-weight: 600;
    color: var(--gray-900);
    text-transform: capitalize;
}

.other-reason {
    color: var(--gray-700);
    font-style: italic;
    background: var(--gray-50);
    padding: 1rem;
    border-radius: var(--radius-sm);
    border-left: 4px solid var(--gray-300);
}

.request-date,
.processed-date {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.primary-date {
    font-weight: 600;
    color: var(--gray-900);
}

.secondary-date {
    font-size: 0.875rem;
    color: var(--gray-600);
}

.status-indicator-text {
    padding: 1rem;
    border-radius: var(--radius-md);
    font-weight: 500;
    border: 1px solid;
}

.status-indicator-text.pending {
    background: var(--pending-light);
    color: var(--pending);
    border-color: var(--pending);
}

.status-indicator-text.processed {
    background: var(--processed-light);
    color: var(--processed);
    border-color: var(--processed);
}

.status-indicator-text.unknown {
    background: var(--gray-100);
    color: var(--gray-600);
    border-color: var(--gray-300);
}

.processor-info {
    font-weight: 600;
    color: var(--gray-900);
}

.processor-email {
    font-size: 0.875rem;
    color: var(--gray-600);
    font-weight: 400;
}

.no-data {
    color: var(--gray-400);
    font-style: italic;
}

/* Professional Action Panel */
.professional-action-panel {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--gray-200);
    overflow: hidden;
    position: sticky;
    top: 2rem;
}

.panel-header {
    padding: 1.5rem 2rem;
    background: linear-gradient(135deg, var(--gray-50) 0%, #fafbff 100%);
    border-bottom: 1px solid var(--gray-200);
}

.panel-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--gray-900);
}

.panel-body {
    padding: 2rem;
}

.action-section {
    margin-bottom: 2rem;
}

.action-section:last-child {
    margin-bottom: 0;
}

.action-title {
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 1rem;
    padding: 0.75rem;
    border-radius: var(--radius-sm);
}

.action-title.danger {
    background: var(--danger-light);
    color: var(--danger);
    border: 1px solid var(--danger);
}

.action-title.success {
    background: var(--success-light);
    color: var(--success);
    border: 1px solid var(--success);
}

.action-description {
    font-size: 0.875rem;
    color: var(--gray-700);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.action-warning {
    background: var(--warning-light);
    border: 1px solid var(--warning);
    border-radius: var(--radius-md);
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.warning-title {
    font-weight: 700;
    color: var(--warning);
    margin-bottom: 1rem;
    font-size: 0.9375rem;
}

.warning-list {
    margin: 0;
    padding-left: 1.5rem;
    color: var(--gray-700);
}

.warning-list li {
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.completion-info {
    background: var(--success-light);
    border: 1px solid var(--success);
    border-radius: var(--radius-md);
    padding: 1.5rem;
    margin-bottom: 2rem;
}

.completion-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
}

.completion-item:last-child {
    margin-bottom: 0;
}

.completion-label {
    font-weight: 600;
    color: var(--gray-700);
    font-size: 0.875rem;
}

.completion-value {
    font-weight: 500;
    color: var(--gray-900);
    font-size: 0.875rem;
}

.navigation-actions {
    border-top: 1px solid var(--gray-200);
    padding-top: 2rem;
    margin-top: 2rem;
}

.btn-icon {
    font-size: 1rem;
}

/* Modern Confirmation Modal */
.modern-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.75);
    backdrop-filter: blur(8px);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    animation: modalOverlayFadeIn 0.3s ease-out;
}

@keyframes modalOverlayFadeIn {
    from {
        opacity: 0;
        backdrop-filter: blur(0px);
    }
    to {
        opacity: 1;
        backdrop-filter: blur(8px);
    }
}

.modern-modal-container {
    width: 100%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
    animation: modalSlideIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: scale(0.8) translateY(40px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

.modern-modal-content {
    background: var(--white);
    border-radius: 16px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    overflow: hidden;
    position: relative;
}

/* Modal Header */
.modern-modal-header {
    background: linear-gradient(135deg, var(--danger) 0%, var(--danger-hover) 100%);
    color: var(--white);
    padding: 2rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    position: relative;
}

.modern-modal-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="danger-grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23danger-grid)"/></svg>');
    opacity: 0.3;
}

.modal-header-icon {
    position: relative;
    z-index: 1;
}

.icon-circle {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.icon-circle.danger {
    color: var(--white);
}

.modal-header-content {
    flex: 1;
    position: relative;
    z-index: 1;
}

.modal-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
}

.modal-subtitle {
    font-size: 1rem;
    opacity: 0.9;
    margin: 0;
    line-height: 1.4;
}

.modal-close-btn {
    position: relative;
    z-index: 1;
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 12px;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    cursor: pointer;
    transition: var(--transition);
}

.modal-close-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.05);
}

/* Modal Body */
.modern-modal-body {
    padding: 2rem;
    max-height: 60vh;
    overflow-y: auto;
}

.modern-modal-body::-webkit-scrollbar {
    width: 6px;
}

.modern-modal-body::-webkit-scrollbar-track {
    background: var(--gray-100);
    border-radius: 3px;
}

.modern-modal-body::-webkit-scrollbar-thumb {
    background: var(--gray-300);
    border-radius: 3px;
}

.modern-modal-body::-webkit-scrollbar-thumb:hover {
    background: var(--gray-400);
}

/* Modal Alert */
.modal-alert {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    border: 2px solid;
}

.modal-alert.danger {
    background: linear-gradient(135deg, var(--danger-light) 0%, #fef2f2 100%);
    border-color: var(--danger);
}

.modal-alert .alert-icon {
    width: 48px;
    height: 48px;
    background: var(--danger);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    flex-shrink: 0;
}

.modal-alert .alert-content {
    flex: 1;
}

.modal-alert .alert-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--danger);
    margin: 0 0 0.5rem 0;
}

.modal-alert .alert-description {
    color: var(--gray-700);
    margin: 0;
    line-height: 1.5;
}

/* Modal Sections */
.modal-section {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: var(--gray-50);
    border-radius: 12px;
    border: 1px solid var(--gray-200);
}

.modal-section .section-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--gray-900);
    margin: 0 0 1.5rem 0;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--gray-200);
}

.modal-section .section-title svg {
    color: var(--primary);
}

/* Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.info-label {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--gray-600);
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.info-value {
    font-size: 1rem;
    font-weight: 500;
    color: var(--gray-900);
    padding: 0.75rem;
    background: var(--white);
    border-radius: 8px;
    border: 1px solid var(--gray-200);
}

/* Deletion Categories */
.deletion-categories {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

.deletion-category {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: var(--white);
    border-radius: 8px;
    border: 1px solid var(--gray-200);
}

.category-icon {
    width: 40px;
    height: 40px;
    background: var(--danger-light);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--danger);
    flex-shrink: 0;
}

.category-content {
    flex: 1;
}

.category-title {
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 0.5rem;
    display: block;
}

.category-items {
    list-style: none;
    margin: 0;
    padding: 0;
}

.category-items li {
    color: var(--gray-700);
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
    position: relative;
    padding-left: 1rem;
}

.category-items li::before {
    content: '•';
    color: var(--danger);
    position: absolute;
    left: 0;
    font-weight: bold;
}

/* Verification Section */
.verification-section {
    background: linear-gradient(135deg, var(--warning-light) 0%, #fef3c7 100%);
    border-color: var(--warning);
}

.verification-content {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.verification-instruction {
    color: var(--gray-700);
    text-align: center;
    font-size: 1rem;
    margin: 0;
}

.verification-input-group {
    position: relative;
    display: flex;
    align-items: center;
}

.verification-input {
    width: 100%;
    padding: 1rem 1rem 1rem 1rem;
    border: 2px solid var(--warning);
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    background: var(--white);
    transition: var(--transition);
    text-align: center;
}

.verification-input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    outline: none;
}

.verification-input.valid {
    border-color: var(--success);
    background: var(--success-light);
}

.input-status {
    position: absolute;
    right: 1rem;
    color: var(--danger);
    transition: var(--transition);
}

.input-status.valid {
    color: var(--success);
}

.verification-hint {
    text-align: center;
    font-size: 0.875rem;
    color: var(--gray-600);
}

.verification-hint code {
    background: var(--warning);
    color: var(--white);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-family: 'SF Mono', Monaco, 'Cascadia Code', monospace;
    font-weight: 600;
}

/* Modal Footer */
.modern-modal-footer {
    background: linear-gradient(135deg, var(--gray-50) 0%, #f8fafc 100%);
    border-top: 1px solid var(--gray-200);
    padding: 1.5rem 2rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.footer-info {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--gray-600);
}

.footer-info svg {
    color: var(--info);
}

.footer-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    align-items: center;
}

/* Modern Buttons */
.modern-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    border-radius: 12px;
    border: 2px solid transparent;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition);
    white-space: nowrap;
}

.modern-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none !important;
}

.modern-btn.btn-secondary {
    background: var(--gray-100);
    color: var(--gray-700);
    border-color: var(--gray-300);
}

.modern-btn.btn-secondary:hover:not(:disabled) {
    background: var(--gray-200);
    border-color: var(--gray-400);
    color: var(--gray-800);
    transform: translateY(-2px);
}

.modern-btn.btn-danger {
    background: var(--danger);
    color: var(--white);
    border-color: var(--danger);
    position: relative;
    overflow: hidden;
}

.modern-btn.btn-danger:hover:not(:disabled) {
    background: var(--danger-hover);
    border-color: var(--danger-hover);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
}

.modern-btn.btn-danger:disabled {
    background: var(--gray-300);
    color: var(--gray-500);
    border-color: var(--gray-300);
}

/* Loading State */
.modern-btn.loading {
    pointer-events: none;
    position: relative;
}

.modern-btn.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.modern-btn.loading svg,
.modern-btn.loading span {
    opacity: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-modal-container {
        max-width: 95vw;
        max-height: 95vh;
        margin: 0;
    }

    .modern-modal-header {
        padding: 1.5rem;
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }

    .icon-circle {
        width: 56px;
        height: 56px;
    }

    .modal-title {
        font-size: 1.5rem;
    }

    .modern-modal-body {
        padding: 1.5rem;
        max-height: 65vh;
    }

    .modal-section {
        padding: 1rem;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .deletion-category {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .footer-actions {
        flex-direction: column;
        width: 100%;
    }

    .modern-btn {
        width: 100%;
        justify-content: center;
    }

    .modern-modal-footer {
        padding: 1rem 1.5rem;
    }
}

@media (max-width: 480px) {
    .modern-modal-overlay {
        padding: 0.5rem;
    }

    .modal-header-icon {
        display: none;
    }

    .modern-modal-header {
        padding: 1rem;
    }

    .modern-modal-body {
        padding: 1rem;
    }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .professional-detail-header {
        flex-direction: column;
        gap: 1.5rem;
        align-items: flex-start;
        padding: 1.5rem;
    }

    .header-meta {
        width: 100%;
    }

    .request-timeline {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.25rem;
    }

    .professional-action-panel {
        position: static;
    }
}

@media (max-width: 768px) {
    .modern-bg {
        padding: 1rem 0;
    }

    .professional-breadcrumb,
    .professional-detail-header,
    .professional-detail-card,
    .professional-action-panel {
        margin-left: -0.5rem;
        margin-right: -0.5rem;
        border-radius: 0;
    }

    .card-header,
    .card-body,
    .panel-header,
    .panel-body {
        padding: 1.5rem;
    }

    .header-title {
        font-size: 1.5rem;
    }

    .detail-section {
        padding-left: 1rem;
        border-left-width: 3px;
    }

    .details-grid {
        gap: 2rem;
    }

    .detail-group {
        gap: 1rem;
    }

    .professional-btn {
        font-size: 0.8125rem;
        padding: 0.625rem 1.25rem;
    }
}

@media (max-width: 480px) {
    .request-timeline {
        font-size: 0.8125rem;
    }

    .status-badge {
        padding: 0.5rem 0.75rem;
        font-size: 0.8125rem;
    }

    .detail-item {
        gap: 0.375rem;
    }

    .detail-label {
        font-size: 0.8125rem;
    }

    .detail-value {
        font-size: 0.9375rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get modal elements
    const modal = document.getElementById('modernConfirmationModal');
    const openBtn = document.getElementById('openModernConfirmationBtn');
    const closeBtn = document.getElementById('closeModalBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    const confirmationInput = document.getElementById('confirmationInput');
    const inputStatus = document.getElementById('inputStatus');
    const modalRequestId = document.getElementById('modalRequestId');
    const modalCandidateName = document.getElementById('modalCandidateName');
    const hiddenForm = document.getElementById('hiddenDeleteForm');

    let currentData = null;

    // Open modal
    if (openBtn) {
        openBtn.addEventListener('click', function() {
            currentData = {
                requestId: this.getAttribute('data-request-id'),
                candidateName: this.getAttribute('data-candidate-name'),
                actionUrl: this.getAttribute('data-action-url')
            };

            // Populate modal data
            modalRequestId.textContent = currentData.requestId || '-';
            modalCandidateName.textContent = currentData.candidateName || 'Unknown';

            // Reset form state
            confirmationInput.value = '';
            confirmBtn.disabled = true;
            updateInputStatus(false);

            // Show modal
            modal.style.display = 'flex';
            setTimeout(() => confirmationInput.focus(), 300);
        });
    }

    // Close modal functions
    function closeModal() {
        modal.style.display = 'none';
        confirmationInput.value = '';
        confirmBtn.disabled = true;
        updateInputStatus(false);
    }

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

    // Close on overlay click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) closeModal();
    });

    // Handle input validation
    if (confirmationInput) {
        confirmationInput.addEventListener('input', function() {
            const value = this.value.trim();
            const isValid = value === 'PERMANENT DELETE';

            confirmBtn.disabled = !isValid;
            updateInputStatus(isValid);

            if (isValid) {
                this.classList.add('valid');
            } else {
                this.classList.remove('valid');
            }
        });
    }

    // Update input status
    function updateInputStatus(isValid) {
        if (isValid) {
            inputStatus.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            `;
            inputStatus.classList.add('valid');
        } else {
            inputStatus.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                    <path d="M15 9L9 15M9 9L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            `;
            inputStatus.classList.remove('valid');
        }
    }

    // Handle final confirmation
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            if (!currentData || this.disabled) return;

            // Show loading state
            this.classList.add('loading');
            this.disabled = true;

            // Set up hidden form
            hiddenForm.action = currentData.actionUrl;

            // Submit after delay
            setTimeout(() => {
                hiddenForm.submit();
            }, 1500);
        });
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (modal.style.display === 'flex') {
            if (e.key === 'Escape') {
                closeModal();
            } else if (e.key === 'Enter' && !confirmBtn.disabled) {
                confirmBtn.click();
            }
        }
    });

    // Auto-hide alerts
    document.querySelectorAll('.professional-alert').forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });

    // Enhanced hover effects
    document.querySelectorAll('.professional-btn, .modern-btn').forEach(btn => {
        if (!btn.disabled && !btn.classList.contains('loading')) {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px) scale(1.02)';
            });

            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        }
    });

    // Status badge hover effects
    document.querySelectorAll('.status-badge').forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });

        badge.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Email link tracking
    document.querySelectorAll('.email-link').forEach(link => {
        link.addEventListener('click', function(e) {
            console.log('Email link clicked:', this.href);
        });
    });
});
</script>
@endpush
@endsection
