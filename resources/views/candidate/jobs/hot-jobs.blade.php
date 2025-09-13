@extends('layouts.app')
@section('content')
<main class="page-content professional-bg">
    <!--breadcrumb-->
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
                        <i class="bx bx-hot me-1"></i>Hot Jobs
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <!-- Search Filter Card -->
    <div class="card mb-4 professional-card">
        <div class="card-body p-4">
            <form class="row g-3 align-items-end">
                <div class="col-md-4 col-12">
                    <label for="rank" class="form-label fw-semibold search-label">
                        <i class="bx bx-search-alt-2 me-2"></i>Select Rank
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
                <div class="col-md-2 col-12">
                    <button type="submit" class="btn btn-primary search-btn w-100">
                        <i class="bx bx-search-alt me-1"></i> Search Jobs
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Hot Jobs Section -->
    <div class="card mb-4 professional-card">
        <div class="card-header professional-header jobs-header">
            <h5 class="mb-0 header-title">
                <i class="bx bx-hot me-2"></i>Hot Jobs Available
            </h5>
            <div class="header-stats">
                <span class="stats-badge">
                    <i class="bx bx-briefcase me-1"></i>3 Active Jobs
                </span>
            </div>
        </div>
        <div class="card-body p-4">
            <!-- Combined Responsive Job Cards -->
            <div class="row g-3">
                <!-- Job Card 1 -->
                <div class="col-12">
                    <div class="job-card hot-job">
                        <div class="d-flex align-items-start">
                            <div class="job-logo me-3">
                                <img src="{{ asset('theme/assets/images/products/download.png') }}" alt="Company Logo" class="rounded">
                                <div class="urgent-badge">
                                    <i class="bx bx-time-five"></i>
                                </div>
                            </div>
                            <div class="job-info flex-grow-1">
                                <h6 class="job-title mb-2">
                                    <i class="bx bx-buildings me-1 text-muted"></i>MAS SHIP MANAGEMENT PRIVATE LIMITED
                                </h6>
                                <div class="job-description-section mb-3">
                                    <strong class="desc-label">Job Description:</strong>
                                    <p class="job-description">
                                        Urgent Requirement of 2nd Officer for Oil Tanker, COC: Only National COCs are acceptable, Prior experience on the same type of vessels is essential, Promotional candidates are also eligible to apply. Salary as per Market Standard.
                                    </p>
                                </div>
                                <div class="job-meta">
                                    <span class="urgency-tag">
                                        <i class="bx bx-error-circle me-1"></i>Urgent
                                    </span>
                                    <span class="rank-tag ms-3">
                                        <i class="bx bx-user me-1"></i>2nd Officer
                                    </span>
                                    <span class="job-type ms-3">
                                        <i class="bx bx-anchor me-1"></i>Oil Tanker
                                    </span>
                                    <span class="posted-date ms-3">
                                        <i class="bx bx-calendar me-1"></i>Posted: July 30, 2025
                                    </span>
                                </div>
                            </div>
                            <div class="job-actions ms-3">
                                <a href="{{ route('candidate.hot-job.details') }}" class="btn btn-outline-primary btn-view">
                                    <i class="bx bx-show me-1"></i>
                                    <span class="d-none d-sm-inline">View Details</span>
                                    <span class="d-sm-none">View</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Job Card 2 -->
                <div class="col-12">
                    <div class="job-card hot-job">
                        <div class="d-flex align-items-start">
                            <div class="job-logo me-3">
                                <img src="{{ asset('theme/assets/images/products/download.png') }}" alt="Company Logo" class="rounded">
                                <div class="urgent-badge">
                                    <i class="bx bx-time-five"></i>
                                </div>
                            </div>
                            <div class="job-info flex-grow-1">
                                <h6 class="job-title mb-2">
                                    <i class="bx bx-buildings me-1 text-muted"></i>OCEANIC CREW MANAGEMENT
                                </h6>
                                <div class="job-description-section mb-3">
                                    <strong class="desc-label">Job Description:</strong>
                                    <p class="job-description">
                                        Urgent Requirement of Chief Engineer for Container Vessel, Valid COC and STCW certificates mandatory, Minimum 2 years experience as 2nd Engineer on similar vessels required, Competitive salary package offered. Joining ASAP.
                                    </p>
                                </div>
                                <div class="job-meta">
                                    <span class="urgency-tag">
                                        <i class="bx bx-error-circle me-1"></i>Urgent
                                    </span>
                                    <span class="rank-tag ms-3">
                                        <i class="bx bx-user me-1"></i>Chief Engineer
                                    </span>
                                    <span class="job-type ms-3">
                                        <i class="bx bx-anchor me-1"></i>Container
                                    </span>
                                    <span class="posted-date ms-3">
                                        <i class="bx bx-calendar me-1"></i>Posted: July 28, 2025
                                    </span>
                                </div>
                            </div>
                            <div class="job-actions ms-3">
                                <a href="{{ route('candidate.hot-job.details') }}" class="btn btn-outline-primary btn-view">
                                    <i class="bx bx-show me-1"></i>
                                    <span class="d-none d-sm-inline">View Details</span>
                                    <span class="d-sm-none">View</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Job Card 3 -->
                <div class="col-12">
                    <div class="job-card hot-job">
                        <div class="d-flex align-items-start">
                            <div class="job-logo me-3">
                                <img src="{{ asset('theme/assets/images/products/download.png') }}" alt="Company Logo" class="rounded">
                                <div class="urgent-badge">
                                    <i class="bx bx-time-five"></i>
                                </div>
                            </div>
                            <div class="job-info flex-grow-1">
                                <h6 class="job-title mb-2">
                                    <i class="bx bx-buildings me-1 text-muted"></i>GLOBAL MARITIME SERVICES
                                </h6>
                                <div class="job-description-section mb-3">
                                    <strong class="desc-label">Job Description:</strong>
                                    <p class="job-description">
                                        Urgent Requirement of Master for Bulk Carrier, COC: Only National COCs are acceptable, Prior experience on the same type of vessels is essential, Promotional candidates are also eligible to apply. Salary as per Market Standard, Immediate joining preferred.
                                    </p>
                                </div>
                                <div class="job-meta">
                                    <span class="urgency-tag">
                                        <i class="bx bx-error-circle me-1"></i>Urgent
                                    </span>
                                    <span class="rank-tag ms-3">
                                        <i class="bx bx-user me-1"></i>Master
                                    </span>
                                    <span class="job-type ms-3">
                                        <i class="bx bx-anchor me-1"></i>Bulk Carrier
                                    </span>
                                    <span class="posted-date ms-3">
                                        <i class="bx bx-calendar me-1"></i>Posted: July 26, 2025
                                    </span>
                                </div>
                            </div>
                            <div class="job-actions ms-3">
                                <a href="{{ route('candidate.hot-job.details') }}" class="btn btn-outline-primary btn-view">
                                    <i class="bx bx-show me-1"></i>
                                    <span class="d-none d-sm-inline">View Details</span>
                                    <span class="d-sm-none">View</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    </div>
