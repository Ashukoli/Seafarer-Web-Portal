<?php
namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Advertisement;
use App\Models\CandidateResume;
use App\Models\Hotjob;
use Illuminate\Contracts\Auth\Authenticatable;

class AdvertisementMatchingService
{
    /**
     * Return banner ads and hotjobs matching the candidate's resume ranks.
     *
     * @param  Authenticatable|null  $user
     * @return array{bannerAds: \Illuminate\Support\Collection, hotJobs: \Illuminate\Support\Collection}
     */
    public function matchForCandidate(?Authenticatable $user): array
    {
        $bannerAds = collect();
        $hotJobs = collect();

        if (! $user) {
            return compact('bannerAds', 'hotJobs');
        }

        $resume = CandidateResume::where('user_id', $user->getAuthIdentifier())->first();
        if (! $resume) {
            return compact('bannerAds', 'hotJobs');
        }

        // gather rank ids to match against
        $rankIds = array_filter([
            $resume->present_rank ? (int)$resume->present_rank : null,
            $resume->post_applied_for ? (int)$resume->post_applied_for : null,
        ]);

        $rankIds = array_values(array_unique($rankIds));

        if (empty($rankIds)) {
            return compact('bannerAds', 'hotJobs');
        }

        // 1) Match advertisements via pivot table advertisement_ranks
        $adIds = DB::table('advertisement_ranks')
            ->whereIn('rank_id', $rankIds)
            ->pluck('advertisement_id')
            ->unique()
            ->toArray();

        if (! empty($adIds)) {
            $query = Advertisement::whereIn('id', $adIds);

            // safe ordering: use priority if column exists, otherwise fallback to id
            if (Schema::hasColumn('company_advertisements', 'priority')) {
                $query = $query->orderByDesc('priority');
            } else {
                $query = $query->orderByDesc('id');
            }

            $bannerAds = $query->get();
        }

        // 2) Match hotjobs directly by rank_id
        $hotJobs = Hotjob::whereIn('rank_id', $rankIds)
            ->where(function($q){
                // optional: ensure job not expired / status check
                $q->whereNull('expiry_date')->orWhere('expiry_date', '>=', now());
            })
            ->get();

        return compact('bannerAds', 'hotJobs');
    }
}
