<?php

namespace App\Http\Controllers\Admin\Company;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Company\CompanyService;
use App\Models\CompanyDetail;
use App\Models\ShipType;
use App\Models\Rank;
use App\Models\Package;
use App\Models\Banner;
use App\Models\CountryCode;
use App\Models\User;
use App\Models\CompanySubadmin;

class CompanyController extends Controller
{
    protected CompanyService $service;

    public function __construct(CompanyService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $perPage = (int) $request->input('per_page', 20);
        $companies = $this->service->getAllCompanies($perPage);
        return view('admin.company.index', compact('companies'));
    }

    public function show(int $id)
    {
        $company = $this->service->getCompanyById($id);
        return view('admin.company.show', compact('company'));
    }

    public function edit(int $id)
    {
        $company = $this->service->getCompanyById($id);
        $shipTypes = ShipType::all();
        $ranks = Rank::all();
        $packages = Package::all();
        $banner = Banner::where('company_id', $company->id)->first();
        $advertisement = \App\Models\Advertisement::where('company_id', $company->id)->first();
        $shiptypeRanks = [];
        if ($advertisement) {
            $adRanks = \App\Models\AdvertisementRank::where('advertisement_id', $advertisement->id)->get();
            foreach ($adRanks->groupBy('shiptype_id') as $shiptypeId => $ranksGroup) {
                $shiptypeRanks[] = [
                    'shiptype' => $shiptypeId,
                    'ranks' => $ranksGroup->pluck('rank_id')->toArray(),
                ];
            }
        }
        if (empty($shiptypeRanks)) {
            $shiptypeRanks = [[]]; // At least one empty row for UI
        }

        return view('admin.company.edit', compact('company', 'shipTypes', 'ranks', 'packages', 'banner', 'advertisement', 'shiptypeRanks'));
    }



