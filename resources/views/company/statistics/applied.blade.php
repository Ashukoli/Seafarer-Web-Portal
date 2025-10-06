@extends('layouts.company.app')
@section('content')
<main class="page-content professional-bg">
    <!--Enhanced Professional Breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3">
            <i class="bx bx-buildings me-2 text-primary"></i>Company
        </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 enhanced-breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('company.dashboard') }}" class="breadcrumb-link">
                            <i class="bx bx-home-alt"></i>Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="breadcrumb-link">
                            <i class="bx bx-briefcase"></i>Job Postings
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bx bx-user-check"></i>Applied Candidates
                    </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button class="btn btn-outline-secondary" onclick="exportCandidatesList()" aria-label="Export candidates list">
                    <i class="bx bx-export"></i>Export List
                </button>
                <button class="btn btn-primary" onclick="downloadAllResumes()" aria-label="Download all resumes">
                    <i class="bx bx-download"></i>Download All
                </button>
            </div>
        </div>
    </div>

    <!--Mobile Breadcrumb-->
    <div class="mobile-breadcrumb d-flex d-sm-none align-items-center mb-3 px-3">
        <button class="btn-back me-3" onclick="history.back()" aria-label="Go back to previous page">
            <i class="bx bx-arrow-back"></i>
        </button>
        <div class="breadcrumb-mobile">
            <div class="current-page">Applied Candidates</div>
            <div class="page-subtitle">Candidates who applied to your job posting</div>
        </div>
    </div>

    <div class="applied-candidates-container">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Job Posting Info Card -->
                <div class="job-info-card">
                    <div class="job-info-header">
                        <div class="job-info-left">
                            <div class="job-icon">
                                <i class="bx bx-anchor"></i>
                            </div>
                            <div class="job-details">
                                <h4 class="job-title">Master - Bulk Carrier</h4>
                                <div class="job-meta">
                                    <span class="job-meta-item">
                                        <i class="bx bx-calendar"></i>Posted: 15th Jul, 2025
                                    </span>
                                    <span class="job-meta-item">
                                        <i class="bx bx-time"></i>Expires: 15th Sep, 2025
                                    </span>
                                    <span class="job-meta-item">
                                        <i class="bx bx-map"></i>Location: Mumbai, India
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="job-info-right">
                            <div class="job-stats">
                                <div class="stat-item">
                                    <div class="stat-number">47</div>
                                    <div class="stat-label">Total Applications</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">12</div>
                                    <div class="stat-label">Premium Candidates</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">8</div>
                                    <div class="stat-label">Contacted</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Results Card -->
                <div class="results-card">
                    <!-- Results Header -->
                    <div class="results-header">
                        <div class="results-info">
                            <h5 class="results-title">Applied Candidates</h5>
                            <p class="results-count" id="resultsCount">
                                <span class="count-number">47</span> candidates have applied to this position
                            </p>
                        </div>
                        <div class="results-actions">
                            <button class="btn btn-outline-secondary btn-sm" onclick="toggleViewMode()" aria-label="Toggle view mode">
                                <i class="bx bx-grid-alt" id="viewIcon"></i>
                            </button>
                            <select class="sort-select" id="quickSort" aria-label="Sort candidates by">
                                <option value="recent">Most Recent</option>
                                <option value="premium">Premium First</option>
                                <option value="contacted">Contacted</option>
                                <option value="experience">Most Experienced</option>
                                <option value="name">Name A-Z</option>
                            </select>
                            <button class="btn btn-primary btn-sm" onclick="bulkActions()" aria-label="Bulk actions">
                                <i class="bx bx-check-square"></i>Bulk Actions
                            </button>
                        </div>
                    </div>

                    <!-- Status Filter Tabs -->
                    <div class="status-tabs">
                        <button class="status-tab active" onclick="filterByStatus('all')" data-count="47">
                            <i class="bx bx-list-ul"></i>All Candidates
                        </button>
                        <button class="status-tab" onclick="filterByStatus('new')" data-count="23">
                            <i class="bx bx-file-plus"></i>New Applications
                        </button>
                        <button class="status-tab" onclick="filterByStatus('reviewed')" data-count="16">
                            <i class="bx bx-check-circle"></i>Reviewed
                        </button>
                        <button class="status-tab" onclick="filterByStatus('contacted')" data-count="8">
                            <i class="bx bx-phone"></i>Contacted
                        </button>
                        <button class="status-tab" onclick="filterByStatus('rejected')" data-count="0">
                            <i class="bx bx-x-circle"></i>Rejected
                        </button>
                    </div>

                    <!-- Loading State -->
                    <div class="loading-state" id="loadingState" style="display: none;">
                        <div class="loading-spinner">
                            <i class="bx bx-loader-alt bx-spin"></i>
                        </div>
                        <p>Loading candidates...</p>
                    </div>

                    <!-- Candidates Grid -->
                    <div class="candidates-grid" id="candidatesGrid">
                        <!-- Premium Candidate Card 1 -->
                        <div class="candidate-card premium-candidate" data-id="SJ0023343" data-status="new">
                            <div class="candidate-checkbox">
                                <input type="checkbox" id="candidate_SJ0023343" class="candidate-select">
                            </div>
                            <div class="premium-overlay">
                                <div class="premium-crown">
                                    <i class="bx bx-crown"></i>
                                </div>
                            </div>
                            <div class="candidate-status">
                                <span class="status-badge online">Online</span>
                                <span class="premium-badge-enhanced">
                                    <i class="bx bx-star"></i>Premium
                                </span>
                                <span class="application-badge new">New Application</span>
                            </div>
                            <div class="candidate-header">
                                <div class="candidate-avatar">
                                    <img src="https://ui-avatars.com/api/?name=John+Smith&size=60&background=6366f1&color=ffffff&bold=true"
                                         alt="John Smith profile picture"
                                         onerror="this.onerror=null; this.src='https://via.placeholder.com/60x60/6366f1/ffffff?text=JS';">
                                </div>
                                <div class="candidate-info">
                                    <h6 class="candidate-name">John Smith</h6>
                                    <p class="candidate-title">Master Mariner</p>
                                    <p class="candidate-location">
                                        <i class="bx bx-map"></i>Mumbai, India
                                    </p>
                                    <p class="application-date">
                                        <i class="bx bx-calendar"></i>Applied: 28th Jul, 2025
                                    </p>
                                </div>
                            </div>

                            <!-- Compact Details Section with Posted Date -->
                            <div class="candidate-details-compact">
                                <div class="detail-row-compact">
                                    <span class="detail-compact">Age: <strong>45</strong></span>
                                    <span class="detail-compact">Experience: <strong>18 yrs</strong></span>
                                    <span class="detail-compact">Nationality: <strong>Indian</strong></span>
                                </div>
                                <div class="detail-row-compact">
                                    <span class="detail-compact">Present Rank: <strong>Master</strong></span>
                                    <span class="detail-compact">Applied For: <strong>Master</strong></span>
                                </div>
                                <div class="detail-row-compact">
                                    <span class="detail-compact">COC: <strong>Indian</strong></span>
                                    <span class="detail-compact">Availability: <strong>15th Aug, 2025</strong></span>
                                </div>
                            </div>

                            <!-- Multi-line Ship Types -->
                            <div class="ship-types-section">
                                <div class="ship-types-label">Ship Types:</div>
                                <div class="ship-types-tags">
                                    <span class="ship-tag experienced">Bulk Carrier</span>
                                    <span class="ship-tag experienced">Tanker</span>
                                    <span class="ship-tag basic">Container Ship</span>
                                    <span class="ship-tag experienced">General Cargo</span>
                                    <span class="ship-tag basic">Offshore Vessel</span>
                                    <span class="ship-tag experienced">Chemical Tanker</span>
                                </div>
                            </div>

                            <div class="candidate-actions">
                                <button class="btn btn-primary btn-sm" onclick="viewResume('SJ0023343')">
                                    <i class="bx bx-file-text"></i>View Resume
                                </button>
                                <button class="btn btn-outline-secondary btn-sm" onclick="downloadProfile('SJ0023343')">
                                    <i class="bx bx-download"></i>Download
                                </button>
                                <button class="btn btn-outline-primary btn-sm" onclick="contactCandidate('SJ0023343')">
                                    <i class="bx bx-phone"></i>Contact
                                </button>
                                <button class="btn btn-outline-success btn-sm" onclick="shortlistCandidate('SJ0023343')">
                                    <i class="bx bx-check"></i>Shortlist
                                </button>
                            </div>
                        </div>

                        <!-- Professional Regular Candidate Card 2 -->
                        <div class="candidate-card professional-candidate" data-id="SJ0063502" data-status="reviewed">
                            <div class="candidate-checkbox">
                                <input type="checkbox" id="candidate_SJ0063502" class="candidate-select">
                            </div>
                            <div class="professional-accent-line"></div>
                            <div class="candidate-status">
                                <span class="status-badge offline">Offline</span>
                                <span class="verified-badge">
                                    <i class="bx bx-check-shield"></i>Verified
                                </span>
                                <span class="application-badge reviewed">Reviewed</span>
                            </div>
                            <div class="candidate-header">
                                <div class="candidate-avatar">
                                    <img src="https://ui-avatars.com/api/?name=Raj+Singh&size=60&background=64748b&color=ffffff&bold=true"
                                         alt="Raj Singh profile picture"
                                         onerror="this.onerror=null; this.src='https://via.placeholder.com/60x60/64748b/ffffff?text=RS';">
                                </div>
                                <div class="candidate-info">
                                    <h6 class="candidate-name">Raj Singh</h6>
                                    <p class="candidate-title">Chief Engineer</p>
                                    <p class="candidate-location">
                                        <i class="bx bx-map"></i>Chennai, India
                                    </p>
                                    <p class="application-date">
                                        <i class="bx bx-calendar"></i>Applied: 2nd Aug, 2025
                                    </p>
                                </div>
                            </div>

                            <!-- Compact Details Section -->
                            <div class="candidate-details-compact professional">
                                <div class="detail-row-compact">
                                    <span class="detail-compact">Age: <strong>38</strong></span>
                                    <span class="detail-compact">Experience: <strong>12 yrs</strong></span>
                                    <span class="detail-compact">Nationality: <strong>Indian</strong></span>
                                </div>
                                <div class="detail-row-compact">
                                    <span class="detail-compact">Present Rank: <strong>Chief Engineer</strong></span>
                                    <span class="detail-compact">Applied For: <strong>Chief Engineer</strong></span>
                                </div>
                                <div class="detail-row-compact">
                                    <span class="detail-compact">COC: <strong>Indian</strong></span>
                                    <span class="detail-compact">Availability: <strong>5th Sep, 2025</strong></span>
                                </div>
                            </div>

                            <!-- Multi-line Ship Types -->
                            <div class="ship-types-section professional">
                                <div class="ship-types-label">Ship Types:</div>
                                <div class="ship-types-tags">
                                    <span class="ship-tag experienced">Tanker</span>
                                    <span class="ship-tag basic">Chemical Tanker</span>
                                    <span class="ship-tag experienced">Product Tanker</span>
                                </div>
                            </div>

                            <div class="candidate-actions">
                                <button class="btn btn-primary btn-sm" onclick="viewResume('SJ0063502')">
                                    <i class="bx bx-file-text"></i>View Resume
                                </button>
                                <button class="btn btn-outline-secondary btn-sm" onclick="downloadProfile('SJ0063502')">
                                    <i class="bx bx-download"></i>Download
                                </button>
                                <button class="btn btn-outline-primary btn-sm" onclick="contactCandidate('SJ0063502')">
                                    <i class="bx bx-phone"></i>Contact
                                </button>
                                <button class="btn btn-outline-success btn-sm" onclick="shortlistCandidate('SJ0063502')">
                                    <i class="bx bx-check"></i>Shortlist
                                </button>
                            </div>
                        </div>

                        <!-- Professional Regular Candidate Card 3 -->
                        <div class="candidate-card professional-candidate" data-id="SJ0084721" data-status="contacted">
                            <div class="candidate-checkbox">
                                <input type="checkbox" id="candidate_SJ0084721" class="candidate-select">
                            </div>
                            <div class="professional-accent-line"></div>
                            <div class="candidate-status">
                                <span class="status-badge online">Online</span>
                                <span class="verified-badge">
                                    <i class="bx bx-check-shield"></i>Verified
                                </span>
                                <span class="application-badge contacted">Contacted</span>
                            </div>
                            <div class="candidate-header">
                                <div class="candidate-avatar">
                                    <img src="https://ui-avatars.com/api/?name=Michael+Kumar&size=60&background=10b981&color=ffffff&bold=true"
                                         alt="Michael Kumar profile picture"
                                         onerror="this.onerror=null; this.src='https://via.placeholder.com/60x60/10b981/ffffff?text=MK';">
                                </div>
                                <div class="candidate-info">
                                    <h6 class="candidate-name">Michael Kumar</h6>
                                    <p class="candidate-title">Second Officer</p>
                                    <p class="candidate-location">
                                        <i class="bx bx-map"></i>Goa, India
                                    </p>
                                    <p class="application-date">
                                        <i class="bx bx-calendar"></i>Applied: 5th Aug, 2025
                                    </p>
                                </div>
                            </div>

                            <!-- Compact Details Section -->
                            <div class="candidate-details-compact professional">
                                <div class="detail-row-compact">
                                    <span class="detail-compact">Age: <strong>29</strong></span>
                                    <span class="detail-compact">Experience: <strong>6 yrs</strong></span>
                                    <span class="detail-compact">Nationality: <strong>Indian</strong></span>
                                </div>
                                <div class="detail-row-compact">
                                    <span class="detail-compact">Present Rank: <strong>Second Officer</strong></span>
                                    <span class="detail-compact">Applied For: <strong>Chief Officer</strong></span>
                                </div>
                                <div class="detail-row-compact">
                                    <span class="detail-compact">COC: <strong>Indian</strong></span>
                                    <span class="detail-compact">Availability: <strong>20th Aug, 2025</strong></span>
                                </div>
                            </div>

                            <!-- Multi-line Ship Types -->
                            <div class="ship-types-section professional">
                                <div class="ship-types-label">Ship Types:</div>
                                <div class="ship-types-tags">
                                    <span class="ship-tag experienced">Container Ship</span>
                                    <span class="ship-tag basic">General Cargo</span>
                                    <span class="ship-tag experienced">Bulk Carrier</span>
                                    <span class="ship-tag basic">RoRo Vessel</span>
                                    <span class="ship-tag experienced">Feeder Vessel</span>
                                </div>
                            </div>

                            <div class="candidate-actions">
                                <button class="btn btn-primary btn-sm" onclick="viewResume('SJ0084721')">
                                    <i class="bx bx-file-text"></i>View Resume
                                </button>
                                <button class="btn btn-outline-secondary btn-sm" onclick="downloadProfile('SJ0084721')">
                                    <i class="bx bx-download"></i>Download
                                </button>
                                <button class="btn btn-success btn-sm" onclick="viewContactHistory('SJ0084721')">
                                    <i class="bx bx-history"></i>Contact History
                                </button>
                                <button class="btn btn-outline-success btn-sm" onclick="shortlistCandidate('SJ0084721')">
                                    <i class="bx bx-check"></i>Shortlist
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div class="empty-state" id="emptyState" style="display: none;">
                        <div class="empty-icon">
                            <i class="bx bx-user-x"></i>
                        </div>
                        <div class="empty-title">No Applications Yet</div>
                        <div class="empty-subtitle">No candidates have applied to this job posting yet. Share your job posting to attract more candidates.</div>
                        <button class="btn btn-primary" onclick="shareJobPosting()">
                            <i class="bx bx-share"></i>Share Job Posting
                        </button>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-section">
                        <div class="pagination-info">
                            <span id="paginationInfo">Showing 1-10 of 47 candidates</span>
                        </div>
                        <nav aria-label="Candidates pagination">
                            <ul class="pagination pagination-custom">
                                <li class="page-item disabled">
                                    <button class="page-link" disabled tabindex="-1">
                                        <i class="bx bx-chevron-left"></i>
                                    </button>
                                </li>
                                <li class="page-item active">
                                    <button class="page-link">1</button>
                                </li>
                                <li class="page-item">
                                    <button class="page-link">2</button>
                                </li>
                                <li class="page-item">
                                    <button class="page-link">3</button>
                                </li>
                                <li class="page-item">
                                    <span class="page-link">...</span>
                                </li>
                                <li class="page-item">
                                    <button class="page-link">5</button>
                                </li>
                                <li class="page-item">
                                    <button class="page-link">
                                        <i class="bx bx-chevron-right"></i>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </div>
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
    color: #475569;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 6px;
    line-height: 1.2;
}

