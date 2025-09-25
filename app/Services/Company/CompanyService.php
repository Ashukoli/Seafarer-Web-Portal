<?php

namespace App\Services\Company;

use App\Models\CompanyDetail;
use App\Models\Banner;
use App\Models\Advertisement;
use App\Models\AdvertisementRank;
use App\Models\User;
use App\Models\CompanySubadmin;
use App\Models\CompanyFollowUp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class CompanyService
{
    /**
     * Return paginated companies.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllCompanies(int $perPage = 20)
    {
        return CompanyDetail::orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Get company by id.
     *
     * @param int $id
     * @return CompanyDetail
     */
    public function getCompanyById($id): CompanyDetail
    {
        return CompanyDetail::findOrFail($id);
    }

    /**
     * Update company and related data.
     *
     * @param int $id
     * @param array $data
     * @param \Illuminate\Http\Request $request
     * @return CompanyDetail
     */
    public function updateCompanyWithRelations(int $id, array $data): CompanyDetail
    {
        return DB::transaction(function () use ($id, $data) {
            $company = CompanyDetail::findOrFail($id);

            // Convert rpsl_expiry to Y-m-d
            if (!empty($data['rpsl_expiry'])) {
                try {
                    $data['rpsl_expiry'] = Carbon::createFromFormat('d-m-Y', $data['rpsl_expiry'])->format('Y-m-d');
                } catch (\Exception $e) {
                    $data['rpsl_expiry'] = null;
                }
            }

            // Map form fields to DB columns
            $data['resume_view_package_id'] = $data['resumes_view_per_day'] ?? null;
            $data['resume_download_package_id'] = $data['resumes_download_per_day'] ?? null;
            $data['hotjobs_package_id'] = $data['hotjobs_per_day'] ?? null;
            unset($data['resumes_view_per_day'], $data['resumes_download_per_day'], $data['hotjobs_per_day']);

            // Only update company_logo if present
            if (empty($data['company_logo'])) {
                unset($data['company_logo']);
            }

            $company->fill($data);
            $company->save();

            // --- Banner ---
            $banner = Banner::where('company_id', $id)->first();
            if ($banner) {
                $banner->update([
                    'image' => $data['banner_image'] ?? $banner->image,
                    'section' => $data['banner_section'] ?? $banner->section,
                    'order' => $data['banner_order'] ?? $banner->order,
                    'status' => $data['banner_status'] ?? $banner->status,
                ]);
            } elseif (!empty($data['banner_image'])) {
                Banner::create([
                    'company_id' => $id,
                    'image' => $data['banner_image'],
                    'section' => $data['banner_section'] ?? null,
                    'order' => $data['banner_order'] ?? null,
                    'status' => $data['banner_status'] ?? null,
                ]);
            }

            // --- Advertisement ---
            $advertisement = Advertisement::where('company_id', $id)->first();
            $postedDate = $data['advertisement_posted_date'] ?? null;
            if ($postedDate) {
                try {
                    $postedDate = Carbon::createFromFormat('d-m-Y', $postedDate)->format('Y-m-d');
                } catch (\Exception $e) {
                    $postedDate = null;
                }
            }

            if ($advertisement) {
                $advertisement->update([
                    'description' => $data['advertisement_description'] ?? $advertisement->description,
                    'posted_date' => $postedDate ?? $advertisement->posted_date,
                    'subject' => $data['advertisement_subject'] ?? $advertisement->subject,
                    'advertisement_type' => $data['advertisement_type'] ?? $advertisement->advertisement_type,
                ]);
                AdvertisementRank::where('advertisement_id', $advertisement->id)->delete();
            } elseif (!empty($data['advertisement_subject'])) {
                $advertisement = Advertisement::create([
                    'company_id' => $id,
                    'description' => $data['advertisement_description'] ?? null,
                    'posted_date' => $postedDate,
                    'subject' => $data['advertisement_subject'],
                    'advertisement_type' => $data['advertisement_type'] ?? 'fixed',
                ]);
            }

            // --- Advertisement Ranks ---
            // Always ensure $advertisement is set before this block
            if (isset($advertisement) && !empty($data['advertisement_shiptypes'])) {
                foreach ($data['advertisement_shiptypes'] as $shiptypeData) {
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

            return $company;
        });
    }

    /**
     * Delete company (uses transaction).
     *
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deleteCompany(int $id)
    {
        return DB::transaction(function () use ($id) {
            $company = CompanyDetail::findOrFail($id);

            // Optionally delete related records and files
            if (!empty($company->company_logo) && file_exists(public_path('theme/assets/images/company_logo/' . $company->company_logo))) {
                @unlink(public_path('theme/assets/images/company_logo/' . $company->company_logo));
            }

            return $company->delete();
        });
    }

    /**
     * Update or create superadmin for the company.
     *
     * @param CompanyDetail $company
     * @param array $data
     * @return User
     */
    public function updateOrCreateSuperadmin(CompanyDetail $company, array $data)
    {
        $superadmin = $company->superadmin;

        $userData = [
            'username'      => $data['superadmin_username'],
            'first_name'    => $data['superadmin_name'],
            'designation'   => $data['superadmin_designation'],
            'email'         => $data['superadmin_email'],
            'country_code'  => $data['superadmin_country_code'],
            'mobile'        => $data['superadmin_mobile'],
            'status'        => 'active',
        ];

        if (!empty($data['superadmin_password'])) {
            $userData['password'] = Hash::make($data['superadmin_password']);
        }

        if ($superadmin) {
            $superadmin->update($userData);
        } else {
            $userData['user_type'] = 'company';
            $userData['role'] = 'super_admin';
            $superadmin = User::create($userData);
            $company->user_id = $superadmin->id;
            $company->save();
        }

        return $superadmin;
    }

    /**
     * Update subadmins for the company.
     *
     * @param CompanyDetail $company
     * @param array $subadmins
     * @return void
     */
    public function updateSubadmins(CompanyDetail $company, array $subadmins)
    {
        // Get current subadmin IDs from the request
        $submittedIds = collect($subadmins)
            ->pluck('id')
            ->filter()
            ->toArray();

        // Get existing subadmin user IDs for this company
        $existingSubadmins = CompanySubadmin::where('company_id', $company->id)->get();
        $existingIds = $existingSubadmins->pluck('user_id')->toArray();

        // Find IDs to delete (existing but not submitted)
        $idsToDelete = array_diff($existingIds, $submittedIds);

        // Delete removed subadmins
        if (!empty($idsToDelete)) {
            CompanySubadmin::where('company_id', $company->id)
                ->whereIn('user_id', $idsToDelete)
                ->delete();

            User::whereIn('id', $idsToDelete)->delete();
        }

        // Update/Create subadmins
        foreach ($subadmins as $subadmin) {
            if (!empty($subadmin['id'])) {
                // Update existing subadmin
                $user = User::find($subadmin['id']);
                if ($user) {
                    $user->username = $subadmin['username'];
                    $user->first_name = $subadmin['name'];
                    $user->email = $subadmin['email'] ?? null;
                    $user->country_code = $subadmin['country_code'];
                    $user->mobile = $subadmin['mobile'];
                    $user->designation = $subadmin['designation'];
                    if (!empty($subadmin['password'])) {
                        $user->password = Hash::make($subadmin['password']);
                    }
                    $user->save();

                    // Ensure CompanySubadmin exists (only company_id and user_id)
                    CompanySubadmin::updateOrCreate(
                        [
                            'company_id' => $company->id,
                            'user_id' => $user->id,
                        ],
                        [] // No additional fields
                    );
                }
            } else {
                // Create new subadmin
                $user = User::create([
                    'user_type' => 'company',
                    'role' => 'subadmin',
                    'username' => $subadmin['username'],
                    'first_name' => $subadmin['name'],
                    'email' => $subadmin['email'] ?? null,
                    'country_code' => $subadmin['country_code'],
                    'mobile' => $subadmin['mobile'],
                    'designation' => $subadmin['designation'],
                    'password' => Hash::make($subadmin['password']),
                    'status' => 'active',
                ]);
                if ($user) {
                    CompanySubadmin::create([
                        'company_id' => $company->id,
                        'user_id' => $user->id,
                    ]);
                }
            }
        }
    }

    /**
     * Get all follow-ups for companies.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllFollowUps($perPage = 25)
    {
        return CompanyFollowUp::with('company')->orderByDesc('id')->paginate($perPage);
    }

    /**
     * Create a new follow-up.
     *
     * @param array $data
     * @return CompanyFollowUp
     */
    public function createFollowUp(array $data)
    {
        return CompanyFollowUp::create($data);
    }

    // List today's and upcoming follow-ups
    public function getFollowUpsForTodayAndUpcoming($perPage = 25)
    {
        $today = now()->toDateString();

        // Subquery to get the latest followup id for each company
        $latestFollowupIds = CompanyFollowUp::selectRaw('MAX(id) as id')
            ->groupBy('company_id');

        return CompanyFollowUp::with('company')
            ->whereIn('id', $latestFollowupIds)
            ->orderByDesc('next_follow_up_date')
            ->orderByDesc('follow_up_date')
            ->paginate($perPage);
    }

    public function getAllBanners($filters = [])
    {
        $query = Banner::with('company')->orderBy('order');
        if (!empty($filters['company'])) {
            $query->whereHas('company', function($q) use ($filters) {
                $q->where('company_name', 'like', '%' . $filters['company'] . '%');
            });
        }
        if (!empty($filters['section'])) {
            $query->where('section', $filters['section']);
        }
        return $query->get();
     }

    public function getSubadmins($companyId)
    {
        // Get all user_ids for this company from the pivot table
        $userIds = CompanySubadmin::where('company_id', $companyId)->pluck('user_id');

        // Fetch user details for those user_ids from the users table
        return User::whereIn('id', $userIds)
            ->where('role', 'subadmin')
            ->get();
    }
}
