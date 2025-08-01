@extends('administrative.layouts.master')
@section('page-css')

@endsection
@section('content')
@include('administrative.layouts.partial._breadcrump',['breadcrumbs' =>
    [
        ['name' => 'Account Settings', 'link' => route('administrative.role')],
        ['name' => 'Role', 'link' => route('administrative.role')],
        ['name' => 'Edit']
    ]
])
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Role Edit</h4>
                    @can('role_list')
                        <a href="{{route('administrative.role')}}" class="btn btn-primary btn-sm">
                            <i class="ri-list-check align-middle mr-2"></i>
                            Role List
                        </a>
                    @endcan
                </div>
                <p class="card-title-desc"></p>
                <form class="" action="{{route('administrative.role.update',$data->id)}}" method="POST" enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                    @csrf
                        <div class="mb-3">
                            <label for="name">Name <strong class="text-danger">*</strong></label>
                                <input required type="text" class="form-control form-control-danger" id="name" name="name" autocomplete="off" placeholder="Role Name" value="{{ old('name', isset($data) ? $data->name : '') }}">
                                @if($errors->has('name'))
                                    <label id="name-error" class="error mt-2 text-danger" for="name">Please enter a name</label>
                                @endif
                        </div>

                        <div class="mb-3">
                            <label for="permission">Permission <strong class="text-danger">*</strong><br>
                                <span class="btn btn-light btn-sm select-all">Select All</span>
                                <span class="btn btn-light btn-sm deselect-all">Deselect All</span>
                            </label>
                            <select name="permission[]" id="permission" data-placeholder="Select Permission" class="form-control select2" multiple="multiple">
                                @foreach($permissions as $id => $permissions)
                                <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($data) && $data->permissions()->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}>{{ ucfirst(str_replace("_"," ",$permissions)) }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('permission'))
                                <label id="name-error" class="error mt-2 text-danger" for="name">Please enter a permssion</label>
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

