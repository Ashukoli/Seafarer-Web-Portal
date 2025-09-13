@extends('layouts.app')
@section('content')
<!-- Add Swiper.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<main class="page-content professional-bg">
    <!--Enhanced Breadcrumb-->
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
                        <i class="bx bx-search-alt me-1"></i>Search Jobs
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <!-- Compact Search Filter Card -->
    <div class="card mb-4 professional-card">
        <div class="card-body p-3">
            <form class="row g-3 align-items-end">
                <div class="col-md-4 col-12">
                    <label for="rank" class="form-label search-label">
                        <i class="bx bx-medal me-1"></i>Select Rank
                    </label>
                    <select class="form-select professional-select" id="rank" name="rank">
                        <option selected disabled>Choose your rank...</option>
                        <option value="fresher">Fresher</option>
                        <option value="dpo">DPO</option>
                        <option value="sr.dpo">Sr. DPO</option>
                        <option value="deck-cadet">Deck Cadet</option>
                        <option value="engine-cadet">Engine Cadet</option>
                        <option value="third-officer">Third Officer</option>
                        <option value="second-officer">Second Officer</option>
                        <option value="chief-officer">Chief Officer</option>
                        <option value="master">Master</option>
                    </select>
                </div>
                <div class="col-md-3 col-12">
                    <label for="vessel-type" class="form-label search-label">
                        <i class="bx bx-anchor me-1"></i>Vessel Type
                    </label>
                    <select class="form-select professional-select" id="vessel-type" name="vessel_type">
                        <option value="">All Types</option>
                        <option value="bulk-carrier">Bulk Carrier</option>
                        <option value="oil-tanker">Oil Tanker</option>
                        <option value="container">Container</option>
                        <option value="tug-boat">Tug Boat</option>
                    </select>
                </div>
                <div class="col-md-2 col-12">
                    <button type="submit" class="btn btn-primary search-btn w-100">
                        <i class="bx bx-search me-1"></i>Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Hot Jobs Section with Professional Slider -->
    <div class="card mb-4 professional-card">
        <div class="card-header professional-header jobs-header">
            <h5 class="mb-0 header-title">
                <i class="bx bx-hot me-2"></i>Hot Jobs
            </h5>
            <div class="header-stats">               
                <div class="slider-controls">
                    <button class="slider-nav prev-btn" id="jobsPrev">
                        <i class="bx bx-chevron-left"></i>
                    </button>
                    <button class="slider-nav next-btn" id="jobsNext">
                        <i class="bx bx-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body p-3">
            <!-- Swiper Slider Container -->
            <div class="swiper hot-jobs-swiper">
                <div class="swiper-wrapper">
                    <!-- Job Slide 1 -->
                    <div class="swiper-slide">
                        <div class="job-item hot-job slider-job">
                            <div class="job-header">
                                <div class="job-number">
                                    <span class="number-badge">1</span>
                                </div>
                                <div class="job-status">
                                    <div class="status-badge active">
                                        <i class="bx bx-check-circle me-1"></i>Active
                                    </div>
                                </div>
                            </div>
                            
                            <div class="job-content">
                                <h6 class="company-name">
                                    <i class="bx bx-buildings me-2"></i>Tangar Ship Management Pvt. Ltd
                                </h6>
                                
                                <div class="job-details">
                                    <div class="detail-row">
                                        <i class="bx bx-briefcase me-2"></i>
                                        <span><strong>Position:</strong> Master for Bulk Carrier</span>
                                    </div>
                                    <div class="detail-row">
                                        <i class="bx bx-calendar me-2"></i>
                                        <span><strong>Joining:</strong> Aug 29, 2025</span>
                                    </div>
                                    <div class="detail-row">
                                        <i class="bx bx-time me-2"></i>
                                        <span><strong>Experience:</strong> 6 Months min.</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="job-action">
                                <a href="{{ route('candidate.hot-job.details') }}" class="btn btn-primary btn-apply">
                                    <i class="bx bx-paper-plane me-2"></i>Apply Now
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Job Slide 2 -->
                    <div class="swiper-slide">
                        <div class="job-item hot-job slider-job">
                            <div class="job-header">
                                <div class="job-number">
                                    <span class="number-badge">2</span>
                                </div>
                                <div class="job-status">
                                    <div class="status-badge active">
                                        <i class="bx bx-check-circle me-1"></i>Active
                                    </div>
                                </div>
                            </div>
                            
                            <div class="job-content">
                                <h6 class="company-name">
                                    <i class="bx bx-buildings me-2"></i>VR Maritime Services Pvt. Ltd
                                </h6>
                                
                                <div class="job-details">
                                    <div class="detail-row">
                                        <i class="bx bx-briefcase me-2"></i>
                                        <span><strong>Position:</strong> Master for Container</span>
                                    </div>
                                    <div class="detail-row">
                                        <i class="bx bx-calendar me-2"></i>
                                        <span><strong>Joining:</strong> Aug 28, 2025</span>
                                    </div>
                                    <div class="detail-row">
                                        <i class="bx bx-time me-2"></i>
                                        <span><strong>Experience:</strong> 6 Months min.</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="job-action">
                                <a href="{{ route('candidate.hot-job.details') }}" class="btn btn-primary btn-apply">
                                    <i class="bx bx-paper-plane me-2"></i>Apply Now
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Job Slide 3 -->
                    <div class="swiper-slide">
                        <div class="job-item hot-job slider-job">
                            <div class="job-header">
                                <div class="job-number">
                                    <span class="number-badge">3</span>
                                </div>
                                <div class="job-status">
                                    <div class="status-badge active">
                                        <i class="bx bx-check-circle me-1"></i>Active
                                    </div>
                                </div>
                            </div>
                            
                            <div class="job-content">
                                <h6 class="company-name">
                                    <i class="bx bx-buildings me-2"></i>Blue Ocean Shipping Ltd.
                                </h6>
                                
                                <div class="job-details">
                                    <div class="detail-row">
                                        <i class="bx bx-briefcase me-2"></i>
                                        <span><strong>Position:</strong> Chief Engineer</span>
                                    </div>
                                    <div class="detail-row">
                                        <i class="bx bx-calendar me-2"></i>
                                        <span><strong>Joining:</strong> Sep 15, 2025</span>
                                    </div>
                                    <div class="detail-row">
                                        <i class="bx bx-time me-2"></i>
                                        <span><strong>Experience:</strong> 1 Year min.</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="job-action">
                                <a href="{{ route('candidate.hot-job.details') }}" class="btn btn-primary btn-apply">
                                    <i class="bx bx-paper-plane me-2"></i>Apply Now
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Job Slide 4 -->
                    <div class="swiper-slide">
                        <div class="job-item hot-job slider-job">
                            <div class="job-header">
                                <div class="job-number">
                                    <span class="number-badge">4</span>
                                </div>
                                <div class="job-status">
                                    <div class="status-badge active">
                                        <i class="bx bx-check-circle me-1"></i>Active
                                    </div>
                                </div>
                            </div>
                            
                            <div class="job-content">
                                <h6 class="company-name">
                                    <i class="bx bx-buildings me-2"></i>Maritime Experts Co.
                                </h6>
                                
                                <div class="job-details">
                                    <div class="detail-row">
                                        <i class="bx bx-briefcase me-2"></i>
                                        <span><strong>Position:</strong> Second Engineer</span>
                                    </div>
                                    <div class="detail-row">
                                        <i class="bx bx-calendar me-2"></i>
                                        <span><strong>Joining:</strong> Oct 1, 2025</span>
                                    </div>
                                    <div class="detail-row">
                                        <i class="bx bx-time me-2"></i>
                                        <span><strong>Experience:</strong> 6 Months min.</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="job-action">
                                <a href="{{ route('candidate.hot-job.details') }}" class="btn btn-primary btn-apply">
                                    <i class="bx bx-paper-plane me-2"></i>Apply Now
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Job Slide 5 -->
                    <div class="swiper-slide">
                        <div class="job-item hot-job slider-job">
                            <div class="job-header">
                                <div class="job-number">
                                    <span class="number-badge">5</span>
                                </div>
                                <div class="job-status">
                                    <div class="status-badge active">
                                        <i class="bx bx-check-circle me-1"></i>Active
                                    </div>
                                </div>
                            </div>
                            
                            <div class="job-content">
                                <h6 class="company-name">
                                    <i class="bx bx-buildings me-2"></i>Global Marine Corp.
                                </h6>
                                
                                <div class="job-details">
                                    <div class="detail-row">
                                        <i class="bx bx-briefcase me-2"></i>
                                        <span><strong>Position:</strong> Third Officer</span>
                                    </div>
                                    <div class="detail-row">
                                        <i class="bx bx-calendar me-2"></i>
                                        <span><strong>Joining:</strong> Oct 15, 2025</span>
                                    </div>
                                    <div class="detail-row">
                                        <i class="bx bx-time me-2"></i>
                                        <span><strong>Experience:</strong> 3 Months min.</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="job-action">
                                <a href="{{ route('candidate.hot-job.details') }}" class="btn btn-primary btn-apply">
                                    <i class="bx bx-paper-plane me-2"></i>Apply Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pagination dots -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <!-- Advertisements Section -->
    <div class="card mb-4 professional-card">
        <div class="card-header professional-header ads-header">
            <h5 class="mb-0 header-title">
                <i class="bx bx-bullhorn me-2"></i>Advertisements
            </h5>
            <div class="header-stats">
                <span class="stats-badge">
                    <i class="bx bx-calendar me-1"></i>2 Recent
                </span>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="row g-3">
                <!-- Advertisement Card 1 -->
                <div class="col-12">
                    <div class="ad-item">
                        <div class="d-flex align-items-center">
                            <div class="ad-logo me-3">
                                <img src="{{ asset('theme/assets/images/products/28.png') }}" alt="Company Logo" class="rounded">
                            </div>
                            <div class="ad-info flex-grow-1">
                                <h6 class="ad-title mb-1">
                                    <i class="bx bx-building me-1 text-muted"></i>Oceanic Shipping Ltd.
                                </h6>
                                <div class="ad-meta">
                                    <span class="posted-date">
                                        <i class="bx bx-calendar me-1"></i>Posted: July 30, 2025
                                    </span>
                                    <span class="ad-type ms-3">
                                        <i class="bx bx-bullhorn me-1"></i>Advertisement
                                    </span>
                                </div>
                            </div>
                            <div class="ad-actions ms-3">
                                <a href="{{ route('candidate.advertisement.details') }}" class="btn btn-outline-info btn-sm">
                                    <i class="bx bx-show me-1"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Advertisement Card 2 -->
                <div class="col-12">
                    <div class="ad-item">
                        <div class="d-flex align-items-center">
                            <div class="ad-logo me-3">
                                <img src="{{ asset('theme/assets/images/products/100.jpg') }}" alt="Company Logo" class="rounded">
                            </div>
                            <div class="ad-info flex-grow-1">
                                <h6 class="ad-title mb-1">
                                    <i class="bx bx-building me-1 text-muted"></i>Marine Careers
                                </h6>
                                <div class="ad-meta">
                                    <span class="posted-date">
                                        <i class="bx bx-calendar me-1"></i>Posted: July 28, 2025
                                    </span>
                                    <span class="ad-type ms-3">
                                        <i class="bx bx-bullhorn me-1"></i>Advertisement
                                    </span>
                                </div>
                            </div>
                            <div class="ad-actions ms-3">
                                <a href="{{ route('candidate.advertisement.details') }}" class="btn btn-outline-info btn-sm">
                                    <i class="bx bx-show me-1"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
