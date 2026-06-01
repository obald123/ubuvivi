@extends('layouts.guest')

@section('title')
    Transport Services Rwanda - Ubuvivi
@endsection

@section('meta')
    <meta name="description" content="Providing hassle-free Rwanda transport services seven days a week, with reliable airport pickups and city transfers available 24/7.">
    <meta name="keywords" content="ubuvivi, Rwanda transport services, airport transport Rwanda, airport car services Rwanda">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    /* ── Hero ── */
    .transfers-hero {
        position: relative;
        height: 480px;
        min-height: 380px;
        background: url('{{ asset("assets/images/car-rental.jpg") }}') center center / cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .transfers-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(13, 31, 53, 0.65);
    }
    .transfers-hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
    }
    .transfers-hero-content h1 {
        font-size: clamp(30px, 5.5vw, 58px);
        font-weight: 800;
        color: #fff !important;
        text-shadow: 0 2px 16px rgba(0,0,0,.4);
        max-width: 760px;
        margin: 0 auto;
        line-height: 1.2;
    }

    /* ── Content ── */
    .transfers-content {
        background: #fff;
        padding: 80px 0 60px;
    }

    .transfer-row {
        padding: 54px 0;
        border-bottom: 1px solid #f0f0f0;
        align-items: center;
    }
    .transfer-row:last-child { border-bottom: none; }

    .orange-dash {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #C85A2A;
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 14px;
    }
    .orange-dash::before {
        content: '';
        display: block;
        width: 40px;
        height: 2px;
        background: #C85A2A;
        flex-shrink: 0;
    }

    .transfer-row h2 {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }
    .transfer-row p {
        color: #555;
        font-size: 15px;
        line-height: 1.8;
        margin-bottom: 8px;
    }
    .includes-label {
        font-weight: 700;
        color: #1a1a1a;
        font-size: 15px;
        margin: 14px 0 6px;
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
        margin-top: 22px;
        transition: color .2s;
    }
    .transfer-link:hover { color: #a84520; }

    .transfer-img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-radius: 20px 60px 20px 20px;
        display: block;
    }
    .transfer-img.flip { border-radius: 60px 20px 20px 20px; }

    @media (max-width: 767px) {
        .transfer-img { margin-top: 28px; }
    }
</style>
@endsection

@section('content')

    {{-- Hero --}}
    <section class="transfers-hero">
        <div class="transfers-hero-content">
            <h1>Move Around Rwanda with Ease</h1>
        </div>
    </section>

    {{-- Transfer Services --}}
    <section class="transfers-content">
        <div class="container">

            {{-- Airport Transfers --}}
            <div class="row transfer-row" data-aos="fade-up">
                <div class="col-12 col-md-6 order-md-1">
                    <div class="orange-dash">Airport Transfers</div>
                    <p>Pickup and drop-off services to and from the airport with comfort and reliability.</p>
                    <p class="includes-label">Includes:</p>
                    <ul>
                        <li>Meet &amp; greet</li>
                        <li>Luggage assistance</li>
                        <li>On-time pickup</li>
                    </ul>
                    <a href="{{ route('transfer.book.form', ['type' => 'airport']) }}" class="transfer-link">Book Your Transfer &raquo;</a>
                </div>
                <div class="col-12 col-md-6 order-md-2">
                    <img src="{{ asset('assets/images/backgrounds/bg_04.jpg') }}" alt="Airport Transfers" class="transfer-img">
                </div>
            </div>

            {{-- Hotel Transfers --}}
            <div class="row transfer-row" data-aos="fade-up">
                <div class="col-12 col-md-6 order-md-2">
                    <div class="orange-dash">Hotel Transfers</div>
                    <p>Easy transportation between hotels, city locations, and nearby destinations.</p>
                    <p class="includes-label">Includes:</p>
                    <ul>
                        <li>Door-to-door service</li>
                        <li>Comfortable vehicles</li>
                        <li>Flexible timing</li>
                    </ul>
                    <a href="{{ route('transfer.book.form', ['type' => 'hotel']) }}" class="transfer-link">Book Your Transfer &raquo;</a>
                </div>
                <div class="col-12 col-md-6 order-md-1">
                    <img src="{{ asset('assets/images/backgrounds/bg_15.jpg') }}" alt="Hotel Transfers" class="transfer-img flip">
                </div>
            </div>

            {{-- City & Long-Distance --}}
            <div class="row transfer-row" data-aos="fade-up">
                <div class="col-12 col-md-6 order-md-1">
                    <div class="orange-dash">City &amp; Long-Distance Transfers</div>
                    <p>Travel between cities or tourist destinations with safe and convenient transport.</p>
                    <p class="includes-label">Includes:</p>
                    <ul>
                        <li>Private vehicle</li>
                        <li>Professional driver</li>
                        <li>Scenic routes across Rwanda</li>
                    </ul>
                    <a href="{{ route('transfer.book.form', ['type' => 'city']) }}" class="transfer-link">Book Your Transfer &raquo;</a>
                </div>
                <div class="col-12 col-md-6 order-md-2">
                    <img src="{{ asset('assets/images/backgrounds/bg_5.jpg') }}" alt="Long Distance Transfer" class="transfer-img">
                </div>
            </div>

        </div>
    </section>

@endsection