.breadcrumb-link:hover {
    color: #334155;
    transform: translateX(2px);
    text-decoration: none;
}

.breadcrumb-title {
    font-weight: 600;
    color: #374151;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 8px;
    line-height: 1.2;
}

.breadcrumb-item.active {
    color: #6b7280;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
    line-height: 1.2;
}

/* Mobile Breadcrumb */
.mobile-breadcrumb {
    background: #ffffff;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    border: 1px solid #e5e7eb;
}

.btn-back {
    width: 44px;
    height: 44px;
    border: none;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #374151;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: #e5e7eb;
    transform: translateX(-2px);
}

.current-page {
    font-weight: 600;
    color: #1f2937;
    font-size: 1rem;
    line-height: 1.2;
}

.page-subtitle {
    font-size: 0.85rem;
    color: #6b7280;
    margin-top: 2px;
}

/* Applied Candidates Container */
.applied-candidates-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 16px;
}

/* Job Info Card */
.job-info-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    margin-bottom: 24px;
    overflow: hidden;
}

.job-info-header {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    color: #ffffff;
    padding: 20px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.job-info-left {
    display: flex;
    align-items: center;
    gap: 16px;
}

.job-icon {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.job-details {
    flex: 1;
}

.job-title {
    margin: 0 0 8px 0;
    font-size: 1.3rem;
    font-weight: 600;
}

.job-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.job-meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.9rem;
    opacity: 0.9;
}

.job-info-right {
    flex-shrink: 0;
}

.job-stats {
    display: flex;
    gap: 24px;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    line-height: 1;
}

.stat-label {
    font-size: 0.8rem;
    opacity: 0.8;
    margin-top: 4px;
}

/* Results Card */
.results-card {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
}

.results-header {
    padding: 20px 24px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.results-title {
    margin: 0;
    font-size: 1.3rem;
    font-weight: 600;
    color: #1f2937;
}

.results-count {
    margin: 4px 0 0 0;
    color: #6b7280;
    font-size: 0.9rem;
}

.count-number {
    font-weight: 600;
    color: #374151;
}

.results-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.sort-select {
    padding: 8px 12px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    font-size: 0.9rem;
    background: #ffffff;
    transition: all 0.3s ease;
}

.sort-select:focus {
    border-color: #6366f1;
    outline: none;
    box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1);
}

/* Status Tabs */
.status-tabs {
    display: flex;
    border-bottom: 1px solid #e5e7eb;
    background: #f9fafb;
    overflow-x: auto;
}

.status-tab {
    background: none;
    border: none;
    padding: 16px 20px;
    font-size: 0.9rem;
    font-weight: 500;
    color: #6b7280;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
    position: relative;
}

.status-tab:hover {
    color: #374151;
    background: #ffffff;
}

.status-tab.active {
    color: #6366f1;
    background: #ffffff;
}

.status-tab.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 2px;
    background: #6366f1;
}