/* Professional Balanced Background */
.professional-bg {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    min-height: 100vh;
}

/* Toned Down Breadcrumb Styling */
.enhanced-breadcrumb {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    padding: 12px 20px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
}

.breadcrumb-link {
    color: #475569; /* Muted blue-gray instead of bright blue */
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.breadcrumb-link:hover {
    color: #334155; /* Darker on hover */
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

/* Muted Professional Card Styling */
.professional-card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
    overflow: hidden;
}

/* Compact Search Form */
.search-label {
    color: #374151;
    font-size: 0.9rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    margin-bottom: 6px;
}

.professional-select {
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background: #ffffff;
}

.professional-select:focus {
    border-color: #6366f1; /* Muted indigo instead of bright blue */
    box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1);
    outline: none;
}

.search-btn {
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #6366f1, #4f46e5); /* Muted indigo gradient */
    border: none;
    color: white;
}

.search-btn:hover {
    transform: translateY(-1px);
    background: linear-gradient(135deg, #4f46e5, #4338ca);
    box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
}

/* Muted Professional Headers */
.professional-header {
    padding: 16px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border: none;
}

.jobs-header {
    background: linear-gradient(135deg, #64748b 0%, #475569 100%); /* Muted slate instead of bright blue */
}

.ads-header {
    background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%); /* Consistent muted tones */
}

.header-title {
    color: #ffffff;
    font-size: 1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    margin: 0;
}

.stats-badge {
    background: rgba(255, 255, 255, 0.15); /* More subtle */
    color: #ffffff;
    padding: 4px 10px;
    border-radius: 16px;
    font-size: 0.8rem;
    font-weight: 500;
    display: flex;
    align-items: center;
}

/* Minimal Hot Jobs Slider Styles */
.hot-jobs-swiper {
    width: 100%;
    height: auto;
    padding-bottom: 30px;
    margin: 0;
}

.hot-jobs-swiper .swiper-wrapper {
    align-items: stretch;
}

.hot-jobs-swiper .swiper-slide {
    height: auto;
    display: flex;
    padding: 0;
    margin: 0;
}

/* Balanced Slider Navigation Controls */
.slider-controls {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-left: 16px;
}

.slider-nav {
    width: 32px;
    height: 32px;
    border: none;
    background: rgba(255, 255, 255, 0.15); /* More subtle */
    color: #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1.1rem;
}

.slider-nav:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: scale(1.05); /* Reduced scale */
}

