@extends('layouts.candidate.app')
@section('content')
<main class="page-content professional-bg">
    <!--Enhanced Professional Breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3">
            <i class="bx bx-user-circle me-2 text-primary"></i>Candidate
        </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 enhanced-breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('candidate.dashboard') }}" class="breadcrumb-link">
                            <i class="bx bx-home-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bx bx-file-text me-1"></i>View Resume
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!--Mobile Breadcrumb-->
    <div class="mobile-breadcrumb d-flex d-sm-none align-items-center mb-3 px-3">
        <button class="btn-back me-3" onclick="history.back()">
            <i class="bx bx-arrow-back"></i>
        </button>
        <div class="breadcrumb-mobile">
            <div class="current-page">Seafarer Resume</div>
            <div class="page-subtitle">Professional maritime profile</div>
        </div>
    </div>

    <div class="resume-container">
        <!-- Resume Header Actions -->
        <div class="resume-actions">
            <div class="resume-status">
                <span class="status-badge status-complete">
                    <i class="bx bx-check-circle me-2"></i>Complete Profile
                </span>
                <span class="resume-id">ID: SJ0025114</span>
                <span class="posted-date">Posted: 9th Aug, 2025</span>
            </div>
            <div class="action-buttons">
                <button class="btn btn-outline-primary" onclick="window.print()">
                    <i class="bx bx-printer me-1"></i>Print Resume
                </button>
                <button class="btn btn-outline-secondary" onclick="editResume()">
                    <i class="bx bx-edit me-1"></i>Edit Resume
                </button>
                <button class="btn btn-primary" onclick="downloadPDF()">
                    <i class="bx bx-download me-1"></i>Download PDF
                </button>
            </div>
        </div>

        <!-- Resume Display -->
        <div class="resume-viewer">
            <!-- Header Section -->
            <div class="resume-header">
                <div class="rank-info">
                    <div class="current-rank">
                        <div class="rank-title">Present Rank:</div>
                        <div class="rank-value">Chief Engineer</div>
                    </div>
                    <div class="rank-experience">
                        <div class="exp-title">Present Rank Exp:</div>
                        <div class="exp-value">3 - 5 years</div>
                    </div>
                    <div class="applied-position">
                        <div class="position-title">Post Applied for:</div>
                        <div class="position-value">Chief Engineer</div>
                    </div>
                    <div class="availability">
                        <div class="avail-title">Date of Availability:</div>
                        <div class="avail-value">12/8/2025</div>
                    </div>
                </div>
            </div>

            <!-- Personal Details Section -->
            <section class="resume-section">
                <h3 class="section-title">
                    <i class="bx bx-user me-2"></i>Personal Details
                </h3>
                <div class="section-content">
                    <div class="details-grid">
                        <div class="detail-row">
                            <div class="detail-group">
                                <label class="detail-label">First Name:</label>
                                <span class="detail-value">Ashley</span>
                            </div>
                            <div class="detail-group">
                                <label class="detail-label">Middle Name:</label>
                                <span class="detail-value">D</span>
                            </div>
                            <div class="detail-group">
                                <label class="detail-label">Last Name:</label>
                                <span class="detail-value">Cunha</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-group">
                                <label class="detail-label">Gender:</label>
                                <span class="detail-value">Male</span>
                            </div>
                            <div class="detail-group">
                                <label class="detail-label">Marital Status:</label>
                                <span class="detail-value">Single</span>
                            </div>
                            <div class="detail-group">
                                <label class="detail-label">Nationality:</label>
                                <span class="detail-value">Indian</span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-group">
                                <label class="detail-label">State:</label>
                                <span class="detail-value">Goa - Other</span>
                            </div>
                            <div class="detail-group">
                                <label class="detail-label">D.O.B:</label>
                                <span class="detail-value">11/3/1982</span>
                            </div>
                            <div class="detail-group">
                                <label class="detail-label">Mobile:</label>
                                <span class="detail-value">9860442024</span>
                            </div>
                        </div>
                        <div class="detail-row full-width">
                            <div class="detail-group">
                                <label class="detail-label">Present Address:</label>
                                <span class="detail-value">H No 147 codda vaddo chinchinim salcette Goa</span>
                            </div>
                        </div>
                        <div class="detail-row full-width">
                            <div class="detail-group">
                                <label class="detail-label">Email ID:</label>
                                <span class="detail-value">ashley_03_11@Yahoo.co.in</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Document Details Section -->
            <section class="resume-section">
                <h3 class="section-title">
                    <i class="bx bx-file me-2"></i>Document Details
                </h3>
                <div class="section-content">
                    <div class="document-grid">
                        <!-- Passport -->
                        <div class="doc-card">
                            <div class="doc-header">
                                <i class="bx bx-passport doc-icon"></i>
                                <h4 class="doc-title">Passport</h4>
                            </div>
                            <div class="doc-details">
                                <div class="doc-item">
                                    <span class="doc-label">Type:</span>
                                    <span class="doc-value">Indian</span>
                                </div>
                                <div class="doc-item">
                                    <span class="doc-label">No:</span>
                                    <span class="doc-value">Z5085861</span>
                                </div>
                                <div class="doc-item">
                                    <span class="doc-label">Expiry:</span>
                                    <span class="doc-value">6/1/2029</span>
                                </div>
                            </div>
                        </div>

                        <!-- CDC -->
                        <div class="doc-card">
                            <div class="doc-header">
                                <i class="bx bx-id-card doc-icon"></i>
                                <h4 class="doc-title">CDC</h4>
                            </div>
                            <div class="doc-details">
                                <div class="doc-item">
                                    <span class="doc-label">Type:</span>
                                    <span class="doc-value">India</span>
                                </div>
                                <div class="doc-item">
                                    <span class="doc-label">No:</span>
                                    <span class="doc-value">mum102181</span>
                                </div>
                                <div class="doc-item">
                                    <span class="doc-label">Expiry:</span>
                                    <span class="doc-value">24/7/2027</span>
                                </div>
                            </div>
                        </div>

                        <!-- Visa -->
                        <div class="doc-card">
                            <div class="doc-header">
                                <i class="bx bx-globe doc-icon"></i>
                                <h4 class="doc-title">US Visa</h4>
                            </div>
                            <div class="doc-details">
                                <div class="doc-item">
                                    <span class="doc-label">Status:</span>
                                    <span class="doc-value visa-yes">Yes</span>
                                </div>
                            </div>
                        </div>

                        <!-- INDOS -->
                        <div class="doc-card">
                            <div class="doc-header">
                                <i class="bx bx-shield doc-icon"></i>
                                <h4 class="doc-title">INDOS</h4>
                            </div>
                            <div class="doc-details">
                                <div class="doc-item">
                                    <span class="doc-label">No:</span>
                                    <span class="doc-value">07EL0168</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Training & Certificates Section -->
            <section class="resume-section">
                <h3 class="section-title">
                    <i class="bx bx-graduation me-2"></i>Training & Certificates
                </h3>
                <div class="section-content">
                    <!-- Pre-sea Training -->
                    <div class="training-block">
                        <h4 class="training-title">Pre-sea Training</h4>
                        <div class="training-details">
                            <div class="training-item">
                                <span class="training-label">Type:</span>
                                <span class="training-value">Marine Engineering</span>
                            </div>
                            <div class="training-item">
                                <span class="training-label">Issue Date:</span>
                                <span class="training-value">No data</span>
                            </div>
                        </div>
                    </div>

                    <!-- COC/COP Details -->
                    <div class="training-block">
                        <h4 class="training-title">COC/COP Details</h4>
                        <div class="training-details">
                            <div class="training-item">
                                <span class="training-label">Type:</span>
                                <span class="training-value">India</span>
                            </div>
                            <div class="training-item">
                                <span class="training-label">No:</span>
                                <span class="training-value">CoC0083572</span>
                            </div>
                            <div class="training-item">
                                <span class="training-label">Grade:</span>
                                <span class="training-value">Chief Engineer</span>
                            </div>
                            <div class="training-item">
                                <span class="training-label">Expiry:</span>
                                <span class="training-value">31/3/2029</span>
                            </div>
                        </div>
                    </div>

                    <!-- DC Endorsement Section (NEW) -->
                   <div class="training-block">
                    <h4 class="training-title">DC Endorsement</h4>
                    <div class="endorsement-list">
                        <div class="endorsement-item">
                            <div class="endorsement-card">
                                <div class="endorsement-header">
                                    <div class="endorsement-name">Oil DCE Level -II (Management)</div>
                                    <div class="endorsement-validity">
                                        <span class="validity-label">Valid Until:</span>
                                        <span class="validity-date">15/09/2026</span>
                                    </div>
                                </div>
                                <div class="endorsement-status">
                                    <span class="status-active">
                                        <i class="bx bx-check-circle me-1"></i>Active
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- Valid Courses -->
                    <div class="training-block">
                        <h4 class="training-title">List of Valid Courses</h4>
                        <div class="courses-list">
                            <div class="course-item">
                                <span class="course-number">1.</span>
                                <span class="course-name">Personal Safety & Social Responsibilities (PSSR)</span>
                            </div>
                            <div class="course-item">
                                <span class="course-number">2.</span>
                                <span class="course-name">Proficiency in Survival Craft & Rescue Boats (PSCRB)</span>
                            </div>
                            <div class="course-item">
                                <span class="course-number">3.</span>
                                <span class="course-name">Engine Room Resource Management (ERM)</span>
                            </div>
                            <div class="course-item">
                                <span class="course-number">4.</span>
                                <span class="course-name">Advanced Fire Fighting (AFF)</span>
                            </div>
                            <div class="course-item">
                                <span class="course-number">5.</span>
                                <span class="course-name">Medical First Aid (MFA)</span>
                            </div>
                            <div class="course-item">
                                <span class="course-number">6.</span>
                                <span class="course-name">Ship Security Officers (SSO)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sea Service Details Section -->
            <section class="resume-section">
                <h3 class="section-title">
                    <i class="bx bx-anchor me-2"></i>Sea Service Details
                </h3>
                <div class="section-content">
                    <!-- Desktop Table View -->
                    <div class="table-responsive d-none d-lg-block">
                        <table class="sea-service-table">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Company/Ship Name</th>
                                    <th>Ship Type</th>
                                    <th>Engine Type</th>
                                    <th>Tonnage</th>
                                    <th>BHP</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="rank-cell">Chief Engr.</td>
                                    <td class="company-cell">M/S. AG. MARITIME PRIVATE LIMITED.</td>
                                    <td>Bulk Carrier</td>
                                    <td>-</td>
                                    <td>33192-GRT</td>
                                    <td>-</td>
                                    <td>9/12/2024</td>
                                    <td>5/5/2025</td>
                                    <td class="duration-cell">4m 27d</td>
                                </tr>
                                <tr>
                                    <td class="rank-cell">Chief Engr.</td>
                                    <td class="company-cell">V.SHIPS INDIA PVT. LTD.</td>
                                    <td>Bulk Carrier</td>
                                    <td>mc</td>
                                    <td>93693-GRT</td>
                                    <td>19620</td>
                                    <td>7/5/2024</td>
                                    <td>1/8/2024</td>
                                    <td class="duration-cell">2m 25d</td>
                                </tr>
                                <tr>
                                    <td class="rank-cell">Chief Engr.</td>
                                    <td class="company-cell">V.SHIPS INDIA PVT. LTD.</td>
                                    <td>Bulk Carrier</td>
                                    <td>mc</td>
                                    <td>93693-GRT</td>
                                    <td>19620</td>
                                    <td>30/5/2023</td>
                                    <td>3/11/2023</td>
                                    <td class="duration-cell">5m 4d</td>
                                </tr>
                                <tr>
                                    <td class="rank-cell">Chief Engr.</td>
                                    <td class="company-cell">V.SHIPS INDIA PVT. LTD.</td>
                                    <td>Bulk Carrier</td>
                                    <td>mc</td>
                                    <td>24245-ship GRT</td>
                                    <td>6000</td>
                                    <td>15/1/2023</td>
                                    <td>21/4/2023</td>
                                    <td class="duration-cell">3m 6d</td>
                                </tr>
                                <tr>
                                    <td class="rank-cell">2nd Engr.</td>
                                    <td class="company-cell">dynacom</td>
                                    <td>Bulk Carrier</td>
                                    <td>mc</td>
                                    <td>32964-GRT</td>
                                    <td>9480</td>
                                    <td>12/12/2017</td>
                                    <td>13/6/2018</td>
                                    <td class="duration-cell">6m 1d</td>
                                </tr>
                                <tr>
                                    <td class="rank-cell">3rd Engr.</td>
                                    <td class="company-cell">GLOBAL OFFSHORE</td>
                                    <td>AHTS DP</td>
                                    <td>YANMAR 6EY26</td>
                                    <td>1706-GRT</td>
                                    <td>5220</td>
                                    <td>7/10/2013</td>
                                    <td>19/11/2013</td>
                                    <td class="duration-cell">1m 12d</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="mobile-sea-service d-block d-lg-none">
                        <div class="service-card">
                            <div class="service-header">
                                <div class="service-rank">Chief Engineer</div>
                                <div class="service-duration">4m 27d</div>
                            </div>
                            <div class="service-company">M/S. AG. MARITIME PRIVATE LIMITED.</div>
                            <div class="service-details">
                                <div class="service-detail">
                                    <span class="detail-label">Ship Type:</span>
                                    <span class="detail-value">Bulk Carrier</span>
                                </div>
                                <div class="service-detail">
                                    <span class="detail-label">Tonnage:</span>
                                    <span class="detail-value">33192-GRT</span>
                                </div>
                                <div class="service-detail">
                                    <span class="detail-label">Period:</span>
                                    <span class="detail-value">9/12/2024 - 5/5/2025</span>
                                </div>
                            </div>
                        </div>

                        <div class="service-card">
                            <div class="service-header">
                                <div class="service-rank">Chief Engineer</div>
                                <div class="service-duration">2m 25d</div>
                            </div>
                            <div class="service-company">V.SHIPS INDIA PVT. LTD.</div>
                            <div class="service-details">
                                <div class="service-detail">
                                    <span class="detail-label">Ship Type:</span>
                                    <span class="detail-value">Bulk Carrier</span>
                                </div>
                                <div class="service-detail">
                                    <span class="detail-label">Engine Type:</span>
                                    <span class="detail-value">mc</span>
                                </div>
                                <div class="service-detail">
                                    <span class="detail-label">Tonnage:</span>
                                    <span class="detail-value">93693-GRT</span>
                                </div>
                                <div class="service-detail">
                                    <span class="detail-label">BHP:</span>
                                    <span class="detail-value">19620</span>
                                </div>
                                <div class="service-detail">
                                    <span class="detail-label">Period:</span>
                                    <span class="detail-value">7/5/2024 - 1/8/2024</span>
                                </div>
                            </div>
                        </div>

                        <!-- Add more service cards as needed -->
                        <div class="view-all-services">
                            <button class="btn btn-outline-primary btn-sm">View All Sea Service Records</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Additional Details Section (NEW) -->
            <section class="resume-section">
                <h3 class="section-title">
                    <i class="bx bx-info-circle me-2"></i>Additional Details
                </h3>
                <div class="section-content">
                    <div class="additional-details">




                        <div class="details-block">

                            <ul class="highlights-list">
                                <li>Successfully managed engine room operations on vessels up to 93,693 GRT</li>
                                <li>Maintained zero-deficiency record during PSC inspections for past 3 years</li>
                                <li>Led cost-saving initiatives resulting in 15% reduction in maintenance expenses</li>
                                <li>Mentored junior engineers and contributed to their professional development</li>
                                <li>Specialized in dry-dock supervision and major overhaul projects</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </section>
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
    color: #4f46e5;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.breadcrumb-link:hover {
    color: #3730a3;
    transform: translateX(2px);
}

