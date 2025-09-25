{{-- resources/views/admin/candidate/registration.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Seafarer Registration Portal')

@section('content')
<main class="page-content professional-bg">
    <div class="container-fluid px-4">
        <!-- Enhanced Breadcrumb -->
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="modern-breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-home-alt"></i>
                                </div>
                                <span class="breadcrumb-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.candidates.index') }}" class="breadcrumb-link">
                                <div class="breadcrumb-icon">
                                    <i class="bx bx-user-circle"></i>
                                </div>
                                <span class="breadcrumb-text">Candidates</span>
                            </a>
                        </li>
                        <li class="breadcrumb-separator">
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <div class="breadcrumb-icon">
                                <i class="bx bx-user-plus"></i>
                            </div>
                            <span class="breadcrumb-text">Register Candidate</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Global Alerts -->
        @if ($errors->any())
            <div class="modern-alert modern-alert-error mb-4">
                <div class="alert-icon">
                    <i class="bx bx-error-circle"></i>
                </div>
                <div class="alert-content">
                    <strong>Registration Validation Issues:</strong>
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                    <i class="bx bx-x"></i>
                </button>
            </div>
        @endif

        @if(session('success'))
            <div class="modern-alert modern-alert-success mb-4">
                <div class="alert-icon">
                    <i class="bx bx-check-circle"></i>
                </div>
                <div class="alert-content">
                    <strong>Success!</strong>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                    <i class="bx bx-x"></i>
                </button>
            </div>
        @endif

        @if($errors->has('error'))
            <div class="modern-alert modern-alert-error mb-4">
                <div class="alert-icon">
                    <i class="bx bx-error-circle"></i>
                </div>
                <div class="alert-content">
                    <strong>Registration Error:</strong>
                    <span>{{ $errors->first('error') }}</span>
                </div>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                    <i class="bx bx-x"></i>
                </button>
            </div>
        @endif

        <!-- Professional Progress Steps -->
        <div class="modern-professional-card mb-4">
            <div class="card-body registration-progress-body">
                <div class="professional-progress-wrapper" id="progressSteps" role="tablist" aria-label="Registration steps">
                    <div class="step professional-step active clickable-step" id="step1" data-step="personalStep" role="tab" tabindex="0" data-bs-toggle="tooltip" title="Personal Information">
                        <div class="step-indicator">
                            <div class="step-number">1</div>
                            <div class="step-icon"><i class="bx bx-user"></i></div>
                        </div>
                        <div class="step-content">
                            <div class="step-title">Personal</div>
                            <div class="step-subtitle">Basic Information</div>
                        </div>
                    </div>

                    <div class="step professional-step clickable-step" id="step2" data-step="profileStep" role="tab" tabindex="0" data-bs-toggle="tooltip" title="Professional Profile">
                        <div class="step-indicator">
                            <div class="step-number">2</div>
                            <div class="step-icon"><i class="bx bx-briefcase-alt"></i></div>
                        </div>
                        <div class="step-content">
                            <div class="step-title">Profile</div>
                            <div class="step-subtitle">Experience & Rank</div>
                        </div>
                    </div>

                    <div class="step professional-step clickable-step" id="step3" data-step="documentsStep" role="tab" tabindex="0" data-bs-toggle="tooltip" title="Documents & Certificates">
                        <div class="step-indicator">
                            <div class="step-number">3</div>
                            <div class="step-icon"><i class="bx bx-file"></i></div>
                        </div>
                        <div class="step-content">
                            <div class="step-title">Documents</div>
                            <div class="step-subtitle">Passport & CDC</div>
                        </div>
                    </div>

                    <div class="step professional-step clickable-step" id="step4" data-step="preseaStep" role="tab" tabindex="0" data-bs-toggle="tooltip" title="Pre-Sea Training">
                        <div class="step-indicator">
                            <div class="step-number">4</div>
                            <div class="step-icon"><i class="bx bx-medal"></i></div>
                        </div>
                        <div class="step-content">
                            <div class="step-title">Pre-Sea</div>
                            <div class="step-subtitle">Training & COC</div>
                        </div>
                    </div>

                    <div class="step professional-step clickable-step" id="step5" data-step="gmdssStep" role="tab" tabindex="0" data-bs-toggle="tooltip" title="GMDSS & Radio Certificates">
                        <div class="step-indicator">
                            <div class="step-number">5</div>
                            <div class="step-icon"><i class="bx bx-radio"></i></div>
                        </div>
                        <div class="step-content">
                            <div class="step-title">GMDSS</div>
                            <div class="step-subtitle">Radio & DCE</div>
                        </div>
                    </div>

                    <div class="step professional-step clickable-step" id="step6" data-step="coursesStep" role="tab" tabindex="0" data-bs-toggle="tooltip" title="Training Courses">
                        <div class="step-indicator">
                            <div class="step-number">6</div>
                            <div class="step-icon"><i class="bx bx-book-open"></i></div>
                        </div>
                        <div class="step-content">
                            <div class="step-title">Courses</div>
                            <div class="step-subtitle">Certifications</div>
                        </div>
                    </div>

                    <div class="step professional-step clickable-step" id="step7" data-step="seaServiceStep" role="tab" tabindex="0" data-bs-toggle="tooltip" title="Sea Service Experience">
                        <div class="step-indicator">
                            <div class="step-number">7</div>
                            <div class="step-icon"><i class="bx bx-ship"></i></div>
                        </div>
                        <div class="step-content">
                            <div class="step-title">Sea Service</div>
                            <div class="step-subtitle">Maritime Experience</div>
                        </div>
                    </div>

                    <div class="step professional-step clickable-step" id="step8" data-step="additionalStep" role="tab" tabindex="0" data-bs-toggle="tooltip" title="Additional Information">
                        <div class="step-indicator">
                            <div class="step-number">8</div>
                            <div class="step-icon"><i class="bx bx-check-circle"></i></div>
                        </div>
                        <div class="step-content">
                            <div class="step-title">Additional</div>
                            <div class="step-subtitle">Final Details</div>
                        </div>
                    </div>

                    <div class="progress-line">
                        <div class="progress-line-fill" id="mainProgressBar"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registration Form -->
        <form id="registrationForm" method="POST" action="{{ route('admin.candidates.store') }}" enctype="multipart/form-data" novalidate autocomplete="off">
            @csrf

            <!-- Step 1: Personal Details -->
            <div class="modern-professional-card mb-4" id="personalStep" data-step-index="1">
                <div class="card-header modern-header">
                    <div class="header-content">
                        <div class="header-icon">
                            <i class="bx bx-user"></i>
                        </div>
                        <div class="header-text">
                            <h5 class="header-title">Personal Information</h5>
                            <p class="header-subtitle">Basic personal details and contact information</p>
                        </div>
                    </div>
                </div>
                <div class="card-body modern-body">
                    <div class="modern-form-container">
                        <div class="row g-4">
                            <!-- Name Fields -->
                            <div class="col-md-4">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">First Name</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-container">
                                        <input type="text" name="first_name" id="first_name"
                                               class="modern-form-control @error('first_name') is-invalid @enderror"
                                               value="{{ old('first_name') }}" required placeholder="Enter first name">
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Middle Name</span>
                                        <span class="optional-indicator">(Optional)</span>
                                    </label>
                                    <div class="input-container">
                                        <input type="text" name="middle_name"
                                               class="modern-form-control @error('middle_name') is-invalid @enderror"
                                               value="{{ old('middle_name') }}" placeholder="Enter middle name">
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('middle_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Last Name</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-container">
                                        <input type="text" name="last_name" id="last_name"
                                               class="modern-form-control @error('last_name') is-invalid @enderror"
                                               value="{{ old('last_name') }}" required placeholder="Enter last name">
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email and Password -->
                            <div class="col-md-6">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Email Address</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-container">
                                        <input type="email" name="email" id="email"
                                               class="modern-form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" required placeholder="Enter email address">
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Password</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-container">
                                        <input type="password" name="password" id="password"
                                               class="modern-form-control @error('password') is-invalid @enderror"
                                               required placeholder="Enter password">
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Confirm Password</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-container">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                               class="modern-form-control" required placeholder="Confirm password">
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Details -->
                            <div class="col-md-4">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Marital Status</span>
                                    </label>
                                    <div class="input-container">
                                        <select name="marital_status" class="modern-form-control modern-form-select @error('marital_status') is-invalid @enderror">
                                            <option value="">Select Status</option>
                                            <option value="single" {{ old('marital_status')=='single' ? 'selected' : '' }}>Single</option>
                                            <option value="married" {{ old('marital_status')=='married' ? 'selected' : '' }}>Married</option>
                                            <option value="divorced" {{ old('marital_status')=='divorced' ? 'selected' : '' }}>Divorced</option>
                                            <option value="widowed" {{ old('marital_status')=='widowed' ? 'selected' : '' }}>Widowed</option>
                                        </select>
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('marital_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Gender</span>
                                    </label>
                                    <div class="input-container">
                                        <select name="gender" class="modern-form-control modern-form-select @error('gender') is-invalid @enderror">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender')=='male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender')=='female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('gender')=='other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Date of Birth</span>
                                    </label>
                                    <div class="input-container">
                                        <input type="text" id="dob_display"
                                               class="modern-form-control date-display @error('dob') is-invalid @enderror"
                                               placeholder="DD-MM-YYYY" data-name="dob" autocomplete="off" readonly
                                               value="{{ old('dob') ? \Carbon\Carbon::parse(old('dob'))->format('d-m-Y') : '' }}">
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    <input type="hidden" name="dob" value="{{ old('dob') }}">
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Mobile Numbers with Enhanced Design -->
                            <div class="col-md-6">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Mobile Number</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="mobile-input-group">
                                        <div class="country-code-container">
                                            <select name="mobile_cc" id="mobile_cc" class="country-code-select">
                                                @foreach($mobileCodes as $m)
                                                    <option value="{{ $m->dial_code }}"
                                                        {{ old('mobile_cc', '+91') == $m->dial_code ? 'selected' : '' }}>
                                                        {{ $m->dial_code }} {{ $m->country_code ? '('.$m->country_code.')' : '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mobile-input-container">
                                            <input type="tel" name="mobile_number" id="mobile_number"
                                                   class="mobile-number-input @error('mobile_number') is-invalid @enderror"
                                                   placeholder="Mobile Number" required value="{{ old('mobile_number') }}">
                                            <div class="validation-icon">
                                                <i class="bx bx-check-circle valid-icon"></i>
                                                <i class="bx bx-error-circle invalid-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    @error('mobile_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">WhatsApp Number</span>
                                        <span class="optional-indicator">(Optional)</span>
                                    </label>
                                    <div class="mobile-input-group">
                                        <div class="country-code-container">
                                            <select name="whatsapp_cc" id="whatsapp_cc" class="country-code-select">
                                                @foreach($mobileCodes as $m)
                                                    <option value="{{ $m->dial_code }}"
                                                        {{ old('whatsapp_cc', '+91') == $m->dial_code ? 'selected' : '' }}>
                                                        {{ $m->dial_code }} {{ $m->country_code ? '('.$m->country_code.')' : '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mobile-input-container">
                                            <input type="tel" name="whatsapp_number" id="whatsapp_number"
                                                   class="mobile-number-input" placeholder="WhatsApp Number"
                                                   value="{{ old('whatsapp_number') }}">
                                            <div class="validation-icon">
                                                <i class="bx bx-check-circle valid-icon"></i>
                                                <i class="bx bx-error-circle invalid-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="col-md-6">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Nationality</span>
                                    </label>
                                    <div class="input-container">
                                        <select name="nationality" id="nationality_select" class="modern-form-control modern-form-select">
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}" {{ (old('nationality', $defaultCountryId ?? null) == $country->id) ? 'selected' : '' }}>
                                                    {{ $country->country_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">State</span>
                                    </label>
                                    <div class="input-container">
                                        <select name="state_id" id="state_id" class="modern-form-control modern-form-select">
                                            <option value="">Select State</option>
                                            @foreach($statesForCountry as $s)
                                                <option value="{{ $s->id }}" {{ (string)old('state_id') === (string)$s->id ? 'selected' : '' }}>{{ $s->state_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('state_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">City</span>
                                    </label>
                                    <div class="input-container">
                                        <select name="city_id" id="city_id" class="modern-form-control modern-form-select">
                                            <option value="">Select City</option>
                                            @foreach($cities as $c)
                                                <option value="{{ $c->id }}" {{ (string)old('city_id') === (string)$c->id ? 'selected' : '' }}>{{ $c->city_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('city_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Address and Profile Picture -->
                            <div class="col-12">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Address</span>
                                    </label>
                                    <div class="input-container">
                                        <textarea name="address" class="modern-form-control modern-textarea" rows="3" placeholder="Enter complete address">{{ old('address') }}</textarea>
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Profile Picture</span>
                                        <span class="optional-indicator">(Optional)</span>
                                    </label>
                                    <div class="input-container">
                                        <input type="file" name="profile_pic" class="modern-form-control file-input @error('profile_pic') is-invalid @enderror" accept="image/*">
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('profile_pic')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Step Navigation -->
                        <div class="step-navigation">
                            <button type="button" class="modern-btn modern-btn-outline-secondary" disabled>
                                <i class="bx bx-chevron-left"></i>
                                <span>Previous</span>
                            </button>
                            <button type="button" class="modern-btn modern-btn-primary next-step" data-target="profileStep">
                                <span>Save & Continue</span>
                                <i class="bx bx-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Continue with remaining steps... (Profile, Documents, Pre-Sea, GMDSS, Courses, Sea Service, Additional) -->
            <!-- For brevity, I'll show the structure for one more step -->

            <!-- Step 2: Profile -->
            <div class="modern-professional-card mb-4 d-none" id="profileStep" data-step-index="2">
                <div class="card-header modern-header">
                    <div class="header-content">
                        <div class="header-icon">
                            <i class="bx bx-briefcase-alt"></i>
                        </div>
                        <div class="header-text">
                            <h5 class="header-title">Professional Profile</h5>
                            <p class="header-subtitle">Current rank, experience, and career objectives</p>
                        </div>
                    </div>
                </div>
                <div class="card-body modern-body">
                    <div class="modern-form-container">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="modern-form-group">
                                    <label class="modern-form-label">
                                        <span class="label-text">Present Rank</span>
                                        <span class="required-indicator">*</span>
                                    </label>
                                    <div class="input-container">
                                        <select name="present_rank" id="present_rank" class="modern-form-control modern-form-select @error('present_rank') is-invalid @enderror" required>
                                            <option value="">Choose Rank...</option>
                                            @foreach($ranks as $rank)
                                                <option value="{{ $rank->id }}" {{ (string)old('present_rank') === (string)$rank->id ? 'selected' : '' }}>{{ $rank->rank }}</option>
                                            @endforeach
                                        </select>
                                        <div class="validation-icon">
                                            <i class="bx bx-check-circle valid-icon"></i>
                                            <i class="bx bx-error-circle invalid-icon"></i>
                                        </div>
                                    </div>
                                    @error('present_rank')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Add other profile fields here... -->
                        </div>

                        <!-- Step Navigation -->
                        <div class="step-navigation">
                            <button type="button" class="modern-btn modern-btn-outline-secondary prev-step" data-target="personalStep">
                                <i class="bx bx-chevron-left"></i>
                                <span>Previous</span>
                            </button>
                            <button type="button" class="modern-btn modern-btn-primary next-step" data-target="documentsStep">
                                <span>Save & Continue</span>
                                <i class="bx bx-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add remaining steps following the same pattern -->
        </form>
    </div>
</main>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<style>
/* Professional Design Variables */
:root {
    --primary-color: #4f46e5;
    --primary-hover: #4338ca;
    --primary-light: #f0f4ff;
    --success-color: #059669;
    --success-hover: #047857;
    --success-light: #f0fdf9;
    --warning-color: #d97706;
    --warning-hover: #b45309;
    --warning-light: #fffbeb;
    --danger-color: #dc2626;
    --danger-hover: #b91c1c;
    --danger-light: #fef2f2;
    --info-color: #0891b2;
    --info-hover: #0e7490;
    --info-light: #f0f9ff;
    --secondary-color: #64748b;
    --secondary-hover: #475569;
    --secondary-light: #f8fafc;
    --background-primary: #f8fafc;
    --surface-elevated: #ffffff;
    --border-primary: #e2e8f0;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-muted: #94a3b8;
    --shadow-subtle: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-medium: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    --shadow-elevated: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
    --shadow-floating: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    --border-radius-sm: 8px;
    --border-radius-md: 12px;
    --border-radius-lg: 16px;
    --transition-fast: all 0.15s ease;
    --transition-medium: all 0.25s ease;
    --spacing-xs: 0.5rem;
    --spacing-sm: 0.75rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --spacing-xl: 2rem;

    /* Validation Colors */
    --valid-color: #059669;
    --valid-bg: rgba(5, 150, 105, 0.08);
    --valid-border: rgba(5, 150, 105, 0.25);
    --invalid-color: #dc2626;
    --invalid-bg: rgba(220, 38, 38, 0.08);
    --invalid-border: rgba(220, 38, 38, 0.25);
}

/* Base Styles */
* {
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.6;
    color: var(--text-primary);
    background: var(--background-primary);
}

.professional-bg {
    background: linear-gradient(135deg, var(--background-primary) 0%, #f1f5f9 100%);
    min-height: 100vh;
    padding: var(--spacing-xl) 0;
}

/* Modern Breadcrumb */
.modern-breadcrumb {
    display: flex;
    align-items: center;
    background: var(--surface-elevated);
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-subtle);
    border: 1px solid var(--border-primary);
    margin: 0;
    list-style: none;
    gap: var(--spacing-sm);
    flex-wrap: wrap;
}

.breadcrumb-item {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
}

.breadcrumb-link {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    text-decoration: none;
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    padding: var(--spacing-xs) var(--spacing-sm);
    border-radius: var(--border-radius-sm);
    transition: var(--transition-fast);
}

.breadcrumb-link:hover {
    color: var(--primary-color);
    background: var(--primary-light);
    text-decoration: none;
}

.breadcrumb-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    border-radius: 4px;
    background: var(--primary-light);
    color: var(--primary-color);
    font-size: 0.875rem;
}

.breadcrumb-link:hover .breadcrumb-icon {
    background: var(--primary-color);
    color: white;
}

.breadcrumb-text {
    font-weight: 500;
}

.breadcrumb-separator {
    color: var(--text-muted);
    font-size: 0.75rem;
}

.breadcrumb-item.active {
    color: var(--text-primary);
    font-weight: 600;
}

.breadcrumb-item.active .breadcrumb-icon {
    background: var(--primary-color);
    color: white;
}

/* Registration Header */
.registration-header-section {
    margin-bottom: var(--spacing-lg);
}

.registration-header-card {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-subtle);
    border: 1px solid var(--border-primary);
    padding: var(--spacing-xl);
    position: relative;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--spacing-lg);
}

.registration-header-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color) 0%, var(--info-color) 100%);
}

.registration-header-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    flex: 1;
    min-width: 300px;
}

.registration-header-icon {
    width: 64px;
    height: 64px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
    border-radius: var(--border-radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    flex-shrink: 0;
    box-shadow: var(--shadow-medium);
}

.registration-page-title {
    margin: 0 0 0.5rem 0;
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1.2;
}

.registration-page-subtitle {
    margin: 0;
    font-size: 1rem;
    color: var(--text-secondary);
    line-height: 1.4;
}

.registration-progress-overview {
    display: flex;
    gap: var(--spacing-xl);
    flex-wrap: wrap;
}

.progress-stat {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--primary-color);
    line-height: 1.2;
}

.stat-label {
    display: block;
    font-size: 0.875rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-top: 0.25rem;
    font-weight: 500;
}

/* Modern Alert Styling */
.modern-alert {
    display: flex;
    align-items: flex-start;
    gap: var(--spacing-md);
    padding: var(--spacing-md) var(--spacing-lg);
    border-radius: var(--border-radius-sm);
    border: 1px solid;
    position: relative;
    box-shadow: var(--shadow-subtle);
    animation: slideInDown 0.3s ease-out;
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modern-alert-success {
    background: linear-gradient(135deg, rgba(5, 150, 105, 0.08) 0%, rgba(5, 150, 105, 0.05) 100%);
    border-color: rgba(5, 150, 105, 0.2);
    color: #065f46;
}

.modern-alert-error {
    background: linear-gradient(135deg, rgba(220, 38, 38, 0.08) 0%, rgba(220, 38, 38, 0.05) 100%);
    border-color: rgba(220, 38, 38, 0.2);
    color: #7f1d1d;
}

.alert-icon {
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1rem;
}

.modern-alert-success .alert-icon {
    background: var(--success-color);
    color: white;
}

.modern-alert-error .alert-icon {
    background: var(--danger-color);
    color: white;
}

.alert-content {
    flex: 1;
    line-height: 1.5;
}

.alert-content strong {
    font-weight: 600;
    display: block;
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
}

.error-list {
    margin: 0.5rem 0 0 0;
    padding-left: 1.25rem;
    list-style-type: disc;
}

.error-list li {
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
    line-height: 1.4;
}

.alert-close {
    position: absolute;
    top: var(--spacing-sm);
    right: var(--spacing-md);
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: var(--transition-fast);
    opacity: 0.7;
}

.alert-close:hover {
    opacity: 1;
    background: rgba(0, 0, 0, 0.1);
}

/* Modern Professional Card */
.modern-professional-card {
    background: var(--surface-elevated);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-elevated);
    border: 1px solid var(--border-primary);
    overflow: hidden;
    transition: var(--transition-medium);
}

.modern-professional-card:hover {
    box-shadow: var(--shadow-floating);
}

/* Registration Progress Body */
.registration-progress-body {
    padding: var(--spacing-xl);
    background: var(--surface-elevated);
}

/* Professional Progress Steps */
.professional-progress-wrapper {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: var(--spacing-sm);
    padding: var(--spacing-md) 0;
    flex-wrap: wrap;
}

.professional-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
    transition: var(--transition-medium);
    padding: var(--spacing-sm);
    border-radius: var(--border-radius-sm);
    position: relative;
    z-index: 3;
    outline: none;
    min-width: 100px;
    text-align: center;
    flex: 1;
    max-width: 140px;
}

.professional-step:hover {
    background: rgba(79, 70, 229, 0.05);
}

.professional-step:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

.step-indicator {
    position: relative;
    margin-bottom: var(--spacing-sm);
}

.step-number {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--secondary-light);
    color: var(--text-muted);
    font-weight: 700;
    font-size: 0.875rem;
    border: 3px solid var(--border-primary);
    transition: var(--transition-medium);
    position: relative;
    z-index: 2;
}

.step-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    font-size: 1.25rem;
    color: white;
    transition: var(--transition-medium);
    z-index: 3;
}

.professional-step.active .step-number {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
    transform: scale(1.1);
    box-shadow: var(--shadow-medium);
}

.professional-step.active .step-icon {
    transform: translate(-50%, -50%) scale(1);
}

.professional-step.completed .step-number {
    background: var(--success-color);
    color: white;
    border-color: var(--success-color);
    transform: scale(1.05);
}

.professional-step.completed .step-icon {
    transform: translate(-50%, -50%) scale(1);
}

.step-content {
    text-align: center;
}

.step-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
    line-height: 1.2;
}

.step-subtitle {
    font-size: 0.75rem;
    color: var(--text-muted);
    line-height: 1.2;
}

.professional-step.active .step-title {
    color: var(--primary-color);
}

.professional-step.completed .step-title {
    color: var(--success-color);
}

/* Progress line */
.progress-line {
    position: absolute;
    top: 48px;
    left: 6%;
    right: 6%;
    height: 4px;
    background: var(--border-primary);
    border-radius: 2px;
    z-index: 1;
}

.progress-line-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--primary-color) 0%, var(--info-color) 100%);
    border-radius: 2px;
    width: 12.5%;
    transition: width 0.5s ease;
    box-shadow: var(--shadow-subtle);
}

/* Maritime-themed Header Styling */
.modern-header {
    background: linear-gradient(135deg, var(--info-light) 0%, #e0f7fa 100%);
    color: var(--info-color);
    padding: var(--spacing-lg);
    border: none;
    position: relative;
    overflow: hidden;
}

.modern-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="waves" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M0 20 Q10 10 20 20 T40 20" stroke="rgba(8,145,178,0.1)" stroke-width="2" fill="none"/></pattern></defs><rect width="100" height="100" fill="url(%23waves)"/></svg>');
    opacity: 1;
}

.header-content {
    display: flex;
    align-items: center;
    gap: var(--spacing-md);
    position: relative;
    z-index: 1;
}

.header-icon {
    background: rgba(8, 145, 178, 0.15);
    padding: var(--spacing-md);
    border-radius: var(--border-radius-sm);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(8, 145, 178, 0.2);
}

.header-icon i {
    font-size: 1.5rem;
    color: var(--info-color);
}

.header-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    letter-spacing: -0.025em;
    color: var(--info-color);
}

