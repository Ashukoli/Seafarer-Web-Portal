{{-- resources/views/admin/candidates/show.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Candidate: ' . ($candidate->name ?? 'Details'))

@section('content')
<main class="page-content">
    <div class="page-breadcrumb mb-3 d-flex align-items-center">
        <div>
            <h4 class="mb-0">Candidate: {{ $candidate->name }}</h4>
            <small class="text-muted">ID: {{ $candidate->id }} &middot; Registered: {{ $candidate->created_at ? $candidate->created_at->format('Y-m-d') : '-' }}</small>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.candidates.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('admin.candidates.edit', $candidate->id) ?? '#' }}" class="btn btn-warning ms-2">Edit</a>
            <form action="{{ route('admin.candidates.destroy', $candidate->id) ?? '#' }}" method="POST" class="d-inline-block ms-2" onsubmit="return confirm('Delete this candidate?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <div class="row g-3">
        {{-- Left column: summary / profile pic --}}
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body text-center">
                    @if(optional($candidate->profile)->profile_pic)
                        <img src="{{ asset(optional($candidate->profile)->profile_pic) }}" alt="Profile" class="img-fluid rounded mb-3" style="max-height:180px;">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" style="height:180px;">
                            <i class="bx bx-user fs-1 text-muted"></i>
                        </div>
                    @endif

                    <h5 class="mb-0">{{ $candidate->name }}</h5>
                    <small class="text-muted d-block mb-2">{{ optional($candidate->profile)->marital_status ? ucfirst(optional($candidate->profile)->marital_status) : '' }}</small>

                    <div class="text-start">
                        <p class="mb-1"><strong>Email:</strong> {{ $candidate->email ?? '-' }}</p>
                        <p class="mb-1"><strong>Mobile:</strong> {{ optional($candidate->profile)->mobile_number ?? '-' }}</p>
                        <p class="mb-1"><strong>WhatsApp:</strong> {{ optional($candidate->profile)->whatsapp_number ?? '-' }}</p>
                        <p class="mb-1"><strong>Nationality:</strong>
                            @if(optional($candidate->profile)->nationality)
                                {{ optional(\App\Models\Country::find(optional($candidate->profile)->nationality))->country_name ?? optional($candidate->profile)->nationality }}
                            @else
                                -
                            @endif
                        </p>

                        <p class="mb-1"><strong>DOB:</strong> {{ optional($candidate->profile)->dob ? \Carbon\Carbon::parse($candidate->profile->dob)->format('Y-m-d') : '-' }}</p>
                        <p class="mb-1"><strong>Age:</strong> {{ optional($candidate->profile)->dob ? \Carbon\Carbon::parse($candidate->profile->dob)->age : '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- quick stats --}}
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-2">Quick Info</h6>
                    <p class="mb-1"><strong>Seafarer ID:</strong> {{ optional($candidate->profile)->seafarer_id ?? '-' }}</p>
                    <p class="mb-1"><strong>Indos:</strong> {{ optional($candidate->resume)->indos_number ?? '-' }}</p>
                    <p class="mb-1"><strong>Available From:</strong> {{ optional($candidate->resume)->date_of_availability ? \Carbon\Carbon::parse($candidate->resume->date_of_availability)->format('Y-m-d') : '-' }}</p>
                    <p class="mb-1"><strong>Status:</strong> {{ ucfirst($candidate->status ?? 'N/A') }}</p>
                </div>
            </div>
        </div>

        {{-- Right column: detailed sections --}}
        <div class="col-lg-8">
            {{-- Profile & Experience --}}
            <div class="card mb-3">
                <div class="card-header"><strong>Profile & Experience</strong></div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Present Rank:</strong>
                                @php
                                    $presentRankLabel = '-';
                                    if(optional($candidate->resume)->present_rank) {
                                        $presentRankLabel = optional($candidate->resume->presentRank)->rank ?? $candidate->resume->present_rank;
                                    } elseif($candidate->present_rank) {
                                        $presentRankLabel = optional($candidate->presentRank)->rank ?? $candidate->present_rank;
                                    }
                                @endphp
                                {{ $presentRankLabel }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Present Rank Experience:</strong> {{ optional($candidate->resume)->present_rank_exp ?? '-' }}</p>
                        </div>

                        <div class="col-md-6">
                            <p class="mb-1"><strong>Post Applied For:</strong>
                                @if(optional($candidate->resume)->post_applied_for)
                                    {{ optional(\App\Models\Rank::find(optional($candidate->resume)->post_applied_for))->rank ?? optional($candidate->resume)->post_applied_for }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>

                        <div class="col-md-6">
                            <p class="mb-1"><strong>Total Experience:</strong> -</p>
                        </div>

                        <div class="col-12">
                            <p class="mb-1"><strong>Address:</strong> {{ optional($candidate->profile)->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Documents --}}
            <div class="card mb-3">
                <div class="card-header"><strong>Documents</strong></div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-4"><p class="mb-1"><strong>Passport No:</strong> {{ optional($candidate->resume)->passport_number ?? '-' }}</p></div>
                        <div class="col-md-4"><p class="mb-1"><strong>Passport Nationality:</strong> {{ optional(\App\Models\Country::find(optional($candidate->resume)->passport_nationality))->country_name ?? optional($candidate->resume)->passport_nationality ?? '-' }}</p></div>
                        <div class="col-md-4"><p class="mb-1"><strong>Passport Expiry:</strong> {{ optional($candidate->resume)->passport_expiry ? \Carbon\Carbon::parse($candidate->resume->passport_expiry)->format('Y-m-d') : '-' }}</p></div>

                        <div class="col-md-4"><p class="mb-1"><strong>CDC No:</strong> {{ optional($candidate->resume)->cdc_no ?? '-' }}</p></div>
                        <div class="col-md-4"><p class="mb-1"><strong>CDC Nationality:</strong> {{ optional(\App\Models\Country::find(optional($candidate->resume)->cdc_nationality))->country_name ?? optional($candidate->resume)->cdc_nationality ?? '-' }}</p></div>
                        <div class="col-md-4"><p class="mb-1"><strong>CDC Expiry:</strong> {{ optional($candidate->resume)->cdc_expiry ? \Carbon\Carbon::parse($candidate->resume->cdc_expiry)->format('Y-m-d') : '-' }}</p></div>

                        <div class="col-md-4"><p class="mb-1"><strong>USA Visa:</strong> {{ optional($candidate->resume)->usa_visa ? 'Yes' : 'No' }}</p></div>
                    </div>
                </div>
            </div>

            {{-- Pre-sea / COC --}}
            <div class="card mb-3">
                <div class="card-header"><strong>Pre-Sea & COC</strong></div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-4"><p class="mb-1"><strong>Pre-Sea Type:</strong> {{ optional($candidate->resume)->presea_training_type ?? '-' }}</p></div>
                        <div class="col-md-4"><p class="mb-1"><strong>Issue Date:</strong> {{ optional($candidate->resume)->presea_training_issue_date ? \Carbon\Carbon::parse($candidate->resume->presea_training_issue_date)->format('Y-m-d') : '-' }}</p></div>

                        <div class="col-md-4"><p class="mb-1"><strong>COC Held (Country):</strong> {{ optional(\App\Models\Country::find(optional($candidate->resume)->coc_held))->country_name ?? optional($candidate->resume)->coc_held ?? '-' }}</p></div>
                        <div class="col-md-4"><p class="mb-1"><strong>COC No:</strong> {{ optional($candidate->resume)->coc_no ?? '-' }}</p></div>
                        <div class="col-md-4"><p class="mb-1"><strong>COC Grade:</strong> {{ optional($candidate->resume)->coc_grade ?? '-' }}</p></div>
                        <div class="col-md-4"><p class="mb-1"><strong>COC Type:</strong> {{ optional($candidate->resume)->coc_type ?? '-' }}</p></div>
                        <div class="col-md-4"><p class="mb-1"><strong>COC Expiry:</strong> {{ optional($candidate->resume)->coc_date_of_expiry ? \Carbon\Carbon::parse($candidate->resume->coc_date_of_expiry)->format('Y-m-d') : '-' }}</p></div>
                    </div>
                </div>
            </div>

            {{-- GMDSS / DCE & Courses --}}
            <div class="card mb-3">
                <div class="card-header"><strong>GMDSS / DCE & Courses</strong></div>
                <div class="card-body">
                    {{-- DCEs (if you store CandidateDceEndorsement model with relationship) --}}
                    @if(isset($candidate->dceEndorsements) && $candidate->dceEndorsements->isNotEmpty())
                        <h6>DCE / GMDSS</h6>
                        <ul>
                            @foreach($candidate->dceEndorsements as $dce)
                                <li>{{ optional($dce->dce)->dce_name ?? $dce->dce_id }} — Validity: {{ $dce->validity_date ? \Carbon\Carbon::parse($dce->validity_date)->format('Y-m-d') : '-' }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Courses (if you have CandidateCourseCertificate relationship) --}}
                    @if(isset($candidate->courseCertificates) && $candidate->courseCertificates->isNotEmpty())
                        <h6>Courses</h6>
                        <ul>
                            @foreach($candidate->courseCertificates as $c)
                                <li>{{ optional($c->course)->name ?? $c->course_id }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mb-0 text-muted">No courses recorded.</p>
                    @endif
                </div>
            </div>

            {{-- Sea Service --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Sea Service</strong>
                    <a href="#" class="btn btn-sm btn-outline-primary">Add Sea Service</a>
                </div>
                <div class="card-body">
                    @if(optional($candidate->seaServiceDetails)->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Rank</th>
                                        <th>Ship Type</th>
                                        <th>Ship Name</th>
                                        <th>Company</th>
                                        <th>Sign On</th>
                                        <th>Sign Off</th>
                                        <th>GRT</th>
                                        <th>BHP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($candidate->seaServiceDetails as $ss)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ optional($ss->rank)->rank ?? $ss->rank_id ?? '-' }}</td>
                                            <td>{{ optional($ss->shipType)->ship_name ?? $ss->ship_type_id ?? '-' }}</td>
                                            <td>{{ $ss->ship_name ?? '-' }}</td>
                                            <td>{{ $ss->company_name ?? '-' }}</td>
                                            <td>{{ $ss->sign_on ? \Carbon\Carbon::parse($ss->sign_on)->format('Y-m-d') : '-' }}</td>
                                            <td>{{ $ss->sign_off ? \Carbon\Carbon::parse($ss->sign_off)->format('Y-m-d') : '-' }}</td>
                                            <td>
                                                @if(isset($ss->grt_unit) || isset($ss->grt_value))
                                                    {{ $ss->grt_value ?? '-' }} {{ $ss->grt_unit ?? '' }}
                                                @else
                                                    {{ $ss->grt ?? $ss->tonnage ?? '-' }}
                                                @endif
                                            </td>
                                            <td>{{ $ss->bhp ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No sea service records found.</p>
                    @endif
                </div>
            </div>

            {{-- Additional Information --}}
            <div class="card mb-3">
                <div class="card-header"><strong>Additional Information</strong></div>
                <div class="card-body">
                    <p class="mb-0">{!! nl2br(e(optional($candidate->resume)->additional_information ?? '-')) !!}</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
