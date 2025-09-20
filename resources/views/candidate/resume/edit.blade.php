{{-- resources/views/candidate/resume/edit.blade.php --}}
@extends('layouts.candidate.app')

@section('content')
<main class="page-content">
    {{-- Breadcrumb & messages --}}
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3"><i class="bx bx-user-circle me-2 text-primary"></i>Candidate</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 enhanced-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('candidate.dashboard') }}"><i class="bx bx-home-alt me-1"></i>Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="bx bx-file-text me-1"></i>Edit Resume</li>
                </ol>
            </nav>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('candidate.resume.update') }}" enctype="multipart/form-data" id="resumeForm">
        @csrf

        {{-- Progress card (top) --}}
        <div class="card mb-4">
            <div class="card-body">
                <div class="progress-steps" id="progressSteps">
                    <div class="step clickable-step" id="step1" data-step="personal">
                        <div class="step-number">1</div>
                        <div class="step-title">Personal</div>
                    </div>

                    <div class="step clickable-step" id="step2" data-step="profile">
                        <div class="step-number">2</div>
                        <div class="step-title">Profile</div>
                    </div>

                    <div class="step clickable-step" id="step3" data-step="documents">
                        <div class="step-number">3</div>
                        <div class="step-title">Documents</div>
                    </div>

                    <div class="step clickable-step" id="step4" data-step="presea">
                        <div class="step-number">4</div>
                        <div class="step-title">Pre-Sea</div>
                    </div>

                    <div class="step clickable-step" id="step5" data-step="gmdss">
                        <div class="step-number">5</div>
                        <div class="step-title">GMDSS</div>
                    </div>

                    <div class="step clickable-step" id="step6" data-step="courses">
                        <div class="step-number">6</div>
                        <div class="step-title">Courses</div>
                    </div>

                    <div class="step clickable-step" id="step7" data-step="seaservice">
                        <div class="step-number">7</div>
                        <div class="step-title">Sea Service</div>
                    </div>

                    <div class="step clickable-step" id="step8" data-step="additional">
                        <div class="step-number">8</div>
                        <div class="step-title">Additional</div>
                    </div>

                    <div class="progress-line">
                        <div class="progress-bar" id="mainProgressBar" style="width:12.5%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Step 1: Personal --}}
        <div class="card mb-4 step-card" id="step-personal">
            <div class="card-header bg-light"><h5 class="mb-0">Personal Details</h5></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">First Name</label>
                        <input name="first_name" class="form-control" value="{{ old('first_name', $user->profile->first_name ?? $user->first_name ?? '') }}">
                        @error('first_name')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Middle Name</label>
                        <input name="middle_name" class="form-control" value="{{ old('middle_name', $user->profile->middle_name ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Last Name</label>
                        <input name="last_name" class="form-control" value="{{ old('last_name', $user->profile->last_name ?? $user->last_name ?? '') }}">
                        @error('last_name')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Mobile (cc)</label>
                        <input name="mobile_cc" class="form-control" value="{{ old('mobile_cc', $user->profile->mobile_cc ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mobile Number</label>
                        <input name="mobile_number" class="form-control" value="{{ old('mobile_number', $user->profile->mobile_number ?? '') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Marital Status</label>
                        <select name="marital_status" class="form-select">
                            <option value="">Select</option>
                            <option value="single" {{ (old('marital_status', $user->profile->marital_status ?? '')=='single') ? 'selected':'' }}>Single</option>
                            <option value="married" {{ (old('marital_status', $user->profile->marital_status ?? '')=='married') ? 'selected':'' }}>Married</option>
                            <option value="divorced" {{ (old('marital_status', $user->profile->marital_status ?? '')=='divorced') ? 'selected':'' }}>Divorced</option>
                            <option value="widowed" {{ (old('marital_status', $user->profile->marital_status ?? '')=='widowed') ? 'selected':'' }}>Widowed</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select</option>
                            <option value="male" {{ (old('gender', $user->profile->gender ?? '')=='male') ? 'selected':'' }}>Male</option>
                            <option value="female" {{ (old('gender', $user->profile->gender ?? '')=='female') ? 'selected':'' }}>Female</option>
                            <option value="other" {{ (old('gender', $user->profile->gender ?? '')=='other') ? 'selected':'' }}>Other</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">DOB</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob', optional($user->profile->dob)->format('Y-m-d') ?? '') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Nationality</label>
                        <input name="nationality" class="form-control" value="{{ old('nationality', $user->profile->nationality ?? '') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">State</label>
                        <select name="state_id" id="state_id" class="form-select">
                            <option value="">Select</option>
                            @foreach($states as $st)
                                <option value="{{ $st->id }}" {{ (string)old('state_id', $user->profile->state_id ?? '') === (string)$st->id ? 'selected' : '' }}>{{ $st->state_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">City</label>
                        <select name="city_id" id="city_id" class="form-select">
                            <option value="">Select</option>
                            @foreach($cities as $c)
                                <option value="{{ $c->id }}" {{ (string)old('city_id', $user->profile->city_id ?? '') === (string)$c->id ? 'selected' : '' }}>{{ $c->city_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2">{{ old('address', $user->profile->address ?? '') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" name="profile_pic" class="form-control">
                        @if(!empty($user->profile->profile_pic))
                            <small class="text-muted">Current: <a href="{{ asset('storage/'.$user->profile->profile_pic) }}" target="_blank">view</a></small>
                        @endif
                    </div>

                    <div class="col-12 mt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" disabled>Previous</button>
                        <button type="button" class="btn btn-primary next-btn" data-target="profile">Save & Continue</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Step 2: Profile & Experience --}}
        <div class="card mb-4 step-card d-none" id="step-profile">
            <div class="card-header bg-light"><h5 class="mb-0">Profile & Total Experience</h5></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Present Rank</label>
                        <select name="present_rank" class="form-select">
                            <option value="">Select</option>
                            @foreach($ranks as $r)
                                <option value="{{ $r->id }}" {{ (string)old('present_rank', $user->resume->present_rank ?? '') === (string)$r->id ? 'selected':'' }}>{{ $r->rank }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Present Rank Experience</label>
                        <input name="present_rank_exp" class="form-control" value="{{ old('present_rank_exp', $user->resume->present_rank_exp ?? '') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Post Applied For</label>
                        <select name="post_applied_for" class="form-select">
                            <option value="">Select</option>
                            @foreach($ranks as $r)
                                <option value="{{ $r->id }}" {{ (string)old('post_applied_for', $user->resume->post_applied_for ?? '') === (string)$r->id ? 'selected':'' }}>{{ $r->rank }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date of Availability</label>
                        <input type="date" name="date_of_availability" class="form-control" value="{{ old('date_of_availability', optional($user->resume->date_of_availability)->format('Y-m-d') ?? '') }}">
                    </div>

                    <div class="col-12 mt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary prev-btn" data-target="personal">Previous</button>
                        <button type="button" class="btn btn-primary next-btn" data-target="documents">Save & Continue</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Step 3: Documents --}}
        <div class="card mb-4 step-card d-none" id="step-documents">
            <div class="card-header bg-light"><h5 class="mb-0">Passport & Seamen Book</h5></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Passport Nationality</label>
                        <input name="passport_nationality" class="form-control" value="{{ old('passport_nationality', $user->resume->passport_nationality ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Passport Number</label>
                        <input name="passport_number" class="form-control" value="{{ old('passport_number', $user->resume->passport_number ?? '') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Passport Expiry</label>
                        <input type="date" name="passport_expiry" class="form-control" value="{{ old('passport_expiry', optional($user->resume->passport_expiry)->format('Y-m-d') ?? '') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">CDC No</label>
                        <input name="cdc_no" class="form-control" value="{{ old('cdc_no', $user->resume->cdc_no ?? '') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">CDC Expiry</label>
                        <input type="date" name="cdc_expiry" class="form-control" value="{{ old('cdc_expiry', optional($user->resume->cdc_expiry)->format('Y-m-d') ?? '') }}">
                    </div>

                    <div class="col-12 mt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary prev-btn" data-target="profile">Previous</button>
                        <button type="button" class="btn btn-primary next-btn" data-target="presea">Save & Continue</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Step 4: PreSea --}}
        <div class="card mb-4 step-card d-none" id="step-presea">
            <div class="card-header bg-light"><h5 class="mb-0">Pre-Sea & COC/COP</h5></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Pre-Sea Training Type</label>
                        <input name="presea_training_type" class="form-control" value="{{ old('presea_training_type', $user->resume->presea_training_type ?? '') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Issue Date</label>
                        <input type="date" name="presea_training_issue_date" class="form-control" value="{{ old('presea_training_issue_date', optional($user->resume->presea_training_issue_date)->format('Y-m-d') ?? '') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">COC Held</label>
                        <select name="coc_held" class="form-select">
                            <option value="0" {{ (old('coc_held', $user->resume->coc_held ?? 0) ? '':'selected') }}>No</option>
                            <option value="1" {{ (old('coc_held', $user->resume->coc_held ?? 0) ? 'selected':'') }}>Yes</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">COC No</label>
                        <input name="coc_no" class="form-control" value="{{ old('coc_no', $user->resume->coc_no ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">COC Expiry</label>
                        <input type="date" name="coc_date_of_expiry" class="form-control" value="{{ old('coc_date_of_expiry', optional($user->resume->coc_date_of_expiry)->format('Y-m-d') ?? '') }}">
                    </div>

                    <div class="col-12 mt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary prev-btn" data-target="documents">Previous</button>
                        <button type="button" class="btn btn-primary next-btn" data-target="gmdss">Save & Continue</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Step 5: GMDSS / DCE --}}
        <div class="card mb-4 step-card d-none" id="step-gmdss">
            <div class="card-header bg-light"><h5 class="mb-0">GMDSS / DCE</h5></div>
            <div class="card-body">
                <div id="dceContainer">
                    {{-- existing endorsements --}}
                    @php
                        $dcesExisting = old('dce_id') ?? $user->dceEndorsements->pluck('dce_id')->toArray();
                        $dcesValidity = old('dce_validity') ?? $user->dceEndorsements->map(function($d){ return optional($d->validity_date)->format('Y-m-d'); })->toArray();
                    @endphp

                    @if(empty($dcesExisting))
                        <div class="dce-entry row g-3 mb-2">
                            <div class="col-md-6">
                                <label class="form-label">DCE / GMDSS</label>
                                <select class="form-select" name="dce_id[]">
                                    <option value="">Choose...</option>
                                    @foreach($dces as $d)
                                        <option value="{{ $d->id }}">{{ $d->dce_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Validity</label>
                                <input type="date" class="form-control" name="dce_validity[]" value="">
                            </div>
                            <div class="col-md-1 d-flex align-items-end"><button type="button" class="btn btn-outline-danger remove-dce d-none">&times;</button></div>
                        </div>
                    @else
                        @foreach($dcesExisting as $i => $val)
                            <div class="dce-entry row g-3 mb-2">
                                <div class="col-md-6">
                                    <label class="form-label">DCE / GMDSS</label>
                                    <select class="form-select" name="dce_id[]">
                                        <option value="">Choose...</option>
                                        @foreach($dces as $d)
                                            <option value="{{ $d->id }}" {{ (string)$d->id === (string)$val ? 'selected' : '' }}>{{ $d->dce_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label">Validity</label>
                                    <input type="date" class="form-control" name="dce_validity[]" value="{{ $dcesValidity[$i] ?? '' }}">
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-outline-danger remove-dce {{ $i===0 ? 'd-none':'' }}">&times;</button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="mb-3">
                    <button type="button" id="addDceBtn" class="btn btn-outline-primary">Add More</button>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button type="button" class="btn btn-outline-secondary prev-btn" data-target="presea">Previous</button>
                    <button type="button" class="btn btn-primary next-btn" data-target="courses">Save & Continue</button>
                </div>
            </div>
        </div>

        {{-- Step 6: Courses --}}
        <div class="card mb-4 step-card d-none" id="step-courses">
            <div class="card-header bg-light"><h5 class="mb-0">Courses</h5></div>
            <div class="card-body">
                <label class="form-label">Select Courses</label>
                <div class="multiselect-dropdown">
                    <div class="dropdown-toggle" id="courseToggle" tabindex="0" role="button">
                        <span class="selected-text">Select courses...</span>
                        <i class="bx bx-chevron-down"></i>
                    </div>
                    <div class="dropdown-menu" id="courseMenu">
                        @php $selectedCourses = old('courses', $user->courseCertificates->pluck('course_id')->toArray()); @endphp
                        @foreach($coursesMaster as $course)
                            <label class="dropdown-item">
                                <input type="checkbox" name="courses[]" value="{{ $course->id }}" {{ in_array($course->id, $selectedCourses) ? 'checked' : '' }}>
                                {{ $course->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-secondary prev-btn" data-target="gmdss">Previous</button>
                    <button type="button" class="btn btn-primary next-btn" data-target="seaservice">Save & Continue</button>
                </div>
            </div>
        </div>

        {{-- Step 7: Sea Service --}}
        <div class="card mb-4 step-card d-none" id="step-seaservice">
            <div class="card-header bg-light"><h5 class="mb-0">Sea Service</h5></div>
            <div class="card-body">
                <div id="seaServiceContainer">
                    @php
                        $seaExisting = old('sea_service', $user->seaServiceDetails->map(function($s){
                            return [
                                'rank_id'=>$s->rank_id,
                                'ship_type_id'=>$s->ship_type_id,
                                'company_name'=>$s->company_name,
                                'ship_name'=>$s->ship_name,
                                'sign_on'=>optional($s->sign_on)->format('Y-m-d'),
                                'sign_off'=>optional($s->sign_off)->format('Y-m-d'),
                                'grt_value'=>$s->grt_value,
                                'grt_unit'=>$s->grt_unit,
                                'bhp'=>$s->bhp,
                            ];
                        })->toArray());
                        if (empty($seaExisting)) $seaExisting = [['rank_id'=>null,'ship_type_id'=>null,'company_name'=>null,'ship_name'=>null,'sign_on'=>null,'sign_off'=>null,'grt_value'=>null,'grt_unit'=>null,'bhp'=>null]];
                    @endphp

                    @foreach($seaExisting as $i => $entry)
                        <div class="sea-service-entry border rounded p-3 mb-3" data-index="{{ $i }}">
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <label class="form-label">Rank</label>
                                    <select name="sea_service[{{ $i }}][rank_id]" class="form-select">
                                        <option value="">Select</option>
                                        @foreach($ranks as $r)
                                            <option value="{{ $r->id }}" {{ (string)($entry['rank_id'] ?? '') === (string)$r->id ? 'selected' : '' }}>{{ $r->rank }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Ship Type</label>
                                    <select name="sea_service[{{ $i }}][ship_type_id]" class="form-select">
                                        <option value="">Select</option>
                                        @foreach($shiptypes as $s)
                                            <option value="{{ $s->id }}" {{ (string)($entry['ship_type_id'] ?? '') === (string)$s->id ? 'selected' : '' }}>{{ $s->ship_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Sign On</label>
                                    <input type="date" name="sea_service[{{ $i }}][sign_on]" class="form-control" value="{{ $entry['sign_on'] ?? '' }}">
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">Sign Off</label>
                                    <input type="date" name="sea_service[{{ $i }}][sign_off]" class="form-control" value="{{ $entry['sign_off'] ?? '' }}">
                                </div>

                                <div class="col-md-2">
                                    <label class="form-label">GRT Value</label>
                                    <input type="text" name="sea_service[{{ $i }}][grt_value]" class="form-control" value="{{ $entry['grt_value'] ?? '' }}">
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" name="sea_service[{{ $i }}][company_name]" class="form-control" value="{{ $entry['company_name'] ?? '' }}">
                                </div>

                                <div class="col-md-4 mt-2">
                                    <label class="form-label">Ship Name</label>
                                    <input type="text" name="sea_service[{{ $i }}][ship_name]" class="form-control" value="{{ $entry['ship_name'] ?? '' }}">
                                </div>

                                <div class="col-md-2 mt-2">
                                    <label class="form-label">GRT Unit</label>
                                    <select name="sea_service[{{ $i }}][grt_unit]" class="form-select">
                                        <option value="">Unit</option>
                                        <option value="GRT" {{ ($entry['grt_unit'] ?? '') === 'GRT' ? 'selected':'' }}>GRT</option>
                                        <option value="DWT" {{ ($entry['grt_unit'] ?? '') === 'DWT' ? 'selected':'' }}>DWT</option>
                                    </select>
                                </div>

                                <div class="col-md-2 mt-2">
                                    <label class="form-label">BHP</label>
                                    <input type="text" name="sea_service[{{ $i }}][bhp]" class="form-control" value="{{ $entry['bhp'] ?? '' }}">
                                </div>
                            </div>

                            <div class="mt-2 text-end">
                                <button type="button" class="btn btn-sm btn-outline-danger removeSeaService {{ $i===0 ? 'd-none':'' }}">Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <button type="button" id="addSeaService" class="btn btn-outline-primary">Add More Sea Service</button>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button type="button" class="btn btn-outline-secondary prev-btn" data-target="courses">Previous</button>
                    <button type="button" class="btn btn-primary next-btn" data-target="additional">Save & Continue</button>
                </div>
            </div>
        </div>

        {{-- Step 8: Additional --}}
        <div class="card mb-4 step-card d-none" id="step-additional">
            <div class="card-header bg-light"><h5 class="mb-0">Additional Details</h5></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Additional Information</label>
                        <textarea name="additional_information" class="form-control" rows="4">{{ old('additional_information', $user->resume->additional_information ?? '') }}</textarea>
                    </div>

                    <div class="col-12 mt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary prev-btn" data-target="seaservice">Previous</button>
                        <button type="submit" class="btn btn-success">Save Resume</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

{{-- Inline styles so they load even if layout doesn't yield pushed stacks --}}
<style>
/* Progress / Step bar wrapper */
.progress-steps {
    position: relative;
    display: flex;
    gap: 0.5rem;
    align-items: flex-start;
    padding: 1rem 0 1.2rem;
    min-height: 72px;
    overflow: visible;
}

/* Make it horizontally scrollable on very small screens */
@media (max-width: 767.98px) {
    .progress-steps {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 1.6rem;
    }
}

/* Each step occupies equal space; prevents vertical stacking */
.progress-steps .step {
    flex: 1 0 0;
    text-align: center;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    padding: 0 6px;
    min-width: 88px;
    box-sizing: border-box;
}

/* circle number */
.step-number {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #e9ecef;
    color: #495057;
    font-weight: 700;
    font-size: 0.95rem;
    border: 2px solid transparent;
    z-index: 3;
    box-shadow: 0 1px 2px rgba(0,0,0,0.03);
}

/* text under the number */
.step-title {
    font-size: 0.78rem;
    color: #6c757d;
    line-height: 1.05;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
}

/* active/completed states */
.step.active .step-number {
    background: #0d6efd;
    color: #fff;
    border-color: #0d6efd;
    transform: scale(1.05);
    transition: transform .18s ease;
}

.step.completed .step-number {
    background: #198754;
    color: #fff;
    border-color: #198754;
}

/* Titles for active/completed */
.step.active .step-title,
.step.completed .step-title {
    color: #212529;
    font-weight: 600;
}

/* Progress track (light background) and progress bar on top */
.progress-line {
    position: absolute;
    left: 12px;
    right: 12px;
    top: 22px;
    height: 8px;
    background: #e9ecef;
    border-radius: 6px;
    z-index: 1;
}

/* inner bar (actual progress) */
.progress-line .progress-bar {
    height: 100%;
    width: 0%;
    border-radius: 6px;
    background: #0d6efd;
    transition: width .35s ease;
    z-index: 2;
}

/* Make sure the number sits above the line */
.progress-steps .step-number { position: relative; }

/* small screens: reduce size */
@media (max-width: 575.98px) {
    .step-number { width: 34px; height: 34px; font-size: .85rem; }
    .progress-line { top: 20px; height: 6px; }
    .progress-steps .step { min-width: 72px; padding: 0 4px; }
    .step-title { font-size: 0.67rem; }
}

/* Optional: subtle hover */
.progress-steps .step:hover .step-number { transform: translateY(-3px); transition: transform .15s ease; }

/* Multiselect menu */
.multiselect-dropdown { position: relative; }
.multiselect-dropdown .dropdown-menu {
    display: none; position: absolute; left: 0; right: 0; background:#fff; max-height:240px; overflow:auto; border:1px solid #e5e7eb; padding:6px; z-index: 50;
}
.multiselect-dropdown .dropdown-menu.show { display:block; }
.dropdown-item { display:flex; align-items:center; padding:6px 8px; }
</style>

{{-- Inline scripts so they load reliably --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Step navigation mapping
    const stepMap = {
        personal: 'step-personal',
        profile: 'step-profile',
        documents: 'step-documents',
        presea: 'step-presea',
        gmdss: 'step-gmdss',
        courses: 'step-courses',
        seaservice: 'step-seaservice',
        additional: 'step-additional'
    };
    const steps = document.querySelectorAll('.progress-steps .step');

    function showStep(key) {
        // hide all cards
        document.querySelectorAll('.step-card').forEach(s => s.classList.add('d-none'));
        const id = stepMap[key];
        const el = document.getElementById(id);
        if (!el) return;
        el.classList.remove('d-none');

        // progress width
        const keys = Object.keys(stepMap);
        const idx = keys.indexOf(key);
        const percent = ((idx+1)/keys.length)*100;
        document.getElementById('mainProgressBar').style.width = percent + '%';

        // update visuals
        steps.forEach((elStep, i) => {
            elStep.classList.remove('active','completed');
            if (i < idx) elStep.classList.add('completed');
            if (i === idx) elStep.classList.add('active');
        });

        // On small screens, scroll the active step into view
        const activeStep = document.querySelector('.progress-steps .step.active');
        if (activeStep && activeStep.scrollIntoView) {
            const container = document.querySelector('.progress-steps');
            // prefer smooth, but keep it non-blocking
            activeStep.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
        }
    }

    // initial step
    showStep('personal');

    // make top steps clickable
    document.querySelectorAll('.progress-steps .step').forEach(el => {
        el.addEventListener('click', function(){
            const key = this.dataset.step;
            if (key) showStep(key);
        });
    });

    // next/previous buttons
    document.querySelectorAll('.next-btn').forEach(btn => {
        btn.addEventListener('click', function(){
            const target = this.dataset.target;
            if (target) showStep(target);
        });
    });
    document.querySelectorAll('.prev-btn').forEach(btn => {
        btn.addEventListener('click', function(){
            const target = this.dataset.target;
            if (target) showStep(target);
        });
    });

    // === DCE add/remove ===
    document.getElementById('addDceBtn')?.addEventListener('click', function(){
        const container = document.getElementById('dceContainer');
        if (!container) return;
        const node = document.createElement('div');
        node.className = 'dce-entry row g-3 mb-2';
        node.innerHTML = `
            <div class="col-md-6">
                <label class="form-label">DCE / GMDSS</label>
                <select class="form-select" name="dce_id[]">
                    <option value="">Choose...</option>
                    @foreach($dces as $d)
                        <option value="{{ $d->id }}">{{ addslashes($d->dce_name) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label">Validity</label>
                <input type="date" class="form-control" name="dce_validity[]" value="">
            </div>
            <div class="col-md-1 d-flex align-items-end"><button type="button" class="btn btn-outline-danger remove-dce">&times;</button></div>
        `;
        container.appendChild(node);
        node.querySelector('.remove-dce').addEventListener('click', function(){ node.remove(); });
    });
    document.querySelectorAll('.remove-dce').forEach(btn => btn.addEventListener('click', function(){ this.closest('.dce-entry').remove(); }));

    // === Courses multiselect ===
    const courseToggle = document.getElementById('courseToggle');
    const courseMenu = document.getElementById('courseMenu');
    const selectedText = document.querySelector('.selected-text');
    if (courseToggle && courseMenu && selectedText) {
        courseToggle.addEventListener('click', function(e){
            e.stopPropagation();
            courseMenu.classList.toggle('show');
        });
        document.addEventListener('click', function(){ courseMenu.classList.remove('show'); });
        courseMenu.querySelectorAll('input[type=checkbox]').forEach(cb => cb.addEventListener('change', updateCourseText));
        function updateCourseText(){
            const checks = Array.from(courseMenu.querySelectorAll('input[type=checkbox]'));
            const selected = checks.filter(c=>c.checked).map(c=>c.parentNode.textContent.trim());
            if (selected.length===0) selectedText.textContent = 'Select courses...';
            else if (selected.length===1) selectedText.textContent = selected[0];
            else selectedText.textContent = selected.length + ' courses selected';
        }
        updateCourseText();
    }

    // === Sea Service add/remove ===
    let seaIndex = document.querySelectorAll('.sea-service-entry').length || 0;
    document.getElementById('addSeaService')?.addEventListener('click', function(){
        const container = document.getElementById('seaServiceContainer');
        if (!container) return;
        const div = document.createElement('div');
        div.className = 'sea-service-entry border rounded p-3 mb-3';
        div.dataset.index = seaIndex;
        div.innerHTML = `
            <div class="row g-2">
                <div class="col-md-3">
                    <label class="form-label">Rank</label>
                    <select name="sea_service[${seaIndex}][rank_id]" class="form-select">
                        <option value="">Select</option>
                        @foreach($ranks as $r)
                            <option value="{{ $r->id }}">{{ addslashes($r->rank) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Ship Type</label>
                    <select name="sea_service[${seaIndex}][ship_type_id]" class="form-select">
                        <option value="">Select</option>
                        @foreach($shiptypes as $s)
                            <option value="{{ $s->id }}">{{ addslashes($s->ship_name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2"><label class="form-label">Sign On</label><input type="date" name="sea_service[${seaIndex}][sign_on]" class="form-control"></div>
                <div class="col-md-2"><label class="form-label">Sign Off</label><input type="date" name="sea_service[${seaIndex}][sign_off]" class="form-control"></div>
                <div class="col-md-2"><label class="form-label">GRT Value</label><input type="text" name="sea_service[${seaIndex}][grt_value]" class="form-control"></div>
                <div class="col-md-4 mt-2"><label class="form-label">Company</label><input type="text" name="sea_service[${seaIndex}][company_name]" class="form-control"></div>
                <div class="col-md-4 mt-2"><label class="form-label">Ship Name</label><input type="text" name="sea_service[${seaIndex}][ship_name]" class="form-control"></div>
                <div class="col-md-2 mt-2"><label class="form-label">GRT Unit</label>
                    <select name="sea_service[${seaIndex}][grt_unit]" class="form-select"><option value="">Unit</option><option value="GRT">GRT</option><option value="DWT">DWT</option></select>
                </div>
                <div class="col-md-2 mt-2"><label class="form-label">BHP</label><input type="text" name="sea_service[${seaIndex}][bhp]" class="form-control"></div>
            </div>
            <div class="mt-2 text-end"><button type="button" class="btn btn-sm btn-outline-danger removeSeaService">Remove</button></div>
        `;
        container.appendChild(div);
        seaIndex++;
    });

    document.getElementById('seaServiceContainer')?.addEventListener('click', function(e){
        const btn = e.target.closest('.removeSeaService');
        if (btn) btn.closest('.sea-service-entry').remove();
    });

    // === AJAX state -> cities (optional) ===
    document.getElementById('state_id')?.addEventListener('change', function(){
        const stateId = this.value;
        const city = document.getElementById('city_id');
        if (!city) return;
        city.innerHTML = '<option>Loading...</option>';
        if (!stateId) { city.innerHTML = '<option value="">Select</option>'; return; }
        fetch('/api/cities?state_id=' + encodeURIComponent(stateId), { headers: {'X-Requested-With':'XMLHttpRequest'} })
            .then(r=>r.json())
            .then(json=>{
                const data = Array.isArray(json) ? json : (json.data || []);
                city.innerHTML = '<option value="">Select</option>';
                data.forEach(it => {
                    const opt = document.createElement('option');
                    opt.value = it.id; opt.textContent = it.city_name;
                    city.appendChild(opt);
                });
            }).catch(()=>{ city.innerHTML = '<option value="">Select</option>'; });
    });
});
</script>
