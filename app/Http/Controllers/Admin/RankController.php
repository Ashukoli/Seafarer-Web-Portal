<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rank;
use Illuminate\Http\Request;

class RankController extends Controller
{
    // Show all ranks
    public function index()
    {
        $ranks = Rank::orderBy('sort')->paginate(10);
        return view('admin.ranks.index', compact('ranks'));
    }

    // Show create form
    public function create()
    {
        return view('admin.ranks.create');
    }

    // Store new rank
    public function store(Request $request)
    {
        $request->validate([
            'rank' => 'required|string|max:255',
            'sort' => 'nullable|integer',
        ]);

        Rank::create($request->only('rank', 'sort'));

        return redirect()->route('admin.ranks.index')->with('status', 'Rank created successfully.');
    }

    // Show edit form
    public function edit(Rank $rank)
    {
        return view('admin.ranks.edit', compact('rank'));
    }

    // Update rank
    public function update(Request $request, Rank $rank)
    {
        $request->validate([
            'rank' => 'required|string|max:255',
            'sort' => 'nullable|integer',
        ]);

        $rank->update($request->only('rank', 'sort'));

        return redirect()->route('admin.ranks.index')->with('status', 'Rank updated successfully.');
    }

    // Delete rank
    public function destroy(Rank $rank)
    {
        $rank->delete();
        return redirect()->route('admin.ranks.index')->with('status', 'Rank deleted successfully.');
    }
}
