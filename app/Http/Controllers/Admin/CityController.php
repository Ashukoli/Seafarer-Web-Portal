<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('state.country')->orderBy('sort')->paginate(10);
        return view('admin.masters.cities.index', compact('cities'));
    }

    public function create()
    {
        $states = State::with('country')->orderBy('state_name')->get();
        return view('admin.masters.cities.create', compact('states'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'state_id'  => 'required|exists:states,id',
            'city_name' => 'required|string|max:191',
            'sort'      => 'nullable|integer',
            'status'    => 'sometimes|boolean',
        ]);

        City::create($data + ['status' => $request->status ?? 1]);

        return redirect()->route('admin.cities.index')->with('success', 'City added successfully.');
    }

    public function edit(City $city)
    {
        $states = State::with('country')->orderBy('state_name')->get();
        return view('admin.masters.cities.edit', compact('city', 'states'));
    }

    public function update(Request $request, City $city)
    {
        $data = $request->validate([
            'state_id'  => 'required|exists:states,id',
            'city_name' => 'required|string|max:191',
            'sort'      => 'nullable|integer',
            'status'    => 'sometimes|boolean',
        ]);

        $city->update($data + ['status' => $request->status ?? 0]);

        return redirect()->route('admin.cities.index')->with('success', 'City updated successfully.');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('admin.cities.index')->with('success', 'City deleted successfully.');
    }
}