.status-tab::after {
    content: attr(data-count);
    background: #e5e7eb;
    color: #6b7280;
    padding: 2px 6px;
    border-radius: 10px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-left: 4px;
}

.status-tab.active::after {
    background: #6366f1;
    color: #ffffff;
}

/* Loading State */
.loading-state {
    text-align: center;
    padding: 60px 20px;
    color: #6b7280;
}

.loading-spinner {
    font-size: 2rem;
    margin-bottom: 16px;
}

/* Candidates Grid */
.candidates-grid {
    padding: 24px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
}

/* Candidate Selection Checkbox */
.candidate-checkbox {
    position: absolute;
    top: 16px;
    left: 16px;
    z-index: 5;
}

.candidate-select {
    width: 18px;
    height: 18px;
    accent-color: #6366f1;
    cursor: pointer;
}

/* Enhanced Candidate Card Styling */
.candidate-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
    padding-left: 50px; /* Space for checkbox */
    transition: all 0.3s ease;
    position: relative;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    overflow: hidden;
}

.candidate-card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

/* Professional Regular Candidate Enhanced Styling */
.candidate-card.professional-candidate {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border: 2px solid #e2e8f0;
    box-shadow: 0 4px 16px rgba(100, 116, 139, 0.1);
    position: relative;
}

