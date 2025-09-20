<?php
namespace App\Services\Company;

use App\Models\CompanyDetail;
use App\Models\Banner;
use App\Models\CompanySubadmin;
use App\Models\Advertisement;
use App\Models\AdvertisementRank;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CompanyRegisterService
{
    public function storeCompany($request)
    {
        $data = $request->all();
        if ($request->hasFile('company_logo')) {
            $logo = $request->file('company_logo');
            $logoName = 'logo_' . time() . '_' . Str::random(6) . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('theme/assets/images/company_logo'), $logoName);
            $data['company_logo'] = $logoName;
        }
        Session::put('register.company', $data);
    }

    public function storePackage($request)
    {
        $data = [
            'resume_view_package_id' => $request->input('resume_view_package_id'),
            'resume_download_package_id' => $request->input('resume_download_package_id'),
            'hotjobs_package_id' => $request->input('hotjobs_package_id'),
            'package_expiry' => $request->input('package_expiry'),
        ];
        Session::put('register.package', $data);
    }

    public function storeSuperadmin($request)
    {
        $data = $request->only([
            'superadmin_name',
            'superadmin_email',
            'superadmin_designation',
            'superadmin_country_code',
            'superadmin_mobile',
            'superadmin_password',
            'superadmin_username'
        ]);
        Session::put('register.superadmin', $data);
    }

    public function storeSubadmins($request)
    {
        $subadmins = $request->input('subadmins', []);
        Session::put('register.subadmins', $subadmins);
    }

    public function storeBanner($request)
    {
        $data = $request->only([
            'banner_section',
            'banner_order',
            'banner_status'
        ]);
        if ($request->hasFile('banner_image')) {
            $banner = $request->file('banner_image');
            $bannerName = 'banner_' . time() . '_' . Str::random(6) . '.' . $banner->getClientOriginalExtension();
            $banner->move(public_path('theme/assets/images/company_banner'), $bannerName);
            $data['banner_image'] = $bannerName;
        }
        Session::put('register.banner', $data);
    }

    public function storeAdvertisement($request)
    {
        $data = [
            'advertisement_subject' => $request->input('advertisement_subject'),
            'advertisement_description' => $request->input('advertisement_description'),
            'advertisement_shiptypes' => $request->input('advertisement_shiptypes', []),
            'advertisement_posted_date' => $request->input('advertisement_posted_date'),
        ];
        Session::put('register.advertisement', $data);
    }

    public function finalizeRegistration()
    {
        $companyData = Session::get('register.company', []);
        $packageData = Session::get('register.package', []);
        $superadminData = Session::get('register.superadmin', []);
        $subadmins = Session::get('register.subadmins', []);
        $bannerData = Session::get('register.banner', []);
        $advertisementData = Session::get('register.advertisement', []);

        $rpslExpiry = $companyData['rpsl_expiry'] ?? null;
        if ($rpslExpiry) {
            try {
                $rpslExpiry = Carbon::createFromFormat('d-m-Y', $rpslExpiry)->format('Y-m-d');
            } catch (\Exception $e) {
                $rpslExpiry = null;
            }
        }

        // 1. Create Superadmin User (with username uniqueness check)
        $superadminUser = null;
        if (!empty($superadminData['superadmin_username'])) {
            if (User::where('username', $superadminData['superadmin_username'])->exists()) {
                throw new \Exception('Superadmin username already exists.');
            }
            // Split full name
            $fullName = trim($superadminData['superadmin_name']);
            $nameParts = explode(' ', $fullName, 2);
            $firstName = $nameParts[0] ?? '';
            $lastName = $nameParts[1] ?? '';

            $superadminUser = User::create([
                'user_type'     => 'company',
                'role'          => 'super_admin',
                'username'      => $superadminData['superadmin_username'],
                'first_name'    => $firstName,
                'last_name'     => $lastName,
                'designation'   => $superadminData['superadmin_designation'],
                'country_code'  => $superadminData['superadmin_country_code'],
                'mobile'        => $superadminData['superadmin_mobile'],
                'email'         => $superadminData['superadmin_email'],
                'password'      => Hash::make($superadminData['superadmin_password']),
                'status'        => 'active',
            ]);
        }

        $packageExpiry = $packageData['package_expiry'] ?? null;
        if ($packageExpiry) {
            try {
                $packageExpiry = Carbon::createFromFormat('d-m-Y', $packageExpiry)->format('Y-m-d');
            } catch (\Exception $e) {
                $packageExpiry = null;
            }
        }

        // 2. Save company details with superadmin user_id
        $companyDetail = new CompanyDetail();
        $companyDetail->fill([
            'user_id' => $superadminUser ? $superadminUser->id : null,
            'company_name' => $companyData['company_name'] ?? null,
            'company_email' => $companyData['company_email'] ?? null,
            'company_contact_country_code' => $companyData['company_contact_country_code'] ?? null,
            'company_contact_no' => $companyData['company_contact_no'] ?? null,
            'website' => $companyData['website'] ?? null,
            'rpsl_number' => $companyData['rpsl_number'] ?? null,
            'rpsl_expiry' => $rpslExpiry,
            'area' => $companyData['area'] ?? null,
            'address' => $companyData['address'] ?? null,
            'company_type' => $companyData['company_type'] ?? null,
            'account_type' => $companyData['account_type'] ?? null,
            'tie_up_company' => $companyData['tie_up_company'] ?? 0,
            'listed_in_banner' => $companyData['listed_in_banner'] ?? 0,
            'company_logo' => $companyData['company_logo'] ?? null,
            'directors' => $companyData['directors'] ?? null,
            'superadmin_designation' => $superadminData['superadmin_designation'] ?? null,
            'resume_view_package_id' => $packageData['resume_view_package_id'] ?? null,
            'resume_download_package_id' => $packageData['resume_download_package_id'] ?? null,
            'hotjobs_package_id' => $packageData['hotjobs_package_id'] ?? null,
            'package_expiry' => $packageExpiry ?? null,
        ]);
        $companyDetail->save();

        // 3. Create Subadmin Users and link (with username uniqueness check)
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
                    'password'      => Hash::make($subadmin['password']),
                    'email'         => $subadmin['email'] ?? null,
                    'status'        => 'active',
                ]);
                CompanySubadmin::create([
                    'company_id' => $companyDetail->id,
                    'user_id'    => $subadminUser->id,
                ]);
            }
        }

        // Save banner
        if (!empty($bannerData['banner_image'])) {
            Banner::create([
                'company_id' => $companyDetail->id,
                'image' => $bannerData['banner_image'],
                'section' => $bannerData['banner_section'],
                'order' => $bannerData['banner_order'],
                'status' => $bannerData['banner_status'],
            ]);
        }

        // Save advertisement and ranks
        if (!empty($advertisementData['advertisement_subject'])) {
            $postedDate = $advertisementData['advertisement_posted_date'] ?? null;
            if ($postedDate) {
                $postedDate = Carbon::createFromFormat('d-m-Y', $postedDate)->format('Y-m-d');
            }

            $advertisement = Advertisement::create([
                'company_id' => $companyDetail->id,
                'description' => $advertisementData['advertisement_description'],
                'posted_date' => $postedDate,
                'subject' => $advertisementData['advertisement_subject'],
                'advertisement_type' => 'fixed',
            ]);
            foreach ($advertisementData['advertisement_shiptypes'] as $shiptypeIndex => $shiptypeData) {
                $shiptypeId = $shiptypeData['shiptype'] ?? null;
                $ranks = $shiptypeData['ranks'] ?? [];
                foreach ($ranks as $rankId) {
                    AdvertisementRank::create([
                        'advertisement_id' => $advertisement->id,
                        'shiptype_id' => $shiptypeId,
                        'rank_id' => $rankId,
                    ]);
                }
            }
        }

        Session::forget('register');
    }
}
