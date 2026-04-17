<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- General CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css?v=1') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css?v=1') }}">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css?v=1') }}">
    <link href="{{ asset('assets/css/sweetalert.css?v=1') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/select2.min.css?v=1') }}" rel="stylesheet" type="text/css" />

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=1">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png?v=1') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png?v=1') }}">
    <link rel="manifest" href="{{ asset('img/site.webmanifest?v=1') }}">
    <link rel="mask-icon" href="{{ asset('img/safari-pinned-tab.svg?v=1') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <style>
        .bg-dark-1 {
            background-image: linear-gradient(0deg, rgb(22, 24, 41), rgb(41, 45, 69)) !important;
        }
    </style>
</head>

<body class="bg-dark-1">
    <div id="app">
        <section class="section">
            <div class="container mt-3">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="login-brand">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-12">
                                    <a href="{{ route('guest.home') }}">
                                        <img src="{{ asset('assets/images/logo.png?v=1') }}" alt="logo" width="100">
                                    </a>
                                </div>
                                <div class="col-12">
                                    <h2 class="text-white font-weight-bolder">Ubuvivi Tours</h2>
                                </div>
                            </div>
                        </div>
                        @yield('content')
                        <div class="simple-footer">
                            Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/jquery.min.js?v=1') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js?v=1') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js?v=1') }}"></script>
    <script src="{{ asset('assets/js/jquery.nicescroll.js?v=1') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('web/js/stisla.js?v=1') }}"></script>
    <script src="{{ asset('web/js/scripts.js?v=1') }}"></script>
    <!-- Page Specific JS File -->
</body>

</html>