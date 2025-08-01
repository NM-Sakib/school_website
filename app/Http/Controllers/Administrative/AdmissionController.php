<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdmissionController extends Controller
{
    public function index()
    {
        return view('administrative.admissions.index');
    }

    public function data()
    {
        $admissions = Admission::query();

        return DataTables::of($admissions)
            ->addIndexColumn()
            ->addColumn('action', function ($admission) {
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<a href="' . route('administrative.admissions.edit', $admission->id) . '" class="btn btn-sm btn-primary"><i class="ri-edit-line"></i></a>';
                $actions .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteData(' . $admission->id . ')"><i class="ri-delete-bin-line"></i></button>';
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('status', function ($admission) {
                $statusClass = '';
                switch ($admission->status) {
                    case 'pending':
                        $statusClass = 'bg-warning';
                        break;
                    case 'reviewed':
                        $statusClass = 'bg-info';
                        break;
                    case 'accepted':
                        $statusClass = 'bg-success';
                        break;
                    case 'rejected':
                        $statusClass = 'bg-danger';
                        break;
                    default:
                        $statusClass = 'bg-secondary';
                }
                return '<span class="badge ' . $statusClass . '">' . ucfirst($admission->status) . '</span>';
            })
            ->addColumn('created_at', function ($admission) {
                return $admission->created_at ? date('d M Y', strtotime($admission->created_at)) : 'N/A';
            })
            ->rawColumns(['action', 'status', 'created_at'])
            ->make(true);
    }

    public function edit($id)
    {
        $admission = Admission::findOrFail($id);
        return view('administrative.admissions.edit', compact('admission'));
    }

    public function update(Request $request, $id)
    {
        $admission = Admission::findOrFail($id);

        $data = $request->validate([
            'status' => 'required|in:pending,reviewed,accepted,rejected',
        ]);

        $admission->update($data);

        return redirect()->route('administrative.admissions')->with('success', 'Admission status updated successfully.');
    }

    public function destroy($id)
    {
        $admission = Admission::findOrFail($id);
        $admission->delete();

        return 'success';
    }
}