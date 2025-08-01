<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    public function index()
    {
        return view('administrative.gallery.index');
    }

    public function data()
    {
        $gallery = Gallery::query();

        return DataTables::of($gallery)
            ->addIndexColumn()
            ->addColumn('action', function ($gallery) {
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<a href="' . route('administrative.gallery.edit', $gallery->id) . '" class="btn btn-sm btn-primary"><i class="ri-edit-line"></i></a>';
                $actions .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteData(' . $gallery->id . ')"><i class="ri-delete-bin-line"></i></button>';
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('status', function ($gallery) {
                return $gallery->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('image', function ($gallery) {
                if ($gallery->image_path) {
                    return '<img src="' . asset('storage/' . $gallery->image_path) . '" alt="Gallery Image" class="img-thumbnail" style="max-width: 50px;">';
                }
                return '<img src="' . asset('assets/images/dummy_80x80.png') . '" alt="Default Image" class="img-thumbnail" style="max-width: 50px;">';
            })
            ->rawColumns(['action', 'status', 'image'])
            ->make(true);
    }

    public function create()
    {
        return view('administrative.gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $data['status'] = $request->has('status') ? 1 : 0;

        Gallery::create($data);

        return redirect()->route('administrative.gallery')->with('success', 'Gallery item added successfully.');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('administrative.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $data['status'] = $request->has('status') ? 1 : 0;

        $gallery->update($data);

        return redirect()->route('administrative.gallery')->with('success', 'Gallery item updated successfully.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }
        
        $gallery->delete();

        return 'success';
    }
}
