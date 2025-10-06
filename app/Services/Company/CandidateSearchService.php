<?php
namespace App\Services\Company;

use App\Models\CandidateResume;

class CandidateSearchService
{
    /**
     * Search candidates based on filters.
     */
    public function search(array $filters)
    {
        $query = CandidateResume::with(['user', 'rank', 'shipType']);

        if (!empty($filters['rank'])) {
            $query->where('present_rank', $filters['rank']);
        }
        if (!empty($filters['shipType'])) {
            $query->where('ship_type', $filters['shipType']);
        }
        if (!empty($filters['cocCop'])) {
            $query->where('coc_nationality', $filters['cocCop']);
        }
        // Add more filters as needed...

        // Sorting
        if (!empty($filters['sortBy'])) {
            switch ($filters['sortBy']) {
                case 'experience':
                    $query->orderByDesc('present_rank_exp');
                    break;
                case 'recent':
                case 'updated':
                    $query->orderByDesc('updated_at');
                    break;
                case 'name':
                    // Assuming you want to sort by user's full name
                    $query->join('users', 'candidate_resumes.user_id', '=', 'users.id')
                          ->orderBy('users.first_name')
                          ->select('candidate_resumes.*');
                    break;
                default:
                    $query->orderByDesc('updated_at');
            }
        } else {
            $query->orderByDesc('updated_at');
        }

        return $query->paginate(12);
    }
}
