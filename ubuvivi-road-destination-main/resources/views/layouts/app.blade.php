<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover' name='viewport'>
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
        :root {
            --admin-sidebar-width: 232px;
            --admin-shell-bg: #0e2a38;
            --admin-surface: #f6f7fb;
            --admin-curve: 40px;
        }

        * {
            box-sizing: border-box;
        }

        /* Touch target minimum sizes */
        a, button, [role="button"], input[type="submit"], input[type="button"] {
            min-height: 44px;
        }

        /* Text overflow safety net */
        td, th {
            overflow-wrap: break-word;
            word-break: break-word;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--admin-shell-bg) !important;
            color: #183247;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden !important;
        }

        html {
            min-height: 100%;
            overflow-x: hidden !important;
        }

        #app {
            min-height: 100vh;
        }

        .main-wrapper.main-wrapper-1 {
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            background: var(--admin-shell-bg);
            overflow-x: hidden;
        }

        .file-preview {
            background-color: var(--light)
        }

        .file-caption-name:not(.file-caption-disabled) {
            background-color: var(--light) !important;
        }

        #sidebar-wrapper {
            background: var(--admin-shell-bg) !important;
            width: 100%;
            position: sticky;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
            padding: 18px 0 20px;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 12px 22px 20px;
        }

        .admin-sidebar-brand-link {
            display: flex;
            align-items: center;
            gap: 11px;
            text-decoration: none;
        }

        .admin-sidebar-brand-link:hover {
            text-decoration: none;
        }

        .admin-sidebar-logo {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,.14);
        }

        .admin-sidebar-brand-text {
            color: white;
            font-size: 15px;
            font-weight: 500;
            letter-spacing: -.02em;
        }

        .sidebar-menu {
            list-style: none;
            padding: 22px 0 0;
            margin: 0;
            min-height: calc(100vh - 104px);
            display: flex;
            flex-direction: column;
        }

        .side-menus {
            margin: 0 12px 8px;
        }

        .side-menus .nav-link {
            color: rgba(255,255,255,.88);
            padding: 12px 18px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: background .2s, color .2s;
            border-left: none;
            font-size: 15px;
            font-weight: 500;
            border-radius: 999px;
            gap: 14px;
        }

        .side-menus .nav-link:hover {
            color: rgba(255,255,255,.98);
            background: rgba(255,255,255,.07);
            text-decoration: none;
        }

        .side-menus.active .nav-link {
            color: #fff;
            background: linear-gradient(90deg, #1795ef 0%, #2ea4f4 100%);
            border-left: none;
            border-radius: 999px;
            box-shadow: 0 10px 24px rgba(23, 149, 239, .26);
        }

        .side-menus .nav-link i {
            width: 20px;
            margin-right: 2px;
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

        .main-sidebar.main-sidebar-postion {
            width: var(--admin-sidebar-width);
            min-width: var(--admin-sidebar-width);
            flex: 0 0 var(--admin-sidebar-width);
            background: var(--admin-shell-bg) !important;
            padding-bottom: 0 !important;
        }

        .main-content {
            position: relative;
            flex: 1 1 auto;
            min-width: 0;
            width: auto;
            margin-left: 0;
            padding: 28px 32px 42px;
            background: var(--admin-surface);
            min-height: 100vh;
            overflow-x: hidden !important;
            border-radius: var(--admin-curve) 0 0 var(--admin-curve);
            box-shadow: inset 0 1px 0 rgba(255,255,255,.55);
        }

        .main-content::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 1px;
            background: rgba(223, 228, 238, .45);
            pointer-events: none;
        }

        .main-content > * {
            max-width: 100%;
        }

        .admin-stage {
            width: 100%;
            max-width: 1120px;
            margin: 0 auto;
        }

        .admin-stage > * {
            max-width: 100%;
        }

        .main-content table {
            width: 100%;
        }

        .main-content th,
        .main-content td {
            overflow-wrap: anywhere;
        }

        /* Prevent action-column button text from wrapping letter-by-letter */
        .tbl-actions { display: flex; gap: 8px; flex-wrap: wrap; align-items: center; }
        .tbl-actions button,
        .tbl-actions a { white-space: nowrap !important; }
        td:has(.tbl-actions) { white-space: nowrap; }

        .main-content .table-responsive,
        .main-content .table-wrap,
        .main-content .req-panel,
        .main-content .users-panel,
        .main-content .table-shell {
            max-width: 100%;
        }

        .admin-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
        }

        .admin-page-title {
            margin: 0;
            color: #2d313d;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -.03em;
        }

        .admin-page-tools {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-left: auto;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .admin-page-search {
            display: flex;
            align-items: center;
            gap: 10px;
            width: var(--admin-search-width, 418px);
            max-width: 100%;
            height: 46px;
            padding: 0 15px;
            background: #fff;
            border: 1px solid #dfe4ee;
            border-radius: 4px;
        }

        .admin-page-search i {
            color: #b5bfcc;
            font-size: 14px;
        }

        .admin-page-search input {
            width: 100%;
            border: 0;
            outline: 0;
            background: transparent;
            color: #4b5563;
            font-size: 14px;
        }

        .admin-page-search input::placeholder {
            color: #b5bfcc;
        }

        .admin-page-icon,
        .admin-page-avatar {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .admin-page-icon {
            position: relative;
            border: 0;
            background: transparent;
            color: #23384d;
            font-size: 16px;
        }

        .admin-page-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #ef4444;
            border: 2px solid #f4f6fb;
        }

        .admin-page-avatar {
            background: #122c3b;
            color: #fff;
            font-size: 22px;
            font-weight: 700;
        }

        .admin-primary-btn {
            border: 0;
            background: #122c3b;
            color: #fff;
            height: 40px;
            padding: 0 18px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            box-shadow: 0 10px 20px rgba(18, 44, 59, .12);
            transition: background .18s ease, transform .18s ease;
        }

        .admin-primary-btn:hover {
            background: #0f2431;
            transform: translateY(-1px);
            color: #fff;
            text-decoration: none;
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

            .main-sidebar.main-sidebar-postion {
                width: 100%;
                min-width: 0;
                flex-basis: auto;
            }

            .main-wrapper.main-wrapper-1 {
                display: block;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                border-radius: 28px 28px 0 0;
                padding: 24px 18px 32px;
            }

            .admin-page-tools {
                width: 100%;
            }

            .admin-page-search {
                width: 100%;
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

        @media (max-width: 767px) {
            .main-content {
                padding: 16px 12px 24px;
                border-radius: 0;
            }

            .admin-page-title {
                font-size: 22px;
            }

            .admin-stage {
                padding: 0;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 12px 10px 20px;
            }

            .admin-page-title {
                font-size: 18px;
            }
        }
    </style>
    @yield('page_css')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css?v=1') }}">
    @yield('css')
    <style>
        /* ── Page progress bar ── */
        #page-bar {
            position: fixed; top: 0; left: 0; height: 3px;
            background: linear-gradient(90deg, #C85A2A, #e87a42, #C85A2A);
            background-size: 200% 100%;
            z-index: 99999; width: 0; opacity: 0;
            transition: width .3s ease, opacity .4s ease;
            animation: bar-move 1.2s linear infinite;
        }
        #page-bar.running { opacity: 1; }
        @keyframes bar-move { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

        /* ── Skeleton shimmer ── */
        @keyframes skel-shine {
            0%   { background-position: -200% 0; }
            100% { background-position:  200% 0; }
        }
        .skel {
            background: linear-gradient(90deg,#f0f2f5 25%,#e4e6ea 50%,#f0f2f5 75%);
            background-size: 200% 100%;
            animation: skel-shine 1.4s ease-in-out infinite;
            border-radius: 5px; display: block;
        }
        .skel-row td { padding: 14px 16px !important; border-bottom: 1px solid #f0f2f7; }
        .skel-row td .skel { height: 14px; border-radius: 4px; }
        .skel-row td .skel.short { width: 55%; }
        .skel-row td .skel.icon { width: 28px; height: 28px; border-radius: 50%; }

        /* fade-in for real rows after skeleton removed */
        @keyframes row-in {
            from { opacity: 0; transform: translateY(4px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .row-loaded { animation: row-in .25s ease forwards; }
    </style>
</head>

<body>
<div id="page-bar"></div>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="main-sidebar main-sidebar-postion bg-dark pb-5">
                @include('layouts.sidebar')
            </div>
            <!-- Main Content -->
            <div class="main-content">
                <div class="admin-stage">
                    @yield('content')
                </div>
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

<script>
(function () {
    /* ── Progress bar ── */
    var bar = document.getElementById('page-bar');
    function barStart() {
        if (!bar) return;
        bar.style.width = '0';
        bar.classList.add('running');
        setTimeout(function () { bar.style.width = '75%'; }, 10);
    }
    function barDone() {
        if (!bar) return;
        bar.style.width = '100%';
        setTimeout(function () {
            bar.classList.remove('running');
            setTimeout(function () { bar.style.width = '0'; }, 400);
        }, 200);
    }
    barStart();
    window.addEventListener('load', barDone);
    document.addEventListener('click', function (e) {
        var a = e.target.closest('a[href]');
        if (!a) return;
        var h = a.getAttribute('href') || '';
        if (h.charAt(0) === '#' || h.indexOf('javascript') === 0 || a.target === '_blank') return;
        barStart();
    });
    document.addEventListener('submit', function () { barStart(); });

    /* ── Skeleton rows → real content ── */
    document.addEventListener('DOMContentLoaded', function () {
        /* Remove skeleton rows */
        document.querySelectorAll('.skel-row').forEach(function (r) {
            r.style.display = 'none';
        });
        /* Animate real rows in */
        document.querySelectorAll('[data-searchable]').forEach(function (el, i) {
            el.style.animationDelay = (i * 25) + 'ms';
            el.classList.add('row-loaded');
        });

        /* ── Universal search ── */
        var si = document.querySelector('.admin-page-search input');
        if (!si) return;
        si.addEventListener('input', function () {
            var searchables = document.querySelectorAll('[data-searchable]');
            if (!searchables.length) return;
            var val = this.value.toLowerCase().trim();
            searchables.forEach(function (el) {
                el.style.display = (!val || el.textContent.toLowerCase().includes(val)) ? '' : 'none';
            });
        });
    });
})();
</script>

@yield('scripts')

</html>
