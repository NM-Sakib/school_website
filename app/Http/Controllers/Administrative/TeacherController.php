<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    public function index()
    {
        return view('administrative.teachers.index');
    }

    public function data()
    {
        $teachers = Teacher::query();

        return DataTables::of($teachers)
            ->addIndexColumn()
            ->addColumn('action', function ($teacher) {
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<a href="' . route('administrative.teachers.edit', $teacher->id) . '" class="btn btn-sm btn-primary"><i class="ri-edit-line"></i></a>';
                $actions .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteData(' . $teacher->id . ')"><i class="ri-delete-bin-line"></i></button>';
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('status', function ($teacher) {
                return $teacher->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('image', function ($teacher) {
                if ($teacher->image_path) {
                    return '<img src="' . asset('storage/' . $teacher->image_path) . '" alt="Teacher Image" class="img-thumbnail" style="max-width: 50px;">';
                }
                return '<img src="' . asset('assets/images/dummy_80x80.png') . '" alt="Default Image" class="img-thumbnail" style="max-width: 50px;">';
            })
            ->rawColumns(['action', 'status', 'image'])
            ->make(true);
    }

    public function create()
    {
        return view('administrative.teachers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('teachers', 'public');
        }

        $data['status'] = $request->has('status') ? 1 : 0;

        Teacher::create($data);

        return redirect()->route('administrative.teachers')->with('success', 'Teacher added successfully.');
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('administrative.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($teacher->image_path) {
                Storage::disk('public')->delete($teacher->image_path);
            }
            $data['image_path'] = $request->file('image')->store('teachers', 'public');
        }

        $data['status'] = $request->has('status') ? 1 : 0;

        $teacher->update($data);

        return redirect()->route('administrative.teachers')->with('success', 'Teacher updated successfully.');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        
        if ($teacher->image_path) {
            Storage::disk('public')->delete($teacher->image_path);
        }
        
        $teacher->delete();

        return 'success';
    }
}