.breadcrumb-title {
    font-weight: 600;
    color: #374151;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
}

.breadcrumb-item.active {
    color: #6b7280;
    font-weight: 500;
    display: flex;
    align-items: center;
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

/* Resume Container */
.resume-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
}

/* Resume Actions */
.resume-actions {
    background: #ffffff;
    border-radius: 12px;
    padding: 20px 24px;
    margin-bottom: 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    border: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.resume-status {
    display: flex;
    align-items: center;
    gap: 16px;
}

.status-badge {
    display: flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.85rem;
}

.status-complete {
    background: #d1fae5;
    color: #065f46;
}

.resume-id,
.posted-date {
    font-size: 0.85rem;
    color: #6b7280;
    font-weight: 500;
}

.action-buttons {
    display: flex;
    gap: 12px;
}

.btn {
    padding: 10px 16px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
}

.btn-outline-primary {
    background: #ffffff;
    color: #3b82f6;
    border: 2px solid #3b82f6;
}

.btn-outline-primary:hover {
    background: #3b82f6;
    color: #ffffff;
}

.btn-outline-secondary {
    background: #ffffff;
    color: #6b7280;
    border: 2px solid #e5e7eb;
}

.btn-outline-secondary:hover {
    background: #f9fafb;
    border-color: #cbd5e1;
}

.btn-primary {
    background: #3b82f6;
    color: #ffffff;
}

.btn-primary:hover {
    background: #2563eb;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}

/* Resume Viewer */
.resume-viewer {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
}

/* Resume Header */
.resume-header {
    background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
    color: #ffffff;
    padding: 24px 32px;
}

.rank-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.current-rank,
.rank-experience,
.applied-position,
.availability {
    text-align: center;
}

.rank-title,
.exp-title,
.position-title,
.avail-title {
    font-size: 0.85rem;
    opacity: 0.8;
    margin-bottom: 4px;
}

.rank-value,
.exp-value,
.position-value,
.avail-value {
    font-size: 1.1rem;
    font-weight: 600;
}

/* Resume Sections */
.resume-section {
    padding: 32px;
    border-bottom: 1px solid #f1f5f9;
}

.resume-section:last-child {
    border-bottom: none;
}

.section-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    padding-bottom: 8px;
    border-bottom: 2px solid #f1f5f9;
}

.section-content {
    line-height: 1.6;
}

/* Personal Details */
.details-grid {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.detail-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.detail-row.full-width {
    grid-template-columns: 1fr;
}

.detail-group {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.detail-label {
    font-weight: 600;
    color: #6b7280;
    font-size: 0.85rem;
}

.detail-value {
    color: #1f2937;
    font-size: 0.95rem;
    font-weight: 500;
}

/* Document Cards */
.document-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.doc-card {
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
    transition: all 0.3s ease;
}

.doc-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px);
}

.doc-header {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
}

.doc-icon {
    width: 40px;
    height: 40px;
    background: #3b82f6;
    color: #ffffff;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    margin-right: 12px;
}

.doc-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1f2937;
    margin: 0;
}

