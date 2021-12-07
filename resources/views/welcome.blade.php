<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-size: 100%;
            https: //wallpapercave.com/wp/wp2841663.jpg
        }

        /*
       background-image: url("https://weststreetwillyseatery.com/wp-content/uploads/2016/03/Top-10-best-Simple-Awesome-Background-Images-for-Your-Website-or-Blog2.jpg");
        */

    </style>
</head>

<body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @else
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-warning"><a href="{{ route('login') }}"
                            class="text-sm text-gray-700 dark:text-gray-500 underline"><b>LogIn</b></a></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @if (Route::has('register'))
                        <button class="btn btn-warning"><a href="{{ route('register') }}"
                                class="text-sm text-gray-700 dark:text-gray-500 underline"><b>Register</b></a></button>
                    @endif
                @endauth
            </div>
        @endif

        <section class="content" style="border: none;">
            <div class="container-fluid" style="border: none;">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    @foreach ($query as $querys)
                        <div class="card"
                            style="width:300px;margin-right: 40px;background-color: transparent">
                            <a href="{{ route('crud.showcomment', ['id' => $querys->id]) }}">
                                <div class="card-body display" id="show">

                                    @php
                                        $count = DB::table('likes')
                                            ->where('blog_id', $querys->id)
                                            ->count();
                                    @endphp

                                    @php
                                        $countcomment = DB::table('comments')
                                            ->where('blog_id', $querys->id)
                                            ->count();
                                    @endphp


                                    <div id="{{ $querys->id }}">
                                        <img src="{{ $querys->image }}" class="img-thumbnail" id="imageshow"
                                            height="300px" width="300px">
                                        <h3>{{ $querys->title }}</h3>
                                        <b>{{ $querys->description }}</b>
                                        <div>

                                            {{-- <button type="button" style="background-color: transparent; border:none;"
                                                class="btn btn-light view hvr" id="likeblog"
                                                data-id="{{ $querys->id }}">
                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                <b class="{{ $querys->id }}">{{ $count }}</b>
                                            </button>
                                            <button type="button" style="background-color: transparent; border:none;"
                                                class="btn btn-light view hvrc" id="commentblog"
                                                data-id="{{ $querys->id }}" data-toggle="modal"
                                                data-target="#exampleModalCenter2">
                                                <i class="fa fa-comment" aria-hidden="true"></i>
                                                <b id="m{{ $querys->id }}">{{ $countcomment }}</b>
                                            </button> --}}

                                        </div>
                                        <div>&nbsp;</div>
                                    </div>


                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

    </div>


    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
    <!-- AdminLTE App -->
    <script src="{{ 'dist/js/adminlte.min.js' }}"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    {{-- <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    {{-- <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>

    <script>
        /*  $(document).on("click", ".display",function(){
                    alert();
                }); */
    </script>

</body>

</html>
