@extends('layouts.app')
@section('content')
<main class="page-content" style="background:#f5f7fb;">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Candidate</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('candidate.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Seafarer Express Service</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container py-4">
        <div class="card shadow border-0 mb-4">
            <div class="card-body">
                <h3 class="text-center mb-4 fw-bold" style="letter-spacing:1px;">Seafarer Express Service</h3>

                <div class="row justify-content-center mb-4">
                    <div class="col-md-5 text-center">
                        <img src="{{ asset('theme/assets/images/products/moneybackguarantee.png') }}" alt="60 Days Money Back" style="max-width:110px;">
                        <div class="fw-bold text-danger mt-2">60 Days Money Back Guarantee Combo</div>
                    </div>
                    <div class="col-md-5 text-center">
                        <img src="{{ asset('theme/assets/images/products/moneysaver.png') }}" alt="30 Days Money Saver" style="max-width:110px;">
                        <div class="fw-bold text-primary mt-2">30 Days Money Saver Combo Plan</div>
                    </div>
                </div>
                <!-- Packages -->
                <div class="mb-4">
                    <!-- Header row -->
                    <div class="d-none d-md-flex fw-bold bg-light border rounded-top p-3">
                        <div class="flex-grow-1 ps-3">Package</div>
                        <div style="width: 150px;" class="text-center">Amount</div>
                        <div style="width: 120px;" class="text-end">Action</div>
                    </div>

                    <!-- Package 1 -->
                    <div class="d-flex flex-column flex-md-row border-start border-end border-bottom align-items-start align-items-md-center p-3">
                        <div class="flex-grow-1 ps-md-3">
                            <div class="fw-semibold mb-1">30 Days Money Saver Combo Plan</div>
                            <span class="text-muted small d-block">(Highlight Resume + Job Alert + Resume Blaster)</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-center mt-3 mt-md-0 ms-md-4" style="width: 150px;">
                            <div class="fw-bold">INR 10,000/-</div>
                        </div>

                        <div class="mt-3 mt-md-0 ms-md-4" style="width: 120px;">
                        <a href="{{ route('candidate.express.pay.form', ['service' => 'combo-30']) }}">Pay</a>
                        </div>
                    </div>

                    <!-- Package 2 -->
                    <div class="d-flex flex-column flex-md-row border-start border-end border-bottom align-items-start align-items-md-center p-3">
                        <div class="flex-grow-1 ps-md-3">
                            <div class="fw-semibold mb-1">60 Days Money Back Guarantee Combo Plan</div>
                            <span class="text-muted small d-block">(Highlight Resume + Job Alert + Resume Blaster)</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-center mt-3 mt-md-0 ms-md-4" style="width: 150px;">
                            <div class="fw-bold">INR 18,000/-</div>
                        </div>

                       <div class="mt-3 mt-md-0 ms-md-4" style="width: 120px;">
                        <a href="{{ route('candidate.express.pay.form', ['service' => 'combo-60']) }}">Pay</a>
                        </div>
                    </div>
                </div>

                <!-- Feature cards: separated -->
                <div class="row text-center g-3">
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100">
                            <div class="fw-bold text-danger mb-2" style="font-size:1.1rem;">Highlight Resume</div>
                            <div class="small">
                                Highlight Profile to Recruiters. Stand out and get noticed in recruiter eyes.<br>
                                <span class="fw-semibold">Increase your profile views up to 3 times.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100">
                            <div class="fw-bold text-warning mb-2" style="font-size:1.1rem;">Resume Blaster</div>
                            <div class="small">
                                Direct Access<br>
                                Send Your Resume directly to the Company of your choice.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 h-100">
                            <div class="fw-bold text-danger mb-2" style="font-size:1.1rem;">SMS Job Alert</div>
                            <div class="small">
                                Be the First to Apply for the Job Opening.<br>
                                <span class="fw-semibold">Get Notified Within 30 Minutes of Job Posting through SMS Notification.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Feature Cards -->
            </div>
        </div>
    </div>
</main>
@endsection
