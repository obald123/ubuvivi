@extends('layouts.guest')

@section('title')
    Event Planning Services Rwanda - Ubuvivi
@endsection

@section('meta')
    <meta name="description" content="Professional event planning services in Rwanda by Ubuvivi. From basic consultation to full event management.">
    <meta name="keywords" content="ubuvivi, event planning Rwanda, wedding planning Kigali, event management Rwanda">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    /* ── Hero ── */
    .events-hero {
        position: relative;
        height: 100vh;
        min-height: 520px;
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
        background: rgba(0,0,0,.50);
    }
    .events-hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
    }
    .events-hero-content h1 {
        font-size: clamp(34px, 6vw, 64px);
        font-weight: 800;
        text-shadow: 0 2px 16px rgba(0,0,0,.4);
        max-width: 760px;
        margin: 0 auto 16px;
        line-height: 1.2;
    }
    .events-hero-content p {
        font-size: 18px;
        color: rgba(255,255,255,.88);
        max-width: 540px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* ── Services Section ── */
    .events-services {
        background: #fff;
        padding: 80px 0;
    }
    .events-services .section-title {
        text-align: center;
        font-size: clamp(28px, 4vw, 40px);
        font-weight: 900;
        color: #1a1a1a;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 6px;
    }
    .events-services .title-underline {
        width: 80px;
        height: 3px;
        background: #C85A2A;
        margin: 0 auto 50px;
        border-radius: 2px;
    }

    /* ── Event Cards ── */
    .event-card {
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 2px 20px rgba(0,0,0,.09);
        transition: transform .25s, box-shadow .25s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0,0,0,.15);
    }
    .event-card-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        display: block;
    }
    .event-card-body {
        padding: 20px 22px 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .event-card-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 4px;
    }
    .event-card-subtitle {
        font-size: 14px;
        color: #777;
        margin-bottom: 16px;
    }
    .event-card-link {
        color: #C85A2A;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: auto;
        transition: color .2s;
    }
    .event-card-link:hover { color: #a84520; }

    /* ── CTA Banner ── */
    .events-cta {
        background: #0D1F35;
        padding: 60px 0;
        text-align: center;
    }
    .events-cta h2 { color: #fff; font-size: 30px; font-weight: 700; margin-bottom: 12px; }
    .events-cta p { color: rgba(255,255,255,.75); font-size: 16px; margin-bottom: 28px; }
    .events-cta .cta-btn {
        background: #C85A2A;
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 14px 36px;
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

    {{-- ── Hero ── --}}
    <section class="events-hero">
        <div class="events-hero-content">
            <h1>Unforgettable Events in Rwanda</h1>
            <p>From intimate gatherings to grand celebrations — we plan it all.</p>
        </div>
    </section>

    {{-- ── Services Grid ── --}}
    <section class="events-services">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <div class="title-underline"></div>

            <div class="row">
                {{-- Basic Planning --}}
                <div class="col-12 col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="event-card w-100">
                        <img src="{{ asset('assets/images/backgrounds/bg_02.jpg') }}"
                             alt="Basic Planning" class="event-card-img">
                        <div class="event-card-body">
                            <h3 class="event-card-title">Basic Planning</h3>
                            <p class="event-card-subtitle">Consultation only</p>
                            <a href="{{ route('guest.contact') }}" class="event-card-link">
                                Plan Your Event &raquo;
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Partial Planning --}}
                <div class="col-12 col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="event-card w-100">
                        <img src="{{ asset('assets/images/backgrounds/bg_03.jpg') }}"
                             alt="Partial Planning" class="event-card-img">
                        <div class="event-card-body">
                            <h3 class="event-card-title">Partial Planning</h3>
                            <p class="event-card-subtitle">We assist setup + vendors</p>
                            <a href="{{ route('guest.contact') }}" class="event-card-link">
                                Plan Your Event &raquo;
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Full Planning --}}
                <div class="col-12 col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="event-card w-100">
                        <img src="{{ asset('assets/images/backgrounds/bg_04.jpg') }}"
                             alt="Full Planning" class="event-card-img">
                        <div class="event-card-body">
                            <h3 class="event-card-title">Full Planning</h3>
                            <p class="event-card-subtitle">We handle everything</p>
                            <a href="{{ route('guest.contact') }}" class="event-card-link">
                                Plan Your Event &raquo;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── CTA Banner ── --}}
    <section class="events-cta">
        <div class="container">
            <h2>Ready to Plan Your Event?</h2>
            <p>Contact us today and let's create something unforgettable together.</p>
            <a href="{{ route('guest.contact') }}" class="cta-btn">Get in Touch</a>
        </div>
    </section>

@endsection
