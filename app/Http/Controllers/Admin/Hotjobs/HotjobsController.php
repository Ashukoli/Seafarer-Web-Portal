<?php
// app/Http/Controllers/Admin/Hotjobs/HotjobsController.php
namespace App\Http\Controllers\Admin\Hotjobs;

use App\Http\Controllers\Controller;
use App\Models\Hotjob;
use App\Models\CompanyDetail;
use App\Models\Rank;
use App\Models\ShipType;
use App\Models\Country;
use App\Models\MobileCountryCode;
use Illuminate\Http\Request;
use App\Services\Hotjobs\HotjobsService;
use Carbon\Carbon;

class HotjobsController extends Controller
{
    protected $service;

    public function __construct(HotjobsService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $hotjobs = $this->service->list($request->all());
        return view('admin.hotjobs.index', compact('hotjobs'));
    }

    public function create()
    {
        $companies = CompanyDetail::all();
        $ranks = Rank::orderBy('sort')->get();
        $ships = ShipType::orderBy('sort')->get();
        $countries = Country::orderBy('country_name')->get();
        $mobileCountryCodes = MobileCountryCode::where('status', 1)->orderBy('country_name')->get();
        return view('admin.hotjobs.create', compact('companies', 'ranks', 'ships', 'countries', 'mobileCountryCodes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_id' => 'required|exists:company_details,id',
            'rank_id' => 'required|exists:ranks,id',
            'ship_id' => 'required|exists:ship_types,id',
            'joiningdate' => 'required|string',
            'nationality' => 'required|string|max:191',
            'experience_count' => 'required|integer|min:0|max:30',
            'experience_type' => 'required|in:Months,Years',
            'description' => 'required|string',
            'expiry_date' => 'required|string',
            'status' => 'required|in:pending,active,expired',
            'withsms' => 'required|in:yes,no',
            'posted_by_name' => 'required|string|max:191',
            'posted_by_email' => 'required|email|max:191',
            'posted_by_country_code' => 'required|string|max:10',
            'posted_by_mobile' => 'required|string|max:20',
        ]);

        // Combine experience fields
        $data['experience'] = $data['experience_count'] . ' ' . $data['experience_type'];

        // Convert dates from d-m-Y to Y-m-d
        if (!empty($data['joiningdate'])) {
            $data['joiningdate'] = Carbon::createFromFormat('d-m-Y', $data['joiningdate'])->format('Y-m-d');
        }
        if (!empty($data['expiry_date'])) {
            $data['expiry_date'] = Carbon::createFromFormat('d-m-Y', $data['expiry_date'])->format('Y-m-d');
        }

        $this->service->create($data);
        return redirect()->route('admin.hotjobs.index')->with('success', 'Hotjob added!');
    }

    public function edit(Hotjob $hotjob)
    {
        $companies = CompanyDetail::all();
        $ranks = Rank::orderBy('sort')->get();
        $ships = ShipType::orderBy('sort')->get();
        $countries = Country::orderBy('country_name')->get();
        $mobileCountryCodes = MobileCountryCode::where('status', 1)->orderBy('country_name')->get();

        return view('admin.hotjobs.edit', compact(
            'hotjob', 'companies', 'ranks', 'ships', 'countries', 'mobileCountryCodes'
        ));
    }

    public function update(Request $request, Hotjob $hotjob)
    {
        $data = $request->validate([
            'company_id' => 'required|exists:company_details,id',
            'rank_id' => 'required|exists:ranks,id',
            'ship_id' => 'required|exists:ship_types,id',
            'joiningdate' => 'required|string',
            'nationality' => 'required|string|max:191',
            'experience_count' => 'required|integer|min:0|max:30',
            'experience_type' => 'required|in:Months,Years',
            'description' => 'required|string',
            'expiry_date' => 'required|string',
            'status' => 'required|in:pending,active,expired',
            'withsms' => 'required|in:yes,no',
            'posted_by_name' => 'required|string|max:191',
            'posted_by_email' => 'required|email|max:191',
            'posted_by_country_code' => 'required|string|max:10',
            'posted_by_mobile' => 'required|string|max:20',
        ]);

        // Combine experience fields
        $data['experience'] = $data['experience_count'] . ' ' . $data['experience_type'];

        // Convert dates from d-m-Y to Y-m-d
        if (!empty($data['joiningdate'])) {
            $data['joiningdate'] = \Carbon\Carbon::createFromFormat('d-m-Y', $data['joiningdate'])->format('Y-m-d');
        }
        if (!empty($data['expiry_date'])) {
            $data['expiry_date'] = \Carbon\Carbon::createFromFormat('d-m-Y', $data['expiry_date'])->format('Y-m-d');
        }

        $this->service->update($hotjob, $data);
        return redirect()->route('admin.hotjobs.index')->with('success', 'Hotjob updated!');
    }

    public function validateHotjob(Hotjob $hotjob)
    {
        $this->service->validateHotjob($hotjob);
        return redirect()->route('admin.hotjobs.index')->with('success', 'Hotjob validated!');
    }
}