.header-subtitle {
    margin: 0;
    font-size: 0.875rem;
    color: var(--info-hover);
    font-weight: 400;
}

/* Modern Body */
.modern-body {
    padding: var(--spacing-xl);
    background: var(--surface-elevated);
}

/* Form Container */
.modern-form-container {
    background: linear-gradient(145deg, #fafbff 0%, #f1f5f9 100%);
    border: 1px solid rgba(8, 145, 178, 0.1);
    border-radius: var(--border-radius-md);
    padding: var(--spacing-xl);
    transition: var(--transition-fast);
    position: relative;
}

.modern-form-container:hover {
    box-shadow: var(--shadow-medium);
    border-color: rgba(8, 145, 178, 0.2);
}

.modern-form-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, var(--info-color) 0%, var(--info-hover) 100%);
    border-radius: 2px 0 0 2px;
    opacity: 0;
    transition: var(--transition-fast);
}

.modern-form-container:hover::before {
    opacity: 1;
}

/* Form Groups */
.modern-form-group {
    margin-bottom: var(--spacing-lg);
    position: relative;
}

.modern-form-label {
    display: flex;
    align-items: center;
    gap: var(--spacing-xs);
    margin-bottom: var(--spacing-sm);
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
}

.label-text {
    color: var(--text-primary);
}

