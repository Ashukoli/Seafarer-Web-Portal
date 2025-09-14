<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DceEndorsement;
use Illuminate\Http\Request;

class DceEndorsementController extends Controller
{
    public function index()
    {
        $endorsements = DceEndorsement::orderBy('sort')->paginate(10);
        return view('admin.masters.dce_endorsements.index', compact('endorsements'));
    }

    public function create()
    {
        return view('admin.masters.dce_endorsements.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dce_name' => 'required|string|max:191',
            'sort'     => 'nullable|integer'
        ]);

        DceEndorsement::create($data);
        return redirect()->route('admin.dce-endorsements.index')->with('success', 'DCE Endorsement added.');
    }

    public function edit(DceEndorsement $dce_endorsement)
    {
        return view('admin.masters.dce_endorsements.edit', compact('dce_endorsement'));
    }

    public function update(Request $request, DceEndorsement $dce_endorsement)
    {
        $data = $request->validate([
            'dce_name' => 'required|string|max:191',
            'sort'     => 'nullable|integer'
        ]);

        $dce_endorsement->update($data);
        return redirect()->route('admin.dce-endorsements.index')->with('success', 'Updated successfully.');
    }

    public function destroy(DceEndorsement $dce_endorsement)
    {
        $dce_endorsement->delete();
        return redirect()->route('admin.dce-endorsements.index')->with('success', 'Deleted successfully.');
    }
}
