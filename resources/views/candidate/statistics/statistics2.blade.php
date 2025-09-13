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
                        <i class="bx bx-show me-1"></i>Viewed Your Resume
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    
    <div class="container py-4">
        <!-- Resume Views Section -->
        <div class="card mb-4 professional-card">
            <div class="card-header professional-header resume-header">
                <h5 class="mb-0 header-title">
                    <i class="bx bx-file-blank me-2"></i>Companies That Viewed Your Resume
                </h5>
                <div class="header-stats">
                    <span class="stats-badge">
                        <i class="bx bx-show-alt me-1"></i>3 Views
                    </span>
                </div>
            </div>
            <div class="card-body p-4">
                <!-- Combined Responsive Resume View Cards -->
                <div class="row g-3">
                    <!-- Resume View Card 1 -->
                    <div class="col-12">
                        <div class="resume-view-card">
                            <div class="d-flex align-items-center">
                                <div class="company-logo me-3">
                                    <img src="{{ asset('theme/assets/images/products/28.png') }}" alt="Oceanic Crew" class="rounded">
                                </div>
                                <div class="company-info flex-grow-1">
                                    <h6 class="company-name mb-1">
                                        <i class="bx bx-buildings me-1 text-muted"></i>Oceanic Crew Management
                                    </h6>
                                    <div class="view-meta">
                                        <span class="viewed-date">
                                            <i class="bx bx-calendar me-1"></i>Viewed: 2025-07-29
                                        </span>
                                        <span class="view-time ms-3">
                                            <i class="bx bx-time me-1"></i>2 days ago
                                        </span>
                                    </div>
                                </div>
                                <div class="view-indicator ms-3">
                                    <div class="view-status recent">
                                        <i class="bx bx-show"></i>
                                        <small>Recent</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Resume View Card 2 -->
                    <div class="col-12">
                        <div class="resume-view-card">
                            <div class="d-flex align-items-center">
                                <div class="company-logo me-3">
                                    <img src="{{ asset('theme/assets/images/products/100.jpg') }}" alt="Blue Wave" class="rounded">
                                </div>
                                <div class="company-info flex-grow-1">
                                    <h6 class="company-name mb-1">
                                        <i class="bx bx-buildings me-1 text-muted"></i>Blue Wave Shipping
                                    </h6>
                                    <div class="view-meta">
                                        <span class="viewed-date">
                                            <i class="bx bx-calendar me-1"></i>Viewed: 2025-07-27
                                        </span>
                                        <span class="view-time ms-3">
                                            <i class="bx bx-time me-1"></i>4 days ago
                                        </span>
                                    </div>
                                </div>
                                <div class="view-indicator ms-3">
                                    <div class="view-status normal">
                                        <i class="bx bx-show"></i>
                                        <small>Viewed</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Resume View Card 3 -->
                    <div class="col-12">
                        <div class="resume-view-card">
                            <div class="d-flex align-items-center">
                                <div class="company-logo me-3">
                                    <img src="{{ asset('theme/assets/images/products/28.png') }}" alt="SES Marine" class="rounded">
                                </div>
                                <div class="company-info flex-grow-1">
                                    <h6 class="company-name mb-1">
                                        <i class="bx bx-buildings me-1 text-muted"></i>SES MARINE SERVICES
                                    </h6>
                                    <div class="view-meta">
                                        <span class="viewed-date">
                                            <i class="bx bx-calendar me-1"></i>Viewed: 2025-07-25
                                        </span>
                                        <span class="view-time ms-3">
                                            <i class="bx bx-time me-1"></i>6 days ago
                                        </span>
                                    </div>
                                </div>
                                <div class="view-indicator ms-3">
                                    <div class="view-status old">
                                        <i class="bx bx-show"></i>
                                        <small>Viewed</small>
                                    </div>
                                </div>
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
    
    /* Resume Header */
    .resume-header {
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
    
    /* Resume View Card Styling */
    .resume-view-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }
    
    .resume-view-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .resume-view-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-color: #3b82f6;
    }
    
    .resume-view-card:hover::before {
        opacity: 1;
    }
    
    /* Company Logo Styling */
    .company-logo img {
        width: 60px;
        height: 60px;
        object-fit: contain;
        border: 2px solid #f3f4f6;
        padding: 8px;
        background: #fafafa;
        transition: all 0.3s ease;
        border-radius: 6px;
    }
    
    .resume-view-card:hover .company-logo img {
        border-color: #e5e7eb;
        transform: scale(1.02);
    }
    
    /* Company Info Styling */
    .company-name {
        color: #374151;
        font-weight: 600;
        font-size: 1.05rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }
    
    .view-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .viewed-date, .view-time {
        color: #6b7280;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        font-weight: 500;
    }
    
    .viewed-date i, .view-time i {
        color: #9ca3af;
        font-size: 0.9rem;
    }
    
    /* View Indicator */
    .view-indicator {
        text-align: center;
    }
    
    .view-status {
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
        min-width: 70px;
    }
    
    .view-status i {
        font-size: 1.2rem;
        margin-bottom: 2px;
    }
    
    .view-status.recent {
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        color: #15803d;
        border: 1px solid #86efac;
    }
    
    .view-status.normal {
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        color: #1d4ed8;
        border: 1px solid #93c5fd;
    }
    
    .view-status.old {
        background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        color: #6b7280;
        border: 1px solid #d1d5db;
    }
    
    /* Resume Stats */
    .resume-stats {
        background: #f9fafb;
        border-radius: 8px;
        padding: 20px;
        margin: 0 -20px -20px -20px;
    }
    
    .stat-item {
        padding: 15px;
        text-align: center;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
    }
    
    .stat-icon i {
        font-size: 1.5rem;
        color: #ffffff;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #374151;
        margin-bottom: 4px;
    }
    
    .stat-label {
        font-size: 0.9rem;
        color: #6b7280;
        font-weight: 500;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .professional-bg {
            background: #f8fafc;
        }
        
        .resume-view-card {
            padding: 16px;
        }
        
        .company-logo img {
            width: 50px;
            height: 50px;
        }
        
        .company-name {
            font-size: 1rem;
        }
        
        .view-meta {
            gap: 15px;
        }
        
        .viewed-date, .view-time {
            font-size: 0.8rem;
        }
        
        .breadcrumb-title {
            font-size: 1rem;
        }
        
        .enhanced-breadcrumb {
            padding: 12px 16px;
        }
        
        .resume-header {
            padding: 16px 20px;
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }
        
        .header-title {
            font-size: 1rem;
        }
        
        .resume-stats {
            margin: 20px -16px -16px -16px;
            padding: 16px;
        }
        
        .stat-number {
            font-size: 1.5rem;
        }
        
        .stat-icon {
            width: 40px;
            height: 40px;
        }
        
        .stat-icon i {
            font-size: 1.2rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .resume-view-card .d-flex {
            flex-direction: column;
            align-items: flex-start;
            text-align: center;
        }
        
        .view-indicator {
            margin-left: 0 !important;
            margin-top: 15px;
            width: 100%;
        }
        
        .view-status {
            width: 100%;
            flex-direction: row;
            justify-content: center;
            gap: 8px;
        }
        
        .company-info {
            margin-top: 12px;
            width: 100%;
            text-align: center;
        }
        
        .view-meta {
            justify-content: center;
        }
    }
    
    /* Subtle Animation for cards */
    @keyframes subtleFadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .resume-view-card {
        animation: subtleFadeIn 0.4s ease-out;
    }
    
    .resume-view-card:nth-child(2) {
        animation-delay: 0.1s;
    }
    
    .resume-view-card:nth-child(3) {
        animation-delay: 0.2s;
    }
    
    /* Focus states for accessibility */
    .resume-view-card:focus {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
    }
    
    .breadcrumb-link:focus {
        outline: 2px solid #4f46e5;
        outline-offset: 2px;
        border-radius: 4px;
    }
</style>
