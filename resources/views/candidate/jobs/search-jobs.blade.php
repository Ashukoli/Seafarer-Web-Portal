@extends('layouts.candidate.app')
@section('content')
<!-- Add Swiper.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<main class="page-content modern-professional-bg">
    <!--Enhanced Breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3">
            <i class="bx bx-user-circle me-2"></i>Candidate
        </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 modern-breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('candidate.dashboard') }}" class="breadcrumb-link">
                            <i class="bx bx-home-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bx bx-search-alt me-1"></i>Search Jobs
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <!-- Modern Search Filter Card -->
    <div class="card mb-4 modern-card elevation-soft">
        <div class="card-body p-4">
            <form class="row g-4 align-items-end" method="GET" action="{{ route('candidate.jobs.search') }}">
                <div class="col-md-4 col-12">
                    <label for="rank" class="form-label modern-label">
                        <i class="bx bx-medal me-2"></i>Select Rank
                    </label>
                    <select class="form-select modern-select" id="rank" name="rank">
                        <option value="">Choose your rank...</option>
                        @foreach($ranks as $rank)
                            <option value="{{ $rank->id }}" {{ request('rank') == $rank->id ? 'selected' : '' }}>
                                {{ $rank->rank }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-12">
                    <label for="vessel-type" class="form-label modern-label">
                        <i class="bx bx-anchor me-2"></i>Ship Type
                    </label>
                    <select class="form-select modern-select" id="vessel-type" name="ship_type">
                        <option value="">All Types</option>
                        @foreach($shipTypes as $shipType)
                            <option value="{{ $shipType->id }}" {{ request('ship_type') == $shipType->id ? 'selected' : '' }}>
                                {{ $shipType->ship_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-12">
                    <button type="submit" class="btn btn-modern-primary search-btn w-100">
                        <i class="bx bx-search me-2"></i>Search Jobs
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modern Hot Jobs Section -->
    <div class="card mb-4 modern-card elevation-soft">
        <div class="card-header modern-header gradient-ocean">
            <div class="header-content">
                <h5 class="header-title">
                    <div class="title-icon">
                        <i class="bx bx-fire"></i>
                    </div>
                    <span>Hot Jobs</span>
                    <div class="title-badge">{{ count($hotJobs ?? []) }} Available</div>
                </h5>
                <div class="header-controls">
                    <div class="slider-navigation">
                        <button class="nav-btn prev-btn" id="jobsPrev">
                            <i class="bx bx-chevron-left"></i>
                        </button>
                        <button class="nav-btn next-btn" id="jobsNext">
                            <i class="bx bx-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <!-- Swiper Slider Container -->
            <div class="swiper modern-jobs-swiper">
                <div class="swiper-wrapper">
                    @if(isset($hotJobs) && count($hotJobs) > 0)
                        @foreach($hotJobs as $index => $job)
                            <div class="swiper-slide">
                                <div class="blue-job-card">
                                    <div class="job-title">
                                        Required {{ $job->rank->rank ?? 'Position' }} for {{ $job->shipType->ship_name ?? 'Vessel' }}
                                    </div>
                                    <div class="job-details">
                                        <div class="detail-item">
                                            <span class="detail-label">Joining Date:</span>
                                            <span class="detail-value">{{ optional($job->joining_date)->format('Y-m-d') ?? '2025-10-06' }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Nationality:</span>
                                            <span class="detail-value">{{ $job->nationality ?? 'Indian' }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Minimum Exp:</span>
                                            <span class="detail-value">{{ $job->min_experience ?? '2' }} Years</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Job Description:</span>
                                            <span class="detail-value">{{ $job->description ?? 'Urgent Requirement' }}</span>
                                        </div>
                                    </div>
                                    <div class="job-action">
                                        <a href="{{ route('candidate.jobs.show', $job->id) }}" class="more-btn">More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Sample data when no jobs available -->
                        @php
                            $sampleJobs = [
                                ['position' => 'Chief Engr.', 'vessel' => 'AHTS DP', 'nationality' => 'Indian'],
                                ['position' => 'NWKO', 'vessel' => 'PSV DP', 'nationality' => 'Indian'],
                                ['position' => 'NWKO', 'vessel' => 'AHTS DP', 'nationality' => 'Indian'],
                                ['position' => 'NWKO', 'vessel' => 'OSV', 'nationality' => 'Any'],
                                ['position' => 'Master', 'vessel' => 'Bulk Carrier', 'nationality' => 'Indian'],
                            ];
                        @endphp

                        @foreach($sampleJobs as $index => $job)
                            <div class="swiper-slide">
                                <div class="blue-job-card">
                                    <div class="job-title">
                                        Required {{ $job['position'] }} for {{ $job['vessel'] }}
                                    </div>
                                    <div class="job-details">
                                        <div class="detail-item">
                                            <span class="detail-label">Joining Date:</span>
                                            <span class="detail-value">{{ now()->addDays(($index + 1) * 5)->format('Y-m-d') }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Nationality:</span>
                                            <span class="detail-value">{{ $job['nationality'] }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Minimum Exp:</span>
                                            <span class="detail-value">{{ ($index + 1) * 2 }} Years</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Job Description:</span>
                                            <span class="detail-value">Urgent Requirement</span>
                                        </div>
                                    </div>
                                    <div class="job-action">
                                        <a href="#" class="more-btn">More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- Pagination dots -->
                <div class="swiper-pagination modern-pagination"></div>
            </div>
        </div>
    </div>

    <!-- Modern Advertisements Section -->
    <div class="card mb-4 modern-card elevation-soft">
        <div class="card-header modern-header gradient-slate">
            <div class="header-content">
                <h5 class="header-title">
                    <div class="title-icon">
                        <i class="bx bx-bullhorn"></i>
                    </div>
                    <span>Latest Announcements</span>
                    <div class="title-badge">{{ count($advertisements ?? []) }} Recent</div>
                </h5>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="announcements-grid">
                @if(isset($advertisements) && count($advertisements) > 0)
                    @foreach($advertisements as $ad)
                        <div class="announcement-card">
                            <div class="announcement-content">
                                <div class="announcement-logo">
                                    @if($ad->logo)
                                        <img src="{{ asset('storage/' . $ad->logo) }}" alt="{{ $ad->company_name }}" class="logo-img">
                                    @else
                                        <div class="logo-placeholder">
                                            <i class="bx bx-building"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="announcement-info">
                                    <h6 class="announcement-title">{{ $ad->company_name ?? 'Company Name' }}</h6>
                                    <div class="announcement-meta">
                                        <span class="meta-date">
                                            <i class="bx bx-calendar-alt me-1"></i>
                                            {{ optional($ad->created_at)->format('M d, Y') ?? 'Recent' }}
                                        </span>
                                        <span class="meta-type">
                                            <i class="bx bx-tag me-1"></i>
                                            {{ $ad->type ?? 'Announcement' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="announcement-action">
                                    <a href="{{ route('candidate.advertisements.show', $ad->id) }}" class="btn btn-modern-subtle">
                                        <i class="bx bx-show me-1"></i>
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Sample data when no advertisements available -->
                    @for($i = 1; $i <= 2; $i++)
                        <div class="announcement-card">
                            <div class="announcement-content">
                                <div class="announcement-logo">
                                    <div class="logo-placeholder">
                                        <i class="bx bx-building"></i>
                                    </div>
                                </div>
                                <div class="announcement-info">
                                    <h6 class="announcement-title">{{ ['Oceanic Shipping Ltd.', 'Marine Careers Group'][$i-1] }}</h6>
                                    <div class="announcement-meta">
                                        <span class="meta-date">
                                            <i class="bx bx-calendar-alt me-1"></i>
                                            {{ now()->subDays($i * 2)->format('M d, Y') }}
                                        </span>
                                        <span class="meta-type">
                                            <i class="bx bx-tag me-1"></i>
                                            Announcement
                                        </span>
                                    </div>
                                </div>
                                <div class="announcement-action">
                                    <a href="#" class="btn btn-modern-subtle">
                                        <i class="bx bx-show me-1"></i>
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>
</main>

<style>
/* Modern Professional Color Palette */
:root {
    --primary-50: #f0f9ff;
    --primary-100: #e0f2fe;
    --primary-500: #0ea5e9;
    --primary-600: #0284c7;
    --primary-700: #0369a1;

    --blue-gradient-start: #4A90E2;
    --blue-gradient-end: #357ABD;
    --blue-border: #2E5F8F;
    --blue-text: #1E3A5F;

    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;

    --success-50: #f0fdf4;
    --success-500: #22c55e;
    --success-600: #16a34a;

    --warning-50: #fffbeb;
    --warning-500: #f59e0b;

    --red-50: #fef2f2;
    --red-500: #ef4444;

    --radius-sm: 0.375rem;
    --radius-md: 0.5rem;
    --radius-lg: 0.75rem;
    --radius-xl: 1rem;

    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);

    --transition: all 0.15s ease-in-out;
}

/* Modern Background */
.modern-professional-bg {
    background: linear-gradient(135deg, var(--gray-50) 0%, var(--primary-50) 100%);
    min-height: 100vh;
    padding: 2rem 1rem;
}

/* Modern Breadcrumb */
.modern-breadcrumb {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    padding: 0.75rem 1.5rem;
    box-shadow: var(--shadow-sm);
}

.breadcrumb-link {
    color: var(--gray-600);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
    display: flex;
    align-items: center;
    padding: 0.25rem 0.5rem;
    border-radius: var(--radius-sm);
}

.breadcrumb-link:hover {
    color: var(--primary-600);
    background: var(--primary-50);
}

.breadcrumb-title {
    font-weight: 600;
    color: var(--gray-700);
    font-size: 1.1rem;
    display: flex;
    align-items: center;
}

.breadcrumb-item.active {
    color: var(--gray-500);
    font-weight: 500;
    display: flex;
    align-items: center;
}

/* Modern Cards */
.modern-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-xl);
    overflow: hidden;
    transition: var(--transition);
    margin: 0 0.5rem 1.5rem 0.5rem;
}

.elevation-soft {
    box-shadow: var(--shadow-md);
}

.modern-card:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-2px);
}

/* Modern Form Elements */
.modern-label {
    color: var(--gray-700);
    font-size: 0.875rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
}

.modern-select {
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-md);
    padding: 0.75rem 1rem;
    font-size: 0.875rem;
    transition: var(--transition);
    background: white;
    color: var(--gray-700);
}

.modern-select:focus {
    border-color: var(--primary-500);
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    outline: none;
}

/* Modern Buttons */
.btn-modern-primary {
    background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
    border: 2px solid var(--primary-500);
    color: white;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius-md);
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-modern-primary:hover {
    background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
    color: white;
}

.btn-modern-subtle {
    background: var(--gray-100);
    border: 2px solid var(--gray-200);
    color: var(--gray-700);
    font-weight: 500;
    padding: 0.5rem 1rem;
    border-radius: var(--radius-md);
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 0.875rem;
}

.btn-modern-subtle:hover {
    background: var(--primary-50);
    border-color: var(--primary-200);
    color: var(--primary-700);
    transform: translateY(-1px);
}

/* Modern Headers */
.modern-header {
    border: none;
    padding: 1.25rem 1.5rem;
    position: relative;
    overflow: hidden;
}

.gradient-ocean {
    background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-600) 50%, var(--primary-700) 100%);
}

.gradient-slate {
    background: linear-gradient(135deg, var(--gray-600) 0%, var(--gray-700) 50%, var(--gray-800) 100%);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    z-index: 2;
}

.header-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: white;
    font-size: 1rem;
    font-weight: 700;
    margin: 0;
}

