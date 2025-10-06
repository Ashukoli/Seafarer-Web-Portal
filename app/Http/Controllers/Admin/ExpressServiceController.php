<?php
// filepath: app/Http/Controllers/Admin/ExpressServiceController.php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\AdminService;

class ExpressServiceController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        $expressServices = $this->adminService->getAllExpressServices();
        return view('admin.masters.express_services.index', compact('expressServices'));
    }

    public function create()
    {
        return view('admin.masters.express_services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_title' => 'required|string|max:255',
            'description'   => 'nullable|string',
            'amount'        => 'required|numeric|min:0',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'        => 'required|in:active,inactive',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('expressservices', 'public');
        }

        $this->adminService->createExpressService($validated);
        return redirect()->route('admin.expressservices.index')->with('success', 'Express Service created successfully.');
    }

    public function show($id)
    {
        $expressService = $this->adminService->getExpressServiceById($id);
        return view('admin.masters.express_services.show', compact('expressService'));
    }

    public function edit($id)
    {
        $expressService = $this->adminService->getExpressServiceById($id);
        return view('admin.masters.express_services.edit', compact('expressService'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'package_title' => 'required|string|max:255',
            'description'   => 'nullable|string',
            'amount'        => 'required|numeric|min:0',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status'        => 'required|in:active,inactive',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('expressservices', 'public');
        }

        $this->adminService->updateExpressService($id, $validated);
        return redirect()->route('admin.expressservices.index')->with('success', 'Express Service updated successfully.');
    }

    public function destroy($id)
    {
        $this->adminService->deleteExpressService($id);
        return redirect()->route('admin.expressservices.index')->with('success', 'Express Service deleted successfully.');
    }
}