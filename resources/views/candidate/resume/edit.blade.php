@extends('layouts.candidate.app')
@section('content')
<main class="page-content">
    <!-- Breadcrumb -->
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
                        <i class="bx bx-file-text me-1"></i>Edit Resume
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="progress-steps">
                <div class="step clickable-step" id="step1" onclick="showForm('personalDetailsForm')">
                    <div class="step-number">1</div>
                    <div class="step-title">Personal</div>
                </div>
                <div class="step clickable-step" id="step2" onclick="showForm('profileForm')">
                    <div class="step-number">2</div>
                    <div class="step-title">Profile</div>
                </div>
                <div class="step clickable-step" id="step3" onclick="showForm('documentsForm')">
                    <div class="step-number">3</div>
                    <div class="step-title">Documents</div>
                </div>
                <div class="step clickable-step" id="step4" onclick="showForm('preSeaForm')">
                    <div class="step-number">4</div>
                    <div class="step-title">Pre-Sea</div>
                </div>
                <div class="step clickable-step" id="step5" onclick="showForm('gmdssForm')">
                    <div class="step-number">5</div>
                    <div class="step-title">GMDSS</div>
                </div>
                <div class="step clickable-step" id="step6" onclick="showForm('courseDetailsForm')">
                    <div class="step-number">6</div>
                    <div class="step-title">Courses</div>
                </div>
                <div class="step clickable-step" id="step7" onclick="showForm('seaServiceForm')">
                    <div class="step-number">7</div>
                    <div class="step-title">Sea Service</div>
                </div>
                <div class="step clickable-step" id="step8" onclick="showForm('additionalDetailsForm')">
                    <div class="step-number">8</div>
                    <div class="step-title">Additional</div>
                </div>
                <div class="progress">
                    <div class="progress-bar" id="mainProgressBar" role="progressbar" style="width: 12.5%;" aria-valuenow="12.5" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 1: Personal Details Form (Now First) -->
    <div class="card mb-4" id="personalDetailsForm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Personal Details</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row g-3">
                    <!-- Name Section -->
                    <div class="col-md-4">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" required>
                    </div>
                    <div class="col-md-4">
                        <label for="middleName" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middleName">
                    </div>
                    <div class="col-md-4">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" required>
                    </div>

                    <!-- Email & Password -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email ID</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" required>
                    </div>
                    <div class="col-md-6">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" required>
                    </div>

                    <!-- Personal Info -->
                    <div class="col-md-6">
                        <label for="maritalStatus" class="form-label">Marital Status</label>
                        <select class="form-select" id="maritalStatus" required>
                            <option value="" selected disabled>Select...</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" required>
                            <option value="" selected disabled>Select...</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Nationality & Location -->
                    <div class="col-md-6">
                        <label for="nationality" class="form-label">Nationality</label>
                        <select class="form-select" id="nationality" required>
                            <option value="" selected disabled>Select...</option>
                            <option value="indian">Indian</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" id="state" required>
                            <option value="" selected disabled>Select...</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <select class="form-select" id="city" required>
                            <option value="" selected disabled>Select...</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" value="2025-04-02">
                    </div>

                    <!-- Contact Information -->
                    <div class="col-md-6">
                        <label class="form-label">Mobile Number</label>
                        <div class="input-group">
                            <span class="input-group-text">+91</span>
                            <input type="tel" class="form-control" placeholder="Mobile Number" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">WhatsApp Number</label>
                        <div class="input-group">
                            <span class="input-group-text">+91</span>
                            <input type="tel" class="form-control" placeholder="WhatsApp Number">
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" rows="2" required></textarea>
                    </div>

                    <!-- Form Actions -->
                    <div class="col-12 mt-4">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary" disabled>
                                <i class="bx bx-chevron-left me-1"></i> Previous
                            </button>
                            <button type="button" class="btn btn-primary" onclick="showForm('profileForm')">
                                Save & Continue <i class="bx bx-chevron-right ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Step 2: Profile & Experience Form (Now Second) -->
    <div class="card mb-4 d-none" id="profileForm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Profile & Total Experience</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row g-3">
                    <!-- Present Rank -->
                    <div class="col-md-6">
                        <label for="presentRank" class="form-label">Select Present Rank</label>
                        <select class="form-select" id="presentRank" required>
                            <option value="" selected disabled>Choose rank...</option>
                            <option value="captain">Captain</option>
                            <option value="chief_engineer">Chief Engineer</option>
                            <option value="dpo">DPO</option>
                            <option value="2nd_off">2nd Officer</option>
                        </select>
                    </div>

                    <!-- Rank Experience -->
                    <div class="col-md-6">
                        <label for="rankExperience" class="form-label">Select Rank Experience</label>
                        <select class="form-select" id="rankExperience" required>
                            <option value="" selected disabled>Choose experience...</option>
                            <option value="fresher">Fresher</option>
                            <option value="6_months">6 Months</option>
                            <option value="1_year">1 Year</option>
                            <option value="2_years">2 Years</option>
                        </select>
                    </div>

                    <!-- Post Rank -->
                    <div class="col-md-6">
                        <label for="postRank" class="form-label">Select Post Rank</label>
                        <select class="form-select" id="postRank">
                            <option value="" selected disabled>Choose rank...</option>
                            <option value="captain">Captain</option>
                            <option value="chief_engineer">Chief Engineer</option>
                        </select>
                    </div>

                    <!-- Date -->
                    <div class="col-md-6">
                        <label for="lastPromotionDate" class="form-label">Last Promotion Date</label>
                        <input type="date" class="form-control" id="lastPromotionDate" value="2025-04-02">
                    </div>
                    <!-- Form Actions -->
                    <div class="col-12 mt-4">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary" onclick="showForm('personalDetailsForm')">
                                <i class="bx bx-chevron-left me-1"></i> Previous
                            </button>
                            <button type="button" class="btn btn-primary" onclick="showForm('documentsForm')">
                                Save & Continue <i class="bx bx-chevron-right ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Step 3: Passport & Seamen Book Form -->
    <div class="card mb-4 d-none" id="documentsForm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Passport & Seamen Book Details</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row g-3">
                    <!-- Passport Details -->
                    <div class="col-md-6">
                        <label for="passportNationality" class="form-label">Passport Nationality</label>
                        <select class="form-select" id="passportNationality" required>
                            <option value="" selected disabled>Select...</option>
                            <option value="indian">Indian</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="passportNumber" class="form-label">Passport No.</label>
                        <input type="text" class="form-control" id="passportNumber" required>
                    </div>

                    <!-- CDC Details -->
                    <div class="col-md-6">
                        <label for="cdcType" class="form-label">Select CDC</label>
                        <select class="form-select" id="cdcType" required>
                            <option value="" selected disabled>Select...</option>
                            <option value="indian">Indian CDC</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="cdcNumber" class="form-label">CDC No.</label>
                        <input type="text" class="form-control" id="cdcNumber" required>
                    </div>
                    <div class="col-md-6">
                        <label for="passportExpiry" class="form-label">Passport Expiry Date</label>
                        <input type="date" class="form-control" id="passportExpiry" value="2025-04-02">
                    </div>
                    <div class="col-md-6">
                        <label for="cdcExpiry" class="form-label">CDC Expiry Date</label>
                        <input type="date" class="form-control" id="cdcExpiry" value="2025-04-02">
                    </div>

                    <!-- Visa Details -->
                      <div class="col-md-6">
                        <label for="indosNumber" class="form-label">INDOS No.</label>
                        <input type="text" class="form-control" id="indosNumber">
                    </div>
                    <div class="col-md-6">
                        <label for="usVisa" class="form-label">US Visa</label>
                        <select class="form-select" id="usVisa">
                            <option value="" selected disabled>Select...</option>
                            <option value="b1">B1</option>
                            <option value="b2">B2</option>
                            <option value="none">None</option>
                        </select>
                    </div>


                    <!-- Dates -->


                    <!-- Form Actions -->
                    <div class="col-12 mt-4">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary" onclick="showForm('profileForm')">
                                <i class="bx bx-chevron-left me-1"></i> Previous
                            </button>
                            <button type="button" class="btn btn-primary" onclick="showForm('preSeaForm')">
                                Save & Continue <i class="bx bx-chevron-right ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Step 4: Pre-Sea & COC/COP Form -->
    <div class="card mb-4 d-none" id="preSeaForm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Pre-Sea & COC/COP Details</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="preSeaType" class="form-label">Pre Sea Training Type</label>
                        <select class="form-select" id="preSeaType" required>
                            <option value="" selected disabled>Choose...</option>
                            <option value="marine_engineering">Marine Engineering</option>
                            <option value="nautical_science">Nautical Science</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="preSeaDate" class="form-label">Issue Date</label>
                        <input type="date" class="form-control" id="preSeaDate" value="2025-04-02">
                    </div>
                    <div class="col-md-6">
                        <label for="cocType" class="form-label">Select COC/COP Details</label>
                        <select class="form-select" id="cocType" required>
                            <option value="" selected disabled>Choose...</option>
                            <option value="coc">Certificate of Competency</option>
                            <option value="cop">Certificate of Proficiency</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="grade" class="form-label">Grade</label>
                        <input type="text" class="form-control" id="grade" required>
                    </div>
                    <div class="col-md-6">
                        <label for="cocNumber" class="form-label">COC No.</label>
                        <input type="text" class="form-control" id="cocNumber" required>
                    </div>
                    <div class="col-md-6">
                        <label for="cocDate" class="form-label">Expiry Date</label>
                        <input type="date" class="form-control" id="cocDate" value="2025-04-02">
                    </div>

                    <!-- Form Actions -->
                    <div class="col-12 mt-4">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary" onclick="showForm('documentsForm')">
                                <i class="bx bx-chevron-left me-1"></i> Previous
                            </button>
                            <button type="button" class="btn btn-primary" onclick="showForm('gmdssForm')">
                                Save & Continue <i class="bx bx-chevron-right ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Step 5: GMDSS & DCE Form -->
    <div class="card mb-4 d-none" id="gmdssForm">
        <div class="card-header bg-light">
            <h5 class="mb-0">GMDSS & DC Endorsement</h5>
        </div>
        <div class="card-body">
            <form>
               <div id="dceEntriesContainer">
                <div class="dce-entry">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="dceType" class="form-label">Select DCE & GMDSS</label>
                            <select class="form-select dce-type-select" required>
                                <option value="" selected disabled>Choose...</option>
                                <option value="oil_dce">Oil DCE Level-II</option>
                                <option value="chemical_dce">Chemical DCE Level-II</option>
                                <option value="gmdss">GMDSS Endorsement</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="dceDate" class="form-label">Date</label>
                            <input type="date" class="form-control dce-date-input" value="2025-04-02">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <button type="button" class="btn btn-outline-primary" id="addMoreDceBtn">
                    <i class="bx bx-plus"></i> Add More
                </button>
            </div>

                <!-- Endorsements Table -->
                <div class="mt-4">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 d-none d-md-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Endorsement</th>
                                    <th>Validity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Oil DCE Level -II (Management)</td>
                                    <td>2016-04-10</td>
                                    <td><button class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i></button></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Mobile View for Endorsements -->
                        <div class="d-md-none">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Oil DCE Level -II (Management)</strong>
                                        <button class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i></button>
                                    </div>
                                    <div><small class="text-muted">Validity:</small> 2016-04-10</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" onclick="showForm('preSeaForm')">
                            <i class="bx bx-chevron-left me-1"></i> Previous
                        </button>
                        <button type="button" class="btn btn-primary" onclick="showForm('courseDetailsForm')">
                            Save & Continue <i class="bx bx-chevron-right ms-1"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Step 6: Course Details Form -->
    <div class="card mb-4 d-none" id="courseDetailsForm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Valid Course Details</h5>
        </div>
        <div class="card-body">
            <form>
              <div class="mb-3">
        <label for="courseSelection" class="form-label">Select Course(s)</label>
        <div class="multiselect-dropdown" id="courseSelection">
            <div class="dropdown-toggle" id="courseToggle">
                <span class="selected-text">Select courses...</span>
                <i class="bx bx-chevron-down"></i>
            </div>
            <div class="dropdown-menu" id="courseMenu">
                <label class="dropdown-item">
                    <input type="checkbox" value="Basic Safety Training"> Basic Safety Training
                </label>
                <label class="dropdown-item">
                    <input type="checkbox" value="Advanced Fire Fighting"> Advanced Fire Fighting
                </label>
                <label class="dropdown-item">
                    <input type="checkbox" value="Medical First Aid"> Medical First Aid
                </label>
                <label class="dropdown-item">
                    <input type="checkbox" value="Proficiency in Survival Craft"> Proficiency in Survival Craft
                </label>
                <label class="dropdown-item">
                    <input type="checkbox" value="Ship Security Officer"> Ship Security Officer
                </label>
                <label class="dropdown-item">
                    <input type="checkbox" value="ECDIS"> ECDIS
                </label>
                <label class="dropdown-item">
                    <input type="checkbox" value="GMDSS"> GMDSS
                </label>
                <label class="dropdown-item">
                    <input type="checkbox" value="Oil Tanker Familiarization"> Oil Tanker Familiarization
                </label>
                <label class="dropdown-item">
                    <input type="checkbox" value="Chemical Tanker Familiarization"> Chemical Tanker Familiarization
                </label>
                <label class="dropdown-item">
                    <input type="checkbox" value="LNG Tanker Familiarization"> LNG Tanker Familiarization
                </label>
            </div>
        </div>
    </div>

                <!-- Course form content would go here -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-secondary" onclick="showForm('gmdssForm')">
                        <i class="bx bx-chevron-left me-1"></i> Previous
                    </button>
                    <button type="button" class="btn btn-primary" onclick="showForm('seaServiceForm')">
                        Save & Continue <i class="bx bx-chevron-right ms-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Step 7: Sea Service Details Form -->
    <div class="card mb-4 d-none" id="seaServiceForm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Sea Service Details</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row g-3">
                    <!-- Service Entry Form -->
                    <div class="col-md-4">
                        <label for="serviceRank" class="form-label">Select Rank</label>
                        <select class="form-select" id="serviceRank" required>
                            <option value="" selected disabled>Choose rank...</option>
                            <option value="3rd_engr">3rd Engineer</option>
                            <option value="2nd_engr">2nd Engineer</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="shipType" class="form-label">Select Ship Type</label>
                        <select class="form-select" id="shipType" required>
                            <option value="" selected disabled>Choose type...</option>
                            <option value="oil_tanker">Oil Tanker</option>
                            <option value="bulk_carrier">Bulk Carrier</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="signOnDate" class="form-label">Sign On Date</label>
                        <input type="date" class="form-control" id="signOnDate" value="2025-04-02">
                    </div>
                    <div class="col-md-4">
                        <label for="companyName" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="companyName" required>
                    </div>
                    <div class="col-md-4">
                        <label for="companyName" class="form-label">Ship Name</label>
                        <input type="text" class="form-control" id="shipName" required>
                    </div>
                    <div class="col-md-4">
                        <label for="engineType" class="form-label">Engine Type</label>
                        <input type="text" class="form-control" id="engineType" required>
                    </div>
                    <div class="col-md-4">
                        <label for="signOffDate" class="form-label">Sign Off Date</label>
                        <input type="date" class="form-control" id="signOffDate" value="2025-04-02">
                    </div>
                    <div class="col-md-4">
                        <label for="grt" class="form-label">GRT</label>
                        <input type="text" class="form-control" id="grt" required>
                    </div>
                    <div class="col-md-4">
                        <label for="bhp" class="form-label">BHP</label>
                        <input type="text" class="form-control" id="bhp" required>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-outline-primary">
                            <i class="bx bx-plus"></i> Add Service Record
                        </button>
                    </div>
                </div>

                <!-- Service Records Table -->
                <div class="mt-4">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 d-none d-md-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Rank</th>
                                    <th>Ship/Company</th>
                                    <th>Ship Type</th>
                                    <th>Engine Type</th>
                                    <th>Tonnage</th>
                                    <th>BHP</th>
                                    <th>Sign On</th>
                                    <th>Sign Off</th>
                                    <th>Duration</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>3rd Engr.</td>
                                    <td>M.T BLUEBIND</td>
                                    <td>Oil Tanker</td>
                                    <td>MAN B</td>
                                    <td>AFRAMAX-GRT</td>
                                    <td>12350</td>
                                    <td>2011-12-04</td>
                                    <td>2012-08-01</td>
                                    <td>7m 26d</td>
                                    <td><button class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i></button></td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Mobile View for Service Records -->
                        <div class="d-md-none">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>3rd Engr.</strong>
                                        <button class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i></button>
                                    </div>
                                    <div class="mb-1"><small class="text-muted">Ship:</small> M.T BLUEBIND</div>
                                    <div class="mb-1"><small class="text-muted">Type:</small> Oil Tanker</div>
                                    <div class="mb-1"><small class="text-muted">Engine:</small> MAN B</div>
                                    <div class="mb-1"><small class="text-muted">Tonnage:</small> AFRAMAX-GRT</div>
                                    <div class="mb-1"><small class="text-muted">BHP:</small> 12350</div>
                                    <div class="row">
                                        <div class="col-6"><small class="text-muted">Sign On:</small> 2011-12-04</div>
                                        <div class="col-6"><small class="text-muted">Sign Off:</small> 2012-08-01</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" onclick="showForm('courseDetailsForm')">
                            <i class="bx bx-chevron-left me-1"></i> Previous
                        </button>
                        <button type="button" class="btn btn-primary" onclick="showForm('additionalDetailsForm')">
                            Save & Continue <i class="bx bx-chevron-right ms-1"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Step 8: Additional Details Form (NEW) -->
    <div class="card mb-4 d-none" id="additionalDetailsForm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Additional Details</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row g-3">
                    <div class="col-12">
                        <label for="additionalInfo" class="form-label">Additional Information</label>
                        <textarea class="form-control" id="additionalInfo" rows="3" placeholder="Rig: last/repeated salary per year/month/day, additional qualifications, etc."></textarea>
                        <div class="form-text">
                            <small class="text-muted">
                                You can include any additional information that you think would be valuable for your application.
                            </small>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="col-12 mt-4">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary" onclick="showForm('seaServiceForm')">
                                <i class="bx bx-chevron-left me-1"></i> Previous
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="bx bx-save me-1"></i> Save Resume
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<style>
    /* Progress Steps - Updated for 8 steps and clickable */
    .progress-steps {
        position: relative;
        display: flex;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }
    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
        flex: 1;
        min-width: 50px;
    }

    /* Clickable step styling */
    .clickable-step {
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .clickable-step:hover {
        transform: translateY(-2px);
    }

    .clickable-step:hover .step-number {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .step-number {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #e9ecef;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .step.active .step-number {
        background-color: #0d6efd;
        color: white;
        transform: scale(1.1);
        border-color: #0d6efd;
    }

    .step.completed .step-number {
        background-color: #198754;
        color: white;
        border-color: #198754;
    }

    .step-title {
        font-size: 0.65rem;
        text-align: center;
        color: #6c757d;
        white-space: nowrap;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .step.active .step-title,
    .step.completed .step-title {
        color: #212529;
        font-weight: 600;
    }

    .progress {
        position: absolute;
        top: 16px;
        left: 0;
        width: 100%;
        height: 4px;
        background-color: #e9ecef;
        z-index: 1;
        border-radius: 2px;
    }

    .progress-bar {
        background-color: #0d6efd;
        transition: width 0.5s ease;
        border-radius: 2px;
    }

    /* Mobile Responsive Adjustments */
    @media (max-width: 767.98px) {
        .progress-steps {
            overflow-x: auto;
            padding-bottom: 1rem;
        }
        .step {
            min-width: 45px;
        }
        .step-title {
            font-size: 0.55rem;
        }
        .step-number {
            width: 28px;
            height: 28px;
            font-size: 0.75rem;
        }
    }

    /* Multiselect Dropdown Styles */
    .multiselect-dropdown {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .multiselect-dropdown .dropdown-toggle {
        background: #ffffff;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        padding: 12px 16px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .multiselect-dropdown .dropdown-toggle:hover {
        border-color: #cbd5e1;
    }

    .multiselect-dropdown .dropdown-toggle.active {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .multiselect-dropdown .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #ffffff;
        border: 2px solid #e5e7eb;
        border-top: none;
        border-radius: 0 0 8px 8px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .multiselect-dropdown .dropdown-menu.show {
        display: block;
    }

    .multiselect-dropdown .dropdown-item {
        display: flex;
        align-items: center;
        padding: 8px 16px;
        cursor: pointer;
        margin: 0;
        font-weight: normal;
        transition: background-color 0.2s ease;
    }

    .multiselect-dropdown .dropdown-item:hover {
        background-color: #f8fafc;
    }

    .multiselect-dropdown .dropdown-item input[type="checkbox"] {
        margin-right: 8px;
        margin-top: 0;
    }

    .selected-text {
        color: #374151;
    }

    /* DCE Entry Styles */
    .dce-entry {
        margin-bottom: 16px;
        padding: 16px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: #f9fafb;
        position: relative;
    }

    .dce-entry:first-child {
        background: #ffffff;
        border: none;
        padding: 0;
    }

    .dce-entry .btn-remove {
        position: absolute;
        top: 8px;
        right: 8px;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
        .multiselect-dropdown .dropdown-menu {
            max-height: 150px;
        }

        .dce-entry .btn-remove {
            position: static;
            margin-top: 12px;
            width: 100%;
        }
    }
</style>

<script>
    function showForm(formId) {
        // Hide all forms
        document.querySelectorAll('.card.mb-4').forEach(form => {
            if (form.id !== '' && form.id !== 'progressCard') { // Only hide form cards, not the progress bar card
                form.classList.add('d-none');
            }
        });

        // Show the requested form
        document.getElementById(formId).classList.remove('d-none');

        // Update progress bar and steps
        updateProgressBar(formId);
    }

    function updateProgressBar(currentFormId) {
        // Updated form order with Personal Details first
        const formOrder = [
            'personalDetailsForm', 'profileForm', 'documentsForm',
            'preSeaForm', 'gmdssForm', 'courseDetailsForm', 'seaServiceForm', 'additionalDetailsForm'
        ];

        const currentStep = formOrder.indexOf(currentFormId) + 1;
        const progressPercent = (currentStep / formOrder.length) * 100;

        // Update progress bar width
        document.getElementById('mainProgressBar').style.width = `${progressPercent}%`;
        document.getElementById('mainProgressBar').setAttribute('aria-valuenow', progressPercent);

        // Update all steps
        for (let i = 1; i <= 8; i++) { // Updated to 8 steps
            const stepElement = document.getElementById(`step${i}`);

            if (i < currentStep) {
                // Completed steps
                stepElement.classList.add('completed');
                stepElement.classList.remove('active');
            } else if (i === currentStep) {
                // Current step
                stepElement.classList.add('active');
                stepElement.classList.remove('completed');
            } else {
                // Future steps
                stepElement.classList.remove('active', 'completed');
            }
        }
    }

    // Initialize with first form visible (now Personal Details)
    document.addEventListener('DOMContentLoaded', function() {
        showForm('personalDetailsForm');

        // Set first step as active
        document.getElementById('step1').classList.add('active');

        // Initialize other functionality
        initializeMultiselect();
        initializeDceAddMore();
    });

    // Multiselect Dropdown Functionality
    function initializeMultiselect() {
        const multiselectDropdown = document.getElementById('courseSelection');
        if (!multiselectDropdown) {
            return;
        }

        const toggle = multiselectDropdown.querySelector('.dropdown-toggle');
        const menu = multiselectDropdown.querySelector('.dropdown-menu');
        const selectedText = multiselectDropdown.querySelector('.selected-text');
        const checkboxes = multiselectDropdown.querySelectorAll('input[type="checkbox"]');

        if (!toggle || !menu || !selectedText) {
            return;
        }

        // Toggle dropdown on click
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const isOpen = menu.classList.contains('show');

            // Close all other dropdowns first
            closeAllDropdowns();

            if (!isOpen) {
                menu.classList.add('show');
                toggle.classList.add('active');
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!multiselectDropdown.contains(e.target)) {
                menu.classList.remove('show');
                toggle.classList.remove('active');
            }
        });

        // Prevent dropdown from closing when clicking inside
        menu.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Update selected text when checkboxes change
        function updateSelectedText() {
            const selected = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            if (selected.length === 0) {
                selectedText.textContent = 'Select courses...';
                selectedText.style.color = '#9ca3af';
            } else if (selected.length === 1) {
                selectedText.textContent = selected[0];
                selectedText.style.color = '#374151';
            } else {
                selectedText.textContent = `${selected.length} courses selected`;
                selectedText.style.color = '#374151';
            }
        }

        // Add change listeners to all checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectedText();
            });
        });

        // Initialize the display
        updateSelectedText();
    }

    function closeAllDropdowns() {
        document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
            menu.classList.remove('show');
        });
        document.querySelectorAll('.dropdown-toggle.active').forEach(toggle => {
            toggle.classList.remove('active');
        });
    }

    function initializeDceAddMore() {
        const addMoreBtn = document.getElementById('addMoreDceBtn');
        const dceContainer = document.getElementById('dceEntriesContainer');
        let dceCounter = 1;

        if (addMoreBtn && dceContainer) {
            addMoreBtn.addEventListener('click', function() {
                dceCounter++;

                const newDceEntry = document.createElement('div');
                newDceEntry.className = 'dce-entry';
                newDceEntry.innerHTML = `
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Select DCE & GMDSS</label>
                            <select class="form-select dce-type-select" required>
                                <option value="" selected disabled>Choose...</option>
                                <option value="oil_dce">Oil DCE Level-II</option>
                                <option value="chemical_dce">Chemical DCE Level-II</option>
                                <option value="gmdss">GMDSS Endorsement</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control dce-date-input" value="">
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-outline-danger btn-sm btn-remove">
                                <i class="bx bx-trash me-1"></i>Remove
                            </button>
                        </div>
                    </div>
                `;

                // Add remove functionality
                const removeBtn = newDceEntry.querySelector('.btn-remove');
                removeBtn.addEventListener('click', function() {
                    dceContainer.removeChild(newDceEntry);
                });

                dceContainer.appendChild(newDceEntry);
            });
        }
    }
</script>
@endsection
