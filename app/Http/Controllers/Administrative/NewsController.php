<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
    public function index()
    {
        return view('administrative.news.index');
    }

    public function data()
    {
        $news = News::query();

        return DataTables::of($news)
            ->addIndexColumn()
            ->addColumn('action', function ($news) {
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<a href="' . route('administrative.news.edit', $news->id) . '" class="btn btn-sm btn-primary"><i class="ri-edit-line"></i></a>';
                $actions .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteData(' . $news->id . ')"><i class="ri-delete-bin-line"></i></button>';
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('status', function ($news) {
                return $news->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('image', function ($news) {
                if ($news->image_path) {
                    return '<img src="' . asset('storage/' . $news->image_path) . '" alt="News Image" class="img-thumbnail" style="max-width: 50px;">';
                }
                return '<img src="' . asset('assets/images/dummy_80x80.png') . '" alt="Default Image" class="img-thumbnail" style="max-width: 50px;">';
            })
            ->rawColumns(['action', 'status', 'image'])
            ->make(true);
    }

    public function create()
    {
        return view('administrative.news.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('news', 'public');
        }

        $data['slug'] = Str::slug($request->title);
        $data['status'] = $request->has('status') ? 1 : 0;

        News::create($data);

        return redirect()->route('administrative.news')->with('success', 'News added successfully.');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('administrative.news.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }
            $data['image_path'] = $request->file('image')->store('news', 'public');
        }

        $data['slug'] = Str::slug($request->title);
        $data['status'] = $request->has('status') ? 1 : 0;

        $news->update($data);

        return redirect()->route('administrative.news')->with('success', 'News updated successfully.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }
        
        $news->delete();

        return 'success';
    }
}
