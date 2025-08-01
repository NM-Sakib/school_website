@extends('administrative.layouts.master')
@section('page-css')

@endsection
@section('content')
@include('administrative.layouts.partial._breadcrump',['breadcrumbs' =>
    [
        ['name' => 'Account Settings', 'link' => route('administrative.permission')],
        ['name' => 'Permission', 'link' => route('administrative.permission')],
        ['name' => 'Edit']
    ]
])
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Permission Create</h4>
                    @can('permission_list')
                        <a href="{{route('administrative.permission')}}" class="btn btn-primary btn-sm">
                            <i class="ri-list-check align-middle mr-2"></i>
                            Permissions List
                        </a>
                    @endcan
                </div>
                <p class="card-title-desc"></p>
                <form class="needs-validation" novalidate action="{{route('administrative.permission.update',$data->id)}} " method="POST" enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Permission Name *</label>
                        <input required type="text" class="form-control form-control-danger" id="name" name="name" autocomplete="off" placeholder="Permission Name" value="{{ old('name', isset($data) ? $data->name : '') }}" aria-invalid="true">
                        @if($errors->has('name'))
                        <label id="name-error" class="error mt-2 text-danger" for="name">Please enter a name</label>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{ route('administrative.permission') }}" class="btn btn-light">Cancel</a>

                </form>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection
@section('page-js')

@endsection