.doc-details {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.doc-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.doc-label {
    color: #6b7280;
    font-weight: 500;
    font-size: 0.85rem;
}

.doc-value {
    color: #1f2937;
    font-weight: 600;
    font-size: 0.9rem;
}

.visa-yes {
    color: #059669;
    background: #d1fae5;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
}

/* Training Blocks */
.training-block {
    margin-bottom: 24px;
    background: #f9fafb;
    border: 1px solid #f1f5f9;
    border-radius: 8px;
    padding: 20px;
}

.training-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 16px;
}

.training-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 12px;
}

.training-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.training-label {
    color: #6b7280;
    font-weight: 500;
    font-size: 0.85rem;
}

.training-value {
    color: #1f2937;
    font-weight: 600;
    font-size: 0.9rem;
}

/* DC Endorsement Styles (NEW) */
.dc-endorsement {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    border: 1px solid #f59e0b;
}

.dc-endorsement .training-title {
    color: #92400e;
    display: flex;
    align-items: center;
}

.endorsement-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.endorsement-item {
    background: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #f59e0b;
}

.endorsement-card {
    padding: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.endorsement-header {
    flex: 1;
}

.endorsement-name {
    font-weight: 600;
    color: #92400e;
    font-size: 1rem;
    margin-bottom: 4px;
}

.endorsement-validity {
    display: flex;
    align-items: center;
    gap: 8px;
}

.validity-label {
    color: #6b7280;
    font-size: 0.85rem;
    font-weight: 500;
}

.validity-date {
    color: #1f2937;
    font-weight: 600;
    font-size: 0.9rem;
}

.endorsement-status {
    flex-shrink: 0;
}

.status-active {
    background: #d1fae5;
    color: #065f46;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

/* Courses List */
.courses-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 12px;
}

.course-item {
    display: flex;
    align-items: flex-start;
    padding: 8px 0;
    border-bottom: 1px solid #f1f5f9;
}

.course-item:last-child {
    border-bottom: none;
}

.course-number {
    color: #3b82f6;
    font-weight: 600;
    margin-right: 8px;
    min-width: 20px;
}

.course-name {
    color: #374151;
    font-size: 0.9rem;
    line-height: 1.4;
}

/* Sea Service Table */
.sea-service-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
}

