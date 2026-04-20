<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <link href="{{ asset('assets/css/bootstrap.min.css?v=1') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css?v=1') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png?v=1') }}">
    <style>
        :root {
            --orange: #C85A2A;
            --navy: #0D1F35;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }

        /* ── Full-page background ── */
        body {
            min-height: 100vh;
            background: url('{{ asset("assets/images/backgrounds/bg_9.jpg") }}') center center / cover no-repeat fixed;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 0;
        }

        /* ── Navbar ── */
        .auth-navbar {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 40px;
            background: rgba(13,31,53,.65);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        .auth-navbar .brand img { height: 50px; }
        .auth-navbar .nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
        }
        .auth-navbar .nav-links a {
            color: rgba(255,255,255,.88);
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            padding: 6px 14px;
            transition: color .2s;
        }
        .auth-navbar .nav-links a:hover,
        .auth-navbar .nav-links a.active { color: #fff; }
        .auth-navbar .nav-links .active { border-bottom: 2px solid var(--orange); }
        .auth-navbar .dropdown { position: relative; }
        .auth-navbar .dropdown-toggle::after {
            content: ' ▾';
            font-size: 11px;
        }
        .auth-navbar .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: var(--navy);
            border-radius: 10px;
            min-width: 180px;
            padding: 8px 0;
            box-shadow: 0 8px 30px rgba(0,0,0,.3);
            z-index: 100;
            list-style: none;
        }
        .auth-navbar .dropdown:hover .dropdown-menu { display: block; }
        .auth-navbar .dropdown-menu a {
            display: block;
            padding: 10px 20px;
            color: #fff;
            font-size: 14px;
        }
        .auth-navbar .dropdown-menu a:hover { background: var(--orange); }
        .plan-btn {
            background: var(--navy);
            color: #fff;
            border-radius: 50px;
            padding: 10px 22px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background .2s;
            white-space: nowrap;
        }
        .plan-btn:hover { background: var(--orange); color: #fff; text-decoration: none; }

        /* ── Auth page content ── */
        .auth-page {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 82px);
            padding: 40px 20px;
        }
        .auth-box {
            width: 100%;
            max-width: 480px;
            text-align: center;
        }
        .auth-logo {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 12px;
            border: 3px solid rgba(255,255,255,.3);
        }
        .auth-title {
            color: #fff;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 28px;
            letter-spacing: .5px;
        }

        /* ── Input fields ── */
        .auth-field {
            display: flex;
            align-items: center;
            background: rgba(255,255,255,.12);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            border: 1px solid rgba(255,255,255,.35);
            border-radius: 8px;
            margin-bottom: 14px;
            overflow: hidden;
            transition: border-color .2s;
        }
        .auth-field:focus-within { border-color: rgba(255,255,255,.75); }
        .auth-field .field-icon {
            width: 48px;
            min-width: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,.8);
            font-size: 16px;
            border-right: 1px solid rgba(255,255,255,.3);
            height: 50px;
        }
        .auth-field input {
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            padding: 14px 16px;
            color: #fff;
            font-size: 14px;
        }
        .auth-field input::placeholder { color: rgba(255,255,255,.65); }

        /* ── Checkbox row ── */
        .auth-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 8px;
        }
        .auth-row label, .auth-row a, .auth-row span {
            color: rgba(255,255,255,.85);
            font-size: 13px;
            text-decoration: none;
        }
        .auth-row a:hover { color: #fff; text-decoration: underline; }
        .auth-row input[type="checkbox"] { margin-right: 6px; }

        /* ── Submit button ── */
        .auth-submit {
            width: 100%;
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255,255,255,.6);
            border-radius: 8px;
            padding: 14px;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            margin-bottom: 16px;
            transition: background .2s, border-color .2s;
        }
        .auth-submit:hover {
            background: var(--orange);
            border-color: var(--orange);
        }

        /* ── Footer link ── */
        .auth-footer-link {
            color: rgba(255,255,255,.75);
            font-size: 13px;
        }
        .auth-footer-link a {
            color: #fff;
            font-weight: 600;
            text-decoration: underline;
        }
        .auth-footer-link a:hover { color: var(--orange); }

        /* ── Error alerts ── */
        .auth-errors {
            background: rgba(220,53,69,.25);
            border: 1px solid rgba(220,53,69,.5);
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 16px;
            text-align: left;
        }
        .auth-errors ul { padding-left: 16px; margin: 0; }
        .auth-errors li { color: #ffaaaa; font-size: 13px; }

        @media (max-width: 575px) {
            .auth-navbar { padding: 12px 16px; }
            .auth-navbar .nav-links { display: none; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="auth-navbar">
        <a class="brand" href="{{ route('guest.home') }}">
            <img src="{{ asset('assets/images/logo.png?v=1') }}" alt="Ubuvivi Tours">
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('guest.home') }}">Home</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Services</a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/tours') }}">Tours & Travel</a></li>
                    <li><a href="{{ url('/cars') }}">Car Rentals</a></li>
                    <li><a href="{{ route('guest.services') }}">Transfer</a></li>
                    <li><a href="{{ route('guest.events') }}">Event Planning</a></li>
                </ul>
            </li>
            <li><a href="{{ route('guest.contact') }}">Contact</a></li>
            <li><a href="{{ route('login') }}" class="active">My Account</a></li>
        </ul>
        <a href="{{ url('/tours') }}" class="plan-btn">Plan Your Trip</a>
    </nav>

    <!-- Auth content -->
    <div class="auth-page">
        <div class="auth-box">
            <img src="{{ asset('assets/images/logo.png?v=1') }}" alt="Ubuvivi Tours" class="auth-logo">
            <h1 class="auth-title">UBUVIVI Tours</h1>
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
