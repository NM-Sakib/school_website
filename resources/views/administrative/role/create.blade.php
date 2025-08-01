@extends('administrative.layouts.master')
@section('page-css')

@endsection
@section('content')
@include('administrative.layouts.partial._breadcrump',['breadcrumbs' =>
    [
        ['name' => 'Account Settings', 'link' => route('administrative.role')],
        ['name' => 'Role', 'link' => route('administrative.role')],
        ['name' => 'Create']
    ]
])

<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Role Create</h4>
                    @can('role_list')
                        <a href="{{route('administrative.role')}}" class="btn btn-primary btn-sm">
                            <i class="ri-list-check align-middle mr-2"></i>
                            Role List
                        </a>
                    @endcan
                </div>
                <p class="card-title-desc"></p>
                <form class="needs-validation" novalidate action="{{route('administrative.role.store')}} " method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-3">
                            <label for="name">Name <strong class="text-danger">*</strong></label>
                                <input required type="text" class="form-control" id="name" name="name"  value="{{ old('name') }}" placeholder="Role Name">
                                @if($errors->has('name'))
                                    <small id="name-error" class="error mt-2 text-danger" for="name">Please enter a name</small>
                                @endif
                        </div>

                        <div class="mb-3">
                            <label for="permission">Permission <strong class="text-danger">*</strong><br>
                                <span class="btn btn-light btn-sm select-all">Select All</span>
                                <span class="btn btn-light btn-sm deselect-all">Deselect All</span>
                            </label>
                            <select name="permission[]" id="permission" data-placeholder="Select Permission" class="form-control select2" multiple="multiple">
                                @foreach($permissions as $id => $permissions)
                                    <option value="{{ $id }}" {{ (in_array($id, old('permission', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>{{ ucfirst(str_replace("_"," ",$permissions)) }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('permission'))
                                <small id="name-error" class="error mt-2 text-danger" for="name">Please enter a permssion</small>
                            @endif
                        </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('administrative.role') }}" class="ml-3 btn btn-light">Cancel</a>
                </form>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
@section('page-js')

<script>
    $('.select-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', 'selected')
        $select2.trigger('change')
    })
    $('.deselect-all').click(function () {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', '')
        $select2.trigger('change')
    })
</script>
@endsection
