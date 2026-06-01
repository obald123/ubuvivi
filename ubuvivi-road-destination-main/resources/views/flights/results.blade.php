@extends('layouts.guest')
@section('title') Flights: {{ $from_city }} → {{ $to_city }} - Ubuvivi Tours @endsection

@section('content')
@php
    $cabinLabels = [
        'ECONOMY'         => 'Economy',
        'PREMIUM_ECONOMY' => 'Premium Economy',
        'BUSINESS'        => 'Business',
        'FIRST'           => 'First Class',
    ];
    $cabinLabel = $cabinLabels[$cabin_class] ?? $cabin_class;
@endphp

<style>
    /* ── Hero / inline search ── */
    .fr-hero { background: linear-gradient(135deg,#0D1F35 0%,#1a3a5f 100%); padding:36px 0 28px; color:#fff; }
    .fr-hero h2 { font-size:24px; font-weight:800; margin-bottom:6px; }
    .fr-hero p  { font-size:13px; color:rgba(255,255,255,.65); }
    .fr-search-bar { background:rgba(255,255,255,.08); border:1px solid rgba(255,255,255,.15); border-radius:14px; padding:16px 20px; margin-top:20px; }
    .fr-sg { display:grid; grid-template-columns:1fr 1fr 1fr 1fr 1fr auto; gap:10px; align-items:end; }
    .rsf { display:flex; flex-direction:column; }
    .rsf label { font-size:11px; font-weight:700; color:rgba(255,255,255,.6); text-transform:uppercase; letter-spacing:.4px; margin-bottom:5px; }
    .rsf input, .rsf select { padding:9px 12px; border:1.5px solid rgba(255,255,255,.2); border-radius:8px; font-size:13px; background:rgba(255,255,255,.1); color:#fff; outline:none; font-family:inherit; }
    .rsf input::placeholder { color:rgba(255,255,255,.4); }
    .rsf input:focus, .rsf select:focus { border-color:#C85A2A; }
    .rsf select option { background:#0D1F35; color:#fff; }
    .btn-re-search { background:#C85A2A; color:#fff; border:none; padding:10px 20px; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; white-space:nowrap; font-family:inherit; }
    .btn-re-search:hover { background:#a84820; }

    /* ── Results layout ── */
    .fr-body { background:#f5f6fa; padding:36px 0 60px; }
    .fr-meta { display:flex; align-items:center; justify-content:space-between; margin-bottom:22px; flex-wrap:wrap; gap:12px; }
    .fr-meta h3 { font-size:18px; font-weight:700; color:#0D1F35; }
    .fr-meta a  { font-size:13px; color:#C85A2A; font-weight:600; text-decoration:none; }

    /* ── Flight card ── */
    .flight-card {
        background:#fff; border-radius:16px; border:1px solid #e4e8f0;
        box-shadow:0 2px 12px rgba(13,31,53,.05); padding:20px 24px;
        margin-bottom:14px; display:grid;
        grid-template-columns:auto 1fr auto auto;
        gap:20px; align-items:center;
        transition:box-shadow .2s;
    }
    .flight-card:hover { box-shadow:0 6px 24px rgba(13,31,53,.1); }

    .airline-col { display:flex; flex-direction:column; align-items:center; gap:6px; min-width:80px; }
    .airline-logo { width:48px; height:48px; object-fit:contain; border-radius:8px; border:1px solid #eee; padding:4px; }
    .airline-logo-placeholder { width:48px; height:48px; background:#f0f2f7; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:10px; font-weight:700; color:#888; text-align:center; line-height:1.2; }
    .airline-name { font-size:11px; color:#888; text-align:center; max-width:80px; line-height:1.3; }

    .route-col { display:flex; align-items:center; gap:16px; }
    .route-point { text-align:center; }
    .route-code { font-size:22px; font-weight:800; color:#0D1F35; }
    .route-city { font-size:11px; color:#aaa; }
    .route-time { font-size:14px; font-weight:600; color:#333; margin-top:2px; }
    .route-line { flex:1; display:flex; flex-direction:column; align-items:center; gap:3px; }
    .route-line-bar { width:100%; height:2px; background:#e4e8f0; position:relative; }
    .route-line-bar::before, .route-line-bar::after { content:''; position:absolute; top:-3px; width:8px; height:8px; border-radius:50%; background:#C85A2A; }
    .route-line-bar::before { left:0; }
    .route-line-bar::after  { right:0; }
    .route-duration { font-size:11px; color:#aaa; }
    .route-stops { font-size:11px; font-weight:600; color:#C85A2A; }

    .price-col { text-align:right; }
    .price-amount { font-size:22px; font-weight:800; color:#C85A2A; white-space:nowrap; }
    .price-per    { font-size:11px; color:#aaa; }
    .cabin-badge  { background:#f0f2f7; color:#555; padding:3px 10px; border-radius:50px; font-size:11px; font-weight:600; margin-top:4px; display:inline-block; }

    .btn-col { display:flex; align-items:center; }
    .btn-book-flight {
        background:#0D1F35; color:#fff; border:none; padding:12px 20px;
        border-radius:10px; font-size:13px; font-weight:700; cursor:pointer;
        white-space:nowrap; font-family:inherit; transition:background .2s;
    }
    .btn-book-flight:hover { background:#C85A2A; }

    /* ── Empty / error ── */
    .fr-empty { text-align:center; padding:80px 20px; background:#fff; border-radius:16px; border:1px solid #e4e8f0; }
    .fr-empty i { font-size:48px; color:#ddd; display:block; margin-bottom:16px; }
    .fr-empty h4 { font-size:20px; font-weight:700; color:#333; margin-bottom:8px; }
    .fr-empty p  { font-size:14px; color:#888; margin-bottom:20px; }
    .btn-try-again { display:inline-block; background:#0D1F35; color:#fff; padding:11px 28px; border-radius:10px; font-size:14px; font-weight:700; text-decoration:none; }
    .error-banner { background:#fff8f4; border:1px solid #f5d5c2; border-radius:12px; padding:20px 24px; font-size:14px; color:#7a3815; margin-bottom:24px; }
    .error-banner i { color:#C85A2A; margin-right:6px; }

    /* ── Booking Modal ── */
    .modal-overlay { position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,.55); display:flex; align-items:center; justify-content:center; z-index:3000; padding:16px; }
    .modal-box { background:#fff; border-radius:20px; max-width:560px; width:100%; max-height:92vh; overflow-y:auto; box-shadow:0 20px 60px rgba(0,0,0,.2); }
    .modal-head { background:#0D1F35; border-radius:20px 20px 0 0; padding:22px 28px; display:flex; justify-content:space-between; align-items:center; }
    .modal-head h3 { color:#fff; font-size:18px; font-weight:700; margin:0; }
    .modal-close { background:none; border:none; color:rgba(255,255,255,.7); font-size:22px; cursor:pointer; line-height:1; }
    .modal-body { padding:24px 28px; }
    .modal-flight-summary { background:#f7f8fb; border-radius:12px; padding:16px; margin-bottom:20px; }
    .mfs-row { display:flex; justify-content:space-between; font-size:13px; color:#555; margin-bottom:6px; }
    .mfs-row:last-child { margin-bottom:0; }
    .mfs-row span:last-child { font-weight:700; color:#0D1F35; }
    .mf-group { margin-bottom:14px; }
    .mf-group label { display:block; font-size:12px; font-weight:700; color:#444; text-transform:uppercase; letter-spacing:.4px; margin-bottom:5px; }
    .mf-group input, .mf-group textarea { width:100%; padding:10px 13px; border:1.5px solid #e0e0e0; border-radius:8px; font-size:14px; outline:none; font-family:inherit; color:#222; background:#fff; }
    .mf-group input:focus, .mf-group textarea:focus { border-color:#0D1F35; }
    .mf-group textarea { resize:vertical; min-height:80px; }
    .btn-confirm-booking { width:100%; background:#C85A2A; color:#fff; border:none; padding:14px; border-radius:10px; font-size:15px; font-weight:700; cursor:pointer; margin-top:6px; font-family:inherit; }
    .btn-confirm-booking:hover { background:#a84820; }
    .modal-note { font-size:12px; color:#aaa; text-align:center; margin-top:10px; line-height:1.6; }

    @media (max-width:991px) { .fr-sg { grid-template-columns:1fr 1fr; } }
    @media (max-width:767px) {
        .flight-card { grid-template-columns:1fr; gap:14px; }
        .route-col { flex-wrap:wrap; }
        .price-col { text-align:left; }
        .fr-sg { grid-template-columns:1fr; }
    }
</style>

{{-- Hero with inline re-search --}}
<section class="fr-hero">
    <div class="container">
        <h2>
            <i class="fas fa-plane-departure" style="color:#C85A2A;margin-right:10px"></i>
            {{ $from_city }} → {{ $to_city }}
        </h2>
        <p>
            {{ \Carbon\Carbon::parse($depart_date)->format('M d, Y') }}
            @if($trip_type === 'round' && $return_date)
                — {{ \Carbon\Carbon::parse($return_date)->format('M d, Y') }}
            @endif
            &bull; {{ $adults }} adult{{ $adults > 1 ? 's' : '' }}
            &bull; {{ $cabinLabel }}
        </p>

        <form action="{{ route('guest.flights.results') }}" method="GET" class="fr-search-bar">
            <input type="hidden" name="trip_type" value="{{ $trip_type }}">
            <div class="fr-sg">
                <div class="rsf"><label>From</label><input type="text" name="from" value="{{ $from }}" required></div>
                <div class="rsf"><label>To</label><input type="text" name="to" value="{{ $to }}" required></div>
                <div class="rsf"><label>Departure</label><input type="date" name="depart_date" value="{{ $depart_date }}" required></div>
                @if($trip_type === 'round')
                    <div class="rsf"><label>Return</label><input type="date" name="return_date" value="{{ $return_date }}"></div>
                @endif
                <div class="rsf">
                    <label>Class</label>
                    <select name="cabin_class">
                        @foreach(['ECONOMY'=>'Economy','PREMIUM_ECONOMY'=>'Premium Eco','BUSINESS'=>'Business','FIRST'=>'First'] as $v=>$l)
                            <option value="{{ $v }}" {{ $cabin_class===$v?'selected':'' }}>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn-re-search"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</section>

{{-- Results --}}
<section class="fr-body">
    <div class="container">

        @if($error)
            <div class="error-banner"><i class="fas fa-info-circle"></i>{{ $error }}</div>
        @endif

        <div class="fr-meta">
            <h3>
                @if(!$error && count($flights) > 0)
                    {{ count($flights) }} flight{{ count($flights) !== 1 ? 's' : '' }} found
                @elseif(!$error)
                    No flights found
                @endif
            </h3>
            <a href="{{ route('guest.flights.search') }}"><i class="fas fa-arrow-left" style="margin-right:4px"></i>New Search</a>
        </div>

        @forelse($flights as $i => $offer)
        @php
            $seg       = $offer['segments'][0] ?? [];
            $legs      = $seg['legs'] ?? [];
            $firstLeg  = $legs[0] ?? [];
            $lastLeg   = end($legs) ?: [];
            $carrier   = $firstLeg['carriersData'][0] ?? [];
            $airlineName = $carrier['name'] ?? 'Unknown Airline';
            $airlineLogo = $carrier['logo'] ?? null;
            $depCode   = $firstLeg['departureAirport']['code'] ?? ($from_city);
            $arrCode   = $lastLeg['arrivalAirport']['code']   ?? ($to_city);
            $depCity   = $firstLeg['departureAirport']['cityName'] ?? $from_city;
            $arrCity   = $lastLeg['arrivalAirport']['cityName']   ?? $to_city;
            $depTime   = isset($firstLeg['departureTime']) ? \Carbon\Carbon::parse($firstLeg['departureTime'])->format('H:i') : '—';
            $arrTime   = isset($lastLeg['arrivalTime'])    ? \Carbon\Carbon::parse($lastLeg['arrivalTime'])->format('H:i') : '—';
            $totalSecs = $seg['totalTime'] ?? 0;
            $duration  = $totalSecs > 0
                ? floor($totalSecs/3600).'h ' . (floor(($totalSecs%3600)/60)).'m'
                : '—';
            $stops    = count($legs) - 1;
            $stopsLabel = $stops === 0 ? 'Direct' : ($stops . ' stop' . ($stops > 1 ? 's' : ''));
            $price    = $offer['priceBreakdown']['total']['units'] ?? null;
            $nanos    = $offer['priceBreakdown']['total']['nanos'] ?? 0;
            $currency = $offer['priceBreakdown']['total']['currencyCode'] ?? 'USD';
            $priceDisplay = $price !== null
                ? $currency . ' ' . number_format($price + ($nanos / 1e9), 0)
                : '—';
            $offerId = 'offer_' . $i;
        @endphp

        <div class="flight-card">
            <div class="airline-col">
                @if($airlineLogo)
                    <img src="{{ $airlineLogo }}" alt="{{ $airlineName }}" class="airline-logo">
                @else
                    <div class="airline-logo-placeholder">{{ strtoupper(substr($airlineName,0,2)) }}</div>
                @endif
                <span class="airline-name">{{ $airlineName }}</span>
            </div>

            <div class="route-col">
                <div class="route-point">
                    <div class="route-code">{{ $depCode }}</div>
                    <div class="route-city">{{ $depCity }}</div>
                    <div class="route-time">{{ $depTime }}</div>
                </div>
                <div class="route-line" style="flex:1;min-width:80px;">
                    <div class="route-duration">{{ $duration }}</div>
                    <div class="route-line-bar"></div>
                    <div class="route-stops" style="color:{{ $stops===0 ? '#15803d' : '#C85A2A' }}">{{ $stopsLabel }}</div>
                </div>
                <div class="route-point">
                    <div class="route-code">{{ $arrCode }}</div>
                    <div class="route-city">{{ $arrCity }}</div>
                    <div class="route-time">{{ $arrTime }}</div>
                </div>
            </div>

            <div class="price-col">
                <div class="price-amount">{{ $priceDisplay }}</div>
                <div class="price-per">per adult</div>
                <div class="cabin-badge">{{ $cabinLabel }}</div>
            </div>

            <div class="btn-col">
                <button class="btn-book-flight" onclick="openBookingModal({
                    airline: '{{ addslashes($airlineName) }}',
                    from: '{{ $depCode }}',
                    fromCity: '{{ addslashes($depCity) }}',
                    to: '{{ $arrCode }}',
                    toCity: '{{ addslashes($arrCity) }}',
                    depTime: '{{ $depTime }}',
                    arrTime: '{{ $arrTime }}',
                    duration: '{{ $duration }}',
                    stops: '{{ $stopsLabel }}',
                    price: '{{ $priceDisplay }}',
                    cabinClass: '{{ $cabin_class }}',
                    departDate: '{{ $depart_date }}',
                    returnDate: '{{ $return_date ?? '' }}',
                    tripType: '{{ $trip_type }}',
                    adults: {{ $adults }}
                })">
                    Book This Flight
                </button>
            </div>
        </div>
        @empty
        @if(!$error)
        <div class="fr-empty">
            <i class="fas fa-plane-slash"></i>
            <h4>No flights found</h4>
            <p>We couldn't find flights for this route and dates. Try different dates or airports.</p>
            <a href="{{ route('guest.flights.search') }}" class="btn-try-again">Try Again</a>
        </div>
        @endif
        @endforelse

        @if(!$error && count($flights) > 0)
            <p style="text-align:center;font-size:12px;color:#bbb;margin-top:24px;">
                Flight data provided by Booking.com. Prices are indicative and may change at time of booking.
            </p>
        @endif

    </div>
</section>

{{-- Booking Modal --}}
<div class="modal-overlay" id="bookingModal" style="display:none;" onclick="if(event.target===this)closeModal()">
    <div class="modal-box">
        <div class="modal-head">
            <h3><i class="fas fa-paper-plane" style="color:#C85A2A;margin-right:8px"></i>Book This Flight</h3>
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="modal-flight-summary" id="flightSummary">
                <div class="mfs-row"><span><i class="fas fa-plane-departure" style="color:#C85A2A;margin-right:5px"></i>Route</span><span id="ms-route">—</span></div>
                <div class="mfs-row"><span><i class="fas fa-calendar-alt" style="color:#C85A2A;margin-right:5px"></i>Departure</span><span id="ms-date">—</span></div>
                <div class="mfs-row"><span><i class="fas fa-clock" style="color:#C85A2A;margin-right:5px"></i>Duration</span><span id="ms-duration">—</span></div>
                <div class="mfs-row"><span><i class="fas fa-couch" style="color:#C85A2A;margin-right:5px"></i>Class</span><span id="ms-class">—</span></div>
                <div class="mfs-row"><span><i class="fas fa-user" style="color:#C85A2A;margin-right:5px"></i>Passengers</span><span id="ms-adults">—</span></div>
                <div class="mfs-row"><span><i class="fas fa-tag" style="color:#C85A2A;margin-right:5px"></i>Indicative Price</span><span id="ms-price" style="color:#C85A2A;font-size:16px;">—</span></div>
            </div>

            <form action="{{ route('guest.flights.book.store') }}" method="POST">
                @csrf
                <input type="hidden" name="airline"              id="h-airline">
                <input type="hidden" name="departure_airport"    id="h-from">
                <input type="hidden" name="arrival_airport"      id="h-to">
                <input type="hidden" name="departure_date"       id="h-depart-date">
                <input type="hidden" name="return_date"          id="h-return-date">
                <input type="hidden" name="trip_type"            id="h-trip-type">
                <input type="hidden" name="flight_class"         id="h-class">
                <input type="hidden" name="number_of_passengers" id="h-adults">

                <div class="mf-group">
                    <label>Full Name <span style="color:#e74c3c">*</span></label>
                    <input type="text" name="names" placeholder="Your full name" required>
                </div>
                <div class="mf-group">
                    <label>Email Address <span style="color:#e74c3c">*</span></label>
                    <input type="email" name="email" placeholder="your@email.com" required>
                </div>
                <div class="mf-group">
                    <label>Phone Number <span style="color:#e74c3c">*</span></label>
                    <input type="tel" name="phone_number" placeholder="+250 7XX XXX XXX" required>
                </div>
                <div class="mf-group">
                    <label>Special Requests</label>
                    <textarea name="additional_info" placeholder="Meal preferences, seat requests, accessibility needs..."></textarea>
                </div>

                <button type="submit" class="btn-confirm-booking">
                    <i class="fas fa-paper-plane" style="margin-right:8px"></i>Submit Booking Request
                </button>
            </form>

            <p class="modal-note">
                <i class="fas fa-shield-alt" style="color:#15803d"></i>
                Our team will confirm and ticket your flight within <strong>24 hours</strong>.<br>
                A confirmation email will be sent to you immediately.
            </p>
        </div>
    </div>
</div>

<script>
var cabinLabels = {
    'ECONOMY': 'Economy', 'PREMIUM_ECONOMY': 'Premium Economy',
    'BUSINESS': 'Business Class', 'FIRST': 'First Class'
};

function openBookingModal(data) {
    document.getElementById('ms-route').textContent    = data.from + ' (' + data.fromCity + ') → ' + data.to + ' (' + data.toCity + ')';
    document.getElementById('ms-date').textContent     = data.departDate + (data.tripType === 'round' && data.returnDate ? ' → ' + data.returnDate : '');
    document.getElementById('ms-duration').textContent = data.duration + ' · ' + data.stops;
    document.getElementById('ms-class').textContent    = cabinLabels[data.cabinClass] || data.cabinClass;
    document.getElementById('ms-adults').textContent   = data.adults + ' adult' + (data.adults > 1 ? 's' : '');
    document.getElementById('ms-price').textContent    = data.price;

    document.getElementById('h-airline').value      = data.airline;
    document.getElementById('h-from').value         = data.from + ' - ' + data.fromCity;
    document.getElementById('h-to').value           = data.to + ' - ' + data.toCity;
    document.getElementById('h-depart-date').value  = data.departDate;
    document.getElementById('h-return-date').value  = data.returnDate || '';
    document.getElementById('h-trip-type').value    = data.tripType;
    document.getElementById('h-class').value        = data.cabinClass;
    document.getElementById('h-adults').value       = data.adults;

    document.getElementById('bookingModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('bookingModal').style.display = 'none';
    document.body.style.overflow = '';
}
</script>
@endsection
