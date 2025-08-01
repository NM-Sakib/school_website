<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Models\PopupNotice;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PopupNoticeController extends Controller
{
    public function index()
    {
        return view('administrative.popup-notices.index');
    }

    public function data()
    {
        $notices = PopupNotice::query();

        return DataTables::of($notices)
            ->addIndexColumn()
            ->addColumn('action', function ($notice) {
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<a href="' . route('administrative.popup-notices.edit', $notice->id) . '" class="btn btn-sm btn-primary"><i class="ri-edit-line"></i></a>';
                $actions .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteData(' . $notice->id . ')"><i class="ri-delete-bin-line"></i></button>';
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('status', function ($notice) {
                return $notice->is_active == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create()
    {
        return view('administrative.popup-notices.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'message' => 'required|string',
            'is_active' => 'nullable|boolean'
        ]);

        // Optionally deactivate all other notices if only one active allowed
        if ($request->has('is_active')) {
            PopupNotice::query()->update(['is_active' => false]);
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        PopupNotice::create($data);

        return redirect()->route('administrative.popup-notices')->with('success', 'Popup notice added successfully.');
    }

    public function edit($id)
    {
        $notice = PopupNotice::findOrFail($id);
        return view('administrative.popup-notices.edit', compact('notice'));
    }

    public function update(Request $request, $id)
    {
        $notice = PopupNotice::findOrFail($id);

        $data = $request->validate([
            'message' => 'required|string',
            'is_active' => 'nullable|boolean'
        ]);

        if ($request->has('is_active')) {
            PopupNotice::query()->update(['is_active' => false]);
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $notice->update($data);

        return redirect()->route('administrative.popup-notices')->with('success', 'Popup notice updated successfully.');
    }

    public function destroy($id)
    {
        $notice = PopupNotice::findOrFail($id);
        $notice->delete();

        return 'success';
    }
}