.required-indicator {
    color: var(--danger-color);
    font-weight: 700;
}

.optional-indicator {
    color: var(--text-muted);
    font-weight: 400;
    font-style: italic;
}

/* Enhanced Input Container for Validation */
.input-container {
    position: relative;
    display: flex;
    align-items: center;
}

/* Form Controls with Validation States */
.modern-form-control {
    width: 100%;
    padding: var(--spacing-sm) 2.5rem var(--spacing-sm) var(--spacing-md);
    font-size: 0.875rem;
    line-height: 1.5;
    color: var(--text-primary);
    background: white;
    border: 2px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    transition: var(--transition-fast);
    box-shadow: var(--shadow-subtle);
}

.modern-form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    background: white;
}

.modern-form-control::placeholder {
    color: var(--text-muted);
    opacity: 1;
}

.modern-form-control:hover {
    border-color: var(--text-secondary);
}

/* Modern Textarea */
.modern-textarea {
    resize: vertical;
    min-height: 100px;
    padding-top: var(--spacing-md);
}

/* Modern Select */
.modern-form-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
}

/* File Input */
.file-input {
    padding: 0.75rem var(--spacing-md);
}

/* Validation States */
.modern-form-control:valid:not(:placeholder-shown):not(:focus) {
    border-color: var(--valid-border);
    background: var(--valid-bg);
}

