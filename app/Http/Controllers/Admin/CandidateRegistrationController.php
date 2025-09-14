<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CandidateRegistrationRequest;
use App\Services\Candidate\CandidateRegistrationService;
use App\Models\MobileCountryCode;
use App\Models\Rank;
use App\Models\ShipType;
use App\Models\CourseCertificate;
use App\Models\DceEndorsement;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateRegistrationController extends Controller
{
    protected CandidateRegistrationService $service;

    public function __construct(CandidateRegistrationService $service)
    {
        $this->service = $service;
        // Optionally add middleware('auth:admin') if you use a custom admin guard
    }

    /**
     * Show registration form (admin).
     */
    public function create(Request $request)
    {
        $mobileCodes = MobileCountryCode::orderBy('country_name')->get();
        $ranks = Rank::orderBy('sort')->get();
        $shiptypes = ShipType::orderBy('sort')->get();
        $courses = CourseCertificate::orderBy('name')->get();
        $dces = DceEndorsement::orderBy('sort')->get();
        $states = State::orderBy('state_name')->get();
        $cities = City::where('state_id', $states->first()->id ?? null)
                      ->orderBy('city_name')->get();

        // Use admin blade or frontend edit-resume blade (choose the correct path)
        return view('admin.candidate.registration', compact(
            'mobileCodes', 'ranks', 'shiptypes', 'courses', 'dces', 'states', 'cities'
        ));
    }

    /**
     * Handle registration submit (admin).
     */
    public function store(CandidateRegistrationRequest $request)
    {
        $data = $request->validated();

        // attach uploaded file object for service to store
        if ($request->hasFile('profile_pic')) {
            $data['profile_pic_file'] = $request->file('profile_pic');
        }

        // Determine admin id (works for "admin" guard or default guard)
        $createdBy = $this->getAdminId();

        try {
            $user = $this->service->registerFromAdmin($data, $createdBy);

            return redirect()->route('admin.candidates.create')
                ->with('success', 'Candidate created successfully (ID: ' . $user->id . ').');
        } catch (\Throwable $e) {
            // In production log the exception: \Log::error($e);
            return back()->withInput()->withErrors(['error' => 'Registration failed: ' . $e->getMessage()]);
        }
    }

    /**
     * Get the currently authenticated admin's ID.
     *
     * @return int|null
     */

    protected function getAdminId(): ?int
    {
        // If 'admin' guard configured, prefer that
        $guards = config('auth.guards', []);
        if (is_array($guards) && array_key_exists('admin', $guards)) {
            if (Auth::guard('admin')->check()) {
                return (int) Auth::guard('admin')->id();
            }
        }

        // fallback to the default logged-in user
        if (Auth::check()) {
            return (int) Auth::id();
        }

        return null;
    }


}
