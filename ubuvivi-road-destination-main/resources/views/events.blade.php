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

    /* ── Package Cards ── */
    .event-pkg-card {
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 20px rgba(0,0,0,.08);
        transition: transform .25s, box-shadow .25s;
        display: flex;
        flex-direction: column;
        height: 100%;
        text-decoration: none;
        color: inherit;
    }
    .event-pkg-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 40px rgba(0,0,0,.14);
        text-decoration: none;
        color: inherit;
    }
    .event-pkg-img {
        overflow: hidden;
        height: 240px;
        display: block;
        flex-shrink: 0;
    }
    .event-pkg-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .4s ease;
    }
    .event-pkg-card:hover .event-pkg-img img {
        transform: scale(1.05);
    }
    .event-pkg-body {
        padding: 24px 26px 28px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .event-pkg-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 4px;
        line-height: 1.3;
    }
    .event-pkg-subtitle {
        font-size: 13px;
        color: #888;
        margin-bottom: 16px;
        font-style: italic;
    }
    .event-pkg-includes {
        list-style: none;
        padding: 0;
        margin: 0 0 22px;
        flex: 1;
    }
    .event-pkg-includes li {
        font-size: 13px;
        color: #555;
        padding: 7px 0;
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 1px solid #f2f2f2;
    }
    .event-pkg-includes li:last-child { border-bottom: none; }
    .event-pkg-includes li::before {
        content: '';
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #C85A2A;
        flex-shrink: 0;
    }
    .event-pkg-cta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #C85A2A;
        color: #fff;
        font-weight: 600;
        font-size: 14px;
        padding: 11px 24px;
        border-radius: 50px;
        align-self: flex-start;
        transition: background .2s;
        text-decoration: none;
    }
    .event-pkg-cta:hover { background: #a84520; color: #fff; text-decoration: none; }

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

    {{-- Conference Packages --}}
    <section class="events-services">
        <div class="container">
            <h2 class="section-title">Conference Packages</h2>
            <div class="title-underline"></div>

            <div class="row">

                {{-- Basic --}}
                <div class="col-12 col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="0">
                    <div class="event-pkg-card w-100">
                        <div class="event-pkg-img">
                            <img src="{{ asset('assets/images/backgrounds/bg_13.jpg') }}" alt="Basic Package">
                        </div>
                        <div class="event-pkg-body">
                            <div class="event-pkg-title">Basic Package</div>
                            <div class="event-pkg-subtitle">Venue only — ideal for self-organised events</div>
                            <ul class="event-pkg-includes">
                                <li>Conference hall / venue</li>
                                <li>Tables &amp; seating setup</li>
                                <li>Projector &amp; screen</li>
                            </ul>
                            <a href="{{ route('event.book.form', ['package' => 'basic']) }}" class="event-pkg-cta">
                                Plan Your Event <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Partial --}}
                <div class="col-12 col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="event-pkg-card w-100">
                        <div class="event-pkg-img">
                            <img src="{{ asset('assets/images/backgrounds/bg_14.jpg') }}" alt="Partial Package">
                        </div>
                        <div class="event-pkg-body">
                            <div class="event-pkg-title">Partial Package</div>
                            <div class="event-pkg-subtitle">Venue + catering for a complete experience</div>
                            <ul class="event-pkg-includes">
                                <li>Conference hall / venue</li>
                                <li>Catering &amp; refreshments</li>
                                <li>Audio-visual equipment</li>
                                <li>On-site event coordinator</li>
                            </ul>
                            <a href="{{ route('event.book.form', ['package' => 'partial']) }}" class="event-pkg-cta">
                                Plan Your Event <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Full --}}
                <div class="col-12 col-md-4 mb-4 d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="event-pkg-card w-100">
                        <div class="event-pkg-img">
                            <img src="{{ asset('assets/images/backgrounds/bg_15.jpg') }}" alt="Full Package">
                        </div>
                        <div class="event-pkg-body">
                            <div class="event-pkg-title">Full Package</div>
                            <div class="event-pkg-subtitle">All-inclusive — we handle everything</div>
                            <ul class="event-pkg-includes">
                                <li>Conference hall / venue</li>
                                <li>Catering &amp; refreshments</li>
                                <li>Guest transport &amp; transfers</li>
                                <li>Décor &amp; branding setup</li>
                                <li>Full on-site support</li>
                            </ul>
                            <a href="{{ route('event.book.form', ['package' => 'full']) }}" class="event-pkg-cta">
                                Plan Your Event <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
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
