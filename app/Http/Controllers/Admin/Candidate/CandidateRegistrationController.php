<?php

namespace App\Http\Controllers\Admin\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Requests\CandidateRegistrationRequest;
use App\Services\Candidate\CandidateRegistrationService;
use App\Services\Candidate\CandidateService;
use App\Models\MobileCountryCode;
use App\Models\Rank;
use App\Models\ShipType;
use App\Models\CourseCertificate;
use App\Models\DceEndorsement;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use App\Models\CoursesAndOtherCertificateMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class CandidateRegistrationController extends Controller
{
    protected CandidateRegistrationService $service;
    protected CandidateService $readService;

    public function __construct(
        CandidateRegistrationService $service,
        CandidateService $readService
    ) {
        $this->service = $service;
        $this->readService = $readService;

        // optionally protect with middleware('auth:admin') if you have a custom guard
        $this->middleware('auth'); // adjust as needed
    }

    /**
     * Show registration form (admin).
     */
    public function create(Request $request)
    {
        $mobileCodes = MobileCountryCode::orderBy('country_name')->get();
        $ranks = Rank::orderBy('sort')->get();
        $shiptypes = ShipType::orderBy('sort')->get();
        $courses = CourseCertificate::orderBy('name')->get(); // legacy courses
        $dces = DceEndorsement::orderBy('sort')->get();
        $states = State::orderBy('state_name')->get();

        // NEW: countries and default country (IN)
        $countries = Country::orderBy('country_name')->get();
        $defaultCountry = $countries->firstWhere('country_code', 'IN') ?? $countries->first();
        $defaultCountryId = $defaultCountry->id ?? null;
        // load states for selected country (default IN)
        $countryStateId = $defaultCountry->id ?? null;
        $statesForCountry = State::where('country_id', $countryStateId)->orderBy('state_name')->get();

        // pick first state to load cities initially
        $firstState = $statesForCountry->first();
        $cities = $firstState ? City::where('state_id', $firstState->id)->orderBy('city_name')->get() : collect();

        // NEW: master courses table (courses_and_other_certificate_master)
        $coursesMaster = CoursesAndOtherCertificateMaster::orderBy('sort')->get();

        // show admin registration view
        return view('admin.candidate.registration', compact(
            'mobileCodes', 'ranks', 'shiptypes', 'courses', 'dces', 'states',
            'cities', 'countries', 'defaultCountry', 'defaultCountryId', 'statesForCountry', 'coursesMaster'
        ));
    }

    /**
     * Handle registration submit (admin).
     */
    public function store(CandidateRegistrationRequest $request)
    {
        // validated data (this will throw ValidationException automatically and redirect back with errors)
        $data = $request->validated();

        // attach uploaded file object for service to store
        if ($request->hasFile('profile_pic')) {
            $data['profile_pic_file'] = $request->file('profile_pic');
        }

        // Attach skipped steps info
        $data['skipped'] = $request->input('skipped', []);

        // Determine admin id (works for "admin" guard or default guard)
        $createdBy = $this->getAdminId();

        try {
            // registerFromAdmin should call your service which in turn calls createCandidate()
            $user = $this->service->registerFromAdmin($data, $createdBy);

            return redirect()->route('admin.candidates.create')
                ->with('success', 'Candidate created successfully (ID: ' . $user->id . ').');
        } catch (\Throwable $e) {
            Log::error('Candidate registration failed: '.$e->getMessage(), [
                'exception' => $e,
                'input' => $request->all(),
            ]);
            return back()->withInput()->withErrors(['error' => 'Registration failed: ' . $e->getMessage()]);
        }
    }

    /**
     * Validate candidate data via AJAX (admin).
     */
    public function ajaxValidate(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'mobile_cc' => 'required|string',
            'mobile_number' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($request) {
                    $cc = $request->input('mobile_cc');
                    if (
                        \App\Models\CandidateProfile::where('mobile_cc', $cc)
                            ->where('mobile_number', $value)
                            ->exists()
                    ) {
                        $fail('The mobile number with this country code is already taken.');
                    }
                }
            ],
            'whatsapp_cc' => 'required_with:whatsapp_number|string',
            'whatsapp_number' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) use ($request) {
                    $cc = $request->input('whatsapp_cc');
                    if ($value && $cc) {
                        if (
                            \App\Models\CandidateProfile::where('whatsapp_cc', $cc)
                                ->where('whatsapp_number', $value)
                                ->exists()
                        ) {
                            $fail('The WhatsApp number with this country code is already taken.');
                        }
                    }
                }
            ],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        return response()->json(['success' => true]);
    }


    /**
     * Get the currently authenticated admin's ID.
     *
     * @return int|null
     */
    protected function getAdminId(): ?int
    {
        // Prefer 'admin' guard if configured
        $guards = config('auth.guards', []);
        if (is_array($guards) && array_key_exists('admin', $guards)) {
            if (Auth::guard('admin')->check()) {
                return (int) Auth::guard('admin')->id();
            }
        }

        // Fallback to default auth
        if (Auth::check()) {
            return (int) Auth::id();
        }

        return null;
    }
}