</main>
@endsection

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
    
    /* Professional Card Styling */
    .professional-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    
    /* Search Form Styling */
    .search-label {
        color: #374151;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }
    
    .professional-select {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 10px 12px;
        transition: all 0.3s ease;
        background: #ffffff;
    }
    
    .professional-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }
    
    .search-btn {
        padding: 10px 16px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .search-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    
    /* Jobs Header */
    .jobs-header {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border: none;
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .header-title {
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        margin: 0;
    }
    
    .header-title i {
        font-size: 1.2rem;
        opacity: 0.9;
    }
    
    .header-stats {
        display: flex;
        align-items: center;
    }
    
    .stats-badge {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: flex;
        align-items: center;
    }
    
    /* Job Card Styling */
    .job-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 24px;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }
    
    .job-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .job-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        border-color: #f59e0b;
    }
    
    .job-card:hover::before {
        opacity: 1;
    }
    
    /* Job Logo Styling */
    .job-logo {
        position: relative;
    }
    
    .job-logo img {
        width: 70px;
        height: 70px;
        object-fit: contain;
        border: 2px solid #f3f4f6;
        padding: 8px;
        background: #fafafa;
        transition: all 0.3s ease;
        border-radius: 8px;
    }
    
    .urgent-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 20px;
        height: 20px;
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #ffffff;
    }
    
    .urgent-badge i {
        color: #ffffff;
        font-size: 0.7rem;
    }
    
    .job-card:hover .job-logo img {
        border-color: #f59e0b;
        transform: scale(1.02);
    }
    
    /* Job Info Styling */
    .job-title {
        color: #374151;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
    }
    
    .job-description-section {
        background: #f9fafb;
        border-left: 4px solid #3b82f6;
        padding: 16px;
        border-radius: 6px;
        margin: 16px 0;
    }
    
    .desc-label {
        color: #1f2937;
        font-size: 0.9rem;
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
    }
    
    .job-description {
        color: #4b5563;
        font-size: 0.9rem;
        line-height: 1.6;
        margin: 0;
    }
    
    .job-meta {
        display: flex;
        align-items: center;
        gap: 0;
        flex-wrap: wrap;
        margin-top: 16px;
    }
    
    .posted-date, .job-type {
        color: #6b7280;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        font-weight: 500;
    }
    
    .posted-date i, .job-type i {
        color: #9ca3af;
        font-size: 0.9rem;
    }
    
    /* Updated Meta Tags Styling */
    .urgency-tag {
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        color: #dc2626;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        border: 1px solid #fecaca;
    }
    
    .urgency-tag i {
        font-size: 0.8rem;
    }
    
    .rank-tag {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        color: #1d4ed8;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        border: 1px solid #bfdbfe;
    }
    
    .rank-tag i {
        font-size: 0.8rem;
    }
    
    .job-type {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        color: #166534;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        border: 1px solid #bbf7d0;
    }
    
    .job-type i {
        font-size: 0.8rem;
    }
    
    /* Button Styling */
    .btn-view {
        padding: 10px 20px;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        white-space: nowrap;
        border-width: 2px;
    }
    
    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
    
    .btn-outline-primary.btn-view {
        color: #3b82f6;
        border-color: #3b82f6;
        background: transparent;
    }
    
    .btn-outline-primary.btn-view:hover {
        background: #3b82f6;
        color: #ffffff;
        border-color: #3b82f6;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .professional-bg {
            background: #f8fafc;
        }
        
        .job-card {
            padding: 20px;
        }
        
        .job-logo img {
            width: 60px;
            height: 60px;
        }
        
        .job-title {
            font-size: 1rem;
        }
        
        .job-description {
            font-size: 0.85rem;
        }
        
        .job-meta {
            gap: 8px;
        }
        
        .posted-date, .job-type, .rank-tag, .urgency-tag {
            font-size: 0.75rem;
            padding: 3px 6px;
        }
        
        .btn-view {
            padding: 8px 16px;
            font-size: 0.8rem;
        }
        
        .breadcrumb-title {
            font-size: 1rem;
        }
        
        .enhanced-breadcrumb {
            padding: 12px 16px;
        }
        
        .jobs-header {
            padding: 16px 20px;
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }
        
        .header-title {
            font-size: 1rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .job-card .d-flex {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .job-actions {
            margin-left: 0 !important;
            margin-top: 15px;
            width: 100%;
        }
        
        .btn-view {
            width: 100%;
            justify-content: center;
        }
        
        .job-info {
            margin-top: 15px;
            width: 100%;
        }
        
        .job-meta {
            justify-content: flex-start;
            gap: 6px;
        }
        
        .job-description-section {
            margin: 12px 0;
            padding: 12px;
        }
        
        .posted-date, .job-type, .rank-tag, .urgency-tag {
            font-size: 0.7rem;
            padding: 2px 5px;
        }
    }
    
    /* Subtle Animation for cards */
    @keyframes subtleFadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .job-card {
        animation: subtleFadeIn 0.5s ease-out;
    }
    
    .job-card:nth-child(2) {
        animation-delay: 0.1s;
    }
    
    .job-card:nth-child(3) {
        animation-delay: 0.2s;
    }
    
    /* Focus states for accessibility */
    .job-card:focus {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
    }
    
    .breadcrumb-link:focus {
        outline: 2px solid #4f46e5;
        outline-offset: 2px;
        border-radius: 4px;
    }
    
    .professional-select:focus {
        outline: none;
    }
</style>
