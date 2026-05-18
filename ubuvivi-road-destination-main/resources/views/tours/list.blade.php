@extends('layouts.guest')

@section('title')
    Tour & Travels Agents Rwanda | Rwanda Tourism Services - Ubuvivi
@endsection

@section('meta')
    <meta name="description"
        content="Rwanda tourism services from Ubuvivi we arrange custom tour packages with an expert local tour guide to explore Rwanda tourism">
    <meta name="keywords" content="ubuvivi, Rwanda tourism services, Tour & Travels Agents Rwanda">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    /* ── Hero ── */
    .tours-hero {
        position: relative;
        height: 100vh;
        min-height: 560px;
        background: url('{{ asset("assets/images/backgrounds/bg_11.jpg") }}') center center / cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .tours-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(13, 31, 53, 0.65);
    }
    .tours-hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
    }
    .tours-hero-content h1 {
        font-size: clamp(42px, 7vw, 72px);
        font-weight: 800;
        margin-bottom: 16px;
        text-shadow: 0 2px 12px rgba(0,0,0,.3);
    }
    .tours-hero-content p {
        font-size: clamp(16px, 2.5vw, 20px);
        color: rgba(255,255,255,.92);
        max-width: 640px;
        margin: 0 auto 28px;
        line-height: 1.6;
    }
    .tours-hero-link {
        color: #C85A2A;
        font-weight: 700;
        font-size: 18px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: color .2s;
    }
    .tours-hero-link:hover { color: #e8794a; }

    /* Decorative wave bottom */
    .hero-wave {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        z-index: 2;
        line-height: 0;
    }
    .hero-wave svg { display: block; }

    /* ── Tour Cards ── */
    .tours-grid-section {
        background: #fff;
        padding: 70px 0 80px;
    }
    .tour-card {
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 2px 20px rgba(0,0,0,.08);
        transition: transform .25s, box-shadow .25s;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .tour-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 40px rgba(0,0,0,.14);
    }
    .tour-card-img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        display: block;
    }
    .tour-card-img-placeholder {
        width: 100%;
        height: 220px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .tour-card-body {
        padding: 18px 18px 0;
        flex: 1;
    }
    .tour-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 0;
        line-height: 1.3;
    }
    .tour-card-footer {
        margin-top: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #C85A2A;
        border-radius: 50px;
        padding: 12px 20px;
        margin: 16px 18px 18px;
        text-decoration: none;
        transition: background .2s;
    }
    .tour-card-footer:hover { background: #a84520; text-decoration: none; }
    .tour-card-price {
        color: #fff;
        font-weight: 700;
        font-size: 18px;
    }
    .tour-card-price span {
        font-size: 13px;
        font-weight: 400;
        opacity: .85;
    }
    .tour-card-cta {
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .no-tours {
        text-align: center;
        padding: 80px 0;
        color: #888;
        font-size: 18px;
    }
</style>
@endsection

@section('content')

    {{-- ── Hero ── --}}
    <section class="tours-hero">
        <div class="tours-hero-content">
            <h1>Explore Rwanda</h1>
            <p>Discover unforgettable tours across Rwanda's most iconic destinations.</p>
            <a href="#tours-grid" class="tours-hero-link">
                View Tours
                <i class="fas fa-arrow-down"></i>
            </a>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1440 60" fill="white" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" height="60" width="100%">
                <path d="M0,40 C360,80 1080,0 1440,40 L1440,60 L0,60 Z"/>
            </svg>
        </div>
    </section>

    {{-- ── Tours Grid ── --}}
    <section class="tours-grid-section" id="tours-grid">
        <div class="container">
            @if ($tours->count())
                <div class="row">
                    @foreach ($tours as $tour)
                        <div class="col-12 col-md-6 col-lg-4 mb-4 d-flex">
                            <div class="tour-card w-100">
                                @if ($tour->images && count($tour->images))
                                    <div class="tour-card-img-placeholder"
                                         style="background-image: url('{{ $tour->images[0] }}')">
                                    </div>
                                @else
                                    <img src="{{ asset('assets/images/vehicles/not_found.png') }}"
                                         alt="{{ $tour->title }}"
                                         class="tour-card-img">
                                @endif

                                <div class="tour-card-body">
                                    <h3 class="tour-card-title">{{ $tour->title }}</h3>
                                    @if($tour->description)
                                        <p class="tour-card-desc" style="margin: 8px 0; font-size: 14px; color: #666; line-height: 1.4;">
                                            {{ Str::limit($tour->description, 120) }}
                                        </p>
                                    @endif
                                </div>

                                <a href="{{ route('tour.view', $tour->id) }}" class="tour-card-footer">
                                    <div class="tour-card-price">
                                        @if ($tour->price > 0)
                                            ${{ number_format($tour->price) }} <span>/person</span>
                                        @else
                                            <span>Contact for price</span>
                                        @endif
                                    </div>
                                    <div class="tour-card-cta">
                                        View Details
                                        <i class="fas fa-chevron-right" style="font-size:11px;"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-tours">
                    <i class="fas fa-map-marker-alt" style="font-size:40px; color:#C85A2A; display:block; margin-bottom:16px;"></i>
                    No tours available at the moment. Check back soon!
                </div>
            @endif
        </div>
    </section>

@endsection
