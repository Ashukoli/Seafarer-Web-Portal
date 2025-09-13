@extends('layouts.app')
@section('content')
<main class="page-content">
    <div class="container py-4">
        <div class="card border-0 shadow-sm mx-auto">
            <!-- Header with Company Info -->
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <div class="me-md-4 mb-3 mb-md-0">
                        <img src="{{ asset('theme/assets/images/products/download.png') }}"
                             class="rounded-circle border p-1 bg-light"
                             width="90"
                             alt="Company Logo">
                    </div>
                    <div class="text-center text-md-start">
                        <h1 class="h4 fw-bold mb-1 text-dark">MAS SHIP MANAGEMENT PRIVATE LIMITED</h1>
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                            <span class="badge bg-light text-dark border border-1 border-secondary">
                                <i class="bi bi-clock me-1"></i> Posted: 2025-07-30
                            </span>
                            <span class="badge bg-danger bg-opacity-10">
                                <i class="bi bi-exclamation-triangle-fill me-1 text-danger"></i> Urgent
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Job Details -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-6 col-md-4 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary p-2">
                                    <i class="bx bx-user fs-5 icon-white"></i>
                                </span>
                            </div>
                            <div>
                                <div class="text-muted small">Rank</div>
                                <div class="fw-bold">Chief Engineer</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary p-2">
                                    <i class="bx bx-anchor fs-5 icon-white"></i>
                                </span>
                            </div>
                            <div>
                                <div class="text-muted small">Ship Type</div>
                                <div class="fw-bold">Bulk Carrier</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary p-2">
                                    <i class="bx bx-calendar fs-5 icon-white"></i>
                                </span>
                            </div>
                            <div>
                                <div class="text-muted small">Joining Date</div>
                                <div class="fw-bold">2025-08-15</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary p-2">
                                    <i class="bx bx-calendar-check fs-5 icon-white"></i>
                                </span>
                            </div>
                            <div>
                                <div class="text-muted small">Expiry Date</div>
                                <div class="fw-bold">2025-08-31</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary p-2">
                                    <i class="bx bx-flag fs-5 icon-white"></i>
                                </span>
                            </div>
                            <div>
                                <div class="text-muted small">Nationality</div>
                                <div class="fw-bold">Indian</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary p-2">
                                    <i class="bx bx-timer fs-5 icon-white"></i>
                                </span>
                            </div>
                            <div>
                                <div class="text-muted small">Experience</div>
                                <div class="fw-bold">2 Years</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <h6 class="fw-bold mb-2 job-title">Job Description</h6>
                <p class="mb-3 job-description">
                   Urgent Requirement of Master for Bulk Carrier, COC: Only National COCs are acceptable, Prior experience on the same type of vessels is essential, Promotional candidates are also eligible to apply.(FOR JR.OFFICERS), Salary as per Market Standard.
                </p>
                
                <!-- Contact Information Section (Hidden by default) -->
                <div id="contactInfo" class="contact-section mb-4">
                    <h6 class="fw-bold mb-3 contact-title">
                        <i class="bx bx-phone-call me-2"></i>Contact Information
                    </h6>
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="contact-item">
                                <div class="d-flex align-items-center">
                                    <div class="contact-icon me-3">
                                        <i class="bx bx-user-circle fs-4 icon-primary"></i>
                                    </div>
                                    <div>
                                        <div class="contact-label">Posted By</div>
                                        <div class="contact-value">HR Manager - Maritime Division</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="contact-item">
                                <div class="d-flex align-items-center">
                                    <div class="contact-icon me-3">
                                        <i class="bx bx-envelope fs-4 icon-primary"></i>
                                    </div>
                                    <div>
                                        <div class="contact-label">Email ID</div>
                                        <div class="contact-value">
                                            <a href="mailto:careers@masship.com" class="contact-link">careers@masship.com</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="contact-item">
                                <div class="d-flex align-items-center">
                                    <div class="contact-icon me-3">
                                        <i class="bx bx-phone fs-4 icon-primary"></i>
                                    </div>
                                    <div>
                                        <div class="contact-label">Contact No.</div>
                                        <div class="contact-value">
                                            <a href="tel:+919876543210" class="contact-link">+91 98765 43210</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-primary px-4 fw-bold">
                            <i class="bx bx-check-circle"></i> Apply Now
                        </a>
                        <button type="button" id="toggleContactBtn" class="btn btn-outline-primary px-4 fw-bold">
                            <i class="bx bx-phone"></i> <span id="contactBtnText">View Contact</span>
                        </button>
                    </div>                    
                </div>
                
                <!-- SMS Alert Notice -->
                <div class="sms-alert-notice mt-3">
                    <p class="mb-0"><strong>Note * :</strong> Continue receiving "instant job SMS Alert " <a href="{{ route('candidate.express.service') }}" class="sms-alert-link">Click Here</a></p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

