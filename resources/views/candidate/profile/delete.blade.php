@extends('layouts.candidate.app')
@section('content')
<main class="page-content">
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
                        <i class="bx bx-trash me-1"></i>Delete Profile Request
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-12">

                <!-- Success / Error alerts -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show success-alert mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="success-icon me-3">
                            <i class="bx bx-check-circle"></i>
                        </div>
                        <div class="success-content flex-grow-1">
                            <h5 class="alert-heading mb-1">
                                <i class="bx bx-party me-2"></i>Request Submitted Successfully!
                            </h5>
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show error-alert mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="error-icon me-3">
                            <i class="bx bx-error-circle"></i>
                        </div>
                        <div class="error-content flex-grow-1">
                            <h5 class="alert-heading mb-1">
                                <i class="bx bx-x-circle me-2"></i>Request Failed
                            </h5>
                            <p class="mb-0">{{ session('error') }}</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i>Delete Profile Request</h4>
                    </div>
                    <div class="card-body">

                        @php
                            // controller should pass $deleteRequest (nullable ProfileDeleteRequest model)
                            $hasRequest = isset($deleteRequest) && $deleteRequest;
                            // once a request exists (pending/processed/cancelled) we disable new submissions except cancelled (optional)
                            $disableRequest = $hasRequest && ($deleteRequest->status !== 'cancelled');
                        @endphp

                        @if($hasRequest)
                            <div class="mb-4">
                                <div class="alert alert-info">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <strong>Request Status:</strong>
                                            @if($deleteRequest->status === 'pending')
                                                <span class="badge bg-warning text-dark ms-2">Pending</span>
                                            @elseif($deleteRequest->status === 'processed')
                                                <span class="badge bg-success ms-2">Processed</span>
                                            @elseif($deleteRequest->status === 'cancelled')
                                                <span class="badge bg-secondary ms-2">Cancelled</span>
                                            @else
                                                <span class="badge bg-secondary ms-2">{{ ucfirst($deleteRequest->status) }}</span>
                                            @endif

                                            <div class="mt-2">
                                                <small><strong>Reason:</strong> {{ $deleteRequest->reason ?? '—' }}</small><br>
                                                @if(!empty($deleteRequest->other_reason))
                                                    <small><strong>Details:</strong> {{ $deleteRequest->other_reason }}</small><br>
                                                @endif
                                                <small><strong>Submitted:</strong> {{ $deleteRequest->created_at ? $deleteRequest->created_at->format('d M Y, H:i') : '—' }}</small>
                                                @if($deleteRequest->processed_at)
                                                    <br><small><strong>Processed:</strong> {{ $deleteRequest->processed_at->format('d M Y, H:i') }} by {{ optional($deleteRequest->processor)->first_name ?? optional($deleteRequest->processor)->email ?? 'Admin' }}</small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            @if($deleteRequest->status === 'pending')
                                                <small class="text-muted">Your request is under review.</small>
                                            @elseif($deleteRequest->status === 'processed')
                                                <small class="text-success">Your profile has been removed from visibility.</small>
                                            @elseif($deleteRequest->status === 'cancelled')
                                                <small class="text-muted">You may submit a new request.</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('candidate.profile.delete.confirm') }}" id="deleteProfileForm">
                            @csrf

                            <fieldset @if($disableRequest) disabled @endif aria-disabled="{{ $disableRequest ? 'true' : 'false' }}">

                                <div class="mb-4">
                                    <label class="form-label fw-bold mb-3">Please select a reason for deleting your profile:</label>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="reason" id="duplication" value="Duplication" {{ old('reason') == 'Duplication' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="duplication">Duplication</label>
                                    </div>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="reason" id="retired" value="Retired / Quit sailing" {{ old('reason') == 'Retired / Quit sailing' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="retired">Retired / Quit sailing</label>
                                    </div>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="reason" id="unsatisfactory" value="Service Unsatisfactory" {{ old('reason') == 'Service Unsatisfactory' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="unsatisfactory">Service Unsatisfactory</label>
                                    </div>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="reason" id="not-required" value="Service no longer required" {{ old('reason') == 'Service no longer required' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="not-required">Service no longer required</label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="reason" id="other" value="Other" {{ old('reason') == 'Other' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="other">Other (comment box for reason)</label>
                                    </div>

                                    <div id="otherReasonBox" style="display:none;">
                                        <textarea name="other_reason" class="form-control bg-white bg-opacity-25 border-1 border-warning mt-2" rows="3" placeholder="Other (comment box for reason)">{{ old('other_reason') }}</textarea>
                                    </div>
                                </div>

                                <div class="alert alert-warning text-center fw-bold mb-4" style="font-size:1.1rem;">
                                    By clicking the <span class="text-danger">Delete Profile Request</span> button, your request will be sent to our customer care.<br>
                                    You might receive a call or email for your request verification.
                                </div>

                                <div class="d-flex justify-content-center">
                                    @if($disableRequest)
                                        <button type="button" class="btn btn-secondary px-5 fw-bold" id="submitBtn" disabled>
                                            <i class="bi bi-hourglass-split me-1"></i> Request Submitted
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-danger px-5 fw-bold" id="submitBtn">
                                            <i class="bi bi-trash me-1"></i> Delete Profile Request
                                        </button>
                                    @endif
                                </div>

                            </fieldset>
                        </form>

                        <div class="mt-4 text-center text-muted small">
                            If you have any concerns, please <a href="mailto:support@yourdomain.com">contact support</a>.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<style>
    /* Enhanced Breadcrumb Styling */
    .enhanced-breadcrumb {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 12px 20px;
        border-radius: 10px;
        border: 1px solid #dee2e6;
    }

    .breadcrumb-link {
        color: #0d6efd;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .breadcrumb-link:hover {
        color: #0a58ca;
        transform: translateX(2px);
    }

    .breadcrumb-title {
        font-weight: 600;
        color: #495057;
        font-size: 1.1rem;
    }

    /* Success Alert Styling */
    .success-alert {
        background: linear-gradient(135deg, #d1edff 0%, #e8f5e8 100%);
        border: 1px solid #28a745;
        border-radius: 12px;
        padding: 20px;
        animation: slideInDown 0.6s ease-out;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
    }

    .success-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .success-icon i {
        font-size: 1.5rem;
        color: white;
    }

    .success-content .alert-heading {
        color: #155724;
        font-weight: 600;
        margin: 0;
    }

    .success-content p {
        color: #155724;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* Error Alert Styling */
    .error-alert {
        background: linear-gradient(135deg, #ffe6e6 0%, #fff0f0 100%);
        border: 1px solid #dc3545;
        border-radius: 12px;
        padding: 20px;
        animation: slideInDown 0.6s ease-out;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);
    }

    .error-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .error-icon i {
        font-size: 1.5rem;
        color: white;
    }

    .error-content .alert-heading {
        color: #721c24;
        font-weight: 600;
        margin: 0;
    }

    .error-content p {
        color: #721c24;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* Form enhancements */
    #submitBtn {
        transition: all 0.3s ease;
    }

    #submitBtn:disabled {
        background: #6c757d;
        border-color: #6c757d;
        cursor: not-allowed;
    }

    #submitBtn.loading {
        position: relative;
    }

    #submitBtn.loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        top: 50%;
        left: 20px;
        transform: translateY(-50%);
    }

    /* Animations */
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes spin {
        from {
            transform: translateY(-50%) rotate(0deg);
        }
        to {
            transform: translateY(-50%) rotate(360deg);
        }
    }

    /* Auto-hide animation */
    .alert.fade-out {
        animation: fadeOut 0.5s ease-out forwards;
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .success-alert, .error-alert {
            padding: 15px;
        }

        .success-icon, .error-icon {
            width: 40px;
            height: 40px;
        }

        .success-icon i, .error-icon i {
            font-size: 1.2rem;
        }

        .success-content .alert-heading,
        .error-content .alert-heading {
            font-size: 1rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input[name="reason"]');
    const otherBox = document.getElementById('otherReasonBox');
    const form = document.getElementById('deleteProfileForm');
    const submitBtn = document.getElementById('submitBtn');

    // show/hide other reason box (works even when fieldset disabled for accessibility)
    radios.forEach(radio => {
        radio.addEventListener('change', function () {
            if (this.value === 'Other') {
                otherBox.style.display = 'block';
            } else {
                otherBox.style.display = 'none';
            }
        });

        // reveal if page loaded with old value or existing request had "Other"
        if (radio.checked && radio.value === 'Other') {
            otherBox.style.display = 'block';
        }
    });

    // prevent double submit and show loading only when form is enabled
    if (form && submitBtn && !submitBtn.disabled) {
        form.addEventListener('submit', function(e) {
            const selectedReason = document.querySelector('input[name="reason"]:checked');

            if (!selectedReason) {
                e.preventDefault();
                alert('Please select a reason for deleting your profile.');
                return;
            }

            if (selectedReason.value === 'Other') {
                const otherReason = document.querySelector('textarea[name="other_reason"]').value.trim();
                if (!otherReason) {
                    e.preventDefault();
                    alert('Please provide your specific reason.');
                    return;
                }
            }

            submitBtn.disabled = true;
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i>Processing Request...';
        });
    }

    // auto-hide alerts (existing behavior)
    const alerts = document.querySelectorAll('.alert.success-alert, .alert.error-alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('fade-out');
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 500);
        }, 8000);
    });
});
</script>
@endsection
