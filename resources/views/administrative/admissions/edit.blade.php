@extends('administrative.layouts.master')
@section('page-css')
@endsection

@section('content')
    @include('administrative.layouts.partial._breadcrump', [
        'breadcrumbs' => [
            ['name' => 'Admissions', 'link' => route('administrative.admissions')],
            ['name' => 'Edit'],
        ],
    ])

    <div class="row">
        <div class="col-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Edit Admission Status</h4>
                        <a href="{{ route('administrative.admissions') }}"
                            class="btn btn-primary btn-sm">
                            <i class="ri-list-check align-middle mr-2"></i> List
                        </a>
                    </div>

                    <form class="needs-validation" novalidate
                        action="{{ route('administrative.admissions.update', $admission->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Admission Information</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control" 
                                                    value="{{ $admission->name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" 
                                                    value="{{ $admission->email }}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="phone" id="phone" 
                                                    value="{{ $admission->phone }}" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="status">Status<strong class="text-danger">*</strong></label>
                                                <select name="status" id="status" class="form-control" required>
                                                    <option value="pending" {{ $admission->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="reviewed" {{ $admission->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                                    <option value="accepted" {{ $admission->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                                    <option value="rejected" {{ $admission->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        <a href="{{ route('administrative.admissions') }}"
                            class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
@endsection 