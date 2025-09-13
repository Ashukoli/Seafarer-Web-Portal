<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShipType;
use Illuminate\Http\Request;

class ShipTypeController extends Controller
{
    // index listing
    public function index()
    {
        $shipTypes = ShipType::orderBy('sort', 'asc')->paginate(10);
        return view('admin.shiptypes.index', compact('shipTypes'));
    }

    // show create form
    public function create()
    {
        return view('admin.shiptypes.create');
    }

    // store new shiptype
    public function store(Request $request)
    {
        $data = $request->validate([
            'ship_name' => 'required|string|max:191|unique:ship_types,ship_name',
            'sort' => 'nullable|integer|min:0',
        ], [
            'ship_name.required' => 'Please enter ship name.',
            'ship_name.unique'   => 'A ship type with this name already exists.',
        ]);

        ShipType::create([
            'ship_name' => $data['ship_name'],
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('admin.shiptypes.index')->with('success', 'Ship type created successfully.');
    }

    // show edit form
    public function edit(ShipType $shiptype)
    {
        return view('admin.shiptypes.edit', ['shiptype' => $shiptype]);
    }

    // update existing
    public function update(Request $request, ShipType $shiptype)
    {
        $data = $request->validate([
            'ship_name' => 'required|string|max:191|unique:ship_types,ship_name,' . $shiptype->id,
            'sort' => 'nullable|integer|min:0',
        ], [
            'ship_name.required' => 'Please enter ship name.',
            'ship_name.unique'   => 'A ship type with this name already exists.',
        ]);

        $shiptype->update([
            'ship_name' => $data['ship_name'],
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('admin.shiptypes.index')->with('success', 'Ship type updated successfully.');
    }

    // destroy (soft delete)
    public function destroy(ShipType $shiptype)
    {
        $shiptype->delete();
        return redirect()->route('admin.shiptypes.index')->with('success', 'Ship type deleted.');
    }
}