.title-icon {
    width: 2rem;
    height: 2rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.title-badge {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 0.2rem 0.6rem;
    border-radius: 9999px;
    font-size: 0.7rem;
    font-weight: 600;
}

/* Modern Slider Navigation */
.slider-navigation {
    display: flex;
    gap: 0.375rem;
}

.nav-btn {
    width: 2rem;
    height: 2rem;
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
    font-size: 1rem;
}

.nav-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.05);
}

.nav-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

/* Blue Job Cards - Horizontal Layout like in image */
.modern-jobs-swiper {
    padding-bottom: 1.5rem;
}

.blue-job-card {
    background: linear-gradient(135deg, var(--blue-gradient-start), var(--blue-gradient-end));
    border: 2px solid var(--blue-border);
    border-radius: var(--radius-xl);
    padding: 1.5rem;
    color: white;
    box-shadow: var(--shadow-md);
    transition: var(--transition);
    height: 180px; /* Fixed height for consistent layout */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    overflow: hidden;
}

.blue-job-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    transform: translate(30px, -30px);
    pointer-events: none;
}

.blue-job-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    background: linear-gradient(135deg, var(--blue-gradient-end), var(--blue-border));
}

.job-title {
    font-size: 1rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
    line-height: 1.3;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

.job-details {
    flex-grow: 1;
    margin-bottom: 1rem;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.4rem;
    font-size: 0.85rem;
}

.detail-label {
    font-weight: 600;
    color: rgba(255, 255, 255, 0.9);
    min-width: 100px;
}

.detail-value {
    font-weight: 500;
    color: white;
    text-align: right;
}

.job-action {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-top: auto;
}

.more-btn {
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.4);
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    transition: var(--transition);
    backdrop-filter: blur(10px);
}

