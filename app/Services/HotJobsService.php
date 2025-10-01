<?php
// app/Services/Hotjobs/HotjobsService.php
namespace App\Services;

use App\Models\Hotjob;
use App\Models\CandidateResume;
use Illuminate\Support\Collection;
use Carbon\Carbon;


class HotjobsService
{
    public function list($filters = [])
    {
        $query = Hotjob::with(['company', 'rank', 'ship']);

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['company_id'])) {
            $query->where('company_id', $filters['company_id']);
        }

        return $query->orderByDesc('created_at')->paginate(25);
    }

    public function create(array $data)
    {
        return Hotjob::create($data);
    }

    public function update(Hotjob $hotjob, array $data)
    {
        $hotjob->update($data);
        return $hotjob;
    }

    public function validateHotjob(Hotjob $hotjob)
    {
        $hotjob->status = 'active';
        $hotjob->save();
        return $hotjob;
    }

    public function delete($id, $companyId)
    {
        $hotjob = Hotjob::where('id', $id)->where('company_id', $companyId)->firstOrFail();
        return $hotjob->delete();
    }

    public function getForCandidate(int $userId, ?int $rankId = null): Collection
    {
        $resume = CandidateResume::where('user_id', $userId)->first();
        $presentRank = $resume->present_rank ?? null;
        $desiredRank = $rankId ?: $presentRank;

        if (! $desiredRank) {
            return collect();
        }

        $today = Carbon::today()->toDateString();

        return Hotjob::with(['company', 'rank', 'ship'])
            ->where('status', 'active')
            ->where(function ($q) use ($desiredRank) {
                $q->where('rank_id', $desiredRank);
            })
            ->where(function ($q) use ($today) {
                $q->whereNull('expiry_date')->orWhere('expiry_date', '>=', $today);
            })
            ->orderBy('joiningdate', 'asc')
            ->get();
    }

    public function findForCandidateById(int $userId, int $hotjobId)
    {
        $presentRank = CandidateResume::where('user_id', $userId)->value('present_rank');
        if (! $presentRank) {
            return null;
        }

        $today = Carbon::today()->toDateString();

        return Hotjob::with(['company', 'rank', 'ship'])
            ->where('id', $hotjobId)
            ->where('status', 'active')
            ->where('rank_id', $presentRank)
            ->where(function ($q) use ($today) {
                $q->whereNull('expiry_date')->orWhereDate('expiry_date', '>=', $today);
            })
            ->first();
    }
}
