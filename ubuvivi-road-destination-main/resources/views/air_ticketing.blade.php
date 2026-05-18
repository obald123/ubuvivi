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
        background: url('{{ asset("assets/images/backgrounds/bg_04.jpg") }}') center/cover no-repeat;
        display: flex; align-items: center; justify-content: center; text-align: center;
    }
    .at-hero::after {
        content: ''; position: absolute; inset: 0;
        background: rgba(13,31,53,.65);
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
    .at-search-bar { background: var(--navy); padding: 24px 0 28px; }
    .at-search-pills {
        display: flex; align-items: center; gap: 8px;
        margin-bottom: 18px; flex-wrap: wrap;
    }
    .at-pill {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,.1);
        border: 1px solid rgba(255,255,255,.2);
        color: rgba(255,255,255,.9);
        padding: 6px 16px; border-radius: 20px;
        font-size: 13px; cursor: pointer;
        transition: background .2s; user-select: none;
    }
    .at-pill.active {
        background: rgba(255,255,255,.95);
        color: var(--navy); border-color: transparent; font-weight: 600;
    }
    .at-pill:not(.active):hover { background: rgba(255,255,255,.2); }
    .at-pill select {
        background: transparent; border: none; outline: none;
        color: inherit; font-size: 13px; cursor: pointer; padding: 0;
    }
    .at-pill.active select { color: var(--navy); }

    /* ── Inputs Row ── */
    .at-inputs-row {
        display: flex; align-items: stretch;
        background: #fff; border-radius: 12px; overflow: hidden;
    }
    .at-input-group {
        flex: 1; display: flex; align-items: center; gap: 10px;
        padding: 14px 18px; border-right: 1px solid #ececec; min-width: 0;
    }
    .at-input-group:last-of-type { border-right: none; }
    .at-input-group i { color: #aaa; font-size: 14px; flex-shrink: 0; }
    .at-input-group input {
        border: none; outline: none; background: transparent;
        font-size: 14px; color: #333; width: 100%; min-width: 0;
    }
    .at-input-group input::placeholder { color: #bbb; }
    .at-date-sep { color: #ddd; margin: 0 4px; flex-shrink: 0; }
    .at-swap-wrap {
        display: flex; align-items: center; flex-shrink: 0;
        padding: 0 4px; background: #fff;
    }
    .at-swap-btn {
        width: 36px; height: 36px; border-radius: 50%;
        background: var(--navy); color: #fff; border: none;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; font-size: 12px;
        transition: background .2s;
    }
    .at-swap-btn:hover { background: var(--orange); }
    .at-search-submit {
        display: flex; align-items: center; justify-content: center;
        width: 54px; height: 54px; border-radius: 50%;
        background: var(--navy); color: #fff; border: none;
        cursor: pointer; font-size: 18px; margin: 6px;
        flex-shrink: 0; transition: background .2s;
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

    @media (max-width: 768px) {
        .at-inputs-row { flex-direction: column; gap: 0; }
        .at-input-group { border-right: none; border-bottom: 1px solid #ececec; }
        .at-input-group:last-of-type { border-bottom: none; }
        .at-search-submit { width: calc(100% - 12px); border-radius: 8px; height: 48px; }
        .at-swap-wrap { justify-content: center; padding: 8px; }
        .dest-slider-wrap { padding: 0 36px; }
        .flight-row { flex-direction: column; align-items: flex-start; gap: 12px; }
        .fl-airline, .fl-price-col { flex: unset; }
        .fl-price-col { text-align: left; }
        .fl-times { width: 100%; }
    }
</style>
@endsection

@section('content')

    {{-- ── Hero ── --}}
    <section class="at-hero">
        <div class="at-hero-content">
            <h1>Air Ticketing</h1>
            <p>Book flights easily with assistance in finding the best routes, prices, and travel options.</p>
        </div>
    </section>

    {{-- ── Search Bar ── --}}
    <div class="at-search-bar">
        <div class="container">
            {{-- Pills --}}
            <div class="at-search-pills">
                <span class="at-pill active" id="pill-round" onclick="setTripType('round')">
                    <i class="fas fa-exchange-alt"></i> Round Trip
                </span>
                <span class="at-pill" id="pill-oneway" onclick="setTripType('oneway')">One Way</span>

                <span class="at-pill" style="padding: 4px 4px 4px 12px;">
                    <i class="fas fa-user"></i>
                    <select id="passSelect" onchange="updatePassLabel(this)" style="background:transparent;border:none;outline:none;color:inherit;font-size:13px;cursor:pointer;">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5+</option>
                    </select>
                    <span id="passLabel">Passenger</span>
                </span>

                <span class="at-pill" style="padding: 4px 4px 4px 12px;">
                    <select id="classSelect" style="background:transparent;border:none;outline:none;color:inherit;font-size:13px;cursor:pointer;">
                        <option>Economy</option>
                        <option>Business</option>
                        <option>First Class</option>
                    </select>
                </span>
            </div>

            {{-- Inputs --}}
            <div class="at-inputs-row">
                <div class="at-input-group" style="flex:1.3;">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" id="fromInput" placeholder="From" value="Kigali">
                </div>
                <div class="at-swap-wrap">
                    <button class="at-swap-btn" onclick="swapLocations()" title="Swap">
                        <i class="fas fa-exchange-alt"></i>
                    </button>
                </div>
                <div class="at-input-group" style="flex:1.3;">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" id="toInput" placeholder="To" value="Paris">
                </div>
                <div class="at-input-group" style="flex:1.6;">
                    <i class="fas fa-calendar-alt"></i>
                    <input type="date" id="depDate" title="Departure">
                    <span class="at-date-sep" id="dateSep">|</span>
                    <input type="date" id="retDate" title="Return" id="retDateField">
                </div>
                <button class="at-search-submit" onclick="searchFlights()" title="Search Flights">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- ── Popular Destinations ── --}}
    <section class="destinations-section">
        <div class="container">
            <h2 class="section-h">popular Destinations</h2>
            <div class="dest-underline"></div>
            <div class="dest-slider-wrap">
                <button class="slider-arrow-btn prev-btn" onclick="slideDest(-1)">&#8249;</button>
                <div class="row">
                    @php
                    $destinations = [
                        ['name' => 'Zanzibar',  'country' => 'Tanzania', 'bg' => 'bg_8.jpg'],
                        ['name' => 'Istanbul',  'country' => 'Turkey',   'bg' => 'bg_01.jpg'],
                        ['name' => 'Cairo',     'country' => 'Egypt',    'bg' => 'bg_02.jpg'],
                        ['name' => 'Paris',     'country' => 'France',   'bg' => 'bg_5.jpg'],
                    ];
                    @endphp
                    @foreach($destinations as $dest)
                    <div class="col-6 col-md-3 mb-4">
                        <div class="dest-card">
                            <div class="dest-card-img" style="background-image: url('{{ asset('assets/images/backgrounds/'.$dest['bg']) }}');"></div>
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

    {{-- ── Top Departing Flights ── --}}
    <section class="flights-section">
        <div class="container">
            <h2 class="section-h">Top Departing Flights</h2>

            @php
            $flights = [
                [
                    'code'      => 'RW',
                    'airline'   => 'RwandaAir',
                    'num'       => 'WB 123',
                    'dep'       => '2:10 AM',
                    'arr'       => '5:00 PM',
                    'dur'       => '14hr 50min',
                    'stops'     => '2 Stops',
                    'via'       => 'EBB, IST',
                    'amenities' => 'Lie flat seat, Free Wi-Fi, In-seat power & USB outlets',
                    'price'     => '$ 5,500',
                    'class'     => 'Business Class',
                ],
                [
                    'code'      => 'ET',
                    'airline'   => 'Ethiopian Airlines',
                    'num'       => 'ET 500',
                    'dep'       => '2:10 AM',
                    'arr'       => '5:00 PM',
                    'dur'       => '14hr 50min',
                    'stops'     => '2 Stops',
                    'via'       => 'EBB, IST',
                    'amenities' => 'Lie flat seat, Free Wi-Fi, In-seat power & USB outlets',
                    'price'     => '$ 5,500',
                    'class'     => 'Business Class',
                ],
                [
                    'code'      => 'KQ',
                    'airline'   => 'Kenya Airways',
                    'num'       => 'KQ 456',
                    'dep'       => '2:10 AM',
                    'arr'       => '5:00 PM',
                    'dur'       => '14hr 50min',
                    'stops'     => '2 Stops',
                    'via'       => 'EBB, IST',
                    'amenities' => 'Lie flat seat, Free Wi-Fi, In-seat power & USB outlets',
                    'price'     => '$ 5,500',
                    'class'     => 'Business Class',
                ],
                [
                    'code'      => 'QR',
                    'airline'   => 'Qatar Airways',
                    'num'       => 'QR 789',
                    'dep'       => '2:10 AM',
                    'arr'       => '5:00 PM',
                    'dur'       => '14hr 50min',
                    'stops'     => '2 Stops',
                    'via'       => 'EBB, IST',
                    'amenities' => 'Lie flat seat, Free Wi-Fi, In-seat power & USB outlets',
                    'price'     => '$ 5,500',
                    'class'     => 'Business Class',
                ],
            ];
            @endphp

            @foreach($flights as $f)
            <div class="flight-row">
                <div class="fl-airline">
                    <div class="fl-logo">
                        <i class="fas fa-plane fl-logo-icon"></i>
                    </div>
                    <div>
                        <div class="fl-airline-name">{{ $f['airline'] }}</div>
                        <div class="fl-airline-code">{{ $f['num'] }}</div>
                    </div>
                </div>

                <div class="fl-times">
                    <div class="fl-time-block">
                        <div class="fl-time">{{ $f['dep'] }}</div>
                        <div class="fl-airport">KGL</div>
                    </div>
                    <div class="fl-dash"></div>
                    <div class="fl-time-block">
                        <div class="fl-time">{{ $f['arr'] }}</div>
                        <div class="fl-airport">CDG</div>
                    </div>
                    <div class="fl-dur">{{ $f['dur'] }}</div>
                </div>

                <div class="fl-stops">
                    <strong>{{ $f['stops'] }}</strong>
                    <span>{{ $f['via'] }}</span>
                </div>

                <div class="fl-amenities">{{ $f['amenities'] }}</div>

                <div class="fl-price-col">
                    <div class="fl-price">{{ $f['price'] }}</div>
                    <div class="fl-class">{{ $f['class'] }}</div>
                    <button class="fl-book-btn" onclick="alert('Contact us at +250 789 044 222 to book this flight!')">Book Now</button>
                </div>
            </div>
            @endforeach

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
    const roundPill  = document.getElementById('pill-round');
    const onewayPill = document.getElementById('pill-oneway');
    const retDate    = document.getElementById('retDate');
    const dateSep    = document.getElementById('dateSep');
    if (type === 'round') {
        roundPill.classList.add('active');
        onewayPill.classList.remove('active');
        retDate.style.display = '';
        dateSep.style.display = '';
    } else {
        onewayPill.classList.add('active');
        roundPill.classList.remove('active');
        retDate.style.display = 'none';
        dateSep.style.display = 'none';
    }
}

function updatePassLabel(sel) {
    document.getElementById('passLabel').textContent =
        parseInt(sel.value) > 1 ? 'Passengers' : 'Passenger';
}

function swapLocations() {
    const f = document.getElementById('fromInput');
    const t = document.getElementById('toInput');
    [f.value, t.value] = [t.value, f.value];
}

function searchFlights() {
    document.querySelector('.flights-section').scrollIntoView({ behavior: 'smooth' });
}

function slideDest(dir) {
    // visual-only nudge for desktop slider feel
    const grid = document.querySelector('.dest-slider-wrap .row');
    grid.style.transition = 'opacity .3s';
    grid.style.opacity = '0.6';
    setTimeout(() => { grid.style.opacity = '1'; }, 300);
}
</script>
@endsection