.sea-service-table th {
    background: #f8fafc;
    color: #374151;
    font-weight: 600;
    padding: 12px 8px;
    text-align: left;
    border-bottom: 2px solid #e5e7eb;
}

.sea-service-table td {
    padding: 12px 8px;
    border-bottom: 1px solid #f1f5f9;
    color: #374151;
}

.rank-cell {
    font-weight: 600;
    color: #1e40af;
}

.company-cell {
    font-weight: 500;
    max-width: 200px;
}

.duration-cell {
    font-weight: 600;
    color: #059669;
}

/* Mobile Service Cards */
.mobile-sea-service {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.service-card {
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
}

.service-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.service-rank {
    font-weight: 600;
    color: #1e40af;
    font-size: 1rem;
}

.service-duration {
    background: #d1fae5;
    color: #065f46;
    padding: 4px 12px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.8rem;
}

.service-company {
    font-weight: 500;
    color: #374151;
    margin-bottom: 16px;
}

.service-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
}

.service-detail {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 4px 0;
}

.view-all-services {
    text-align: center;
    margin-top: 20px;
}

/* Additional Details Styles (NEW) */
.additional-details {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.details-block {
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 24px;
}

.details-subtitle {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #e5e7eb;
    padding-bottom: 8px;
}

.details-text {
    color: #374151;
    line-height: 1.6;
    margin: 0;
    font-size: 0.95rem;
}

.qualifications-list,
.highlights-list {
    color: #374151;
    padding-left: 20px;
    margin: 0;
}

.qualifications-list li,
.highlights-list li {
    margin-bottom: 8px;
    line-height: 1.5;
    font-size: 0.9rem;
}

.additional-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 12px;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f1f5f9;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    color: #6b7280;
    font-weight: 500;
    font-size: 0.85rem;
    min-width: 140px;
}

