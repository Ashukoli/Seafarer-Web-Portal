<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(Request $request)
{
    $query = State::with('country')->orderBy('state_name');

    if ($request->has('country_id') && $request->country_id != '') {
        $query->where('country_id', $request->country_id);
    }

    $states = $query->paginate(10);
    $countries = Country::orderBy('country_name')->get();

    return view('admin.states.index', compact('states', 'countries'));
}

    public function create()
    {
        $countries = Country::orderBy('country_name')->get();
        return view('admin.states.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'state_name' => 'required|string|max:191|unique:states,state_name',
            'sort' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
        ]);

        State::create($data);
        return redirect()->route('admin.states.index')->with('success', 'State added successfully.');
    }

    public function edit(State $state)
    {
        $countries = Country::orderBy('country_name')->get();
        return view('admin.states.edit', compact('state', 'countries'));
    }

    public function update(Request $request, State $state)
    {
        $data = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'state_name' => 'required|string|max:191|unique:states,state_name,' . $state->id,
            'sort' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
        ]);

        $state->update($data);
        return redirect()->route('admin.states.index')->with('success', 'State updated successfully.');
    }

    public function destroy(State $state)
    {
        $state->delete();
        return redirect()->route('admin.states.index')->with('success', 'State deleted.');
    }
}
