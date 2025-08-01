<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    public function index()
    {
        return view('administrative.events.index');
    }

    public function data()
    {
        $events = Event::query();

        return DataTables::of($events)
            ->addIndexColumn()
            ->addColumn('action', function ($event) {
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<a href="' . route('administrative.events.edit', $event->id) . '" class="btn btn-sm btn-primary"><i class="ri-edit-line"></i></a>';
                $actions .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteData(' . $event->id . ')"><i class="ri-delete-bin-line"></i></button>';
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('status', function ($event) {
                return $event->status == 1 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('event_date', function ($event) {
                return $event->event_date ? date('d M Y', strtotime($event->event_date)) : 'N/A';
            })
            ->rawColumns(['action', 'status', 'event_date'])
            ->make(true);
    }

    public function create()
    {
        return view('administrative.events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'status' => 'nullable|boolean'
        ]);

        $data['status'] = $request->has('status') ? 1 : 0;

        Event::create($data);

        return redirect()->route('administrative.events')->with('success', 'Event added successfully.');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('administrative.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'status' => 'nullable|boolean'
        ]);

        $data['status'] = $request->has('status') ? 1 : 0;

        $event->update($data);

        return redirect()->route('administrative.events')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return 'success';
    }
}
