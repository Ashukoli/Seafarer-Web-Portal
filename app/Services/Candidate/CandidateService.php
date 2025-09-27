<?php

namespace App\Services\Candidate;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\CandidateProfile;
use App\Models\CandidateResume;
use App\Models\SeaServiceDetail;
use App\Models\CandidateDceEndorsement;
use App\Models\CandidateCourseCertificate;
use App\Models\Rank;
use App\Models\ShipType;
use App\Models\State;
use App\Models\City;
use App\Models\DceEndorsement; // master
// use App\Models\CourseAndOtherCertificateMaster as CourseMaster; // adjust if different
use App\Models\CoursesAndOtherCertificateMaster as CourseMaster; // adjust to your actual model name
use App\Models\Country;
use App\Models\MobileCountryCode;

class CandidateService
{
    /**
     * Load data for the edit form.
     * Returns an array of variables expected by the edit blade.
     */
    public function getForEdit(int $userId): array
    {
        $user = User::with([
            'profile',
            'resume',
            'seaServiceDetails',
            'dceEndorsements',
            'courseCertificates'
        ])->findOrFail($userId);

        $states = State::all();
        $cities = City::all();
        $ranks = Rank::all();
        $shiptypes = ShipType::all();
        $dces = DceEndorsement::all();
        $coursesMaster = CourseMaster::all();
        $countries = Country::all();
        $mobileCountryCodes = MobileCountryCode::where('status', 1)->orderBy('country_name')->get(); // <-- Add this line

        return [
            'user' => $user,
            'states' => $states,
            'cities' => $cities,
            'ranks' => $ranks,
            'shiptypes' => $shiptypes,
            'dces' => $dces,
            'coursesMaster' => $coursesMaster,
            'countries' => $countries,
            'mobileCountryCodes' => $mobileCountryCodes, // <-- And this line
        ];
    }

    /**
     * Persist resume update: profile, resume, dce endorsements, courses, sea service.
     *
     * $data is the validated array from the controller.
     */
    public function updateResume(int $userId, array $data): void
    {
        DB::transaction(function () use ($userId, $data) {
            $user = User::findOrFail($userId);

            // ---- CandidateProfile upsert ----
            $profileData = [
                'first_name' => $data['first_name'] ?? null,
                'middle_name' => $data['middle_name'] ?? null,
                'last_name' => $data['last_name'] ?? null,
                'marital_status' => $data['marital_status'] ?? null,
                'dob' => $data['dob'] ?? null,
                'mobile_cc' => $data['mobile_cc'] ?? null,
                'mobile_number' => $data['mobile_number'] ?? null,
                'whatsapp_cc' => $data['whatsapp_cc'] ?? null,
                'whatsapp_number' => $data['whatsapp_number'] ?? null,
                'address' => $data['address'] ?? null,
                'state_id' => $data['state_id'] ?? null,
                'city_id' => $data['city_id'] ?? null,
                'nationality' => $data['nationality'] ?? null,
                'gender' => $data['gender'] ?? null,
            ];

            // handle profile picture
            if (!empty($data['profile_pic_file'])) {
                $file = $data['profile_pic_file'];
                $path = $file->store('candidates/profile_pic', 'public');
                $profileData['profile_pic'] = $path;

                // optional: delete previous pic
                if ($user->profile && $user->profile->profile_pic) {
                    try {
                        Storage::disk('public')->delete($user->profile->profile_pic);
                    } catch (\Throwable $e) {
                        // ignore delete errors
                    }
                }
            }

            if ($user->profile) {
                $user->profile->fill($profileData)->save();
            } else {
                $profileData['user_id'] = $user->id;
                CandidateProfile::create($profileData);
            }

            // ---- CandidateResume upsert ----
            $resumeData = [
                'present_rank' => $data['present_rank'] ?? null,
                'present_rank_exp' => $data['present_rank_exp'] ?? null,
                'post_applied_for' => $data['post_applied_for'] ?? null,
                'date_of_availability' => $data['date_of_availability'] ?? null,
                'indos_number' => $data['indos_number'] ?? null,
                'passport_nationality' => $data['passport_nationality'] ?? null,
                'passport_number' => $data['passport_number'] ?? null,
                'passport_expiry' => $data['passport_expiry'] ?? null,
                'usa_visa' => isset($data['usa_visa']) ? (int)$data['usa_visa'] : null,
                'cdc_nationality' => $data['cdc_nationality'] ?? null,
                'cdc_no' => $data['cdc_no'] ?? null,
                'cdc_expiry' => $data['cdc_expiry'] ?? null,
                'presea_training_type' => $data['presea_training_type'] ?? null,
                'presea_training_issue_date' => $data['presea_training_issue_date'] ?? null,
                'coc_held' => isset($data['coc_held']) ? (int)$data['coc_held'] : null,
                'coc_type' => $data['coc_type'] ?? null,
                'coc_no' => $data['coc_no'] ?? null,
                'coc_date_of_expiry' => $data['coc_date_of_expiry'] ?? null,
                'additional_information' => $data['additional_information'] ?? null,
            ];

            if ($user->resume) {
                $user->resume->fill($resumeData)->save();
            } else {
                $resumeData['user_id'] = $user->id;
                CandidateResume::create($resumeData);
            }

            // ---- Candidate DCE endorsements (replace) ----
            if (isset($data['dce_id']) && is_array($data['dce_id'])) {
                CandidateDceEndorsement::where('user_id', $user->id)->delete();
                foreach ($data['dce_id'] as $idx => $dceId) {
                    if (empty($dceId)) continue;
                    $validity = $data['dce_validity'][$idx] ?? null;
                    CandidateDceEndorsement::create([
                        'user_id' => $user->id,
                        'dce_id' => $dceId,
                        'validity_date' => $validity,
                    ]);
                }
            }

            // ---- Courses certificates (replace) ----
            if (isset($data['courses']) && is_array($data['courses'])) {
                CandidateCourseCertificate::where('user_id', $user->id)->delete();
                foreach ($data['courses'] as $courseId) {
                    if (empty($courseId)) continue;
                    CandidateCourseCertificate::create([
                        'user_id' => $user->id,
                        'course_id' => $courseId,
                    ]);
                }
            }

            // ---- Sea service details (replace) ----
            if (isset($data['sea_service']) && is_array($data['sea_service'])) {
                SeaServiceDetail::where('user_id', $user->id)->delete();
                foreach ($data['sea_service'] as $entry) {
                    $allEmpty = true;
                    foreach (['rank_id','ship_type_id','company_name','ship_name','sign_on','sign_off','grt_value','grt_unit','bhp'] as $k) {
                        if (!empty($entry[$k]) || (isset($entry[$k]) && $entry[$k] === '0')) { $allEmpty = false; break; }
                    }
                    if ($allEmpty) continue;
                    SeaServiceDetail::create([
                        'user_id' => $user->id,
                        'rank_id' => $entry['rank_id'] ?? null,
                        'ship_type_id' => $entry['ship_type_id'] ?? null,
                        'company_name' => $entry['company_name'] ?? null,
                        'ship_name' => $entry['ship_name'] ?? null,
                        'sign_on' => $entry['sign_on'] ?? null,
                        'sign_off' => $entry['sign_off'] ?? null,
                        'grt_value' => isset($entry['grt_value']) ? (int)$entry['grt_value'] : null,
                        'grt_unit' => $entry['grt_unit'] ?? null,
                        'bhp' => isset($entry['bhp']) ? $entry['bhp'] : null,
                    ]);
                }
            }

            // ---- Optionally update profile_completion metric ----
            if ($user->profile) {
                $complete = 0;
                if ($user->profile->first_name) $complete += 10;
                if ($user->profile->last_name) $complete += 10;
                if ($user->profile->mobile_number) $complete += 10;
                if ($user->resume) $complete += 20;
                $user->profile->profile_completion = min(100, $complete);
                $user->profile->save();
            }
        });
    }

