@extends('layouts.guest')

@section('title')
    {{ $hotel->name }} - Ubuvivi Tours
@endsection

@section('body-class', 'hero-page')

@php
    $images = $hotel->images ?? [];
    if (is_string($images)) { $images = json_decode($images, true) ?? []; }
    $gallery = is_array($images) ? array_values(array_filter($images)) : [];
    $hero = !empty($gallery) ? $gallery[0] : null;
@endphp

@section('meta')
    <meta name="description" content="Book {{ $hotel->name }} in {{ $hotel->location }} with Ubuvivi Tours & Safaris.">
@endsection

@section('css')
<style>
    /* ── Hero ── */
    .hd-hero {
        position: relative;
        height: 420px;
        background: {{ $hero ? "url('".htmlspecialchars($hero, ENT_QUOTES, 'UTF-8')."')" : 'var(--navy)' }} center/cover no-repeat;
        display: flex; align-items: flex-end;
    }
    .hd-hero::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(180deg, rgba(13,31,53,.15) 0%, rgba(13,31,53,.82) 100%);
    }
    .hd-hero-content { position: relative; z-index: 2; padding: 40px 0; color: #fff; width: 100%; }
    .hd-stars { color: #f5c518; font-size: 15px; margin-bottom: 10px; }
    .hd-stars .far { color: rgba(255,255,255,.4); }
    .hd-title { font-size: 38px; font-weight: 800; margin: 0 0 8px; line-height: 1.15; }
    .hd-loc { font-size: 15px; opacity: .92; display: flex; align-items: center; gap: 7px; }
    .hd-loc i { color: var(--orange); }

    /* ── Body layout ── */
    .hd-section { padding: 50px 0 70px; background: #f7f9fc; }
    .hd-grid { display: grid; grid-template-columns: 1fr 360px; gap: 32px; align-items: start; }

    .hd-card { background: #fff; border-radius: 16px; box-shadow: 0 2px 16px rgba(13,31,53,.06); padding: 28px 30px; margin-bottom: 24px; }
    .hd-card h2 { font-size: 20px; font-weight: 700; color: #1a1a2e; margin: 0 0 16px; }
    .hd-card p { font-size: 15px; color: #555; line-height: 1.8; margin: 0; }

    /* ── Gallery ── */
    .hd-gallery { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; }
    .hd-gallery .g-item {
        height: 150px; border-radius: 12px; overflow: hidden; cursor: pointer;
        background-size: cover; background-position: center; position: relative;
        transition: transform .2s;
    }
    .hd-gallery .g-item:hover { transform: scale(1.02); }
    .hd-gallery .g-more {
        display: flex; align-items: center; justify-content: center;
        background: rgba(13,31,53,.7); color: #fff; font-size: 18px; font-weight: 700;
        position: absolute; inset: 0;
    }

    /* ── Amenities ── */
    .hd-amenities { display: flex; flex-wrap: wrap; gap: 10px; }
    .hd-amenity {
        background: #f0f4f8; color: #34526b; padding: 8px 16px;
        border-radius: 50px; font-size: 13px; font-weight: 500;
        display: flex; align-items: center; gap: 7px;
    }
    .hd-amenity i { color: var(--orange); font-size: 12px; }

    /* ── Booking sidebar ── */
    .hd-book-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(13,31,53,.1); padding: 26px 28px; position: sticky; top: 100px; }
    .hd-price-block { padding-bottom: 18px; margin-bottom: 18px; border-bottom: 1px solid #f0f2f7; }
    .hd-price-label { font-size: 13px; color: #999; }
    .hd-price { font-size: 30px; font-weight: 800; color: var(--orange); }
    .hd-price-night { font-size: 14px; color: #aaa; font-weight: 500; }
    .hd-price-contact { font-size: 20px; font-weight: 700; color: #34526b; }

    .hd-fl { display: block; font-size: 13px; font-weight: 600; color: #444; margin-bottom: 6px; }
    .hd-fi {
        width: 100%; padding: 11px 14px; border: 1.5px solid #e2e6ee;
        border-radius: 9px; font-size: 14px; outline: none; font-family: inherit;
        margin-bottom: 14px; color: #1a1a2e;
    }
    .hd-fi:focus { border-color: var(--navy); }
    .hd-submit {
        width: 100%; background: var(--orange); color: #fff; border: none;
        border-radius: 50px; padding: 14px; font-size: 15px; font-weight: 700;
        cursor: pointer; transition: opacity .2s;
    }
    .hd-submit:hover { opacity: .9; }
    .hd-back { display: inline-flex; align-items: center; gap: 7px; color: #fff; text-decoration: none; font-size: 14px; opacity: .9; margin-bottom: 18px; }
    .hd-back:hover { color: var(--orange); }

    /* ── Lightbox ── */
    .hg-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.92); z-index: 4000; align-items: center; justify-content: center; }
    .hg-overlay.open { display: flex; }
    .hg-main-img { max-width: 90vw; max-height: 80vh; border-radius: 10px; object-fit: contain; }
    .hg-close { position: absolute; top: 22px; right: 26px; background: none; border: none; color: #fff; font-size: 38px; cursor: pointer; }
    .hg-nav { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,.15); border: none; color: #fff; width: 50px; height: 50px; border-radius: 50%; font-size: 22px; cursor: pointer; display: flex; align-items: center; justify-content: center; }
    .hg-nav:hover { background: rgba(255,255,255,.32); }
    .hg-prev { left: 18px; } .hg-next { right: 18px; }
    .hg-counter { position: absolute; bottom: 22px; left: 50%; transform: translateX(-50%); color: #fff; background: rgba(0,0,0,.5); padding: 5px 16px; border-radius: 50px; font-size: 14px; }

    @media (max-width: 991px) {
        .hd-grid { grid-template-columns: 1fr; }
        .hd-book-card { position: static; }
    }
    @media (max-width: 576px) {
        .hd-hero { height: 320px; }
        .hd-title { font-size: 26px; }
        .hd-gallery { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endsection

@section('content')

    {{-- Hero --}}
    <section class="hd-hero">
        <div class="container">
            <div class="hd-hero-content">
                <a href="{{ route('guest.hotel_booking') }}" class="hd-back"><i class="fas fa-arrow-left"></i> Back to Hotels</a>
                <div class="hd-stars">
                    @for($i = 0; $i < $hotel->stars; $i++)<i class="fas fa-star"></i>@endfor
                    @for($i = $hotel->stars; $i < 5; $i++)<i class="far fa-star"></i>@endfor
                </div>
                <h1 class="hd-title">{{ $hotel->name }}</h1>
                <div class="hd-loc"><i class="fas fa-map-marker-alt"></i> {{ $hotel->location }}</div>
            </div>
        </div>
    </section>

    <section class="hd-section">
        <div class="container">
            <div class="hd-grid">

                {{-- Left column --}}
                <div>
                    {{-- Gallery --}}
                    @if(count($gallery))
                    <div class="hd-card">
                        <h2>Photos</h2>
                        <div class="hd-gallery">
                            @foreach(array_slice($gallery, 0, 6) as $i => $img)
                            <div class="g-item" style="background-image:url('{{ htmlspecialchars($img, ENT_QUOTES, 'UTF-8') }}');" onclick="openGallery({{ $i }})">
                                @if($i === 5 && count($gallery) > 6)
                                    <div class="g-more">+{{ count($gallery) - 6 }} more</div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Description --}}
                    @if($hotel->description)
                    <div class="hd-card">
                        <h2>About this hotel</h2>
                        <p>{{ $hotel->description }}</p>
                    </div>
                    @endif

                    {{-- Amenities --}}
                    @if(!empty($hotel->amenities))
                    <div class="hd-card">
                        <h2>Amenities</h2>
                        <div class="hd-amenities">
                            @foreach($hotel->amenities as $am)
                                <span class="hd-amenity"><i class="fas fa-check"></i> {{ $am }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Booking sidebar --}}
                <div>
                    <div class="hd-book-card">
                        <div class="hd-price-block">
                            @if($hotel->price_per_night)
                                <div class="hd-price-label">Starting from</div>
                                <span class="hd-price">${{ number_format($hotel->price_per_night, 0) }}</span>
                                <span class="hd-price-night">/ night</span>
                            @else
                                <span class="hd-price-contact">Contact for price</span>
                            @endif
                        </div>

                        @if($errors->any())
                            <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:12px 16px;margin-bottom:16px;font-size:13px;color:#dc2626;">
                                @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                            </div>
                        @endif

                        @if(session('success'))
                            <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;padding:12px 16px;margin-bottom:16px;font-size:13px;color:#15803d;">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('hotel.booking.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                            <input type="hidden" name="hotel_name" value="{{ $hotel->name }}">

                            <label class="hd-fl">Full Name <span style="color:#e74c3c">*</span></label>
                            <input class="hd-fi" type="text" name="names" value="{{ old('names') }}" placeholder="Your full name" required>

                            <label class="hd-fl">Email <span style="color:#e74c3c">*</span></label>
                            <input class="hd-fi" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>

                            <label class="hd-fl">Phone Number <span style="color:#e74c3c">*</span></label>
                            <input class="hd-fi" type="tel" name="phone_number" value="{{ old('phone_number') }}" placeholder="+250 7XX XXX XXX" required>

                            <label class="hd-fl">Check-in <span style="color:#e74c3c">*</span></label>
                            <input class="hd-fi" type="date" name="check_in" value="{{ old('check_in') }}" min="{{ date('Y-m-d') }}" required>

                            <label class="hd-fl">Check-out <span style="color:#e74c3c">*</span></label>
                            <input class="hd-fi" type="date" name="check_out" value="{{ old('check_out') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>

                            <label class="hd-fl">Guests <span style="color:#e74c3c">*</span></label>
                            <input class="hd-fi" type="number" name="number_of_guests" value="{{ old('number_of_guests', 1) }}" min="1" required>

                            <label class="hd-fl">Room Type</label>
                            <select class="hd-fi" name="room_type">
                                <option value="">Select (optional)</option>
                                <option value="Single">Single</option>
                                <option value="Double">Double</option>
                                <option value="Twin">Twin</option>
                                <option value="Suite">Suite</option>
                                <option value="Family">Family Room</option>
                            </select>

                            <label class="hd-fl">Special Requests</label>
                            <textarea class="hd-fi" name="message" rows="3" placeholder="Any preferences...">{{ old('message') }}</textarea>

                            <button type="submit" class="hd-submit">
                                <i class="fas fa-paper-plane" style="margin-right:7px;"></i>Request Booking
                            </button>
                            <p style="text-align:center;font-size:12px;color:#999;margin:12px 0 0;">We'll confirm availability and pricing shortly.</p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Lightbox --}}
    @if(count($gallery))
    <div class="hg-overlay" id="hotelGallery">
        <button class="hg-close" onclick="closeGallery()">&times;</button>
        <button class="hg-nav hg-prev" onclick="galleryStep(-1)"><i class="fas fa-chevron-left"></i></button>
        <img class="hg-main-img" id="hgMainImg" src="" alt="{{ $hotel->name }}">
        <button class="hg-nav hg-next" onclick="galleryStep(1)"><i class="fas fa-chevron-right"></i></button>
        <span class="hg-counter" id="hgCounter"></span>
    </div>
    @endif

@endsection

@section('scripts')
<script>
var galleryImages = @json($gallery);
var hgIdx = 0;

function openGallery(i) {
    if (!galleryImages.length) return;
    hgIdx = i;
    renderGallery();
    document.getElementById('hotelGallery').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function renderGallery() {
    document.getElementById('hgMainImg').src = galleryImages[hgIdx];
    document.getElementById('hgCounter').textContent = (hgIdx + 1) + ' / ' + galleryImages.length;
    var single = galleryImages.length <= 1;
    document.querySelector('.hg-prev').style.display = single ? 'none' : 'flex';
    document.querySelector('.hg-next').style.display = single ? 'none' : 'flex';
}
function galleryStep(dir) {
    hgIdx = (hgIdx + dir + galleryImages.length) % galleryImages.length;
    renderGallery();
}
function closeGallery() {
    document.getElementById('hotelGallery').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function (e) {
    var ov = document.getElementById('hotelGallery');
    if (!ov || !ov.classList.contains('open')) return;
    if (e.key === 'Escape') closeGallery();
    if (e.key === 'ArrowLeft') galleryStep(-1);
    if (e.key === 'ArrowRight') galleryStep(1);
});
document.addEventListener('DOMContentLoaded', function () {
    var ov = document.getElementById('hotelGallery');
    if (ov) ov.addEventListener('click', function (e) { if (e.target === this) closeGallery(); });
});
</script>
@endsection
