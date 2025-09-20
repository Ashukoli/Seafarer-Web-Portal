<?php

namespace App\Http\Controllers\Admin\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MobileCountryCode;
use App\Models\Package;
use App\Models\ShipType;
use App\Models\Rank;
use App\Services\Company\CompanyRegisterService;
use App\Models\User;
use App\Models\CompanySubadmin;
use App\Models\CompanyDetail;

class CompanyRegisterController extends Controller
{
    protected $service;

    public function __construct(CompanyRegisterService $service)
    {
        $this->service = $service;
    }

    public function showForm($step = 1)
    {
        $step = (int) $step;
        if ($step < 1 || $step > 7) {
            $step = 1;
        }
        $countryCodes = MobileCountryCode::where('status', 1)->orderBy('country_name')->get();
        $shipTypes = ShipType::all();
        $ranks = Rank::all();
        $packages = Package::all();

        $company = session('register.company');
        $package = session('register.package');
        $superadmin = session('register.superadmin');
        $subadmins = session('register.subadmins');
        $banner = session('register.banner');
        $advertisement = session('register.advertisement');

        return view('admin.company.register', compact(
            'step', 'countryCodes', 'shipTypes', 'ranks', 'packages',
            'company', 'package', 'superadmin', 'subadmins', 'banner', 'advertisement'
        ));
    }

    public function handleStep(Request $request, $step)
    {
        switch ((int)$step) {
            case 1:
                $this->service->storeCompany($request);
                $request->validate([
                    'company_name' => 'required|string|max:255|unique:company_details,company_name',
                ]);
                break;
            case 2:
                $this->service->storePackage($request);
                break;
            case 3:
                $this->service->storeSuperadmin($request);
                $request->validate([
                    'superadmin_username'      => 'required|string|max:100|unique:users,username',
                    'superadmin_name'          => 'required|string|max:255',
                    'superadmin_designation'   => 'required|string|max:255',
                    'superadmin_country_code'  => 'required|string|max:8',
                    'superadmin_mobile'        => [
                        'required',
                        'string',
                        'max:20',
                        function ($attribute, $value, $fail) use ($request) {
                            $exists = User::where('country_code', $request->superadmin_country_code)
                                ->where('mobile', $value)
                                ->exists();
                            if ($exists) {
                                $fail('The mobile number with country code is already in use.');
                            }
                        }
                    ],
                    'superadmin_password'      => 'required|string|min:6',
                    'superadmin_email'         => 'nullable|email|unique:users,email',
                ]);
                break;
            case 4:
                $this->service->storeSubadmins($request);
                $rules = [];
                foreach ($request->input('subadmins', []) as $index => $subadmin) {
                    $rules["subadmins.$index.username"]      = 'required|string|max:100|unique:users,username';
                    $rules["subadmins.$index.name"]          = 'required|string|max:255';
                    $rules["subadmins.$index.designation"]   = 'required|string|max:255';
                    $rules["subadmins.$index.country_code"]  = 'required|string|max:8';
                    $rules["subadmins.$index.mobile"]        = [
                        'required',
                        'string',
                        'max:20',
                        function ($attribute, $value, $fail) use ($subadmin) {
                            $exists = User::where('country_code', $subadmin['country_code'])
                                ->where('mobile', $value)
                                ->exists();
                            if ($exists) {
                                $fail('The mobile number with country code is already in use.');
                            }
                        }
                    ];
                    $rules["subadmins.$index.password"]      = 'required|string|min:6';
                    $rules["subadmins.$index.email"]         = 'nullable|email|unique:users,email';
                }
                $request->validate($rules);

                $companySession = session('register.company');
                $companyDetail = null;
                if ($companySession && !empty($companySession['company_name'])) {
                    $companyDetail = CompanyDetail::where('company_name', $companySession['company_name'])->first();
                }

                $subadmins = $request->input('subadmins', []);
                foreach ($subadmins as $subadmin) {
                    if (
                        !empty($subadmin['username']) &&
                        !empty($subadmin['password']) &&
                        !empty($subadmin['name']) &&
                        !empty($subadmin['designation']) &&
                        !empty($subadmin['mobile']) &&
                        !empty($subadmin['country_code']) &&
                        $companyDetail
                    ) {
                        // Split full name
                        $fullName = trim($subadmin['name']);
                        $nameParts = explode(' ', $fullName, 2);
                        $firstName = $nameParts[0] ?? '';
                        $lastName = $nameParts[1] ?? '';

                        $subadminUser = User::create([
                            'user_type'     => 'company',
                            'role'          => 'subadmin',
                            'username'      => $subadmin['username'],
                            'first_name'    => $firstName,
                            'last_name'     => $lastName,
                            'designation'   => $subadmin['designation'],
                            'country_code'  => $subadmin['country_code'],
                            'mobile'        => $subadmin['mobile'],
                            'password'      => bcrypt($subadmin['password']),
                            'email'         => $subadmin['email'] ?? null,
                            'status'        => 'active',
                        ]);
                        CompanySubadmin::create([
                            'company_id' => $companyDetail->id,
                            'user_id' => $subadminUser->id,
                        ]);
                    }
                }
                break;
            case 5:
                $this->service->storeBanner($request);
                break;
            case 6:
                $this->service->storeAdvertisement($request);
                break;
            case 7:
                $this->service->finalizeRegistration();
                break;
        }

        $nextStep = (int)$step + 1;
        return redirect()->route('admin.company.register.step', $nextStep);
    }
}
