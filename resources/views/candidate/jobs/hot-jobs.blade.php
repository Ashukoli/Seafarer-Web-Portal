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
                        <i class="bx bxs-hot me-1"></i>Hot Jobs
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->



    <!-- Search Filter Card -->
    <div class="card mb-4 professional-card">
        <div class="card-body p-4">
            <form class="row g-3 align-items-end" method="GET" action="{{ route('candidate.jobs.hot') }}">
                <div class="col-md-6 col-12">
                    <label for="rank" class="form-label fw-semibold search-label">
                        <i class="bx bx-medal me-2"></i>Select Rank
                    </label>
                    <select class="form-select professional-select" id="rank" name="rank">
                        <option value="">-- All Ranks --</option>
                        @foreach($ranks as $rank)
                            <option value="{{ $rank->id }}" @if(isset($selectedRank) && $selectedRank == $rank->id) selected @endif>
                                {{ $rank->rank }}
                            </option>
                        @endforeach
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

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>There were some problems:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Hot Jobs Section -->
    <div class="card mb-4 professional-card">
        <div class="card-header professional-header jobs-header gradient-header">
            <h5 class="mb-0 header-title">
                <i class="bx bxs-hot me-2"></i>Hot Jobs Available
            </h5>
            <div class="header-stats">
                <span class="stats-badge title-badge improved-badge">
                    <i class="bx bx-briefcase me-1"></i>
                    <span class="badge-text">{{ $hotJobs->count() }} Active</span>
                </span>
            </div>
        </div>

        <div class="card-body p-4">
            @if($hotJobs->isEmpty())
                <div class="alert alert-info mb-0">
                    No hot jobs match your current rank. Update your resume present rank or try a different filter.
                </div>
            @else
                <div class="row g-4">
                    @foreach($hotJobs as $job)
                        <div class="col-12">
                            <div class="professional-job-card hot-job compact-desktop">
                                <!-- Urgent Badge -->
                                @if($job->urgent_status)
                                    <div class="urgent-badge" title="Urgent Requirement">
                                        <i class="bx bx-error-circle"></i>
                                    </div>
                                @endif

                                <!-- Desktop View: Horizontal Layout -->
                                <div class="desktop-layout d-none d-lg-flex">
                                    <!-- Left Content -->
                                    <div class="desktop-left-content">
                                        <!-- Company Header -->
                                        <div class="desktop-company-header">
                                            <div class="company-logo-wrapper">
                                                <img src="{{ optional($job->company)->logo ? asset('storage/' . $job->company->logo) : asset('theme/assets/images/products/download.png') }}" alt="Company Logo" class="company-logo-img">
                                            </div>
                                            <div class="company-details">
                                                <div class="company-badge">
                                                    <i class="bx bx-buildings me-1"></i>
                                                    COMPANY
                                                </div>
                                                <h6 class="company-name">
                                                    {{ optional($job->company)->company_name ?? 'Company' }}
                                                </h6>
                                            </div>
                                        </div>

                                        <!-- Job Description -->
                                        <div class="desktop-job-description">
                                            <div class="description-header">
                                                <i class="bx bx-file-text description-icon"></i>
                                                <strong class="description-title">Job Description:</strong>
                                            </div>
                                            <div class="description-content">
                                                {{ Str::limit($job->description, 280) }}
                                            </div>
                                        </div>

                                        <!-- Tags -->
                                        <div class="desktop-tags">
                                            <span class="professional-tag urgent-tag">
                                                <i class="bx bx-error-circle me-1"></i>
                                                Urgent
                                            </span>

                                            <span class="professional-tag rank-tag">
                                                <i class="bx bx-user me-1"></i>
                                                {{ optional($job->rank)->rank ?? '—' }}
                                            </span>

                                            <span class="professional-tag ship-tag">
                                                <i class="bx bx-anchor me-1"></i>
                                                {{ optional($job->ship)->ship_name ?? 'Ship Type' }}
                                            </span>

                                            <span class="professional-tag date-tag">
                                                <i class="bx bx-calendar me-1"></i>
                                                Joining: {{ optional($job->joiningdate) ? \Carbon\Carbon::parse($job->joiningdate)->format('M d, Y') : '—' }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Right Action Button -->
                                    <div class="desktop-right-action">
                                        <a href="{{ route('candidate.jobs.show', $job->id) }}" class="btn-view-desktop">
                                            <i class="bx bx-show me-1"></i>
                                            <span>View Details</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Mobile View: Vertical Layout (Keep Existing Perfect Mobile Layout) -->
                                <div class="mobile-layout d-lg-none">
                                    <!-- Card Header with Company Info -->
                                    <div class="job-card-header-improved">
                                        <div class="company-info-section">
                                            <div class="company-logo-wrapper">
                                                <img src="{{ optional($job->company)->logo ? asset('storage/' . $job->company->logo) : asset('theme/assets/images/products/download.png') }}" alt="Company Logo" class="company-logo-img">
                                            </div>
                                            <div class="company-details">
                                                <div class="company-badge">
                                                    <i class="bx bx-buildings me-1"></i>
                                                    COMPANY
                                                </div>
                                                <h6 class="company-name">
                                                    {{ optional($job->company)->company_name ?? 'Company' }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Job Description Section -->
                                    <div class="job-description-professional">
                                        <div class="description-header">
                                            <i class="bx bx-file-text description-icon"></i>
                                            <strong class="description-title">Job Description:</strong>
                                        </div>
                                        <div class="description-content">
                                            {{ Str::limit($job->description, 320) }}
                                        </div>
                                    </div>

                                    <!-- Professional Tags Section -->
                                    <div class="job-tags-professional">
                                        <div class="tag-group">
                                            <span class="professional-tag urgent-tag">
                                                <i class="bx bx-error-circle me-1"></i>
                                                Urgent
                                            </span>

                                            <span class="professional-tag rank-tag">
                                                <i class="bx bx-user me-1"></i>
                                                {{ optional($job->rank)->rank ?? '—' }}
                                            </span>

                                            <span class="professional-tag ship-tag">
                                                <i class="bx bx-anchor me-1"></i>
                                                {{ optional($job->ship)->ship_name ?? 'Ship Type' }}
                                            </span>

                                            <span class="professional-tag date-tag">
                                                <i class="bx bx-calendar me-1"></i>
                                                Joining: {{ optional($job->joiningdate) ? \Carbon\Carbon::parse($job->joiningdate)->format('M d, Y') : '—' }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- View Button at Bottom -->
                                    <div class="job-actions-bottom">
                                        <a href="{{ route('candidate.jobs.show', $job->id) }}" class="btn-view-bottom">
                                            <i class="bx bx-show me-1"></i>
                                            <span>View Details</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
