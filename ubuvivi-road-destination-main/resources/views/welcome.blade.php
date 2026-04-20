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
    /* ── Hero ── */
    .hero-section {
        position: relative;
        height: 100vh;
        min-height: 600px;
        background: url('{{ asset("assets/images/backgrounds/bg_6.jpg") }}') center center / cover no-repeat;
    }
    .hero-section::after {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,.25) 0%, rgba(0,0,0,.1) 60%, rgba(0,0,0,.5) 100%);
        z-index: 1;
    }
    .hero-pill-bar {
        position: absolute;
        bottom: 32px;
        left: 50%;
        transform: translateX(-50%);
        width: 88%;
        max-width: 980px;
        z-index: 2;
        background: rgba(13, 31, 53, 0.35);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 50px;
        padding: 16px 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }
    .hero-contact-info {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    .hero-contact-info span {
        color: #fff;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .hero-social a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px; height: 42px;
        border-radius: 50%;
        background: rgba(255,255,255,.15);
        color: #fff;
        font-size: 16px;
        margin-left: 8px;
        transition: background .2s;
        text-decoration: none;
    }
    .hero-social a:hover { background: #C85A2A; }

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

    /* Objective card */
    .obj-card-wrap {
        position: relative;
        background: #0D1F35;
        border-radius: 20px 140px 140px 20px;
        padding: 32px 220px 32px 36px;
        overflow: hidden;
        min-height: 180px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .obj-card-wrap h3 {
        font-size: 26px; font-weight: 700; color: #fff;
        margin-bottom: 12px; text-align: center;
    }
    .obj-card-wrap p  { font-size: 15px; color: rgba(255,255,255,.8); line-height: 1.75; margin: 0; }
    .obj-circle {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        width: 170px; height: 170px;
        border-radius: 50%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

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

    {{-- ── Hero ── --}}
    <section class="hero-section">
        <div class="hero-pill-bar">
            <div class="hero-contact-info">
                <span>
                    <i class="far fa-envelope"></i>
                    ubuvivitours@gmail.com
                </span>
                <span>
                    <i class="fas fa-phone"></i>
                    +250 789 044 222 | +250 783 123 089 | +250 787 229 916
                </span>
            </div>
            <div class="hero-social">
                <a href="https://www.facebook.com/profile.php?id=100077752760078" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/ubuvivitours/" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#!" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </section>

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

    {{-- ── Our Objective & Aim ── --}}
    <section class="objective-section sec-pad">
        <div class="container">

            {{-- Row 1: Heading LEFT | Aim card RIGHT --}}
            <div class="row align-items-center mb-4">
                <div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-right">
                    <div class="heading-block">
                        <h2>Our Objective<br><em>&amp; Aim</em></h2>
                        <div class="double-underline">
                            <div class="line-orange"></div>
                            <div class="line-dark"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8" data-aos="fade-left">
                    <div class="aim-card-wrap">
                        <div class="aim-circle" style="background-image: url('{{ asset('assets/images/backgrounds/bg_13.jpg') }}')"></div>
                        <h3>Aim</h3>
                        <p>UBUVIVI car Rental and UBUVIVI tours and travels aim at making our clients smile as they enjoy the ride.</p>
                    </div>
                </div>
            </div>

            {{-- Row 2: Objective card LEFT-aligned --}}
            <div class="row" data-aos="fade-up">
                <div class="col-lg-9">
                    <div class="obj-card-wrap">
                        <h3>Objective</h3>
                        <p>UBUVIVI Car Rental &amp; Tours provides reliable car rentals, tours, and transfer services at affordable prices while ensuring excellent service and maximum client satisfaction.</p>
                        <div class="obj-circle" style="background-image: url('{{ asset('assets/images/backgrounds/bg_12.jpg') }}')"></div>
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

            {{-- Private Transfers --}}
            <div class="service-row row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 order-lg-1" data-aos="fade-right">
                    <span class="orange-dash">Private Transfers</span>
                    <p class="mt-2">
                        UBUVIVI offers convenient private transfer services across Rwanda. We provide pre-booked
                        transportation for airport pickups, hotel transfers, and travel between cities or destinations.
                        Our professional drivers ensure safe, comfortable, and timely journeys for travelers moving
                        between airports, hotels, and tourist destinations.
                    </p>
                    <a href="{{ route('guest.services') }}" class="service-link mt-3 d-inline-block">Book Transfer &raquo;</a>
                </div>
                <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                    <img src="{{ asset('assets/images/backgrounds/bg_15.jpg') }}" alt="Private Transfers" class="service-img round-tr">
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
