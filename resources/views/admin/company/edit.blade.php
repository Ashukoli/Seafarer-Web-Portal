{{-- filepath: resources/views/admin/company/edit.blade.php --}}
@extends('layouts.admin.app')

@push('styles')
<style>
:root {
    --primary-color: #3b82f6;
    --primary-dark: #1e40af;
    --secondary-color: #64748b;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --light-bg: #f8fafc;
    --white: #ffffff;
    --border-color: #e2e8f0;
    --text-primary: #1e293b;
    --text-secondary: #64748b;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
}
.professional-bg { background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); min-height: 100vh; padding: 2rem 0; }
.enhanced-breadcrumb { background: var(--white); padding: 1rem 1.5rem; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem; }
.breadcrumb-link { color: var(--primary-color); text-decoration: none; font-weight: 500; transition: all 0.3s ease; display: flex; align-items: center; gap: 0.5rem; }
.breadcrumb-link:hover { color: var(--primary-dark); transform: translateX(2px); }
.breadcrumb-title { font-weight: 600; color: var(--text-primary); font-size: 1.125rem; display: flex; align-items: center; gap: 0.5rem; }
.breadcrumb-item.active { color: var(--text-secondary); font-weight: 500; display: flex; align-items: center; gap: 0.25rem; }
.professional-card { background: var(--white); border-radius: 16px; box-shadow: var(--shadow-lg); border: none; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; }
.professional-header { background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%); color: var(--white); padding: 1.5rem; border-bottom: none; }
.header-title { font-size: 1.25rem; font-weight: 600; margin: 0; display: flex; align-items: center; gap: 0.5rem; }
.form-label { font-weight: 600; color: var(--text-primary); margin-bottom: 0.5rem; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.025em; }
.form-control, .form-select { border: 2px solid var(--border-color); border-radius: 8px; padding: 0.75rem 1rem; font-size: 0.875rem; transition: all 0.3s ease; background: var(--white); }
.form-control:focus, .form-select:focus { border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); outline: none; }
.form-control:hover, .form-select:hover { border-color: var(--secondary-color); }
.btn { border-radius: 8px; padding: 0.75rem 1.5rem; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.025em; transition: all 0.3s ease; border: none; display: inline-flex; align-items: center; gap: 0.5rem; }
.btn-primary { background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%); color: var(--white); box-shadow: var(--shadow-md); }
.btn-primary:hover { transform: translateY(-2px); box-shadow: var(--shadow-lg); background: linear-gradient(135deg, var(--primary-dark) 0%, #1e3a8a 100%); }
.btn-outline-secondary { background: transparent; border: 2px solid var(--border-color); color: var(--text-secondary); }
.btn-outline-secondary:hover { background: var(--secondary-color); border-color: var(--secondary-color); color: var(--white); transform: translateY(-2px); }
.btn-danger { background: var(--danger-color); color: var(--white); }
.btn-danger:hover { background: #b91c1c; color: var(--white); }
.alert { border-radius: 8px; padding: 1rem 1.5rem; margin-bottom: 1rem; border: none; font-weight: 500; }
.alert-danger { background: rgba(239, 68, 68, 0.1); color: var(--danger-color); border-left: 4px solid var(--danger-color); }
@media (max-width: 768px) { .professional-bg { padding: 1rem 0; } }
.multiselect-checkbox { position: relative; }
.rankDropdownBtn {
    background: var(--white);
    border: 2px solid var(--border-color);
    color: var(--text-primary);
    text-align: left;
    cursor: pointer;
    width: 100%;
}
.rankDropdownBtn:hover { border-color: var(--primary-color); }
.rankDropdownMenu {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: var(--white);
    border: 2px solid var(--border-color);
    border-radius: 8px;
    box-shadow: var(--shadow-lg);
    z-index: 1000;
    max-height: 220px;
    overflow-y: auto;
    display: none;
}
.rankDropdownMenu.show { display: block; }
.dropdown-item {
    padding: 0.75rem 1rem;
    margin: 0;
    border: none;
    background: none;
    cursor: pointer;
    transition: background-color 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.dropdown-item:hover { background: var(--light-bg); }
.dynamic-row { background: var(--light-bg); border-radius: 8px; padding: 1rem; margin-bottom: 1rem; border: 1px solid var(--border-color); position: relative; }
.remove-shiptype-rank { position: absolute; top: 0.5rem; right: 0.5rem; z-index: 10; }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('content')
<main class="page-content professional-bg">
    <div class="container">
        <!-- Breadcrumb -->
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb enhanced-breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">
                                <i class="bx bx-home-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.company.index') }}" class="breadcrumb-link">
                                <i class="bx bx-building"></i> Companies
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="bx bx-edit"></i> Edit Company
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-11">
                <div class="professional-card">
                    <div class="professional-header">
                        <h4 class="header-title mb-0"><i class="bx bx-buildings"></i> Edit Company</h4>
                    </div>
                    @if($errors->any())
                        <div class="alert alert-danger m-3">
                            <ul class="mb-0">@foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" name="company_name" class="form-control" required
                                           value="{{ old('company_name', $company->company_name) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Company Email</label>
                                    <input type="email" name="company_email" class="form-control"
                                           value="{{ old('company_email', $company->company_email) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Contact Number</label>
                                    <input type="text" name="company_contact_no" class="form-control"
                                           value="{{ old('company_contact_no', $company->company_contact_no) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Website</label>
                                    <input type="url" name="website" class="form-control"
                                           value="{{ old('website', $company->website) }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">RPSL Number</label>
                                    <input type="text" name="rpsl_number" class="form-control"
                                           value="{{ old('rpsl_number', $company->rpsl_number) }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">RPSL Expiry</label>
                                    <input type="text" name="rpsl_expiry" class="form-control datepicker" autocomplete="off"
                                           value="{{ old('rpsl_expiry', $company->rpsl_expiry) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Company Type</label>
                                    <select name="company_type" class="form-select">
                                        <option value="">Select</option>
                                        <option value="shipowner" {{ old('company_type', $company->company_type) == 'shipowner' ? 'selected' : '' }}>Shipowner / Ship Operator</option>
                                        <option value="crewing" {{ old('company_type', $company->company_type) == 'crewing' ? 'selected' : '' }}>Crewing Company</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Account Type</label>
                                    <select name="account_type" class="form-select">
                                        <option value="">Select</option>
                                        <option value="advertisement" {{ old('account_type', $company->account_type) == 'advertisement' ? 'selected' : '' }}>Advertisement</option>
                                        <option value="database" {{ old('account_type', $company->account_type) == 'database' ? 'selected' : '' }}>Database</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tie-up Company</label>
                                    <select name="tie_up_company" class="form-select">
                                        <option value="0" {{ old('tie_up_company', $company->tie_up_company) == 0 ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ old('tie_up_company', $company->tie_up_company) == 1 ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Listed in Banner</label>
                                    <select name="listed_in_banner" class="form-select">
                                        <option value="0" {{ old('listed_in_banner', $company->listed_in_banner) == 0 ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ old('listed_in_banner', $company->listed_in_banner) == 1 ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Company Logo</label>
                                    <input type="file" name="company_logo" class="form-control" accept="image/*">
                                    @if(!empty($company->company_logo))
                                        <div class="mt-2">
                                            <img src="{{ asset('theme/assets/images/company_logo/'.$company->company_logo) }}" style="height:48px" alt="Company Logo">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Area</label>
                                    <textarea name="area" class="form-control" rows="2">{{ old('area', $company->area) }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Full Address</label>
                                    <textarea name="address" class="form-control" rows="3">{{ old('address', $company->address) }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Directors</label>
                                    <textarea name="directors" class="form-control" rows="3">{{ old('directors', $company->directors) }}</textarea>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row g-4">
                                <div class="col-md-4">
                                    <label class="form-label">Resume Views Per Day</label>
                                    <select name="resumes_view_per_day" class="form-select">
                                        <option value="">Select</option>
                                        @foreach($packages as $package)
                                            <option value="{{ $package->id }}"
                                                {{ old('resumes_view_per_day', $company->resume_view_package_id) == $package->id ? 'selected' : '' }}>
                                                {{ $package->package_count == 'unlimited' ? 'Unlimited' : $package->package_count . ' Views' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Resume Downloads Per Day</label>
                                    <select name="resumes_download_per_day" class="form-select">
                                        <option value="">Select</option>
                                        @foreach($packages as $package)
                                            <option value="{{ $package->id }}"

                                                {{ old('resumes_download_per_day', $company->resume_download_package_id) == $package->id ? 'selected' : '' }}>
                                                {{ $package->package_count == 'unlimited' ? 'Unlimited' : $package->package_count . ' Downloads' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Hot Jobs Per Day</label>
                                    <select name="hotjobs_per_day" class="form-select">
                                        <option value="">Select</option>
                                        @foreach($packages as $package)
                                            <option value="{{ $package->id }}"

                                                {{ old('hotjobs_per_day', $company->hotjobs_package_id) == $package->id ? 'selected' : '' }}>
                                                {{ $package->package_count == 'unlimited' ? 'Unlimited' : $package->package_count . ' Hot Jobs' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Banner Section -->
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Banner Image</label>
                                    <input type="file" name="banner_image" class="form-control" accept="image/*">
                                    @php
                                        $bannerImage = old('banner_image') ?: ($banner->image ?? $company->banner_image ?? '');
                                    @endphp
                                    @if(!empty($bannerImage))
                                        <div class="mt-2">
                                            <img src="{{ asset('theme/assets/images/company_banner/'.$bannerImage) }}" style="height:48px" alt="Banner Image">
                                        </div>
                                    @endif
                                    <small class="text-muted mt-2 d-block">Recommended size: 1200x400px, max 2MB (JPG/PNG)</small>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Banner Section</label>
                                    <select name="banner_section" class="form-select">
                                        <option value="">Select Section</option>
                                        <option value="featured" {{ old('banner_section', $banner->section ?? $company->banner_section) == 'featured' ? 'selected' : '' }}>Featured</option>
                                        <option value="toplisted" {{ old('banner_section', $banner->section ?? $company->banner_section) == 'toplisted' ? 'selected' : '' }}>Top Listed</option>
                                        <option value="listed" {{ old('banner_section', $banner->section ?? $company->banner_section) == 'listed' ? 'selected' : '' }}>Listed</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Display Order</label>
                                    <input type="number" name="banner_order" class="form-control" min="1" placeholder="1"
                                        value="{{ old('banner_order', $banner->order ?? $company->banner_order) }}">
                                    <small class="text-muted mt-2 d-block">Lower number = higher priority</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Banner Status</label>
                                    <select name="banner_status" class="form-select">
                                        <option value="enabled" {{ old('banner_status', $banner->status ?? $company->banner_status) == 'enabled' ? 'selected' : '' }}>Enabled</option>
                                        <option value="disabled" {{ old('banner_status', $banner->status ?? $company->banner_status) == 'disabled' ? 'selected' : '' }}>Disabled</option>
                                    </select>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Advertisement Section -->
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label">Advertisement Subject</label>
                                    <input type="text" name="advertisement_subject" class="form-control"
                                        value="{{ old('advertisement_subject', $advertisement->subject ?? $company->advertisement_subject) }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Advertisement Description</label>
                                    <textarea id="advertisement_description" name="advertisement_description" class="form-control" rows="6">{{ old('advertisement_description', $advertisement->description ?? $company->advertisement_description) }}</textarea>
                                    <small class="text-muted mt-2 d-block">You can use rich text formatting, links, and lists.</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Advertisement Posted Date</label>
                                    <input type="text" name="advertisement_posted_date" class="form-control datepicker" autocomplete="off"
                                        value="{{ old('advertisement_posted_date', isset($advertisement->posted_date) ? \Carbon\Carbon::parse($advertisement->posted_date)->format('d-m-Y') : ($company->advertisement_posted_date ?? '')) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Advertisement Type</label>
                                    <select name="advertisement_type" class="form-select">
                                        <option value="fixed" {{ old('advertisement_type', $advertisement->advertisement_type ?? $company->advertisement_type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                        <option value="customized" {{ old('advertisement_type', $advertisement->advertisement_type ?? $company->advertisement_type) == 'customized' ? 'selected' : '' }}>Customized</option>
                                    </select>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Ship Type & Rank Section -->
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label">Ship Types & Ranks</label>
                                    <div id="shiptype-rank-wrapper">
                                        @php
                                            $shiptypeRanks = old('advertisement_shiptypes', $shiptypeRanks ?? [[]]);
                                            if (empty($shiptypeRanks)) $shiptypeRanks = [[]];
                                        @endphp
                                        @foreach($shiptypeRanks as $idx => $shiptype)
                                        <div class="dynamic-row shiptype-rank-row">
                                            <button type="button" class="btn btn-danger btn-sm remove-shiptype-rank" title="Remove"><i class="bx bx-trash"></i></button>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Ship Type</label>
                                                    <select name="advertisement_shiptypes[{{ $idx }}][shiptype]" class="form-select">
                                                        <option value="">Select Ship Type</option>
                                                        @foreach($shipTypes as $type)
                                                            <option value="{{ $type->id }}" {{ (old('advertisement_shiptypes.'.$idx.'.shiptype', $shiptype['shiptype'] ?? '') == $type->id) ? 'selected' : '' }}>{{ $type->ship_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Required Ranks</label>
                                                    <div class="multiselect-checkbox position-relative">
                                                        <button type="button" class="form-control text-start rankDropdownBtn">
                                                            @php
                                                                $selectedRanks = old('advertisement_shiptypes.'.$idx.'.ranks', $shiptype['ranks'] ?? []);
                                                                $selectedRanksText = collect($ranks)->whereIn('id', (array)$selectedRanks)->pluck('rank')->implode(', ');
                                                            @endphp
                                                            {{ $selectedRanksText ?: 'Select Ranks' }}
                                                        </button>
                                                        <div class="dropdown-menu w-100 rankDropdownMenu">
                                                            @foreach($ranks as $rank)
                                                            <label class="dropdown-item">
                                                                <input type="checkbox" name="advertisement_shiptypes[{{ $idx }}][ranks][]" value="{{ $rank->id }}"
                                                                    {{ in_array($rank->id, (array)$selectedRanks) ? 'checked' : '' }}>
                                                                {{ $rank->rank }}
                                                            </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-outline-primary mt-3" id="add-shiptype-rank">
                                        <i class="bx bx-plus"></i> Add More Ship Types
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end p-4">
                            <a href="{{ route('admin.company.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                            <button class="btn btn-primary">Update Company</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    if(typeof $ !== 'undefined' && $('.datepicker').length){
        $('.datepicker').datepicker({ format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true });
    }
    $('#advertisement_description').summernote({
        height: 250,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['view', ['undo', 'redo', 'codeview']]
        ],
        placeholder: 'Enter detailed advertisement description...'
    });

    // Multiselect Dropdown for Ranks
    $(document).on('click', '.rankDropdownBtn', function() {
        $(this).siblings('.rankDropdownMenu').toggleClass('show');
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.multiselect-checkbox').length) {
            $('.rankDropdownMenu').removeClass('show');
        }
    });

    $(document).on('change', '.rankDropdownMenu input[type="checkbox"]', function() {
        let $row = $(this).closest('.shiptype-rank-row');
        let selected = [];
        $row.find('input[type="checkbox"]:checked').each(function() {
            selected.push($(this).parent().text().trim());
        });
        $row.find('.rankDropdownBtn').text(selected.length ? selected.join(', ') : 'Select Ranks');
    });

    // Shiptype & Rank Management
    let shiptypeRankIndex = {{ isset($shiptypeRanks) ? count($shiptypeRanks) : 1 }};
    $('#add-shiptype-rank').on('click', function() {
        let html = `
        <div class="dynamic-row shiptype-rank-row">
            <button type="button" class="btn btn-danger btn-sm remove-shiptype-rank" title="Remove"><i class="bx bx-trash"></i></button>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Ship Type</label>
                    <select name="advertisement_shiptypes[${shiptypeRankIndex}][shiptype]" class="form-select" required>
                        <option value="">Select Ship Type</option>
                        @foreach($shipTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->ship_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Required Ranks</label>
                    <div class="multiselect-checkbox position-relative">
                        <button type="button" class="form-control text-start rankDropdownBtn">
                            Select Ranks
                        </button>
                        <div class="dropdown-menu w-100 rankDropdownMenu">
                            @foreach($ranks as $rank)
                            <label class="dropdown-item">
                                <input type="checkbox" name="advertisement_shiptypes[${shiptypeRankIndex}][ranks][]" value="{{ $rank->id }}">
                                {{ $rank->rank }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        $('#shiptype-rank-wrapper').append(html);
        shiptypeRankIndex++;
    });

    // Remove Shiptype & Rank Row
    $(document).on('click', '.remove-shiptype-rank', function() {
        $(this).closest('.shiptype-rank-row').remove();
    });
});
</script>
@endpush
