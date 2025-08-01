@extends('administrative.layouts.app')
@section('page-css')
<style>
/* password field */
.toggle-password{
    position: absolute;
    top: 17px;
    right: 17px;
    font-size: 24px;
    color: #00407085;
}
</style>
@endsection
@section('content')
<div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-lg-4 col-md-6 col-sm-8">
        <div class="authentication-page-content p-4">
            <div class="w-100">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div>
                            <div class="text-center">
                                <div>
                                    <a href="{{url('/')}}" class="">
                                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="" width="200" class="auth-logo logo-dark mx-auto">
                                    </a>
                                </div>
                                <h4 class="font-size-18 mt-4">Welcome Back !</h4>
                                <p class="text-muted">Sign up to Kyro.</p>
                            </div>
                            @if($errors->any())
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{$errors->first()}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <div class="mt-3">
                                <form id="register" method="post" >
                                    @csrf
                                    <div class="mb-3 auth-form-group-custom mb-4">
                                        <i class="ri-user-3-line auti-custom-input-icon"></i>
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Enter Full Name">
                                    </div>
                                    <div class="mb-3 auth-form-group-custom mb-4">
                                        <i class="ri-phone-line auti-custom-input-icon"></i>
                                        <label for="phone">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" placeholder="01710000000">
                                    </div>

                                    <div id="otp-input" class="mb-3 auth-form-group-custom mb-4 d-none">
                                        <i class="ri-smartphone-line auti-custom-input-icon"></i>
                                        <label for="otp">OTP</label>
                                        <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter otp">
                                    </div>

                                    <div class="mt-4 text-center">
                                        <button id="click-next" class="btn btn-primary w-md waves-effect waves-light" type="button">Next</button>
                                        <button id="click-submit" class="btn btn-primary w-md waves-effect waves-light d-none" type="submit">Register</button>
                                    </div>
                                    <div class="mt-4 text-center">
                                        Already have an account ? <a href="{{route('administrative.login')}}" class="text-primary"> Sign in</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')

<script>
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $('#password');
        if (input.attr("type") == "password") {
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        }
    });
    $(document).ready(function() {
        $('#click-next').on('click',function(e) {
            e.preventDefault();
            var phone_no = $('#phone').val();
            var name = $('#name').val();
            if(phone_no && name){
                // Send an AJAX request
                $.ajax({
                    type: 'GET',
                    url: "{{route('register.check-phone')}}",
                    data: {
                        phone : phone_no
                    },
                    success: function(response) {
                        if(response.code == 200){
                            $('#otp-input').removeClass('d-none');
                            $('#click-submit').removeClass('d-none');
                            toastr.success(response.message);
                            $('#click-next').addClass('d-none');
                        }else{
                            toastr.error(response.message);
                            $('#click-next').removeClass('d-none');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }else{
                toastr.error('Name / Phone no is required');
            }
        });

        $('#register').submit(function(e) {
            e.preventDefault();
            // Serialize the form data
            const formData = new FormData(this);
            // Send an AJAX request
            $.ajax({
                type: 'POST',
                url: "{{route('register.post')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if(response.code == 200){
                        toastr.success(response.message);
                        window.location.href = response.url;
                    }else{
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors if needed
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
