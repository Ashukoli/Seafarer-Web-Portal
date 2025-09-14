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
use Carbon\Carbon;
use Exception;

class CandidateRegistrationService
{
    /**
     * Register a candidate from admin panel.
     *
     * @param array $data
     * @param int|null $createdBy
     * @return \App\Models\User
     * @throws \Throwable
     */
    public function registerFromAdmin(array $data, ?int $createdBy = null): User
    {
        $data['user_type'] = $data['user_type'] ?? 'candidate';
        $data['created_by_admin_id'] = $createdBy;

        return $this->createCandidate($data);
    }

    /**
     * Register from frontend (re-usable).
     */
    public function registerFromFrontend(array $data): User
    {
        $data['user_type'] = $data['user_type'] ?? 'candidate';
        return $this->createCandidate($data);
    }

    /**
     * Core creation method in a transaction.
     *
     * @param array $data
     * @return User
     */
    protected function createCandidate(array $data): User
    {
        return DB::transaction(function () use ($data) {

            // create user
            $password = $data['password'] ?? Str::random(10);

            $user = User::create([
                'name' => trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '')),
                'email' => $data['email'],
                'password' => Hash::make($password),
                'user_type' => $data['user_type'] ?? 'candidate',
                'status' => $data['status'] ?? 'active',
                'remember_token' => Str::random(60),
            ]);

            // profile
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
                'whatsapp_cc' => $data['whatsapp_cc'] ?? null,
                'whatsapp_number' => $data['whatsapp_number'] ?? null,
                'address' => $data['address'] ?? null,
                'gender' => $data['gender'] ?? null,
                'nationality' => $data['nationality'] ?? null,
                'state_id' => $data['state_id'] ?? null,
                'city_id' => $data['city_id'] ?? null,
            ]);

            // handle profile pic upload
            if (!empty($data['profile_pic_file']) && $data['profile_pic_file'] instanceof UploadedFile) {
                $path = $data['profile_pic_file']->store('profile_pics', 'public');
                $profile->profile_pic = $path;
                $profile->save();
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

            // courses (array of master ids)
            if (!empty($data['courses']) && is_array($data['courses'])) {
                foreach ($data['courses'] as $courseId) {
                    if (empty($courseId)) continue;
                    CandidateCourseCertificate::create([
                        'user_id' => $user->id,
                        'course_id' => $courseId,
                    ]);
                }
            }

            // DCE endorsements
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

            // sea service details (array of assoc arrays)
            if (!empty($data['sea_service']) && is_array($data['sea_service'])) {
                foreach ($data['sea_service'] as $entry) {
                    // normalize dates if present
                    $signOn = $entry['sign_on'] ?? null;
                    $signOff = $entry['sign_off'] ?? null;

                    SeaServiceDetail::create([
                        'user_id' => $user->id,
                        'rank_id' => $entry['rank_id'] ?? null,
                        'ship_type_id' => $entry['ship_type_id'] ?? null,
                        'sign_on' => $signOn,
                        'sign_off' => $signOff,
                        'company_name' => $entry['company_name'] ?? null,
                        'ship_name' => $entry['ship_name'] ?? null,
                        'grt' => $entry['grt'] ?? null,
                        'bhp' => $entry['bhp'] ?? null,
                        'tonnage' => $entry['tonnage'] ?? null,
                    ]);
                }
            }

            // update profile completion
            $this->updateProfileCompletion($profile, $resume);

            return $user;
        });
    }

    /**
     * Compute profile completion and save on CandidateProfile
     *
     * @param \App\Models\CandidateProfile $profile
     * @param \App\Models\CandidateResume $resume
     * @return void
     */
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
