<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no, viewport-fit=cover" name="viewport">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <link href="{{ asset('assets/css/bootstrap.min.css?v=1') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css?v=1') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png?v=1') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600;1,700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @include('layouts.partials.public_navbar_styles')

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background: url('{{ asset("assets/images/backgrounds/bg_9.jpg") }}') center center / cover no-repeat fixed;
            font-family: 'Poppins', sans-serif;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: linear-gradient(180deg, rgba(7,20,31,.52) 0%, rgba(7,20,31,.62) 100%);
            z-index: 0;
        }

        .auth-page {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: calc(var(--navbar-height) + 48px) 20px 40px;
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
            font-family: 'Playfair Display', serif;
        }

        .auth-field {
            display: flex;
            align-items: center;
            background: rgba(255,255,255,.12);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,.35);
            border-radius: 8px;
            margin-bottom: 14px;
            overflow: hidden;
            transition: border-color .2s;
        }

        .auth-field:focus-within {
            border-color: rgba(255,255,255,.75);
        }

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

        .auth-field input::placeholder {
            color: rgba(255,255,255,.65);
        }

        .auth-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .auth-row label,
        .auth-row a,
        .auth-row span {
            color: rgba(255,255,255,.85);
            font-size: 13px;
            text-decoration: none;
        }

        .auth-row a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .auth-row input[type="checkbox"] {
            margin-right: 6px;
        }

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

        .auth-footer-link {
            color: rgba(255,255,255,.75);
            font-size: 13px;
        }

        .auth-footer-link a {
            color: #fff;
            font-weight: 600;
            text-decoration: underline;
        }

        .auth-footer-link a:hover {
            color: var(--orange);
        }

        .auth-errors {
            background: rgba(220,53,69,.25);
            border: 1px solid rgba(220,53,69,.5);
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 16px;
            text-align: left;
        }

        .auth-errors ul {
            padding-left: 16px;
            margin: 0;
        }

        .auth-errors li {
            color: #ffaaaa;
            font-size: 13px;
        }
    </style>
</head>
<body>
    @include('layouts.partials.public_navbar')

    <div class="auth-page">
        <div class="auth-box">
            <img src="{{ asset('assets/images/logo.png?v=1') }}" alt="Ubuvivi Tours" class="auth-logo">
            <h1 class="auth-title">UBUVIVI Tours</h1>
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script>
        window.addEventListener('scroll', function () {
            var nav = document.getElementById('mainNavbar');
            if (nav) {
                if (window.scrollY > 24) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            }
        });
    </script>
</body>
</html>
