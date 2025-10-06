<?php

namespace App\Services;

use App\Models\Stat;
use App\Models\Hotjob;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsService
{
    /**
     * Record an event for a statable model (morphMany relation expected).
     *
     * @param  mixed        $statable   E.g. Hotjob|Advertisement model instance
     * @param  string       $event      'view'|'apply'|...
     * @param  Request|null $request
     * @param  array        $meta
     * @return bool
     */
    public function record($statable, string $event, Request $request = null, array $meta = []): bool
    {
        if (! $statable || ! method_exists($statable, 'stats')) {
            return false;
        }

        $request = $request ?? request();

        try {
            $statable->stats()->create([
                'event'      => $event,
                'user_id'    => Auth::id(),
                'ip'         => $request->ip(),
                'user_agent' => $request->userAgent(),
                'meta'       => $meta ?: null,
            ]);
            return true;
        } catch (\Throwable $e) {
            // swallow errors; do not break UX
            return false;
        }
    }

    public function getAppliedJobsForUser($user, ?int $perPage = null)
    {
        $userId = is_object($user) ? $user->id : (int) $user;

        $query = Stat::with(['statable', 'statable.company', 'user'])
            ->where('event', 'apply')
            ->where('user_id', $userId)
            ->orderByDesc('created_at');

        return $perPage ? $query->paginate($perPage) : $query->get();
    }


    public function getCompanyAppliedStats($company)
    {
              return Stat::with(['statable', 'user'])
            ->where('event', 'apply')
            ->whereHasMorph(
                'statable',
                [Hotjob::class, Advertisement::class],
                function ($q) use ($company) {
                    $q->where('company_id', $company->id);
                }
            )
            ->latest()
            ->get();
    }




}
