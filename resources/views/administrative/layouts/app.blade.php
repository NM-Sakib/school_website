<!doctype html>
<html lang="en">

<head>
        <meta charset="utf-8" />
        <title>LOGIN | SMSCR</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="SMSCR Dashboard" name="description" />
        <meta content="Dashboard" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
        <!-- Bootstrap Css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

        <link  href="{{asset('assets/libs/toastr/build/toastr.min.css')}}" rel="stylesheet" type="text/css" />

        @yield("page-css")
    </head>

    <body class="auth-body-bg">
        <div>
            <div class="container-fluid p-0">
                @yield('content')
            </div>
        </div>
        <!-- JAVASCRIPT -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('assets/libs/toastr/build/toastr.min.js')}}"></script>
        <script src="{{asset('assets/js/app.js')}}"></script>
        @yield("page-js")
    </body>

</html>