.candidate-card.professional-candidate:hover {
    box-shadow: 0 8px 30px rgba(100, 116, 139, 0.15);
    transform: translateY(-3px);
    border-color: #cbd5e1;
}

.professional-accent-line {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(135deg, #64748b 0%, #475569 100%);
}

/* Premium Candidate Enhanced Styling */
.candidate-card.premium-candidate {
    background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
    border: 2px solid #f59e0b;
    box-shadow: 0 4px 20px rgba(245, 158, 11, 0.2);
    position: relative;
}

.candidate-card.premium-candidate:hover {
    box-shadow: 0 12px 40px rgba(245, 158, 11, 0.3);
    transform: translateY(-4px);
}

.premium-overlay {
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 50px 50px 0;
    border-color: transparent #f59e0b transparent transparent;
}

.premium-crown {
    position: absolute;
    top: 4px;
    right: 4px;
    color: #ffffff;
    font-size: 1.2rem;
    z-index: 10;
}

.candidate-status {
    position: absolute;
    top: 16px;
    right: 16px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    z-index: 5;
    align-items: flex-end;
}

.status-badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 4px;
}

.status-badge.online {
    background: #d1fae5;
    color: #065f46;
}

.status-badge.offline {
    background: #f3f4f6;
    color: #6b7280;
}

