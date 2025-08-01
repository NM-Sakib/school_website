<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>DASHBOARD | SMSCR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="SMSCR Dashboard" name="description" />
    <meta content="Dashboard" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

    <!-- jquery.vectormap css -->
    <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/dropify.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/hexa-toaster.css') }}">
    <!-- include summernote css/js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote-bs5.min.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/aiz-core.css') }}">
    <!-- NProgress CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/nprogress.min.css') }}" />

    @yield('page-css')
    @stack('page-css')



    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: 'Nothing selected',
            nothing_found: 'Nothing found',
            choose_file: 'Choose file',
            file_selected: 'File selected',
            files_selected: 'Files selected',
            add_more_files: 'Add more files',
            adding_more_files: 'Adding more files',
            drop_files_here_paste_or: 'Drop files here, paste or',
            browse: 'Browse',
            upload_complete: 'Upload complete',
            upload_paused: 'Upload paused',
            resume_upload: 'Resume upload',
            pause_upload: 'Pause upload',
            retry_upload: 'Retry upload',
            cancel_upload: 'Cancel upload',
            uploading: 'Uploading',
            processing: 'Processing',
            complete: 'Complete',
            file: 'File',
            files: 'Files',
        }
    </script>

</head>

<body data-sidebar="dark" data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('administrative.layouts.partial._navbar')

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                @include('administrative.layouts.partial._sidebar')
                <!-- Sidebar -->

            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="loading">
                        <div class="box" id="loader1"></div>
                        <div class="box" id="loader2"></div>
                        <div class="box" id="loader3"></div>
                        <div class="box" id="loader4"></div>
                        <div class="box" id="loader5"></div>
                    </div>
                    <!-- toaster Start -->
                    <div class="hs-toast-wrapper  hs-toast-fixed-top " id="hexa-toaster"></div>

                    @yield('content')
                </div>
            </div>
            <!-- End Page-content -->
            @include('administrative.layouts.partial._footer')

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

    <!-- jquery.vectormap map -->
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}">
    </script>
    <script src="{{ asset('assets/libs/admin-resources/jquery-ui.min.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.min.js') }}"></script>
    <script>
        const FRONTEND_URL = @json(config('app.frontend_url'));
    </script>

    <!-- toaster plugin -->
    <script src="{{ asset('assets/js/hexa-toaster.js') }}"></script>
    @include('administrative.layouts.partial._toaster')
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- include summernote css/js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote-bs5.min.js">
    </script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
    <script src="{{ asset('assets/js/aiz-core.js') }}"></script>
    <!-- NProgress JS -->
    <script src="{{ asset('assets/js/nprogress.min.js') }}"></script>
    <script>
        // Start NProgress on page start
        NProgress.start();

        // Complete NProgress when page is fully loaded
        window.addEventListener('load', function() {
            NProgress.done();
        });
    </script>

    @yield('page-js')
    @stack('page-js')
    <script>
        $('.select2').select2();

        $(window).on('load', function() {
            $('.loading').fadeOut('slow');
        });

        // Initialize the summernote editor
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                callbacks: {
                    onImageUpload: function(images) {
                        imageUploadCompleted = false;
                        uploadImage(images[0]);
                    }
                }
            });
        });

        function uploadImage(image) {
            let formData = new FormData();
            formData.append("image", image);
            formData.append("_token", "{{ csrf_token() }}"); // CSRF protection

            $.ajax({
                url: "{{ route('administrative.summernote.upload') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(url) {
                    $('.summernote').summernote('insertImage', url);
                    imageUploadCompleted = true; // Mark upload as completed
                },
                error: function(response) {
                    console.log(response);
                    alert('Image upload failed!');
                }
            });
        }

        // Initialize the summernote One editor
        $(document).ready(function() {
            $('.summernoteOne').summernote({
                height: 200,
                callbacks: {
                    onImageUpload: function(images) {
                        imageUploadCompleted = false;
                        uploadImageOne(images[0]);
                    }
                }
            });
        });

        function uploadImageOne(image) {
            let formData = new FormData();
            formData.append("image", image);
            formData.append("_token", "{{ csrf_token() }}"); // CSRF protection

            $.ajax({
                url: "{{ route('administrative.summernote.upload') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(url) {
                    $('.summernoteOne').summernote('insertImage', url);
                    imageUploadCompleted = true; // Mark upload as completed
                },
                error: function(response) {
                    console.log(response);
                    alert('Image upload failed!');
                }
            });
        }
    </script>
    <script>
        $(document).on('keyup', '#header-search-input', function() {
            let query = $(this).val();
            if (query.length >= 2) {
                $.ajax({
                    url: '/search', // Update with your actual route
                    method: 'GET',
                    data: {
                        q: query
                    },
                    success: function(data) {
                        let results = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                results +=
                                    `<li class="list-group-item"><a href="${item.page_link}" class="text-decoration-none">${item.title}</a></li>`;

                            });
                        } else {
                            results = '<li class="list-group-item text-muted">No results found</li>';
                        }
                        $('#search-results').html(results);
                    }
                });
            } else {
                $('#search-results').empty();
            }
        });
    </script>
</body>


</html>