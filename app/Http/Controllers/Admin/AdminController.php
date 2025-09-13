<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;

class AdminController extends Controller
{
    protected AdminService $service;

    public function __construct(AdminService $service)
    {
        $this->service = $service;

        // Protect all admin routes with admin guard
        $this->middleware('auth'); // or 'auth:admin' if using custom guard
    }

    public function dashboard()
    {
        // Example: fetch stats from service
        $stats = $this->service->getDashboardStats();

        return view('admin.dashboard', compact('stats'));
    }
}
