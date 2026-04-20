@extends('layouts.guest')

@section('title')
    Best Transfer Services Rwanda - Ubuvivi
@endsection

@section('meta')
    <meta name="description"
        content="Providing hassle-free Rwanda transfer services seven days a week, Our services are 24/7 so any time you get to the airport">
    <meta name="keywords" content="ubuvivi, Rwanda Airport Transfers, Airport Transfer Services Rwanda, Airport Car Services Rwanda">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    /* ── Hero ── */
    .transfers-hero {
        position: relative;
        height: 100vh;
        min-height: 520px;
        background: url('{{ asset("assets/images/backgrounds/bg_7.jpg") }}') center center / cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .transfers-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,.52);
    }
    .transfers-hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
    }
    .transfers-hero-content h1 {
        font-size: clamp(32px, 5.5vw, 62px);
        font-weight: 800;
        text-shadow: 0 2px 16px rgba(0,0,0,.4);
        max-width: 760px;
        margin: 0 auto;
        line-height: 1.2;
    }

    /* ── Shared section styles ── */
    .transfers-content { background: #fff; padding: 80px 0; }
    .transfer-row { padding: 50px 0; border-bottom: 1px solid #f0f0f0; }
    .transfer-row:last-child { border-bottom: none; }

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
        width: 40px;
        height: 2px;
        background: #C85A2A;
    }
    .transfer-row h2 {
        font-size: 26px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 14px;
    }
    .transfer-row p {
        color: #555;
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 8px;
    }
    .transfer-row .includes-label {
        font-weight: 700;
        color: #1a1a1a;
        font-size: 15px;
        margin: 12px 0 6px;
    }
    .transfer-row ul {
        padding-left: 0;
        list-style: none;
        margin-bottom: 0;
    }
    .transfer-row ul li {
        color: #555;
        font-size: 15px;
        padding: 3px 0;
    }
    .transfer-row ul li::before {
        content: '• ';
        color: #1a1a1a;
    }
    .transfer-link {
        display: inline-block;
        color: #C85A2A;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        margin-top: 20px;
        transition: color .2s;
    }
    .transfer-link:hover { color: #a84520; }
    .transfer-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 20px;
    }
    .transfer-img.round-tr { border-radius: 60px 20px 20px 20px; }
    .transfer-img.round-tl { border-radius: 20px 60px 20px 20px; }
    .transfer-img.round-br { border-radius: 20px 20px 60px 20px; }
</style>
@endsection

@section('content')

    {{-- ── Hero ── --}}
    <section class="transfers-hero">
        <div class="transfers-hero-content">
            <h1>Move Around Rwanda with Ease</h1>
        </div>
    </section>

    {{-- ── Transfer Services ── --}}
    <section class="transfers-content">
        <div class="container">

            {{-- Airport Transfers --}}
            <div class="transfer-row row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 order-lg-1" data-aos="fade-right">
                    <span class="orange-dash">Airport Transfers</span>
                    <h2>Airport Transfers</h2>
                    <p>Pickup and drop-off services to and from the airport with comfort and reliability.</p>
                    <p class="includes-label">Includes:</p>
                    <ul>
                        <li>Meet &amp; greet</li>
                        <li>Luggage assistance</li>
                        <li>On-time pickup</li>
                    </ul>
                    <a href="{{ url('/cars') }}" class="transfer-link">Book Your Transfer &raquo;</a>
                </div>
                <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                    <img src="{{ asset('assets/images/backgrounds/bg_15.jpg') }}"
                         alt="Airport Transfers" class="transfer-img round-tr">
                </div>
            </div>

            {{-- Hotel Transfers --}}
            <div class="transfer-row row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 order-lg-1" data-aos="fade-right">
                    <img src="{{ asset('assets/images/about/3.jpg') }}"
                         alt="Hotel Transfers" class="transfer-img round-br">
                </div>
                <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                    <span class="orange-dash">Hotel Transfers</span>
                    <h2>Hotel Transfers</h2>
                    <p>Easy transportation between hotels, city locations, and nearby destinations.</p>
                    <p class="includes-label">Includes:</p>
                    <ul>
                        <li>Door-to-door service</li>
                        <li>Comfortable vehicles</li>
                        <li>Flexible timing</li>
                    </ul>
                    <a href="{{ url('/cars') }}" class="transfer-link">Book Your Transfer &raquo;</a>
                </div>
            </div>

            {{-- City & Long-Distance Transfers --}}
            <div class="transfer-row row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 order-lg-1" data-aos="fade-right">
                    <span class="orange-dash">City &amp; Long-Distance Transfers</span>
                    <h2>City &amp; Long-Distance Transfers</h2>
                    <p>Travel between cities or tourist destinations with safe and convenient transport.</p>
                    <p class="includes-label">Includes:</p>
                    <ul>
                        <li>Private vehicle</li>
                        <li>Professional driver</li>
                        <li>Scenic routes across Rwanda</li>
                    </ul>
                    <a href="{{ url('/cars') }}" class="transfer-link">Book Your Transfer &raquo;</a>
                </div>
                <div class="col-lg-6 order-lg-2" data-aos="fade-left">
                    <img src="{{ asset('assets/images/backgrounds/bg_10.jpg') }}"
                         alt="City Transfers" class="transfer-img round-tr">
                </div>
            </div>

        </div>
    </section>

@endsection
