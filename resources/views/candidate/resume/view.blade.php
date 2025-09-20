{{-- resources/views/candidate/resume/show.blade.php --}}
@extends('layouts.candidate.app')

@section('content')
<main class="page-content professional-bg">
    <!-- Enhanced Professional Breadcrumb -->
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

    <!-- Mobile Breadcrumb -->
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
                    <i class="bx bx-check-circle me-2"></i>
                    {{ optional($profile)->profile_completion ? 'Complete Profile' : 'Profile' }}
                </span>

                @if(!empty($resume->id))
                    <span class="resume-id">ID: {{ $resume->id }}</span>
                @endif

                <span class="posted-date">Posted: {{ optional($resume->created_at)->format('jS M, Y') ?? '-' }}</span>
            </div>

            <div class="action-buttons">
                <button class="btn btn-outline-primary" onclick="window.print()">
                    <i class="bx bx-printer me-1"></i>Print Resume
                </button>

                <a href="{{ route('candidate.resume.edit') }}" class="btn btn-outline-secondary">
                    <i class="bx bx-edit me-1"></i>Edit Resume
                </a>

                <button class="btn btn-primary" id="downloadPdfBtn" onclick="downloadPDF(event)">
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
                        <div class="rank-value">{{ $resume->present_rank ? (is_numeric($resume->present_rank) ? ($ranks->firstWhere('id', $resume->present_rank)->rank ?? $resume->present_rank) : $resume->present_rank) : '-' }}</div>
                    </div>

                    <div class="rank-experience">
                        <div class="exp-title">Present Rank Exp:</div>
                        <div class="exp-value">{{ $resume->present_rank_exp ?? '-' }}</div>
                    </div>

                    <div class="applied-position">
                        <div class="position-title">Post Applied for:</div>
                        <div class="position-value">{{ $resume->post_applied_for ? (is_numeric($resume->post_applied_for) ? ($ranks->firstWhere('id', $resume->post_applied_for)->rank ?? $resume->post_applied_for) : $resume->post_applied_for) : '-' }}</div>
                    </div>

                    <div class="availability">
                        <div class="avail-title">Date of Availability:</div>
                        <div class="avail-value">{{ optional($resume->date_of_availability)->format('d/m/Y') ?? '-' }}</div>
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
                                <span class="detail-value">{{ $profile->first_name ?? $user->first_name ?? '-' }}</span>
                            </div>
                            <div class="detail-group">
                                <label class="detail-label">Middle Name:</label>
                                <span class="detail-value">{{ $profile->middle_name ?? '-' }}</span>
                            </div>
                            <div class="detail-group">
                                <label class="detail-label">Last Name:</label>
                                <span class="detail-value">{{ $profile->last_name ?? $user->last_name ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="detail-row">
                            <div class="detail-group">
                                <label class="detail-label">Gender:</label>
                                <span class="detail-value">{{ ucfirst($profile->gender ?? '-') }}</span>
                            </div>
                            <div class="detail-group">
                                <label class="detail-label">Marital Status:</label>
                                <span class="detail-value">{{ ucfirst($profile->marital_status ?? '-') }}</span>
                            </div>
                            <div class="detail-group">
                                <label class="detail-label">Nationality:</label>
                                <span class="detail-value">{{ $profile->nationality ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="detail-row">
                            <div class="detail-group">
                                <label class="detail-label">State:</label>
                                <span class="detail-value">{{ optional($states->firstWhere('id', $profile->state_id))->state_name ?? '-' }}</span>
                            </div>
                            <div class="detail-group">
                                <label class="detail-label">D.O.B:</label>
                                <span class="detail-value">{{ optional($profile->dob)->format('d/m/Y') ?? '-' }}</span>
                            </div>
                            <div class="detail-group">
                                <label class="detail-label">Mobile:</label>
                                <span class="detail-value">{{ $profile->mobile_number ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="detail-row full-width">
                            <div class="detail-group">
                                <label class="detail-label">Present Address:</label>
                                <span class="detail-value">{{ $profile->address ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="detail-row full-width">
                            <div class="detail-group">
                                <label class="detail-label">Email ID:</label>
                                <span class="detail-value">{{ $user->email ?? '-' }}</span>
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
                                    <span class="doc-value">{{ $resume->passport_nationality ?? '-' }}</span>
                                </div>
                                <div class="doc-item">
                                    <span class="doc-label">No:</span>
                                    <span class="doc-value">{{ $resume->passport_number ?? '-' }}</span>
                                </div>
                                <div class="doc-item">
                                    <span class="doc-label">Expiry:</span>
                                    <span class="doc-value">{{ optional($resume->passport_expiry)->format('d/m/Y') ?? '-' }}</span>
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
                                    <span class="doc-value">{{ $resume->cdc_nationality ?? '-' }}</span>
                                </div>
                                <div class="doc-item">
                                    <span class="doc-label">No:</span>
                                    <span class="doc-value">{{ $resume->cdc_no ?? '-' }}</span>
                                </div>
                                <div class="doc-item">
                                    <span class="doc-label">Expiry:</span>
                                    <span class="doc-value">{{ optional($resume->cdc_expiry)->format('d/m/Y') ?? '-' }}</span>
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
                                    <span class="doc-value {{ ($resume->usa_visa ? 'visa-yes':'') }}">{{ $resume->usa_visa ? 'Yes' : 'No' }}</span>
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
                                    <span class="doc-value">{{ $resume->indos_number ?? '-' }}</span>
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
                                <span class="training-value">{{ $resume->presea_training_type ?? 'No data' }}</span>
                            </div>
                            <div class="training-item">
                                <span class="training-label">Issue Date:</span>
                                <span class="training-value">{{ optional($resume->presea_training_issue_date)->format('d/m/Y') ?? 'No data' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- COC/COP Details -->
                    <div class="training-block">
                        <h4 class="training-title">COC/COP Details</h4>
                        <div class="training-details">
                            <div class="training-item">
                                <span class="training-label">Type:</span>
                                <span class="training-value">{{ $resume->coc_type ?? '-' }}</span>
                            </div>
                            <div class="training-item">
                                <span class="training-label">No:</span>
                                <span class="training-value">{{ $resume->coc_no ?? '-' }}</span>
                            </div>
                            <div class="training-item">
                                <span class="training-label">Grade:</span>
                                <span class="training-value">{{ $resume->coc_type ?? $resume->present_rank ?? '-' }}</span>
                            </div>
                            <div class="training-item">
                                <span class="training-label">Expiry:</span>
                                <span class="training-value">{{ optional($resume->coc_date_of_expiry)->format('d/m/Y') ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- DC Endorsement -->
                    <div class="training-block dc-endorsement">
                        <h4 class="training-title">DC Endorsement</h4>

                        @if($dceEndorsements && $dceEndorsements->isNotEmpty())
                            <div class="endorsement-list">
                                @foreach($dceEndorsements as $dce)
                                    <div class="endorsement-item">
                                        <div class="endorsement-card">
                                            <div class="endorsement-header">
                                                <div class="endorsement-name">{{ $dce->dce->dce_name ?? ($dce->dce_name ?? '-') }}</div>
                                                <div class="endorsement-validity">
                                                    <span class="validity-label">Valid Until:</span>
                                                    <span class="validity-date">{{ optional($dce->validity_date)->format('d/m/Y') ?? '-' }}</span>
                                                </div>
                                            </div>
                                            <div class="endorsement-status">
                                                <span class="status-active">
                                                    <i class="bx bx-check-circle me-1"></i>{{ (optional($dce->validity_date)->isFuture() ? 'Active' : 'Expired') ?? 'Status' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-3">No DC endorsements recorded.</div>
                        @endif
                    </div>

                    <!-- Valid Courses -->
                    <div class="training-block">
                        <h4 class="training-title">List of Valid Courses</h4>
                        <div class="courses-list">
                            @if($courses && $courses->isNotEmpty())
                                @foreach($courses as $idx => $course)
                                    <div class="course-item">
                                        <span class="course-number">{{ $idx + 1 }}.</span>
                                        <span class="course-name">{{ $course->name ?? $course->course_name ?? '-' }}</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="p-3">No courses recorded.</div>
                            @endif
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
                    @if($seaServices && $seaServices->isNotEmpty())
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
                                    @foreach($seaServices as $s)
                                        <tr>
                                            <td class="rank-cell">{{ $s->rank->rank ?? $s->rank_name ?? '-' }}</td>
                                            <td class="company-cell">{{ $s->company_name }} / {{ $s->ship_name }}</td>
                                            <td>{{ $s->shipType->ship_name ?? $s->ship_type_name ?? '-' }}</td>
                                            <td>{{ $s->engine_type ?? '-' }}</td>
                                            <td>{{ $s->grt_value ? ($s->grt_value . '-' . ($s->grt_unit ?? 'GRT')) : '-' }}</td>
                                            <td>{{ $s->bhp ?? '-' }}</td>
                                            <td>{{ optional($s->sign_on)->format('d/m/Y') ?? '-' }}</td>
                                            <td>{{ optional($s->sign_off)->format('d/m/Y') ?? '-' }}</td>
                                            <td class="duration-cell">
                                                {{-- simple duration display; you may want to compute precisely in model/service --}}
                                                {{ $s->duration_text ?? '' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="mobile-sea-service d-block d-lg-none">
                            @foreach($seaServices as $s)
                                <div class="service-card">
                                    <div class="service-header">
                                        <div class="service-rank">{{ $s->rank->rank ?? $s->rank_name ?? '-' }}</div>
                                        <div class="service-duration">{{ $s->duration_text ?? '-' }}</div>
                                    </div>
                                    <div class="service-company">{{ $s->company_name }} / {{ $s->ship_name }}</div>
                                    <div class="service-details">
                                        <div class="service-detail">
                                            <span class="detail-label">Ship Type:</span>
                                            <span class="detail-value">{{ $s->shipType->ship_name ?? $s->ship_type_name ?? '-' }}</span>
                                        </div>
                                        <div class="service-detail">
                                            <span class="detail-label">Tonnage:</span>
                                            <span class="detail-value">{{ $s->grt_value ? $s->grt_value . '-' . ($s->grt_unit ?? 'GRT') : '-' }}</span>
                                        </div>
                                        <div class="service-detail">
                                            <span class="detail-label">Period:</span>
                                            <span class="detail-value">{{ optional($s->sign_on)->format('d/m/Y') ?? '-' }} - {{ optional($s->sign_off)->format('d/m/Y') ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="view-all-services">
                                <button class="btn btn-outline-primary btn-sm">View All Sea Service Records</button>
                            </div>
                        </div>
                    @else
                        <div class="p-3">No sea service records available.</div>
                    @endif
                </div>
            </section>

            <!-- Additional Details Section -->
            <section class="resume-section">
                <h3 class="section-title">
                    <i class="bx bx-info-circle me-2"></i>Additional Details
                </h3>
                <div class="section-content">
                    <div class="additional-details">
                        <div class="details-block">
                            @if(!empty($resume->additional_information))
                                <p class="details-text">{!! nl2br(e($resume->additional_information)) !!}</p>
                            @else
                                <p class="details-text">No additional information provided.</p>
                            @endif

                            @if(!empty($resume->additional_highlights))
                                <ul class="highlights-list">
                                    @foreach($resume->additional_highlights as $h)
                                        <li>{{ $h }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<style>
/* (You can keep your existing CSS block here - omitted for brevity in this snippet)
   I recommend keeping the CSS you already have; the template above expects those classes.
*/
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    initializeResumeView();
});

function initializeResumeView() {
    const sections = document.querySelectorAll('.resume-section');
    sections.forEach(section => section.style.scrollMarginTop = '20px');
    optimizeForPrint();
}

function downloadPDF(event) {
    const btn = event.currentTarget;
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-1"></i>Generating PDF...';
    btn.disabled = true;

    // Replace with server-side PDF generation or client-side library
    setTimeout(() => {
        window.print();
        btn.innerHTML = originalText;
        btn.disabled = false;
        showToast('Resume PDF generated successfully!');
    }, 1000);
}

function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'toast-notification';
    toast.innerHTML = `<i class="bx bx-check-circle me-2"></i>${message}`;
    toast.style.cssText = `
        position: fixed; top: 20px; right: 20px; background: #059669;
        color: white; padding: 12px 20px; border-radius: 8px; z-index: 10000;
        display: flex; align-items: center;
    `;
    document.body.appendChild(toast);
    setTimeout(() => { toast.remove(); }, 2800);
}

function optimizeForPrint() {
    window.addEventListener('beforeprint', function() { document.body.classList.add('printing'); });
    window.addEventListener('afterprint', function() { document.body.classList.remove('printing'); });
}
</script>
@endsection