/* Enhanced Premium Badge */
.premium-badge-enhanced {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: #ffffff;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    display: flex;
    align-items: center;
    gap: 4px;
    animation: pulse-glow 2s ease-in-out infinite;
}

/* Professional Verified Badge */
.verified-badge {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #ffffff;
    padding: 4px 10px;
    border-radius: 16px;
    font-size: 0.75rem;
    font-weight: 500;
    box-shadow: 0 2px 6px rgba(16, 185, 129, 0.2);
    display: flex;
    align-items: center;
    gap: 4px;
}

/* Application Status Badges */
.application-badge {
    padding: 4px 10px;
    border-radius: 16px;
    font-size: 0.75rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 4px;
}

.application-badge.new {
    background: #dbeafe;
    color: #1e40af;
}

.application-badge.reviewed {
    background: #f3e8ff;
    color: #7c3aed;
}

.application-badge.contacted {
    background: #ecfdf5;
    color: #059669;
}

@keyframes pulse-glow {
    0%, 100% {
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }
    50% {
        box-shadow: 0 4px 16px rgba(245, 158, 11, 0.5);
    }
}

.candidate-header {
    display: flex;
    gap: 16px;
    margin-bottom: 16px;
    align-items: start;
}

.candidate-avatar {
    flex-shrink: 0;
}

.candidate-avatar img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    background: #f3f4f6;
}

.candidate-info {
    flex: 1;
}

.candidate-name {
    margin: 0 0 4px 0;
    font-size: 1.1rem;
    font-weight: 600;
    color: #1f2937;
}

.candidate-title {
    margin: 0 0 6px 0;
    color: #6366f1;
    font-weight: 500;
    font-size: 0.9rem;
}

.candidate-location,
.application-date {
    margin: 0 0 4px 0;
    color: #6b7280;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* Enhanced Compact Details Section */
.candidate-details-compact {
    margin-bottom: 16px;
    background: #f8fafc;
    border-radius: 8px;
    padding: 12px;
    border-left: 4px solid #6366f1;
}

.candidate-details-compact.professional {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    border-left: 4px solid #64748b;
}

.detail-row-compact {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 6px;
}

.detail-row-compact:last-child {
    margin-bottom: 0;
}

.detail-compact {
    font-size: 0.82rem;
    color: #4b5563;
    flex: 1;
    min-width: 140px;
}

.detail-compact strong {
    color: #1f2937;
    font-weight: 600;
}

/* Enhanced Ship Types Section */
.ship-types-section {
    margin-bottom: 16px;
    background: #f1f5f9;
    border-radius: 8px;
    padding: 12px;
}

.ship-types-section.professional {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border: 1px solid #e2e8f0;
}

.ship-types-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}

.ship-types-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    line-height: 1.6;
}

.ship-tag {
    padding: 4px 10px;
    border-radius: 16px;
    font-size: 0.75rem;
    font-weight: 500;
    white-space: nowrap;
    border: 1px solid transparent;
    transition: all 0.3s ease;
}

.ship-tag.experienced {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    color: #065f46;
    border-color: #10b981;
}

