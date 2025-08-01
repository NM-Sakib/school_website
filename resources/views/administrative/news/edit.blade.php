@extends('administrative.layouts.master')
@section('page-css')
@endsection

@section('content')
    @include('administrative.layouts.partial._breadcrump', [
        'breadcrumbs' => [
            ['name' => 'News', 'link' => route('administrative.news')],
            ['name' => 'Edit'],
        ],
    ])

    <div class="row">
        <div class="col-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Edit News</h4>
                        <a href="{{ route('administrative.news') }}"
                            class="btn btn-primary btn-sm">
                            <i class="ri-list-check align-middle mr-2"></i> List
                        </a>
                    </div>

                    <form class="needs-validation" novalidate
                        action="{{ route('administrative.news.update', $news->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">News Information</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="title">Title<strong class="text-danger">*</strong></label>
                                                <input type="text" name="title" id="title" class="form-control" 
                                                    value="{{ old('title', $news->title) }}" required>
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="image">News Image</label>
                                                <input type="file" name="image" id="image" class="form-control" 
                                                    accept="image/*">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                @if($news->image_path)
                                                    <div class="mt-2">
                                                        <img src="{{ asset('storage/' . $news->image_path) }}" 
                                                            alt="Current Image" class="img-thumbnail" style="max-width: 100px;">
                                                        <small class="text-muted">Current image</small>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" class="form-control" rows="6">{{ old('description', $news->description) }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="status">Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="status" 
                                                        id="status" value="1" {{ old('status', $news->status) ? 'checked' : '' }}>
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
                        <a href="{{ route('administrative.news') }}"
                            class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
@endsection 