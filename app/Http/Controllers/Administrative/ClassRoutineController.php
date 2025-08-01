<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Models\ClassRoutine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ClassRoutineController extends Controller
{
    public function index()
    {
        return view('administrative.class-routines.index');
    }

    public function data()
    {
        $routines = ClassRoutine::query();

        return DataTables::of($routines)
            ->addIndexColumn()
            ->addColumn('action', function ($routine) {
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<a href="' . route('administrative.class-routines.edit', $routine->id) . '" class="btn btn-sm btn-primary"><i class="ri-edit-line"></i></a>';
                $actions .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteData(' . $routine->id . ')"><i class="ri-delete-bin-line"></i></button>';
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('status', function ($routine) {
                return $routine->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('file', function ($routine) {
                if ($routine->pdf_path) {
                    return '<a href="' . asset('storage/' . $routine->pdf_path) . '" target="_blank" class="btn btn-sm btn-info"><i class="ri-download-line"></i> Download</a>';
                }
                return '<span class="text-muted">No file</span>';
            })
            ->addColumn('published_at', function ($routine) {
                return $routine->published_at ? date('d M Y', strtotime($routine->published_at)) : 'N/A';
            })
            ->rawColumns(['action', 'status', 'file', 'published_at'])
            ->make(true);
    }

    public function create()
    {
        return view('administrative.class-routines.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'published_at' => 'nullable|date',
            'pdf' => 'required|file|mimes:pdf|max:2048',
            'status' => 'nullable|boolean'
        ]);

        if ($request->hasFile('pdf')) {
            $data['pdf_path'] = $request->file('pdf')->store('class-routines', 'public');
        }

        $data['status'] = $request->has('status') ? 1 : 0;

        ClassRoutine::create($data);

        return redirect()->route('administrative.class-routines')->with('success', 'Class routine added successfully.');
    }

    public function edit($id)
    {
        $routine = ClassRoutine::findOrFail($id);
        return view('administrative.class-routines.edit', compact('routine'));
    }

    public function update(Request $request, $id)
    {
        $routine = ClassRoutine::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'published_at' => 'nullable|date',
            'pdf' => 'nullable|file|mimes:pdf|max:2048',
            'status' => 'nullable|boolean'
        ]);

        if ($request->hasFile('pdf')) {
            // Delete old file if exists
            if ($routine->pdf_path) {
                Storage::disk('public')->delete($routine->pdf_path);
            }
            $data['pdf_path'] = $request->file('pdf')->store('class-routines', 'public');
        }

        $data['status'] = $request->has('status') ? 1 : 0;

        $routine->update($data);

        return redirect()->route('administrative.class-routines')->with('success', 'Class routine updated successfully.');
    }

    public function destroy($id)
    {
        $routine = ClassRoutine::findOrFail($id);
        
        if ($routine->pdf_path) {
            Storage::disk('public')->delete($routine->pdf_path);
        }
        
        $routine->delete();

        return 'success';
    }
}
