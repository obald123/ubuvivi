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
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800&display=swap" rel="stylesheet">
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
        body {
            margin: 0;
            background: #0f2a38 !important;
            color: #183247;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden !important;
        }

        html {
            overflow-x: hidden !important;
        }

        .main-wrapper.main-wrapper-1 {
            min-height: 100vh;
            background: #0f2a38;
        }

        .file-preview {
            background-color: var(--light)
        }

        .file-caption-name:not(.file-caption-disabled) {
            background-color: var(--light) !important;
        }

        #sidebar-wrapper {
            background: #0f2a38 !important;
            width: 212px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            padding: 18px 0;
        }

        .sidebar-brand {
            padding: 8px 18px 22px;
        }

        .logo-circle {
            width: 40px;
            height: 40px;
            background: #C85A2A;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: white;
            font-size: 18px;
        }

        .brand-text {
            color: white;
            font-size: 23px;
            font-weight: 700;
            letter-spacing: -.02em;
        }

        .sidebar-menu {
            list-style: none;
            padding: 18px 0 0;
            margin: 0;
            min-height: calc(100vh - 110px);
            display: flex;
            flex-direction: column;
        }

        .side-menus {
            margin: 0 12px 8px;
        }

        .side-menus .nav-link {
            color: rgba(255,255,255,.6);
            padding: 14px 16px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: background .2s, color .2s;
            border-left: none;
            font-size: 15px;
            font-weight: 500;
            border-radius: 999px;
            gap: 10px;
        }

        .side-menus .nav-link:hover {
            color: rgba(255,255,255,.96);
            background: rgba(255,255,255,.08);
            text-decoration: none;
        }

        .side-menus.active .nav-link {
            color: #fff;
            background: linear-gradient(90deg, #1d96ef 0%, #35a9f4 100%);
            border-left: none;
            border-radius: 999px;
            box-shadow: 0 10px 24px rgba(29, 150, 239, .24);
        }

        .side-menus .nav-link i {
            width: 20px;
            margin-right: 6px;
            font-size: 15px;
            text-align: center;
        }

        .logout-item {
            margin-top: auto;
            padding-top: 18px;
        }

        .logout-form {
            margin: 0;
        }

        .logout-button {
            width: 100%;
            background: transparent;
            border: 0;
            text-align: left;
        }

        .main-content {
            margin-left: 212px;
            padding: 28px 30px 36px;
            background: #f5f6fb;
            min-height: 100vh;
            overflow-x: hidden;
            max-width: calc(100vw - 212px);
            border-radius: 42px 0 0 42px;
        }

        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
        }

        /* Modal fixes */
        .modal-content {
            max-width: calc(100vw - 40px);
            margin: 0 auto;
        }

        /* Service grid fixes */
        .service-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1rem;
        }

        /* Form fixes */
        .form-group input,
        .form-group select,
        .form-group textarea {
            max-width: 100%;
            box-sizing: border-box;
        }

        /* Card fixes */
        .content-card,
        .service-card {
            max-width: 100%;
            box-sizing: border-box;
        }

        .main-header {
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #e9ecef;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0D1F35;
            margin: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .search-bar {
            position: relative;
        }

        .search-bar input {
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            width: 250px;
            outline: none;
        }

        .search-bar i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .notification-icon, .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s;
        }

        .notification-icon {
            background: #f8f9fa;
            color: #666;
            position: relative;
        }

        .notification-icon:hover {
            background: #e9ecef;
        }

        .notification-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            background: #ff4757;
            border-radius: 50%;
        }

        .user-avatar {
            background: #C85A2A;
            color: white;
            font-weight: 600;
        }

        /* Content Card Styles */
        .content-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid #e9ecef;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid #e0e0e0;
        }

        .filter-tab {
            padding: 0.75rem 1.5rem;
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            position: relative;
            transition: color 0.3s;
        }

        .filter-tab:hover {
            color: #0D1F35;
        }

        .filter-tab.active {
            color: #C85A2A;
        }

        .filter-tab.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background: #C85A2A;
        }

        .filter-tab .count {
            background: #f0f0f0;
            padding: 0.2rem 0.5rem;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-left: 0.5rem;
        }

        .filter-tab.active .count {
            background: #C85A2A;
            color: white;
        }

        /* Status Badges */
        .status-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-badge.approved {
            background: #d4edda;
            color: #155724;
        }

        .status-badge.pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-badge.rejected {
            background: #f8d7da;
            color: #721c24;
        }

        .status-badge.active {
            background: #cce5ff;
            color: #004085;
        }

        .status-badge.completed {
            background: #d1ecf1;
            color: #0c5460;
        }

        /* Service Cards */
        .service-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1rem;
        }

        .service-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid #e9ecef;
        }

        .service-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .service-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .service-card-content {
            padding: 1.5rem;
        }

        .service-card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #0D1F35;
            margin-bottom: 0.5rem;
        }

        .service-card-price {
            color: #C85A2A;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .service-card-description {
            color: #666;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .service-card-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-edit {
            background: #0D1F35;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-edit:hover {
            background: #1a2b42;
        }

        .btn-delete {
            background: white;
            color: #0D1F35;
            border: 1px solid #0D1F35;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-delete:hover {
            background: #0D1F35;
            color: white;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            max-width: 600px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #0D1F35;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #999;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #0D1F35;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #C85A2A;
        }

        .btn-primary {
            background: #C85A2A;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #a84520;
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #666;
            border: 1px solid #e0e0e0;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background: #e9ecef;
        }

        @media (max-width: 991px) {
            #sidebar-wrapper {
                position: relative;
                width: 100%;
                height: auto;
                padding-bottom: 8px;
            }

            .main-content {
                margin-left: 0;
                max-width: 100%;
                border-radius: 28px 28px 0 0;
                padding: 22px 18px 28px;
            }

            .sidebar-menu {
                min-height: auto;
            }

            .logout-item {
                margin-top: 8px;
            }

            .service-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @yield('page_css')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css?v=1') }}">
    @yield('css')
</head>

<body>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="main-sidebar main-sidebar-postion bg-dark pb-5">
                @include('layouts.sidebar')
            </div>
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
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
