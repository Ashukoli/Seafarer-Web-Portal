@extends('layouts.app')
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
                    <li class="breadcrumb-item">
                        <a href="{{ route('candidate.dashboard') }}" class="breadcrumb-link">
                            <i class="bx bx-home-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('candidate.express.service') }}" class="breadcrumb-link">
                            <i class="bx bx-rocket me-1"></i>Express Service
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bx bx-credit-card me-1"></i>Checkout
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container py-4">
        <div class="checkout-wrapper">
            <!-- Progress Indicator -->
            <div class="progress-section mb-4">
                <div class="progress-steps">
                    <div class="step completed">
                        <div class="step-circle">
                            <i class="bx bx-check"></i>
                        </div>
                        <div class="step-label">Select Package</div>
                    </div>
                    <div class="step-line completed"></div>
                    <div class="step active">
                        <div class="step-circle">
                            <i class="bx bx-credit-card"></i>
                        </div>
                        <div class="step-label">Payment</div>
                    </div>
                    <div class="step-line"></div>
                    <div class="step">
                        <div class="step-circle">
                            <i class="bx bx-check-shield"></i>
                        </div>
                        <div class="step-label">Confirmation</div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Main Checkout Card -->
                    <div class="card professional-card mb-4">
                        <div class="card-header professional-header checkout-header">
                            <h5 class="mb-0 header-title">
                                <i class="bx bx-rocket me-2"></i>Seafarer Express Service Checkout
                            </h5>
                            <div class="security-badge">
                                <i class="bx bx-shield-check me-1"></i>
                                <span>Secure Payment</span>
                            </div>
                        </div>
                        
                        <div class="card-body p-4">
                            <!-- Customer Information -->
                            <div class="info-section mb-4">
                                <h6 class="section-title">
                                    <i class="bx bx-user me-2"></i>Customer Information
                                </h6>
                                <div class="customer-info-card">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <label class="info-label">Full Name</label>
                                                <div class="info-value">{{ Auth::user()->name ?? 'Bhupesh Bhandari' }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <label class="info-label">Email Address</label>
                                                <div class="info-value">{{ Auth::user()->email ?? 'bhupesh@example.com' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Package Details -->
                            <div class="package-section mb-4">
                                <h6 class="section-title">
                                    <i class="bx bx-package me-2"></i>Selected Package
                                </h6>
                                <div class="package-details-card">
                                    <div class="package-header">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('theme/assets/images/products/moneybackguarantee.png') }}" alt="Money Back Guarantee" class="package-icon me-3">
                                            <div>
                                                <h6 class="package-name mb-1">60 Days Money Back Guarantee Combo Plan</h6>
                                                <div class="package-description">Complete career acceleration package</div>
                                            </div>
                                            <div class="package-badge ms-auto">
                                                <span class="badge badge-premium">Premium</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="package-features">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="feature-item">
                                                    <i class="bx bx-highlight text-danger me-2"></i>
                                                    <span>Highlight Resume</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="feature-item">
                                                    <i class="bx bx-bell text-warning me-2"></i>
                                                    <span>SMS Job Alert</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="feature-item">
                                                    <i class="bx bx-send text-primary me-2"></i>
                                                    <span>Resume Blaster</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pricing Breakdown -->
                            <div class="pricing-section mb-4">
                                <h6 class="section-title">
                                    <i class="bx bx-calculator me-2"></i>Pricing Breakdown
                                </h6>
                                <div class="pricing-card">
                                    <div class="pricing-row">
                                        <span class="pricing-label">Package Price</span>
                                        <span class="pricing-value">₹15,254/-</span>
                                    </div>
                                    <div class="pricing-row">
                                        <span class="pricing-label">GST (18%)</span>
                                        <span class="pricing-value">₹2,746/-</span>
                                    </div>
                                    <div class="pricing-row discount-row">
                                        <span class="pricing-label">
                                            <i class="bx bx-gift me-1"></i>Early Bird Discount
                                        </span>
                                        <span class="pricing-value text-success">-₹0/-</span>
                                    </div>
                                    <hr class="pricing-divider">
                                    <div class="pricing-row total-row">
                                        <span class="pricing-label">Total Payable Amount</span>
                                        <span class="pricing-value total-amount">₹18,000/-</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="terms-section mb-4">
                                <div class="terms-card">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="termsCheck">
                                        <label class="form-check-label" for="termsCheck">
                                            I have read and agree to the 
                                            <a href="#" class="terms-link" data-bs-toggle="modal" data-bs-target="#termsModal">
                                                Terms & Conditions
                                            </a> and 
                                            <a href="#" class="terms-link" data-bs-toggle="modal" data-bs-target="#privacyModal">
                                                Privacy Policy
                                            </a>
                                        </label>
                                    </div>
                                    <div class="terms-highlights mt-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="highlight-item">
                                                    <i class="bx bx-shield-check text-success me-2"></i>
                                                    <span>60 Days Money Back Guarantee</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="highlight-item">
                                                    <i class="bx bx-support text-primary me-2"></i>
                                                    <span>24/7 Customer Support</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Button -->
                            <div class="payment-button-section">
                                <button id="payButton" class="btn btn-payment w-100" disabled>
                                    <div class="btn-content">
                                        <i class="bx bx-lock me-2"></i>
                                        <span class="btn-text">Complete Secure Payment - ₹18,000/-</span>
                                        <div class="btn-loader">
                                            <i class="bx bx-loader-alt bx-spin"></i>
                                        </div>
                                    </div>
                                </button>
                                <div class="payment-note">
                                    <i class="bx bx-info-circle me-1"></i>
                                    You will be redirected to a secure payment gateway
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods Card -->
                    <div class="card professional-card">
                        <div class="card-body p-4">
                            <h6 class="section-title mb-3">
                                <i class="bx bx-credit-card me-2"></i>Secure Payment Options
                            </h6>
                            <div class="payment-methods">
                                <div class="row text-center">
                                    <div class="col-6 col-md-3 mb-3">
                                        <div class="payment-method">
                                            <div class="payment-icon">
                                                <i class="bx bx-credit-card"></i>
                                            </div>
                                            <div class="payment-label">Credit/Debit Cards</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 mb-3">
                                        <div class="payment-method">
                                            <div class="payment-icon">
                                                <i class="bx bx-mobile"></i>
                                            </div>
                                            <div class="payment-label">UPI</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 mb-3">
                                        <div class="payment-method">
                                            <div class="payment-icon">
                                                <i class="bx bx-wallet"></i>
                                            </div>
                                            <div class="payment-label">Net Banking</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3 mb-3">
                                        <div class="payment-method">
                                            <div class="payment-icon">
                                                <i class="bx bx-qr"></i>
                                            </div>
                                            <div class="payment-label">QR Code</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="security-features mt-4">
                                    <div class="row text-center">
                                        <div class="col-md-4">
                                            <div class="security-item">
                                                <i class="bx bx-shield-check text-success mb-2"></i>
                                                <div class="security-text">256-bit SSL Encryption</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="security-item">
                                                <i class="bx bx-check-shield text-primary mb-2"></i>
                                                <div class="security-text">PCI DSS Compliant</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="security-item">
                                                <i class="bx bx-lock-alt text-warning mb-2"></i>
                                                <div class="security-text">Secure Gateway</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary Sidebar -->
                <div class="col-lg-4">
                    <div class="card professional-card sticky-top">
                        <div class="card-header professional-header summary-header">
                            <h6 class="mb-0 header-title">
                                <i class="bx bx-receipt me-2"></i>Order Summary
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="summary-item">
                                <div class="summary-icon">
                                    <img src="{{ asset('theme/assets/images/products/moneybackguarantee.png') }}" alt="Package" class="summary-package-icon">
                                </div>
                                <div class="summary-details">
                                    <div class="summary-title">60 Days Money Back Guarantee</div>
                                    <div class="summary-subtitle">Complete Combo Plan</div>
                                </div>
                            </div>
                            
                            <div class="summary-features">
                                <div class="feature-check">
                                    <i class="bx bx-check text-success me-2"></i>
                                    <span>Highlight Resume (3x visibility)</span>
                                </div>
                                <div class="feature-check">
                                    <i class="bx bx-check text-success me-2"></i>
                                    <span>Instant SMS Job Alerts</span>
                                </div>
                                <div class="feature-check">
                                    <i class="bx bx-check text-success me-2"></i>
                                    <span>Direct Resume Blaster</span>
                                </div>
                                <div class="feature-check">
                                    <i class="bx bx-check text-success me-2"></i>
                                    <span>Priority Customer Support</span>
                                </div>
                            </div>
                            
                            <div class="summary-total">
                                <div class="total-label">Total Amount</div>
                                <div class="total-amount">₹18,000/-</div>
                            </div>
                            
                            <div class="guarantee-badge">
                                <i class="bx bx-shield-check me-2"></i>
                                <span>60 Days Money Back Guarantee</span>
                            </div>

                            <div class="support-info">
                                <div class="support-title">Need Help?</div>
                                <div class="support-contact">
                                    <i class="bx bx-phone me-2"></i>+91 98765 43210
                                </div>
                                <div class="support-contact">
                                    <i class="bx bx-envelope me-2"></i>support@example.com
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

    /* Checkout Wrapper */
    .checkout-wrapper {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Progress Steps */
    .progress-section {
        background: #ffffff;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    }

    .progress-steps {
        display: flex;
        align-items: center;
        justify-content: center;
        max-width: 600px;
        margin: 0 auto;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    .step-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #9ca3af;
        transition: all 0.3s ease;
        margin-bottom: 8px;
    }

    .step.completed .step-circle {
        background: linear-gradient(135deg, #059669, #10b981);
        color: #ffffff;
    }

    .step.active .step-circle {
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        color: #ffffff;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
    }

    .step-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #6b7280;
        text-align: center;
    }

    .step.completed .step-label,
    .step.active .step-label {
        color: #374151;
        font-weight: 600;
    }

    .step-line {
        width: 100px;
        height: 3px;
        background: #e5e7eb;
        margin: 0 16px;
        margin-top: -33px;
        position: relative;
        z-index: 1;
    }

    .step-line.completed {
        background: linear-gradient(135deg, #059669, #10b981);
    }

    /* Professional Card Styling */
    .professional-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
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

    .checkout-header {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
    }

    .summary-header {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .header-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .security-badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        display: flex;
        align-items: center;
    }

    /* Section Styling */
    .section-title {
        color: #374151;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        padding-bottom: 8px;
        border-bottom: 2px solid #f1f5f9;
    }

    /* Customer Info */
    .customer-info-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 20px;
    }

    .info-item {
        margin-bottom: 16px;
    }

    .info-label {
        font-size: 0.875rem;
        font-weight: 500;
        color: #6b7280;
        margin-bottom: 4px;
        display: block;
    }

    .info-value {
        font-size: 1rem;
        font-weight: 600;
        color: #374151;
    }

    /* Package Details */
    .package-details-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 20px;
    }

    .package-header {
        margin-bottom: 16px;
    }

    .package-icon {
        width: 60px;
        height: auto;
    }

    .package-name {
        color: #374151;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 4px;
    }

    .package-description {
        color: #6b7280;
        font-size: 0.9rem;
    }

    .package-badge .badge-premium {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #ffffff;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .package-features {
        padding-top: 16px;
        border-top: 1px solid #e2e8f0;
    }

    .feature-item {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
    }

    /* Pricing Card */
    .pricing-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 20px;
    }

    .pricing-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
    }

    .pricing-label {
        font-size: 0.9rem;
        color: #6b7280;
        font-weight: 500;
    }

    .pricing-value {
        font-size: 0.9rem;
        font-weight: 600;
        color: #374151;
    }

    .discount-row .pricing-label {
        color: #059669;
    }

    .pricing-divider {
        margin: 16px 0;
        border-color: #e2e8f0;
    }

    .total-row {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        margin: 0 -20px;
        padding: 16px 20px;
        border-radius: 8px;
    }

    .total-row .pricing-label {
        font-size: 1rem;
        font-weight: 600;
        color: #1e40af;
    }

    .total-amount {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e40af;
    }

    /* Terms Section */
    .terms-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 20px;
    }

    .form-check-input {
        width: 1.2rem;
        height: 1.2rem;
        margin-right: 8px;
    }

    .form-check-label {
        font-size: 0.9rem;
        color: #374151;
        line-height: 1.5;
    }

    .terms-link {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
    }

    .terms-link:hover {
        color: #2563eb;
        text-decoration: underline;
    }

    .terms-highlights {
        padding-top: 16px;
        border-top: 1px solid #e2e8f0;
    }

    .highlight-item {
        display: flex;
        align-items: center;
        font-size: 0.85rem;
        color: #374151;
        margin-bottom: 8px;
    }

    /* Payment Button */
    .payment-button-section {
        text-align: center;
    }

    .btn-payment {
        background: linear-gradient(135deg, #059669, #047857);
        border: none;
        border-radius: 12px;
        padding: 16px 24px;
        font-size: 1.1rem;
        font-weight: 600;
        color: #ffffff;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-payment:hover:not(:disabled) {
        background: linear-gradient(135deg, #047857, #065f46);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(5, 150, 105, 0.4);
    }

    .btn-payment:disabled {
        background: #9ca3af;
        cursor: not-allowed;
    }

    .btn-content {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-loader {
        display: none;
    }

    .btn-payment.loading .btn-text {
        display: none;
    }

    .btn-payment.loading .btn-loader {
        display: block;
    }

    .payment-note {
        margin-top: 12px;
        font-size: 0.85rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Payment Methods */
    .payment-method {
        padding: 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        background: #fafafa;
    }

    .payment-method:hover {
        border-color: #3b82f6;
        background: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .payment-icon {
        font-size: 2rem;
        color: #64748b;
        margin-bottom: 8px;
    }

    .payment-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #374151;
    }

    .security-features {
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
    }

    .security-item {
        text-align: center;
    }

    .security-item i {
        font-size: 2rem;
        display: block;
    }

    .security-text {
        font-size: 0.8rem;
        color: #6b7280;
        font-weight: 500;
    }

    /* Order Summary Sidebar */
    .summary-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f1f5f9;
    }

    .summary-package-icon {
        width: 50px;
        height: auto;
        margin-right: 12px;
    }

    .summary-title {
        font-weight: 600;
        color: #374151;
        font-size: 0.95rem;
        line-height: 1.3;
    }

    .summary-subtitle {
        font-size: 0.8rem;
        color: #6b7280;
    }

    .summary-features {
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f1f5f9;
    }

    .feature-check {
        display: flex;
        align-items: center;
        font-size: 0.85rem;
        color: #374151;
        margin-bottom: 8px;
    }

    .summary-total {
        text-align: center;
        padding: 16px;
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border-radius: 8px;
        margin-bottom: 16px;
    }

    .total-label {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .summary-total .total-amount {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e40af;
    }

    .guarantee-badge {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #065f46;
        padding: 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .support-info {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 16px;
        text-align: center;
    }

    .support-title {
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .support-contact {
        font-size: 0.8rem;
        color: #6b7280;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Responsive Design */
    @media (max-width: 767.98px) {
        .professional-bg {
            background: #f8fafc;
        }

        .progress-steps {
            flex-direction: column;
            gap: 16px;
        }

        .step-line {
            width: 3px;
            height: 40px;
            margin: 8px 0;
        }

        .step-line.completed {
            background: linear-gradient(180deg, #059669, #10b981);
        }

        .checkout-wrapper {
            padding: 0 16px;
        }

        .customer-info-card,
        .package-details-card,
        .pricing-card,
        .terms-card {
            padding: 16px;
        }

        .package-features .row > div {
            margin-bottom: 8px;
        }

        .payment-methods .row > div {
            margin-bottom: 16px;
        }

        .btn-payment {
            padding: 14px 20px;
            font-size: 1rem;
        }

        .breadcrumb-title {
            font-size: 1rem;
        }

        .enhanced-breadcrumb {
            padding: 12px 16px;
        }

        .professional-header {
            padding: 12px 16px;
            flex-direction: column;
            gap: 8px;
            text-align: center;
        }

        .header-title {
            font-size: 0.95rem;
        }
    }

    /* Sticky positioning for sidebar */
    .sticky-top {
        top: 20px;
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .professional-card {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Focus states for accessibility */
    .form-check-input:focus,
    .btn-payment:focus {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
    }

    .breadcrumb-link:focus {
        outline: 2px solid #4f46e5;
        outline-offset: 2px;
        border-radius: 4px;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const termsCheck = document.getElementById('termsCheck');
    const payButton = document.getElementById('payButton');
    
    // Enable/disable payment button based on terms acceptance
    termsCheck.addEventListener('change', function() {
        payButton.disabled = !this.checked;
        
        if (this.checked) {
            payButton.classList.add('terms-accepted');
        } else {
            payButton.classList.remove('terms-accepted');
        }
    });

    // Payment button click handler
    payButton.addEventListener('click', function() {
        if (!termsCheck.checked) {
            alert('Please accept the terms and conditions to proceed.');
            return;
        }

        // Add loading state
        this.classList.add('loading');
        this.disabled = true;

        // Simulate payment processing
        setTimeout(() => {
            // Here you would integrate with your actual payment gateway
            // For demo purposes, we'll show an alert
            alert('Redirecting to secure payment gateway...');
            
            // Reset button state (remove in production)
            this.classList.remove('loading');
            this.disabled = false;
        }, 2000);
    });

    // Add smooth scroll to top when page loads
    window.scrollTo({ top: 0, behavior: 'smooth' });

    // Auto-focus on terms checkbox if user scrolls to it
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !termsCheck.checked) {
                entry.target.style.border = '2px solid #3b82f6';
                setTimeout(() => {
                    entry.target.style.border = '';
                }, 2000);
            }
        });
    }, { threshold: 0.5 });

    observer.observe(document.querySelector('.terms-card'));

    // Add payment method selection (for future enhancement)
    const paymentMethods = document.querySelectorAll('.payment-method');
    paymentMethods.forEach(method => {
        method.addEventListener('click', function() {
            paymentMethods.forEach(m => m.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
});

// Add CSS for selected payment method
const style = document.createElement('style');
style.textContent = `
    .payment-method.selected {
        border-color: #3b82f6 !important;
        background: #eff6ff !important;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2) !important;
    }
    
    .payment-method.selected .payment-icon {
        color: #3b82f6 !important;
    }
    
    .btn-payment.terms-accepted {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(5, 150, 105, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(5, 150, 105, 0); }
        100% { box-shadow: 0 0 0 0 rgba(5, 150, 105, 0); }
    }
`;
document.head.appendChild(style);
</script>

@endsection