.ship-tag.basic {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #92400e;
    border-color: #f59e0b;
}

.ship-tag:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.candidate-actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

/* Button Styling */
.btn {
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 6px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    justify-content: center;
    line-height: 1.2;
    position: relative;
}

.btn:focus {
    outline: 2px solid #6366f1;
    outline-offset: 2px;
}

.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

.btn i {
    font-size: 0.9rem;
    flex-shrink: 0;
}

.btn-sm {
    padding: 6px 12px;
    font-size: 0.8rem;
}

.btn-primary {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: #ffffff;
}

.btn-primary:hover:not(:disabled) {
    background: linear-gradient(135deg, #4f46e5, #4338ca);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    color: #ffffff;
    text-decoration: none;
}

.btn-success {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #ffffff;
}

.btn-success:hover:not(:disabled) {
    background: linear-gradient(135deg, #059669, #047857);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    color: #ffffff;
    text-decoration: none;
}

.btn-outline-primary {
    background: transparent;
    color: #6366f1;
    border: 2px solid #6366f1;
}

.btn-outline-primary:hover:not(:disabled) {
    background: #6366f1;
    color: #ffffff;
    text-decoration: none;
}

.btn-outline-secondary {
    background: transparent;
    color: #6b7280;
    border: 1px solid #e5e7eb;
}

.btn-outline-secondary:hover:not(:disabled) {
    background: #f9fafb;
    border-color: #cbd5e1;
    color: #374151;
    text-decoration: none;
}

.btn-outline-success {
    background: transparent;
    color: #10b981;
    border: 2px solid #10b981;
}

.btn-outline-success:hover:not(:disabled) {
    background: #10b981;
    color: #ffffff;
    text-decoration: none;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #6b7280;
}

.empty-icon {
    font-size: 4rem;
    color: #d1d5db;
    margin-bottom: 16px;
}

.empty-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}

.empty-subtitle {
    font-size: 0.9rem;
    margin-bottom: 24px;
    line-height: 1.5;
}

/* Pagination */
.pagination-section {
    padding: 20px 24px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.pagination-info {
    font-size: 0.9rem;
    color: #6b7280;
}

.pagination-custom {
    margin: 0;
    display: flex;
    list-style: none;
    padding: 0;
}

.pagination-custom .page-item {
    margin: 0 2px;
}

.pagination-custom .page-link {
    border: 1px solid #e5e7eb;
    color: #6b7280;
    padding: 8px 12px;
    border-radius: 6px;
    transition: all 0.3s ease;
    background: #ffffff;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    min-height: 40px;
}

.pagination-custom .page-link:hover:not(:disabled) {
    background: #f9fafb;
    border-color: #cbd5e1;
    color: #374151;
}

.pagination-custom .page-item.active .page-link {
    background: #6366f1;
    border-color: #6366f1;
    color: #ffffff;
}

.pagination-custom .page-item.disabled .page-link {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Mobile Responsive Design */
@media (max-width: 992px) {
    .applied-candidates-container {
        padding: 0 12px;
    }

    .job-info-header {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }

    .job-stats {
        justify-content: center;
        gap: 16px;
    }

    .results-header {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }

    .results-actions {
        width: 100%;
        justify-content: center;
    }

    .status-tabs {
        justify-content: flex-start;
    }
}

@media (max-width: 768px) {
    .candidate-header {
        flex-direction: column;
        text-align: center;
        gap: 12px;
    }

    .detail-row-compact {
        flex-direction: column;
        gap: 6px;
    }

    .detail-compact {
        min-width: auto;
    }

    .ship-types-tags {
        justify-content: center;
    }

    .candidate-actions {
        justify-content: center;
    }

    .candidate-actions .btn {
        flex: 1;
        min-width: 0;
    }

    .job-info-left {
        flex-direction: column;
        text-align: center;
    }

    .pagination-section {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }

    .pagination-custom {
        justify-content: center;
        flex-wrap: wrap;
    }
}

@media (max-width: 480px) {
    .candidates-grid {
        padding: 16px;
    }

    .candidate-card {
        padding: 16px;
        padding-left: 40px;
    }

    .btn {
        font-size: 0.8rem;
        padding: 8px 12px;
    }

    .job-info-header {
        padding: 16px;
    }

    .results-header {
        padding: 16px;
    }

    .pagination-section {
        padding: 16px;
    }

    .status-tabs {
        padding: 0 8px;
    }

    .status-tab {
        padding: 12px 16px;
        font-size: 0.8rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    initializeAppliedCandidatesPage();
});

function initializeAppliedCandidatesPage() {
    try {
        console.log('Applied candidates page initialized');

        // Add event listeners for bulk selection
        const selectAllCheckbox = document.getElementById('selectAllCandidates');
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                toggleAllCandidates(this.checked);
            });
        }

        // Add event listeners for individual checkboxes
        const candidateCheckboxes = document.querySelectorAll('.candidate-select');
        candidateCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateBulkActionButton();
            });
        });

        // Add event listener for sort functionality
        const quickSort = document.getElementById('quickSort');
        if (quickSort) {
            quickSort.addEventListener('change', function() {
                sortCandidates(this.value);
            });
        }

    } catch (error) {
        console.error('Error initializing applied candidates page:', error);
    }
}

