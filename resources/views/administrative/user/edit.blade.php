@extends('administrative.layouts.master')
@section('page-css')
@endsection
@section('content')
@include('administrative.layouts.partial._breadcrump',['breadcrumbs' =>
    [
        ['name' => 'Account Settings', 'link' => route('administrative.user')],
        ['name' => 'User', 'link' => route('administrative.user')],
        ['name' => 'Edit']
    ]
])
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">User Edit</h4>
                    @can('user_list')
                        <a href="{{route('administrative.user')}}" class="btn btn-primary btn-sm">
                            <i class="ri-list-check align-middle mr-2"></i>
                            User List
                        </a>
                    @endcan
                </div>
                <p class="card-title-desc"></p>
                <form class="needs-validation" novalidate action="{{ route('administrative.user.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    {!! method_field('PUT') !!}
                    @csrf

                    <div class="mb-3">
                        <label for="name">Full Name *</label>
                        <input required type="text" class="form-control form-control-danger" id="name" name="name" autocomplete="off" placeholder="Full Name" value="{{ old('name', isset($data) ? $data->name : '') }}" aria-invalid="true">
                        @if ($errors->has('name'))
                        <small id="name-error" class="error mt-2 text-danger" for="name">{{ $errors->first('name') }}</small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="phone">Phone Number *</label>
                        <input required type="text" class="form-control form-control-danger" id="phone" name="phone" autocomplete="off" placeholder="Phone Number" value="{{ old('phone', isset($data) ? $data->phone : '') }}" aria-invalid="true">
                        @if ($errors->has('phone'))
                        <small id="phone-error" class="error mt-2 text-danger" for="phone">{{ $errors->first('phone') }}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="email">Email *</label>
                        <input required type="email" class="form-control form-control-danger" id="email" name="email" autocomplete="off" placeholder="Email" value="{{ old('email', isset($data) ? $data->email : '') }}" aria-invalid="true">
                        @if ($errors->has('email'))
                        <small id="email-error" class="error mt-2 text-danger" for="email">{{ $errors->first('email') }}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-danger" id="password" name="password" autocomplete="off" value="{{base64_decode($data->password_hint)}}" aria-invalid="true" placeholder="Password">
                        @if ($errors->has('password'))
                        <small id="password-error" class="error mt-2 text-danger" for="password">{{ $errors->first('password') }}</small>
                        @endif
                    </div>



                    <div class="mb-3">
                        <label for="roles">Selected Role *</label>
                        <select name="role" id="roles" class="form-control" required>
                            <option selected disabled value ="">Select Role</option>
                            @if(count($roles)>0)
                            @foreach ($roles as $id => $role)
                                <option value="{{ $id }}" {{ isset($data->roles) && $data->roles->first()->id == $id ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                            @endforeach
                            @endif
                        </select>
                        @if ($errors->has('roles'))
                        <small id="name-error" class="error mt-2 text-danger" for="name">{{ $errors->first('roles') }}</small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="ustatus"> Status *</label>
                        <select id="ustatus" name="status" class="form-control ">
                            <option value="1" {{ $data->status == 1 ?  'selected' : '' }}>Active</option>
                            <option value="0" {{ $data->status != 1 ?  'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('administrative.user') }}" class="ml-3 btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
@section('page-js')

@endsection
