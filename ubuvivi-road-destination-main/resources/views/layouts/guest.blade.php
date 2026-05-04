<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title', 'Ubuvivi Tours & Safaris')</title>
        @yield('meta')
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="google-site-verification" content="3Jiqxe_pR4TUfsKpSTiWC5bMXT6ksTJLbK_LDqoCmFU">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png?v=1') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favsliicon-32x32.png?v=1') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png?v=1') }}">
        <link rel="manifest" href="{{ asset('img/site.webmanifest?v=1') }}">
        <link rel="mask-icon" href="{{ asset('img/safari-pinned-tab.svg?v=1') }}" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css?v=1') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css?v=1') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/aos.css?v=1') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css?v=1') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css?v=1') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick-theme.css?v=1') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css?v=1') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/nice-select.css?v=1') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-ui.css?v=1') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css?v=1') }}">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600;1,700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset('assets/owl-carousel/assets/owl.carousel.min.css?v=1') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/owl-carousel/assets/owl.theme.default.min.css?v=1') }}" rel="stylesheet" type="text/css">
        <style>
            :root {
                --orange: #C85A2A;
                --navy: #0D1F35;
                --navy-light: #162032;
            }

            /* ── Global fonts ── */
            body, p, a, li, span, input, textarea, button, select, label {
                font-family: 'Poppins', sans-serif !important;
            }
            h1, h2, h3, h4, h5, h6 {
                font-family: 'Playfair Display', serif !important;
            }

            /* ── Hard resets to prevent old style.css conflicts ── */
            main { padding: 0 !important; margin: 0 !important; overflow-x: hidden; }
            .header_section, .header_top, .header_bottom { display: none !important; }
            section { padding: 0; margin: 0; }
            .backtotop { z-index: 999; }

            pre { white-space: pre-line; }

            /* ── Navbar ── */
            .ubu-navbar {
                position: absolute;
                top: 0; left: 0; right: 0;
                z-index: 1000;
                padding: 18px 40px;
                background: rgba(13, 31, 53, 0.35);
                backdrop-filter: blur(14px);
                -webkit-backdrop-filter: blur(14px);
                border-bottom: 1px solid rgba(255,255,255,0.08);
            }
            .ubu-navbar .navbar-brand img { height: 60px; }
            .ubu-navbar .nav-link {
                color: #fff !important;
                font-weight: 500;
                font-size: 15px;
                padding: 6px 14px !important;
                transition: color .2s;
            }
            .ubu-navbar .nav-link:hover,
            .ubu-navbar .nav-link.active-link { color: var(--orange) !important; }
            .ubu-navbar .navbar-toggler { border-color: rgba(255,255,255,.5); }
            .ubu-navbar .navbar-toggler-icon { filter: invert(1); }
            .ubu-navbar.scrolled {
                position: fixed;
                background: var(--navy);
                box-shadow: 0 2px 20px rgba(0,0,0,.4);
                padding: 10px 40px;
                transition: all .3s;
            }
            .plan-trip-btn {
                background: var(--navy);
                color: #fff !important;
                border-radius: 50px;
                padding: 10px 24px;
                font-weight: 600;
                font-size: 14px;
                border: none;
                transition: background .2s;
                white-space: nowrap;
            }
            .plan-trip-btn:hover { background: var(--orange); color: #fff !important; text-decoration: none; }
            .ubu-navbar .dropdown-menu {
                border: none;
                border-radius: 10px;
                box-shadow: 0 8px 30px rgba(0,0,0,.15);
                background: var(--navy);
                min-width: 180px;
            }
            .ubu-navbar .dropdown-item {
                color: #fff;
                padding: 10px 20px;
                font-size: 14px;
            }
            .ubu-navbar .dropdown-item:hover { background: var(--orange); color: #fff; }

            /* Non-hero pages: navbar is sticky solid navy */
            body:not(.hero-page) .ubu-navbar {
                position: relative;
                background: var(--navy);
            }

            /* ── Footer ── */
            .ubu-footer { background: var(--navy); color: #fff; padding-top: 60px; }
            .ubu-footer a { color: rgba(255,255,255,.8); text-decoration: none; }
            .ubu-footer a:hover { color: var(--orange); }

            /* Subscribe row */
            .ubu-footer .footer-subscribe-row {
                background: rgba(255,255,255,.07);
                border-radius: 16px;
                padding: 40px 48px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 24px;
                margin-bottom: 60px;
            }
            .ubu-footer .footer-subscribe-text h3 { font-size: 24px; font-weight: 700; margin: 0; color: #fff; }
            .ubu-footer .footer-subscribe-text p { color: rgba(255,255,255,.65); margin: 6px 0 0; font-size: 14px; }
            .ubu-footer .subscribe-form {
                display: flex;
                background: #fff;
                border-radius: 50px;
                overflow: hidden;
                min-width: 360px;
            }
            .ubu-footer .subscribe-form input {
                border: none;
                outline: none;
                padding: 14px 20px;
                flex: 1;
                font-size: 14px;
                color: #333;
                font-family: 'Poppins', sans-serif;
            }
            .ubu-footer .subscribe-form button {
                background: var(--orange);
                border: none;
                color: #fff;
                padding: 14px 28px;
                font-weight: 600;
                font-size: 14px;
                cursor: pointer;
                border-radius: 50px;
                transition: background .2s;
                font-family: 'Poppins', sans-serif;
            }
            .ubu-footer .subscribe-form button:hover { background: #a84520; }

            /* 3-column row */
            .ubu-footer .footer-cols-row {
                display: flex;
                gap: 40px;
                flex-wrap: wrap;
                margin-bottom: 10px;
            }
            .ubu-footer .footer-col { flex: 1; min-width: 200px; }
            .ubu-footer .footer-col-brand { flex: 1.3; }

            /* Brand col: logo + address side by side */
            .ubu-footer .footer-logo-wrap {
                display: flex;
                align-items: flex-start;
                gap: 16px;
                margin-bottom: 20px;
            }
            .ubu-footer .footer-logo-wrap img { height: 60px; flex-shrink: 0; }
            .ubu-footer .footer-brand-info { display: flex; flex-direction: column; gap: 4px; }
            .ubu-footer .footer-addr-label { font-size: 12px; font-weight: 600; color: rgba(255,255,255,.5); text-transform: uppercase; letter-spacing: .5px; }
            .ubu-footer .footer-addr-text { font-size: 13px; color: rgba(255,255,255,.7); line-height: 1.6; }

            /* Social icons */
            .ubu-footer .footer-socials { display: flex; gap: 10px; }
            .ubu-footer .footer-socials a {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 36px; height: 36px;
                border-radius: 50%;
                background: rgba(255,255,255,.1);
                color: #fff;
                font-size: 14px;
                transition: background .2s;
            }
            .ubu-footer .footer-socials a:hover { background: var(--orange); color: #fff; }

            /* Quick links + contact cols */
            .ubu-footer .footer-col-title { font-size: 16px; font-weight: 700; margin-bottom: 18px; color: #fff; font-family: 'Playfair Display', serif !important; }
            .ubu-footer .footer-links { padding-left: 0; margin: 0; }
            .ubu-footer .footer-links li { margin-bottom: 10px; list-style: none; font-size: 14px; }
            .ubu-footer .contact-item { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 14px; }
            .ubu-footer .contact-icon {
                width: 36px; height: 36px; min-width: 36px;
                border-radius: 50%;
                background: rgba(255,255,255,.1);
                display: flex; align-items: center; justify-content: center;
                font-size: 14px; color: #fff;
            }
            .ubu-footer .contact-text { font-size: 13px; color: rgba(255,255,255,.8); line-height: 1.7; }

            /* Divider + copyright */
            .ubu-footer .footer-divider { border-color: rgba(255,255,255,.1); margin: 30px 0 0; }
            .ubu-footer .copyright { font-size: 13px; color: rgba(255,255,255,.45); text-align: center; padding: 18px 0 24px; margin: 0; }

            @media (max-width: 767px) {
                .ubu-footer .footer-subscribe-row { flex-direction: column; padding: 28px 24px; }
                .ubu-footer .subscribe-form { min-width: 100%; }
                .ubu-footer .footer-cols-row { flex-direction: column; gap: 32px; }
            }
        </style>
        @yield('css')
    </head>

    <body class="@yield('body-class')">
        <div id="thetop"></div>
        <div class="backtotop bg-dark-1"><a href="#" class="scroll"><i class="far fa-arrow-up"></i></a></div>

        <!-- Navbar -->
        <nav class="ubu-navbar navbar navbar-expand-lg" id="mainNavbar">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/images/logo.png?v=1') }}" alt="Ubuvivi Tours">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenu" aria-controls="navMenu" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navMenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('/')) active-link @endif" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('our-services*') || request()->is('tours*') || request()->is('cars*') || request()->is('services*') || request()->is('events*') || request()->is('air-ticketing*')) active-link @endif"
                           href="{{ route('guest.all_services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('contact*')) active-link @endif" href="{{ route('guest.contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        @auth
                            <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                My Account
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
                                <a class="dropdown-item" href="{{ url('/home') }}">Dashboard</a>
                                <a class="dropdown-item" href="#"
                                   onclick="event.preventDefault(); document.getElementById('guest-logout-form').submit();">
                                    Logout
                                </a>
                            </div>
                            <form id="guest-logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a class="nav-link @if(request()->is('login*')) active-link @endif" href="{{ route('login') }}">My Account</a>
                        @endauth
                    </li>
                </ul>
            </div>
            <a href="{{ url('/tours') }}" class="plan-trip-btn ml-lg-3 d-none d-lg-inline-block">Plan Your Trip</a>
        </nav>

        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="ubu-footer">
            <div class="container">

                <!-- Subscribe row -->
                <div class="footer-subscribe-row">
                    <div class="footer-subscribe-text">
                        <h3>Let's Plan Your Next Journey</h3>
                        <p>Get updates on tours, travel tips, and exclusive offers across Rwanda.</p>
                    </div>
                    <form class="subscribe-form" onsubmit="return false;">
                        <input type="email" placeholder="Enter your Email">
                        <button type="submit">Subscribe</button>
                    </form>
                </div>

                <!-- 3-column row -->
                <div class="footer-cols-row">
                    <!-- Col 1: Logo + address + social -->
                    <div class="footer-col footer-col-brand">
                        <div class="footer-logo-wrap">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('assets/images/logo.png?v=1') }}" alt="Ubuvivi Tours">
                            </a>
                            <div class="footer-brand-info">
                                <span class="footer-addr-label">Main Office Address:</span>
                                <span class="footer-addr-text">Remera - Kisimenti KG11 Ave, Amahoro Stadium Road, Ikaze house, 3rd floor.</span>
                            </div>
                        </div>
                        <div class="footer-socials">
                            <a href="https://www.facebook.com/profile.php?id=100077752760078" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/ubuvivitours/" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#!" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>

                    <!-- Col 2: Quick Links -->
                    <div class="footer-col footer-col-links">
                        <p class="footer-col-title">Quick Links</p>
                        <ul class="footer-links">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ route('guest.all_services') }}">Services</a></li>
                            <li><a href="{{ url('/tours') }}">Tours & Travel</a></li>
                            <li><a href="{{ url('/cars') }}">Car Rentals</a></li>
                            <li><a href="{{ route('guest.transfer') }}">Transfer</a></li>
                            <li><a href="{{ route('guest.contact') }}">Contact</a></li>
                            <li><a href="{{ route('login') }}">My account</a></li>
                        </ul>
                    </div>

                    <!-- Col 3: Contact -->
                    <div class="footer-col footer-col-contact">
                        <p class="footer-col-title">Contact</p>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                            <div class="contact-text">
                                <a href="mailto:ubuvivitours@gmail.com">ubuvivitours@gmail.com</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-phone"></i></div>
                            <div class="contact-text">
                                <a href="tel:+250789044222">+250 789 044 222</a><br>
                                <a href="tel:+250783123089">+250 783 123 089</a><br>
                                <a href="tel:+250787229916">+250 787 229 916</a>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="footer-divider">
                <p class="copyright">Copyright © 2020. Ubuvivi Car Rental &amp; Tours.</p>
            </div>
        </footer>

        <script defer="defer" src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
        <script defer="defer" src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script defer="defer" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script defer="defer" src="{{ asset('assets/js/aos.js') }}"></script>
        <script defer="defer" src="{{ asset('assets/js/slick.min.js') }}"></script>
        <script defer="defer" src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
        <script defer="defer" src="{{ asset('assets/js/nice-select.min.js') }}"></script>
        <script defer="defer" src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
        <script defer="defer" src="{{ asset('assets/js/jquery-ui.js') }}"></script>
        <script defer="defer" src="{{ asset('assets/js/validate.js') }}"></script>
        <script defer="defer" src="{{ asset('assets/js/mCustomScrollbar.js') }}"></script>
        <script defer="defer" src="{{ asset('assets/js/custom.js') }}"></script>
        <script defer="defer" src="{{ asset('assets/owl-carousel/owl.carousel.min.js') }}"></script>
        <script>
            // Sticky navbar on scroll — only on hero page
            if (document.body.classList.contains('hero-page')) {
                window.addEventListener('scroll', function () {
                    var nav = document.getElementById('mainNavbar');
                    if (nav) {
                        if (window.scrollY > 80) {
                            nav.classList.add('scrolled');
                        } else {
                            nav.classList.remove('scrolled');
                        }
                    }
                });
            }
        </script>
        @yield('scripts')
        <!-- Google tag (gtag.js) -->
        <script defer="defer" async src="https://www.googletagmanager.com/gtag/js?id=G-NK2XGT17DH"></script>
        <script defer="defer">
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', 'G-NK2XGT17DH');
        </script>
        <script defer="defer">
            document.addEventListener('DOMContentLoaded', function() {
                var url = 'https://wati-integration-service.clare.ai/ShopifyWidget/shopifyWidget.js?41437';
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = url;
                var options = {
                    "enabled": true,
                    "chatButtonSetting": {
                        "backgroundColor": "#4dc247",
                        "ctaText": "",
                        "borderRadius": "25",
                        "marginLeft": "0",
                        "marginBottom": "20",
                        "marginRight": "15",
                        "position": "right"
                    },
                    "brandSetting": {
                        "brandName": "Ubuvivi Tours",
                        "brandSubTitle": "",
                        "brandImg": "https://cdn.clare.ai/wati/images/WATI_logo_square_2.png",
                        "welcomeText": "Hi there!\nHow can We help you?",
                        "messageText": "",
                        "backgroundColor": "#0a5f54",
                        "ctaText": "Start Chat",
                        "borderRadius": "25",
                        "autoShow": false,
                        "phoneNumber": "250783123089"
                    }
                };
                s.onload = function() { CreateWhatsappChatWidget(options); };
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            });
        </script>
    </body>

</html>
