@extends('layouts.candidate.app')
@section('content')
<main class="page-content professional-bg">
    <!-- breadcrumb (same style as hot-jobs listing) -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
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
                    <li class="breadcrumb-item">
                        <a href="{{ route('candidate.jobs.hot') }}" class="breadcrumb-link">
                            <i class="bx bxs-hot me-1"></i>Hot Jobs
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bx bx-file me-1"></i>Job Details
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-2">
        <div class="card border-0 shadow-sm mx-auto professional-card job-details-card-compact">
            <!-- Compact Header with Company Info -->
            <div class="card-header bg-white border-bottom-0 job-details-header-compact position-relative">
                <!-- Urgent Badge - positioned absolute on desktop, flows on small screens -->
                @if($job->withsms)
                    <div class="urgent-badge-absolute">
                        <i class="bx bx-error-circle me-1"></i>Urgent
                    </div>
                @endif

                <div class="row align-items-center">
                    <div class="col-auto">
                        <img src="{{ optional($job->company)->logo ? asset('storage/' . $job->company->logo) : asset('theme/assets/images/products/download.png') }}"
                             class="job-details-logo-compact rounded-circle border bg-light"
                             alt="Company Logo">
                    </div>
                    <div class="col">
                        <h1 class="job-details-company-name-compact mb-1">{{ optional($job->company)->company_name ?? 'Company' }}</h1>
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <span class="job-details-badge-compact company-badge">
                                <i class="bx bx-buildings me-1"></i>Company
                            </span>
                            <span class="job-details-badge-compact posted-badge">
                                <i class="bx bx-calendar me-1"></i>Posted: {{ optional($job->created_at) ? $job->created_at->format('M d, Y') : '—' }}
                            </span>
                        </div>
                    </div>
                    <!-- Header apply button (desktop only) -->
                    <div class="col-auto d-none d-md-block">
                        @if(! empty($hasApplied))
                            <button type="button" class="job-action-btn-compact apply-btn disabled" aria-disabled="true">
                                <i class="bx bx-check-circle"></i>
                                <span class="apply-btn-text">Already Applied</span>
                            </button>
                        @else
                            <form method="POST" action="{{ url('candidate/hotjobs/'.$job->id.'/apply') }}" class="m-0">
                                @csrf
                                <button type="submit" class="job-action-btn-compact apply-btn" aria-live="polite">
                                    <i class="bx bx-check-circle"></i>
                                    <span class="apply-btn-text">Apply Now</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Compact Job Details Grid -->
            <div class="card-body job-details-body-compact">
                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-4">
                        <div class="job-detail-item-compact">
                            <div class="detail-icon-compact">
                                <i class="bx bx-user"></i>
                            </div>
                            <div class="detail-content-compact">
                                <div class="detail-label-compact">RANK</div>
                                <div class="detail-value-compact">{{ optional($job->rank)->rank ?? '—' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="job-detail-item-compact">
                            <div class="detail-icon-compact">
                                <i class="bx bx-anchor"></i>
                            </div>
                            <div class="detail-content-compact">
                                <div class="detail-label-compact">SHIP TYPE</div>
                                <div class="detail-value-compact">{{ optional($job->ship)->ship_name ?? '—' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="job-detail-item-compact">
                            <div class="detail-icon-compact">
                                <i class="bx bx-calendar"></i>
                            </div>
                            <div class="detail-content-compact">
                                <div class="detail-label-compact">JOINING DATE</div>
                                <div class="detail-value-compact">{{ $job->joiningdate ? \Carbon\Carbon::parse($job->joiningdate)->format('M d, Y') : '—' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="job-detail-item-compact">
                            <div class="detail-icon-compact">
                                <i class="bx bx-calendar-check"></i>
                            </div>
                            <div class="detail-content-compact">
                                <div class="detail-label-compact">EXPIRY DATE</div>
                                <div class="detail-value-compact">{{ $job->expiry_date ? \Carbon\Carbon::parse($job->expiry_date)->format('M d, Y') : '—' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="job-detail-item-compact">
                            <div class="detail-icon-compact">
                                <i class="bx bx-flag"></i>
                            </div>
                            <div class="detail-content-compact">
                                <div class="detail-label-compact">NATIONALITY</div>
                                <div class="detail-value-compact">{{ $job->nationality ?? '—' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="job-detail-item-compact">
                            <div class="detail-icon-compact">
                                <i class="bx bx-time"></i>
                            </div>
                            <div class="detail-content-compact">
                                <div class="detail-label-compact">EXPERIENCE</div>
                                <div class="detail-value-compact">{{ $job->experience ?? '—' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="job-details-divider-compact">

                <!-- Compact Job Description -->
                <div class="job-description-container-compact mb-4">
                    <h6 class="job-description-title-compact">
                        <i class="bx bx-file-text me-2"></i>Job Description
                    </h6>
                    <div class="job-description-text-compact">{{ $job->description }}</div>
                </div>

                <!-- Compact Contact Information Section (Hidden by default) -->
                <div id="contactInfo" class="contact-section-compact mb-4">
                    <h6 class="contact-section-title-compact">
                        <i class="bx bx-phone-call me-2"></i>Contact Information
                    </h6>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="contact-item-compact">
                                <div class="contact-icon-compact">
                                    <i class="bx bx-user-circle"></i>
                                </div>
                                <div class="contact-details-compact">
                                    <div class="contact-label-compact">Posted By</div>
                                    <div class="contact-value-compact">{{ $job->posted_by_name ?? '—' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="contact-item-compact">
                                <div class="contact-icon-compact">
                                    <i class="bx bx-envelope"></i>
                                </div>
                                <div class="contact-details-compact">
                                    <div class="contact-label-compact">Email ID</div>
                                    <div class="contact-value-compact">
                                        @if($job->posted_by_email)
                                            <a href="mailto:{{ $job->posted_by_email }}" class="contact-link-compact">{{ $job->posted_by_email }}</a>
                                        @else
                                            —
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="contact-item-compact">
                                <div class="contact-icon-compact">
                                    <i class="bx bx-phone"></i>
                                </div>
                                <div class="contact-details-compact">
                                    <div class="contact-label-compact">Contact No.</div>
                                    <div class="contact-value-compact">
                                        @if($job->posted_by_mobile)
                                            <a href="tel:{{ $job->posted_by_mobile }}" class="contact-link-compact">{{ $job->posted_by_mobile }}</a>
                                        @else
                                            —
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons (body) -->
                <div class="job-details-actions-compact">
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        @if(! empty($hasApplied))
                            <button type="button" class="job-action-btn-compact apply-btn disabled" aria-disabled="true">
                                <i class="bx bx-check-circle"></i>
                                <span class="apply-btn-text">Already Applied</span>
                            </button>
                        @else
                            <form method="POST" action="{{ url('candidate/hotjobs/'.$job->id.'/apply') }}" class="m-0">
                                @csrf
                                <button type="submit" class="job-action-btn-compact apply-btn" aria-live="polite">
                                    <i class="bx bx-check-circle"></i>
                                    <span class="apply-btn-text">Apply Now</span>
                                </button>
                            </form>
                        @endif

                        <button type="button" id="toggleContactBtn" class="job-action-btn-compact contact-btn">
                            <i class="bx bx-phone"></i>
                            <span id="contactBtnText">View Contact</span>
                        </button>
                    </div>
                </div>

                <!-- Compact SMS Alert Notice -->
                <div class="sms-alert-notice-compact">
                    <i class="bx bx-info-circle me-2"></i>
                    <span><strong>Note:</strong> Continue receiving "instant job SMS Alert"
                    <a href="{{ route('candidate.express.service') }}" class="sms-alert-link">Click Here</a></span>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
