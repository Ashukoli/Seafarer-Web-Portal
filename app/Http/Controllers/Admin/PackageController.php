<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\AdminService;

class PackageController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Display a listing of all packages.
     */
    public function index()
    {
        $packages = $this->adminService->getAllPackages();
        return view('admin.masters.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new package.
     */
    public function create()
    {
        return view('admin.masters.packages.create');
    }

    /**
     * Store a newly created package.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_name' => 'required|string|max:255',
            'package_count' => 'required|integer',
            'status' => 'required|in:active,inactive',
        ]);

        $this->adminService->createPackage($validated);
        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified package.
     */
    public function show($id)
    {
        $package = $this->adminService->getPackageById($id);
        return view('admin.masters.packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified package.
     */
    public function edit($id)
    {
        $package = $this->adminService->getPackageById($id);
        return view('admin.masters.packages.edit', compact('package'));
    }

    /**
     * Update the specified package.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'package_name' => 'sometimes|required|string|max:255',
            'package_count' => 'sometimes|required|integer',
            'status' => 'sometimes|required|in:active,inactive',
        ]);

        $this->adminService->updatePackage($id, $validated);
        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified package.
     */
    public function destroy($id)
    {
        $this->adminService->deletePackage($id);
        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }
}
