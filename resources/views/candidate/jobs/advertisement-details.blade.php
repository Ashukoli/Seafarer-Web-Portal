@extends('layouts.candidate.app')
@section('content')

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
                    <li class="breadcrumb-item">
                        <a href="{{ route('candidate.jobs.search') }}" class="breadcrumb-link">
                            <i class="bx bx-search-alt me-1"></i>Search Jobs
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bx bx-file-text me-1"></i>Job Details
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!--Mobile Breadcrumb-->
    <div class="mobile-breadcrumb d-flex d-sm-none align-items-center mb-3 px-3">
        <button class="btn-back me-3" onclick="history.back()">
            <i class="bx bx-arrow-back"></i>
        </button>
        <div class="breadcrumb-mobile">
            <div class="current-page">Job Details</div>
            <div class="page-subtitle">Maritime opportunity</div>
        </div>
    </div>

    <div class="banner-container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-10 col-md-11">
                <div class="banner-card">
                    <div class="banner-actions">
                        <a href="" class="btn btn-apply-primary">
                            <i class="bx bx-paper-plane me-2"></i>
                            Click here to Apply for this Job
                        </a>
                    </div>
                    <!-- Banner Image -->
                    <div class="banner-image-wrapper">
                        <img src="{{ asset('theme/assets/images/banner1.jpg') }}"
                             alt="Job Advertisement Banner"
                             class="banner-image">
                    </div>

                    <!-- Apply Button -->
                    <div class="banner-actions">
                        <a href="" class="btn btn-apply-primary">
                            <i class="bx bx-paper-plane me-2"></i>
                            Click here to Apply for this Job
                        </a>
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
    padding: 12px 20px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
}

.breadcrumb-link {
    color: #475569;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.breadcrumb-link:hover {
    color: #334155;
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

/* Mobile Breadcrumb */
.mobile-breadcrumb {
    background: #ffffff;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    border: 1px solid #e5e7eb;
}

.btn-back {
    width: 44px;
    height: 44px;
    border: none;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #374151;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: #e5e7eb;
    transform: translateX(-2px);
}

.current-page {
    font-weight: 600;
    color: #1f2937;
    font-size: 1rem;
    line-height: 1.2;
}

.page-subtitle {
    font-size: 0.85rem;
    color: #6b7280;
    margin-top: 2px;
}

/* Banner Container */
.banner-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 16px;
}

/* Banner Card */
.banner-card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border: 1px solid #e5e7eb;
    overflow: hidden;
    animation: slideInUp 0.6s ease-out;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Banner Image Wrapper */
.banner-image-wrapper {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f8fafc;
    padding: 20px;
}

.banner-image {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.banner-image:hover {
    transform: scale(1.02);
}

/* Banner Actions */
.banner-actions {
    padding: 32px;
    text-align: center;
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border-top: 1px solid #f1f5f9;
}

.btn-apply-primary {
    display: inline-flex;
    align-items: center;
    padding: 16px 32px;
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: #ffffff;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    transition: all 0.3s ease;
    border: none;
    letter-spacing: 0.025em;
}

.btn-apply-primary:hover {
    background: linear-gradient(135deg, #4f46e5, #4338ca);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
    color: #ffffff;
    text-decoration: none;
}

.btn-apply-primary:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
}

.btn-apply-primary:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
}

.btn-apply-primary i {
    font-size: 1.2rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .banner-container {
        padding: 0 12px;
    }

    .banner-image-wrapper {
        padding: 16px;
    }

    .banner-actions {
        padding: 24px 20px;
    }

    .btn-apply-primary {
        padding: 12px 24px;
        font-size: 1rem;
        width: 100%;
        justify-content: center;
    }

    .btn-apply-primary i {
        font-size: 1.1rem;
    }
}

@media (max-width: 576px) {
    .banner-image-wrapper {
        padding: 12px;
    }

    .banner-actions {
        padding: 20px 16px;
    }

    .btn-apply-primary {
        font-size: 0.95rem;
    }
}

/* Focus states for accessibility */
.breadcrumb-link:focus,
.btn-back:focus,
.btn-apply-primary:focus {
    outline: 2px solid #6366f1;
    outline-offset: 2px;
}

/* Print styles */
@media print {
    .professional-bg {
        background: #ffffff;
    }

    .page-breadcrumb,
    .mobile-breadcrumb {
        display: none;
    }

    .banner-actions {
        display: none;
    }
}
</style>

@endsection