function filterByStatus(status) {
    try {
        const candidates = document.querySelectorAll('.candidate-card');
        const tabs = document.querySelectorAll('.status-tab');

        // Update active tab
        tabs.forEach(tab => tab.classList.remove('active'));
        event.target.classList.add('active');

        // Filter candidates
        let visibleCount = 0;
        candidates.forEach(candidate => {
            const candidateStatus = candidate.dataset.status;
            const shouldShow = status === 'all' || candidateStatus === status;

            candidate.style.display = shouldShow ? 'block' : 'none';
            if (shouldShow) visibleCount++;
        });

        // Update results count
        const resultsCount = document.getElementById('resultsCount');
        if (resultsCount) {
            const statusText = status === 'all' ? 'candidates have applied to this position' : `${status} candidates`;
            resultsCount.innerHTML = `<span class="count-number">${visibleCount}</span> ${statusText}`;
        }

        console.log('Filtered by status:', status, 'Visible candidates:', visibleCount);
    } catch (error) {
        console.error('Error filtering candidates by status:', error);
    }
}

function sortCandidates(sortBy) {
    try {
        console.log('Sorting candidates by:', sortBy);

        const candidatesGrid = document.getElementById('candidatesGrid');
        const candidates = Array.from(candidatesGrid.querySelectorAll('.candidate-card'));

        candidates.sort((a, b) => {
            switch (sortBy) {
                case 'recent':
                    // Sort by most recent applications
                    return new Date(b.querySelector('.application-date')?.textContent || 0) -
                           new Date(a.querySelector('.application-date')?.textContent || 0);

                case 'premium':
                    // Premium candidates first
                    const aIsPremium = a.classList.contains('premium-candidate');
                    const bIsPremium = b.classList.contains('premium-candidate');
                    if (aIsPremium && !bIsPremium) return -1;
                    if (!aIsPremium && bIsPremium) return 1;
                    return 0;

                case 'contacted':
                    // Contacted candidates first
                    const aIsContacted = a.dataset.status === 'contacted';
                    const bIsContacted = b.dataset.status === 'contacted';
                    if (aIsContacted && !bIsContacted) return -1;
                    if (!aIsContacted && bIsContacted) return 1;
                    return 0;

                case 'experience':
                    // Sort by experience (extract years from text)
                    const aExp = parseInt(a.querySelector('.detail-compact strong')?.textContent || 0);
                    const bExp = parseInt(b.querySelector('.detail-compact strong')?.textContent || 0);
                    return bExp - aExp;

                case 'name':
                    // Sort alphabetically by name
                    const aName = a.querySelector('.candidate-name')?.textContent || '';
                    const bName = b.querySelector('.candidate-name')?.textContent || '';
                    return aName.localeCompare(bName);

                default:
                    return 0;
            }
        });

        // Reappend sorted candidates
        candidates.forEach(candidate => {
            candidatesGrid.appendChild(candidate);
        });

        console.log('Candidates sorted by:', sortBy);
    } catch (error) {
        console.error('Error sorting candidates:', error);
    }
}

function toggleAllCandidates(selectAll) {
    try {
        const candidateCheckboxes = document.querySelectorAll('.candidate-select');
        candidateCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAll;
        });

        updateBulkActionButton();
        console.log('All candidates', selectAll ? 'selected' : 'deselected');
    } catch (error) {
        console.error('Error toggling all candidates:', error);
    }
}

function updateBulkActionButton() {
    try {
        const selectedCount = document.querySelectorAll('.candidate-select:checked').length;
        const bulkActionBtn = document.querySelector('[onclick="bulkActions()"]');

        if (bulkActionBtn) {
            if (selectedCount > 0) {
                bulkActionBtn.textContent = `Bulk Actions (${selectedCount})`;
                bulkActionBtn.disabled = false;
            } else {
                bulkActionBtn.innerHTML = '<i class="bx bx-check-square"></i>Bulk Actions';
                bulkActionBtn.disabled = false;
            }
        }
    } catch (error) {
        console.error('Error updating bulk action button:', error);
    }
}

function bulkActions() {
    try {
        const selectedCandidates = document.querySelectorAll('.candidate-select:checked');

        if (selectedCandidates.length === 0) {
            alert('Please select at least one candidate for bulk actions.');
            return;
        }

        const actions = [
            'Contact Selected Candidates',
            'Download Selected Resumes',
            'Add to Shortlist',
            'Mark as Reviewed',
            'Export Selected Data',
            'Send Bulk Message'
        ];

        const selectedAction = prompt('Select bulk action:\n' +
            actions.map((action, index) => `${index + 1}. ${action}`).join('\n') +
            '\n\nEnter number (1-' + actions.length + '):');

        if (selectedAction && selectedAction >= 1 && selectedAction <= actions.length) {
            const actionName = actions[selectedAction - 1];
            console.log(`Performing bulk action: ${actionName} on ${selectedCandidates.length} candidates`);

            // Simulate bulk action
            alert(`${actionName} performed on ${selectedCandidates.length} selected candidates.`);

            // Uncheck all after action
            selectedCandidates.forEach(checkbox => checkbox.checked = false);
            updateBulkActionButton();
        }
    } catch (error) {
        console.error('Error performing bulk actions:', error);
    }
}