.more-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.6);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Modern Pagination */
.modern-pagination {
    text-align: center;
    margin-top: 1rem;
}

.modern-jobs-swiper .swiper-pagination-bullet {
    width: 0.5rem;
    height: 0.5rem;
    background: var(--gray-300);
    opacity: 1;
    margin: 0 0.25rem;
    transition: var(--transition);
}

.modern-jobs-swiper .swiper-pagination-bullet-active {
    background: var(--primary-500);
    transform: scale(1.5);
}

/* Modern Announcements */
.announcements-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.announcement-card {
    background: white;
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-lg);
    padding: 1.25rem;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.announcement-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: var(--primary-200);
}

.announcement-content {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.announcement-logo {
    width: 3.5rem;
    height: 3.5rem;
    border-radius: var(--radius-lg);
    overflow: hidden;
    flex-shrink: 0;
}

.logo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.logo-placeholder {
    width: 100%;
    height: 100%;
    background: var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gray-500);
    font-size: 1.5rem;
}

.announcement-info {
    flex-grow: 1;
}

.announcement-title {
    color: var(--gray-800);
    font-weight: 700;
    font-size: 1rem;
    margin: 0 0 0.5rem 0;
}

.announcement-meta {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.meta-date,
.meta-type {
    color: var(--gray-500);
    font-size: 0.75rem;
    font-weight: 500;
    display: flex;
    align-items: center;
}

/* Enhanced Card Spacing */
.card-body {
    padding: 1.5rem !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .modern-professional-bg {
        padding: 1rem 0.5rem;
    }

    .modern-card {
        margin: 0 0 1rem 0;
    }

    .slider-navigation {
        display: none;
    }

    .blue-job-card {
        padding: 1rem;
        height: 160px;
    }

    .job-title {
        font-size: 0.9rem;
        margin-bottom: 0.75rem;
    }

    .detail-item {
        margin-bottom: 0.3rem;
        font-size: 0.8rem;
    }

    .detail-label {
        min-width: 80px;
    }

    .header-content {
        flex-direction: column;
        gap: 0.75rem;
        align-items: flex-start;
    }

    .header-title {
        font-size: 0.9rem;
    }

    .modern-header {
        padding: 1rem;
    }

    .announcement-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .announcement-info {
        width: 100%;
    }

    .announcement-action {
        width: 100%;
    }

    .card-body {
        padding: 1rem !important;
    }
}

@media (max-width: 576px) {
    .modern-card {
        border-radius: var(--radius-lg);
    }

    .blue-job-card {
        height: 140px;
        padding: 0.75rem;
    }

    .job-title {
        font-size: 0.85rem;
    }

    .detail-item {
        font-size: 0.75rem;
    }
}

/* Focus States for Accessibility */
.modern-select:focus,
.btn-modern-primary:focus,
.btn-modern-subtle:focus,
.more-btn:focus {
    outline: 2px solid var(--primary-500);
    outline-offset: 2px;
}

.breadcrumb-link:focus {
    outline: 2px solid var(--primary-500);
    outline-offset: 2px;
}
</style>

<!-- Add Swiper.js JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Modern Jobs Swiper
    const modernJobsSwiper = new Swiper('.modern-jobs-swiper', {
        slidesPerView: 1.1,
        spaceBetween: 16,
        centeredSlides: false,
        loop: true,
        grabCursor: true,

        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },

        navigation: {
            nextEl: '#jobsNext',
            prevEl: '#jobsPrev',
        },

        breakpoints: {
            576: {
                slidesPerView: 1.5,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 24,
            },
            992: {
                slidesPerView: 2.5,
                spaceBetween: 28,
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 32,
            },
            1400: {
                slidesPerView: 4,
                spaceBetween: 32,
            }
        },

        on: {
            init: function () {
                updateNavigationState(this);
            },
            slideChange: function () {
                updateNavigationState(this);
            },
        }
    });

    function updateNavigationState(swiper) {
        const prevBtn = document.getElementById('jobsPrev');
        const nextBtn = document.getElementById('jobsNext');

        if (prevBtn && nextBtn) {
            prevBtn.disabled = false;
            nextBtn.disabled = false;
        }
    }

    // Pause autoplay on hover
    const swiperContainer = document.querySelector('.modern-jobs-swiper');
    if (swiperContainer) {
        swiperContainer.addEventListener('mouseenter', () => {
            modernJobsSwiper.autoplay.stop();
        });

        swiperContainer.addEventListener('mouseleave', () => {
            modernJobsSwiper.autoplay.start();
        });
    }

    // Enhanced form interactions
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.search-btn');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i>Searching...';
            submitBtn.disabled = true;

            // Re-enable after a delay if no actual submission
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });
    }

    // Add smooth animations
    const cards = document.querySelectorAll('.blue-job-card, .announcement-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});
</script>
@endsection