.info-value {
    color: #1f2937;
    font-weight: 600;
    font-size: 0.9rem;
    text-align: right;
}

/* Mobile Responsive Design */
@media (max-width: 768px) {
    .resume-container {
        padding: 0 12px;
    }

    .resume-actions {
        flex-direction: column;
        gap: 16px;
        text-align: center;
    }

    .action-buttons {
        justify-content: center;
        flex-wrap: wrap;
    }

    .rank-info {
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .resume-section {
        padding: 24px 20px;
    }

    .details-grid {
        gap: 12px;
    }

    .detail-row {
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .document-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .training-details {
        grid-template-columns: 1fr;
        gap: 8px;
    }

    .courses-list {
        grid-template-columns: 1fr;
    }

    .service-details {
        grid-template-columns: 1fr;
    }

    .endorsement-card {
        flex-direction: column;
        gap: 12px;
        align-items: flex-start;
    }

    .additional-info-grid {
        grid-template-columns: 1fr;
    }

    .info-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
    }

    .info-value {
        text-align: left;
    }
}

@media (max-width: 480px) {
    .rank-info {
        grid-template-columns: 1fr;
    }

    .btn {
        padding: 8px 12px;
        font-size: 0.85rem;
    }

    .section-title {
        font-size: 1.1rem;
    }
}

/* Print Styles */
@media print {
    .resume-actions {
        display: none;
    }

    .professional-bg {
        background: #ffffff;
    }

    .page-breadcrumb,
    .mobile-breadcrumb {
        display: none;
    }

    .resume-viewer {
        box-shadow: none;
        border: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize resume view functionality
    initializeResumeView();
});

function initializeResumeView() {
    // Add smooth scrolling to sections
    const sections = document.querySelectorAll('.resume-section');
    sections.forEach(section => {
        section.style.scrollMarginTop = '20px';
    });

    // Add print optimization
    optimizeForPrint();
}

function editResume() {
    // Redirect to resume builder/edit page
    window.location.href = "{{ route('candidate.resume') }}";
}

function downloadPDF() {
    // Add loading state
    const btn = event.target;
    const originalContent = btn.innerHTML;
    btn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Generating PDF...';
    btn.disabled = true;

    // Simulate PDF generation
    setTimeout(() => {
        // Here you would integrate with a PDF generation service
        // For now, we'll use the browser's print function
        window.print();

        // Reset button
        btn.innerHTML = originalContent;
        btn.disabled = false;

        // Show success message
        showToast('Resume PDF generated successfully!');
    }, 2000);
}

function showToast(message) {
    // Create and show toast notification
    const toast = document.createElement('div');
    toast.className = 'toast-notification';
    toast.innerHTML = `<i class="bx bx-check-circle me-2"></i>${message}`;

    // Add styles
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #059669;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        z-index: 10000;
        animation: slideInRight 0.3s ease-out;
        display: flex;
        align-items: center;
    `;

    document.body.appendChild(toast);

    // Remove after 3 seconds
    setTimeout(() => {
        toast.style.animation = 'slideOutRight 0.3s ease-out';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

function optimizeForPrint() {
    // Add print-specific optimizations
    window.addEventListener('beforeprint', function() {
        document.body.classList.add('printing');
    });

    window.addEventListener('afterprint', function() {
        document.body.classList.remove('printing');
    });
}

// Add CSS for toast animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection
