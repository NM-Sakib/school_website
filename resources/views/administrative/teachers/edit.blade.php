@extends('administrative.layouts.master')
@section('page-css')
@endsection

@section('content')
    @include('administrative.layouts.partial._breadcrump', [
        'breadcrumbs' => [
            ['name' => 'Teachers', 'link' => route('administrative.teachers')],
            ['name' => 'Edit'],
        ],
    ])

    <div class="row">
        <div class="col-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Edit Teacher</h4>
                        <a href="{{ route('administrative.teachers') }}"
                            class="btn btn-primary btn-sm">
                            <i class="ri-list-check align-middle mr-2"></i> List
                        </a>
                    </div>

                    <form class="needs-validation" novalidate
                        action="{{ route('administrative.teachers.update', $teacher->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Teacher Information</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="name">Name<strong class="text-danger">*</strong></label>
                                                <input type="text" name="name" id="name" class="form-control" 
                                                    value="{{ old('name', $teacher->name) }}" required>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="designation">Designation<strong class="text-danger">*</strong></label>
                                                <input type="text" name="designation" id="designation" 
                                                    value="{{ old('designation', $teacher->designation) }}" class="form-control" required>
                                                @error('designation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="department">Department</label>
                                                <input type="text" name="department" id="department" 
                                                    value="{{ old('department', $teacher->department) }}" class="form-control">
                                                @error('department')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" 
                                                    value="{{ old('email', $teacher->email) }}" class="form-control">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="phone">Phone</label>
                                                <input type="text" name="phone" id="phone" 
                                                    value="{{ old('phone', $teacher->phone) }}" class="form-control">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="image">Profile Image</label>
                                                <input type="file" name="image" id="image" class="form-control" 
                                                    accept="image/*">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                @if($teacher->image_path)
                                                    <div class="mt-2">
                                                        <img src="{{ asset('storage/' . $teacher->image_path) }}" 
                                                            alt="Current Image" class="img-thumbnail" style="max-width: 100px;">
                                                        <small class="text-muted">Current image</small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="bio">Bio</label>
                                                <textarea name="bio" id="bio" class="form-control" rows="4">{{ old('bio', $teacher->bio) }}</textarea>
                                                @error('bio')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="status">Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="status" 
                                                        id="status" value="1" {{ old('status', $teacher->status) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="status">
                                                        Active
                                                    </label>
                                                </div>
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
                        <a href="{{ route('administrative.teachers') }}"
                            class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
@endsection 