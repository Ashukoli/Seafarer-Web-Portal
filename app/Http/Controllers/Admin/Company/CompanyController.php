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
use App\Models\CompanySubadminLoginLog;
use App\Models\CompanyFollowUp;

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

    public function show($id)
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
        $superadmin = $company->superadmin;
        $superadminId = $superadmin ? $superadmin->id : null;

        $request->validate([
            'superadmin_username'      => [
                'required',
                'string',
                'max:100',
                \Illuminate\Validation\Rule::unique('users', 'username')->ignore($superadminId),
            ],
            'superadmin_name'          => 'required|string|max:255',
            'superadmin_designation'   => 'required|string|max:255',
            'superadmin_country_code'  => 'required|string|max:8',
            'superadmin_mobile'        => 'required|string|max:20',
            'superadmin_email'         => [
                'nullable',
                'email',
                \Illuminate\Validation\Rule::unique('users', 'email')->ignore($superadminId),
            ],
            'superadmin_password'      => $superadmin ? 'nullable|string|min:6' : 'required|string|min:6',
        ]);

        // Combined uniqueness checks
        $checks = [
            [
                'field' => ['username' => $request->superadmin_username],
                'error' => ['superadmin_username' => 'The username is already in use.'],
            ],
            [
                'field' => [
                    'mobile' => $request->superadmin_mobile,
                    'country_code' => $request->superadmin_country_code,
                ],
                'error' => ['superadmin_mobile' => 'The mobile number is already in use.'],
            ],
        ];

        if ($request->superadmin_email) {
            $checks[] = [
                'field' => ['email' => $request->superadmin_email],
                'error' => ['superadmin_email' => 'The email is already in use.'],
            ];
        }

        foreach ($checks as $check) {
            $query = User::query();
            foreach ($check['field'] as $col => $val) {
                $query->where($col, $val);
            }
            if ($superadminId) {
                $query->where('id', '!=', $superadminId);
            }
            if ($query->exists()) {
                return back()->withErrors($check['error'])->withInput();
            }
        }

        // All DB operations are handled in the service
        $this->service->updateOrCreateSuperadmin($company, $request->all());

        return redirect()->route('admin.company.superadmin.edit', $companyId)->with('success', 'Superadmin updated successfully.');
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
                'designation' => $sub->user->designation, // <-- from user
                'country_code' => $sub->user->country_code ?? '+91', // <-- from user
                'mobile' => $sub->user->mobile ?? '', // <-- from user
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

        // Uniqueness checks for username, mobile, and email in users table
        foreach ($request->input('subadmins', []) as $index => $subadmin) {
            $id = $subadmin['id'] ?? null;

            // Username uniqueness (including soft-deleted)
            $usernameExists = User::withTrashed()
                ->where('username', $subadmin['username'])
                ->when($id, fn($q) => $q->where('id', '!=', $id))
                ->exists();
            if ($usernameExists) {
                return back()->withErrors([
                    "subadmins.$index.username" => "The username {$subadmin['username']} is already in use.",
                ])->withInput();
            }

            // Mobile uniqueness (including soft-deleted)
            $mobileExists = User::withTrashed()
                ->where('mobile', $subadmin['mobile'])
                ->where('country_code', $subadmin['country_code'])
                ->when($id, fn($q) => $q->where('id', '!=', $id))
                ->exists();
            if ($mobileExists) {
                return back()->withErrors([
                    "subadmins.$index.mobile" => "The mobile number {$subadmin['country_code']} {$subadmin['mobile']} is already in use.",
                ])->withInput();
            }

            // Email uniqueness (including soft-deleted)
            if (!empty($subadmin['email'])) {
                $emailExists = User::withTrashed()
                    ->where('email', $subadmin['email'])
                    ->when($id, fn($q) => $q->where('id', '!=', $id))
                    ->exists();
                if ($emailExists) {
                    return back()->withErrors([
                        "subadmins.$index.email" => "The email {$subadmin['email']} is already in use.",
                    ])->withInput();
                }
            }
        }

        app(CompanyService::class)->updateSubadmins($company, $request->input('subadmins', []));

        return redirect()->route('admin.company.subadmins.edit', $company->id)->with('success', 'Subadmins updated successfully!');
    }

    public function adminLogins($companyId)
    {
        $company = CompanyDetail::findOrFail($companyId);
        $superadmin = $company->superadmin;
        $subadmins = $company->subadmins()->with('user')->get();

        return view('admin.company.adminlogins', compact('company', 'superadmin', 'subadmins'));
    }

    public function showLoginLogs($companyId, $userId)
    {
        $company = CompanyDetail::findOrFail($companyId);
        $user = User::findOrFail($userId);

        $logs = CompanySubadminLoginLog::where('user_id', $userId)
            ->orderByDesc('login_at')
            ->paginate(50);

        return view('admin.company.loginlogs', compact('company', 'user', 'logs'));
    }

    // List all follow-ups (today's and next)
    public function followupsIndex(Request $request)
    {
        $perPage = (int) $request->input('per_page', 25);
        $followups = $this->service->getFollowUpsForTodayAndUpcoming($perPage);
        return view('admin.company.followups.index', compact('followups'));
    }

    // Show create form
    public function followupsCreate(Request $request)
    {
        $companyId = $request->get('company_id');
        $company = CompanyDetail::findOrFail($companyId);

        // Fetch previous follow-ups for this company, ordered by next_follow_up_date descending, then follow_up_date descending
        $previousFollowups = CompanyFollowUp::where('company_id', $companyId)
            ->orderByDesc('next_follow_up_date')
            ->orderByDesc('follow_up_date')
            ->get();

        return view('admin.company.followups.create', compact('company', 'previousFollowups'));
    }

    // Store new follow-up
    public function followupsStore(Request $request)
    {
        $data = $request->validate([
            'company_id'          => 'required|exists:company_details,id',
            'message'             => 'required|string|max:255',
            'next_follow_up_date' => 'required|string', // will convert to Y-m-d below
        ]);

        // Set executive from logged-in admin
        $data['executive'] = auth('admin')->user()->name ?? auth('admin')->user()->username;

        // Set follow_up_date to today
        $data['follow_up_date'] = now()->format('Y-m-d');

        // Convert next_follow_up_date from d-m-Y to Y-m-d
        if (!empty($data['next_follow_up_date'])) {
            try {
                $data['next_follow_up_date'] = \Carbon\Carbon::createFromFormat('d-m-Y', $data['next_follow_up_date'])->format('Y-m-d');
            } catch (\Exception $e) {
                $data['next_follow_up_date'] = null;
            }
        }

        $data['followup_taken'] = false; // default, or set as needed

        $this->service->createFollowUp($data);

        return redirect()->route('admin.company.followups.index')->with('success', 'Follow-up added!');
    }

    public function bannersIndex(Request $request, CompanyService $service)
    {
        $filters = [
            'company' => $request->input('company'),
            'section' => $request->input('section'),
        ];
        $banners = $service->getAllBanners($filters);
        return view('admin.company.banners.index', compact('banners'));
    }
}
