<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Hotjobs\HotjobsService;
use App\Models\Rank;
use App\Models\ShipType;
use App\Models\Country;
use App\Models\MobileCountryCode;
use App\Models\CompanyDetail;
use App\Models\Hotjob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\Company\CompanyService;
use App\Services\StatisticsService;
use App\Services\Company\CandidateSearchService;

class CompanyController extends Controller
{
    public function dashboard()
    {
        return view('company.dashboard');
    }

    public function hotjobsIndex(HotjobsService $service)
    {
        $user = Auth::user();
        $company = CompanyDetail::where('user_id', $user->id)->first();
        if (!$company) {
            return back()->withErrors(['Company profile not found.']);
        }
        $hotjobs = $service->list(['company_id' => $company->id]);
        return view('company.hotjobs.index', compact('hotjobs'));
    }

    public function hotjobsCreate()
    {
        $ranks = Rank::orderBy('sort')->get();
        $ships = ShipType::orderBy('sort')->get();
        $countries = Country::orderBy('country_name')->get();
        $mobileCountryCodes = MobileCountryCode::where('status', 1)->orderBy('country_name')->get();
        $user = Auth::user();
        return view('company.hotjobs.create', compact('ranks', 'ships', 'countries', 'mobileCountryCodes', 'user'));
    }

    public function hotjobsStore(Request $request, HotjobsService $service)
    {
        $user = Auth::user();
        $company = CompanyDetail::where('user_id', $user->id)->first();
        if (!$company) {
            return back()->withErrors(['Company profile not found.']);
        }

        $data = $request->validate([
            'rank_id' => 'required|exists:ranks,id',
            'ship_id' => 'required|exists:ship_types,id',
            'joiningdate' => 'required|string',
            'nationality' => 'required|string|max:191',
            'experience_count' => 'required|integer|min:0|max:30',
            'experience_type' => 'required|in:Months,Years',
            'description' => 'required|string',
            'expiry_date' => 'required|string',
            'withsms' => 'required|in:yes,no',
            'posted_by_name' => 'required|string|max:191',
            'posted_by_email' => 'required|email|max:191',
            'posted_by_country_code' => 'required|string|max:10',
            'posted_by_mobile' => 'required|string|max:20',
        ]);

        $data['company_id'] = $company->id;
        $data['status'] = 'pending'; // Always pending by default
        $data['experience'] = $data['experience_count'] . ' ' . $data['experience_type'];

        // Convert dates from d-m-Y to Y-m-d
        if (!empty($data['joiningdate'])) {
            $data['joiningdate'] = \Carbon\Carbon::createFromFormat('d-m-Y', $data['joiningdate'])->format('Y-m-d');
        }
        if (!empty($data['expiry_date'])) {
            $data['expiry_date'] = \Carbon\Carbon::createFromFormat('d-m-Y', $data['expiry_date'])->format('Y-m-d');
        }

        $service->create($data);
        return redirect()->route('company.hotjobs.index')->with('success', 'Hotjob added!');
    }

    public function hotjobsDestroy($hotjobId, HotjobsService $service)
    {
        $user = Auth::user();
        $company = CompanyDetail::where('user_id', $user->id)->first();
        if (!$company) {
            return back()->withErrors(['Company profile not found.']);
        }

        $service->delete($hotjobId, $company->id);

        return redirect()->route('company.hotjobs.index')->with('success', 'Hotjob deleted successfully.');
    }

    public function subadminList(CompanyService $service)
        {
            $user = auth('company')->user();
            $company = CompanyDetail::where('user_id', $user->id)->firstOrFail();
            $subadmins = $service->getSubadmins($company->id);

            return view('company.subadmin.list', compact('subadmins'));
        }


    public function editSubadmin($id)
    {
        $subadmin = User::where('id', $id)->where('user_type', 'subadmin')->firstOrFail();
        return view('company.subadmin.edit', compact('subadmin'));
    }

    public function updateSubadmin(Request $request, $id)
    {
        $subadmin = User::where('id', $id)->where('user_type', 'subadmin')->firstOrFail();

        $data = $request->validate([
            'first_name' => 'required|string|max:191',
            'last_name' => 'nullable|string|max:191',
            'designation' => 'required|string|max:191',
            'country_code' => 'required|string|max:10',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|max:191',
            'status' => 'required|in:active,inactive',
        ]);

        $subadmin->update($data);

        return redirect()->route('company.subadmin.list')->with('success', 'Subadmin updated successfully.');
    }

    public function applied(StatisticsService $statistics)
    {
        $user = Auth::user();
        $company = CompanyDetail::where('user_id', $user->id)->first();

        if (!$company) {
            abort(404, 'Company profile not found.');
        }

        $appliedStats = $statistics->getCompanyAppliedStats($company);

        return view('company.statistics.applied', compact('appliedStats'));
    }

    public function searchCandidates(Request $request, CandidateSearchService $service)
    {
        $filters = $request->all();
        $candidates = $service->search($filters);

        // For filter dropdowns
        $ranks = Rank::orderBy('sort')->get();
        $shipTypes = ShipType::orderBy('sort')->get();
        $cocCountries = ['Indian', 'UK', 'Panama', 'Marshall Islands', 'Singapore', 'Philippines', 'Other'];

        return view('company.candidates.search', compact('candidates', 'ranks', 'shipTypes', 'cocCountries', 'filters'));
    }

}
