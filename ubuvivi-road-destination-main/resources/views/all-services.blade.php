@extends('layouts.guest')

@section('title')
    Our Services - Ubuvivi Tours & Safaris
@endsection

@section('meta')
    <meta name="description" content="Explore all services offered by Ubuvivi Tours: Tours & Travel, Car Rentals, Transport Services, and Conference Planning in Rwanda.">
    <meta name="keywords" content="ubuvivi services, Rwanda tours, car rental Rwanda, airport transport, conference planning Kigali">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    /* ── Hero ── */
    .services-hero {
        position: relative;
        height: 480px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .services-hero-video {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }
    .services-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(13, 31, 53, 0.52);
        z-index: 1;
    }
    .services-hero-content {
        position: relative;
        z-index: 2;
        z-index: 2;
        color: #fff;
    }
    .services-hero-content h1 {
        font-size: clamp(28px, 5vw, 54px);
        font-weight: 800;
        color: #fff !important;
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
    .all-services-section { background: #f8f8f8; padding: 80px 0 160px; }
    /* add extra vertical gap between grid rows to avoid touching next section */
    .all-services-section .row { row-gap: 1.75rem; }

    /* ── Mobile: horizontal touch-swipe slider instead of a stacked grid ── */
    @media (max-width: 767.98px) {
        .services-slider {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            overflow-y: hidden;
            row-gap: 0;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            -ms-overflow-style: none;
            margin-left: -4px;
            margin-right: -4px;
            padding: 4px 4px 14px;
        }
        .services-slider::-webkit-scrollbar { display: none; }
        .services-slider > [class*="col-"] {
            flex: 0 0 84%;
            max-width: 84%;
            scroll-snap-align: center;
            scroll-snap-stop: always;
        }
    }

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

    /* Secondary search link inside card */
    .service-card-cta-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: auto;
    }
    .service-card-search-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #0D1F35;
        color: #fff !important;
        font-size: 12px;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 50px;
        text-decoration: none;
        white-space: nowrap;
        transition: background .2s;
    }
    .service-card-search-link:hover { background: #C85A2A; color: #fff !important; text-decoration: none; }
    /* Make non-link cards still look clickable */
    .service-card-clickable { cursor: pointer; }

    /* ── News & Upcoming Events ── */
    .news-section { background: #fff; padding: 20px 0 90px; }
    .news-card {
        background: #f8f8f8;
        border-radius: 16px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform .25s, box-shadow .25s;
    }
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,.10);
        text-decoration: none;
        color: inherit;
    }
    .news-card-img { width: 100%; height: 170px; object-fit: cover; display: block; }
    .news-card-no-img {
        width: 100%; height: 170px;
        background: linear-gradient(135deg, #0D1F35, #1e3a5f);
        display: flex; align-items: center; justify-content: center;
    }
    .news-card-no-img i { font-size: 30px; color: rgba(255,255,255,.25); }
    .news-card-body { padding: 18px 20px 22px; flex: 1; display: flex; flex-direction: column; }
    .news-card-tag {
        display: inline-block; align-self: flex-start;
        padding: 3px 12px; border-radius: 50px;
        font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .6px;
        margin-bottom: 10px;
    }
    .news-card-tag.tag-news     { background: #e0f2fe; color: #0369a1; }
    .news-card-tag.tag-event    { background: #ede9fe; color: #7c3aed; }
    .news-card-tag.tag-tour     { background: #fff0e8; color: #C85A2A; }
    .news-card-tag.tag-upcoming { background: #dcfce7; color: #16a34a; }
    .news-card-title { font-size: 16px; font-weight: 700; color: #1a1a1a; line-height: 1.4; margin-bottom: auto; padding-bottom: 14px; }
    .news-card-date { font-size: 12px; color: #999; }
</style>
@endsection

@section('content')

@php $isPlanMode = request()->query('plan') == '1'; @endphp

    {{-- ── Hero ── --}}
    <section class="services-hero">
        <video class="services-hero-video" id="servicesHeroVideo" autoplay muted playsinline>
            <source src="{{ asset('videos/giraffes.mp4') }}" type="video/mp4">
        </video>
        <div class="services-hero-content">
            @if($isPlanMode)
                <h1>Plan Your Trip</h1>
                <p>Choose your travel essentials — tours, flights, and hotels — all in one place.</p>
            @else
                <h1>What We Offer</h1>
                <p>Explore our full range of travel, transport, and conference services across Rwanda.</p>
            @endif
        </div>
    </section>
    @if($isPlanMode)
        @include('partials.hero-breadcrumbs', ['breadcrumbs' => [['label' => 'Home', 'url' => url('/')], ['label' => 'Trip Essentials']]])
    @else
        @include('partials.hero-breadcrumbs', ['breadcrumbs' => [['label' => 'Home', 'url' => url('/')], ['label' => 'Services', 'url' => route('guest.all_services')]]])
    @endif

    {{-- ── Services Grid ── --}}
    <section class="all-services-section">
        <div class="container">
            <div class="text-center mb-2">
                @if($isPlanMode)
                    <span class="section-label" style="justify-content:center;">Trip Essentials</span>
                    <h2 class="section-heading">Everything You Need for Your Trip</h2>
                    <p class="section-sub">Start with a tour, book your flight, then secure your hotel — we handle it all.</p>
                @else
                    <span class="section-label" style="justify-content:center;">Our Services</span>
                    <h2 class="section-heading">Everything You Need, In One Place</h2>
                    <p class="section-sub">From guided safaris to airport transfers and conference management — Ubuvivi has you covered.</p>
                @endif
            </div>

            <div class="row g-4 services-slider">

                {{-- 1. Tours & Travel — always first --}}
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

                {{-- 2. Air Ticketing --}}
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <a href="{{ route('guest.air_ticketing') }}" class="d-block" style="text-decoration:none;color:inherit;">
                            <img src="{{ asset('images/ticket.jpg') }}" alt="Air Ticketing" class="service-card-img">
                        </a>
                        <div class="service-card-body">
                            <div class="service-card-icon">
                                <i class="fas fa-plane"></i>
                            </div>
                            <div class="service-card-title">Air Ticketing</div>
                            <p class="service-card-desc">Book flights from Kigali to destinations worldwide. We find the best fares across all major airlines so you travel for less.</p>
                            <a href="{{ route('guest.air_ticketing') }}" class="service-card-cta">Book Flights <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                {{-- 3. Hotel Booking --}}
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <a href="{{ route('guest.hotel_booking') }}" class="d-block" style="text-decoration:none;color:inherit;">
                            <img src="{{ asset('assets/images/hotel-booking.jpg') }}" alt="Hotel Booking" class="service-card-img">
                        </a>
                        <div class="service-card-body">
                            <div class="service-card-icon">
                                <i class="fas fa-hotel"></i>
                            </div>
                            <div class="service-card-title">Hotel Booking</div>
                            <p class="service-card-desc">Find and book the perfect hotel across Rwanda and Africa. We secure the best rates and locations for a comfortable stay.</p>
                            <a href="{{ route('guest.hotel_booking') }}" class="service-card-cta">Browse Hotels <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                @if(!$isPlanMode)
                {{-- Car Rentals — full mode only --}}
                <div class="col-md-6 col-lg-4">
                    <a href="{{ url('/cars') }}" class="service-card d-block">
                        <img src="{{ asset('assets/images/car-rental.jpg') }}" alt="Car Rentals" class="service-card-img">
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

                {{-- Transport Services — full mode only --}}
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('guest.transfer') }}" class="service-card d-block">
                        <img src="{{ asset('assets/images/vehicles/landcruiser_prado_txl.jpg') }}" alt="Transport Services" class="service-card-img">
                        <div class="service-card-body">
                            <div class="service-card-icon">
                                <i class="fas fa-shuttle-van"></i>
                            </div>
                            <div class="service-card-title">Transport Services</div>
                            <p class="service-card-desc">Reliable airport pickups, hotel transfers, and city-to-city transport with professional drivers available 24/7.</p>
                            <span class="service-card-cta">Book Transport <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>

                {{-- Conference Planning — full mode only --}}
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('guest.events') }}" class="service-card d-block">
                        <img src="{{ asset('images/conference-hero.webp') }}" alt="Conference Planning" class="service-card-img">
                        <div class="service-card-body">
                            <div class="service-card-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="service-card-title">Conference Planning</div>
                            <p class="service-card-desc">From executive sessions to large corporate conferences, we handle every detail so you don't have to.</p>
                            <span class="service-card-cta">Learn More <i class="fas fa-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
                @endif

            </div>

            @if($isPlanMode)
            <div class="text-center mt-5">
                <a href="{{ route('guest.all_services') }}" style="color:#C85A2A;font-size:14px;font-weight:600;text-decoration:none;">
                    <i class="fas fa-th-large" style="margin-right:6px;"></i>View All Services
                </a>
            </div>
            @endif
        </div>
    </section>

    {{-- ── News & Upcoming Events ── --}}
    @if($isPlanMode && $newsPosts->count())
    <section class="news-section">
        <div class="container">
            <div class="text-center mb-2">
                <span class="section-label" style="justify-content:center;">Stay in the Loop</span>
                <h2 class="section-heading">Latest News &amp; Upcoming Events</h2>
                <p class="section-sub">See what's happening at Ubuvivi before you plan your trip.</p>
            </div>

            <div class="row g-4">
                @foreach($newsPosts as $post)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('blog.show', $post->slug) }}" class="news-card">
                        @if($post->image)
                            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="news-card-img">
                        @else
                            <div class="news-card-no-img"><i class="fas fa-newspaper"></i></div>
                        @endif
                        <div class="news-card-body">
                            <span class="news-card-tag tag-{{ $post->category }}">{{ $post->category_label }}</span>
                            <div class="news-card-title">{{ $post->title }}</div>
                            <span class="news-card-date">
                                {{ ($post->published_at ?? $post->created_at)->format('M j, Y') }}
                            </span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('blog.index') }}" style="color:#C85A2A;font-size:14px;font-weight:600;text-decoration:none;">
                    <i class="fas fa-newspaper" style="margin-right:6px;"></i>View All News &amp; Events
                </a>
            </div>
        </div>
    </section>
    @endif

@endsection

@section('scripts')
<script>
(function() {
    var videos = [
        "{{ asset('videos/giraffes.mp4') }}",
        "{{ asset('videos/Man_driving_car_in_Kigali_202605240630.mp4') }}",
        "{{ asset('videos/Jet_soaring_through_clear_sky_202605240346.mp4') }}",
        "{{ asset('videos/hall.mp4') }}"
    ];
    var idx = 0;
    var vid = document.getElementById('servicesHeroVideo');
    if (vid) {
        vid.addEventListener('ended', function() {
            idx = (idx + 1) % videos.length;
            vid.src = videos[idx];
            vid.load();
            vid.play();
        });
    }
})();
</script>
@endsection