.modern-form-control:valid:not(:placeholder-shown):not(:focus) + .validation-icon .valid-icon {
    display: block;
}

.modern-form-control.is-invalid,
.modern-form-control:invalid:not(:placeholder-shown):not(:focus) {
    border-color: var(--invalid-border);
    background: var(--invalid-bg);
}

.modern-form-control.is-invalid + .validation-icon .invalid-icon,
.modern-form-control:invalid:not(:placeholder-shown):not(:focus) + .validation-icon .invalid-icon {
    display: block;
}

/* Validation Icons */
.validation-icon {
    position: absolute;
    right: var(--spacing-sm);
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    z-index: 2;
}

.valid-icon,
.invalid-icon {
    display: none;
    font-size: 1rem;
    transition: var(--transition-fast);
}

.valid-icon {
    color: var(--valid-color);
    animation: scaleIn 0.3s ease-out;
}

.invalid-icon {
    color: var(--invalid-color);
    animation: shake 0.5s ease-out;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-2px); }
    75% { transform: translateX(2px); }
}

/* Invalid Feedback Messages */
.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.375rem;
    padding: var(--spacing-sm) var(--spacing-sm);
    font-size: 0.8125rem;
    color: var(--invalid-color);
    background: var(--invalid-bg);
    border: 1px solid var(--invalid-border);
    border-radius: var(--border-radius-sm);
    line-height: 1.4;
    position: relative;
}

