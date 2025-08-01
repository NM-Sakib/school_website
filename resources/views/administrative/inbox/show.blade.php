@extends('administrative.layouts.master')
@section('page-css')
@endsection

@section('content')
    @include('administrative.layouts.partial._breadcrump', [
        'breadcrumbs' => [
            ['name' => 'Contact Inbox', 'link' => route('administrative.inbox')],
            ['name' => 'View Message'],
        ],
    ])

    <div class="row">
        <div class="col-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">View Message</h4>
                        <a href="{{ route('administrative.inbox') }}"
                            class="btn btn-primary btn-sm">
                            <i class="ri-list-check align-middle mr-2"></i> Back to List
                        </a>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Message Details</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label><strong>Name:</strong></label>
                                            <p>{{ $message->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label><strong>Email:</strong></label>
                                            <p>{{ $message->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label><strong>Subject:</strong></label>
                                            <p>{{ $message->subject }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label><strong>Status:</strong></label>
                                            <p>
                                                @if($message->is_read)
                                                    <span class="badge bg-success">Read</span>
                                                @else
                                                    <span class="badge bg-warning">Unread</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label><strong>Message:</strong></label>
                                            <div class="border p-3 bg-light">
                                                {!! nl2br(e($message->message)) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label><strong>Created At:</strong></label>
                                            <p>{{ $message->created_at ? date('d M Y H:i', strtotime($message->created_at)) : 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('administrative.inbox') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
@endsection 