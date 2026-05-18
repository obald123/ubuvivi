@extends('layouts.guest')

@section('title')
    Our Services | Transport Services Rwanda - Ubuvivi
@endsection

@section('meta')
    <meta name="description"
        content="Providing hassle-free Rwanda transport services seven days a week, with reliable airport pickups and city transfers available 24/7.">
    <meta name="keywords" content="ubuvivi, Rwanda transport services, airport transport Rwanda, airport car services Rwanda">
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
        background: rgba(13, 31, 53, 0.65);
    }
    .transfers-hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
    }
    .transfers-hero-kicker {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 7px 18px;
        margin-bottom: 18px;
        border-radius: 999px;
        background: rgba(255,255,255,.14);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,.2);
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 1.4px;
        text-transform: uppercase;
    }
    .transfers-hero-content h1 {
        font-size: clamp(32px, 5.5vw, 62px);
        font-weight: 800;
        color: #fff !important;
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

    /* Transfer Cards Styles */
    .transfer-card {
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 2px 20px rgba(0,0,0,.09);
        transition: transform .25s, box-shadow .25s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .transfer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0,0,0,.15);
    }
    .transfer-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 18px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 1px solid #e9ecef;
    }
    .transfer-price {
        font-size: 24px;
        font-weight: 700;
        color: #C85A2A;
    }
    .transfer-card-body {
        padding: 20px 22px 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .transfer-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 16px;
    }
    .transfer-info-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .transfer-info-item i {
        color: #C85A2A;
        font-size: 16px;
        width: 20px;
        text-align: center;
    }
    .transfer-info-item div {
        font-size: 14px;
        color: #555;
    }
    .transfer-description {
        color: #666;
        line-height: 1.5;
        margin-bottom: 16px;
    }
    .transfer-features {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }
    .transfer-badge {
        background: #C85A2A;
        color: white;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .transfer-days {
        color: #777;
        font-size: 14px;
    }
    .transfer-card-footer {
        margin-top: auto;
        padding: 16px 18px;
    }
    .transfer-btn {
        background: #C85A2A;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 24px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background .2s;
    }
    .transfer-btn:hover {
        background: #a84520;
        color: white;
        text-decoration: none;
    }
    .transfer-btn i {
        font-size: 14px;
    }
</style>
@endsection

@section('content')

    {{-- ── Hero ── --}}
    <section class="transfers-hero">
        <div class="transfers-hero-content">
            <span class="transfers-hero-kicker">Our Services</span>
            <h1>Move Around Rwanda with Ease</h1>
        </div>
    </section>

    {{-- ── Transfer Services ── --}}
    <section class="transfers-content">
        <div class="container">

            @if($transfers->count())
            <div class="row">
                @foreach($transfers as $transfer)
                    <div class="col-12 col-md-6 mb-4 d-flex" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="transfer-card w-100">
                            <div class="transfer-card-header">
                                <h3>{{ $transfer->destination }} Transfer</h3>
                                <div class="transfer-price">${{ number_format($transfer->price) }}</div>
                            </div>
                            <div class="transfer-card-body">
                                <div class="transfer-info">
                                    <div class="transfer-info-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <div>
                                            <strong>Pickup:</strong> {{ $transfer->pickup_location }}
                                        </div>
                                    </div>
                                    <div class="transfer-info-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <div>
                                            <strong>Date:</strong> {{ date('M j, Y', strtotime($transfer->pickup_date)) }}
                                        </div>
                                    </div>
                                    <div class="transfer-info-item">
                                        <i class="fas fa-clock"></i>
                                        <div>
                                            <strong>Time:</strong> {{ $transfer->pickup_time }}
                                        </div>
                                    </div>
                                </div>
                                <p class="transfer-description">{{ Str::limit($transfer->message, 120) }}</p>
                                <div class="transfer-features">
                                    @if($transfer->transfer_type == 'airport')
                                        <span class="transfer-badge airport">Airport</span>
                                    @elseif($transfer->transfer_type == 'hotel')
                                        <span class="transfer-badge hotel">Hotel</span>
                                    @else
                                        <span class="transfer-badge private">Private</span>
                                    @endif
                                    <span class="transfer-days">{{ $transfer->number_of_days }} day{{ $transfer->number_of_days > 1 ? 's' : '' }}</span>
                                </div>
                            </div>
                            <div class="transfer-card-footer">
                                <a href="{{ route('guest.contact') }}" class="transfer-btn">
                                    Book This Transport
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-exchange-alt" style="font-size: 40px; color: #C85A2A; display: block; margin-bottom: 16px;"></i>
                <h3 style="color: #666; margin-bottom: 16px;">No Transport Services Available</h3>
                <p style="color: #888;">Check back soon for available transport services!</p>
            </div>
        @endif

        </div>
    </section>

@endsection
