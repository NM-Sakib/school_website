<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    public function index()
    {
        return view('administrative.pages.index');
    }

    public function data()
    {
        $pages = Page::query();

        return DataTables::of($pages)
            ->addIndexColumn()
            ->addColumn('action', function ($page) {
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<a href="' . route('administrative.pages.edit', $page->id) . '" class="btn btn-sm btn-primary"><i class="ri-edit-line"></i></a>';
                $actions .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteData(' . $page->id . ')"><i class="ri-delete-bin-line"></i></button>';
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('status', function ($page) {
                return $page->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create()
    {
        return view('administrative.pages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages',
            'content' => 'nullable|string',
            'status' => 'nullable|boolean'
        ]);

        $data['status'] = $request->has('status') ? 1 : 0;

        Page::create($data);

        return redirect()->route('administrative.pages')->with('success', 'Page added successfully.');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('administrative.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $id,
            'content' => 'nullable|string',
            'status' => 'nullable|boolean'
        ]);

        $data['status'] = $request->has('status') ? 1 : 0;

        $page->update($data);

        return redirect()->route('administrative.pages')->with('success', 'Page updated successfully.');
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return 'success';
    }
}
