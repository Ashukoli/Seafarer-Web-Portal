{{-- resources/views/admin/candidate/registration.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<main class="page-content professional-bg">
    <div class="container">
        <!-- Enhanced Breadcrumb (similar to company registration) -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
            <div class="breadcrumb-title pe-3">
                <i class="bx bx-user me-2"></i>Admin
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0 enhanced-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">
                                <i class="bx bx-home-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.candidates.index') }}" class="breadcrumb-link">
                                <i class="bx bx-group"></i>Candidates
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="bx bx-plus-circle"></i>
                            Register New Candidate
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Progress / Steps -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="progress-steps" id="progressSteps" role="tablist" aria-label="Registration steps">
                    @foreach([
                        'Personal', 'Profile', 'Documents', 'Pre-Sea', 'GMDSS / DCE', 'Courses', 'Sea Service', 'Additional'
                    ] as $i => $stepTitle)
                        <div class="step clickable-step" id="step{{ $i+1 }}" data-step="{{ \Illuminate\Support\Str::camel($stepTitle).'Step' }}" role="tab" tabindex="0">
                            <div class="step-number">{{ $i+1 }}</div>
                            <div class="step-title">{{ $stepTitle }}</div>
                        </div>
                    @endforeach
                    <div class="progress"><div class="progress-bar" id="mainProgressBar" role="progressbar" style="width:12.5%"></div></div>
                </div>
            </div>
        </div>

        <form id="registrationForm" method="POST" action="{{ route('admin.candidates.store') }}" enctype="multipart/form-data" novalidate>
            @csrf

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>There were problems with your submission:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Step 1: Personal -->
            <div class="card mb-4" id="personalStep" data-step-index="1">
                <div class="card-header modern-header">
                    <div class="header-content">
                        <div class="header-icon">
                            <i class="bx bx-user"></i>
                        </div>
                        <div>
                            <h5 class="header-title mb-0">Personal Details</h5>
                            <div class="header-subtitle">Basic candidate information</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <!-- First name, middle, last -->
                        <div class="col-md-4">
                            <label class="form-label">First Name *</label>
                            <input type="text" name="first_name" id="first_name"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   value="{{ old('first_name') }}" required>
                            @error('first_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name') }}">
                            @error('middle_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Last Name *</label>
                            <input type="text" name="last_name" id="last_name"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   value="{{ old('last_name') }}" required>
                            @error('last_name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <!-- Email/password -->
                        <div class="col-md-6">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Password *</label>
                            <input type="password" name="password" id="password"
                                   class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Confirm Password *</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control" required>
                        </div>

                        <!-- Marital, gender, dob -->
                        <div class="col-md-4">
                            <label class="form-label">Marital Status</label>
                            <select name="marital_status" class="form-select @error('marital_status') is-invalid @enderror">
                                <option value="">Select</option>
                                <option value="single" {{ old('marital_status')=='single' ? 'selected' : '' }}>Single</option>
                                <option value="married" {{ old('marital_status')=='married' ? 'selected' : '' }}>Married</option>
                                <option value="divorced" {{ old('marital_status')=='divorced' ? 'selected' : '' }}>Divorced</option>
                                <option value="widowed" {{ old('marital_status')=='widowed' ? 'selected' : '' }}>Widowed</option>
                            </select>
                            @error('marital_status')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                <option value="">Select</option>
                                <option value="male" {{ old('gender')=='male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender')=='female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender')=='other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Date of Birth</label>
                            <input type="text" id="dob_display" class="form-control date-display @error('dob') is-invalid @enderror"
                                   placeholder="dd-mm-yyyy" data-name="dob" autocomplete="off" value="{{ old('dob') ? \Carbon\Carbon::parse(old('dob'))->format('d-m-Y') : '' }}">
                            @error('dob')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <!-- Mobile / WhatsApp -->
                        <div class="col-md-6">
                            <label class="form-label">Mobile Number *</label>
                            <div class="input-group">
                                <select name="mobile_cc" id="mobile_cc" class="form-select" style="max-width:140px;">
                                    @foreach($mobileCodes as $m)
                                        <option value="{{ $m->dial_code }}" {{ old('mobile_cc', '+91') == $m->dial_code ? 'selected' : '' }}>
                                            {{ $m->dial_code }} ({{ $m->country_code ?? '' }})
                                        </option>
                                    @endforeach
                                </select>
                                <input type="tel" name="mobile_number" id="mobile_number"
                                       class="form-control @error('mobile_number') is-invalid @enderror"
                                       placeholder="Mobile Number" required value="{{ old('mobile_number') }}">
                                @error('mobile_number')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">WhatsApp Number</label>
                            <div class="input-group">
                                <select name="whatsapp_cc" id="whatsapp_cc" class="form-select" style="max-width:140px;">
                                    @foreach($mobileCodes as $m)
                                        <option value="{{ $m->dial_code }}" {{ old('whatsapp_cc', '+91') == $m->dial_code ? 'selected' : '' }}>{{ $m->dial_code }} ({{ $m->country_code ?? '' }})</option>
                                    @endforeach
                                </select>
                                <input type="tel" name="whatsapp_number" id="whatsapp_number" class="form-control" placeholder="WhatsApp Number" value="{{ old('whatsapp_number') }}">
                            </div>
                        </div>

                        <!-- Nationality -->
                        <div class="col-md-6">
                            <label class="form-label">Nationality</label>
                            <select name="nationality" id="nationality_select" class="form-select">
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ (old('nationality', $defaultCountryId ?? null) == $country->id) ? 'selected' : '' }}>
                                        {{ $country->country_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- State & City -->
                        <div class="col-md-3">
                            <label class="form-label">State</label>
                            <select name="state_id" id="state_id" class="form-select">
                                <option value="">Select</option>
                                @foreach($states as $s)
                                    <option value="{{ $s->id }}" {{ (string)old('state_id') === (string)$s->id ? 'selected' : '' }}>{{ $s->state_name }}</option>
                                @endforeach
                            </select>
                            @error('state_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">City</label>
                            <select name="city_id" id="city_id" class="form-select">
                                <option value="">Select</option>
                                @foreach($cities as $c)
                                    <option value="{{ $c->id }}" {{ (string)old('city_id') === (string)$c->id ? 'selected' : '' }}>{{ $c->city_name }}</option>
                                @endforeach
                            </select>
                            @error('city_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>

                        <!-- Address + Profile pic -->
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea>
                            @error('address')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" name="profile_pic" class="form-control @error('profile_pic') is-invalid @enderror">
                            @error('profile_pic')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" disabled>Previous</button>
                        <button type="button" class="btn btn-primary next-step" data-target="profileStep">Save & Continue</button>
                    </div>
                </div>
            </div>

            <!-- Step 2: Profile -->
            <div class="card mb-4 d-none" id="profileStep" data-step-index="2">
                <div class="card-header modern-header">
                    <div class="header-content">
                        <div class="header-icon">
                            <i class="bx bx-id-card"></i>
                        </div>
                        <div>
                            <h5 class="header-title mb-0">Profile & Total Experience</h5>
                            <div class="header-subtitle">Rank, experience & applied post</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Present Rank *</label>
                            <select name="present_rank" id="present_rank" class="form-select @error('present_rank') is-invalid @enderror" required>
                                <option value="">Select Rank</option>
                                @foreach($ranks as $rank)
                                    <option value="{{ $rank->id }}" {{ old('present_rank') == $rank->id ? 'selected' : '' }}>{{ $rank->rank }}</option>
                                @endforeach
                            </select>
                            @error('present_rank')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Experience in Present Rank *</label>
                            <select name="present_rank_exp" id="present_rank_exp" class="form-select @error('present_rank_exp') is-invalid @enderror" required>
                                <option value="">Select</option>
                                <option value="Fresher" {{ old('present_rank_exp') == 'Fresher' ? 'selected' : '' }}>Fresher</option>
                                <option value="0 - 6 mts" {{ old('present_rank_exp') == '0 - 6 mts' ? 'selected' : '' }}>0 - 6 mts</option>
                                <option value="6 mts - 1 yr" {{ old('present_rank_exp') == '6 mts - 1 yr' ? 'selected' : '' }}>6 mts - 1 yr</option>
                                <option value="1 - 2 yrs" {{ old('present_rank_exp') == '1 - 2 yrs' ? 'selected' : '' }}>1 - 2 yrs</option>
                                <option value="2 - 3 yrs" {{ old('present_rank_exp') == '2 - 3 yrs' ? 'selected' : '' }}>2 - 3 yrs</option>
                                <option value="3 - 5 yrs" {{ old('present_rank_exp') == '3 - 5 yrs' ? 'selected' : '' }}>3 - 5 yrs</option>
                                <option value="5 yrs & above" {{ old('present_rank_exp') == '5 yrs & above' ? 'selected' : '' }}>5 yrs & above</option>
                            </select>
                            @error('present_rank_exp')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Post Applied For *</label>
                            <select name="post_applied_for" id="post_applied_for" class="form-select @error('post_applied_for') is-invalid @enderror" required>
                                <option value="">Select Rank</option>
                                @foreach($ranks as $rank)
                                    <option value="{{ $rank->id }}" {{ old('post_applied_for') == $rank->id ? 'selected' : '' }}>{{ $rank->rank }}</option>
                                @endforeach
                            </select>
                            @error('post_applied_for')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Availability</label>
                            <input type="text" name="availability_display" id="availability_display" class="form-control date-display" data-name="date_of_availability" placeholder="dd-mm-yyyy" value="{{ old('date_of_availability') ? \Carbon\Carbon::parse(old('date_of_availability'))->format('d-m-Y') : '' }}">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary prev-step" data-target="personalStep">Previous</button>
                        <button type="button" class="btn btn-primary next-step" data-target="documentsStep">Save & Continue</button>
                    </div>
                </div>
            </div>

            <!-- Step 3: Documents -->
            <div class="card mb-4 d-none" id="documentsStep" data-step-index="3">
                <div class="card-header modern-header">
                    <div class="header-content">
                        <div class="header-icon">
                            <i class="bx bx-book"></i>
                        </div>
                        <div>
                            <h5 class="header-title mb-0">Passport & Seamen Book</h5>
                            <div class="header-subtitle">Document details</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3 align-items-end">
                        <!-- Passport Nationality, Number, Expiry -->
                        <div class="col-md-4">
                            <label class="form-label">Passport Nationality *</label>
                            <select name="passport_nationality" class="form-select @error('passport_nationality') is-invalid @enderror" required>
                                <option value="">Select</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('passport_nationality') == $country->id ? 'selected' : '' }}>
                                        {{ $country->country_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('passport_nationality')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Passport Number *</label>
                            <input type="text" name="passport_number" class="form-control @error('passport_number') is-invalid @enderror" value="{{ old('passport_number') }}" required>
                            @error('passport_number')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Passport Expiry</label>
                            <input type="text" name="passport_expiry_display" class="form-control date-display" data-name="passport_expiry" placeholder="dd-mm-yyyy" value="{{ old('passport_expiry') ? \Carbon\Carbon::parse(old('passport_expiry'))->format('d-m-Y') : '' }}">
                        </div>
                    </div>
                    <div class="row g-3 align-items-end mt-1">
                        <!-- CDC Nationality, Number, Expiry -->
                        <div class="col-md-4">
                            <label class="form-label">CDC Nationality *</label>
                            <select name="cdc_nationality" class="form-select @error('cdc_nationality') is-invalid @enderror" required>
                                <option value="">Select</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('cdc_nationality') == $country->id ? 'selected' : '' }}>
                                        {{ $country->country_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('cdc_nationality')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">CDC Number *</label>
                            <input type="text" name="cdc_number" class="form-control @error('cdc_number') is-invalid @enderror" value="{{ old('cdc_number') }}" required>
                            @error('cdc_number')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">CDC Expiry</label>
                            <input type="text" name="cdc_expiry_display" class="form-control date-display" data-name="cdc_expiry" placeholder="dd-mm-yyyy" value="{{ old('cdc_expiry') ? \Carbon\Carbon::parse(old('cdc_expiry'))->format('d-m-Y') : '' }}">
                        </div>
                    </div>
                    <div class="row g-3 mt-1">
                        <!-- USA Visa Dropdown -->
                        <div class="col-md-4">
                            <label class="form-label">USA Visa</label>
                            <select name="usa_visa" class="form-select @error('usa_visa') is-invalid @enderror">
                                <option value="">Select</option>
                                <option value="yes" {{ old('usa_visa') == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ old('usa_visa') == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('usa_visa')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">INDOS Number</label>
                            <input type="text" name="indos_number" class="form-control" value="{{ old('indos_number') }}">
                        </div>
                    </div>
                    <div class="col-12 mt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary prev-step" data-target="profileStep">Previous</button>
                        <button type="button" class="btn btn-primary next-step" data-target="preseaStep">Save & Continue</button>
                    </div>
                </div>
            </div>

            <!-- Step 4: PreSea & COC -->
            <div class="card mb-4 d-none" id="preseaStep" data-step-index="4">
                <div class="card-header modern-header">
                    <div class="header-content">
                        <div class="header-icon">
                            <i class="bx bx-certification"></i>
                        </div>
                        <div>
                            <h5 class="header-title mb-0">Pre-Sea & COC/COP</h5>
                            <div class="header-subtitle">Training & certification</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Pre-Sea Training Type</label>
                            <input type="text" name="presea_training_type" class="form-control" value="{{ old('presea_training_type') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Issue Date</label>
                            <input type="text" id="presea_training_issue_date_display" class="form-control date-display @error('presea_training_issue_date') is-invalid @enderror" placeholder="dd-mm-yyyy" data-name="presea_training_issue_date" autocomplete="off" value="{{ old('presea_training_issue_date') ? \Carbon\Carbon::parse(old('presea_training_issue_date'))->format('d-m-Y') : '' }}">
                            @error('presea_training_issue_date')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">COC Held (Country)</label>
                            <select name="coc_held" class="form-select">
                                <option value="">Select...</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ (int) old('coc_held') === $country->id ? 'selected' : '' }}>{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">COC Number</label>
                            <input type="text" name="coc_no" class="form-control" value="{{ old('coc_no') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">COC Grade</label>
                            <input type="text" name="coc_grade" class="form-control" value="{{ old('coc_grade') }}" placeholder="Grade / Rank (if any)">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">COC Type</label>
                            <input type="text" name="coc_type" class="form-control" value="{{ old('coc_type') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">COC Expiry</label>
                            <input type="text" id="coc_date_of_expiry_display" class="form-control date-display @error('coc_date_of_expiry') is-invalid @enderror" placeholder="dd-mm-yyyy" data-name="coc_date_of_expiry" autocomplete="off" value="{{ old('coc_date_of_expiry') ? \Carbon\Carbon::parse(old('coc_date_of_expiry'))->format('d-m-Y') : '' }}">
                            @error('coc_date_of_expiry')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12 mt-3 d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary prev-step" data-target="documentsStep">Previous</button>
                            <div>
                                <button type="button" class="btn btn-warning skip-step" data-target="gmdssStep">Skip</button>
                                <button type="button" class="btn btn-primary next-step" data-target="gmdssStep">Save & Continue</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 5: GMDSS / DCE -->
            <div class="card mb-4 d-none" id="gmdssStep" data-step-index="5">
                <div class="card-header modern-header">
                    <div class="header-content">
                        <div class="header-icon">
                            <i class="bx bx-radio"></i>
                        </div>
                        <div>
                            <h5 class="header-title mb-0">GMDSS & DCE Endorsements</h5>
                            <div class="header-subtitle">Endorsement details</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="dceContainer">
                        @php
                            $oldDceIds = old('dce_id', []);
                            $oldDceValidity = old('dce_validity', []);
                            $dceCount = max(count($oldDceIds), 1);
                        @endphp
                        @for($i = 0; $i < $dceCount; $i++)
                        <div class="dce-entry row g-3 mb-2">
                            <div class="col-md-6">
                                <label class="form-label">Select DCE / GMDSS</label>
                                <select name="dce_id[]" class="form-select">
                                    <option value="">Choose...</option>
                                    @foreach($dces as $d)
                                        <option value="{{ $d->id }}" {{ (isset($oldDceIds[$i]) && $oldDceIds[$i] == $d->id) ? 'selected' : '' }}>{{ $d->dce_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Validity Date</label>
                                <input type="text"
                                       class="form-control date-display dce-validity-display @error('dce_validity.'.$i) is-invalid @enderror"
                                       placeholder="dd-mm-yyyy"
                                       data-name="dce_validity[]"
                                       autocomplete="off"
                                       value="{{ old('dce_validity.' . $i) ? \Carbon\Carbon::parse(old('dce_validity.' . $i))->format('d-m-Y') : '' }}">
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-outline-danger remove-dce {{ $i == 0 && $dceCount == 1 ? 'd-none' : '' }}">&times;</button>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <div class="mb-3">
                        <button type="button" id="addDce" class="btn btn-outline-primary"><i class="bx bx-plus"></i> Add More</button>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-outline-secondary prev-step" data-target="preseaStep">Previous</button>
                        <div>
                            <button type="button" class="btn btn-warning skip-step" data-target="coursesStep">Skip</button>
                            <button type="button" class="btn btn-primary next-step" data-target="coursesStep">Save & Continue</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 6: Courses (multiselect dropdown with checkboxes) -->
            <div class="card mb-4 d-none" id="coursesStep" data-step-index="6">
                <div class="card-header modern-header">
                    <div class="header-content">
                        <div class="header-icon">
                            <i class="bx bx-book-content"></i>
                        </div>
                        <div>
                            <h5 class="header-title mb-0">Valid Course Details</h5>
                            <div class="header-subtitle">Course selection</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <label class="form-label">Select Course(s)</label>
                    <div class="multiselect-dropdown" id="courseSelection" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-toggle" id="courseToggle" tabindex="0" role="button" aria-controls="courseMenu">
                            <span class="selected-text">Select courses...</span>
                            <i class="bx bx-chevron-down"></i>
                        </div>
                        <div class="dropdown-menu" id="courseMenu" aria-labelledby="courseToggle" role="menu">
                            @foreach($coursesMaster as $course)
                                <label class="dropdown-item" role="menuitem">
                                    <input type="checkbox" name="courses[]" value="{{ $course->id }}" {{ in_array($course->id, (array) old('courses', [])) ? 'checked' : '' }}> {{ $course->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    @error('courses')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-outline-secondary prev-step" data-target="gmdssStep">Previous</button>
                        <div>
                            <button type="button" class="btn btn-warning skip-step" data-target="seaServiceStep">Skip</button>
                            <button type="button" class="btn btn-primary next-step" data-target="seaServiceStep">Save & Continue</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 7: Sea Service (includes tonnage field) -->
            <div class="card mb-4 d-none" id="seaServiceStep" data-step-index="7">
                <div class="card-header modern-header">
                    <div class="header-content">
                        <div class="header-icon">
                            <i class="bx bx-ship"></i>
                        </div>
                        <div>
                            <h5 class="header-title mb-0">Sea Service Details</h5>
                            <div class="header-subtitle">Sea service history</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="seaServiceContainer">
                        <!-- Template entry (index 0). Clone this when adding more. -->
                        <div class="sea-service-entry border rounded p-3 mb-3">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Rank</label>
                                    <select name="sea_service[0][rank_id]" class="form-select">
                                        <option value="">Select</option>
                                        @foreach($ranks as $rank)
                                            <option value="{{ $rank->id }}" {{ (old('sea_service.0.rank_id') == $rank->id) ? 'selected' : '' }}>
                                                {{ $rank->rank }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Ship Type</label>
                                    <select name="sea_service[0][ship_type_id]" class="form-select">
                                        <option value="">Select</option>
                                        @foreach($shiptypes as $s)
                                            <option value="{{ $s->id }}" {{ (old('sea_service.0.ship_type_id') == $s->id) ? 'selected' : '' }}>
                                                {{ $s->ship_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Sign On</label>
                                    <input type="text"
                                           name="sea_service[0][sign_on]_display"
                                           class="form-control date-display"
                                           placeholder="dd-mm-yyyy"
                                           data-name="sea_service[0][sign_on]"
                                           autocomplete="off"
                                           value="{{ old('sea_service.0.sign_on') ? \Carbon\Carbon::parse(old('sea_service.0.sign_on'))->format('d-m-Y') : '' }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Sign Off</label>
                                    <input type="text"
                                           name="sea_service[0][sign_off]_display"
                                           class="form-control date-display"
                                           placeholder="dd-mm-yyyy"
                                           data-name="sea_service[0][sign_off]"
                                           autocomplete="off"
                                           value="{{ old('sea_service.0.sign_off') ? \Carbon\Carbon::parse(old('sea_service.0.sign_off'))->format('d-m-Y') : '' }}">
                                </div>
                                <!-- Tonnage: select unit + numeric value -->
                                <div class="col-md-2">
                                    <label class="form-label">Tonnage</label>
                                    <div class="d-flex">
                                        <select name="sea_service[0][grt_unit]" class="form-select" style="max-width:90px; margin-right:6px;">
                                            <option value="GRT" {{ old('sea_service.0.grt_unit') === 'GRT' ? 'selected' : '' }}>GRT</option>
                                            <option value="DWT" {{ old('sea_service.0.grt_unit') === 'DWT' ? 'selected' : '' }}>DWT</option>
                                        </select>
                                        <input type="number" name="sea_service[0][grt_value]" class="form-control" placeholder="e.g. 1971" value="{{ old('sea_service.0.grt_value') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" name="sea_service[0][company_name]" class="form-control" value="{{ old('sea_service.0.company_name') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Ship Name</label>
                                    <input type="text" name="sea_service[0][ship_name]" class="form-control" value="{{ old('sea_service.0.ship_name') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">BHP</label>
                                    <input type="text" name="sea_service[0][bhp]" class="form-control" value="{{ old('sea_service.0.bhp') }}">
                                </div>
                            </div>
                            <div class="mt-2 text-end">
                                <button type="button" class="btn btn-sm btn-outline-danger removeSeaService d-none"><i class="bx bx-trash"></i> Remove</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="button" id="addSeaService" class="btn btn-outline-primary"><i class="bx bx-plus"></i> Add More Sea Service</button>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-outline-secondary prev-step" data-target="coursesStep">Previous</button>
                        <div>
                            <button type="button" class="btn btn-warning skip-step" data-target="additionalStep">Skip</button>
                            <button type="button" class="btn btn-primary next-step" data-target="additionalStep">Save & Continue</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 8: Additional & Submit -->
            <div class="modern-professional-card mb-4 d-none" id="additionalStep" data-step-index="8">
                <div class="card-header modern-header">
                    <div class="header-content">
                        <div class="header-icon">
                            <i class="bx bx-info-circle"></i>
                        </div>
                        <div>
                            <h5 class="header-title mb-0">Additional Details</h5>
                            <div class="header-subtitle">Other information</div>
                        </div>
                    </div>
                </div>
                <div class="card-body modern-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Additional Information</label>
                            <textarea name="additional_information" class="form-control" rows="3">{{ old('additional_information') }}</textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="modern-btn modern-btn-outline-secondary prev-step" data-target="seaServiceStep">Previous</button>
                        <button type="submit" class="modern-btn modern-btn-success" id="submitBtn"><i class="bx bx-save me-1"></i> Register Candidate</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ---------- STEP UI & validation (unchanged logic) ----------
    const steps = ['personalStep','profileStep','documentsStep','preseaStep','gmdssStep','coursesStep','seaServiceStep','additionalStep'];
    function showStep(stepId) {
        steps.forEach(id => {
            const el = document.getElementById(id);
            if (!el) return;
            if (id === stepId) el.classList.remove('d-none'); else el.classList.add('d-none');
        });
        updateProgress(stepId);
    }
    function updateProgress(currentId) {
        const idx = steps.indexOf(currentId);
        const percent = ((idx + 1) / steps.length) * 100;
        const bar = document.getElementById('mainProgressBar');
        if (bar) bar.style.width = percent + '%';
        steps.forEach((id, i) => {
            const stepEl = document.getElementById('step' + (i+1));
            if (!stepEl) return;
            stepEl.classList.remove('active','completed');
            if (i < idx) stepEl.classList.add('completed');
            if (i === idx) stepEl.classList.add('active');
        });
    }
    showStep('personalStep');

    document.querySelectorAll('.clickable-step').forEach(el => {
        el.addEventListener('click', function () {
            const target = this.dataset.step;
            if (canNavigateTo(target)) {
                showStep(target);
            } else {
                validateStep('personalStep', () => {
                    validateStep('profileStep', () => showStep(target));
                });
            }
        });
        el.addEventListener('keydown', function(e){ if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); this.click(); } });
    });

    document.querySelectorAll('.next-step').forEach(btn => {
        btn.addEventListener('click', function () {
            const target = this.dataset.target;
            const current = getVisibleStep();
            if (current === 'personalStep' || current === 'profileStep') {
                validateStep(current, () => showStep(target));
            } else showStep(target);
        });
    });
    document.querySelectorAll('.prev-step').forEach(btn => btn.addEventListener('click', function(){ showStep(this.dataset.target); }));

    function getVisibleStep() {
        for (const id of steps) {
            const el = document.getElementById(id);
            if (el && !el.classList.contains('d-none')) return id;
        }
        return steps[0];
    }

    function validateStep(stepId, onSuccess) {
        const stepMap = {
            personalStep: ['#first_name','#last_name','#email','#mobile_number'],
            profileStep: ['#present_rank','#present_rank_exp']
        };
        const selectors = stepMap[stepId] || [];
        let ok = true;
        for (const sel of selectors) {
            const el = document.querySelector(sel);
            if (!el) { ok = false; continue; }
            const v = (el.value || '').trim();
            if (!v) { el.classList.add('is-invalid'); ok = false; } else el.classList.remove('is-invalid');
            if (el.id === 'email' && v) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!re.test(v)) { el.classList.add('is-invalid'); ok = false; }
            }
            if (el.id === 'password' && v && v.length < 6) { el.classList.add('is-invalid'); ok = false; }
            if (el.id === 'password_confirmation') {
                const p = document.querySelector('#password')?.value || '';
                if (p && p !== v) { el.classList.add('is-invalid'); ok = false; }
            }
        }
        if (!ok) { const first = document.querySelector('.is-invalid'); if (first) first.focus(); return; }
        if (typeof onSuccess === 'function') onSuccess();
    }

    function canNavigateTo(targetId) {
        try {
            const pOk = isQuickValid(['#first_name','#last_name','#email','#mobile_number']);
            const prOk = isQuickValid(['#present_rank','#present_rank_exp']);
            const currentIdx = steps.indexOf(getVisibleStep());
            const targetIdx = steps.indexOf(targetId);
            if (targetIdx <= currentIdx) return true;
            return pOk && prOk;
        } catch (e) { return false; }
    }

    function isQuickValid(fields) {
        for (const sel of fields) {
            const el = document.querySelector(sel);
            if (!el) return false;
            if (!(el.value || '').trim()) return false;
        }
        return true;
    }

    document.querySelectorAll('#registrationForm input, #registrationForm select, #registrationForm textarea').forEach(el=>{ el.addEventListener('input', ()=> el.classList.remove('is-invalid')); });

    // ---------------- DCE add/remove ----------------
    document.getElementById('addDce')?.addEventListener('click', function () {
        const container = document.getElementById('dceContainer');
        const template = container.querySelector('.dce-entry').cloneNode(true);
        template.querySelectorAll('select,input').forEach(i => i.value = '');
        template.querySelector('.remove-dce').classList.remove('d-none');
        template.querySelector('.remove-dce').addEventListener('click', ()=> {
            template.querySelectorAll('.date-display').forEach(el => { if (el._flatpickrInstance) try { el._flatpickrInstance.destroy(); } catch(e){} });
            template.remove();
        });
        template.querySelectorAll('.date-display').forEach(initDateDisplay);
        container.appendChild(template);
    });
    document.querySelectorAll('.remove-dce').forEach(btn => btn.addEventListener('click', function(){ this.closest('.dce-entry').remove(); }));

    // ---------------- Sea service add/remove (complete) ----------------
    let serviceIndex = (function(){
        // try to detect number of existing entries from old() input if present, else start 1
        try {
            const existing = document.querySelectorAll('#seaServiceContainer .sea-service-entry').length;
            return existing > 0 ? existing : 1;
        } catch(e) { return 1; }
    })();

    const seaContainer = document.getElementById('seaServiceContainer');
    const addSeaBtn = document.getElementById('addSeaService');

    // prepare initial template reference - we'll clone this
    const baseTemplate = seaContainer.querySelector('.sea-service-entry');

    // helper to clear form controls inside an element
    function clearInputs(el) {
        el.querySelectorAll('input,select,textarea').forEach(i => {
            if (i.type === 'checkbox' || i.type === 'radio') i.checked = false;
            else i.value = '';
        });
    }

    addSeaBtn?.addEventListener('click', function () {
        const template = baseTemplate.cloneNode(true);

        // remove any existing flatpickr instances inside cloned template
        template.querySelectorAll('.date-display').forEach(el => {
            if (el._flatpickrInstance) {
                try { el._flatpickrInstance.destroy(); } catch(e){/* ignore */ }
            }
        });

        // update names replacing [0] with current serviceIndex
        template.querySelectorAll('input,select,textarea').forEach(el => {
            if (!el.name) return;
            el.name = el.name.replace(/\[0\]/g, `[${serviceIndex}]`);
            // reset values for cloned entry
            if (el.tagName.toLowerCase() === 'select') el.selectedIndex = 0;
            else el.value = '';
        });

        // update data-name attributes on date-display fields
        template.querySelectorAll('.date-display').forEach(el => {
            if (el.dataset && el.dataset.name) {
                el.dataset.name = el.dataset.name.replace(/\[0\]/g, `[${serviceIndex}]`);
            }
        });

        // show remove button and attach handler
        const removeBtn = template.querySelector('.removeSeaService');
        removeBtn.classList.remove('d-none');
        removeBtn.addEventListener('click', function () {
            // destroy flatpickr instances inside this template before removing
            template.querySelectorAll('.date-display').forEach(el => {
                if (el._flatpickrInstance) {
                    try { el._flatpickrInstance.destroy(); } catch(e){/*ignore*/ }
                }
            });
            template.remove();
        });

        // init date-display on cloned template
        template.querySelectorAll('.date-display').forEach(initDateDisplay);

        // append template
        seaContainer.appendChild(template);
        serviceIndex++;
    });

    // allow existing remove buttons to work (the initial template's remove button is hidden)
    seaContainer.addEventListener('click', function(e){
        if (e.target && e.target.matches('.removeSeaService, .removeSeaService *')) {
            const btn = e.target.closest('.removeSeaService');
            if (!btn) return;
            const entry = btn.closest('.sea-service-entry');
            if (!entry) return;
            // destroy flatpickr instances inside this entry
            entry.querySelectorAll('.date-display').forEach(el => {
                if (el._flatpickrInstance) {
                    try { el._flatpickrInstance.destroy(); } catch(e){/*ignore*/ }
                }
            });
            entry.remove();
        }
    });

    // ---------------- Multiselect dropdown (courses) ----------------
    const courseToggle = document.getElementById('courseToggle');
    const courseMenu = document.getElementById('courseMenu');
    const selectedText = document.querySelector('#courseSelection .selected-text');

    if (courseToggle) {
        courseToggle.addEventListener('click', function(e){
            e.stopPropagation();
            courseMenu.classList.toggle('show');
        });
        document.addEventListener('click', ()=> courseMenu.classList.remove('show'));
    }
    function updateCourseSelectedText() {
        const checks = Array.from(document.querySelectorAll('#courseMenu input[type=checkbox]'));
        const selected = checks.filter(c=>c.checked).map(c=>c.parentNode.textContent.trim());
        if (selected.length === 0) selectedText.textContent = 'Select courses...';
        else if (selected.length === 1) selectedText.textContent = selected[0];
        else selectedText.textContent = `${selected.length} courses selected`;
    }
    document.querySelectorAll('#courseMenu input[type=checkbox]').forEach(cb => cb.addEventListener('change', updateCourseSelectedText));
    updateCourseSelectedText();

    // ---------------- State -> Cities (AJAX) ----------------
    document.getElementById('state_id')?.addEventListener('change', function () {
        const stateId = this.value;
        const citySelect = document.getElementById('city_id');
        citySelect.innerHTML = '<option value="">Loading...</option>';
        if (!stateId) {
            citySelect.innerHTML = '<option value="">Select</option>';
            return;
        }
        fetch('/api/cities?state_id=' + encodeURIComponent(stateId), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(res => { if (!res.ok) throw new Error('Network response was not ok'); return res.json(); })
        .then(json => {
            const data = Array.isArray(json) ? json : (Array.isArray(json.data) ? json.data : []);
            citySelect.innerHTML = '<option value="">Select</option>';
            data.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c.id;
                opt.textContent = c.city_name;
                if (String(opt.value) === String(@json(old('city_id')))) opt.selected = true;
                citySelect.appendChild(opt);
            });
        })
        .catch(err => {
            console.error('Failed to load cities', err);
            citySelect.innerHTML = '<option value="">Select</option>';
        });
    });

    // ---------------- Date display helpers + initDateDisplay (Flatpickr) ----------------
    function ddmmyyyyToIso(value) {
        if (!value) return '';
        const parts = value.split(/[-\/\.]/);
        if (parts.length !== 3) return '';
        let [d,m,y] = parts.map(p => p.trim());
        if (y.length === 2) y = '20' + y;
        if (d.length===1) d = '0'+d;
        if (m.length===1) m = '0'+m;
        if (isNaN(+d) || isNaN(+m) || isNaN(+y)) return '';
        return `${y}-${m}-${d}`;
    }
    function isoToDdmmyyyy(value) {
        if (!value) return '';
        const parts = value.split('-');
        if (parts.length !== 3) return '';
        return `${parts[2]}-${parts[1]}-${parts[0]}`;
    }

    function initDateDisplay(el) {
        if (!el) return;
        const hiddenName = el.dataset.name;
        // populate display value from existing hidden input if present
        if (hiddenName) {
            const existingHidden = document.querySelector('input[name="' + hiddenName + '"]');
            if (existingHidden && existingHidden.value) { el.value = isoToDdmmyyyy(existingHidden.value); }
        }

        // destroy if already attached
        if (el._flatpickrInstance) {
            try { el._flatpickrInstance.destroy(); } catch(e){/*ignore*/ }
        }

        if (window.flatpickr) {
            el._flatpickrInstance = flatpickr(el, {
                dateFormat: "d-m-Y",
                allowInput: true,
                clickOpens: true,
                onChange: function(selectedDates, dateStr) {
                    if (!hiddenName) return;
                    const iso = ddmmyyyyToIso(dateStr);
                    let hidden = document.querySelector('input[name="' + hiddenName + '"]');
                    if (!hidden) {
                        hidden = document.createElement('input');
                        hidden.type = 'hidden';
                        hidden.name = hiddenName;
                        el.parentNode.appendChild(hidden);
                    }
                    hidden.value = iso || '';
                }
            });

            el.addEventListener('blur', function() {
                if (!hiddenName) return;
                const iso = ddmmyyyyToIso((el.value || '').trim());
                let hidden = document.querySelector('input[name="' + hiddenName + '"]');
                if (!hidden) {
                    hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = hiddenName;
                    el.parentNode.appendChild(hidden);
                }
                hidden.value = iso || '';
            }, { once: false });
            return;
        }

        // fallback (no flatpickr)
        el.addEventListener('blur', function () {
            if (!hiddenName) return;
            const iso = ddmmyyyyToIso((el.value || '').trim());
            let hidden = document.querySelector('input[name="' + hiddenName + '"]');
            if (!hidden) {
                hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = hiddenName;
                el.parentNode.appendChild(hidden);
            }
            hidden.value = iso || '';
        });
    }

    // initialize date displays initially
    document.querySelectorAll('.date-display').forEach(initDateDisplay);

    // ensure newly added date-display inputs get initialized
    document.addEventListener('click', function () {
        document.querySelectorAll('.date-display').forEach(el => {
            if (!el._dateInit) {
                initDateDisplay(el);
                el._dateInit = true;
            }
        });
    }, true);

    // Before final submit: convert all date-display fields (in case user didn't blur)
    document.getElementById('registrationForm').addEventListener('submit', function (e) {
        e.preventDefault();

        // Gather only the fields you want to check for uniqueness
        const formData = new FormData();
        formData.append('email', document.getElementById('email').value);
        formData.append('mobile_cc', document.getElementById('mobile_cc').value);
        formData.append('mobile_number', document.getElementById('mobile_number').value);
        formData.append('whatsapp_cc', document.getElementById('whatsapp_cc').value);
        formData.append('whatsapp_number', document.getElementById('whatsapp_number').value);

        fetch('{{ route('admin.candidates.ajaxValidate') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json().then(data => ({status: res.status, body: data})))
        .then(({status, body}) => {
            if (status === 422) {
                let msg = '';
                for (const field in body.errors) {
                    msg += body.errors[field].join('<br>') + '<br>';
                    const el = document.querySelector(`[name="${field}"]`);
                    if (el) el.classList.add('is-invalid');
                }
                // Show in alert box above the form
                let alertBox = document.getElementById('ajax-error-box');
                if (!alertBox) {
                    alertBox = document.createElement('div');
                    alertBox.id = 'ajax-error-box';
                    alertBox.className = 'alert alert-danger';
                    // Insert before the form
                    const form = document.getElementById('registrationForm');
                    form.parentNode.insertBefore(alertBox, form);
                }
                alertBox.innerHTML = `<strong>There were problems with your submission:</strong><br>${msg}`;
                return;
            }
            // If no errors, submit the form for real
            let alertBox = document.getElementById('ajax-error-box');
            if (alertBox) alertBox.remove();
            e.target.submit();
        })
        .catch(err => {
            alert('Validation failed. Please try again.');
            console.error(err);
        });
    });

    // Prefill city if old('city_id') exists and state is set
    @if(old('state_id'))
        document.getElementById('state_id')?.dispatchEvent(new Event('change'));
    @endif

    // Skip button logic: skip validation and go to next step
    document.querySelectorAll('.skip-step').forEach(btn => {
        btn.addEventListener('click', function () {
            const target = this.dataset.target;
            // Record skipped step
            const currentStep = getVisibleStep();
            const stepName = currentStep.replace('Step', '');
            let input = document.querySelector('input[name="skipped['+stepName+']"]');
            if (!input) {
                input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'skipped['+stepName+']';
                input.value = '1';
                document.getElementById('registrationForm').appendChild(input);
            }
            showStep(target);
        });
    });

}); // DOMContentLoaded
</script>
@endpush
