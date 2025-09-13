<?php

namespace App\Services\Admin;

use App\Models\User;

class AdminService
{
    /**
     * Return basic stats for admin dashboard.
     */
    public function getDashboardStats(): array
    {
        return [
            'totalCandidates' => User::where('user_type', 'candidate')->count(),
            'totalCompanies'  => User::where('user_type', 'company')->count(),
            'totalAdmins'     => User::where('user_type', 'admin')->count(),
        ];
    }
}
