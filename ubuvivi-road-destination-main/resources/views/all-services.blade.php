@extends('layouts.guest')

@section('title')
    Our Services - Ubuvivi Tours & Safaris
@endsection

@section('meta')
    <meta name="description" content="Explore all services offered by Ubuvivi Tours: Tours & Travel, Car Rentals, Transfer Services, and Event Planning in Rwanda.">
    <meta name="keywords" content="ubuvivi services, Rwanda tours, car rental Rwanda, airport transfer, event planning Kigali">
@endsection

@section('css')
<style>
    /* ── Hero ── */
    .services-hero {
        position: relative;
        height: 420px;
        background: url('{{ asset("assets/images/backgrounds/bg_01.jpg") }}') center center / cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .services-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(13, 31, 53, 0.68);
    }
    .services-hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
    }
    .services-hero-content h1 {
        font-size: clamp(28px, 5vw, 54px);
        font-weight: 800;
        text-shadow: 0 2px 16px rgba(0,0,0,.4);
        margin-bottom: 14px;
    }
    .services-hero-content p {
        font-size: 17px;
        color: rgba(255,255,255,.85);
        max-width: 560px;
        margin: 0 auto;
    }

    /* ── Section ── */
    .all-services-section { background: #f8f8f8; padding: 80px 0 100px; }

    .section-label {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #C85A2A;
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 10px;
    }
    .section-label::before {
        content: '';
        display: block;
        width: 40px; height: 2px;
        background: #C85A2A;
    }
    .section-heading {
        font-size: clamp(26px, 3.5vw, 38px);
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 10px;
    }
    .section-sub {
        font-size: 15px;
        color: #666;
        max-width: 560px;
        margin: 0 auto 50px;
        text-align: center;
    }

    /* ── Service Cards ── */
    .service-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,.07);
        transition: transform .25s, box-shadow .25s;
        height: 100%;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
    }
    .service-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 40px rgba(0,0,0,.13);
        text-decoration: none;
        color: inherit;
    }
    .service-card-img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
    }
    .service-card-body {
        padding: 28px 28px 32px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .service-card-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        background: rgba(200, 90, 42, .1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #C85A2A;
        margin-bottom: 18px;
    }
    .service-card-title {
        font-size: 21px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }
    .service-card-desc {
        font-size: 14px;
        color: #666;
        line-height: 1.75;
        flex: 1;
        margin-bottom: 22px;
    }
    .service-card-cta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #C85A2A;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: gap .2s;
    }
    .service-card:hover .service-card-cta { gap: 14px; }
</style>
@endsection

@section('content')

    {{-- ── Hero ── --}}
    <section class="services-hero">
        <div class="services-hero-content">
            <h1>What We Offer</h1>
            <p>Explore our full range of travel, transport, and event services across Rwanda.</p>
        </div>
    </section>

    {{-- ── Services Grid ── --}}
    <section class="all-services-section">
        <div class="container">
            <div class="text-center mb-2">
                <span class="section-label" style="justify-content:center;">Our Services</span>
                <h2 class="section-heading">Everything You Need, In One Place</h2>
                <p class="section-sub">From guided safaris to airport transfers and event management — Ubuvivi has you covered.</p>
            </div>

            <div class="row g-4">

                {{-- Tours & Travel --}}
                <div class="col-md-6 col-lg-4">
                    <a href="{{ url('/tours') }}" class="service-card d-block">
                        <img src="{{ asset('assets/images/backgrounds/bg_6.jpg') }}" alt="Tours & Travel" class="service-card-img">
                        <div class="service-card-body">
                            <div class="service-card-icon">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <div class="service-card-title">Tours &amp; Travel</div>
                            <p class="service-card-desc">Discover Rwanda's breathtaking landscapes, gorilla trekking, national parks, and cultural experiences with our expert-guided tour packages.</p>
                            <span class="service-card-cta">Explore Tours <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>

                {{-- Car Rentals --}}
                <div class="col-md-6 col-lg-4">
                    <a href="{{ url('/cars') }}" class="service-card d-block">
                        <img src="{{ asset('assets/images/backgrounds/bg_14.jpg') }}" alt="Car Rentals" class="service-card-img">
                        <div class="service-card-body">
                            <div class="service-card-icon">
                                <i class="fas fa-car"></i>
                            </div>
                            <div class="service-card-title">Car Rentals</div>
                            <p class="service-card-desc">Choose from our fleet of well-maintained vehicles for self-drive adventures across Rwanda at competitive daily rates.</p>
                            <span class="service-card-cta">View Fleet <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>

                {{-- Transfer Services --}}
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('guest.transfer') }}" class="service-card d-block">
                        <img src="{{ asset('assets/images/backgrounds/bg_15.jpg') }}" alt="Transfer Services" class="service-card-img">
                        <div class="service-card-body">
                            <div class="service-card-icon">
                                <i class="fas fa-shuttle-van"></i>
                            </div>
                            <div class="service-card-title">Transfer Services</div>
                            <p class="service-card-desc">Reliable airport pickups, hotel transfers, and city-to-city transport with professional drivers available 24/7.</p>
                            <span class="service-card-cta">Book Transfer <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>

                {{-- Event Planning --}}
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('guest.events') }}" class="service-card d-block">
                        <img src="{{ asset('assets/images/backgrounds/bg_9.jpg') }}" alt="Event Planning" class="service-card-img">
                        <div class="service-card-body">
                            <div class="service-card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="service-card-title">Event Planning</div>
                            <p class="service-card-desc">From intimate gatherings to large corporate events and weddings — we handle every detail so you don't have to.</p>
                            <span class="service-card-cta">Learn More <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>

                {{-- Hotel Booking --}}
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('guest.hotel_booking') }}" class="service-card d-block">
                        <img src="{{ asset('assets/images/backgrounds/bg_12.jpg') }}" alt="Hotel Booking" class="service-card-img">
                        <div class="service-card-body">
                            <div class="service-card-icon">
                                <i class="fas fa-hotel"></i>
                            </div>
                            <div class="service-card-title">Hotel Booking</div>
                            <p class="service-card-desc">Find and book the perfect hotel across Rwanda and Africa. We secure the best rates and locations for a comfortable stay.</p>
                            <span class="service-card-cta">Browse Hotels <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>

                {{-- Air Ticketing --}}
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('guest.air_ticketing') }}" class="service-card d-block">
                        <img src="{{ asset('assets/images/backgrounds/bg_04.jpg') }}" alt="Air Ticketing" class="service-card-img">
                        <div class="service-card-body">
                            <div class="service-card-icon">
                                <i class="fas fa-plane"></i>
                            </div>
                            <div class="service-card-title">Air Ticketing</div>
                            <p class="service-card-desc">Book flights from Kigali to destinations worldwide. We find the best fares across all major airlines so you travel for less.</p>
                            <span class="service-card-cta">Book Flights <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection
