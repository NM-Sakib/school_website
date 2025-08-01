<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Download;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DownloadController extends Controller
{
    public function index()
    {
        return view('administrative.downloads.index');
    }

    public function data()
    {
        $downloads = Download::query();

        return DataTables::of($downloads)
            ->addIndexColumn()
            ->addColumn('action', function ($download) {
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<a href="' . route('administrative.downloads.edit', $download->id) . '" class="btn btn-sm btn-primary"><i class="ri-edit-line"></i></a>';
                $actions .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteData(' . $download->id . ')"><i class="ri-delete-bin-line"></i></button>';
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('status', function ($download) {
                return $download->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('file', function ($download) {
                if ($download->file_path) {
                    return '<a href="' . asset('storage/' . $download->file_path) . '" target="_blank" class="btn btn-sm btn-info"><i class="ri-download-line"></i> Download</a>';
                }
                return '<span class="text-muted">No file</span>';
            })
            ->rawColumns(['action', 'status', 'file'])
            ->make(true);
    }

    public function create()
    {
        return view('administrative.downloads.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'file' => 'required|file|mimes:pdf,doc,docx,xlsx,jpg,jpeg,png|max:2048',
            'status' => 'nullable|boolean'
        ]);

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('downloads', 'public');
        }

        $data['status'] = $request->has('status') ? 1 : 0;

        Download::create($data);

        return redirect()->route('administrative.downloads')->with('success', 'Download file added successfully.');
    }

    public function edit($id)
    {
        $download = Download::findOrFail($id);
        return view('administrative.downloads.edit', compact('download'));
    }

    public function update(Request $request, $id)
    {
        $download = Download::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xlsx,jpg,jpeg,png|max:2048',
            'status' => 'nullable|boolean'
        ]);

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($download->file_path) {
                Storage::disk('public')->delete($download->file_path);
            }
            $data['file_path'] = $request->file('file')->store('downloads', 'public');
        }

        $data['status'] = $request->has('status') ? 1 : 0;

        $download->update($data);

        return redirect()->route('administrative.downloads')->with('success', 'Download file updated successfully.');
    }

    public function destroy($id)
    {
        $download = Download::findOrFail($id);
        
        if ($download->file_path) {
            Storage::disk('public')->delete($download->file_path);
        }
        
        $download->delete();

        return 'success';
    }
}
