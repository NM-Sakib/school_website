<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Yajra\DataTables\Facades\DataTables;

class ContactInboxController extends Controller
{
    public function index()
    {
        return view('administrative.inbox.index');
    }

    public function data()
    {
        $messages = ContactMessage::query();

        return DataTables::of($messages)
            ->addIndexColumn()
            ->addColumn('action', function ($message) {
                $actions = '<div class="btn-group" role="group">';
                $actions .= '<button type="button" class="btn btn-sm btn-info" onclick="viewMessage(' . $message->id . ')"><i class="ri-eye-line"></i></button>';
                $actions .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteData(' . $message->id . ')"><i class="ri-delete-bin-line"></i></button>';
                $actions .= '</div>';
                return $actions;
            })
            ->addColumn('status', function ($message) {
                return $message->is_read == 1 ? '<span class="badge bg-success">Read</span>' : '<span class="badge bg-warning">Unread</span>';
            })
            ->addColumn('created_at', function ($message) {
                return $message->created_at ? date('d M Y H:i', strtotime($message->created_at)) : 'N/A';
            })
            ->rawColumns(['action', 'status', 'created_at'])
            ->make(true);
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // Mark as read
        if (!$message->is_read) {
            $message->update(['is_read' => 1]);
        }
        
        return view('administrative.inbox.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return 'success';
    }
}
