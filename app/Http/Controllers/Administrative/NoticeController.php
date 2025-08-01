<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class NoticeController extends Controller
{
    public function index()
    {
        return view('administrative.notices.index');
    }

    public function data()
    {
        $notices = Notice::query();

        return DataTables::of($notices)
            ->addIndexColumn()
            ->addColumn('action', function ($notice) {
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<a href="' . route('administrative.notices.edit', $notice->id) . '" class="btn btn-sm btn-primary"><i class="ri-edit-line"></i></a>';
                $actions .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteData(' . $notice->id . ')"><i class="ri-delete-bin-line"></i></button>';
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('status', function ($notice) {
                return $notice->is_published == 1 ? '<span class="badge bg-success">Published</span>' : '<span class="badge bg-warning">Draft</span>';
            })
            ->addColumn('file', function ($notice) {
                if ($notice->file_path) {
                    return '<a href="' . asset('storage/' . $notice->file_path) . '" target="_blank" class="btn btn-sm btn-info"><i class="ri-download-line"></i> Download</a>';
                }
                return '<span class="text-muted">No file</span>';
            })
            ->rawColumns(['action', 'status', 'file'])
            ->make(true);
    }

    public function create()
    {
        return view('administrative.notices.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'is_published' => 'nullable|boolean'
        ]);

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('notices', 'public');
        }

        $data['is_published'] = $request->has('is_published') ? 1 : 0;

        Notice::create($data);

        return redirect()->route('administrative.notices')->with('success', 'Notice added successfully.');
    }

    public function edit($id)
    {
        $notice = Notice::findOrFail($id);
        return view('administrative.notices.edit', compact('notice'));
    }

    public function update(Request $request, $id)
    {
        $notice = Notice::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'is_published' => 'nullable|boolean'
        ]);

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($notice->file_path) {
                Storage::disk('public')->delete($notice->file_path);
            }
            $data['file_path'] = $request->file('file')->store('notices', 'public');
        }

        $data['is_published'] = $request->has('is_published') ? 1 : 0;

        $notice->update($data);

        return redirect()->route('administrative.notices')->with('success', 'Notice updated successfully.');
    }

    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);
        
        if ($notice->file_path) {
            Storage::disk('public')->delete($notice->file_path);
        }
        
        $notice->delete();

        return 'success';
    }
}
