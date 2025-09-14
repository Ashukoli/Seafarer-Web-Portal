<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCertificate;
use Illuminate\Http\Request;

class CourseCertificateController extends Controller
{
    // show paginated list
    public function index(Request $request)
    {
        $q = $request->query('q');
        $perPage = 15;

        $query = CourseCertificate::query()->ordered();

        if ($q) {
            $query->where('name', 'like', '%' . $q . '%');
        }

        $items = $query->paginate($perPage)->withQueryString();

        return view('admin.masters.course_certificates.index', ['items' => $items, 'q' => $q]);
    }

    public function create()
    {
        return view('admin.masters.course_certificates.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'sort' => 'nullable|integer',
        ]);

        CourseCertificate::create([
            'name' => $data['name'],
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('admin.course-certificates.index')->with('success', 'Course / Certificate added.');
    }

    public function edit(CourseCertificate $course_certificate)
    {
        return view('admin.masters.course_certificates.edit', ['item' => $course_certificate]);
    }

    public function update(Request $request, CourseCertificate $course_certificate)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'sort' => 'nullable|integer',
        ]);

        $course_certificate->update([
            'name' => $data['name'],
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('admin.course-certificates.index')->with('success', 'Updated successfully.');
    }

    public function destroy(CourseCertificate $course_certificate)
    {
        $course_certificate->delete();
        return redirect()->route('admin.course-certificates.index')->with('success', 'Deleted successfully.');
    }
}
