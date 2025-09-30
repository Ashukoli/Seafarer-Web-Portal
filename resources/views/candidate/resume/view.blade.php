{{-- resources/views/candidate/resume/view.blade.php --}}
@extends('layouts.candidate.app')

@section('content')
<main class="page-content compact-bg">
    <!-- Compact Breadcrumb -->
    <div class="compact-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-2">
            <i class="bx bx-user-circle me-1 text-primary"></i>Candidate
        </div>
        <div class="ps-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 compact-nav">
                    <li class="breadcrumb-item">
                        <a href="{{ route('candidate.dashboard') }}" class="nav-link">
                            <i class="bx bx-home-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bx bx-file-text me-1"></i>Resume
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Mobile Breadcrumb -->
    <div class="mobile-nav d-flex d-sm-none align-items-center mb-2 px-2">
        <button class="btn-back me-2" onclick="history.back()">
            <i class="bx bx-arrow-back"></i>
        </button>
        <div class="nav-content">
            <div class="current-page">Resume</div>
        </div>
    </div>

    <div class="resume-container">
        <!-- Compact Resume Actions -->
        <div class="compact-actions">
            <div class="status-info">
                <span class="status-badge">
                    <i class="bx bx-check-circle me-1"></i>
                    {{ optional($profile)->profile_completion ? 'Complete' : 'Profile' }}
                </span>
                @if(!empty($resume->id))
                    <span class="resume-id">ID: {{ $resume->id }}</span>
                @endif
                <span class="posted-date">{{ optional($resume->created_at)->format('M d, Y') ?? '-' }}</span>
            </div>

            <div class="action-btns">
                <button class="btn btn-sm btn-outline-primary" onclick="window.print()">
                    <i class="bx bx-printer"></i><span class="d-none d-md-inline ms-1">Print</span>
                </button>
                <a href="{{ route('candidate.resume.edit') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bx bx-edit"></i><span class="d-none d-md-inline ms-1">Edit</span>
                </a>
                <button class="btn btn-sm btn-primary" onclick="downloadPDF(event)">
                    <i class="bx bx-download"></i><span class="d-none d-md-inline ms-1">PDF</span>
                </button>
            </div>
        </div>

        <!-- Compact Resume Display -->
        <div class="compact-resume">
            <!-- Compact Header -->
            <div class="resume-header">
                <div class="rank-grid">
                    <div class="rank-item">
                        <div class="label">Present Rank</div>
                        <div class="value">{{ $resume->present_rank ? (is_numeric($resume->present_rank) ? ($ranks->firstWhere('id', $resume->present_rank)->rank ?? $resume->present_rank) : $resume->present_rank) : '-' }}</div>
                    </div>
                    <div class="rank-item">
                        <div class="label">Experience</div>
                        <div class="value">{{ $resume->present_rank_exp ?? '-' }}</div>
                    </div>
                    <div class="rank-item">
                        <div class="label">Applied For</div>
                        <div class="value">{{ $resume->post_applied_for ? (is_numeric($resume->post_applied_for) ? ($ranks->firstWhere('id', $resume->post_applied_for)->rank ?? $resume->post_applied_for) : $resume->post_applied_for) : '-' }}</div>
                    </div>
                    <div class="rank-item">
                        <div class="label">Available</div>
                        <div class="value">{{ optional($resume->date_of_availability)->format('d/m/Y') ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <!-- Personal Details - Compact -->
            <section class="compact-section">
                <h4 class="section-title">
                    <i class="bx bx-user me-1"></i>Personal Details
                </h4>
                <div class="content">
                    <div class="details-compact">
                        <div class="row g-2">
                            <div class="col-md-4 col-6">
                                <div class="field">
                                    <label>First Name</label>
                                    <span>{{ $profile->first_name ?? $user->first_name ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="field">
                                    <label>Middle Name</label>
                                    <span>{{ $profile->middle_name ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="field">
                                    <label>Last Name</label>
                                    <span>{{ $profile->last_name ?? $user->last_name ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="field">
                                    <label>Gender</label>
                                    <span>{{ ucfirst($profile->gender ?? '-') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="field">
                                    <label>Marital Status</label>
                                    <span>{{ ucfirst($profile->marital_status ?? '-') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="field">
                                    <label>Nationality</label>
                                    <span>{{ optional($countries->firstWhere('id', $profile->nationality))->country_name ?? $profile->nationality ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="field">
                                    <label>State</label>
                                    <span>{{ optional($states->firstWhere('id', $profile->state_id))->state_name ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="field">
                                    <label>D.O.B</label>
                                    <span>{{ optional($profile->dob)->format('d/m/Y') ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="field">
                                    <label>Mobile</label>
                                    <span>{{ $profile->mobile_number ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field">
                                    <label>Address</label>
                                    <span>{{ $profile->address ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field">
                                    <label>Email</label>
                                    <span>{{ $user->email ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Document Details - Compact -->
            <section class="compact-section">
                <h4 class="section-title">
                    <i class="bx bx-file me-1"></i>Document Details
                </h4>
                <div class="content">
                    <div class="row g-2">
                        <div class="col-md-3 col-6">
                            <div class="doc-compact">
                                <div class="doc-title">
                                    <i class="bx bx-passport"></i>Passport
                                </div>
                                <div class="doc-info">
                                    <div>Nationality: {{ optional($countries->firstWhere('id', $resume->passport_nationality))->country_name ?? $resume->passport_nationality ?? '-' }}</div>
                                    <div>No: {{ $resume->passport_number ?? '-' }}</div>
                                    <div>Expiry: {{ optional($resume->passport_expiry)->format('d/m/Y') ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="doc-compact">
                                <div class="doc-title">
                                    <i class="bx bx-id-card"></i>CDC
                                </div>
                                <div class="doc-info">
                                    <div>Nationality: {{ optional($countries->firstWhere('id', $resume->cdc_nationality))->country_name ?? $resume->cdc_nationality ?? '-' }}</div>
                                    <div>No: {{ $resume->cdc_no ?? '-' }}</div>
                                    <div>Expiry: {{ optional($resume->cdc_expiry)->format('d/m/Y') ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="doc-compact">
                                <div class="doc-title">
                                    <i class="bx bx-globe"></i>US Visa
                                </div>
                                <div class="doc-info">
                                    <div>Status: <span class="visa-status {{ ($resume->usa_visa ? 'text-success':'text-muted') }}">{{ $resume->usa_visa ? 'Yes' : 'No' }}</span></div>
                                    @if($resume->usa_visa_expiry)
                                        <div>Expiry: {{ optional($resume->usa_visa_expiry)->format('d/m/Y') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="doc-compact">
                                <div class="doc-title">
                                    <i class="bx bx-shield"></i>INDOS
                                </div>
                                <div class="doc-info">
                                    <div>No: {{ $resume->indos_number ?? '-' }}</div>
                                    @if($resume->indos_expiry)
                                        <div>Expiry: {{ optional($resume->indos_expiry)->format('d/m/Y') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Training & Certificates - Compact -->
            <section class="compact-section">
                <h4 class="section-title">
                    <i class="bx bx-graduation me-1"></i>Training & Certificates
                </h4>
                <div class="content">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="training-compact">
                                <h5>Pre-sea Training</h5>
                                <div class="training-info">
                                    <div>Type: {{ $resume->presea_training_type ?? 'No data' }}</div>
                                    <div>Issue Date: {{ optional($resume->presea_training_issue_date)->format('d/m/Y') ?? 'No data' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="training-compact">
                                <h5>COC/COP Details</h5>
                                <div class="training-info">
                                    <div>Type: {{ $resume->coc_type ?? '-' }}</div>
                                    <div>No: {{ $resume->coc_no ?? '-' }}</div>
                                    <div>Grade: {{ $resume->coc_type ?? $resume->present_rank ?? '-' }}</div>
                                    <div>Expiry: {{ optional($resume->coc_date_of_expiry)->format('d/m/Y') ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DC Endorsements - Compact -->
                    @if($dceEndorsements && $dceEndorsements->isNotEmpty())
                        <div class="mt-3">
                            <h5>DC Endorsements</h5>
                            <div class="row g-2">
                                @foreach($dceEndorsements as $dce)
                                    <div class="col-md-6">
                                        <div class="endorsement-compact">
                                            <div class="endorsement-name">{{ $dce->dce->dce_name ?? ($dce->dce_name ?? '-') }}</div>
                                            <div class="endorsement-valid">Valid: {{ optional($dce->validity_date)->format('d/m/Y') ?? '-' }}</div>
                                            <span class="status-badge {{ (optional($dce->validity_date)->isFuture() ? 'active' : 'expired') }}">
                                                {{ (optional($dce->validity_date)->isFuture() ? 'Active' : 'Expired') ?? 'Status' }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="mt-3">
                            <h5>DC Endorsements</h5>
                            <div class="empty-compact">
                                <i class="bx bx-certificate"></i>
                                <span>No DC endorsements available.</span>
                            </div>
                        </div>
                    @endif

                    <!-- Courses - Compact -->
                    @if($courses && $courses->isNotEmpty())
                        <div class="mt-3">
                            <h5>Valid Courses</h5>
                            <div class="courses-compact">
                                @foreach($courses as $idx => $course)
                                    <span class="course-tag">{{ $course->name ?? $course->course_name ?? '-' }}</span>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="mt-3">
                            <h5>Valid Courses</h5>
                            <div class="empty-compact">
                                <i class="bx bx-book"></i>
                                <span>No valid courses available.</span>
                            </div>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Sea Service - Compact -->
            <section class="compact-section">
                <h4 class="section-title">
                    <i class="bx bx-anchor me-1"></i>Sea Service Details
                </h4>
                <div class="content">
                    @if($seaServices && $seaServices->isNotEmpty())
                        <!-- Desktop Table -->
                        <div class="table-responsive d-none d-lg-block">
                            <table class="compact-table">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Company/Ship</th>
                                        <th>Type</th>
                                        <th>Engine</th>
                                        <th>Tonnage</th>
                                        <th>BHP</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($seaServices as $s)
                                        <tr>
                                            <td class="fw-bold text-primary">{{ $s->rank->rank ?? $s->rank_name ?? '-' }}</td>
                                            <td>{{ $s->company_name }} / {{ $s->ship_name }}</td>
                                            <td>{{ $s->shipType->ship_name ?? $s->ship_type_name ?? '-' }}</td>
                                            <td>{{ $s->engine_type ?? '-' }}</td>
                                            <td>{{ $s->grt_value ? ($s->grt_value . '-' . ($s->grt_unit ?? 'GRT')) : '-' }}</td>
                                            <td>{{ $s->bhp ?? '-' }}</td>
                                            <td>{{ optional($s->sign_on)->format('d/m/Y') ?? '-' }}</td>
                                            <td>{{ optional($s->sign_off)->format('d/m/Y') ?? '-' }}</td>
                                            <td class="fw-bold">{{ $s->duration_text ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Cards -->
                        <div class="mobile-services d-block d-lg-none">
                            @foreach($seaServices as $s)
                                <div class="service-compact">
                                    <div class="service-header">
                                        <span class="rank">{{ $s->rank->rank ?? $s->rank_name ?? '-' }}</span>
                                        <span class="duration">{{ $s->duration_text ?? '-' }}</span>
                                    </div>
                                    <div class="service-company">{{ $s->company_name }} / {{ $s->ship_name }}</div>
                                    <div class="service-meta">
                                        <span>{{ $s->shipType->ship_name ?? $s->ship_type_name ?? '-' }}</span>
                                        <span>{{ $s->grt_value ? $s->grt_value . '-' . ($s->grt_unit ?? 'GRT') : '-' }}</span>
                                        <span>{{ optional($s->sign_on)->format('d/m/Y') ?? '-' }} - {{ optional($s->sign_off)->format('d/m/Y') ?? '-' }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-compact">
                            <i class="bx bx-anchor"></i>
                            <span>No sea service records available.</span>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Additional Details - Compact -->
            <section class="compact-section">
                <h4 class="section-title">
                    <i class="bx bx-info-circle me-1"></i>Additional Details
                </h4>
                <div class="content">
                    @if(!empty($resume->additional_information))
                        <div class="additional-compact">
                            {!! nl2br(e($resume->additional_information)) !!}
                        </div>
                    @else
                        <div class="empty-compact">
                            <i class="bx bx-info-circle"></i>
                            <span>No additional information provided.</span>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
</main>

<style>
/* Compact Resume Design */
:root {
    --primary: #2563eb;
    --primary-light: #eff6ff;
    --secondary: #64748b;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --info: #06b6d4;
    --dark: #1e293b;
    --light: #f8fafc;
    --border: #e2e8f0;
    --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --radius: 0.375rem;
    --radius-sm: 0.25rem;
    --transition: all 0.15s ease-in-out;
}

.compact-bg {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
    padding: 0.75rem 0;
}

/* Compact Breadcrumb */
.compact-breadcrumb {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: var(--radius);
    padding: 0.5rem 1rem;
    box-shadow: var(--shadow-sm);
    font-size: 0.875rem;
}

.compact-nav .breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: var(--secondary);
}

.nav-link {
    color: var(--secondary);
    text-decoration: none;
    padding: 0.25rem 0.5rem;
    border-radius: var(--radius-sm);
    transition: var(--transition);
}

.nav-link:hover {
    color: var(--primary);
    background: var(--primary-light);
}

.mobile-nav {
    background: white;
    border-radius: var(--radius);
    padding: 0.75rem;
    box-shadow: var(--shadow-sm);
    margin: 0 -0.5rem;
}

.btn-back {
    background: var(--light);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--secondary);
}

.btn-back:hover {
    background: var(--primary);
    color: white;
}

.current-page {
    font-size: 1rem;
    font-weight: 600;
    color: var(--dark);
}

/* Compact Container */
.resume-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 0.75rem;
}

/* Compact Actions */
.compact-actions {
    background: white;
    border-radius: var(--radius);
    padding: 1rem;
    box-shadow: var(--shadow);
    margin-bottom: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-left: 3px solid var(--primary);
}

.status-info {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.375rem 0.75rem;
    background: var(--success);
    color: white;
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 0.8125rem;
}

.resume-id, .posted-date {
    color: var(--secondary);
    font-size: 0.8125rem;
    font-weight: 500;
}

.action-btns {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.btn {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 0.75rem;
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 0.8125rem;
    text-decoration: none;
    transition: var(--transition);
    border: 1px solid;
    cursor: pointer;
}

.btn-sm {
    padding: 0.375rem 0.625rem;
    font-size: 0.75rem;
}

.btn-primary {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.btn-primary:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
}

.btn-outline-primary {
    background: transparent;
    color: var(--primary);
    border-color: var(--primary);
}

.btn-outline-primary:hover {
    background: var(--primary);
    color: white;
}

.btn-outline-secondary {
    background: transparent;
    color: var(--secondary);
    border-color: var(--border);
}

.btn-outline-secondary:hover {
    background: var(--secondary);
    color: white;
}

/* Compact Resume */
.compact-resume {
    background: white;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
}

/* Compact Header */
.resume-header {
    background: linear-gradient(135deg, var(--primary) 0%, #1e40af 100%);
    color: white;
    padding: 1.25rem;
    position: relative;
}

.rank-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
}

.rank-item {
    background: rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.rank-item .label {
    font-size: 0.75rem;
    opacity: 0.9;
    margin-bottom: 0.375rem;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.rank-item .value {
    font-size: 1rem;
    font-weight: 700;
    line-height: 1.2;
}

/* Compact Sections */
.compact-section {
    border-bottom: 1px solid var(--border);
}

.compact-section:last-child {
    border-bottom: none;
}

.section-title {
    display: flex;
    align-items: center;
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--dark);
    margin: 0;
    padding: 1.25rem 1.25rem 0.75rem;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 1.25rem;
    width: 2rem;
    height: 2px;
    background: var(--primary);
    border-radius: 1px;
}

.content {
    padding: 0.75rem 1.25rem 1.25rem;
}

/* Compact Fields */
.field {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    margin-bottom: 0.75rem;
}

.field label {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--secondary);
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.field span {
    font-size: 0.875rem;
    color: var(--dark);
    padding: 0.5rem 0.625rem;
    background: var(--light);
    border-radius: var(--radius-sm);
    border: 1px solid var(--border);
}

/* Document Cards - Compact */
.doc-compact {
    background: var(--light);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    overflow: hidden;
    margin-bottom: 0.75rem;
}

.doc-title {
    background: white;
    padding: 0.75rem;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    font-size: 0.875rem;
    color: var(--dark);
}

.doc-title i {
    color: var(--primary);
    font-size: 1.125rem;
}

.doc-info {
    padding: 0.75rem;
    font-size: 0.75rem;
    color: var(--secondary);
    line-height: 1.4;
}

.doc-info div {
    margin-bottom: 0.25rem;
}

/* Training - Compact */
.training-compact {
    background: var(--light);
    border-radius: var(--radius);
    padding: 1rem;
    margin-bottom: 0.75rem;
    border: 1px solid var(--border);
}

.training-compact h5 {
    font-size: 1rem;
    font-weight: 700;
    color: var(--dark);
    margin: 0 0 0.75rem;
}

.training-info {
    font-size: 0.8125rem;
    color: var(--secondary);
    line-height: 1.4;
}

.training-info div {
    margin-bottom: 0.375rem;
}

/* Endorsements - Compact */
.endorsement-compact {
    background: white;
    border-radius: var(--radius);
    padding: 0.875rem;
    border: 1px solid var(--border);
    margin-bottom: 0.5rem;
}

.endorsement-name {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 0.375rem;
}

.endorsement-valid {
    font-size: 0.75rem;
    color: var(--secondary);
    margin-bottom: 0.375rem;
}

.status-badge.active {
    background: var(--success);
    color: white;
    padding: 0.125rem 0.375rem;
    border-radius: var(--radius-sm);
    font-size: 0.6875rem;
    font-weight: 600;
}

.status-badge.expired {
    background: var(--danger);
    color: white;
    padding: 0.125rem 0.375rem;
    border-radius: var(--radius-sm);
    font-size: 0.6875rem;
    font-weight: 600;
}

/* Courses - Compact */
.courses-compact {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.course-tag {
    background: var(--primary-light);
    color: var(--primary);
    padding: 0.375rem 0.75rem;
    border-radius: var(--radius);
    font-size: 0.75rem;
    font-weight: 600;
    border: 1px solid var(--primary);
}

/* Compact Table */
.compact-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    font-size: 0.8125rem;
}

.compact-table thead {
    background: var(--primary);
    color: white;
}

.compact-table th {
    padding: 0.75rem 0.5rem;
    text-align: left;
    font-weight: 600;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.compact-table td {
    padding: 0.75rem 0.5rem;
    border-bottom: 1px solid var(--border);
    color: var(--dark);
}

.compact-table tbody tr:hover {
    background: var(--light);
}

/* Mobile Services */
.service-compact {
    background: white;
    border-radius: var(--radius);
    padding: 1rem;
    border: 1px solid var(--border);
    margin-bottom: 0.75rem;
}

.service-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border);
}

.service-header .rank {
    font-size: 1rem;
    font-weight: 700;
    color: var(--primary);
}

.service-header .duration {
    font-size: 0.75rem;
    font-weight: 600;
    color: white;
    background: var(--success);
    padding: 0.25rem 0.5rem;
    border-radius: var(--radius-sm);
}

.service-company {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 0.5rem;
}

.service-meta {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    font-size: 0.75rem;
    color: var(--secondary);
}

/* Additional Details */
.additional-compact {
    background: var(--light);
    border-radius: var(--radius);
    padding: 1rem;
    border: 1px solid var(--border);
    font-size: 0.875rem;
    line-height: 1.6;
    color: var(--dark);
}

/* Empty State */
.empty-compact {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 1.5rem;
    color: var(--secondary);
    font-style: italic;
    background: var(--light);
    border-radius: var(--radius);
    border: 2px dashed var(--border);
    font-size: 0.875rem;
}

.empty-compact i {
    font-size: 1.25rem;
    opacity: 0.7;
}

/* Responsive Design */
@media (max-width: 768px) {
    .compact-actions {
        flex-direction: column;
        gap: 0.75rem;
        align-items: stretch;
    }

    .action-btns {
        justify-content: center;
    }

    .resume-header {
        padding: 1rem;
    }

    .rank-grid {
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }

    .content {
        padding: 0.75rem;
    }

    .section-title {
        padding: 1rem 0.75rem 0.5rem;
        font-size: 1rem;
    }

    .section-title::after {
        left: 0.75rem;
    }
}

@media (max-width: 480px) {
    .resume-container {
        padding: 0 0.5rem;
    }

    .compact-actions {
        padding: 0.75rem;
        margin: 0 -0.5rem 0.75rem;
        border-radius: 0;
    }

    .compact-resume {
        border-radius: 0;
        margin: 0 -0.5rem;
    }

    .action-btns {
        flex-direction: column;
        width: 100%;
    }

    .btn {
        width: 100%;
        justify-content: center;
    }
}

/* Print Styles */
@media print {
    .compact-actions,
    .compact-breadcrumb,
    .mobile-nav {
        display: none !important;
    }

    .compact-resume {
        box-shadow: none !important;
        border: 1px solid #ccc !important;
    }

    .compact-section {
        page-break-inside: avoid;
    }

    .compact-table {
        font-size: 0.7rem !important;
    }

    .compact-table th,
    .compact-table td {
        padding: 0.375rem 0.25rem !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    initializeCompactResume();
});

function initializeCompactResume() {
    addScrollAnimation();
    optimizeForPrint();
}

function addScrollAnimation() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });

    document.querySelectorAll('.compact-section').forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(10px)';
        section.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
        observer.observe(section);
    });
}

function downloadPDF(event) {
    const btn = event.currentTarget;
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i><span class="d-none d-md-inline ms-1">Generating...</span>';
    btn.disabled = true;

    setTimeout(() => {
        window.print();
        btn.innerHTML = originalText;
        btn.disabled = false;
        showToast('Resume generated successfully!', 'success');
    }, 1000);
}

function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    const bgColor = type === 'success' ? '#10b981' : '#ef4444';

    toast.innerHTML = `<i class="bx bx-check-circle me-1"></i>${message}`;
    toast.style.cssText = `
        position: fixed; top: 20px; right: 20px; background: ${bgColor};
        color: white; padding: 0.75rem 1rem; border-radius: 0.375rem; z-index: 10000;
        display: flex; align-items: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        font-weight: 600; font-size: 0.8125rem;
    `;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

function optimizeForPrint() {
    window.addEventListener('beforeprint', function() {
        document.body.classList.add('printing');
    });
    window.addEventListener('afterprint', function() {
        document.body.classList.remove('printing');
    });
}
</script>
@endsection
