<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">

    <!-- Bootstrap 4.1.1 -->
    <link href="{{ asset('assets/css/bootstrap.min.css?v=1') }}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css?v=1') }}" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css?v=1') }}">
    <link href="{{ asset('assets/css/sweetalert.css?v=1') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/select2.min.css?v=1') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/owl-carousel/assets/owl.carousel.min.css?v=1') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/owl-carousel/assets/owl.theme.default.min.css?v=1') }}" rel="stylesheet"
        type="text/css" />

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=1">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png?v=1') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png?v=1') }}">
    <link rel="manifest" href="{{ asset('img/site.webmanifest?v=1') }}">
    <link rel="mask-icon" href="{{ asset('img/safari-pinned-tab.svg?v=1') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <style>
        .file-preview {
            background-color: var(--light)
        }

        .file-caption-name:not(.file-caption-disabled) {
            background-color: var(--light) !important;
        }
    </style>
    @yield('page_css')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css?v=1') }}">
    @yield('css')
</head>

<body style="background-color:#18202d !important ">

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                @include('layouts.header')
            </nav>
            <div class="main-sidebar main-sidebar-postion bg-dark pb-5">
                @include('layouts.sidebar')
            </div>
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                @include('layouts.footer')
            </footer>
        </div>
    </div>

    @include('profile.change_password')
    @include('profile.edit_profile')

</body>
<script src="{{ asset('assets/js/jquery.min.js?v=1') }}"></script>
<script src="{{ asset('assets/js/popper.min.js?v=1') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js?v=1') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js?v=1') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js?v=1') }}"></script>
<script src="{{ asset('assets/js/select2.min.js?v=1') }}"></script>

<script src="{{ asset('assets/js/jquery.nicescroll.js?v=1') }}"></script>
{{-- owl carousel --}}
<script src="{{ asset('assets/owl-carousel/owl.carousel.min.js?v=1') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('web/js/stisla.js?v=1') }}"></script>
<script src="{{ asset('web/js/scripts.js?v=1') }}"></script>
<script src="{{ mix('assets/js/profile.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
@yield('page_js')
@yield('scripts')

</html>