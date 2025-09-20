<?php

namespace App\Services\Candidate;

use App\Models\User;
use App\Models\CandidateProfile;
use App\Models\CandidateResume;
use App\Models\CandidateCourseCertificate;
use App\Models\CandidateDceEndorsement;
use App\Models\SeaServiceDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class CandidateRegistrationService
{
    public function registerFromAdmin(array $data, ?int $createdBy = null): User
    {
        $data['user_type'] = $data['user_type'] ?? 'candidate';
        $data['created_by_admin_id'] = $createdBy;

        return $this->createCandidate($data);
    }

    public function registerFromFrontend(array $data): User
    {
        $data['user_type'] = $data['user_type'] ?? 'candidate';
        return $this->createCandidate($data);
    }

    protected function createCandidate(array $data): User
{
    return DB::transaction(function () use ($data) {
        $password = $data['password'] ?? Str::random(10);

        $user = User::create([
            'name' => trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '')),
            'email' => $data['email'] ?? null,
            'password' => Hash::make($password),
            'user_type' => $data['user_type'] ?? 'candidate',
            'status' => $data['status'] ?? 'active',
            'remember_token' => Str::random(60),
            'created_by' => $data['created_by_admin_id'] ?? null,
        ]);

        $nationality = $data['nationality'] ?? ($data['passport_nationality'] ?? 'IN');

        $profile = CandidateProfile::create([
            'user_id' => $user->id,
            'seafarer_id' => $data['seafarer_id'] ?? null,
            'first_name' => $data['first_name'] ?? null,
            'middle_name' => $data['middle_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'marital_status' => $data['marital_status'] ?? null,
            'dob' => $data['dob'] ?? null,
            'mobile_cc' => $data['mobile_cc'] ?? null,
            'mobile_number' => $data['mobile_number'] ?? null,
            'whatsapp_cc' => $data['whatsapp_cc'] ?? $data['mobile_cc'] ?? null,
            'whatsapp_number' => $data['whatsapp_number'] ?? null,
            'address' => $data['address'] ?? null,
            'gender' => $data['gender'] ?? null,
            'nationality' => $nationality,
            'state_id' => $data['state_id'] ?? null,
            'city_id' => $data['city_id'] ?? null,
        ]);

        // -------- profile pic: save to public/theme/assets/profile_pics ----------
        if (!empty($data['profile_pic_file']) && $data['profile_pic_file'] instanceof \Illuminate\Http\UploadedFile) {
            try {
                $uploadDir = public_path('theme/assets/profile_pics');
                if (!file_exists($uploadDir)) {
                    // create directory recursively and set permissions
                    mkdir($uploadDir, 0755, true);
                }

                // generate unique filename
                $filename = time() . '_' . \Illuminate\Support\Str::slug(pathinfo($data['profile_pic_file']->getClientOriginalName(), PATHINFO_FILENAME))
                            . '.' . $data['profile_pic_file']->getClientOriginalExtension();

                // move the uploaded file to public/theme/assets/profile_pics
                $data['profile_pic_file']->move($uploadDir, $filename);

                // set the profile picture path relative to public/
                $profile->profile_pic = 'theme/assets/profile_pics/' . $filename;
                $profile->save();
            } catch (\Throwable $e) {
                // log but don't fail the whole transaction — you may want to surface this later
                Log::error('Profile pic upload failed: ' . $e->getMessage());
            }
        }

        // resume
        $resume = CandidateResume::create([
            'user_id' => $user->id,
            'present_rank' => $data['present_rank'] ?? null,
            'present_rank_exp' => $data['present_rank_exp'] ?? null,
            'post_applied_for' => $data['post_applied_for'] ?? null,
            'date_of_availability' => $data['date_of_availability'] ?? null,
            'indos_number' => $data['indos_number'] ?? null,
            'passport_nationality' => $data['passport_nationality'] ?? null,
            'passport_number' => $data['passport_number'] ?? null,
            'passport_expiry' => $data['passport_expiry'] ?? null,
            'usa_visa' => $data['usa_visa'] ?? null,
            'cdc_nationality' => $data['cdc_nationality'] ?? null,
            'cdc_no' => $data['cdc_no'] ?? null,
            'cdc_expiry' => $data['cdc_expiry'] ?? null,
            'presea_training_type' => $data['presea_training_type'] ?? null,
            'presea_training_issue_date' => $data['presea_training_issue_date'] ?? null,
            'coc_held' => $data['coc_held'] ?? null,
            'coc_no' => $data['coc_no'] ?? null,
            'coc_type' => $data['coc_type'] ?? null,
            'coc_date_of_expiry' => $data['coc_date_of_expiry'] ?? null,
            'additional_information' => $data['additional_information'] ?? null,
        ]);

        // courses
        if (!empty($data['courses']) && is_array($data['courses'])) {
            foreach ($data['courses'] as $courseId) {
                if (empty($courseId)) continue;
                CandidateCourseCertificate::create([
                    'user_id' => $user->id,
                    'course_id' => $courseId,
                ]);
            }
        }

        // dce
        if (!empty($data['dce_id']) && is_array($data['dce_id'])) {
            $validities = $data['dce_validity'] ?? [];
            foreach ($data['dce_id'] as $idx => $dceId) {
                if (empty($dceId)) continue;
                CandidateDceEndorsement::create([
                    'user_id' => $user->id,
                    'dce_id' => $dceId,
                    'validity_date' => $validities[$idx] ?? null,
                ]);
            }
        }

        // sea service
        if (!empty($data['sea_service']) && is_array($data['sea_service'])) {
            foreach ($data['sea_service'] as $entry) {
                SeaServiceDetail::create([
                    'user_id'      => $user->id,
                    'rank_id'      => $entry['rank_id'] ?? null,
                    'ship_type_id' => $entry['ship_type_id'] ?? null,
                    'sign_on'      => $entry['sign_on'] ?? null,
                    'sign_off'     => $entry['sign_off'] ?? null,
                    'company_name' => $entry['company_name'] ?? null,
                    'ship_name'    => $entry['ship_name'] ?? null,

                    // save tonnage values properly
                       // legacy input, plain numeric
                    'grt_unit'  => $entry['grt_unit'] ?? null,     // "GRT" or "DWT" from dropdown
                    'grt_value' => $entry['grt_value'] ?? null,    // numeric value if separated
                    'bhp'       => $entry['bhp'] ?? null,
                ]);
            }
        }

        // update profile completion
        $this->updateProfileCompletion($profile, $resume);

        return $user;
    });
}


    protected function updateProfileCompletion(CandidateProfile $profile, CandidateResume $resume): void
    {
        $steps = [
            'personal' => 0,
            'profile' => 0,
            'documents' => 0,
            'presea' => 0,
            'gmdss' => 0,
            'courses' => 0,
            'sea_service' => 0,
            'additional' => 0,
        ];

        $personalCount = 0;
        if ($profile->first_name) $personalCount++;
        if ($profile->last_name) $personalCount++;
        if ($profile->mobile_number) $personalCount++;
        if ($profile->dob) $personalCount++;
        $steps['personal'] = ($personalCount >= 3) ? 1 : 0;

        $steps['profile'] = ($resume->present_rank && $resume->present_rank_exp) ? 1 : 0;
        $steps['documents'] = ($resume->passport_number && $resume->passport_expiry) ? 1 : 0;
        $steps['presea'] = $resume->presea_training_type ? 1 : 0;

        $hasDce = CandidateDceEndorsement::where('user_id', $profile->user_id)->exists();
        $steps['gmdss'] = $hasDce ? 1 : 0;

        $hasCourse = CandidateCourseCertificate::where('user_id', $profile->user_id)->exists();
        $steps['courses'] = $hasCourse ? 1 : 0;

        $hasSea = SeaServiceDetail::where('user_id', $profile->user_id)->exists();
        $steps['sea_service'] = $hasSea ? 1 : 0;

        $steps['additional'] = $resume->additional_information ? 1 : 0;

        $completed = array_sum($steps);
        $percent = (int) round(($completed / count($steps)) * 100);

        $profile->completion_steps = $steps;
        $profile->profile_completion = $percent;
        $profile->save();
    }
}
