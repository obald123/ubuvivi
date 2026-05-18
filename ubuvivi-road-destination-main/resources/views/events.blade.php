@extends('layouts.guest')

@section('title')
    Event Planning Services Rwanda - Ubuvivi
@endsection

@section('meta')
    <meta name="description" content="Professional event planning services in Rwanda by Ubuvivi. From intimate gatherings to grand celebrations — we plan it all.">
    <meta name="keywords" content="ubuvivi, event planning Rwanda, conference planning Kigali, corporate events Rwanda, wedding planning Rwanda">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    /* ── Hero ── */
    .events-hero {
        position: relative;
        height: 480px;
        min-height: 380px;
        background: url('{{ asset("assets/images/backgrounds/bg_01.jpg") }}') center center / cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .events-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(13, 31, 53, 0.65);
    }
    .events-hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
    }
    .events-hero-content h1 {
        font-size: clamp(30px, 5vw, 56px);
        font-weight: 800;
        color: #fff !important;
        text-shadow: 0 2px 16px rgba(0,0,0,.4);
        max-width: 720px;
        margin: 0 auto 14px;
        line-height: 1.2;
    }
    .events-hero-content p {
        font-size: 17px;
        color: rgba(255,255,255,.88);
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* ── Services Section ── */
    .events-services {
        background: #fff;
        padding: 80px 0 100px;
    }
    .events-services .section-title {
        text-align: center;
        font-size: clamp(22px, 4vw, 34px);
        font-weight: 900;
        color: #1a1a1a;
        text-transform: uppercase;
        letter-spacing: 3px;
        margin-bottom: 0;
    }
    .title-underline {
        width: 100px;
        height: 3px;
        background: #C85A2A;
        margin: 10px auto 54px;
        border-radius: 2px;
    }

    /* ── Overlay Cards ── */
    .event-overlay-card {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        height: 340px;
        display: block;
        text-decoration: none;
    }
    .event-overlay-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .4s ease;
    }
    .event-overlay-card:hover img {
        transform: scale(1.05);
    }
    .event-overlay-card::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,.08) 40%, rgba(0,0,0,.72) 100%);
    }
    .event-card-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 2;
        padding: 22px 24px 26px;
    }
    .event-card-title {
        font-size: 22px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 4px;
        line-height: 1.2;
    }
    .event-card-subtitle {
        font-size: 13px;
        color: rgba(255,255,255,.78);
        margin-bottom: 14px;
    }
    .event-card-link {
        color: #C85A2A;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: color .2s;
    }
    .event-card-link:hover { color: #e8794a; }

    /* ── CTA Banner ── */
    .events-cta {
        background: #0D1F35;
        padding: 64px 0;
        text-align: center;
    }
    .events-cta h2 {
        color: #fff;
        font-size: clamp(22px, 3.5vw, 32px);
        font-weight: 700;
        margin-bottom: 12px;
    }
    .events-cta p {
        color: rgba(255,255,255,.72);
        font-size: 16px;
        margin-bottom: 28px;
        max-width: 480px;
        margin-left: auto;
        margin-right: auto;
    }
    .events-cta .cta-btn {
        background: #C85A2A;
        color: #fff;
        border-radius: 50px;
        padding: 14px 38px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: background .2s;
    }
    .events-cta .cta-btn:hover { background: #a84520; color: #fff; text-decoration: none; }
</style>
@endsection

@section('content')

    {{-- Hero --}}
    <section class="events-hero">
        <div class="events-hero-content">
            <h1>Make Your Event Memorable</h1>
            <p>From idea to execution — we handle every detail.</p>
        </div>
    </section>

    {{-- Services --}}
    <section class="events-services">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <div class="title-underline"></div>

            <div class="row">
                <div class="col-12 col-md-4 mb-4" data-aos="fade-up" data-aos-delay="0">
                    <a href="{{ route('guest.contact') }}" class="event-overlay-card">
                        <img src="{{ asset('assets/images/backgrounds/bg_13.jpg') }}" alt="Basic Planning">
                        <div class="event-card-bottom">
                            <div class="event-card-title">Basic Planning</div>
                            <div class="event-card-subtitle">Consultation only</div>
                            <span class="event-card-link">Plan Your Event &raquo;</span>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('guest.contact') }}" class="event-overlay-card">
                        <img src="{{ asset('assets/images/backgrounds/bg_14.jpg') }}" alt="Partial Planning">
                        <div class="event-card-bottom">
                            <div class="event-card-title">Partial Planning</div>
                            <div class="event-card-subtitle">We assist setup + vendors</div>
                            <span class="event-card-link">Plan Your Event &raquo;</span>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('guest.contact') }}" class="event-overlay-card">
                        <img src="{{ asset('assets/images/backgrounds/bg_15.jpg') }}" alt="Full Planning">
                        <div class="event-card-bottom">
                            <div class="event-card-title">Full Planning</div>
                            <div class="event-card-subtitle">We handle everything</div>
                            <span class="event-card-link">Plan Your Event &raquo;</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="events-cta">
        <div class="container">
            <h2>Ready to Plan Your Event?</h2>
            <p>Contact us today and let's create something unforgettable together.</p>
            <a href="{{ route('guest.contact') }}" class="cta-btn">Get in Touch</a>
        </div>
    </section>

@endsection
