<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MobileCountryCode;
use Illuminate\Http\Request;

class MobileCountryCodeController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $query = MobileCountryCode::query();

        if ($q) {
            $query->where(function ($qWhere) use ($q) {
                $qWhere->where('country_name', 'like', "%{$q}%")
                       ->orWhere('dial_code', 'like', "%{$q}%")
                       ->orWhere('country_code', 'like', "%{$q}%");
            });
        }

        $codes = $query->orderBy('country_name')->paginate(20)->withQueryString();

        return view('admin.mobile-country-codes.index', compact('codes', 'q'));
    }

    public function create()
    {
        return view('admin.mobile-country-codes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'country_name' => 'required|string|max:191',
            'country_code' => 'nullable|string|max:10',
            'dial_code'    => 'required|string|max:20',
            'status'       => 'sometimes|in:0,1',
        ]);

        $data['status'] = $data['status'] ?? 1;

        MobileCountryCode::create($data);

        return redirect()->route('admin.mobile-country-codes.index')->with('success', 'Created successfully.');
    }

    // NOTE: important — parameter name matches the resource route: {mobile_country_code}
    public function edit(MobileCountryCode $mobile_country_code)
    {
        // pass to view as $code for convenience
        $code = $mobile_country_code;
        return view('admin.mobile-country-codes.edit', compact('code'));
    }

    public function update(Request $request, MobileCountryCode $mobile_country_code)
    {
        $data = $request->validate([
            'country_name' => 'required|string|max:191',
            'country_code' => 'nullable|string|max:10',
            'dial_code'    => 'required|string|max:20',
            'status'       => 'sometimes|in:0,1',
        ]);

        $data['status'] = $data['status'] ?? 0;

        $mobile_country_code->update($data);

        return redirect()->route('admin.mobile-country-codes.index')->with('success', 'Updated successfully.');
    }

    public function destroy(MobileCountryCode $mobile_country_code)
    {
        $mobile_country_code->delete();

        return redirect()->route('admin.mobile-country-codes.index')->with('success', 'Deleted successfully.');
    }
}
