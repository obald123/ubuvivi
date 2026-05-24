@extends('layouts.guest')

@section('title')
    Ubuvivi Tours Safaris | Best Transport and Travel Company in Rwanda
@endsection

@section('meta')
    <meta name="description"
        content="UBUVIVI leading in Tour operators company in Rwanda, book your dream vacation today for ubuvivi safaris, ubuvivi EAC Safari, ubuvivi Gorillas tracking & ubuvivi Hotel booking">
    <meta name="keywords"
        content="ubuvivi, ubuvivi safaris, ubuvivi tours and safaris, ubuvivi tours & Safari, ubuvivi Hotel booking, ubuvivi safaris, ubuvivi tours, ubuvivi Gorillas tracking, ubuvivi EAC Safari, Rwanda Travel Agency, Best Transport Company in Rwanda">
@endsection

@section('css')
<style>
    /* ── Hero Carousel ── */
    #heroCarousel,
    #heroCarousel .carousel-inner,
    #heroCarousel .carousel-item {
        height: 100vh;
        min-height: 600px;
    }
    #heroCarousel { overflow: hidden; position: relative; }
    #heroCarousel .carousel-inner { position: relative; z-index: 2; }
    #heroCarousel .carousel-indicators { z-index: 3; }
    #heroCarousel .carousel-control-prev,
    #heroCarousel .carousel-control-next { z-index: 3; }
    .hero-video-bg {
        position: absolute;
        inset: 0;
        width: 100%; height: 100%;
        object-fit: cover;
        z-index: 0;
    }
    .hero-slide {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        position: relative;
    }
    .hero-slide::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,.30) 0%, rgba(0,0,0,.15) 50%, rgba(0,0,0,.60) 100%);
    }
    .hero-slide-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: #fff;
        padding: 0 20px;
        max-width: 800px;
    }
    .hero-slide-tag {
        display: inline-block;
        background: #C85A2A;
        color: #fff;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 6px 18px;
        border-radius: 50px;
        margin-bottom: 20px;
    }
    .hero-slide-content h1 {
        font-size: clamp(32px, 5.5vw, 68px);
        font-weight: 800;
        line-height: 1.15;
        margin-bottom: 16px;
        color: #fff !important;
        text-shadow: 0 2px 20px rgba(0,0,0,.4);
    }
    .hero-slide-content p {
        font-size: clamp(15px, 2vw, 19px);
        color: rgba(255,255,255,.88);
        margin-bottom: 32px;
        line-height: 1.7;
    }
    .hero-slide-btn {
        display: inline-block;
        background: #C85A2A;
        color: #fff;
        font-weight: 700;
        font-size: 15px;
        padding: 14px 36px;
        border-radius: 50px;
        text-decoration: none;
        transition: background .2s, transform .2s;
        pointer-events: none;
    }
    .hero-slide:hover .hero-slide-btn {
        background: #a84520;
        transform: translateY(-2px);
    }
    /* Carousel controls */
    #heroCarousel .carousel-control-prev,
    #heroCarousel .carousel-control-next {
        width: 56px;
        height: 56px;
        background: rgba(255,255,255,.18);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        bottom: auto;
        backdrop-filter: blur(6px);
        opacity: 1;
        transition: background .2s;
    }
    #heroCarousel .carousel-control-prev { left: 28px; }
    #heroCarousel .carousel-control-next { right: 28px; }
    #heroCarousel .carousel-control-prev:hover,
    #heroCarousel .carousel-control-next:hover { background: #C85A2A; }
    #heroCarousel .carousel-control-prev-icon,
    #heroCarousel .carousel-control-next-icon { width: 20px; height: 20px; }
    /* Indicators */
    #heroCarousel .carousel-indicators {
        bottom: 100px;
        z-index: 10;
    }
    #heroCarousel .carousel-indicators li {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(255,255,255,.5);
        border: none;
        margin: 0 5px;
        transition: background .2s, transform .2s;
    }
    #heroCarousel .carousel-indicators li.active {
        background: #C85A2A;
        transform: scale(1.3);
    }
    /* Slide text animation */
    .carousel-item.active .hero-slide-content { animation: slideUp .7s ease both; }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 576px) {
        #heroCarousel .carousel-control-prev,
        #heroCarousel .carousel-control-next { display: none; }
        .hero-pill-bar { flex-direction: column; text-align: center; bottom: 16px; border-radius: 20px; }
    }

    /* ── Section shared ── */
    .sec-pad { padding: 80px 0; }
    .sec-pad-sm { padding: 60px 0; }
    .orange-dash {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #C85A2A;
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 12px;
    }
    .orange-dash::before {
        content: '';
        display: block;
        width: 40px; height: 2px;
        background: #C85A2A;
    }
    .section-title-orange {
        color: #C85A2A;
        font-weight: 700;
        font-size: 32px;
        text-align: center;
        margin-bottom: 12px;
    }

    /* ── Who We Are ── */
    .who-section { background: #fff; }
    .who-section h2 { font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 16px; }
    .who-section p { color: #555; line-height: 1.8; font-size: 15px; margin-bottom: 0; }
    .who-link { color: #C85A2A; font-weight: 600; font-size: 15px; text-decoration: none; display: inline-block; margin-top: 24px; }
    .who-link:hover { color: #a84520; }
    /* ── Mosaic ── */
    .mosaic-flex {
        display: flex;
        gap: 10px;
        align-items: flex-end;
    }
    .mosaic-col {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .mosaic-col-1 { flex: 1.3; }
    .mosaic-col-2 { flex: 1; }
    .mosaic-col-3 { flex: 0.8; }

    .mosaic-flex .tile {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
    }
    /* Col 1 — 2 images, tallest */
    .mosaic-col-1 .tile { height: 210px; }
    /* Col 2 — 2 images, medium height */
    .mosaic-col-2 .tile { height: 170px; }
    /* Col 3 — 1 image, smallest */
    .mosaic-col-3 .tile { height: 200px; }

    /* Asymmetric border-radius — one big outer corner per tile */
    /* Col 1 top (gorilla): top-left + left side large */
    .mosaic-col-1 .tile:nth-child(1) { border-radius: 40px 14px 14px 14px; }
    /* Col 1 bottom (lion): bottom-left large */
    .mosaic-col-1 .tile:nth-child(2) { border-radius: 14px 14px 14px 40px; }
    /* Col 2 top (hills): top-right large */
    .mosaic-col-2 .tile:nth-child(1) { border-radius: 14px 40px 14px 14px; }
    /* Col 2 bottom (cars): bottom-right large */
    .mosaic-col-2 .tile:nth-child(2) { border-radius: 14px 14px 40px 14px; }
    /* Col 3 single (safari): top-right large */
    .mosaic-col-3 .tile:nth-child(1) { border-radius: 14px 40px 14px 14px; }

    /* ── UBUVIVI Meaning ── */
    .meaning-section {
        background: #0D1F35;
        padding: 70px 0;
        text-align: center;
    }
    .meaning-section h2 { font-size: 32px; font-weight: 700; color: #C85A2A; margin-bottom: 20px; }
    .meaning-section p { color: rgba(255,255,255,.8); font-size: 16px; max-width: 780px; margin: 0 auto; line-height: 1.9; }

    /* ── Objective & Aim ── */
    .objective-section { background: #fff; }
    .objective-section .heading-block h2 {
        font-size: 42px;
        font-weight: 800;
        color: #1a1a1a;
        line-height: 1.2;
        margin-bottom: 16px;
    }
    .objective-section .heading-block h2 em {
        font-style: italic;
        font-weight: 800;
    }
    .double-underline { display: flex; flex-direction: column; gap: 5px; margin-top: 4px; }
    .double-underline .line-orange { width: 70px; height: 3px; background: #C85A2A; border-radius: 2px; }
    .double-underline .line-dark   { width: 70px; height: 3px; background: #1a1a1a; border-radius: 2px; }

    /* Aim card — left bump mirrors Objective card right bump */
    .aim-card-wrap {
        position: relative;
        background: #F0F0F0;
        border-radius: 140px 20px 20px 140px;
        padding: 32px 36px 32px 220px;
        overflow: hidden;
        min-height: 180px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin-bottom: 20px;
    }
    .aim-circle {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        width: 170px; height: 170px;
        border-radius: 50%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .aim-card-wrap h3 { font-size: 26px; font-weight: 700; color: #1a1a1a; margin-bottom: 10px; }
    .aim-card-wrap p  { font-size: 15px; color: #555; line-height: 1.75; margin: 0; }

    /* ── Services ── */
    .services-section { background: #fff; }
    .service-row { padding: 50px 0; border-bottom: 1px solid #f0f0f0; }
    .service-row:last-child { border-bottom: none; }
    .service-row h3 { font-size: 26px; font-weight: 700; color: #1a1a1a; margin-bottom: 14px; }
    .service-row p { color: #555; line-height: 1.8; font-size: 15px; }
    .service-link { color: #C85A2A; font-weight: 600; font-size: 14px; text-decoration: none; }
    .service-link:hover { color: #a84520; }
    .service-img {
        border-radius: 20px;
        width: 100%;
        height: 300px;
        object-fit: cover;
        display: block;
    }
    .service-img.round-tr { border-radius: 60px 20px 20px 20px; }
    .service-img.round-tl { border-radius: 20px 60px 20px 20px; }
    .service-img.round-br { border-radius: 20px 20px 60px 20px; }

    /* ── Contact Form ── */
    .contact-section {
        position: relative;
        background: url('{{ asset("assets/images/backgrounds/bg_9.jpg") }}') center / cover no-repeat;
        padding: 70px 0;
    }
    .contact-section::before {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: rgba(13,31,53,.82);
        z-index: 0;
    }
    .contact-section .container { position: relative; z-index: 1; }
    .contact-section h2 { font-size: 30px; font-weight: 700; color: #fff; line-height: 1.3; }
    .contact-info-item { display: flex; align-items: flex-start; gap: 14px; margin-bottom: 20px; }
    .contact-info-icon {
        width: 42px; height: 42px; min-width: 42px;
        border-radius: 50%;
        background: #C85A2A;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 16px;
    }
    .contact-info-text { color: rgba(255,255,255,.85); font-size: 14px; line-height: 1.6; }
    .contact-info-text strong { display: block; color: #fff; font-size: 15px; margin-bottom: 2px; }
    .contact-form-card { background: transparent; }
    .contact-form-card .form-control {
        background: rgba(255,255,255,.97);
        border: none;
        border-radius: 10px;
        padding: 14px 18px;
        font-size: 14px;
        color: #333;
        margin-bottom: 14px;
    }
    .contact-form-card .form-control::placeholder { color: #aaa; }
    .contact-form-card .form-control:focus { box-shadow: 0 0 0 3px rgba(200,90,42,.3); outline: none; }
    .contact-submit-btn {
        width: 100%;
        background: #C85A2A;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 14px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s;
    }
    .contact-submit-btn:hover { background: #a84520; }

    /* ── Map ── */
    .map-section { line-height: 0; }
    .map-section iframe { width: 100%; height: 420px; border: 0; display: block; }

    @media (max-width: 991px) {
        .ubu-navbar { padding: 14px 20px; }
        .hero-pill-bar { width: 95%; padding: 14px 20px; border-radius: 20px; }
        .mosaic-col-1 .tile { height: 160px; }
        .mosaic-col-2 .tile { height: 130px; }
        .mosaic-col-3 .tile { height: 100px; }
    }
    @media (max-width: 575px) {
        .hero-contact-info span:first-child { display: none; }
        .mosaic-col-3 { display: none; }
        .mosaic-col-1 .tile { height: 140px; }
        .mosaic-col-2 .tile { height: 110px; }
    }
    @media (max-width: 575px) {
        .hero-contact-info span:first-child { display: none; }
        .subscribe-form { min-width: unset !important; }
    }
</style>
@endsection

@section('body-class', 'hero-page')

@section('content')

    {{-- ── Hero Carousel ── --}}
    <div id="heroCarousel" class="carousel slide" data-ride="carousel" data-interval="5000" style="position:relative;">

        {{-- Video background --}}
        <video class="hero-video-bg" autoplay muted loop playsinline>
            <source src="{{ asset('videos/giraffes.mp4') }}" type="video/mp4">
        </video>

        {{-- Indicators --}}
        <ol class="carousel-indicators">
            <li data-target="#heroCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#heroCarousel" data-slide-to="1"></li>
            <li data-target="#heroCarousel" data-slide-to="2"></li>
            <li data-target="#heroCarousel" data-slide-to="3"></li>
        </ol>

        {{-- Slides --}}
        <div class="carousel-inner">

            {{-- Slide 1: Tours & Travel --}}
            <div class="carousel-item active">
                <a href="{{ url('/tours') }}" class="hero-slide">
                    <div class="hero-slide-content">
                        <span class="hero-slide-tag">Tours &amp; Travel</span>
                        <h1>Discover Rwanda's<br>Breathtaking Wonders</h1>
                        <p>Gorilla trekking, national parks, and cultural experiences crafted by local experts.</p>
                        <span class="hero-slide-btn">Explore Tours &rarr;</span>
                    </div>
                </a>
            </div>

            {{-- Slide 2: Car Rentals --}}
            <div class="carousel-item">
                <a href="{{ url('/cars') }}" class="hero-slide">
                    <div class="hero-slide-content">
                        <span class="hero-slide-tag">Car Rentals</span>
                        <h1>Drive Rwanda<br>at Your Own Pace</h1>
                        <p>Choose from our fleet of premium, well-maintained vehicles for self-drive adventures.</p>
                        <span class="hero-slide-btn">View Fleet &rarr;</span>
                    </div>
                </a>
            </div>

            {{-- Slide 3: Our Services --}}
            <div class="carousel-item">
                <a href="{{ route('guest.transfer') }}" class="hero-slide">
                    <div class="hero-slide-content">
                        <span class="hero-slide-tag">Our Services</span>
                        <h1>Seamless Airport &amp;<br>City Transport</h1>
                        <p>Reliable, on-time pickup and drop-off services available 24/7 across Rwanda.</p>
                        <span class="hero-slide-btn">Book Transport &rarr;</span>
                    </div>
                </a>
            </div>

            {{-- Slide 4: Conference Planning --}}
            <div class="carousel-item">
                <a href="{{ route('guest.events') }}" class="hero-slide">
                    <div class="hero-slide-content">
                        <span class="hero-slide-tag">Conference Planning</span>
                        <h1>Professional Conferences<br>in Rwanda</h1>
                        <p>From executive meetings to large corporate summits, we handle every detail for you.</p>
                        <span class="hero-slide-btn">Plan Your Conference &rarr;</span>
                    </div>
                </a>
            </div>

        </div>

        {{-- Controls --}}
        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>

    {{-- ── Who We Are ── --}}
    <section class="who-section sec-pad">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right">
                    <span class="orange-dash">Who We Are</span>
                    <p>
                        UBUVIVI car rental &amp; Tours is the best company in Rwanda offering excellent transport service.
                        We are extremely professional at assessing and providing the most appropriate vehicle for the task.
                    </p>
                    <p class="mt-3">
                        Our cars are in a pristine conditions and installed with the state of art technology, with all
                        the required Authority Documentation.
                    </p>
                    <p class="mt-3">
                        We also have professional drivers who know all attractive places in Kigali and
                        paradise-like sceneries throughout Rwanda.
                    </p>
                    <p class="mt-3">Book with us now. We pledge to serve you to the best of our professional capability.</p>
                    <a href="{{ url('/tours') }}" class="who-link">Book us &raquo;</a>
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="mosaic-flex">
                        {{-- Col 1: 2 images, tallest --}}
                        <div class="mosaic-col mosaic-col-1">
                            <div class="tile" style="background-image: url('{{ asset('assets/images/backgrounds/bg_6.jpg') }}')"></div>
                            <div class="tile" style="background-image: url('{{ asset('assets/images/backgrounds/bg_5.jpg') }}')"></div>
                        </div>
                        {{-- Col 2: 2 images, medium height --}}
                        <div class="mosaic-col mosaic-col-2">
                            <div class="tile" style="background-image: url('{{ asset('assets/images/backgrounds/bg_11.jpg') }}')"></div>
                            <div class="tile" style="background-image: url('{{ asset('assets/images/backgrounds/bg_14.jpg') }}')"></div>
                        </div>
                        {{-- Col 3: 1 image, smallest --}}
                        <div class="mosaic-col mosaic-col-3">
                            <div class="tile" style="background-image: url('{{ asset('assets/images/backgrounds/bg_10.jpg') }}')"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── UBUVIVI Meaning ── --}}
    <section class="meaning-section" data-aos="fade-up">
        <div class="container">
            <h2>UBUVIVI Meaning</h2>
            <p>
                UBUVIVI is a Rwandan word referring to the fifth family generation, which by implication, we intend
                that this company will exist beyond that family generation. May they reap the fruits of what we have
                set up today.
            </p>
        </div>
    </section>

    {{-- ── Our Mission & Vision ── --}}
    <section class="objective-section sec-pad">
        <div class="container">

            {{-- Row 3: Heading LEFT | Mission card RIGHT --}}
            <div class="row align-items-center mb-4">
                <div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-right">
                    <div class="heading-block">
                        <h2>Our Mission<br><em>&amp; Vision</em></h2>
                        <div class="double-underline">
                            <div class="line-orange"></div>
                            <div class="line-dark"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-left">
                    <div class="aim-card-wrap">
                        <div class="aim-circle" style="background-image: url('{{ asset('assets/images/backgrounds/bg_10.jpg') }}')"></div>
                        <h3>Mission</h3>
                        <p>To provide exceptional, affordable, and reliable travel and transport services that exceed client expectations — connecting people to Rwanda's most beautiful destinations with professionalism and care.</p>
                    </div>
                </div>
            </div>

            {{-- Row 4: Vision card RIGHT-aligned --}}
            <div class="row justify-content-end" data-aos="fade-up">
                <div class="col-lg-9">
                    <div class="obj-card-wrap">
                        <h3>Vision</h3>
                        <p>To be the leading travel and transport company in East Africa, recognized for outstanding service delivery, innovation, and contributing to sustainable tourism across the region.</p>
                        <div class="obj-circle" style="background-image: url('{{ asset('assets/images/backgrounds/bg_7.jpg') }}')"></div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ── Our Services ── --}}
    <section class="services-section">
        <div class="container">
            <h2 class="section-title-orange pt-5" data-aos="fade-up">Our Services</h2>

            {{-- Tours and Travels --}}
            <div class="service-row row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 order-lg-1" data-aos="fade-right">
                    <span class="orange-dash">Tours and travels</span>
                    <p class="mt-2">
                        UBUVIVI Car Rental &amp; Tours offers guided trips across Rwanda's most beautiful destinations.
                        Explore lush hills, Lake Kivu, national parks, and unforgettable wildlife experiences.
                        Visit top locations like Volcanoes National Park, Akagera National Park, Nyungwe National Park,
                        Rubavu, and Karongi, and enjoy activities such as gorilla trekking and wildlife safaris.
                    </p>
                    <a href="{{ url('/tours') }}" class="service-link mt-3 d-inline-block">Explore Tours &raquo;</a>
                </div>
                <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                    <img src="{{ asset('assets/images/backgrounds/bg_11.jpg') }}" alt="Tours Rwanda" class="service-img round-tr">
                </div>
            </div>

            {{-- Car Rental --}}
            <div class="service-row row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 order-lg-2" data-aos="fade-left">
                    <span class="orange-dash">Car Rental</span>
                    <p class="mt-2">
                        UBUVIVI provides reliable and comfortable vehicles for travel across Rwanda. Choose between
                        self-drive cars or chauffeur-driven vehicles, all well-maintained and fully authorized.
                        Our experienced drivers know the best routes and destinations in Kigali and across Rwanda,
                        ensuring a smooth and convenient travel experience.
                    </p>
                    <a href="{{ url('/cars') }}" class="service-link mt-3 d-inline-block">View Cars &raquo;</a>
                </div>
                <div class="col-lg-6 order-lg-1" data-aos="fade-right">
                    <img src="{{ asset('assets/images/backgrounds/bg_14.jpg') }}" alt="Car Rental" class="service-img round-tl">
                </div>
            </div>

            {{-- Private Transport --}}
            <div class="service-row row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 order-lg-1" data-aos="fade-right">
                    <span class="orange-dash">Private Transport</span>
                    <p class="mt-2">
                        UBUVIVI offers convenient private transport services across Rwanda. We provide pre-booked
                        transportation for airport pickups, hotel transfers, and travel between cities or destinations.
                        Our professional drivers ensure safe, comfortable, and timely journeys for travelers moving
                        between airports, hotels, and tourist destinations.
                    </p>
                    <a href="{{ route('guest.transfer') }}" class="service-link mt-3 d-inline-block">Book Transport &raquo;</a>
                </div>
                <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                    <img src="{{ asset('assets/images/backgrounds/bg_15.jpg') }}" alt="Private Transport" class="service-img round-tr">
                </div>
            </div>
        </div>
    </section>

    {{-- ── Get in Touch ── --}}
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-right">
                    <h2>Need more information?<br>Get in Touch</h2>
                    <div class="mt-4">
                        <div class="contact-info-item">
                            <div class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="contact-info-text">
                                <strong>Address</strong>
                                Remera- kisimenti KG11 Ave,<br>
                                Amahoro stadium road, Ikaze house, 3rd floor.
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="contact-info-icon"><i class="fas fa-phone"></i></div>
                            <div class="contact-info-text">
                                <strong>Phone</strong>
                                +250 789 044 222 | +250 783 123 089 | +250 787 229 916
                            </div>
                        </div>
                        <div class="contact-info-item">
                            <div class="contact-info-icon"><i class="fas fa-envelope"></i></div>
                            <div class="contact-info-text">
                                <strong>Email</strong>
                                ubuvivitours@gmail.com
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="contact-form-card">
                        <form action="{{ url('/contact') }}" method="POST">
                            @csrf
                            <input type="text" name="name" class="form-control" placeholder="Full Name *" required>
                            <input type="email" name="email" class="form-control" placeholder="Email Address *" required>
                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                            <textarea name="message" class="form-control" rows="5" placeholder="Leave Your message" required></textarea>
                            <button type="submit" class="contact-submit-btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Map ── --}}
    <section class="map-section">
        <iframe
            title="Ubuvivi Tours Location"
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15949.946523129527!2d30.1103428!3d-1.958924!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca76d9f57f4dd%3A0x82fc7b5b7c073b9f!2sUBUVIVI%20Tours%20and%20Car%20Rental!5e0!3m2!1sen!2srw!4v1695154532377!5m2!1sen!2srw"
            allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </section>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#heroCarousel').carousel({ interval: 5000, ride: 'carousel' });
        // Re-trigger slide animation on each slide change
        $('#heroCarousel').on('slide.bs.carousel', function () {
            $(this).find('.carousel-item.active .hero-slide-content').css('animation', 'none');
        });
        $('#heroCarousel').on('slid.bs.carousel', function () {
            $(this).find('.carousel-item.active .hero-slide-content').css('animation', '');
        });
    });
</script>
@endsection
