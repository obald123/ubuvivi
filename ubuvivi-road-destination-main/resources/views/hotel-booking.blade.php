@extends('layouts.guest')

@section('title')
    Hotel Booking - Ubuvivi Tours & Safaris
@endsection

@section('meta')
    <meta name="description" content="Find and book the best hotels in Rwanda and across Africa with Ubuvivi Tours & Safaris. Great rates, top locations.">
    <meta name="keywords" content="hotel booking Rwanda, hotels Kigali, accommodation Rwanda, Ubuvivi hotels">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    :root { --orange: #C85A2A; --navy: #0D1F35; }

    /* ── Hero ── */
    .hb-hero {
        position: relative; height: 480px;
        background: url('{{ asset("assets/images/hotel-hero.png") }}') center/cover no-repeat;
        display: flex; align-items: center; justify-content: center; text-align: center;
    }
    .hb-hero::after {
        content: ''; position: absolute; inset: 0;
        background: rgba(13,31,53,.65);
    }
    .hb-hero-content { position: relative; z-index: 2; color: #fff; }
    .hb-hero-content h1 {
        font-size: clamp(32px, 5vw, 58px);
        font-weight: 800;
        color: #fff !important;
        margin-bottom: 14px;
    }
    .hb-hero-content p {
        font-size: 16px; color: rgba(255,255,255,.85);
        max-width: 560px; margin: 0 auto;
    }

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
    .dest-slider-wrap { position: relative; padding: 0 52px; overflow: hidden; }
    .dest-track { display: flex; transition: transform .4s ease; will-change: transform; }
    .dest-slide {
        flex: 0 0 25%; max-width: 25%; padding: 0 10px; box-sizing: border-box;
    }
    @media (max-width: 991px) { .dest-slide { flex: 0 0 50%; max-width: 50%; } }
    @media (max-width: 575px) { .dest-slide { flex: 0 0 100%; max-width: 100%; } }
    .slider-arrow-btn {
        position: absolute; top: 50%; transform: translateY(-50%);
        width: 40px; height: 40px; border-radius: 50%;
        background: #fff; border: 1px solid #e0e0e0; color: #444;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; font-size: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,.1); z-index: 2;
        transition: background .2s, color .2s;
    }
    .slider-arrow-btn:hover { background: var(--orange); color: #fff; border-color: var(--orange); }
    .slider-arrow-btn.prev-btn { left: 0; }
    .slider-arrow-btn.next-btn { right: 0; }
    .hb-dest-card {
        background: #fff; border-radius: 14px; overflow: hidden;
        box-shadow: 0 2px 18px rgba(0,0,0,.08);
        transition: transform .25s, box-shadow .25s; cursor: pointer;
    }
    .hb-dest-card:hover { transform: translateY(-4px); box-shadow: 0 8px 32px rgba(0,0,0,.14); }
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
        .dest-slider-wrap { padding: 0 36px; }
    }
</style>
@endsection

@section('content')

    {{-- ── Hero ── --}}
    <section class="hb-hero">
        <div class="hb-hero-content">
            <h1>Hotel Booking</h1>
            <p>Find and book the perfect accommodation across Rwanda and beyond with the best rates guaranteed.</p>
        </div>
    </section>
    @include('partials.hero-breadcrumbs', ['breadcrumbs' => [['label' => 'Home', 'url' => url('/')], ['label' => 'Hotel Booking']]])


    {{-- ── Popular Destinations ── --}}
    <section class="hb-destinations-section">
        <div class="container">
            <h2 class="hb-section-h">Popular Destinations</h2>
            <div class="hb-underline"></div>
            <div class="dest-slider-wrap" id="hotelDestSliderWrap">
                <button class="slider-arrow-btn prev-btn" onclick="slideHotelDest(-1)">&#8249;</button>
                <div class="dest-track" id="hotelDestTrack">
                    @php
                    $hotelDests = [
                        ['name' => 'Kigali',  'tag' => 'Rwanda', 'img' => asset('assets/images/backgrounds/download (6).jpg')],
                        ['name' => 'Musanze', 'tag' => 'Rwanda', 'img' => asset('assets/images/backgrounds/download (7).jpg')],
                        ['name' => 'Rubavu',  'tag' => 'Rwanda', 'img' => asset('assets/images/backgrounds/download (8).jpg')],
                        ['name' => 'Karongi', 'tag' => 'Rwanda', 'img' => asset('assets/images/backgrounds/images.jpg')],
                        ['name' => 'Nyungwe', 'tag' => 'Rwanda', 'img' => asset('assets/images/backgrounds/bg_7.jpg')],
                        ['name' => 'Akagera', 'tag' => 'Rwanda', 'img' => asset('assets/images/backgrounds/bg_8.jpg')],
                        ['name' => 'Huye',    'tag' => 'Rwanda', 'img' => asset('images/huye.jpg')],
                    ];
                    @endphp
                    @foreach($hotelDests as $d)
                    <div class="dest-slide">
                        <div class="hb-dest-card">
                            <div class="hb-dest-img" style="background-image: url('{{ $d['img'] }}');"></div>
                            <div class="hb-dest-body">
                                <div class="hb-dest-name">{{ $d['name'] }}</div>
                                <div class="hb-dest-tag">{{ $d['tag'] }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="slider-arrow-btn next-btn" onclick="slideHotelDest(1)">&#8250;</button>
            </div>
        </div>
    </section>

    {{-- ── Featured Hotels ── --}}
    <section class="featured-hotels-section">
        <div class="container">
            <h2 class="fh-section-h">Available Hotels</h2>
            <div class="fh-underline"></div>

            @if($hotels->count())
            <div class="row">
                @foreach($hotels as $h)
                <div class="col-md-6 col-lg-4 mb-4">
                    @php $hImages = $h->images ?? []; $detailUrl = route('hotel.view', $h->id); @endphp
                    <div class="hotel-card">
                        @if($h->cover_image)
                            <a href="{{ $detailUrl }}" class="hotel-card-img clickable" style="background-image:url('{{ htmlspecialchars($h->cover_image, ENT_QUOTES, 'UTF-8') }}');background-size:cover;background-position:center;display:block;">
                                @if(count($hImages) > 1)
                                    <span class="hotel-photos-badge"><i class="fas fa-images"></i> {{ count($hImages) }} photos</span>
                                @endif
                            </a>
                        @else
                            <a href="{{ $detailUrl }}" class="hotel-card-img" style="background:#e4e8f0;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-hotel" style="font-size:40px;color:#bbb;"></i>
                            </a>
                        @endif
                        <div class="hotel-card-body">
                            <div class="hotel-stars">
                                @for($i = 0; $i < $h->stars; $i++)<i class="fas fa-star"></i>@endfor
                                @for($i = $h->stars; $i < 5; $i++)<i class="far fa-star" style="color:#ddd;"></i>@endfor
                            </div>
                            <a href="{{ $detailUrl }}" class="hotel-name" style="color:inherit;text-decoration:none;display:block;">{{ $h->name }}</a>
                            <div class="hotel-location">
                                <i class="fas fa-map-marker-alt"></i> {{ $h->location }}
                            </div>
                            <div class="hotel-features">
                                @foreach(array_slice($h->amenities ?? [], 0, 4) as $am)
                                    <span class="hotel-feature-tag">{{ $am }}</span>
                                @endforeach
                            </div>
                            <div class="hotel-footer">
                                <div>
                                    @if($h->price_per_night)
                                        <div class="hotel-price-label">Starting from</div>
                                        <span class="hotel-price">${{ number_format($h->price_per_night, 0) }}</span>
                                        <span class="hotel-price-night">/night</span>
                                    @else
                                        <span class="hotel-price" style="font-size:16px;color:#888;">Contact for price</span>
                                    @endif
                                </div>
                                <a href="{{ $detailUrl }}" class="hotel-book-btn" style="text-decoration:none;display:inline-block;">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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

var hotelDestIdx = 0;
function slideHotelDest(dir) {
    const track = document.getElementById('hotelDestTrack');
    const slides = track.querySelectorAll('.dest-slide');
    const visibleCount = window.innerWidth < 576 ? 1 : window.innerWidth < 992 ? 2 : 4;
    const maxIdx = Math.max(0, slides.length - visibleCount);
    hotelDestIdx = Math.min(Math.max(hotelDestIdx + dir, 0), maxIdx);
    const slideW = track.querySelector('.dest-slide').offsetWidth;
    track.style.transform = 'translateX(-' + (hotelDestIdx * slideW) + 'px)';
}
</script>
@endsection
