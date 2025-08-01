@extends('administrative.layouts.master')
@section('page-css')
@endsection
@section('content')
    @include('administrative.layouts.partial._breadcrump', [
        'breadcrumbs' => [
            ['name' => 'About', 'link' => route('administrative.company-profile.at-a-glance.list')],
            ['name' => 'Company Profile', 'link' => route('administrative.company-profile.at-a-glance.list')],
            ['name' => 'At a glance', 'link' => route('administrative.company-profile.at-a-glance.list')],
            ['name' => 'Create'],
        ],
    ])

    <div class="row">
        <div class="col-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">At a Glance Create</h4>
                        <a href="{{ route('administrative.company-profile.at-a-glance.list') }}"
                            class="btn btn-primary btn-sm">
                            <i class="ri-list-check align-middle mr-2"></i>
                            List
                        </a>
                    </div>

                    <p class="card-title-desc"></p>
                    <form class="needs-validation" novalidate
                        action="{{ route('administrative.company-profile.at-a-glance.store') }} " method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    Content Sections
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="year">Year<strong class="text-danger">*</strong></label>
                                                <select name="year" id="year" class="form-control" required>
                                                    <option value="">Select Year</option>
                                                    @php
                                                        $currentYear = date('Y');
                                                        $startYear = $currentYear - 100;
                                                        $endYear = $currentYear + 100;
                                                    @endphp
                                                    @for ($i = $startYear; $i <= $endYear; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                @error('year')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="sort">Sort Order</label>
                                                <input type="number" name="sort" id="sort"
                                                    value="{{ old('sort') }}" class="form-control">
                                                @error('number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="description_english">Description English<strong
                                                        class="text-danger">*</strong></label>
                                                <textarea type="text" name="description_english" id="description_english" class="form-control" required>{{ old('description_english') }}</textarea>
                                                @error('description_english')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="description_bangla">Description Bangla<strong
                                                        class="text-danger">*</strong></label>
                                                <textarea type="text" name="description_bangla" id="description_bangla" class="form-control" required>{{ old('description_bangla') }}</textarea>
                                                @error('description_bangla')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="stat">Status</label>
                                                <select id="stat" name="status" class="form-select">
                                                    <option value="1" selected>Active</option>
                                                    <option value="0">Inactive</option>
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


                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('administrative.company-profile.at-a-glance.list') }}"
                            class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('page-js')
@endsection
