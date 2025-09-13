<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('sort')->paginate(20);
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'country_name' => 'required|string|max:191|unique:countries,country_name',
            'country_code' => 'nullable|string|max:10',
            'sort' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
        ]);

        Country::create($data);
        return redirect()->route('admin.countries.index')->with('success', 'Country added successfully.');
    }

    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $data = $request->validate([
            'country_name' => 'required|string|max:191|unique:countries,country_name,' . $country->id,
            'country_code' => 'nullable|string|max:10',
            'sort' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $country->update($data);
        return redirect()->route('admin.countries.index')->with('success', 'Country updated successfully.');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('admin.countries.index')->with('success', 'Country deleted.');
    }
}