.invalid-feedback::before {
    content: '';
    position: absolute;
    top: -4px;
    left: var(--spacing-md);
    width: 8px;
    height: 8px;
    background: var(--invalid-bg);
    border-left: 1px solid var(--invalid-border);
    border-top: 1px solid var(--invalid-border);
    transform: rotate(45deg);
}

/* Mobile Input Group */
.mobile-input-group {
    display: flex;
    gap: 1px;
    background: var(--border-primary);
    border-radius: var(--border-radius-sm);
    overflow: hidden;
}

.country-code-container {
    flex-shrink: 0;
}

.country-code-select {
    padding: var(--spacing-sm);
    border: 2px solid var(--border-primary);
    border-right: none;
    background: white;
    font-size: 0.875rem;
    min-width: 100px;
    border-radius: var(--border-radius-sm) 0 0 var(--border-radius-sm);
    transition: var(--transition-fast);
}

.country-code-select:focus {
    outline: none;
    border-color: var(--primary-color);
    z-index: 2;
    position: relative;
}

.mobile-input-container {
    flex: 1;
    position: relative;
    display: flex;
    align-items: center;
}

.mobile-number-input {
    width: 100%;
    padding: var(--spacing-sm) 2.5rem var(--spacing-sm) var(--spacing-md);
    font-size: 0.875rem;
    line-height: 1.5;
    color: var(--text-primary);
    background: white;
    border: 2px solid var(--border-primary);
    border-left: none;
    border-radius: 0 var(--border-radius-sm) var(--border-radius-sm) 0;
    transition: var(--transition-fast);
}

