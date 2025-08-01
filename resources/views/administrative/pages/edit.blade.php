@extends('administrative.layouts.master')
@section('page-css')
@endsection

@section('content')
    @include('administrative.layouts.partial._breadcrump', [
        'breadcrumbs' => [
            ['name' => 'Pages', 'link' => route('administrative.pages')],
            ['name' => 'Edit'],
        ],
    ])

    <div class="row">
        <div class="col-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Edit Page</h4>
                        <a href="{{ route('administrative.pages') }}"
                            class="btn btn-primary btn-sm">
                            <i class="ri-list-check align-middle mr-2"></i> List
                        </a>
                    </div>

                    <form class="needs-validation" novalidate
                        action="{{ route('administrative.pages.update', $page->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Page Information</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="title">Title<strong class="text-danger">*</strong></label>
                                                <input type="text" name="title" id="title" class="form-control" 
                                                    value="{{ old('title', $page->title) }}" required>
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="slug">Slug<strong class="text-danger">*</strong></label>
                                                <input type="text" name="slug" id="slug" 
                                                    value="{{ old('slug', $page->slug) }}" class="form-control" required>
                                                @error('slug')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="content">Content</label>
                                                <textarea name="content" id="content" class="form-control" rows="10">{{ old('content', $page->content) }}</textarea>
                                                @error('content')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="status">Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="status" 
                                                        id="status" value="1" {{ old('status', $page->status) ? 'checked' : '' }}>
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
                        <a href="{{ route('administrative.pages') }}"
                            class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
@endsection 