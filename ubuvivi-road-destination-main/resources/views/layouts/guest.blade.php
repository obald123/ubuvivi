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
        <link href="{{ asset('assets/owl-carousel/assets/owl.carousel.min.css?v=1') }}" rel="stylesheet"
            type="text/css">
        <link href="{{ asset('assets/owl-carousel/assets/owl.theme.default.min.css?v=1') }}" rel="stylesheet"
            type="text/css">
        <style>
            pre {
                white-space: pre-line;
            }

            .hover-link:hover {
                text-decoration: underline;
            }

            .fa-phone {
                transform: rotate(90deg);
            }
        </style>
        @yield('css')
    </head>

    <body>
        <div id="thetop"></div>
        <div class="backtotop bg-dark-1"><a href="#" class="scroll"><i class="far fa-arrow-up"></i></a></div>
        <header class="header_section bg-dark-1 clearfix sticky text-white">
            <div class="header_top clearfix shadow-lg">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-auto">
                            <ul class="header_contact_info ul_li clearfix">
                                <li>
                                    <i class="fal fa-envelope"></i>
                                    <a href="mail:ubuvivitours@gmail.com" class="text-white">
                                        ubuvivitours@gmail.com
                                    </a>
                                </li>
                                <li><i class="fal fa-phone"></i> <span>
                                        <a class="mx-1 text-white" href="tel:+250789044222">+250 789 044 222</a> |
                                        <a class="mx-1 text-white" href="tel:+250783123089">+250 783 123 089</a> |
                                        <a class="mx-1 text-white" href="tel:+250787229916">+250 787 229 916</a>
                                    </span></li>
                            </ul>
                        </div>
                        <div class="col-lg-auto">
                            <ul class="primary_social_links ul_li_right clearfix">
                                <li>
                                    <a href="https://www.facebook.com/profile.php?id=100077752760078">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/ubuvivitours/">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li><a href="#!"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#!"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_bottom clearfix shadow-lg">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="brand_logo"><a href="{{ url('/') }}">
                                    <img width="100" height="100" style="max-height: 100px" class="rounded"
                                        src="{{ asset('assets/images/logo.png?v=1') }}"
                                        srcset="{{ asset('assets/images/logo.png?v=1') }} 2x" alt="logo">
                                    <img width="100" height="100" style="max-height: 100px" class="rounded"
                                        src="{{ asset('assets/images/logo.png?v=1') }}"
                                        srcset="{{ asset('assets/images/logo.png?v=1') }} 2x" alt="logo">
                                </a>
                            </div>
                        </div>
                        <div class="order-last col-auto">
                            <ul class="header_action_btns ul_li_right clearfix">
                                <li><button type="button" class="mobile_sidebar_btn" aria-label="Menu Button">
                                        <i class="text-light fal fa-align-right"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-auto col-md-12">
                            <nav class="main_menu clearfix">
                                <ul class="ul_li_center clearfix">
                                    <li class="@if (request()->is('/')) active @endif">
                                        <a href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="@if (request()->is('tours*')) active @endif">
                                        <a href="{{ url('/tours') }}">Tours & Travels</a>
                                    </li>
                                    <li class="@if (request()->is('cars*')) active @endif">
                                        <a href="{{ url('/cars') }}">Car Rental</a>
                                    </li>
                                    <li class="@if (request()->is('services*')) active @endif">
                                        <a href="{{ route('guest.services') }}">Services</a>
                                    </li>
                                    <li class="@if (request()->is('about*')) active @endif">
                                        <a href="{{ route('guest.about') }}">About us</a>
                                    </li>
                                    <li class="@if (request()->is('contact*')) active @endif">
                                        <a href="{{ route('guest.contact') }}">Contact Us</a>
                                    </li>
                                    <li><a href="{{ route('login') }}">My Account</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="sidebar-menu-wrapper">
                <div class="mobile_sidebar_menu">
                    <button type="button" class="close_btn">
                        <i class="fal fa-times"></i>
                    </button>
                    <div class="about_content mb_60">
                        <div class="brand_logo mb_15">
                            <a href="index.html">
                                <img width="150" height="150" style="max-height: 150px" class="rounded"
                                    src="{{ asset('assets/images/logo.png?v=1') }}"
                                    srcset="{{ asset('assets/images/logo.png?v=1') }} 2x" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="menu_list mb_60 clearfix">
                        <ul class="ul_li_block clearfix">
                            <li class="@if (request()->is('/')) active @endif">
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="@if (request()->is('tours*')) active @endif">
                                <a href="{{ url('/tours') }}">Tours & Travels</a>
                            </li>
                            <li class="@if (request()->is('cars*')) active @endif">
                                <a href="{{ url('/cars') }}">Car Rental</a>
                            </li>
                            <li class="@if (request()->is('services*')) active @endif">
                                <a href="{{ route('guest.services') }}">Services</a>
                            </li>
                            <li class="@if (request()->is('about*')) active @endif">
                                <a href="{{ route('guest.about') }}">About Us</a>
                            </li>
                            <li class="@if (request()->is('contact*')) active @endif">
                                <a href="{{ route('guest.contact') }}">Contact Us</a>
                            </li>
                            <li><a href="{{ route('login') }}">My Account</a></li>
                        </ul>
                    </div>
                </div>
                <div class="overlay"></div>
            </div>
            @yield('content')
        </main>
        <footer class="footer_section clearfix" style="background-color: #000c21;color: white;">
            <div class="footer_widget_area clearfix px-4 py-5">
                <div class="container">
                    <div class="row justify-content-lg-between">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-sm-12">
                            <div class="footer_about" data-aos="fade-up" data-aos-delay="100">

                                <div class="footer_useful_links mb_30">
                                    <ul class="ul_li_block clearfix">
                                        <li>
                                            <strong>
                                                <i class="fas fa-map-marker-alt"></i>
                                                Main Office Address:
                                            </strong>
                                            <p class="mb-0">
                                                Remera - Kisimenti KG11 Ave, Amahoro Stadium Road, Ikaze house, 3rd
                                                floor.
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12 col-sm-12">
                            <div class="footer_contact_info" data-aos="fade-up" data-aos-delay="100">
                                <p class="footer_widget_title mb-3 text-white">Quick Links</p>
                                <ul class="ul_li_block clearfix">
                                    <li class="mb-0"><a class="hover-link text-white"
                                            href="{{ url('/') }}">Home</a></li>
                                    <li class="mb-0"><a class="hover-link text-white"
                                            href="{{ url('/tours') }}">Tours & Travels</a></li>
                                    <li class="mb-0"><a class="hover-link text-white"
                                            href="{{ url('/cars') }}">Car Rental</a></li>
                                    <li class="mb-0"><a class="hover-link text-white"
                                            href="{{ route('guest.services') }}">Services</a></li>
                                    <li class="mb-0"><a class="hover-link text-white"
                                            href="{{ route('guest.about') }}">About Us</a></li>
                                    <li class="mb-0"><a class="hover-link text-white"
                                            href="{{ route('guest.contact') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-sm-12">
                            <div class="footer_useful_links" data-aos="fade-up" data-aos-delay="300">
                                <ul class="ul_li_block clearfix">
                                    <li>
                                        <i class="fas fa-envelope"></i>
                                        <strong>
                                            <a class="text-light font-weight-normal"
                                                href="mailto:ubuvivitours@gmail.com">ubuvivitours@gmail.com</a>
                                        </strong>
                                    </li>
                                    <li class="d-flex align-items-baseline">
                                        <i class="fas fa-phone"></i>
                                        <strong class="d-flex flex-column">
                                            <a class="text-light font-weight-normal" href="tel:+250789044222">
                                                +250 789 044 222
                                            </a>
                                            <a class="text-light font-weight-normal" href="tel:+250783123089">
                                                +250 783 123 089
                                            </a>
                                            <a class="text-light font-weight-normal" href="tel:+250787229916">
                                                +250 787 229 916
                                            </a>
                                        </strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_bottom clearfix text-white" data-bg-color="#000C21">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <p class="copyright_text mb-0">Copyright © 2020. Ubuvivi Tours & Logistics LTD.</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <ul class="primary_social_links ul_li_right clearfix">
                                <li>
                                    <a href="https://www.facebook.com/Ubuvivi-Transport-104481372158041"
                                        aria-label="Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/ubuvivitransport" aria-label="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#!" aria-label="Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#!" aria-label="Youtube">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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
        @yield('scripts')
        <!-- Google tag (gtag.js) -->
        <script defer="defer" async src="https://www.googletagmanager.com/gtag/js?id=G-NK2XGT17DH"></script>
        <script defer="defer">
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
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
                s.onload = function() {
                    CreateWhatsappChatWidget(options);
                };
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            });
        </script>
    </body>

</html>
