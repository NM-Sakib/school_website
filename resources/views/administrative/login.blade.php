@extends('administrative.layouts.app')
@section('page-css')
    <style>
        /* password field */
        .toggle-password {
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
                                        <a href="{{ url('/') }}" class="">
                                            <img src="{{ asset('assets/images/icon.jpeg') }}" alt="" width="250"
                                            {{-- <img src="{{ asset('') }}" alt="" width="250" --}}
                                                class="auth-logo logo-dark mx-auto">
                                        </a>
                                    </div>
                                    <h4 class="font-size-18 mt-4">Welcome Back !</h4>
                                    <p class="text-muted">Sign in to SMSCR Admin Panel</p>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ $errors->first() }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="mt-3">
                                    <form id="login" method="post">
                                        @csrf
                                        <div class="mb-3 auth-form-group-custom mb-4">
                                            <i class="ri-mail-line auti-custom-input-icon"></i>
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email') }}" placeholder="email@email.com">
                                        </div>

                                        <div id="passord-input" class="mb-3 auth-form-group-custom mb-4">
                                            <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Enter password">
                                            <span toggle="#password-field"
                                                class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <button id="click-submit" class="btn btn-primary w-md waves-effect waves-light "
                                                type="submit">Log In</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="mt-5 text-center">
                                    <p>Copyright ©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script>. by <a href="#" target="_blank">Developer.</a>
                                    </p>
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
            $('#login').submit(function(e) {
                e.preventDefault();
                // Serialize the form data
                const formData = new FormData(this);
                // Send an AJAX request
                $.ajax({
                    type: 'POST',
                    url: "{{ route('login.post') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.code == 200) {
                            toastr.success(response.message);
                            window.location.href = response.url;
                        } else {
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