    /**
     * Prepare data for show (read-only) view.
     */
    public function getForShow(int $userId): array
    {
        $user = User::with([
            'profile',
            'resume',
            'seaServiceDetails' => function ($q) {
                $q->with(['rank', 'shipType'])->orderByDesc('sign_on');
            },
            'dceEndorsements' => function ($q) {
                $q->with('dce');
            },
            'courseCertificates' => function ($q) {
                $q->with('course');
            }
        ])->findOrFail($userId);

        // compute a duration text for sea services
        $seaServices = $user->seaServiceDetails->map(function ($s) {
            $s->duration_text = '-';
            try {
                if ($s->sign_on && $s->sign_off) {
                    $start = \Illuminate\Support\Carbon::parse($s->sign_on);
                    $end = \Illuminate\Support\Carbon::parse($s->sign_off);
                    $diff = $start->diff($end);
                    $months = $diff->y * 12 + $diff->m;
                    $days = $diff->d;
                    $parts = [];
                    if ($months) $parts[] = $months . 'm';
                    if ($days) $parts[] = $days . 'd';
                    $s->duration_text = $parts ? implode(' ', $parts) : '0d';
                }
            } catch (\Throwable $e) {
                // ignore
            }
            return $s;
        });

        $dceEndorsements = $user->dceEndorsements;
        $courses = $user->courseCertificates->map(function ($cc) {
            return $cc->relationLoaded('course') && $cc->course ? $cc->course : $cc;
        });

        $ranks = Rank::orderBy('rank')->get();
        $shiptypes = ShipType::orderBy('ship_name')->get();
        $states = State::orderBy('state_name')->get();

        $cities = collect();
        if ($user->profile && $user->profile->state_id) {
            $cities = City::where('state_id', $user->profile->state_id)->orderBy('city_name')->get();
        }

        return [
            'user' => $user,
            'profile' => $user->profile,
            'resume' => $user->resume,
            'seaServices' => $seaServices,
            'dceEndorsements' => $dceEndorsements,
            'courses' => $courses,
            'ranks' => $ranks,
            'shiptypes' => $shiptypes,
            'states' => $states,
            'cities' => $cities,
        ];
    }


    public function paginateCandidates(int $perPage = 20, array $filters = [], array $with = [])
    {
        $query = User::query()->where('user_type', 'candidate');

        // Apply filters if provided
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Eager load relations if provided
        if (!empty($with)) {
            $query->with($with);
        }

        return $query->orderByDesc('id')->paginate($perPage);
    }

    /**
     * Find a candidate by user ID with all related profile/resume data.
     *
     * @param int $userId
     * @param array $with
     * @return User|null
     */
    public function findCandidateWithRelations(int $userId, array $with = [])
    {
        $query = User::where('id', $userId)->where('user_type', 'candidate');

        if (!empty($with)) {
            $query->with($with);
        } else {
            // Default relations
            $query->with([
                'candidateProfile',
                'candidateResume',
                'candidateProfile.state',
                'candidateProfile.city',
            ]);
        }

        return $query->first();
    }
}
