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
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bx bx-home-alt me-1"></i>Dashboard
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container-fluid">
        <!-- Welcome Section -->
        <div class="welcome-section mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="welcome-content">
                        <h4 class="welcome-title">
                            <i class="bx bx-sun me-2 text-warning"></i>
                            Good Morning, <span class="user-name">John Anderson</span>
                        </h4>
                        <p class="welcome-subtitle">Ready to find your next maritime opportunity? Here's your career overview.</p>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <div class="quick-actions">
                        {{-- <a href="{{ route('candidate.jobs.search') }}" class="btn btn-primary btn-action me-2">
                            <i class="bx bx-search-alt me-1"></i>Search Jobs
                        </a>
                        <a href="{{ route('candidate.password.change') }}" class="btn btn-outline-secondary btn-action">
                            <i class="bx bx-edit me-1"></i>Update Profile
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Updated KPI Cards Row -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card kpi-card hot-jobs-card">
                    <div class="card-body">
                        <div class="kpi-content">
                            <div class="kpi-icon">
                                <i class="bx bx-hot"></i>
                            </div>
                            <div class="kpi-info">
                                <div class="kpi-number">12</div>
                                <div class="kpi-label">Hot Jobs for Master</div>
                                <div class="kpi-trend positive">
                                    <i class="bx bx-trending-up me-1"></i>+3 this week
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card kpi-card views-card">
                    <div class="card-body">
                        <div class="kpi-content">
                            <div class="kpi-icon">
                                <i class="bx bx-show"></i>
                            </div>
                            <div class="kpi-info">
                                <div class="kpi-number">156</div>
                                <div class="kpi-label">Profile Views</div>
                                <div class="kpi-trend positive">
                                    <i class="bx bx-trending-up me-1"></i>+8% this week
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card kpi-card applied-card">
                    <div class="card-body">
                        <div class="kpi-content">
                            <div class="kpi-icon">
                                <i class="bx bx-briefcase"></i>
                            </div>
                            <div class="kpi-info">
                                <div class="kpi-number">24</div>
                                <div class="kpi-label">Companies Applied</div>
                                <div class="kpi-trend positive">
                                    <i class="bx bx-trending-up me-1"></i>+5 this month
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card kpi-card completion-card">
                    <div class="card-body">
                        <div class="kpi-content">
                            <div class="kpi-icon">
                                <i class="bx bx-user-check"></i>
                            </div>
                            <div class="kpi-info">
                                <div class="kpi-number">85%</div>
                                <div class="kpi-label">Profile Completion</div>
                                <div class="kpi-trend warning">
                                    <i class="bx bx-info-circle me-1"></i>Complete remaining 15%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-xl-8">


                <!-- Express Service Compact Section -->
                <div class="card professional-card mb-4">
                    <div class="card-header professional-header express-header">
                        <h5 class="mb-0 header-title">
                            <i class="bx bx-rocket me-2"></i>Seafarer Express Service
                        </h5>
                        <span class="badge badge-light">Premium Services</span>
                    </div>
                    <div class="card-body p-4">
                        <!-- Service Icons Row -->
                        <div class="row text-center mb-4">
                            <div class="col-md-6">
                                <div class="express-service-item">
                                    <img src="{{ asset('theme/assets/images/products/moneybackguarantee.png') }}" alt="60 Days Money Back" class="express-icon mb-2">
                                    <div class="fw-bold text-danger">60 Days Money Back Guarantee</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="express-service-item">
                                    <img src="{{ asset('theme/assets/images/products/moneysaver.png') }}" alt="30 Days Money Saver" class="express-icon mb-2">
                                    <div class="fw-bold text-primary">30 Days Money Saver Plan</div>
                                </div>
                            </div>
                        </div>

                        <!-- Compact Package Table -->
                        <div class="express-packages">
                            <div class="package-header d-none d-md-flex fw-bold bg-light border rounded-top p-3">
                                <div class="flex-grow-1">Package</div>
                                <div style="width: 120px;" class="text-center">Amount</div>
                                <div style="width: 100px;" class="text-end">Action</div>
                            </div>

                            <div class="package-item d-flex flex-column flex-md-row border-start border-end border-bottom align-items-start align-items-md-center p-3">
                                <div class="flex-grow-1">
                                    <div class="fw-semibold mb-1">30 Days Money Saver Combo</div>
                                    <span class="text-muted small">(Highlight Resume + Job Alert + Resume Blaster)</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mt-2 mt-md-0 ms-md-3" style="width: 120px;">
                                    <div class="fw-bold text-primary">INR 10,000/-</div>
                                </div>
                                <div class="mt-2 mt-md-0 ms-md-3" style="width: 100px;">
                                    <a href="#" class="btn btn-sm btn-info w-100">
                                        <i class="bx bx-credit-card me-1"></i>Pay
                                    </a>
                                </div>
                            </div>

                            <div class="package-item d-flex flex-column flex-md-row border-start border-end border-bottom align-items-start align-items-md-center p-3">
                                <div class="flex-grow-1">
                                    <div class="fw-semibold mb-1">60 Days Money Back Guarantee</div>
                                    <span class="text-muted small">(Highlight Resume + Job Alert + Resume Blaster)</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mt-2 mt-md-0 ms-md-3" style="width: 120px;">
                                    <div class="fw-bold text-danger">INR 18,000/-</div>
                                </div>
                                <div class="mt-2 mt-md-0 ms-md-3" style="width: 100px;">
                                    <a href="#" class="btn btn-sm btn-info w-100">
                                        <i class="bx bx-credit-card me-1"></i>Pay
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Compact Feature Cards -->
                        <div class="row text-center mt-4 g-2">
                            <div class="col-md-4">
                                <div class="feature-card">
                                    <div class="feature-icon text-danger mb-2">
                                        <i class="bx bx-highlight"></i>
                                    </div>
                                    <div class="fw-bold text-danger mb-1">Highlight Resume</div>
                                    <div class="small text-muted">Increase profile views up to 3 times</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-card">
                                    <div class="feature-icon text-warning mb-2">
                                        <i class="bx bx-send"></i>
                                    </div>
                                    <div class="fw-bold text-warning mb-1">Resume Blaster</div>
                                    <div class="small text-muted">Direct access to companies</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-card">
                                    <div class="feature-icon text-danger mb-2">
                                        <i class="bx bx-bell"></i>
                                    </div>
                                    <div class="fw-bold text-danger mb-1">SMS Job Alert</div>
                                    <div class="small text-muted">Get notified within 30 minutes</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-xl-4">
                <!-- Profile Completion Widget -->
                <div class="card professional-card mb-4">
                    <div class="card-header professional-header">
                        <h5 class="mb-0 header-title">
                            <i class="bx bx-user-check me-2"></i>Profile Completion
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="completion-widget">
                            <div class="completion-circle">
                                <div class="circle-progress" data-progress="85">
                                    <div class="circle-content">
                                        <span class="percentage">85%</span>
                                        <span class="label">Complete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="completion-items mt-3">
                                <div class="completion-item completed">
                                    <i class="bx bx-check-circle me-2"></i>
                                    <span>Basic Information</span>
                                </div>
                                <div class="completion-item completed">
                                    <i class="bx bx-check-circle me-2"></i>
                                    <span>Work Experience</span>
                                </div>
                                <div class="completion-item completed">
                                    <i class="bx bx-check-circle me-2"></i>
                                    <span>Certificates</span>
                                </div>
                                <div class="completion-item pending">
                                    <i class="bx bx-circle me-2"></i>
                                    <span>Skills Assessment</span>
                                    <a href="#" class="btn btn-xs btn-primary ms-auto">Complete</a>
                                </div>
                                <div class="completion-item pending">
                                    <i class="bx bx-circle me-2"></i>
                                    <span>References</span>
                                    <a href="#" class="btn btn-xs btn-primary ms-auto">Add</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card professional-card mb-4">
                    <div class="card-header professional-header">
                        <h5 class="mb-0 header-title">
                            <i class="bx bx-bar-chart me-2"></i>Quick Stats
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bx bx-hot"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number">12</div>
                                    <div class="stat-label">Hot Jobs for Master</div>
                                </div>
                            </div>

                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bx bx-anchor"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number">8</div>
                                    <div class="stat-label">Chief Engineer Jobs</div>
                                </div>
                            </div>

                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bx bx-ship"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number">5</div>
                                    <div class="stat-label">Oil Tanker Positions</div>
                                </div>
                            </div>

                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="bx bx-building"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number">15</div>
                                    <div class="stat-label">Active Companies</div>
                                </div>
                            </div>
                        </div>
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

    /* Welcome Section */
    .welcome-section {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .welcome-title {
        color: #1e293b;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }

    .user-name {
        color: #3b82f6;
        font-weight: 700;
    }

    .welcome-subtitle {
        color: #64748b;
        font-size: 1rem;
        margin: 0;
    }

    .quick-actions .btn-action {
        padding: 10px 20px;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .quick-actions .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Professional Card Styling */
    .professional-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .professional-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .professional-header {
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        color: #ffffff;
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: none;
    }

    .express-header {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
    }

    .header-title {
        font-size: 1rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        flex: 1;
    }

    /* Updated KPI Cards */
    .kpi-card {
        background: #ffffff;
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }

    .kpi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
    }

    .hot-jobs-card::before {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .views-card::before {
        background: linear-gradient(135deg, #10b981, #34d399);
    }

    .applied-card::before {
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
    }

    .completion-card::before {
        background: linear-gradient(135deg, #8b5cf6, #a78bfa);
    }

    .kpi-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .kpi-content {
        display: flex;
        align-items: center;
        padding: 20px;
    }

    .kpi-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        color: #64748b;
        font-size: 1.8rem;
    }

    .hot-jobs-card .kpi-icon {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #f59e0b;
    }

    .views-card .kpi-icon {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #10b981;
    }

    .applied-card .kpi-icon {
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        color: #3b82f6;
    }

    .completion-card .kpi-icon {
        background: linear-gradient(135deg, #ede9fe, #ddd6fe);
        color: #8b5cf6;
    }

    .kpi-number {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1;
        margin-bottom: 4px;
    }

    .kpi-label {
        font-size: 0.9rem;
        color: #64748b;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .kpi-trend {
        font-size: 0.8rem;
        font-weight: 500;
        display: flex;
        align-items: center;
    }

    .kpi-trend.positive {
        color: #059669;
    }

    .kpi-trend.neutral {
        color: #64748b;
    }

    .kpi-trend.warning {
        color: #d97706;
    }

    /* Express Service Compact Styles */
    .express-service-item {
        padding: 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .express-service-item:hover {
        background: #f8fafc;
        transform: translateY(-2px);
    }

    .express-icon {
        max-width: 80px;
        height: auto;
    }

    .express-packages {
        background: #ffffff;
        border-radius: 8px;
        overflow: hidden;
    }

    .package-item {
        transition: all 0.3s ease;
    }

    .package-item:hover {
        background: #f8fafc;
    }

    .feature-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 16px;
        height: 100%;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .feature-icon {
        font-size: 2rem;
    }

    /* Job Opportunities - keeping existing styles */
    .job-opportunities {
        padding: 0;
    }

    .job-item {
        padding: 20px;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.3s ease;
    }

    .job-item:last-child {
        border-bottom: none;
    }

    .job-item:hover {
        background: #f8fafc;
    }

    .job-logo {
        position: relative;
    }

    .job-logo img {
        width: 50px;
        height: 50px;
        object-fit: contain;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 4px;
        background: #fafafa;
    }

    .urgency-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        width: 16px;
        height: 16px;
        background: #dc2626;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #ffffff;
    }

    .urgency-badge i {
        color: #ffffff;
        font-size: 0.6rem;
    }

    .job-title {
        color: #1e293b;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 4px;
    }

    .job-company {
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .job-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        font-size: 0.8rem;
        color: #9ca3af;
    }

    .match-score {
        text-align: center;
    }

    .score-badge {
        background: linear-gradient(135deg, #059669, #10b981);
        color: #ffffff;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .score-badge.moderate {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
    }

    /* Profile Completion Widget - keeping existing styles */
    .completion-widget {
        text-align: center;
    }

    .completion-circle {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
    }

    .circle-progress {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: conic-gradient(#3b82f6 0deg 306deg, #e5e7eb 306deg 360deg);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .circle-progress::before {
        content: '';
        width: 90px;
        height: 90px;
        background: #ffffff;
        border-radius: 50%;
        position: absolute;
    }

    .circle-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .percentage {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
    }

    .label {
        font-size: 0.8rem;
        color: #64748b;
        font-weight: 500;
    }

    .completion-items {
        text-align: left;
    }

    .completion-item {
        display: flex;
        align-items: center;
        padding: 8px 0;
        font-size: 0.9rem;
    }

    .completion-item.completed {
        color: #059669;
    }

    .completion-item.pending {
        color: #64748b;
    }

    .btn-xs {
        padding: 2px 8px;
        font-size: 0.7rem;
        border-radius: 4px;
    }

    /* Stats Grid - keeping existing styles */
    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: #f8fafc;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        background: #f1f5f9;
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #e5e7eb, #d1d5db);
        color: #64748b;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .stat-number {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.75rem;
        color: #64748b;
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 1199.98px) {
        .kpi-content {
            padding: 16px;
        }

        .kpi-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
        }

        .kpi-number {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 767.98px) {
        .professional-bg {
            background: #f8fafc;
        }

        .welcome-section {
            padding: 16px;
            text-align: center;
        }

        .welcome-title {
            font-size: 1.2rem;
            justify-content: center;
        }

        .quick-actions {
            margin-top: 16px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .kpi-content {
            flex-direction: column;
            text-align: center;
            padding: 20px 16px;
        }

        .kpi-icon {
            margin-right: 0;
            margin-bottom: 12px;
        }

        .job-item {
            padding: 16px;
        }

        .job-item .d-flex {
            flex-direction: column;
            align-items: flex-start;
            text-align: center;
        }

        .job-actions {
            margin-top: 12px;
            width: 100%;
            text-align: center;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .express-icon {
            max-width: 70px;
        }

        .feature-card {
            margin-bottom: 16px;
        }

        .package-item {
            flex-direction: column !important;
            align-items: flex-start !important;
        }

        .package-item > div {
            width: 100% !important;
            text-align: center;
            margin-top: 8px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize dashboard
    initializeDashboard();

    // Update welcome message based on time
    updateWelcomeMessage();

    // Initialize progress circle animation
    animateProgressCircle();
});

function initializeDashboard() {
    // Add smooth hover effects to cards
    const cards = document.querySelectorAll('.kpi-card, .professional-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}



function animateProgressCircle() {
    const circle = document.querySelector('.circle-progress');
    if (circle) {
        const progress = 85; // 85% completion
        const degrees = (progress / 100) * 360;

        // Animate the circle
        setTimeout(() => {
            circle.style.background = `conic-gradient(#3b82f6 0deg ${degrees}deg, #e5e7eb ${degrees}deg 360deg)`;
        }, 500);
    }
}
</script>
@endsection
