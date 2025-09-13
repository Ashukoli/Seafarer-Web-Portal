<?php

namespace App\Services\Candidate;

use App\Models\User;

class CandidateService
{
    /**
     * Return dashboard data array for view().
     */
    public function getDashboardData(int $userId): array
    {
        // Minimal example: expand to fetch actual stats
        return [
            'user' => User::find($userId),
            'appliedCount' => 0,
            'messagesCount' => 0,
            'recentJobs' => [],
        ];
    }

    public function getResume(int $userId)
    {
        // Return resume data structure (replace with actual resume model access)
        return [
            'summary' => '',
            'experience' => [],
            'education' => [],
        ];
    }

    public function setResumeVisibility(int $userId, bool $visible): void
    {
        // implement: update DB flag on user's resume
    }

    public function searchJobs(array $filters)
    {
        // implement search using Job model / repository and return paginator or array
        return [];
    }

    public function getHotJobs()
    {
        // implement retrieval from Job model
        return [];
    }

    public function getExpressServices()
    {
        // return express service catalog
        return [];
    }

    public function getAppliedStatistics(int $userId)
    {
        return [];
    }

    public function getResumeViewStatistics(int $userId)
    {
        return [];
    }

    public function getMessages(int $userId)
    {
        return [];
    }

    public function deleteProfile(int $userId)
    {
        // careful: soft-delete user and related candidate data
        $user = User::find($userId);
        if (! $user) return;
        $user->delete(); // assuming soft-deletes enabled
    }
}
