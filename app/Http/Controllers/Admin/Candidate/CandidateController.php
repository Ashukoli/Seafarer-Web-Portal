<?php

namespace App\Http\Controllers\Admin\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Candidate\CandidateService;
use App\Models\ProfileDeleteRequest;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    protected $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    /**
     * List all candidates with pagination and optional filters.
     */
    public function index(Request $request)
    {
        $candidates = $this->candidateService->paginateCandidates(20, [
            'search_field' => $request->input('search_field'),
            'search_value' => $request->input('search_value'),
            'search_rank' => $request->input('search_rank'),
            'search_shiptype' => $request->input('search_shiptype'),
        ], [
            'profile', 'resume', 'seaServiceDetails'
        ]);

        $ranks = \App\Models\Rank::orderBy('sort')->get();
        $shiptypes = \App\Models\ShipType::orderBy('ship_name')->get();

        return view('admin.candidate.index', compact('candidates', 'ranks', 'shiptypes'));
    }

    /**
     * Show the candidate followups page (stub, implement as needed).
     */
    public function followups(Request $request)
    {
        // Implement followup logic as per your requirements
        return view('admin.candidate.followups');
    }

    /**
     * Edit candidate (show edit form).
     */
    public function edit($id)
    {
        $user = \App\Models\User::with(['profile', 'resume', 'seaServiceDetails', 'dceEndorsements', 'courseCertificates'])->findOrFail($id);

        $ranks = \App\Models\Rank::orderBy('sort')->get();
        $shiptypes = \App\Models\ShipType::orderBy('ship_name')->get();
        $countries = \App\Models\Country::orderBy('country_name')->get();
        $states = \App\Models\State::orderBy('state_name')->get();
        $cities = \App\Models\City::orderBy('city_name')->get();
        $mobileCountryCodes = \App\Models\MobileCountryCode::orderBy('country_code')->get();
        $dces = \App\Models\DceEndorsement::orderBy('dce_name')->get();
        $coursesMaster = \App\Models\CourseCertificate::orderBy('name')->get();

        return view('admin.candidate.edit', compact(
            'user', 'ranks', 'shiptypes', 'countries', 'states', 'cities', 'mobileCountryCodes', 'dces', 'coursesMaster'
        ));
    }

    /**
     * Update candidate profile/resume (Admin).
     */
    public function updateResume(Request $request, $id)
    {
        $validated = $request->validate([
            // Profile fields
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'marital_status' => 'nullable|string|max:50',
            'dob' => 'nullable|date',
            'mobile_cc' => 'nullable|string|max:10',
            'mobile_number' => 'required|string|max:20',
            'whatsapp_cc' => 'nullable|string|max:10',
            'whatsapp_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'state_id' => 'nullable|integer|exists:states,id',
            'city_id' => 'nullable|integer|exists:cities,id',
            'nationality' => 'nullable|integer|exists:countries,id',
            'gender' => 'nullable|string|max:10',

            // Profile picture
            'profile_pic' => 'nullable|image|max:2048',

            // Resume fields
            'present_rank' => 'nullable|integer|exists:ranks,id',
            'present_rank_exp' => 'nullable|string|max:100',
            'post_applied_for' => 'nullable|integer|exists:ranks,id',
            'date_of_availability' => 'nullable|date',
            'indos_number' => 'nullable|string|max:50',
            'passport_nationality' => 'nullable|integer|exists:countries,id',
            'passport_number' => 'nullable|string|max:50',
            'passport_expiry' => 'nullable|date',
            'usa_visa' => 'nullable|boolean',
            'cdc_nationality' => 'nullable|integer|exists:countries,id',
            'cdc_no' => 'nullable|string|max:50',
            'cdc_expiry' => 'nullable|date',
            'presea_training_type' => 'nullable|string|max:100',
            'presea_training_issue_date' => 'nullable|date',
            'coc_held' => 'nullable|boolean',
            'coc_type' => 'nullable|string|max:100',
            'coc_no' => 'nullable|string|max:50',
            'coc_date_of_expiry' => 'nullable|date',
            'additional_information' => 'nullable|string|max:1000',

            // DCE Endorsements
            'dce_id' => 'array',
            'dce_id.*' => 'nullable|integer|exists:dce_endorsements,id',
            'dce_validity' => 'array',

            // Courses
            'courses' => 'array',
            'courses.*' => 'nullable|integer|exists:courses_and_other_certificate_masters,id',

            // Sea Service
            'sea_service' => 'array',
            'sea_service.*.rank_id' => 'nullable|integer|exists:ranks,id',
            'sea_service.*.ship_type_id' => 'nullable|integer|exists:ship_types,id',
            'sea_service.*.company_name' => 'nullable|string|max:100',
            'sea_service.*.ship_name' => 'nullable|string|max:100',
            'sea_service.*.sign_on' => 'nullable|date',
            'sea_service.*.sign_off' => 'nullable|date',
            'sea_service.*.grt_value' => 'nullable|integer',
            'sea_service.*.grt_unit' => 'nullable|string|max:10',
            'sea_service.*.bhp' => 'nullable|string|max:20',
        ]);

        // Handle file upload for profile_pic
        if ($request->hasFile('profile_pic')) {
            $validated['profile_pic_file'] = $request->file('profile_pic');
        }

        $this->candidateService->updateResume($id, $validated);

        return redirect()
            ->route('candidates.edit', $id)
            ->with('success', 'Candidate profile updated successfully.');
    }

    /**
     * Delete a candidate.
     */
    public function destroy($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.candidates.index')->with('success', 'Candidate deleted successfully.');
    }


    public function showDeleteRequest($id)
    {
        $req = ProfileDeleteRequest::with('candidate')->findOrFail($id);
        return view('admin.candidate.delete_requests.show', compact('req'));
    }

    public function deleteRequests(Request $request)
    {
        $status = $request->input('status', 'pending'); // pending | processed | all
        $perPage = (int) $request->input('per_page', 20);
        $search  = $request->input('q', null);

        $requests = $this->candidateService->getProfileDeleteRequests($status, $perPage, $search);

        return view('admin.candidate.delete_requests.index', compact('requests', 'status', 'search'));
    }

    /**
     * Process (confirm) a delete request. Expects a POST with confirmation.
     */
    public function processDeleteRequest(Request $request, $id)
    {
        $request->validate([
            'confirm' => 'required|in:yes'
        ]);

        $adminId = Auth::id();

        $this->candidateService->processProfileDeleteRequest($id, $adminId);

        return redirect()->route('admin.candidate.delete_requests.index')
            ->with('success', 'Candidate profile deleted and request processed.');
    }
}
