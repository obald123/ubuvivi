@extends('layouts.guest')

@section('title')
    Hotel Booking - Ubuvivi Tours & Safaris
@endsection

@section('meta')
    <meta name="description" content="Find and book the best hotels in Rwanda and across Africa with Ubuvivi Tours & Safaris. Great rates, top locations.">
    <meta name="keywords" content="hotel booking Rwanda, hotels Kigali, accommodation Rwanda, Ubuvivi hotels">
@endsection

@section('css')
<style>
    :root { --orange: #C85A2A; --navy: #0D1F35; }

    /* ── Search Bar ── */
    .hb-search-bar { background: var(--navy); padding: 28px 0 32px; }
    .hb-search-label {
        color: rgba(255,255,255,.7); font-size: 13px;
        margin-bottom: 14px; display: block;
    }
    .hb-inputs-row {
        display: flex; align-items: stretch;
        background: #fff; border-radius: 12px; overflow: hidden;
    }
    .hb-input-group {
        flex: 1; display: flex; flex-direction: column;
        justify-content: center; padding: 12px 18px;
        border-right: 1px solid #ececec; min-width: 0;
    }
    .hb-input-group:last-of-type { border-right: none; }
    .hb-input-label {
        font-size: 11px; color: #aaa; text-transform: uppercase;
        letter-spacing: .5px; margin-bottom: 4px; display: flex;
        align-items: center; gap: 6px;
    }
    .hb-input-label i { color: var(--orange); font-size: 12px; }
    .hb-input-group input,
    .hb-input-group select {
        border: none; outline: none; background: transparent;
        font-size: 15px; color: #1a1a1a; width: 100%;
        font-weight: 500;
    }
    .hb-input-group select option { color: #333; }
    .hb-guest-row {
        display: flex; gap: 0; flex: 0 0 200px;
    }
    .hb-guest-row .hb-input-group { flex: 1; }
    .hb-search-btn-wrap {
        display: flex; align-items: center; padding: 8px;
        flex-shrink: 0;
    }
    .hb-search-btn {
        background: var(--navy); color: #fff; border: none;
        border-radius: 10px; padding: 14px 28px;
        font-size: 15px; font-weight: 700; cursor: pointer;
        display: flex; align-items: center; gap: 8px;
        white-space: nowrap; transition: background .2s;
    }
    .hb-search-btn:hover { background: var(--orange); }

    /* ── Popular Destinations ── */
    .hb-destinations-section { padding: 72px 0; background: #fff; }
    .hb-section-h {
        font-size: clamp(22px, 3vw, 32px);
        font-weight: 800; color: #1a1a1a;
        text-align: center; margin-bottom: 6px;
    }
    .hb-underline {
        width: 60px; height: 3px; background: var(--orange);
        margin: 0 auto 42px; border-radius: 2px;
    }
    .dest-slider-wrap {
        position: relative; overflow: hidden;
        -webkit-mask-image: linear-gradient(to right, transparent 0, #000 6%, #000 94%, transparent 100%);
        mask-image: linear-gradient(to right, transparent 0, #000 6%, #000 94%, transparent 100%);
    }
    .dest-track {
        display: flex; align-items: stretch; width: max-content;
        animation: destSlide 38s linear infinite;
    }
    .dest-track:hover { animation-play-state: paused; }
    .dest-slide {
        flex: 0 0 auto; width: 300px; padding: 0 10px; box-sizing: border-box;
    }
    @media (max-width: 991px) { .dest-slide { width: 260px; } }
    @media (max-width: 575px) { .dest-slide { width: 240px; } }
    @keyframes destSlide {
        from { transform: translateX(0); }
        to   { transform: translateX(-50%); }
    }
    @media (prefers-reduced-motion: reduce) {
        .dest-track { animation: none; }
    }
    a.dest-slide, a.dest-slide:hover { text-decoration: none; color: inherit; }
    .hb-dest-card {
        background: #fff; border-radius: 14px; overflow: hidden;
        box-shadow: 0 2px 18px rgba(0,0,0,.08);
        transition: transform .25s, box-shadow .25s; cursor: pointer;
        border: 2px solid transparent;
    }
    .hb-dest-card:hover { transform: translateY(-4px); box-shadow: 0 8px 32px rgba(0,0,0,.14); }
    .hb-dest-card.is-active {
        border-color: var(--orange);
        box-shadow: 0 8px 28px rgba(200,90,42,.22);
    }

    /* ── Location filter ── */
    .hb-filter-chip-row {
        display: flex; align-items: center; justify-content: center;
        gap: 12px; flex-wrap: wrap; margin: -22px 0 34px;
    }
    .hb-filter-chip {
        display: inline-flex; align-items: center; gap: 8px;
        background: #fff; border: 1.5px solid var(--orange); color: var(--orange);
        padding: 7px 18px; border-radius: 50px; font-size: 14px; font-weight: 600;
    }
    .hb-filter-count {
        background: var(--orange); color: #fff;
        padding: 1px 10px; border-radius: 50px; font-size: 12px;
    }
    .hb-filter-clear {
        display: inline-flex; align-items: center; gap: 7px;
        color: #0D1F35; background: #f0f4f8; border: 1.5px solid #d0d9e4;
        padding: 7px 18px; border-radius: 50px;
        font-size: 14px; font-weight: 600; text-decoration: none;
        transition: background .2s, border-color .2s;
    }
    .hb-filter-clear:hover { background: #e4ebf3; border-color: #b9c6d6; color: #0D1F35; text-decoration: none; }
    .hb-empty-note { text-align: center; padding: 8px 20px 34px; }
    .hb-empty-note i { font-size: 40px; color: #cfd8e3; display: block; margin-bottom: 12px; }
    .hb-empty-title { font-size: 18px; font-weight: 700; color: #1a1a1a; margin: 0 0 4px; }
    .hb-empty-sub { font-size: 15px; color: #777; margin: 0; }
    .hb-dest-img {
        width: 100%; height: 190px;
        background-size: cover; background-position: center; display: block;
    }
    .hb-dest-body { padding: 14px 18px 18px; }
    .hb-dest-name { font-size: 17px; font-weight: 700; color: #1a1a1a; margin-bottom: 2px; }
    .hb-dest-tag { font-size: 13px; color: #999; }

    /* ── Featured Hotels ── */
    .featured-hotels-section { padding: 72px 0; background: #f5f7fa; }
    .fh-section-h {
        font-size: clamp(22px, 3vw, 32px);
        font-weight: 800; color: #1a1a1a;
        text-align: center; margin-bottom: 6px;
    }
    .fh-underline {
        width: 60px; height: 3px; background: var(--orange);
        margin: 0 auto 42px; border-radius: 2px;
    }
    .hotel-card {
        background: #fff; border-radius: 16px; overflow: hidden;
        box-shadow: 0 2px 18px rgba(0,0,0,.07);
        transition: transform .25s, box-shadow .25s; height: 100%;
    }
    .hotel-card:hover { transform: translateY(-4px); box-shadow: 0 8px 32px rgba(0,0,0,.12); }
    .hotel-card-img {
        width: 100%; height: 220px;
        background-size: cover; background-position: center;
        position: relative;
    }
    .hotel-card-img.clickable { cursor: pointer; }
    .hotel-photos-badge {
        position: absolute; bottom: 10px; right: 10px;
        background: rgba(0,0,0,.62); color: #fff;
        padding: 4px 11px; border-radius: 50px;
        font-size: 12px; font-weight: 600;
        display: flex; align-items: center; gap: 5px;
        backdrop-filter: blur(2px);
    }
    .hotel-photos-badge i { font-size: 11px; }
    .hotel-card-body { padding: 20px 22px 24px; }
    .hotel-stars { color: #f5c518; font-size: 13px; margin-bottom: 8px; }
    .hotel-name { font-size: 18px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; }
    .hotel-location { font-size: 13px; color: #888; margin-bottom: 12px; display: flex; align-items: center; gap: 5px; }
    .hotel-location i { color: var(--orange); }
    .hotel-features { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 16px; }
    .hotel-feature-tag {
        background: #f0f0f0; color: #555;
        padding: 4px 10px; border-radius: 20px; font-size: 12px;
    }
    .hotel-footer {
        display: flex; align-items: center;
        justify-content: space-between; padding-top: 14px;
        border-top: 1px solid #f0f0f0;
    }
    .hotel-price-label { font-size: 12px; color: #aaa; }
    .hotel-price { font-size: 22px; font-weight: 800; color: var(--orange); }
    .hotel-price-night { font-size: 12px; color: #aaa; }
    .hotel-book-btn {
        background: var(--navy); color: #fff; border: none;
        padding: 10px 20px; border-radius: 8px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        transition: background .2s;
    }
    .hotel-book-btn:hover { background: var(--orange); }

    /* ── Booking modal form fields ── */
    .hb-fl {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #444;
        margin-bottom: 6px;
    }
    .hb-fi {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 9px;
        font-size: 14px;
        font-family: inherit;
        color: #1a1a2e;
        outline: none;
        background: #fff;
        transition: border-color .2s;
        box-sizing: border-box;
    }
    .hb-fi:focus { border-color: #0D1F35; }
    textarea.hb-fi { resize: vertical; min-height: 80px; }

    @media (max-width: 768px) {
        .hb-inputs-row { flex-direction: column; }
        .hb-input-group { border-right: none; border-bottom: 1px solid #ececec; }
        .hb-input-group:last-of-type { border-bottom: none; }
        .hb-search-btn-wrap { padding: 8px; }
        .hb-search-btn { width: 100%; justify-content: center; }
        .hb-guest-row { flex: unset; width: 100%; }
    }
</style>
@endsection

@section('content')

    @include('partials.back-to-services')


    {{-- ── Destinations With Hotels ── --}}
    <section class="hb-destinations-section">
        <div class="container">
            <h2 class="hb-section-h">Destinations With Hotels</h2>
            <div class="hb-underline"></div>
            <div class="dest-slider-wrap">
                <div class="dest-track">
                    {{-- Rendered twice back-to-back so the marquee loops seamlessly --}}
                    @foreach(array_merge($destinations, $destinations) as $d)
                    @php $isActive = mb_strtolower($location) === mb_strtolower($d['name']); @endphp
                    <a href="{{ route('guest.hotel_booking', ['location' => $d['name']]) }}#hotels"
                       class="dest-slide"
                       aria-label="Show hotels in {{ $d['name'] }}">
                        <div class="hb-dest-card {{ $isActive ? 'is-active' : '' }}">
                            <div class="hb-dest-img" style="background-image: url('{{ $d['img'] }}');"></div>
                            <div class="hb-dest-body">
                                <div class="hb-dest-name">{{ $d['name'] }}</div>
                                <div class="hb-dest-tag">
                                    @if($d['count'] > 0)
                                        {{ $d['count'] }} {{ Str::plural('hotel', $d['count']) }}
                                    @else
                                        {{ $d['tag'] }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ── Featured Hotels ── --}}
    <section class="featured-hotels-section" id="hotels">
        <div class="container">
            <h2 class="fh-section-h">
                @if($location !== '')
                    Hotels in {{ $location }}
                @else
                    Available Hotels
                @endif
            </h2>
            <div class="fh-underline"></div>

            @if($location !== '')
                <div class="hb-filter-chip-row">
                    <span class="hb-filter-chip">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $location }}
                        @if($hotels->count())
                            <span class="hb-filter-count">{{ $hotels->count() }} {{ Str::plural('hotel', $hotels->count()) }}</span>
                        @endif
                    </span>
                    <a href="{{ route('guest.hotel_booking') }}#hotels" class="hb-filter-clear">
                        <i class="fas fa-times"></i> Show all hotels
                    </a>
                </div>
            @endif

            @if($hotels->count())
            <div class="row">
                @foreach($hotels as $h)
                <div class="col-md-6 col-lg-4 mb-4">
                    @include('partials.hotel-card', ['hotel' => $h])
                </div>
                @endforeach
            </div>

            @elseif($location !== '' && $nearbyHotels->count())
            {{-- Nothing in this location, so offer the closest places that do have hotels --}}
            <div class="hb-empty-note">
                <i class="fas fa-map-signs"></i>
                <p class="hb-empty-title">No hotels in {{ $location }} yet</p>
                <p class="hb-empty-sub">
                    @if(count($nearbyNames))
                        Here's what we have nearby &mdash; in {{ collect($nearbyNames)->join(', ', ' and ') }}.
                    @else
                        Here's what we have nearby.
                    @endif
                </p>
            </div>
            <div class="row">
                @foreach($nearbyHotels as $h)
                <div class="col-md-6 col-lg-4 mb-4">
                    @include('partials.hotel-card', ['hotel' => $h])
                </div>
                @endforeach
            </div>
            <div style="text-align:center;margin-top:10px;">
                <a href="{{ route('guest.hotel_booking') }}#hotels" style="display:inline-block;background:#C85A2A;color:#fff;padding:10px 28px;border-radius:50px;font-weight:600;text-decoration:none;">View all hotels</a>
            </div>

            @elseif($location !== '')
            <div style="text-align:center;padding:70px 20px;color:#aaa;">
                <i class="fas fa-hotel" style="font-size:48px;display:block;margin-bottom:14px;"></i>
                <p style="font-size:16px;">No hotels in {{ $location }} yet, and nothing nearby to suggest just now.</p>
                <div style="margin-top:16px;display:flex;gap:10px;justify-content:center;flex-wrap:wrap;">
                    <a href="{{ route('guest.hotel_booking') }}#hotels" style="display:inline-block;background:#C85A2A;color:#fff;padding:10px 28px;border-radius:50px;font-weight:600;text-decoration:none;">View all hotels</a>
                    <a href="{{ route('guest.contact') }}" style="display:inline-block;background:#f0f4f8;border:1.5px solid #d0d9e4;color:#0D1F35;padding:10px 28px;border-radius:50px;font-weight:600;text-decoration:none;">Contact Us</a>
                </div>
            </div>

            @else
            <div style="text-align:center;padding:70px 20px;color:#aaa;">
                <i class="fas fa-hotel" style="font-size:48px;display:block;margin-bottom:14px;"></i>
                <p style="font-size:16px;">No hotels listed yet. Check back soon or contact us directly.</p>
                <a href="{{ route('guest.contact') }}" style="display:inline-block;margin-top:16px;background:#C85A2A;color:#fff;padding:10px 28px;border-radius:50px;font-weight:600;text-decoration:none;">Contact Us</a>
            </div>
            @endif
        </div>
    </section>

@endsection

@section('scripts')
<script>
function searchHotels() {
    document.querySelector('.featured-hotels-section').scrollIntoView({ behavior: 'smooth' });
}
</script>
@endsection
