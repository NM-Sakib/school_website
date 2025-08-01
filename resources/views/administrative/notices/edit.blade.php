@extends('administrative.layouts.master')
@section('page-css')
@endsection

@section('content')
    @include('administrative.layouts.partial._breadcrump', [
        'breadcrumbs' => [
            ['name' => 'Notices', 'link' => route('administrative.notices')],
            ['name' => 'Edit'],
        ],
    ])

    <div class="row">
        <div class="col-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Edit Notice</h4>
                        <a href="{{ route('administrative.notices') }}"
                            class="btn btn-primary btn-sm">
                            <i class="ri-list-check align-middle mr-2"></i> List
                        </a>
                    </div>

                    <form class="needs-validation" novalidate
                        action="{{ route('administrative.notices.update', $notice->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Notice Information</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="title">Title<strong class="text-danger">*</strong></label>
                                                <input type="text" name="title" id="title" class="form-control" 
                                                    value="{{ old('title', $notice->title) }}" required>
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="file">Notice File</label>
                                                <input type="file" name="file" id="file" class="form-control" 
                                                    accept=".pdf,.doc,.docx">
                                                @error('file')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                @if($notice->file_path)
                                                    <div class="mt-2">
                                                        <a href="{{ asset('storage/' . $notice->file_path) }}" 
                                                            target="_blank" class="btn btn-sm btn-info">
                                                            <i class="ri-download-line"></i> Current File
                                                        </a>
                                                        <small class="text-muted">Current file</small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" class="form-control" rows="6">{{ old('description', $notice->description) }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="is_published">Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="is_published" 
                                                        id="is_published" value="1" {{ old('is_published', $notice->is_published) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_published">
                                                        Published
                                                    </label>
                                                </div>
                                                @error('is_published')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        <a href="{{ route('administrative.notices') }}"
                            class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
@endsection 