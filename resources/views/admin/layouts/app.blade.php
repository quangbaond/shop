<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <title>{{ env('APP_NAME') }} - Admin & {{ $title ?? '' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('dist/assets/images/favicon.ico') }}/">

    <!-- App css -->
    <link href="{{ asset('dist/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dist/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')

</head>

<body id="body" class="dark-sidebar">
    @include('admin.includes.sidebar')
    @include('admin.includes.top_bar')
    {{--    page  wrap --}}
    <div class="page-wrapper">
        <!-- Page Content-->
        <div class="page-content-tab">
            <div class="container-fluid">
                @yield('content')
            </div><!-- container -->
            @include('admin.includes.footer')
        </div>
    </div>
    <!-- end page wrapper -->

    <!-- Javascript  -->

    <!-- App js -->
    <script src="{{ asset('dist/assets/js/app.js') }}"></script>
    <script
        src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
        crossorigin="anonymous"></script>
    @yield('js')
</body>
