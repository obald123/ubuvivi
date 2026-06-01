@extends('layouts.guest')

@section('title')
    Air Ticketing - Ubuvivi Tours & Safaris
@endsection

@section('meta')
    <meta name="description" content="Book flights with Ubuvivi Tours & Safaris. Find the best routes, prices, and travel options from Kigali worldwide.">
    <meta name="keywords" content="air ticketing Rwanda, flights from Kigali, book flights Rwanda, RwandaAir, Ubuvivi flights">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    :root { --orange: #C85A2A; --navy: #0D1F35; }

    /* ── Hero ── */
    .at-hero {
        position: relative;
        height: 480px;
        overflow: hidden;
        display: flex; align-items: center; justify-content: center; text-align: center;
    }
    .at-hero-video {
        position: absolute;
        inset: 0;
        width: 100%; height: 100%;
        object-fit: cover;
        z-index: 0;
    }
    .at-hero::after {
        content: ''; position: absolute; inset: 0;
        background: rgba(13,31,53,.65);
        z-index: 1;
    }
    .at-hero-content { position: relative; z-index: 2; color: #fff; }
    .at-hero-content h1 {
        font-size: clamp(32px, 5vw, 58px);
        font-weight: 800;
        color: #fff !important;
        margin-bottom: 14px;
    }
    .at-hero-content p {
        font-size: 16px; color: rgba(255,255,255,.85);
        max-width: 560px; margin: 0 auto;
    }

    /* ── Search Bar ── */
    .at-search-bar { background: var(--navy); padding: 28px 0 32px; }
    .at-trip-toggle {
        display: flex; align-items: center; gap: 6px;
        margin-bottom: 14px;
    }
    .at-trip-btn {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.22);
        color: rgba(255,255,255,.85);
        padding: 7px 18px; border-radius: 50px;
        font-size: 13px; font-weight: 500; cursor: pointer;
        transition: all .2s; user-select: none;
    }
    .at-trip-btn.active {
        background: #fff; color: var(--navy);
        border-color: transparent; font-weight: 700;
    }
    .at-trip-btn:not(.active):hover { background: rgba(255,255,255,.22); }

    /* ── Inputs Row ── */
    .at-inputs-row {
        display: flex; align-items: stretch;
        background: #fff; border-radius: 12px; overflow: hidden;
    }
    .at-input-group {
        flex: 1; display: flex; flex-direction: column;
        justify-content: center; padding: 12px 18px;
        border-right: 1px solid #ececec; min-width: 0;
    }
    .at-input-group:last-of-type { border-right: none; }
    .at-input-label {
        font-size: 11px; color: #aaa; text-transform: uppercase;
        letter-spacing: .5px; margin-bottom: 4px;
        display: flex; align-items: center; gap: 6px;
    }
    .at-input-label i { color: var(--orange); font-size: 12px; }
    .at-input-group input,
    .at-input-group select {
        border: none; outline: none; background: transparent;
        font-size: 15px; color: #1a1a1a; width: 100%;
        font-weight: 500; min-width: 0;
    }
    .at-input-group input::placeholder { color: #bbb; font-weight: 400; }
    .at-input-group select option { color: #333; }
    .at-swap-col {
        display: flex; align-items: center; justify-content: center;
        padding: 0 6px; background: #fff; flex-shrink: 0;
    }
    .at-swap-btn {
        width: 34px; height: 34px; border-radius: 50%;
        background: var(--navy); color: #fff; border: none;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; font-size: 13px; flex-shrink: 0;
        transition: background .2s;
    }
    .at-swap-btn:hover { background: var(--orange); }
    .at-search-btn-wrap {
        display: flex; align-items: center; padding: 8px; flex-shrink: 0;
    }
    .at-search-submit {
        display: flex; align-items: center; justify-content: center; gap: 8px;
        background: var(--navy); color: #fff; border: none;
        border-radius: 10px; padding: 14px 24px;
        font-size: 15px; font-weight: 700; cursor: pointer;
        white-space: nowrap; transition: background .2s;
    }
    .at-search-submit:hover { background: var(--orange); }

    /* ── Popular Destinations ── */
    .destinations-section { padding: 72px 0; background: #fff; }
    .destinations-section .section-h {
        font-size: clamp(22px, 3vw, 32px);
        font-weight: 800; color: #1a1a1a;
        text-align: center; margin-bottom: 6px;
    }
    .dest-underline {
        width: 60px; height: 3px; background: var(--orange);
        margin: 0 auto 42px; border-radius: 2px;
    }
    .dest-slider-wrap { position: relative; padding: 0 52px; overflow: hidden; }
    .dest-track { display: flex; gap: 0; transition: transform .4s ease; will-change: transform; }
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
    .dest-slide {
        flex: 0 0 25%; max-width: 25%; padding: 0 10px; box-sizing: border-box;
    }
    @media (max-width: 991px) { .dest-slide { flex: 0 0 50%; max-width: 50%; } }
    @media (max-width: 575px) { .dest-slide { flex: 0 0 100%; max-width: 100%; } }
    .dest-card {
        background: #fff; border-radius: 14px; overflow: hidden;
        box-shadow: 0 2px 18px rgba(0,0,0,.08);
        transition: transform .25s, box-shadow .25s; cursor: pointer;
    }
    .dest-card:hover { transform: translateY(-4px); box-shadow: 0 8px 32px rgba(0,0,0,.14); }
    .dest-card-img {
        width: 100%; height: 190px;
        background-size: cover; background-position: center;
        display: block;
    }
    .dest-card-body { padding: 14px 18px 18px; }
    .dest-name { font-size: 17px; font-weight: 700; color: #1a1a1a; margin-bottom: 2px; }
    .dest-country { font-size: 13px; color: #999; }

    /* ── Flights Section ── */
    .flights-section { padding: 72px 0; background: #f5f7fa; }
    .flights-section .section-h {
        font-size: clamp(22px, 3vw, 32px);
        font-weight: 800; color: #1a1a1a;
        text-align: center; margin-bottom: 40px;
    }
    .flight-row {
        background: #fff; border-radius: 12px;
        padding: 20px 24px; margin-bottom: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,.06);
        display: flex; align-items: center; gap: 20px;
        flex-wrap: wrap; transition: box-shadow .2s;
    }
    .flight-row:hover { box-shadow: 0 6px 24px rgba(0,0,0,.10); }
    .fl-airline {
        display: flex; align-items: center; gap: 10px;
        flex: 0 0 170px;
    }
    .fl-logo {
        width: 44px; height: 44px; border-radius: 50%;
        background: #f5c518; display: flex; align-items: center;
        justify-content: center; flex-shrink: 0;
    }
    .fl-logo img { width: 28px; height: 28px; object-fit: contain; }
    .fl-logo-icon { font-size: 20px; color: var(--navy); }
    .fl-airline-name { font-weight: 600; font-size: 14px; color: #1a1a1a; }
    .fl-airline-code { font-size: 12px; color: #aaa; }
    .fl-times {
        flex: 1; display: flex; align-items: center; gap: 10px; min-width: 0;
    }
    .fl-time-block { text-align: center; }
    .fl-time { font-size: 15px; font-weight: 700; color: #1a1a1a; }
    .fl-airport { font-size: 12px; color: #999; }
    .fl-dash { flex: 1; border-top: 1px dashed #ccc; position: relative; margin: 0 6px; }
    .fl-dash::after {
        content: '✈'; position: absolute; top: 50%; right: -4px;
        transform: translateY(-50%); font-size: 14px; color: #aaa;
    }
    .fl-dur { font-size: 12px; color: #888; text-align: center; min-width: 70px; }
    .fl-stops { flex: 0 0 100px; font-size: 13px; }
    .fl-stops strong { display: block; color: #1a1a1a; font-size: 14px; }
    .fl-stops span { color: #aaa; font-size: 12px; }
    .fl-amenities {
        flex: 1; font-size: 12px; color: #777; min-width: 0;
        line-height: 1.5;
    }
    .fl-price-col { flex: 0 0 130px; text-align: right; }
    .fl-price { font-size: 22px; font-weight: 800; color: var(--orange); }
    .fl-class { font-size: 12px; color: #aaa; margin-bottom: 8px; }
    .fl-book-btn {
        background: var(--navy); color: #fff; border: none;
        padding: 8px 18px; border-radius: 6px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        transition: background .2s;
    }
    .fl-book-btn:hover { background: var(--orange); }

    /* ── Booking Form ── */
    .at-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 18px;
    }
    .at-form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #444;
        margin-bottom: 7px;
    }
    .at-form-input {
        width: 100%;
        padding: 11px 14px;
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
    .at-form-input:focus { border-color: #0D1F35; }
    textarea.at-form-input { resize: vertical; min-height: 100px; }

    @media (max-width: 991px) {
        .at-inputs-row { flex-wrap: wrap; }
        .at-input-group { flex: 0 0 calc(50% - 1px); border-bottom: 1px solid #ececec; }
        .at-swap-col { order: -1; display: none; }
        .at-search-btn-wrap { flex: 0 0 100%; padding: 8px; }
        .at-search-submit { width: 100%; justify-content: center; }
    }
    @media (max-width: 575px) {
        .at-input-group { flex: 0 0 100%; }
        .dest-slider-wrap { padding: 0 36px; }
    }
    @media (max-width: 768px) {
        .flight-row { flex-direction: column; align-items: flex-start; gap: 12px; }
        .fl-airline, .fl-price-col { flex: unset; }
        .fl-price-col { text-align: left; }
        .fl-times { width: 100%; }
        .at-form-row { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

    {{-- ── Hero ── --}}
    <section class="at-hero">
        <video class="at-hero-video" autoplay muted loop playsinline>
            <source src="{{ asset('videos/jet.mp4') }}" type="video/mp4">
        </video>
        <div class="at-hero-content">
            <h1>Air Ticketing</h1>
            <p>Book flights easily with assistance in finding the best routes, prices, and travel options.</p>
        </div>
    </section>

    {{-- ── Search Bar ── --}}
    <div class="at-search-bar">
        <div class="container">
            {{-- Trip type toggle --}}
            <div class="at-trip-toggle">
                <button type="button" class="at-trip-btn active" id="btn-round" onclick="setTripType('round')">
                    <i class="fas fa-exchange-alt"></i> Round Trip
                </button>
                <button type="button" class="at-trip-btn" id="btn-oneway" onclick="setTripType('oneway')">
                    One Way
                </button>
            </div>

            {{-- Inputs row --}}
            <div class="at-inputs-row">
                <div class="at-input-group" style="flex:1.4;">
                    <div class="at-input-label"><i class="fas fa-plane-departure"></i> From</div>
                    <input type="text" id="fromInput" placeholder="Departure city" value="Kigali">
                </div>
                <div class="at-swap-col">
                    <button class="at-swap-btn" onclick="swapLocations()" title="Swap destinations">
                        <i class="fas fa-exchange-alt"></i>
                    </button>
                </div>
                <div class="at-input-group" style="flex:1.4;">
                    <div class="at-input-label"><i class="fas fa-plane-arrival"></i> To</div>
                    <input type="text" id="toInput" placeholder="Destination city" value="Paris">
                </div>
                <div class="at-input-group">
                    <div class="at-input-label"><i class="fas fa-calendar-alt"></i> Depart</div>
                    <input type="date" id="depDate">
                </div>
                <div class="at-input-group" id="retDateGroup">
                    <div class="at-input-label"><i class="fas fa-calendar-alt"></i> Return</div>
                    <input type="date" id="retDate">
                </div>
                <div class="at-input-group" style="flex:0 0 130px;">
                    <div class="at-input-label"><i class="fas fa-user-friends"></i> Passengers</div>
                    <select id="passSelect">
                        <option value="1">1 Passenger</option>
                        <option value="2">2 Passengers</option>
                        <option value="3">3 Passengers</option>
                        <option value="4">4 Passengers</option>
                        <option value="5">5+ Passengers</option>
                    </select>
                </div>
                <div class="at-input-group" style="flex:0 0 130px;">
                    <div class="at-input-label"><i class="fas fa-chair"></i> Class</div>
                    <select id="classSelect">
                        <option>Economy</option>
                        <option>Business</option>
                        <option>First Class</option>
                        <option>Premium Economy</option>
                    </select>
                </div>
                <div class="at-search-btn-wrap">
                    <button class="at-search-submit" onclick="searchFlights()">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Popular Destinations ── --}}
    <section class="destinations-section">
        <div class="container">
            <h2 class="section-h">popular Destinations</h2>
            <div class="dest-underline"></div>
            <div class="dest-slider-wrap" id="destSliderWrap">
                <button class="slider-arrow-btn prev-btn" onclick="slideDest(-1)">&#8249;</button>
                <div class="dest-track" id="destTrack">
                    @php
                    $destinations = [
                        ['name' => 'Zanzibar',  'country' => 'Tanzania',      'img' => asset('assets/images/backgrounds/download (3).jpg')],
                        ['name' => 'Istanbul',  'country' => 'Turkey',        'img' => asset('assets/images/backgrounds/download (5).jpg')],
                        ['name' => 'Cairo',     'country' => 'Egypt',         'img' => asset('assets/images/backgrounds/unnamed.jpg')],
                        ['name' => 'Paris',     'country' => 'France',        'img' => asset('assets/images/backgrounds/download (4).jpg')],
                        ['name' => 'Dubai',     'country' => 'UAE',           'img' => asset('images/dubai.jpg')],
                        ['name' => 'Nairobi',   'country' => 'Kenya',         'img' => asset('images/nairobi.jpg')],
                        ['name' => 'New York',  'country' => 'United States', 'img' => asset('images/new-york.jpg')],
                    ];
                    @endphp
                    @foreach($destinations as $dest)
                    <div class="dest-slide">
                        <div class="dest-card">
                            <div class="dest-card-img" style="background-image: url('{{ $dest['img'] }}');"></div>
                            <div class="dest-card-body">
                                <div class="dest-name">{{ $dest['name'] }}</div>
                                <div class="dest-country">{{ $dest['country'] }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="slider-arrow-btn next-btn" onclick="slideDest(1)">&#8250;</button>
            </div>
        </div>
    </section>

    {{-- ── Book a Flight Form ── --}}
    <section style="background:#f5f7fa; padding:80px 0 90px;" id="bookFlight">
        <div class="container">
            <div class="text-center" style="margin-bottom:40px;">
                <span style="display:inline-flex;align-items:center;gap:10px;color:#C85A2A;font-weight:600;font-size:15px;margin-bottom:8px;">
                    <span style="display:block;width:40px;height:2px;background:#C85A2A;"></span>Request a Flight
                </span>
                <h2 style="font-size:clamp(24px,3vw,34px);font-weight:800;color:#1a1a1a;margin-bottom:6px;">Book Your Flight with Us</h2>
                <p style="font-size:15px;color:#666;max-width:520px;margin:0 auto;">Fill in your details below and our team will find the best available routes and prices for you.</p>
            </div>

            @if($errors->any())
                <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:14px 18px;margin-bottom:22px;max-width:860px;margin-left:auto;margin-right:auto;font-size:14px;color:#dc2626;">
                    @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                </div>
            @endif

            <div style="background:#fff;border-radius:20px;box-shadow:0 4px 32px rgba(13,31,53,.08);padding:40px 44px 48px;max-width:860px;margin:0 auto;">

                <form action="{{ route('air.ticketing.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Trip type --}}
                    <div style="display:flex;gap:16px;margin-bottom:22px;flex-wrap:wrap;">
                        <label style="display:flex;align-items:center;gap:8px;font-size:14px;font-weight:500;cursor:pointer;">
                            <input type="radio" name="trip_type" value="round" id="tripRound" checked onchange="toggleReturn(this)"> Round Trip
                        </label>
                        <label style="display:flex;align-items:center;gap:8px;font-size:14px;font-weight:500;cursor:pointer;">
                            <input type="radio" name="trip_type" value="oneway" id="tripOneway" onchange="toggleReturn(this)"> One Way
                        </label>
                    </div>

                    {{-- Row 1: Full Name --}}
                    <div style="margin-bottom:18px;">
                        <label class="at-form-label">Full Name <span style="color:#e74c3c">*</span></label>
                        <input class="at-form-input" type="text" name="names" value="{{ old('names') }}" placeholder="Your full name" required>
                    </div>

                    {{-- Row 2: Email + Phone --}}
                    <div class="at-form-row">
                        <div>
                            <label class="at-form-label">Email <span style="color:#e74c3c">*</span></label>
                            <input class="at-form-input" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                        </div>
                        <div>
                            <label class="at-form-label">Phone Number <span style="color:#e74c3c">*</span></label>
                            <input class="at-form-input" type="tel" name="phone_number" value="{{ old('phone_number') }}" placeholder="+250 7XX XXX XXX" required>
                        </div>
                    </div>

                    {{-- Row 3: Airline + Departure Airport --}}
                    <div class="at-form-row">
                        <div>
                            <label class="at-form-label">Choose Airline <span style="color:#999;font-weight:400;">(optional)</span></label>
                            <select class="at-form-input" name="airline">
                                <option value="">Select an airline (optional)</option>
                                <option value="RwandaAir" {{ old('airline')=='RwandaAir'?'selected':'' }}>RwandaAir</option>
                                <option value="Ethiopian Airlines" {{ old('airline')=='Ethiopian Airlines'?'selected':'' }}>Ethiopian Airlines</option>
                                <option value="Kenya Airways" {{ old('airline')=='Kenya Airways'?'selected':'' }}>Kenya Airways</option>
                                <option value="Qatar Airways" {{ old('airline')=='Qatar Airways'?'selected':'' }}>Qatar Airways</option>
                                <option value="Emirates" {{ old('airline')=='Emirates'?'selected':'' }}>Emirates</option>
                                <option value="Turkish Airlines" {{ old('airline')=='Turkish Airlines'?'selected':'' }}>Turkish Airlines</option>
                                <option value="British Airways" {{ old('airline')=='British Airways'?'selected':'' }}>British Airways</option>
                                <option value="Air France" {{ old('airline')=='Air France'?'selected':'' }}>Air France</option>
                            </select>
                        </div>
                        <div>
                            <label class="at-form-label">Departure Airport <span style="color:#e74c3c">*</span></label>
                            <input class="at-form-input" type="text" name="departure_airport" value="{{ old('departure_airport', 'Kigali International Airport') }}" placeholder="Enter departure airport" required>
                        </div>
                    </div>

                    {{-- Row 4: Arrival Airport + Passengers --}}
                    <div class="at-form-row">
                        <div>
                            <label class="at-form-label">Arrival Airport <span style="color:#e74c3c">*</span></label>
                            <input class="at-form-input" type="text" name="arrival_airport" value="{{ old('arrival_airport') }}" placeholder="Enter arrival airport" required>
                        </div>
                        <div>
                            <label class="at-form-label">Number of Passengers <span style="color:#e74c3c">*</span></label>
                            <input class="at-form-input" type="number" name="number_of_passengers" id="passengerCount" value="{{ old('number_of_passengers', 1) }}" min="1" max="10" required onchange="updatePassportFields()">
                        </div>
                    </div>

                    {{-- Row 5: Departure + Return Dates --}}
                    <div class="at-form-row">
                        <div>
                            <label class="at-form-label">Departure Date <span style="color:#e74c3c">*</span></label>
                            <input class="at-form-input" type="date" name="departure_date" value="{{ old('departure_date') }}" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div id="returnDateWrap">
                            <label class="at-form-label">Return Date</label>
                            <input class="at-form-input" type="date" name="return_date" value="{{ old('return_date') }}" min="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    {{-- Flight Class --}}
                    <div style="margin-bottom:18px;">
                        <label class="at-form-label">Flight Class <span style="color:#e74c3c">*</span></label>
                        <select class="at-form-input" name="flight_class" required>
                            <option value="economy"  {{ old('flight_class','economy')=='economy'  ?'selected':'' }}>Economy</option>
                            <option value="premium"  {{ old('flight_class')=='premium'  ?'selected':'' }}>Premium Economy</option>
                            <option value="business" {{ old('flight_class')=='business' ?'selected':'' }}>Business Class</option>
                            <option value="first"    {{ old('flight_class')=='first'    ?'selected':'' }}>First Class</option>
                        </select>
                    </div>

                    {{-- Passport Photos (dynamic) --}}
                    <div id="passportSection" style="margin-bottom:18px;">
                        <label class="at-form-label">Passenger Passport Photos</label>
                        <div id="passportFields" class="at-form-row" style="margin-bottom:0;"></div>
                    </div>

                    {{-- Additional Info --}}
                    <div style="margin-bottom:24px;">
                        <label class="at-form-label">Additional Information</label>
                        <textarea class="at-form-input" name="additional_info" rows="4" placeholder="Any special requirements, connecting flights, or preferences...">{{ old('additional_info') }}</textarea>
                    </div>

                    <button type="submit" style="width:100%;background:#C85A2A;color:#fff;border:none;border-radius:50px;padding:15px;font-size:16px;font-weight:700;cursor:pointer;transition:background .2s;display:flex;align-items:center;justify-content:center;gap:10px;">
                        <i class="fas fa-paper-plane"></i> Submit Flight Request
                    </button>
                    <p style="text-align:center;font-size:13px;color:#999;margin-top:14px;">Our team will contact you with available options and pricing.</p>
                </form>
            </div>
        </div>
    </section>


@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const dep = new Date(); dep.setDate(dep.getDate() + 3);
    const ret = new Date(); ret.setDate(ret.getDate() + 10);
    document.getElementById('depDate').valueAsDate = dep;
    document.getElementById('retDate').valueAsDate = ret;
});

function setTripType(type) {
    document.getElementById('btn-round').classList.toggle('active',  type === 'round');
    document.getElementById('btn-oneway').classList.toggle('active', type === 'oneway');
    const retGroup = document.getElementById('retDateGroup');
    if (retGroup) retGroup.style.display = type === 'oneway' ? 'none' : '';
}

function swapLocations() {
    const f = document.getElementById('fromInput');
    const t = document.getElementById('toInput');
    [f.value, t.value] = [t.value, f.value];
}

function searchFlights() {
    document.querySelector('.flights-section').scrollIntoView({ behavior: 'smooth' });
}

var destIdx = 0;
function slideDest(dir) {
    const track = document.getElementById('destTrack');
    const slides = track.querySelectorAll('.dest-slide');
    const visibleCount = window.innerWidth < 576 ? 1 : window.innerWidth < 992 ? 2 : 4;
    const maxIdx = Math.max(0, slides.length - visibleCount);
    destIdx = Math.min(Math.max(destIdx + dir, 0), maxIdx);
    const slideW = track.querySelector('.dest-slide').offsetWidth;
    track.style.transform = 'translateX(-' + (destIdx * slideW) + 'px)';
}

function toggleReturn(radio) {
    const wrap = document.getElementById('returnDateWrap');
    if (wrap) wrap.style.display = radio.value === 'oneway' ? 'none' : '';
}

function updatePassportFields() {
    const count = parseInt(document.getElementById('passengerCount').value) || 1;
    const container = document.getElementById('passportFields');
    container.innerHTML = '';
    for (var i = 1; i <= count; i++) {
        var div = document.createElement('div');
        div.innerHTML =
            '<label class="at-form-label">Passenger ' + i + ' Passport Photo</label>' +
            '<input type="file" name="passport_photos[]" accept="image/*" class="at-form-input" style="padding:7px 14px;">';
        container.appendChild(div);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    updatePassportFields();
});
</script>
@endsection