<style>
    /* Icon color classes */
    .icon-primary { 
        color: #0d6efd !important; 
    }
    
    .icon-white { 
        color: white !important; 
    }
    
    .icon-success { 
        color: #198754 !important; 
    }
    
    .icon-danger { 
        color: #dc3545 !important; 
    }
    
    .icon-warning { 
        color: #ffc107 !important; 
    }
    
    .icon-info { 
        color: #0dcaf0 !important; 
    }
    
    .icon-dark { 
        color: #212529 !important; 
    }
    
    /* Job section styling */
    .job-title {
        color: #2563eb;
    }
    
    .job-description {
        color: #222;
    }
    
    /* SMS Alert Notice Styling */
    .sms-alert-notice {
        color: #dc3545;
        font-size: 0.875rem;
    }
    
    .sms-alert-link {
        color: #dc3545 !important;
        text-decoration: underline;
        font-weight: 500;
    }
    
    .sms-alert-link:hover {
        color: #b02a37 !important;
        text-decoration: underline;
    }
    
    /* Contact Section Styling */
    .contact-section {
        display: none;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #dee2e6;
        animation: slideDown 0.3s ease-out;
    }
    
    .contact-section.show {
        display: block;
    }
    
    .contact-title {
        color: #2563eb;
        border-bottom: 2px solid #0d6efd;
        padding-bottom: 8px;
        margin-bottom: 20px;
    }
    
    .contact-item {
        background: white;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #0d6efd;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        height: 100%;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .contact-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .contact-icon {
        width: 45px;
        height: 45px;
        background-color: rgba(13, 110, 253, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .contact-label {
        font-size: 0.875rem;
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 2px;
    }
    
    .contact-value {
        font-weight: 600;
        color: #212529;
        font-size: 0.95rem;
        word-break: break-all;
    }
    
    .contact-link {
        color: #0d6efd;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .contact-link:hover {
        color: #0a58ca;
        text-decoration: underline;
    }
    
    /* Animation for slide down effect */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Button styling */
    .btn-outline-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.4);
    }
    
    /* Badge styling enhancements */
    .badge-solid {
        background-color: #0d6efd !important;
        color: white !important;
    }
    
    .badge-solid .bx {
        color: white !important;
    }
    
    /* Alternative color schemes for future use */
    .text-custom-blue {
        color: #2563eb !important;
    }
    
    .text-custom-dark {
        color: #222 !important;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .contact-section {
            padding: 15px;
        }
        
        .contact-item {
            margin-bottom: 15px;
        }
        
        .contact-value {
            font-size: 0.9rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleContactBtn');
    const contactInfo = document.getElementById('contactInfo');
    const btnText = document.getElementById('contactBtnText');
    
    toggleBtn.addEventListener('click', function() {
        if (contactInfo.classList.contains('show')) {
            contactInfo.classList.remove('show');
            btnText.textContent = 'View Contact';
            toggleBtn.querySelector('i').className = 'bx bx-phone';
        } else {
            contactInfo.classList.add('show');
            btnText.textContent = 'Hide Contact';
            toggleBtn.querySelector('i').className = 'bx bx-phone-off';
        }
    });
});
</script>
