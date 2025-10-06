@extends('layouts.candidate.app')
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
                        <i class="bx bx-list-check me-1"></i>Applied By You
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container py-4">
        <div class="card mb-4 professional-card">
            <div class="card-header professional-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 header-title"><i class="bx bx-list-check me-2"></i>My Applications</h5>
                    <div class="header-stats">
                        <span class="stats-badge">
                            <i class="bx bx-file me-1"></i>{{ $appliedStats->count() }} Total Applications
                        </span>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="applications-list" id="applicationsList">
                    @forelse($appliedStats as $stat)
                        @php
                            $statable = $stat->statable;
                            $meta = $stat->meta ?? [];

                            // job id (use statable id when model exists, else fallback to stat.statable_id)
                            $jobId = $statable ? ($statable->id ?? null) : ($stat->statable_id ?? null);

                            // logo / company / title resolution
                            $logo = $meta['company_logo'] ?? ($statable && isset($statable->company) ? $statable->company->company_logo : null);
                            $companyName = $meta['company_name'] ?? ($statable && isset($statable->company) ? $statable->company->company_name : ($statable->company_name ?? null));
                            $jobTitle = $meta['job_title'] ?? ($statable->title ?? ($statable->position ?? 'Job'));
                            $postedDate = $stat->created_at ? $stat->created_at->format('jS M, Y') : '';
                            $type = $meta['type'] ?? (class_basename($statable) === 'Banner' ? 'company-banner' : 'hot-job');
                            $detailsUrl = $jobId ? route('candidate.jobs.show', $jobId) : '#';
                        @endphp

                        <div class="application-card" data-type="{{ $type }}" data-date="{{ $stat->created_at ? $stat->created_at->format('Y-m-d') : '' }}">
                            <div class="application-type-tag {{ $type === 'company-banner' ? 'company-banner-tag' : 'hot-job-tag' }}">
                                <i class="bx {{ $type === 'company-banner' ? 'bx-building' : 'bx-hot' }} me-1"></i>
                                {{ $type === 'company-banner' ? 'Company Banner' : 'Hot Job' }}
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="app-logo me-3">
                                    @if($logo)
                                        <img src="{{ asset('theme/assets/images/company_logo/' . $logo) }}" alt="Logo" class="rounded">
                                    @else
                                        <img src="{{ asset('theme/assets/images/products/100.jpg') }}" alt="Logo" class="rounded">
                                    @endif
                                </div>

                                <div class="app-info flex-grow-1">
                                    <h6 class="app-title mb-1">
                                        <i class="bx {{ $type === 'company-banner' ? 'bx-building' : 'bx-briefcase' }} me-1 text-muted"></i>
                                        {{ $companyName ?? $jobTitle }}
                                    </h6>

                                    <div class="app-meta">
                                        <span class="posted-date"><i class="bx bx-calendar me-1"></i>Applied: {{ $postedDate }}</span>
                                        {{-- status can come from meta if present --}}
                                        @if(!empty($meta['status']))
                                            <span class="application-status ms-3">
                                                <i class="bx {{ $meta['status'] === 'Shortlisted' ? 'bx-check-circle' : ($meta['status'] === 'Rejected' ? 'bx-x-circle' : 'bx-time-five') }} me-1"></i>
                                                {{ $meta['status'] }}
                                            </span>
                                        @endif
                                    </div>

                                    @if(!empty($meta['description']))
                                        <div class="app-description mt-2">
                                            <p class="description-text">{{ $meta['description'] }}</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="app-actions ms-3">
                                    <a href="{{ $detailsUrl }}" class="btn btn-outline-primary btn-action">
                                        <i class="bx bx-show me-1"></i>
                                        <span class="d-none d-sm-inline">View Details</span>
                                        <span class="d-sm-none">View</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state" id="emptyState">
                            <i class="bx bx-inbox"></i>
                            <h6>No applications found</h6>
                            <p>No applications match your current filter criteria.</p>
                        </div>
                    @endforelse
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

    /* Professional Header */
    .professional-header {
        background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%);
        border: none;
        padding: 20px 24px;
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

    /* Filter and Sort Section */
    .applications-filter {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 16px;
    }

    .filter-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        display: block;
    }

    .filter-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .filter-btn {
        background: #ffffff;
        border: 1px solid #d1d5db;
        color: #6b7280;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .filter-btn:hover {
        border-color: #9ca3af;
        background: #f9fafb;
    }

    .filter-btn.active {
        background: #4f46e5;
        border-color: #4f46e5;
        color: #ffffff;
    }

    .sort-select {
        background: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        padding: 8px 12px;
        font-size: 0.875rem;
        color: #374151;
        min-width: 150px;
    }

    .sort-select:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    /* Application Card Styling */
    .applications-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .application-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    .application-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-color: #d1d5db;
    }

    /* Application Type Tags */
    .application-type-tag {
        position: absolute;
        top: 0;
        right: 0;
        padding: 6px 12px;
        border-radius: 0 10px 0 10px;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .company-banner-tag {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #ffffff;
    }

    .hot-job-tag {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: #ffffff;
    }

    /* Logo Styling */
    .app-logo img {
        width: 60px;
        height: 60px;
        object-fit: contain;
        border: 2px solid #f3f4f6;
        padding: 8px;
        background: #fafafa;
        transition: all 0.3s ease;
        border-radius: 6px;
    }

    .application-card:hover .app-logo img {
        border-color: #e5e7eb;
        transform: scale(1.02);
    }

    /* Title and Info Styling */
    .app-title {
        color: #374151;
        font-weight: 600;
        font-size: 1.05rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }

    .app-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 8px;
    }

    .posted-date, .application-status {
        color: #6b7280;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        font-weight: 500;
    }

    .posted-date i, .application-status i {
        color: #9ca3af;
        font-size: 0.9rem;
    }

    .app-description {
        margin-top: 8px;
    }

    .description-text {
        color: #6b7280;
        font-size: 0.875rem;
        margin: 0;
        line-height: 1.4;
    }

    /* Status-specific colors */
    .application-status i.bx-check-circle {
        color: #10b981;
    }

    .application-status i.bx-x-circle {
        color: #ef4444;
    }

    .application-status i.bx-time-five {
        color: #f59e0b;
    }

    /* Professional Button Styling */
    .btn-action {
        padding: 8px 16px;
        font-size: 0.85rem;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        white-space: nowrap;
        border-width: 1px;
    }

    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-primary.btn-action {
        color: #4f46e5;
        border-color: #4f46e5;
        background: transparent;
    }

    .btn-outline-primary.btn-action:hover {
        background: #4f46e5;
        color: #ffffff;
        border-color: #4f46e5;
    }

    .btn-outline-secondary.btn-action {
        color: #6b7280;
        border-color: #6b7280;
        background: transparent;
    }

    .btn-outline-secondary.btn-action:hover {
        background: #6b7280;
        color: #ffffff;
        border-color: #6b7280;
    }

    /* Empty State Styling */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #9ca3af;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 16px;
        opacity: 0.6;
        color: #d1d5db;
    }

    .empty-state h6 {
        color: #6b7280;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: #9ca3af;
        font-size: 0.875rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .professional-bg {
            background: #f8fafc;
        }

        .application-card {
            padding: 16px;
        }

        .app-logo img {
            width: 50px;
            height: 50px;
        }

        .app-title {
            font-size: 1rem;
        }

        .app-meta {
            gap: 15px;
        }

        .posted-date, .application-status {
            font-size: 0.8rem;
        }

        .btn-action {
            padding: 6px 12px;
            font-size: 0.8rem;
        }

        .breadcrumb-title {
            font-size: 1rem;
        }

        .enhanced-breadcrumb {
            padding: 12px 16px;
        }

        .professional-header {
            padding: 16px 20px;
        }

        .header-title {
            font-size: 1rem;
        }

        .applications-filter {
            padding: 12px;
        }

        .filter-buttons {
            gap: 6px;
        }

        .filter-btn {
            padding: 4px 8px;
            font-size: 0.75rem;
        }

        .sort-select {
            min-width: 120px;
            font-size: 0.8rem;
        }

        .application-type-tag {
            padding: 4px 8px;
            font-size: 0.7rem;
        }
    }

    @media (max-width: 575.98px) {
        .application-card .d-flex {
            flex-direction: column;
            align-items: flex-start;
        }

        .app-actions {
            margin-left: 0 !important;
            margin-top: 15px;
            width: 100%;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        .app-info {
            margin-top: 12px;
            width: 100%;
        }

        .app-meta {
            justify-content: space-between;
        }

        .filter-group, .sort-group {
            text-align: left !important;
        }

        .header-stats {
            margin-top: 10px;
        }

        .professional-header .d-flex {
            flex-direction: column;
            align-items: flex-start;
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

    .application-card {
        animation: subtleFadeIn 0.4s ease-out;
    }

    .application-card:nth-child(2) {
        animation-delay: 0.1s;
    }

    .application-card:nth-child(3) {
        animation-delay: 0.2s;
    }

    .application-card:nth-child(4) {
        animation-delay: 0.3s;
    }

    /* Focus states for accessibility */
    .btn-action:focus {
        outline: 2px solid #4f46e5;
        outline-offset: 2px;
    }

    .breadcrumb-link:focus {
        outline: 2px solid #4f46e5;
        outline-offset: 2px;
        border-radius: 4px;
    }

    .filter-btn:focus {
        outline: 2px solid #4f46e5;
        outline-offset: 2px;
    }
</style>