function toggleViewMode() {
    try {
        const viewIcon = document.getElementById('viewIcon');
        const candidatesGrid = document.getElementById('candidatesGrid');

        if (!viewIcon || !candidatesGrid) return;

        if (viewIcon.classList.contains('bx-grid-alt')) {
            viewIcon.classList.replace('bx-grid-alt', 'bx-list-ul');
            candidatesGrid.classList.add('list-view');
        } else {
            viewIcon.classList.replace('bx-list-ul', 'bx-grid-alt');
            candidatesGrid.classList.remove('list-view');
        }
    } catch (error) {
        console.error('Error toggling view mode:', error);
    }
}

function viewResume(candidateId) {
    try {
        if (!candidateId) {
            console.error('Candidate ID is required');
            return;
        }
        window.location.href = `/company/candidate/${candidateId}/resume`;
    } catch (error) {
        console.error('Error viewing resume:', error);
    }
}

function downloadProfile(candidateId) {
    try {
        if (!candidateId) {
            console.error('Candidate ID is required');
            return;
        }

        const button = event.target.closest('.btn');
        if (button) {
            const originalContent = button.innerHTML;
            button.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i>Downloading...';
            button.disabled = true;

            setTimeout(() => {
                try {
                    const link = document.createElement('a');
                    link.href = `/company/candidate/${candidateId}/download`;
                    link.download = `candidate_${candidateId}_profile.pdf`;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);

                    button.innerHTML = originalContent;
                    button.disabled = false;
                } catch (error) {
                    console.error('Error creating download link:', error);
                    button.innerHTML = originalContent;
                    button.disabled = false;
                }
            }, 1000);
        }
    } catch (error) {
        console.error('Error downloading profile:', error);
    }
}

function contactCandidate(candidateId) {
    try {
        if (!candidateId) {
            console.error('Candidate ID is required');
            return;
        }

        console.log(`Contacting candidate: ${candidateId}`);
        window.location.href = `/company/contact-candidate/${candidateId}`;

    } catch (error) {
        console.error('Error contacting candidate:', error);
    }
}

function shortlistCandidate(candidateId) {
    try {
        if (!candidateId) {
            console.error('Candidate ID is required');
            return;
        }

        if (confirm('Add this candidate to your shortlist?')) {
            console.log(`Shortlisting candidate: ${candidateId}`);

            // Simulate API call
            setTimeout(() => {
                alert('Candidate added to shortlist successfully!');

                // Update button to show shortlisted status
                const button = event.target.closest('.btn');
                if (button) {
                    button.innerHTML = '<i class="bx bx-check"></i>Shortlisted';
                    button.classList.remove('btn-outline-success');
                    button.classList.add('btn-success');
                    button.disabled = true;
                }
            }, 500);
        }
    } catch (error) {
        console.error('Error shortlisting candidate:', error);
    }
}

function viewContactHistory(candidateId) {
    try {
        if (!candidateId) {
            console.error('Candidate ID is required');
            return;
        }

        console.log(`Viewing contact history for candidate: ${candidateId}`);
        window.location.href = `/company/candidate/${candidateId}/contact-history`;

    } catch (error) {
        console.error('Error viewing contact history:', error);
    }
}

function exportCandidatesList() {
    try {
        console.log('Exporting candidates list...');

        const button = event.target.closest('.btn');
        if (button) {
            const originalContent = button.innerHTML;
            button.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i>Exporting...';
            button.disabled = true;

            setTimeout(() => {
                const link = document.createElement('a');
                link.href = '/company/job-posting/123/candidates/export';
                link.download = 'applied_candidates_list.xlsx';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                button.innerHTML = originalContent;
                button.disabled = false;

                alert('Candidates list exported successfully!');
            }, 2000);
        }
    } catch (error) {
        console.error('Error exporting candidates list:', error);
    }
}

function downloadAllResumes() {
    try {
        if (confirm('Download all candidate resumes? This may take a few minutes.')) {
            console.log('Downloading all resumes...');

            const button = event.target.closest('.btn');
            if (button) {
                const originalContent = button.innerHTML;
                button.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i>Preparing...';
                button.disabled = true;

                setTimeout(() => {
                    const link = document.createElement('a');
                    link.href = '/company/job-posting/123/resumes/download-all';
                    link.download = 'all_candidate_resumes.zip';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);

                    button.innerHTML = originalContent;
                    button.disabled = false;

                    alert('All resumes download started! Check your downloads folder.');
                }, 3000);
            }
        }
    } catch (error) {
        console.error('Error downloading all resumes:', error);
    }
}

function shareJobPosting() {
    try {
        console.log('Opening job posting sharing options...');
        window.location.href = '/company/job-posting/123/share';
    } catch (error) {
        console.error('Error sharing job posting:', error);
    }
}
</script>
@endsection
