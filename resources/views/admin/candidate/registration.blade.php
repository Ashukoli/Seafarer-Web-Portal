{{-- resources/views/admin/candidate/registration.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<main class="page-content">
    <div class="page-breadcrumb mb-3 d-flex align-items-center">
        <div>
            <h4 class="mb-0">Candidate</h4>
            <small class="text-muted">Register New Candidate</small>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>

    <!-- Progress / Steps -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="progress-steps" id="progressSteps">
                <div class="step clickable-step" id="step1" data-step="personalStep">
                    <div class="step-number">1</div>
                    <div class="step-title">Personal</div>
                </div>
                <div class="step clickable-step" id="step2" data-step="profileStep">
                    <div class="step-number">2</div>
                    <div class="step-title">Profile</div>
                </div>
                <div class="step clickable-step" id="step3" data-step="documentsStep">
                    <div class="step-number">3</div>
                    <div class="step-title">Documents</div>
                </div>
                <div class="step clickable-step" id="step4" data-step="preseaStep">
                    <div class="step-number">4</div>
                    <div class="step-title">Pre-Sea</div>
                </div>
                <div class="step clickable-step" id="step5" data-step="gmdssStep">
                    <div class="step-number">5</div>
                    <div class="step-title">GMDSS / DCE</div>
                </div>
                <div class="step clickable-step" id="step6" data-step="coursesStep">
                    <div class="step-number">6</div>
                    <div class="step-title">Courses</div>
                </div>
                <div class="step clickable-step" id="step7" data-step="seaServiceStep">
                    <div class="step-number">7</div>
                    <div class="step-title">Sea Service</div>
                </div>
                <div class="step clickable-step" id="step8" data-step="additionalStep">
                    <div class="step-number">8</div>
                    <div class="step-title">Additional</div>
                </div>

                <div class="progress"><div class="progress-bar" id="mainProgressBar" role="progressbar" style="width:12.5%"></div></div>
            </div>
        </div>
    </div>

    <form id="registrationForm" method="POST" action="{{ route('admin.candidates.store') }}" enctype="multipart/form-data" novalidate>
        @csrf

        <!-- Step 1: Personal -->
        <div class="card mb-4" id="personalStep" data-step-index="1">
            <div class="card-header bg-light"><h5 class="mb-0">Personal Details</h5></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">First Name *</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" required>
                        <div class="invalid-feedback">Please enter first name.</div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Middle Name</label>
                        <input type="text" name="middle_name" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Last Name *</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" required>
                        <div class="invalid-feedback">Please enter last name.</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                        <div class="invalid-feedback">Please enter a valid email.</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Password *</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <div class="invalid-feedback">Password must be at least 6 characters.</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Confirm Password *</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        <div class="invalid-feedback">Passwords must match.</div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Marital Status</label>
                        <select name="marital_status" class="form-select">
                            <option value="">Select</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="widowed">Widowed</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="dob" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Mobile Number *</label>
                        <div class="input-group">
                            <select name="mobile_cc" id="mobile_cc" class="form-select" style="max-width:140px;">
                                @foreach($mobileCodes as $m)
                                    <option value="{{ $m->dial_code }}" {{ ($m->dial_code == '+91') ? 'selected' : '' }}>{{ $m->dial_code }} ({{ $m->country_code ?? '' }})</option>
                                @endforeach
                            </select>
                            <input type="tel" name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile Number" required>
                            <div class="invalid-feedback">Please enter mobile number.</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">WhatsApp Number</label>
                        <div class="input-group">
                            <select name="whatsapp_cc" id="whatsapp_cc" class="form-select" style="max-width:140px;">
                                @foreach($mobileCodes as $m)
                                    <option value="{{ $m->dial_code }}" {{ ($m->dial_code == '+91') ? 'selected' : '' }}>{{ $m->dial_code }}</option>
                                @endforeach
                            </select>
                            <input type="tel" name="whatsapp_number" id="whatsapp_number" class="form-control" placeholder="WhatsApp Number">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nationality</label>
                        <input type="text" name="nationality" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">State</label>
                        <select name="state_id" id="state_id" class="form-select">
                            <option value="">Select</option>
                            @foreach($states as $s)
                                <option value="{{ $s->id }}">{{ $s->state_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">City</label>
                        <select name="city_id" id="city_id" class="form-select">
                            <option value="">Select</option>
                            @foreach($cities as $c)
                                <option value="{{ $c->id }}">{{ $c->city_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" name="profile_pic" class="form-control">
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
            <div class="card-header bg-light"><h5 class="mb-0">Profile & Total Experience</h5></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Present Rank *</label>
                        <select name="present_rank" id="present_rank" class="form-select" required>
                            <option value="">Choose rank...</option>
                            @foreach($ranks as $rank)
                                <option value="{{ $rank->id }}">{{ $rank->rank }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose your present rank.</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Present Rank Experience *</label>
                        <select name="present_rank_exp" id="present_rank_exp" class="form-select" required>
                            <option value="">Choose experience...</option>
                            <option value="fresher">Fresher</option>
                            <option value="6_months">6 Months</option>
                            <option value="1_year">1 Year</option>
                            <option value="2_years">2 Years</option>
                        </select>
                        <div class="invalid-feedback">Please choose experience.</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Post Applied For</label>
                        <select name="post_applied_for" class="form-select">
                            <option value="">Select...</option>
                            @foreach($ranks as $rank)
                                <option value="{{ $rank->id }}">{{ $rank->rank }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date of Availability</label>
                        <input type="date" name="date_of_availability" class="form-control">
                    </div>

                    <div class="col-12 mt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary prev-step" data-target="personalStep">Previous</button>
                        <button type="button" class="btn btn-primary next-step" data-target="documentsStep">Save & Continue</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3: Documents -->
        <div class="card mb-4 d-none" id="documentsStep" data-step-index="3">
            <div class="card-header bg-light"><h5 class="mb-0">Passport & Seamen Book</h5></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Passport Nationality</label>
                        <input type="text" name="passport_nationality" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Passport Number</label>
                        <input type="text" name="passport_number" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Passport Expiry</label>
                        <input type="date" name="passport_expiry" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">CDC Nationality</label>
                        <input type="text" name="cdc_nationality" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">CDC Number</label>
                        <input type="text" name="cdc_no" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">CDC Expiry</label>
                        <input type="date" name="cdc_expiry" class="form-control">
                    </div>

                    <div class="col-12 mt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary prev-step" data-target="profileStep">Previous</button>
                        <button type="button" class="btn btn-primary next-step" data-target="preseaStep">Save & Continue</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 4: PreSea & COC -->
        <div class="card mb-4 d-none" id="preseaStep" data-step-index="4">
            <div class="card-header bg-light"><h5 class="mb-0">Pre-Sea & COC/COP</h5></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Pre-Sea Training Type</label>
                        <input type="text" name="presea_training_type" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Issue Date</label>
                        <input type="date" name="presea_training_issue_date" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">COC Held</label>
                        <select name="coc_held" class="form-select">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">COC No.</label>
                        <input type="text" name="coc_no" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">COC Expiry</label>
                        <input type="date" name="coc_date_of_expiry" class="form-control">
                    </div>

                    <div class="col-12 mt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary prev-step" data-target="documentsStep">Previous</button>
                        <button type="button" class="btn btn-primary next-step" data-target="gmdssStep">Save & Continue</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 5: GMDSS / DCE -->
        <div class="card mb-4 d-none" id="gmdssStep" data-step-index="5">
            <div class="card-header bg-light"><h5 class="mb-0">GMDSS & DCE Endorsements</h5></div>
            <div class="card-body">
                <div id="dceContainer">
                    <div class="dce-entry row g-3 mb-2">
                        <div class="col-md-6">
                            <label class="form-label">Select DCE / GMDSS</label>
                            <select name="dce_id[]" class="form-select">
                                <option value="">Choose...</option>
                                @foreach($dces as $d)
                                    <option value="{{ $d->id }}">{{ $d->dce_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Validity Date</label>
                            <input type="date" name="dce_validity[]" class="form-control">
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-outline-danger remove-dce d-none">&times;</button>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="button" id="addDce" class="btn btn-outline-primary"><i class="bx bx-plus"></i> Add More</button>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button type="button" class="btn btn-outline-secondary prev-step" data-target="preseaStep">Previous</button>
                    <button type="button" class="btn btn-primary next-step" data-target="coursesStep">Save & Continue</button>
                </div>
            </div>
        </div>

        <!-- Step 6: Courses (multiselect dropdown with checkboxes) -->
        <div class="card mb-4 d-none" id="coursesStep" data-step-index="6">
            <div class="card-header bg-light"><h5 class="mb-0">Valid Course Details</h5></div>
            <div class="card-body">
                <label class="form-label">Select Course(s)</label>
                <div class="multiselect-dropdown" id="courseSelection">
                    <div class="dropdown-toggle" id="courseToggle" tabindex="0">
                        <span class="selected-text">Select courses...</span>
                        <i class="bx bx-chevron-down"></i>
                    </div>
                    <div class="dropdown-menu" id="courseMenu" aria-labelledby="courseToggle">
                        @foreach($courses as $course)
                            <label class="dropdown-item">
                                <input type="checkbox" name="courses[]" value="{{ $course->id }}"> {{ $course->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-secondary prev-step" data-target="gmdssStep">Previous</button>
                    <button type="button" class="btn btn-primary next-step" data-target="seaServiceStep">Save & Continue</button>
                </div>
            </div>
        </div>

        <!-- Step 7: Sea Service (includes tonnage field) -->
        <div class="card mb-4 d-none" id="seaServiceStep" data-step-index="7">
            <div class="card-header bg-light"><h5 class="mb-0">Sea Service Details</h5></div>
            <div class="card-body">
                <div id="seaServiceContainer">
                    <div class="sea-service-entry border rounded p-3 mb-3">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Rank</label>
                                <select name="sea_service[0][rank_id]" class="form-select">
                                    <option value="">Select</option>
                                    @foreach($ranks as $rank)
                                        <option value="{{ $rank->id }}">{{ $rank->rank }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Ship Type</label>
                                <select name="sea_service[0][ship_type_id]" class="form-select">
                                    <option value="">Select</option>
                                    @foreach($shiptypes as $s)
                                        <option value="{{ $s->id }}">{{ $s->ship_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Sign On</label>
                                <input type="date" name="sea_service[0][sign_on]" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Sign Off</label>
                                <input type="date" name="sea_service[0][sign_off]" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Tonnage</label>
                                <input type="text" name="sea_service[0][tonnage]" class="form-control" placeholder="e.g. 50000">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="sea_service[0][company_name]" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Ship Name</label>
                                <input type="text" name="sea_service[0][ship_name]" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">GRT</label>
                                <input type="text" name="sea_service[0][grt]" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">BHP</label>
                                <input type="text" name="sea_service[0][bhp]" class="form-control">
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
                    <button type="button" class="btn btn-primary next-step" data-target="additionalStep">Save & Continue</button>
                </div>
            </div>
        </div>

        <!-- Step 8: Additional & Submit -->
        <div class="card mb-4 d-none" id="additionalStep" data-step-index="8">
            <div class="card-header bg-light"><h5 class="mb-0">Additional Details</h5></div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Additional Information</label>
                        <textarea name="additional_information" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-12 mt-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary prev-step" data-target="seaServiceStep">Previous</button>
                        <div>
                            <button type="submit" class="btn btn-success" id="submitBtn"><i class="bx bx-save me-1"></i> Register Candidate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>

{{-- Inline CSS (embedded directly into this blade) --}}
<style>
/* Steps / progress styling (robust against admin theme) */
.progress-steps {
  position: relative;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: .5rem;
  padding: 0.6rem 0 1.8rem;
}
.progress-steps .step {
  flex: 1 1 0;
  min-width: 68px;
  max-width: 160px;
  display:flex;
  flex-direction:column;
  align-items:center;
  z-index:3;
  cursor:pointer;
  text-align:center;
}
.progress-steps .step-number {
  width:36px;height:36px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  background:#e9ecef;color:#6c757d;font-weight:600;margin-bottom:6px;border:2px solid transparent;
}
.progress-steps .step-title { font-size:0.78rem;color:#6c757d;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100%;}
.progress-steps .step.active .step-number { background:#0d6efd;color:#fff;border-color:#0d6efd; transform:scale(1.05); }
.progress-steps .step.completed .step-number { background:#198754;color:#fff;border-color:#198754; }

/* progress line */
.progress-steps .progress { position:absolute; left:12px; right:12px; top:16px; height:6px; background:#e9ecef; border-radius:3px; z-index:1; }
.progress-steps .progress-bar { height:6px; background:#0d6efd; width:0%; border-radius:3px; transition:width .3s ease; z-index:2; }

/* Multiselect dropdown */
.multiselect-dropdown { position:relative; width:100%; }
.multiselect-dropdown .dropdown-toggle { border:1px solid #e5e7eb; padding:10px 12px; border-radius:8px; display:flex; justify-content:space-between; align-items:center; cursor:pointer; background:#fff; }
.multiselect-dropdown .dropdown-menu { display:none; position:absolute; top:100%; left:0; right:0; background:#fff; border:1px solid #e5e7eb; max-height:260px; overflow:auto; z-index:999; padding:6px; margin-top:0; border-top:none; }
.multiselect-dropdown .dropdown-menu.show { display:block; }
.multiselect-dropdown .dropdown-item { display:block; padding:6px 8px; }

/* small screen adjustments */
@media(max-width:768px) {
  .progress-steps { overflow-x:auto; -webkit-overflow-scrolling:touch; padding-bottom:1rem; }
  .progress-steps .step-number { width:30px;height:30px; font-size:0.85rem; }
  .progress-steps .step-title { font-size:0.65rem; }
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Step logic
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

        // step visuals
        steps.forEach((id, i) => {
            const stepEl = document.getElementById('step' + (i+1));
            if (!stepEl) return;
            stepEl.classList.remove('active','completed');
            if (i < idx) stepEl.classList.add('completed');
            if (i === idx) stepEl.classList.add('active');
        });
    }

    // initial
    showStep('personalStep');

    // clickable steps (prevent skipping personal/profile)
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
    });

    // next / prev handlers
    document.querySelectorAll('.next-step').forEach(btn => {
        btn.addEventListener('click', function () {
            const target = this.dataset.target;
            const current = getVisibleStep();
            if (current === 'personalStep' || current === 'profileStep') {
                validateStep(current, () => showStep(target));
            } else {
                showStep(target);
            }
        });
    });
    document.querySelectorAll('.prev-step').forEach(btn => {
        btn.addEventListener('click', function() {
            showStep(this.dataset.target);
        });
    });

    function getVisibleStep() {
        for (const id of steps) {
            const el = document.getElementById(id);
            if (el && !el.classList.contains('d-none')) return id;
        }
        return steps[0];
    }

    // quick client-side validation for required fields for personal/profile
    function validateStep(stepId, onSuccess) {
        const stepMap = {
            personalStep: ['#first_name','#last_name','#email','#mobile_number','#password','#password_confirmation'],
            profileStep: ['#present_rank','#present_rank_exp']
        };
        const selectors = stepMap[stepId] || [];
        let ok = true;
        for (const sel of selectors) {
            const el = document.querySelector(sel);
            if (!el) { ok = false; continue; }
            const v = (el.value || '').trim();
            if (!v) {
                el.classList.add('is-invalid');
                ok = false;
            } else {
                el.classList.remove('is-invalid');
            }
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
        if (!ok) {
            const first = document.querySelector('.is-invalid');
            if (first) first.focus();
            return;
        }
        if (typeof onSuccess === 'function') onSuccess();
    }

    function canNavigateTo(targetId) {
        try {
            const pOk = isQuickValid('#personalStep', ['#first_name','#last_name','#email','#mobile_number']);
            const prOk = isQuickValid('#profileStep', ['#present_rank','#present_rank_exp']);
            const currentIdx = steps.indexOf(getVisibleStep());
            const targetIdx = steps.indexOf(targetId);
            if (targetIdx <= currentIdx) return true;
            return pOk && prOk;
        } catch (e) { return false; }
    }

    function isQuickValid(stepSelector, fields) {
        for (const sel of fields) {
            const el = document.querySelector(sel);
            if (!el) return false;
            if (!(el.value || '').trim()) return false;
        }
        return true;
    }

    // Remove is-invalid on input
    document.querySelectorAll('#registrationForm input, #registrationForm select, #registrationForm textarea').forEach(el=>{
        el.addEventListener('input', ()=> el.classList.remove('is-invalid'));
    });

    // ---------------- DCE add/remove ----------------
    document.getElementById('addDce').addEventListener('click', function () {
        const container = document.getElementById('dceContainer');
        const template = container.querySelector('.dce-entry').cloneNode(true);
        // clear values
        template.querySelectorAll('select,input').forEach(i => i.value = '');
        template.querySelector('.remove-dce').classList.remove('d-none');
        template.querySelector('.remove-dce').addEventListener('click', ()=> template.remove());
        container.appendChild(template);
    });
    document.querySelectorAll('.remove-dce').forEach(btn => btn.addEventListener('click', function(){ this.closest('.dce-entry').remove(); }));

    // ---------------- Sea service add/remove ----------------
    let serviceIndex = 1;
    document.getElementById('addSeaService').addEventListener('click', function () {
        const container = document.getElementById('seaServiceContainer');
        const template = container.querySelector('.sea-service-entry').cloneNode(true);

        // update names with index
        template.querySelectorAll('input,select').forEach(el => {
            if (el.name) {
                el.name = el.name.replace(/\[0\]/, `[${serviceIndex}]`);
                el.value = '';
            }
        });

        template.querySelector('.removeSeaService').classList.remove('d-none');
        template.querySelector('.removeSeaService').addEventListener('click', ()=> template.remove());
        container.appendChild(template);
        serviceIndex++;
    });

    // multiselect dropdown (courses)
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

    // final submit: optional client-side check - ensure passwords match etc
    document.getElementById('registrationForm').addEventListener('submit', function (e) {
        const pw = document.querySelector('#password')?.value || '';
        const cpw = document.querySelector('#password_confirmation')?.value || '';
        if (pw && pw.length < 6) {
            e.preventDefault();
            alert('Password must be at least 6 characters.');
            return;
        }
        if (pw !== cpw) {
            e.preventDefault();
            alert('Passwords do not match.');
            return;
        }
        // allow form to submit
    });

}); // DOMContentLoaded
</script>
@endpush
