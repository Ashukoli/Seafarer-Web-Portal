<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Services\Candidate\CandidateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    protected CandidateService $service;

    public function __construct(CandidateService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    /**
     * GET /candidate/dashboard
     */
    public function dashboard()
    {
        $user = Auth::user();

        return view('candidate.dashboard', compact('user'));
    }

    /**
     * GET /candidate/resume  (route name candidate.resume.edit)
     * Show edit form.
     */
    public function editResume ()
    {
        $userId = Auth::id();
        $data = $this->service->getForEdit($userId);

        // $data keys: user, profile, resume, states, cities, ranks, shiptypes, dces, coursesMaster
        return view('candidate.resume.edit', $data);
    }

    /**
     * POST /candidate/resume  (route name candidate.resume.update)
     * Persist resume changes.
     */
    public function update(Request $request)
    {
        $userId = Auth::id();

        $rules = [
            // Profile
            'first_name' => 'nullable|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'marital_status' => 'nullable|in:single,married,divorced,widowed',
            'dob' => 'nullable|date_format:Y-m-d',
            'mobile_cc' => 'nullable|string|max:6',
            'mobile_number' => 'nullable|string|max:30',
            'whatsapp_cc' => 'nullable|string|max:6',
            'whatsapp_number' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:1000',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'gender' => 'nullable|in:male,female,other',
            'nationality' => 'nullable|string|max:100',
            'profile_pic' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',

            // Resume
            'present_rank' => 'nullable|exists:ranks,id',
            'present_rank_exp' => 'nullable|string|max:255',
            'post_applied_for' => 'nullable|exists:ranks,id',
            'date_of_availability' => 'nullable|date_format:Y-m-d',
            'indos_number' => 'nullable|string|max:255',
            'passport_nationality' => 'nullable|exists:countries,id',
            'passport_number' => 'nullable|string|max:255',
            'passport_expiry' => 'nullable|date_format:Y-m-d',
            'usa_visa' => 'nullable|in:0,1',
            'cdc_nationality' => 'nullable|exists:countries,id',
            'cdc_no' => 'nullable|string|max:255',
            'cdc_expiry' => 'nullable|date_format:Y-m-d',
            'presea_training_type' => 'nullable|string|max:255',
            'presea_training_issue_date' => 'nullable|date_format:Y-m-d',
            'coc_held' => 'nullable|in:0,1',
            'coc_type' => 'nullable|string|max:255',
            'coc_no' => 'nullable|string|max:255',
            'coc_date_of_expiry' => 'nullable|date_format:Y-m-d',
            'additional_information' => 'nullable|string|max:2000',

            // DCE endorsements
            'dce_id' => 'nullable|array',
            'dce_id.*' => 'nullable|exists:dce_endorsements,id',
            'dce_validity' => 'nullable|array',
            'dce_validity.*' => 'nullable|date_format:Y-m-d',

            // Courses
            'courses' => 'nullable|array',
            'courses.*' => 'nullable|exists:courses_and_other_certificate_master,id',

            // Sea service
            'sea_service' => 'nullable|array',
            'sea_service.*.rank_id' => 'nullable|exists:ranks,id',
            'sea_service.*.ship_type_id' => 'nullable|exists:ship_types,id',
            'sea_service.*.company_name' => 'nullable|string|max:255',
            'sea_service.*.ship_name' => 'nullable|string|max:255',
            'sea_service.*.sign_on' => 'nullable|date_format:Y-m-d',
            'sea_service.*.sign_off' => 'nullable|date_format:Y-m-d',
            'sea_service.*.grt_value' => 'nullable|numeric',
            'sea_service.*.grt_unit' => 'nullable|in:GRT,DWT',
            'sea_service.*.bhp' => 'nullable|numeric',
        ];

        $validated = $request->validate($rules);

        if ($request->hasFile('profile_pic')) {
            $validated['profile_pic_file'] = $request->file('profile_pic');
        }

        app(CandidateService::class)->updateResume($userId, $validated);

        return redirect()->route('candidate.resume.edit')->with('success', 'Resume saved successfully.');
    }

    /**
     * GET /candidate/resume/view (route name candidate.resume.view)
     * Read-only resume view.
     */
    public function show()
    {
        $userId = Auth::id();
        $data = $this->service->getForShow($userId);

        // returns: user, profile, resume, seaServices, dceEndorsements, courses, ranks, shiptypes, states, cities
        return view('candidate.resume.show', $data);
    }

    /**
     * POST /candidate/resume/hide - toggle visibility (simple example).
     */


    /* ---------- Small stubs for other routes referenced in web.php ---------- */

    public function searchJobs()
    {
        return view('candidate.jobs.search');
    }

    public function hotJobs()
    {
        return view('candidate.jobs.hot');
    }

    public function expressService()
    {
        return view('candidate.express.service');
    }

    public function statisticsApplied()
    {
        return view('candidate.statistics.applied');
    }

    public function statisticsViewed()
    {
        return view('candidate.statistics.viewed');
    }

    public function messages()
    {
        return view('candidate.messages.index');
    }

    /**
     * DELETE-style action via POST
     */
    public function deleteProfile(Request $request)
    {
        $user = Auth::user();
        // for safety, don't actually delete here — implement as needed
        // $user->delete();
        return redirect()->route('home')->with('success', 'Profile delete requested (implement actual deletion).');
    }
}
