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
    @media (max-width: 576px) {
        #hotelBookingModal > div { padding: 24px 18px 28px; border-radius: 18px 18px 0 0; }
        #hotelBookingModal { align-items: flex-end !important; padding: 0; }
        #hotelBookingModal > div > form [style*="grid-template-columns:1fr 1fr"] { grid-template-columns: 1fr !important; }
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
            <div class="dest-slider-wrap" id="hotelDestSliderWrap">
                <button class="slider-arrow-btn prev-btn" onclick="slideHotelDest(-1)">&#8249;</button>
                <div class="dest-track" id="hotelDestTrack">
                    @php
                    $hotelDests = [
                        ['name' => 'Kigali',     'tag' => 'Rwanda',   'bg' => 'download (6).jpg'],
                        ['name' => 'Musanze',    'tag' => 'Rwanda',   'bg' => 'download (7).jpg'],
                        ['name' => 'Rubavu',     'tag' => 'Rwanda',   'bg' => 'download (8).jpg'],
                        ['name' => 'Karongi',    'tag' => 'Rwanda',   'bg' => 'images.jpg'],
                        ['name' => 'Nyungwe',    'tag' => 'Rwanda',   'bg' => 'bg_7.jpg'],
                        ['name' => 'Akagera',    'tag' => 'Rwanda',   'bg' => 'bg_8.jpg'],
                        ['name' => 'Huye',       'tag' => 'Rwanda',   'bg' => 'bg_9.jpg'],
                    ];
                    @endphp
                    @foreach($hotelDests as $d)
                    <div class="dest-slide">
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
            <h2 class="fh-section-h">Available Hotels</h2>
            <div class="fh-underline"></div>

            @if($hotels->count())
            <div class="row">
                @foreach($hotels as $h)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="hotel-card">
                        @if($h->cover_image)
                            <div class="hotel-card-img" style="background-image:url('{{ htmlspecialchars($h->cover_image, ENT_QUOTES, 'UTF-8') }}');background-size:cover;background-position:center;"></div>
                        @else
                            <div class="hotel-card-img" style="background:#e4e8f0;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-hotel" style="font-size:40px;color:#bbb;"></i>
                            </div>
                        @endif
                        <div class="hotel-card-body">
                            <div class="hotel-stars">
                                @for($i = 0; $i < $h->stars; $i++)<i class="fas fa-star"></i>@endfor
                                @for($i = $h->stars; $i < 5; $i++)<i class="far fa-star" style="color:#ddd;"></i>@endfor
                            </div>
                            <div class="hotel-name">{{ $h->name }}</div>
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
                                    <div class="hotel-price-label">Starting from</div>
                                    @if($h->price_per_night)
                                        <span class="hotel-price">${{ number_format($h->price_per_night, 0) }}</span>
                                        <span class="hotel-price-night">/night</span>
                                    @else
                                        <span class="hotel-price" style="font-size:16px;color:#888;">Contact for price</span>
                                    @endif
                                </div>
                                <button class="hotel-book-btn" onclick="openBookingModal({{ $h->id }}, '{{ addslashes($h->name) }}')">
                                    Book Now
                                </button>
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

    {{-- ── Booking Modal ── --}}
    <div id="hotelBookingModal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,.5);z-index:3000;align-items:center;justify-content:center;padding:16px;">
        <div style="background:#fff;border-radius:20px;padding:32px 36px;max-width:600px;width:100%;max-height:92vh;overflow-y:auto;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:22px;">
                <h3 style="margin:0;font-size:20px;font-weight:700;color:#0D1F35;">Book <span id="modalHotelName"></span></h3>
                <button onclick="closeBookingModal()" style="background:none;border:none;font-size:24px;cursor:pointer;color:#aaa;line-height:1;">&times;</button>
            </div>

            @if($errors->any())
                <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:12px 16px;margin-bottom:18px;font-size:13px;color:#dc2626;">
                    @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                </div>
            @endif

            <form action="{{ route('hotel.booking.store') }}" method="POST">
                @csrf
                <input type="hidden" name="hotel_id"   id="modalHotelId">
                <input type="hidden" name="hotel_name" id="modalHotelNameHidden">

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                    <div>
                        <label class="hb-fl">Full Name <span style="color:#e74c3c">*</span></label>
                        <input class="hb-fi" type="text" name="names" value="{{ old('names') }}" placeholder="Your full name" required>
                    </div>
                    <div>
                        <label class="hb-fl">Email <span style="color:#e74c3c">*</span></label>
                        <input class="hb-fi" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                    </div>
                </div>
                <div style="margin-bottom:16px;">
                    <label class="hb-fl">Phone Number <span style="color:#e74c3c">*</span></label>
                    <input class="hb-fi" type="tel" name="phone_number" value="{{ old('phone_number') }}" placeholder="+250 7XX XXX XXX" required>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                    <div>
                        <label class="hb-fl">Check-in Date <span style="color:#e74c3c">*</span></label>
                        <input class="hb-fi" type="date" name="check_in" value="{{ old('check_in') }}" min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div>
                        <label class="hb-fl">Check-out Date <span style="color:#e74c3c">*</span></label>
                        <input class="hb-fi" type="date" name="check_out" value="{{ old('check_out') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                    <div>
                        <label class="hb-fl">Number of Guests <span style="color:#e74c3c">*</span></label>
                        <input class="hb-fi" type="number" name="number_of_guests" value="{{ old('number_of_guests', 1) }}" min="1" required>
                    </div>
                    <div>
                        <label class="hb-fl">Room Type</label>
                        <select class="hb-fi" name="room_type">
                            <option value="">Select (optional)</option>
                            <option value="Single">Single</option>
                            <option value="Double">Double</option>
                            <option value="Twin">Twin</option>
                            <option value="Suite">Suite</option>
                            <option value="Family">Family Room</option>
                        </select>
                    </div>
                </div>
                <div style="margin-bottom:22px;">
                    <label class="hb-fl">Special Requests</label>
                    <textarea class="hb-fi" name="message" rows="3" placeholder="Any preferences or special requirements...">{{ old('message') }}</textarea>
                </div>
                <button type="submit" style="width:100%;background:#C85A2A;color:#fff;border:none;border-radius:50px;padding:14px;font-size:15px;font-weight:700;cursor:pointer;transition:background .2s;">
                    <i class="fas fa-paper-plane" style="margin-right:8px;"></i>Submit Booking Request
                </button>
                <p style="text-align:center;font-size:13px;color:#999;margin-top:12px;">Our team will confirm availability and pricing shortly.</p>
            </form>
        </div>
    </div>

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

function openBookingModal(id, name) {
    document.getElementById('modalHotelId').value           = id;
    document.getElementById('modalHotelNameHidden').value   = name;
    document.getElementById('modalHotelName').textContent   = name;
    document.getElementById('hotelBookingModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeBookingModal() {
    document.getElementById('hotelBookingModal').style.display = 'none';
    document.body.style.overflow = '';
}

document.addEventListener('DOMContentLoaded', function () {
    // Re-open modal on validation error
    @if($errors->any() && old('hotel_id'))
    openBookingModal({{ old('hotel_id') }}, '{{ addslashes(old("hotel_name", "")) }}');
    @endif

    // Close on backdrop click
    document.getElementById('hotelBookingModal').addEventListener('click', function(e) {
        if (e.target === this) closeBookingModal();
    });
});
</script>
@endsection
