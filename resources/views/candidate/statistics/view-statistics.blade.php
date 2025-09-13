@extends('layouts.app')
@section('content')
<main class="page-content">
    <div class="container py-4">
        <div class="card shadow-sm border-0" style="max-width: 700px; margin: 0 auto;">
            <!-- Header -->
            <div class="card-header bg-white border-bottom-0 pt-4">
                <h3 class="text-center fw-bold" style="color: #2c3e50;">3rd Off Vacancy</h3>
                <div class="text-center mt-2">
                    <span class="badge bg-primary">NAUTAI MARINE</span>
                    <span class="badge bg-secondary ms-2">RPSL-MUM-1006</span>
                </div>
            </div>

            <!-- Job Details -->
            <div class="card-body pt-0">
                <div class="job-details-grid mb-4">
                    <div class="detail-item">
                        <span class="detail-label fw-bold">Company name:</span>
                        <span class="detail-value">NAUTAI MARINE SERVICES AND TRADING PRIVATE LIMITED</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label fw-bold">Rank:</span>
                        <span class="detail-value">3rd Off</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label fw-bold">Ship type:</span>
                        <span class="detail-value">Container</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label fw-bold">Date of Joining:</span>
                        <span class="detail-value">2025-08-02</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label fw-bold">Nationality:</span>
                        <span class="detail-value">Indian</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label fw-bold">Minimum Rank Exp.:</span>
                        <span class="detail-value">6 Months</span>
                    </div>
                </div>

                <!-- Job Description -->
                <div class="job-description mb-4">
                    <h5 class="fw-bold mb-2">Job Description:</h5>
                    <p>Urgent Requirement of 3rd Off. for Container, Salary as per Market Standard.</p>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons mb-4">
                    <div class="d-flex gap-2">
                        <button class="btn btn-secondary flex-grow-1" disabled>Already Applied</button>
                        <button class="btn btn-outline-primary flex-grow-1">Candidate Reviews</button>
                    </div>
                </div>

                <!-- Important Note -->
                <div class="important-note">
                    <span class="fw-bold text-danger">Note * :</span><br>
                    Continue receiving "Instant job SMS Alert"
                    <a href="#" class="fw-bold text-danger text-decoration-underline">Click Here</a>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .card {
        border-radius: 8px;
    }
    
    .job-details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
    }
    
    .detail-item {
        padding: 0.5rem 0;
        border-bottom: 1px solid #eee;
    }
    
    .detail-label {
        display: inline-block;
        width: 160px;
        color: #555;
    }
    
    .job-description {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 6px;
    }
    
    .important-note {
        padding: 0.75rem;
        background-color: #fff8e1;
        border-radius: 6px;
        font-size: 0.9rem;
    }
    
    @media (max-width: 767.98px) {
        .job-details-grid {
            grid-template-columns: 1fr;
        }
        
        .detail-label {
            width: 140px;
        }
        
        .action-buttons .d-flex {
            flex-direction: column;
        }
        
        .action-buttons button {
            width: 100%;
        }
    }
</style>
@endsection