.mobile-number-input:focus {
    outline: none;
    border-color: var(--primary-color);
    z-index: 2;
    position: relative;
}

/* Modern Buttons */
.modern-btn {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-xs);
    padding: 0.75rem 1.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    line-height: 1;
    border-radius: var(--border-radius-sm);
    border: 2px solid transparent;
    text-decoration: none;
    cursor: pointer;
    transition: var(--transition-fast);
    white-space: nowrap;
    text-align: center;
    justify-content: center;
    min-width: auto;
    position: relative;
    overflow: hidden;
}

.modern-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
}

.modern-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

.modern-btn-primary {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.modern-btn-primary:hover:not(:disabled) {
    background: var(--primary-hover);
    border-color: var(--primary-hover);
    color: white;
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

.modern-btn-success {
    background: var(--success-color);
    color: white;
    border-color: var(--success-color);
}

.modern-btn-success:hover:not(:disabled) {
    background: var(--success-hover);
    border-color: var(--success-hover);
    color: white;
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

.modern-btn-outline-secondary {
    background: white;
    color: var(--secondary-color);
    border-color: var(--border-primary);
}

.modern-btn-outline-secondary:hover:not(:disabled) {
    background: var(--secondary-color);
    color: white;
    border-color: var(--secondary-color);
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

/* Step Navigation */
.step-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: var(--spacing-md);
    margin-top: var(--spacing-xl);
    padding-top: var(--spacing-lg);
    border-top: 2px dashed rgba(8, 145, 178, 0.2);
    background: linear-gradient(135deg, rgba(8, 145, 178, 0.02) 0%, rgba(8, 145, 178, 0.05) 100%);
    border-radius: var(--border-radius-sm);
    padding: var(--spacing-md);
}

/* Animations */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideOutUp {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-30px);
    }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .registration-progress-overview {
        justify-content: center;
        gap: var(--spacing-lg);
    }

    .professional-progress-wrapper {
        flex-wrap: wrap;
        gap: var(--spacing-xs);
        justify-content: center;
    }

    .professional-step {
        min-width: 80px;
        flex: 0 0 auto;
    }
}

@media (max-width: 768px) {
    .professional-bg {
        padding: var(--spacing-md) 0;
    }

    .registration-header-card {
        flex-direction: column;
        text-align: center;
        gap: var(--spacing-md);
    }

    .registration-page-title {
        font-size: 1.5rem;
    }

    .professional-step {
        min-width: 70px;
    }

    .step-number {
        width: 40px;
        height: 40px;
        font-size: 0.75rem;
    }

    .step-title {
        font-size: 0.75rem;
    }

    .step-subtitle {
        font-size: 0.625rem;
    }

    .modern-body {
        padding: var(--spacing-lg);
    }

    .modern-form-container {
        padding: var(--spacing-lg);
    }

    .step-navigation {
        flex-direction: column-reverse;
        gap: var(--spacing-md);
    }

    .modern-btn {
        width: 100%;
    }

    .mobile-input-group {
        flex-direction: column;
        gap: var(--spacing-xs);
    }

    .country-code-select {
        border-radius: var(--border-radius-sm);
        border-right: 2px solid var(--border-primary);
    }

    .mobile-number-input {
        border-radius: var(--border-radius-sm);
        border-left: 2px solid var(--border-primary);
    }

    .progress-line {
        display: none;
    }
}

@media (max-width: 480px) {
    .registration-progress-overview {
        flex-direction: column;
        gap: var(--spacing-md);
        text-align: center;
    }

    .professional-progress-wrapper {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: var(--spacing-xs);
    }

    .professional-step {
        min-width: auto;
    }
}

/* Focus States for Accessibility */
.modern-form-control:focus,
.modern-btn:focus,
.breadcrumb-link:focus,
.professional-step:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

/* Loading States */
.loading {
    pointer-events: none;
    opacity: 0.7;
}

.loading::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    margin: auto;
    border: 2px solid transparent;
    border-top-color: currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    :root {
        --border-primary: #000000;
        --text-primary: #000000;
        --background-primary: #ffffff;
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    console.log('Registration form loaded');

    // Step navigation functionality
    const steps = ['personalStep','profileStep','documentsStep','preseaStep','gmdssStep','coursesStep','seaServiceStep','additionalStep'];
    let currentStepIndex = 0;

    // Initialize first step
    showStep('personalStep');

    function showStep(stepId) {
        console.log('Showing step:', stepId);

        steps.forEach(id => {
            const el = document.getElementById(id);
            if (!el) return;

            if (id === stepId) {
                el.classList.remove('d-none');
                el.style.animation = 'slideInUp 0.3s ease-out';
            } else {
                el.classList.add('d-none');
            }
        });

        currentStepIndex = steps.indexOf(stepId);
        updateProgress(stepId);
    }

    function updateProgress(currentId) {
        const idx = steps.indexOf(currentId);
        const percent = ((idx + 1) / steps.length) * 100;
        const bar = document.getElementById('mainProgressBar');
        if (bar) {
            bar.style.width = percent + '%';
        }

        // Update completion percentage
        const completionEl = document.getElementById('completionPercent');
        if (completionEl) {
            completionEl.textContent = Math.round(percent) + '%';
        }

        // Update step indicators
        steps.forEach((id, i) => {
            const stepEl = document.getElementById('step' + (i+1));
            if (!stepEl) return;

            stepEl.classList.remove('active','completed');
            if (i < idx) stepEl.classList.add('completed');
            if (i === idx) stepEl.classList.add('active');
        });
    }

    // Next step buttons
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('next-step') || e.target.closest('.next-step')) {
            e.preventDefault();
            const button = e.target.classList.contains('next-step') ? e.target : e.target.closest('.next-step');
            const targetStep = button.getAttribute('data-target');

            if (validateCurrentStep()) {
                showStep(targetStep);
            }
        }
    });

    // Previous step buttons
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('prev-step') || e.target.closest('.prev-step')) {
            e.preventDefault();
            const button = e.target.classList.contains('prev-step') ? e.target : e.target.closest('.prev-step');
            const targetStep = button.getAttribute('data-target');
            showStep(targetStep);
        }
    });

    // Clickable step navigation
    document.addEventListener('click', function(e) {
        if (e.target.closest('.clickable-step')) {
            const stepEl = e.target.closest('.clickable-step');
            const targetStep = stepEl.getAttribute('data-step');
            showStep(targetStep);
        }
    });

    // Form validation
    function validateCurrentStep() {
        const currentStep = steps[currentStepIndex];
        const stepElement = document.getElementById(currentStep);
        if (!stepElement) return true;

        const requiredInputs = stepElement.querySelectorAll('input[required], select[required]');
        let isValid = true;

        requiredInputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                isValid = false;

                // Show error message
                showFieldError(input, 'This field is required');
            } else {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                hideFieldError(input);
            }
        });

        // Password confirmation validation
        if (currentStep === 'personalStep') {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');

            if (password && confirmPassword) {
                if (password.value !== confirmPassword.value) {
                    confirmPassword.classList.add('is-invalid');
                    showFieldError(confirmPassword, 'Passwords do not match');
                    isValid = false;
                } else if (password.value && confirmPassword.value) {
                    confirmPassword.classList.remove('is-invalid');
                    confirmPassword.classList.add('is-valid');
                    hideFieldError(confirmPassword);
                }
            }
        }

        if (!isValid) {
            // Scroll to first invalid field
            const firstInvalid = stepElement.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalid.focus();
            }
        }

        return isValid;
    }

    function showFieldError(field, message) {
        // Remove existing error
        hideFieldError(field);

        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.textContent = message;

        field.parentNode.appendChild(errorDiv);
    }

    function hideFieldError(field) {
        const existingError = field.parentNode.querySelector('.invalid-feedback');
        if (existingError) {
            existingError.remove();
        }
    }

    // Real-time validation
    document.addEventListener('input', function(e) {
        const input = e.target;
        if (input.classList.contains('modern-form-control')) {
            validateField(input);
        }
    });

    document.addEventListener('blur', function(e) {
        const input = e.target;
        if (input.classList.contains('modern-form-control')) {
            validateField(input);
        }
    });

    function validateField(field) {
        const isRequired = field.hasAttribute('required');
        const hasValue = field.value.trim() !== '';
        const isValid = field.checkValidity();

        // Remove previous validation classes
        field.classList.remove('is-valid', 'is-invalid');
        hideFieldError(field);

        if (isRequired && !hasValue) {
            field.classList.add('is-invalid');
            showFieldError(field, 'This field is required');
        } else if (hasValue && !isValid) {
            field.classList.add('is-invalid');
            showFieldError(field, field.validationMessage || 'Please enter a valid value');
        } else if (hasValue && isValid) {
            field.classList.add('is-valid');
        }

        // Special validation for password confirmation
        if (field.id === 'password_confirmation') {
            const password = document.getElementById('password');
            if (password && field.value && password.value !== field.value) {
                field.classList.remove('is-valid');
                field.classList.add('is-invalid');
                showFieldError(field, 'Passwords do not match');
            }
        }

        // Update password confirmation when password changes
        if (field.id === 'password') {
            const confirmPassword = document.getElementById('password_confirmation');
            if (confirmPassword && confirmPassword.value) {
                validateField(confirmPassword);
            }
        }
    }

    // Date picker initialization
    const dateInputs = document.querySelectorAll('.date-display');
    dateInputs.forEach(input => {
        flatpickr(input, {
            dateFormat: "d-m-Y",
            allowInput: true,
            maxDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                const hiddenName = input.getAttribute('data-name');
                if (hiddenName) {
                    let hiddenInput = document.querySelector(`input[name="${hiddenName}"]`);
                    if (!hiddenInput) {
                        hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = hiddenName;
                        input.parentNode.appendChild(hiddenInput);
                    }
                    if (selectedDates.length > 0) {
                        const date = selectedDates[0];
                        const year = date.getFullYear();
                        const month = String(date.getMonth() + 1).padStart(2, '0');
                        const day = String(date.getDate()).padStart(2, '0');
                        hiddenInput.value = `${year}-${month}-${day}`;
                    }

                    // Trigger validation
                    validateField(input);
                }
            }
        });
    });

    // Form submission
    document.getElementById('registrationForm')?.addEventListener('submit', function(e) {
        console.log('Form submitted');

        // Validate all steps before submission
        let allValid = true;
        steps.forEach(stepId => {
            const stepElement = document.getElementById(stepId);
            if (stepElement) {
                const requiredInputs = stepElement.querySelectorAll('input[required], select[required]');
                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('is-invalid');
                        allValid = false;
                    }
                });
            }
        });

        if (!allValid) {
            e.preventDefault();
            alert('Please fill in all required fields before submitting.');
            return;
        }

        const submitBtn = document.getElementById('submitBtn');
        if (submitBtn) {
            submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i><span>Processing Registration...</span>';
            submitBtn.disabled = true;
            submitBtn.classList.add('loading');
        }
    });

    // Auto-hide alerts
    setTimeout(() => {
        document.querySelectorAll('.modern-alert').forEach(alert => {
            alert.style.animation = 'slideOutUp 0.3s ease-out';
            setTimeout(() => alert.remove(), 300);
        });
    }, 5000);

    // Initialize tooltips if Bootstrap is available
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    console.log('Registration form initialization complete');
});
</script>
@endpush
