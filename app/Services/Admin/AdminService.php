<?php

namespace App\Services\Admin;

use App\Models\User;
use App\Models\Package;
use App\Models\ExpressService;

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

    // Package methods
    public function getAllPackages()
    {
        return Package::all();
    }

    public function createPackage(array $data)
    {
        return Package::create($data);
    }

    public function getPackageById($id)
    {
        return Package::findOrFail($id);
    }

    public function updatePackage($id, array $data)
    {
        $package = Package::findOrFail($id);
        $package->update($data);
        return $package;
    }

    public function deletePackage($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return true;
    }

    // Express Service methods
    public function getAllExpressServices()
    {
        return ExpressService::all();
    }

    public function createExpressService(array $data)
    {
        return ExpressService::create($data);
    }

    public function getExpressServiceById($id)
    {
        return ExpressService::findOrFail($id);
    }

    public function updateExpressService($id, array $data)
    {
        $service = ExpressService::findOrFail($id);
        $service->update($data);
        return $service;
    }

    public function deleteExpressService($id)
    {
        $service = ExpressService::findOrFail($id);
        $service->delete();
        return true;
    }
}
