<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no,viewport-fit=cover">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Ubuvivi Tours & Safaris')</title>
    @yield('meta')
    <link rel="canonical" href="{{ url()->current() }}">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
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
        @include('layouts.partials.public_navbar_styles')

        body, p, a, li, span, input, textarea, button, select, label {
            font-family: 'Poppins', sans-serif !important;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif !important;
        }

        body {
            background:
                radial-gradient(circle at top left, rgba(200,90,42,.08), transparent 28%),
                linear-gradient(180deg, #f7f8fb 0%, #f4f7fb 100%);
            color: #23364a;
        }

        main {
            padding: 0 !important;
            margin: 0 !important;
            overflow-x: hidden;
        }

        .header_section,
        .header_top,
        .header_bottom {
            display: none !important;
        }

        section {
            padding: 0;
            margin: 0;
        }

        .backtotop {
            z-index: 999;
        }

        pre {
            white-space: pre-line;
        }

        body:not(.hero-page) main {
            padding-top: calc(var(--navbar-height) + 16px) !important;
        }

        body.hero-page .ubu-navbar {
            background: rgba(13, 31, 53, 0.42);
        }

        .ubu-footer {
            background: var(--navy);
            color: #fff;
            padding-top: 60px;
        }

        .ubu-footer a {
            color: rgba(255,255,255,.8);
            text-decoration: none;
        }

        .ubu-footer a:hover {
            color: var(--orange);
        }

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

        .ubu-footer .footer-subscribe-text h3 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            color: #fff;
        }

        .ubu-footer .footer-subscribe-text p {
            color: rgba(255,255,255,.65);
            margin: 6px 0 0;
            font-size: 14px;
        }

        .ubu-footer .subscribe-form {
            display: flex;
            background: #fff;
            border-radius: 50px;
            overflow: hidden;
            width: min(100%, 360px);
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

        .ubu-footer .subscribe-form button:hover {
            background: #a84520;
        }

        .ubu-footer .footer-cols-row {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .ubu-footer .footer-col {
            flex: 1;
            min-width: 200px;
        }

        .ubu-footer .footer-col-brand {
            flex: 1.3;
        }

        .ubu-footer .footer-logo-wrap {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 20px;
        }

        .ubu-footer .footer-logo-wrap img {
            height: 60px;
            flex-shrink: 0;
        }

        .ubu-footer .footer-brand-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .ubu-footer .footer-addr-label {
            font-size: 12px;
            font-weight: 600;
            color: rgba(255,255,255,.5);
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .ubu-footer .footer-addr-text {
            font-size: 13px;
            color: rgba(255,255,255,.7);
            line-height: 1.6;
        }

        .ubu-footer .footer-socials {
            display: flex;
            gap: 10px;
        }

        .ubu-footer .footer-socials a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,.1);
            color: #fff;
            font-size: 14px;
            transition: background .2s;
        }

        .ubu-footer .footer-socials a:hover {
            background: var(--orange);
            color: #fff;
        }

        .ubu-footer .footer-col-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 18px;
            color: #fff;
            font-family: 'Playfair Display', serif !important;
        }

        .ubu-footer .footer-links {
            padding-left: 0;
            margin: 0;
        }

        .ubu-footer .footer-links li {
            margin-bottom: 10px;
            list-style: none;
            font-size: 14px;
        }

        .ubu-footer .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
        }

        .ubu-footer .contact-icon {
            width: 36px;
            height: 36px;
            min-width: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #fff;
        }

        .ubu-footer .contact-text {
            font-size: 13px;
            color: rgba(255,255,255,.8);
            line-height: 1.7;
        }

        .ubu-footer .footer-divider {
            border-color: rgba(255,255,255,.1);
            margin: 30px 0 0;
        }

        .ubu-footer .copyright {
            font-size: 13px;
            color: rgba(255,255,255,.45);
            text-align: center;
            padding: 18px 0 24px;
            margin: 0;
        }

        @media (max-width: 767px) {
            .ubu-footer .footer-subscribe-row {
                flex-direction: column;
                padding: 24px 18px;
                gap: 16px;
            }

            .ubu-footer .subscribe-form {
                width: 100%;
            }

            .ubu-footer .footer-cols-row {
                flex-direction: column;
                gap: 24px;
            }
        }

        @media (max-width: 480px) {
            .ubu-footer {
                padding-top: 40px;
            }

            .ubu-footer .subscribe-form input {
                padding: 12px 14px;
                font-size: 13px;
            }

            .ubu-footer .subscribe-form button {
                padding: 12px 18px;
                font-size: 13px;
            }
        }
    </style>
    @yield('css')
    <style>
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
        /* Skeleton card for public listing pages */
        .skel-card { border-radius: 16px; overflow: hidden; background: #fff; box-shadow: 0 2px 12px rgba(0,0,0,.07); }
        .skel-card .skel-img  { height: 220px; border-radius: 0; }
        .skel-card .skel-body { padding: 20px 22px 24px; }
        .skel-card .skel-line { height: 13px; margin-bottom: 10px; border-radius: 4px; }
        .skel-card .skel-line.short { width: 55%; }
        .skel-card .skel-line.xshort { width: 35%; }
        .skel-card .skel-btn  { height: 38px; border-radius: 50px; margin-top: 16px; width: 45%; }

        @keyframes card-in {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .card-loaded { animation: card-in .3s ease forwards; }
    </style>
</head>

<body class="@yield('body-class')">
<div id="page-bar"></div>
<script>
(function(){
    var bar = document.getElementById('page-bar');
    function barStart(){
        if(!bar) return;
        bar.style.width='0'; bar.classList.add('running');
        setTimeout(function(){bar.style.width='75%';},10);
    }
    function barDone(){
        if(!bar) return;
        bar.style.width='100%';
        setTimeout(function(){
            bar.classList.remove('running');
            setTimeout(function(){bar.style.width='0';},400);
        },200);
    }
    barStart();
    window.addEventListener('load', barDone);
    document.addEventListener('click',function(e){
        var a=e.target.closest('a[href]');
        if(!a) return;
        var h=a.getAttribute('href')||'';
        if(h.charAt(0)==='#'||h.indexOf('javascript')===0||a.target==='_blank') return;
        barStart();
    });
    document.addEventListener('submit',function(){barStart();});
    /* Remove skeleton cards/rows once DOM is ready */
    document.addEventListener('DOMContentLoaded',function(){
        document.querySelectorAll('.skel-card-wrap').forEach(function(c){c.style.display='none';});
        document.querySelectorAll('.real-card').forEach(function(c,i){
            c.style.animationDelay=(i*40)+'ms';
            c.classList.add('card-loaded');
        });
    });
})();
</script>
    <div id="thetop"></div>
    <div class="backtotop bg-dark-1"><a href="#" class="scroll"><i class="far fa-arrow-up"></i></a></div>

    @include('layouts.partials.public_navbar')

    <main>
        @yield('content')
    </main>

    <footer class="ubu-footer">
        <div class="container">
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

            <div class="footer-cols-row">
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

                <div class="footer-col footer-col-links">
                    <p class="footer-col-title">Quick Links</p>
                    <ul class="footer-links">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('guest.all_services') }}">Our Service</a></li>
                        <li><a href="{{ url('/tours') }}">Tours & Travel</a></li>
                        <li><a href="{{ url('/cars') }}">Car Rentals</a></li>
                        <li><a href="{{ route('guest.transfer') }}">Transport Services</a></li>
                        <li><a href="{{ route('guest.contact') }}">Contact</a></li>
                        <li><a href="{{ route('login') }}">My account</a></li>
                    </ul>
                </div>

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
    @yield('scripts')
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