.slider-nav:disabled {
    opacity: 0.4;
    cursor: not-allowed;
    transform: none;
}

/* Muted Job Slider Cards */
.slider-job {
    height: 100%;
    display: flex;
    flex-direction: column;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 14px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    margin: 0;
    width: 100%;
}

.slider-job::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(135deg, #64748b, #475569); /* Muted accent */
    opacity: 0;
    transition: opacity 0.3s ease;
}

.slider-job:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border-color: #cbd5e1;
}

.slider-job:hover::before {
    opacity: 1;
}

/* Balanced card content */
.job-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.job-header .number-badge {
    width: 24px;
    height: 24px;
    background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
    color: #64748b;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.75rem;
    border: 1px solid #e2e8f0;
}

.job-content {
    flex-grow: 1;
    margin-bottom: 12px;
}

.slider-job .company-name {
    color: #374151;
    font-weight: 700;
    font-size: 0.9rem;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    line-height: 1.2;
}

.job-details {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.detail-row {
    display: flex;
    align-items: center;
    color: #6b7280;
    font-size: 0.75rem;
    line-height: 1.3;
}

.detail-row i {
    color: #9ca3af;
    font-size: 0.85rem;
    min-width: 16px;
    margin-right: 6px;
}

.detail-row strong {
    color: #374151;
    font-weight: 600;
}

.job-action {
    margin-top: auto;
}

/* Outline Style Apply Buttons */
.btn-apply {
    width: 100%;
    padding: 8px 12px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.8rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid; /* Add border for outline style */
    background: transparent; /* Remove background */
}

.btn-apply.btn-primary {
    color: #6366f1; /* Text color matches the border - muted indigo */
    border-color: #6366f1; /* Muted indigo border */
    background: transparent; /* Transparent background */
}

.btn-apply.btn-primary:hover {
    background: #6366f1; /* Fill background on hover */
    color: #ffffff; /* White text on hover */
    border-color: #6366f1;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(99, 102, 241, 0.25);
}

.btn-apply.btn-primary:active {
    transform: translateY(0);
    box-shadow: 0 1px 4px rgba(99, 102, 241, 0.3);
}

.btn-apply.btn-secondary {
    background: transparent;
    border: 2px solid #e2e8f0;
    color: #64748b;
    cursor: not-allowed;
}

.btn-apply.btn-secondary:hover {
    background: #f8fafc; /* Very subtle background on hover for disabled state */
}

/* Optional: Add a subtle focus ring for accessibility */
.btn-apply:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

/* Muted Status Badges */
.slider-job .status-badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.slider-job .status-badge.active {
    background: linear-gradient(135deg, #ecfdf5, #d1fae5); /* Softer green */
    color: #166534;
    border: 1px solid #86efac;
}

.slider-job .status-badge.expired {
    background: linear-gradient(135deg, #fef2f2, #fee2e2);
    color: #dc2626;
    border: 1px solid #f87171;
}

/* Subtle pagination */
.hot-jobs-swiper .swiper-pagination {
    bottom: 0;
    margin-top: 5px;
}

.hot-jobs-swiper .swiper-pagination-bullet {
    width: 5px;
    height: 5px;
    background: #cbd5e1;
    opacity: 1;
    margin: 0 2px;
}

.hot-jobs-swiper .swiper-pagination-bullet-active {
    background: #6366f1; /* Muted indigo */
    transform: scale(1.4);
}

/* Reduced container padding */
.card-body {
    padding: 12px !important;
}

/* Advertisement styling with muted colors */
.ad-logo img {
    width: 50px;
    height: 50px;
    object-fit: contain;
    border: 1px solid #e5e7eb;
    padding: 4px;
    background: #fafafa;
    border-radius: 6px;
}

.ad-title {
    color: #374151;
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
}

.ad-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}

.posted-date, .ad-type {
    color: #6b7280;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    font-weight: 500;
}

.posted-date i, .ad-type i {
    color: #9ca3af;
    font-size: 0.85rem;
}

/* Advertisement Items */
.ad-item {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
}

.ad-item:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
    border-color: #cbd5e1;
}

/* Muted Button Styling */
.btn-sm {
    padding: 6px 12px;
    font-size: 0.8rem;
    font-weight: 500;
    border-radius: 6px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    white-space: nowrap;
}

.btn-sm:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.btn-outline-primary.btn-sm {
    color: #6366f1; /* Muted indigo */
    border-color: #6366f1;
}

.btn-outline-primary.btn-sm:hover {
    background: #6366f1;
    color: #ffffff;
}

.btn-outline-info.btn-sm {
    color: #0891b2; /* Muted cyan */
    border-color: #0891b2;
}

.btn-outline-info.btn-sm:hover {
    background: #0891b2;
    color: #ffffff;
}

.btn-outline-secondary.btn-sm {
    color: #6b7280;
    border-color: #6b7280;
    cursor: not-allowed;
}

/* Mobile responsive adjustments */
@media (max-width: 768px) {
    .professional-bg {
        background: #f8fafc;
    }
    
    .slider-controls {
        display: none;
    }
    
    .slider-job {
        padding: 10px;
        border-radius: 8px;
    }
    
    .job-header {
        margin-bottom: 8px;
    }
    
    .job-content {
        margin-bottom: 10px;
    }
    
    .slider-job .company-name {
        font-size: 0.85rem;
        margin-bottom: 8px;
    }
    
    .detail-row {
        font-size: 0.7rem;
    }
    
    .job-details {
        gap: 4px;
    }
    
    .btn-apply {
        padding: 6px 10px;
        font-size: 0.75rem;
        border: 1.5px solid; /* Slightly thinner border on mobile */
    }
    
    .btn-apply.btn-primary:hover {
        background: #6366f1;
        color: #ffffff;
    }
}

@media (max-width: 576px) {
    .hot-jobs-swiper .swiper-slide {
        padding: 0 1px;
    }
    
    .slider-job {
        margin: 0;
        padding: 8px;
    }
    
    .btn-apply {
        border: 1.5px solid;
    }
}

/* Focus states for accessibility */
.professional-select:focus,
.search-btn:focus,
.btn-sm:focus {
    outline: 2px solid #6366f1;
    outline-offset: 2px;
}

.breadcrumb-link:focus {
    outline: 2px solid #475569;
    outline-offset: 2px;
    border-radius: 4px;
}
</style>

<!-- Add Swiper.js JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Hot Jobs Swiper Slider with Auto-Scroll and Minimal Spacing
    const hotJobsSwiper = new Swiper('.hot-jobs-swiper', {
        // Slider Settings
        slidesPerView: 1.2,
        spaceBetween: 8, // Minimal spacing
        centeredSlides: false,
        loop: true, // Enable infinite loop for continuous scrolling
        grabCursor: true,
        
        // Auto-Scroll Configuration
        autoplay: {
            delay: 3000, // 3 seconds delay between slides
            disableOnInteraction: false, // Continue autoplay after user interactions
            pauseOnMouseEnter: true, // Pause when hovering over the slider
        },
        
        // Pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        
        // Navigation
        navigation: {
            nextEl: '#jobsNext',
            prevEl: '#jobsPrev',
        },
        
        // Responsive breakpoints with minimal spacing
        breakpoints: {
            // When window width is >= 576px
            576: {
                slidesPerView: 1.8,
                spaceBetween: 8,
            },
            // When window width is >= 768px
            768: {
                slidesPerView: 2.2,
                spaceBetween: 10,
            },
            // When window width is >= 992px
            992: {
                slidesPerView: 2.8,
                spaceBetween: 12,
            },
            // When window width is >= 1200px
            1200: {
                slidesPerView: 3.2,
                spaceBetween: 14,
            }
        },
        
        // Auto height
        autoHeight: false,
        
        // Events
        on: {
            init: function () {
                updateNavigationButtons(this);
            },
            slideChange: function () {
                updateNavigationButtons(this);
            },
        }
    });
    
    // Update navigation button states
    function updateNavigationButtons(swiper) {
        const prevBtn = document.getElementById('jobsPrev');
        const nextBtn = document.getElementById('jobsNext');
        
        if (prevBtn && nextBtn) {
            // For infinite loop, buttons should always be enabled
            prevBtn.disabled = false;
            nextBtn.disabled = false;
        }
    }
    
    // Pause autoplay on hover for better UX
    const swiperContainer = document.querySelector('.hot-jobs-swiper');
    if (swiperContainer) {
        swiperContainer.addEventListener('mouseenter', function() {
            hotJobsSwiper.autoplay.stop();
        });
        
        swiperContainer.addEventListener('mouseleave', function() {
            hotJobsSwiper.autoplay.start();
        });
    }
    
    // Add touch/swipe feedback
    const sliderJobs = document.querySelectorAll('.slider-job');
    sliderJobs.forEach(job => {
        job.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.98)';
        });
        
        job.addEventListener('touchend', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Search form handling
    const searchForm = document.querySelector('form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const rank = formData.get('rank');
            const vesselType = formData.get('vessel_type');
            
            console.log('Search parameters:', { rank, vesselType });
            
            // Add your search logic here
            // For example: window.location.href = `/search?rank=${rank}&vessel_type=${vesselType}`;
        });
    }
});
</script>
@endsection
