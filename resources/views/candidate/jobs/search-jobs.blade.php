@extends('layouts.candidate.app')
@section('content')
<!-- Add Swiper.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<main class="page-content modern-professional-bg">
    {{-- flash messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
        <div class="card-header modern-header gradient-custom">
            <div class="header-content">
                <h5 class="header-title">
                    <div class="title-icon">
                        <i class="bx bxs-hot"></i>
                    </div>
                    <span>Hot Jobs</span>
                    <div class="title-badge">{{ isset($hotJobs) && count($hotJobs) > 0 ? count($hotJobs) : '0' }} Available</div>
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
            @if(isset($hotJobs) && count($hotJobs) > 0)
                <!-- Swiper Slider Container -->
                <div class="swiper modern-jobs-swiper">
                    <div class="swiper-wrapper">
                        @foreach($hotJobs as $job)
                            <div class="swiper-slide">
                                <div class="blue-job-card">
                                    <!-- Job Title Section -->
                                    <div class="job-title-section">
                                        <div class="job-title">
                                            Required {{ optional($job->rank)->rank ?? 'Bosun' }} for {{ optional($job->ship)->ship_name ?? 'Crude Oil Tanker' }}
                                        </div>
                                    </div>

                                    <!-- Job Details Section -->
                                    <div class="job-details-section">
                                        <div class="detail-item">
                                            <span class="detail-label">Joining Date:</span>
                                            <span class="detail-value">{{ $job->joiningdate ? \Carbon\Carbon::parse($job->joiningdate)->format('Y-m-d') : '2025-10-16' }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Nationality:</span>
                                            <span class="detail-value">{{ $job->nationality ?? 'India' }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Minimum Exp:</span>
                                            <span class="detail-value">{{ $job->experience ?? '7 Years' }}</span>
                                        </div>
                                    </div>

                                    <!-- Action Button - Always at Bottom Right -->
                                    <div class="job-action-section">
                                        <a href="{{ url('candidate/jobs/'.$job->id) }}" class="more-btn">More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pagination dots -->
                    <div class="swiper-pagination modern-pagination"></div>
                </div>
            @else
                <div class="text-center text-muted py-4">
                    No hot jobs available.
                </div>
            @endif
        </div>
    </div>

    <!-- Modern Advertisements Section -->
    <div class="card mb-4 modern-card elevation-soft">
        <div class="card-header modern-header gradient-custom">
            <div class="header-content">
                <h5 class="header-title">
                    <div class="title-icon">
                        <i class="bx bxs-megaphone"></i>
                    </div>
                    <span>Banner Advertisements</span>
                    <div class="title-badge">{{ isset($bannerAds) && count($bannerAds) > 0 ? count($bannerAds) : '0' }} Recent</div>
                </h5>
            </div>
        </div>
        <div class="card-body p-4">
            @if(isset($bannerAds) && count($bannerAds) > 0)
                <div class="announcements-grid">
                    @foreach($bannerAds as $ad)
                        <div class="announcement-card">
                            <div class="announcement-content">
                                {{-- Company Logo --}}
                                <div class="announcement-logo">
                                    @if($ad->company && $ad->company->company_logo)
                                        <img src="{{ asset('theme/assets/images/company_logo/' . $ad->company->company_logo) }}" alt="{{ $ad->company->company_name }}" class="logo-img">
                                    @else
                                        <div class="logo-placeholder">
                                            <i class="bx bx-building"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="announcement-info">
                                    {{-- Company Name --}}
                                    <h6 class="announcement-title">
                                        {{ $ad->company->company_name ?? 'Company Name' }}
                                    </h6>
                                    {{-- Posted Date --}}
                                    <div class="announcement-meta">
                                        <span class="meta-date">
                                            <i class="bx bx-calendar-alt me-1"></i>
                                            {{ $ad->posted_date ? \Carbon\Carbon::parse($ad->posted_date)->format('d M Y') : 'Recent' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="announcement-action">
                                    <a href="{{ route('candidate.advertisements.details', $ad->id) }}">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-muted py-4">
                    No advertisements available.
                </div>
            @endif
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

    --header-primary: #e0e7ff;
    --header-secondary: #c7d2fe;
    --header-accent: #a5b4fc;
    --header-text: #3730a3;
    --header-text-light: #4338ca;

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
    border-color: var(--header-accent);
    box-shadow: 0 0 0 3px rgba(165, 180, 252, 0.15);
    outline: none;
}

/* Modern Buttons - Matching Header Colors */
.btn-modern-primary {
    background: linear-gradient(135deg, var(--header-secondary), var(--header-accent));
    border: 2px solid var(--header-accent);
    color: var(--header-text);
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius-md);
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 4px rgba(165, 180, 252, 0.2);
}

.btn-modern-primary:hover {
    background: linear-gradient(135deg, var(--header-accent), var(--header-text-light));
    border-color: var(--header-text-light);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(165, 180, 252, 0.3);
    color: white;
}

.btn-modern-primary:active {
    transform: translateY(0);
    box-shadow: 0 2px 4px rgba(165, 180, 252, 0.2);
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
    background: var(--header-primary);
    border-color: var(--header-secondary);
    color: var(--header-text);
    transform: translateY(-1px);
}

/* Modern Headers with New Background */
.modern-header {
    border: none;
    padding: 1.25rem 1.5rem;
    position: relative;
    overflow: hidden;
}

.gradient-custom {
    background: linear-gradient(135deg, rgba(74, 144, 226, 0.95), rgba(53, 122, 189, 1));
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
    color: #000000;
    font-size: 1rem;
    font-weight: 700;
    margin: 0;
}

.title-icon {
    width: 2rem;
    height: 2rem;
    background: rgba(255, 255, 255, 0.3);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    color: #000000;
}

.title-badge {
    background: rgba(255, 255, 255, 0.4);
    color: #000000;
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
    background: rgba(255, 255, 255, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.4);
    color: #000000;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
    font-size: 1rem;
}

.nav-btn:hover {
    background: rgba(255, 255, 255, 0.5);
    transform: scale(1.05);
    color: #000000;
}

.nav-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

/* COMPLETELY FIXED: Job Cards Layout */
.modern-jobs-swiper {
    padding-bottom: 1.5rem;
    overflow: visible;
}

.swiper-slide {
    display: flex;
    align-items: stretch;
    height: auto;
}

.modern-jobs-swiper .swiper-slide {
    height: 180px; /* Match card height */
}

.blue-job-card {
    background: linear-gradient(135deg, #b8d4f0 0%, #6ca7d9 100%);
    border: 2px solid #4a90c2;
    border-radius: 16px;
    color: #000000;
    box-shadow: 0 4px 12px rgba(74, 144, 194, 0.2);
    transition: var(--transition);
    width: 100%;
    height: 190px; /* Fixed height for consistency */
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
    padding: 0; /* Remove padding, add to sections instead */
}

.blue-job-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(74, 144, 194, 0.3);
    background: linear-gradient(135deg, #a8c4e0 0%, #5c97c9 100%);
}

/* Job Title Section */
.job-title-section {
    padding: 1rem 1rem 0.5rem 1rem;
    flex-shrink: 0;
}

.job-title {
    font-size: 0.875rem;
    font-weight: 700;
    color: #000000;
    margin: 0;
    line-height: 1.3;
    text-decoration: underline;
    text-underline-offset: 3px;
    text-decoration-thickness: 1px;
    word-wrap: break-word;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Job Details Section */
.job-details-section {
    padding: 0 1rem;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    gap: 0.4rem;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.75rem;
    line-height: 1.2;
}

.detail-label {
    font-weight: 700;
    color: #000000;
    white-space: nowrap;
    flex-shrink: 0;
}

.detail-value {
    font-weight: 600;
    color: #000000;
    text-align: right;
    margin-left: 0.5rem;
}

/* Action Button Section - Always Bottom Right */
.job-action-section {
    padding: 0.5rem 1rem 1rem 1rem;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    flex-shrink: 0;
    margin-top: auto; /* Push to bottom */
}

.more-btn {
    background: rgba(255, 255, 255, 0.9);
    border: 2px solid rgba(0, 0, 0, 0.2);
    color: #000000;
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.8rem;
    text-decoration: none;
    transition: var(--transition);
    text-align: center;
    white-space: nowrap;
    display: inline-block;
    min-width: 60px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.more-btn:hover {
    background: rgba(255, 255, 255, 1);
    border-color: rgba(0, 0, 0, 0.4);
    color: #000000;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
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
    background: var(--header-accent);
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
    border-color: var(--header-accent);
}

.announcement-content {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.announcement-logo {
    width: 80px; /* Increased width for logo */
    height: 80px;
    border-radius: var(--radius-lg);
    overflow: hidden;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-img {
    width: 100%;
    height: 100%;
    object-fit: contain; /* Prevents logo from being cut */
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

/* Mobile Responsive Adjustments */
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
        height: 160px;
    }

    .modern-jobs-swiper .swiper-slide {
        height: 160px;
    }

    .job-title-section {
        padding: 0.875rem 0.875rem 0.5rem 0.875rem;
    }

    .job-title {
        font-size: 0.8125rem;
        -webkit-line-clamp: 2;
    }

    .job-details-section {
        padding: 0 0.875rem;
        gap: 0.35rem;
    }

    .detail-item {
        font-size: 0.7rem;
    }

    .job-action-section {
        padding: 0.5rem 0.875rem 0.875rem 0.875rem;
    }

    .more-btn {
        padding: 0.35rem 0.875rem;
        font-size: 0.75rem;
        min-width: 55px;
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
    }

    .modern-jobs-swiper .swiper-slide {
        height: 140px;
    }

    .job-title-section {
        padding: 0.75rem 0.75rem 0.4rem 0.75rem;
    }

    .job-title {
        font-size: 0.75rem;
        -webkit-line-clamp: 2;
    }

    .job-details-section {
        padding: 0 0.75rem;
        gap: 0.3rem;
    }

    .detail-item {
        font-size: 0.65rem;
    }

    .job-action-section {
        padding: 0.4rem 0.75rem 0.75rem 0.75rem;
    }

    .more-btn {
        padding: 0.3rem 0.75rem;
        font-size: 0.7rem;
        min-width: 50px;
    }
}

/* Focus States for Accessibility */
.modern-select:focus,
.btn-modern-primary:focus,
.btn-modern-subtle:focus,
.more-btn:focus {
    outline: 2px solid var(--header-accent);
    outline-offset: 2px;
}

.breadcrumb-link:focus {
    outline: 2px solid var(--header-accent);
    outline-offset: 2px;
}

/* Reset any conflicting styles from previous definitions */
.job-content,
.job-header,
.job-details,
.job-action,
.detail-row {
    all: unset;
    display: initial;
}
</style>

<!-- Add Swiper.js JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Modern Jobs Swiper - Fixed configuration for proper display
    const modernJobsSwiper = new Swiper('.modern-jobs-swiper', {
        slidesPerView: 1,
        spaceBetween: 16,
        centeredSlides: false,
        loop: false,
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
            320: {
                slidesPerView: 1,
                spaceBetween: 12,
            },
            480: {
                slidesPerView: 1.2,
                spaceBetween: 16,
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2.5,
                spaceBetween: 24,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 28,
            },
            1200: {
                slidesPerView: 3.5,
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
            prevBtn.disabled = swiper.isBeginning;
            nextBtn.disabled = swiper.isEnd;
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