    public function update(Request $request, int $id)
    {
        $rules = [
            'company_name' => 'required|string|max:255|unique:company_details,company_name,' . $id,
            'company_email' => 'nullable|email|max:255',
            'company_contact_no' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255',
            'rpsl_number' => 'nullable|string|max:255',
            'rpsl_expiry' => 'nullable|string|max:50',
            'company_type' => 'nullable|string|max:100',
            'account_type' => 'nullable|string|max:100',
            'company_logo' => 'nullable|image|max:2048',
            'banner_image' => 'nullable|image|max:2048',
        ];

        // Custom validation: If shiptypes/ranks are present, advertisement_subject is required
        $shiptypes = $request->input('advertisement_shiptypes', []);
        $hasRanks = false;
        foreach ($shiptypes as $shiptype) {
            if (!empty($shiptype['shiptype']) && !empty($shiptype['ranks'])) {
                $hasRanks = true;
                break;
            }
        }
        if ($hasRanks) {
            $rules['advertisement_subject'] = 'required|string|max:255';
        }

        $request->validate($rules);

        $company = $this->service->getCompanyById($id);

        $data = $request->only([
            'company_name',
            'company_email',
            'company_contact_country_code',
            'company_contact_no',
            'website',
            'rpsl_number',
            'rpsl_expiry',
            'area',
            'address',
            'company_type',
            'account_type',
            'tie_up_company',
            'listed_in_banner',
            'directors',
            'resumes_view_per_day',
            'resumes_download_per_day',
            'hotjobs_per_day',
            'banner_section',
            'banner_order',
            'banner_status',
            'advertisement_subject',
            'advertisement_description',
            'advertisement_posted_date',
            'advertisement_shiptypes',
        ]);

        // Handle company logo upload
        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            if (!$file->isValid()) {
                dd([
                    'error_code' => $file->getError(),
                    'error_message' => $file->getErrorMessage(),
                    'max_upload' => ini_get('upload_max_filesize'),
                    'max_post' => ini_get('post_max_size'),
                ]);
            }
            $name = 'logo_' . time() . '_' . \Illuminate\Support\Str::random(6) . '.' . $file->getClientOriginalExtension();
            try {
                $file->move(public_path('theme/assets/images/company_logo'), $name);
            } catch (\Exception $e) {
                dd([
                    'move_error' => $e->getMessage(),
                    'move_trace' => $e->getTraceAsString(),
                    'dest_path' => public_path('theme/assets/images/company_logo'),
                    'is_writable' => is_writable(public_path('theme/assets/images/company_logo')),
                ]);
            }
            // delete old logo if exists
            if (!empty($company->company_logo) && file_exists(public_path('theme/assets/images/company_logo/' . $company->company_logo))) {
                @unlink(public_path('theme/assets/images/company_logo/' . $company->company_logo));
            }
            $data['company_logo'] = $name;
        }

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $bannerFile = $request->file('banner_image');
            if (!$bannerFile->isValid()) {
                dd([
                    'error_code' => $bannerFile->getError(),
                    'error_message' => $bannerFile->getErrorMessage(),
                    'max_upload' => ini_get('upload_max_filesize'),
                    'max_post' => ini_get('post_max_size'),
                ]);
            }
            $bannerName = 'banner_' . time() . '_' . \Illuminate\Support\Str::random(6) . '.' . $bannerFile->getClientOriginalExtension();
            try {
                $bannerFile->move(public_path('theme/assets/images/company_banner'), $bannerName);
            } catch (\Exception $e) {
                dd([
                    'move_error' => $e->getMessage(),
                    'move_trace' => $e->getTraceAsString(),
                    'dest_path' => public_path('theme/assets/images/company_banner'),
                    'is_writable' => is_writable(public_path('theme/assets/images/company_banner')),
                ]);
            }
            $data['banner_image'] = $bannerName;
        }

        $this->service->updateCompanyWithRelations($id, $data);

        return redirect()->route('admin.company.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->service->deleteCompany($id);
        return redirect()->route('admin.company.index')->with('success', 'Company deleted successfully.');
    }

    public function editSuperadmin($companyId)
    {
        $company = CompanyDetail::findOrFail($companyId);
        $superadmin = $company->superadmin; // adjust as per your relation
        $countryCodes = CountryCode::where('status', 1)->get();
        return view('admin.company.edit_superadmin', compact('company', 'superadmin', 'countryCodes'));
    }

    public function updateSuperadmin(Request $request, $companyId)
    {
        $company = CompanyDetail::findOrFail($companyId);
        $superadmin = $company->superadmin; // Eloquent relation to User

        $request->validate([
            'superadmin_username'      => 'required|string|max:100|unique:users,username,' . ($superadmin->id ?? 'NULL') . ',id',
            'superadmin_name'          => 'required|string|max:255',
            'superadmin_designation'   => 'required|string|max:255',
            'superadmin_country_code'  => 'required|string|max:8',
            'superadmin_mobile'        => 'required|string|max:20',
            'superadmin_email'         => 'nullable|email|unique:users,email,' . ($superadmin->id ?? 'NULL') . ',id',
            'superadmin_password'      => $superadmin ? 'nullable|string|min:6' : 'required|string|min:6',
        ]);

        // Only update designation in company_details
        $company->superadmin_designation = $request->superadmin_designation;
        $company->save();

        // All other fields in user table
        app(CompanyService::class)->updateOrCreateSuperadmin($company, $request->all());

        return redirect()->route('admin.company.index')->with('success', 'Superadmin updated successfully.');
    }

    // --- Subadmin Management ---
    public function editSubadmins($companyId)
    {
        $company = CompanyDetail::findOrFail($companyId);
        // Get all subadmin users for this company
        $subadmins = $company->subadmins()->with('user')->get()->map(function ($sub) {
            return [
                'id' => $sub->user->id,
                'username' => $sub->user->username,
                'name' => $sub->user->first_name,
                'designation' => $sub->designation,
                'country_code' => $sub->country_code ?? '+91',
                 'mobile' => $sub->mobile ?? '',
                'email' => $sub->user->email,
            ];
        })->toArray();

        $countryCodes = CountryCode::where('status', 1)->get();
        return view('admin.company.edit_subadmins', compact('company', 'subadmins', 'countryCodes'));
    }

    public function updateSubadmins(Request $request, $companyId)
    {
        $company = CompanyDetail::findOrFail($companyId);

        $rules = [];
        foreach ($request->input('subadmins', []) as $index => $subadmin) {
            $id = $subadmin['id'] ?? null;
            $rules["subadmins.$index.username"]      = 'required|string|max:100';
            $rules["subadmins.$index.name"]          = 'required|string|max:255';
            $rules["subadmins.$index.designation"]   = 'required|string|max:255';
            $rules["subadmins.$index.country_code"]  = 'required|string|max:8';
            $rules["subadmins.$index.mobile"]        = 'required|string|max:20';
            $rules["subadmins.$index.email"]         = 'nullable|email|max:255';
            $rules["subadmins.$index.password"]      = $id ? 'nullable|string|min:6' : 'required|string|min:6';
        }
        $validated = $request->validate($rules);

        // Custom uniqueness validation for username, mobile (with country_code), and email
        foreach ($request->input('subadmins', []) as $index => $subadmin) {
            $id = $subadmin['id'] ?? null;

            // Username uniqueness in users table
            $usernameExists = User::where('username', $subadmin['username'])
                ->when($id, fn($q) => $q->where('id', '!=', $id))
                ->exists();
            if ($usernameExists) {
                return back()->withErrors([
                    "subadmins.$index.username" => "The username {$subadmin['username']} is already in use.",
                ])->withInput();
            }

            // Mobile uniqueness in users table
            $mobileExistsInUsers = User::where('mobile', $subadmin['mobile'])
                ->where('country_code', $subadmin['country_code'])
                ->when($id, fn($q) => $q->where('id', '!=', $id))
                ->exists();

            // Mobile uniqueness in company_subadmins table
            $mobileExistsInSubadmins = CompanySubadmin::where('mobile', $subadmin['mobile'])
                ->where('country_code', $subadmin['country_code'])
                ->when($id, fn($q) => $q->where('user_id', '!=', $id))
                ->exists();

            // Mobile uniqueness in company_details (superadmin)
            $mobileExistsInSuperadmin = CompanyDetail::where('superadmin_mobile', $subadmin['mobile'])
                ->where('superadmin_country_code', $subadmin['country_code'])
                ->where('id', '!=', $company->id)
                ->exists();

            if ($mobileExistsInUsers || $mobileExistsInSubadmins || $mobileExistsInSuperadmin) {
                return back()->withErrors([
                    "subadmins.$index.mobile" => "The mobile number {$subadmin['country_code']} {$subadmin['mobile']} is already in use.",
                ])->withInput();
            }

            // Email uniqueness in users table
            if (!empty($subadmin['email'])) {
                $emailExistsInUsers = User::where('email', $subadmin['email'])
                    ->when($id, fn($q) => $q->where('id', '!=', $id))
                    ->exists();

                // Email uniqueness in company_subadmins (via user relation)
                $emailExistsInSubadmins = CompanySubadmin::whereHas('user', function($q) use ($subadmin, $id) {
                        $q->where('email', $subadmin['email']);
                        if ($id) {
                            $q->where('id', '!=', $id);
                        }
                    })
                    ->exists();

                if ($emailExistsInUsers || $emailExistsInSubadmins) {
                    return back()->withErrors([
                        "subadmins.$index.email" => "The email {$subadmin['email']} is already in use.",
                    ])->withInput();
                }
            }
        }

        app(CompanyService::class)->updateSubadmins($company, $request->input('subadmins', []));

        return redirect()->route('admin.company.index')->with('success', 'Subadmins updated successfully!');
    }
}
