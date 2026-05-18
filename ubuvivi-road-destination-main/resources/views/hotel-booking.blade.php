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
        background: url('{{ asset("assets/images/backgrounds/bg_11.jpg") }}') center/cover no-repeat;
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
    .dest-slider-wrap { position: relative; padding: 0 52px; }
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
    }
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

    {{-- ── Search Bar ── --}}
    <div class="hb-search-bar">
        <div class="container">
            <div class="hb-inputs-row">
                <div class="hb-input-group" style="flex:1.5;">
                    <div class="hb-input-label"><i class="fas fa-map-marker-alt"></i> Destination</div>
                    <input type="text" id="hotelDest" placeholder="City, hotel, or place" value="Kigali">
                </div>
                <div class="hb-input-group">
                    <div class="hb-input-label"><i class="fas fa-calendar-alt"></i> Check-in</div>
                    <input type="date" id="checkIn">
                </div>
                <div class="hb-input-group">
                    <div class="hb-input-label"><i class="fas fa-calendar-alt"></i> Check-out</div>
                    <input type="date" id="checkOut">
                </div>
                <div class="hb-input-group" style="flex:0 0 120px;">
                    <div class="hb-input-label"><i class="fas fa-user-friends"></i> Guests</div>
                    <select id="guestCount">
                        <option>1 Guest</option>
                        <option selected>2 Guests</option>
                        <option>3 Guests</option>
                        <option>4 Guests</option>
                        <option>5+ Guests</option>
                    </select>
                </div>
                <div class="hb-input-group" style="flex:0 0 110px;">
                    <div class="hb-input-label"><i class="fas fa-door-open"></i> Rooms</div>
                    <select id="roomCount">
                        <option selected>1 Room</option>
                        <option>2 Rooms</option>
                        <option>3 Rooms</option>
                        <option>4+ Rooms</option>
                    </select>
                </div>
                <div class="hb-search-btn-wrap">
                    <button class="hb-search-btn" onclick="searchHotels()">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Popular Destinations ── --}}
    <section class="hb-destinations-section">
        <div class="container">
            <h2 class="hb-section-h">Popular Destinations</h2>
            <div class="hb-underline"></div>
            <div class="dest-slider-wrap">
                <button class="slider-arrow-btn prev-btn" onclick="slideHotelDest(-1)">&#8249;</button>
                <div class="row">
                    @php
                    $hotelDests = [
                        ['name' => 'Kigali',     'tag' => 'Rwanda',   'bg' => 'bg_6.jpg'],
                        ['name' => 'Musanze',    'tag' => 'Rwanda',   'bg' => 'bg_01.jpg'],
                        ['name' => 'Nairobi',    'tag' => 'Kenya',    'bg' => 'bg_02.jpg'],
                        ['name' => 'Zanzibar',   'tag' => 'Tanzania', 'bg' => 'bg_8.jpg'],
                    ];
                    @endphp
                    @foreach($hotelDests as $d)
                    <div class="col-6 col-md-3 mb-4">
                        <div class="hb-dest-card">
                            <div class="hb-dest-img" style="background-image: url('{{ asset('assets/images/backgrounds/'.$d['bg']) }}');"></div>
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
            <h2 class="fh-section-h">Featured Hotels</h2>
            <div class="fh-underline"></div>

            @php
            $hotels = [
                [
                    'name'     => 'Kigali Marriott Hotel',
                    'location' => 'KN 3 Ave, Kigali',
                    'stars'    => 5,
                    'features' => ['Pool', 'Spa', 'Free Wi-Fi', 'Restaurant'],
                    'price'    => '$280',
                    'bg'       => 'bg_12.jpg',
                ],
                [
                    'name'     => 'Radisson Blu Hotel',
                    'location' => 'KG 2 Roundabout, Kigali',
                    'stars'    => 5,
                    'features' => ['Conference', 'Gym', 'Rooftop Bar', 'Parking'],
                    'price'    => '$240',
                    'bg'       => 'bg_13.jpg',
                ],
                [
                    'name'     => 'Heaven Restaurant & Boutique Hotel',
                    'location' => 'KN 29 St, Kigali',
                    'stars'    => 4,
                    'features' => ['Garden', 'Free Wi-Fi', 'Pool', 'Bar'],
                    'price'    => '$185',
                    'bg'       => 'bg_5.jpg',
                ],
                [
                    'name'     => 'Gorilla\'s Nest Lodge',
                    'location' => 'Musanze, Rwanda',
                    'stars'    => 4,
                    'features' => ['Safari View', 'Fireplace', 'Restaurant', 'Trekking'],
                    'price'    => '$320',
                    'bg'       => 'bg_7.jpg',
                ],
                [
                    'name'     => 'One&Only Nyungwe House',
                    'location' => 'Nyungwe Forest, Rwanda',
                    'stars'    => 5,
                    'features' => ['Forest View', 'Spa', 'Pool', 'All Inclusive'],
                    'price'    => '$650',
                    'bg'       => 'bg_02.jpg',
                ],
                [
                    'name'     => 'Lake Kivu Serena Hotel',
                    'location' => 'Gisenyi, Rwanda',
                    'stars'    => 4,
                    'features' => ['Lake View', 'Beach', 'Free Wi-Fi', 'Restaurant'],
                    'price'    => '$210',
                    'bg'       => 'bg_8.jpg',
                ],
            ];
            @endphp

            <div class="row">
                @foreach($hotels as $h)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="hotel-card">
                        <div class="hotel-card-img" style="background-image: url('{{ asset('assets/images/backgrounds/'.$h['bg']) }}');"></div>
                        <div class="hotel-card-body">
                            <div class="hotel-stars">
                                @for($i=0; $i<$h['stars']; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @if($h['stars'] < 5)
                                    <i class="far fa-star"></i>
                                @endif
                            </div>
                            <div class="hotel-name">{{ $h['name'] }}</div>
                            <div class="hotel-location">
                                <i class="fas fa-map-marker-alt"></i> {{ $h['location'] }}
                            </div>
                            <div class="hotel-features">
                                @foreach($h['features'] as $feat)
                                    <span class="hotel-feature-tag">{{ $feat }}</span>
                                @endforeach
                            </div>
                            <div class="hotel-footer">
                                <div>
                                    <div class="hotel-price-label">Starting from</div>
                                    <span class="hotel-price">{{ $h['price'] }}</span>
                                    <span class="hotel-price-night">/night</span>
                                </div>
                                <button class="hotel-book-btn" onclick="alert('Contact us at +250 789 044 222 to book this hotel!')">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ci = new Date(); ci.setDate(ci.getDate() + 3);
    const co = new Date(); co.setDate(co.getDate() + 7);
    document.getElementById('checkIn').valueAsDate  = ci;
    document.getElementById('checkOut').valueAsDate = co;
});

function searchHotels() {
    document.querySelector('.featured-hotels-section').scrollIntoView({ behavior: 'smooth' });
}

function slideHotelDest(dir) {
    const grid = document.querySelector('.hb-destinations-section .dest-slider-wrap .row');
    grid.style.transition = 'opacity .3s';
    grid.style.opacity = '0.6';
    setTimeout(() => { grid.style.opacity = '1'; }, 300);
}
</script>
@endsection
