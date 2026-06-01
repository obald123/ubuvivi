@extends('layouts.guest')
@section('title') Search Flights - Ubuvivi Tours @endsection

@section('content')
<style>
    .flights-hero {
        background: linear-gradient(135deg, #0D1F35 0%, #1a3a5f 100%);
        padding: 80px 0 60px;
        text-align: center;
        color: #fff;
    }
    .flights-hero h1 { font-size: 38px; font-weight: 800; margin-bottom: 10px; }
    .flights-hero p  { font-size: 16px; color: rgba(255,255,255,.65); margin-bottom: 40px; }

    .search-card {
        background: #fff;
        border-radius: 20px;
        padding: 32px 36px;
        max-width: 860px;
        margin: 0 auto;
        box-shadow: 0 8px 40px rgba(0,0,0,.2);
    }

    /* Trip type toggle */
    .trip-toggle { display: flex; gap: 8px; margin-bottom: 22px; justify-content: center; }
    .trip-btn {
        padding: 8px 24px; border-radius: 50px; border: 2px solid #e0e0e0;
        background: #fff; color: #555; font-size: 14px; font-weight: 600;
        cursor: pointer; transition: all .2s; font-family: inherit;
    }
    .trip-btn.active { background: #0D1F35; color: #fff; border-color: #0D1F35; }

    .search-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-bottom: 14px;
    }
    .search-grid.four { grid-template-columns: 1fr 1fr 1fr 1fr; }

    .sf { display: flex; flex-direction: column; }
    .sf label { font-size: 12px; font-weight: 700; color: #555; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 6px; }
    .sf input, .sf select {
        padding: 12px 14px;
        border: 1.5px solid #e0e0e0;
        border-radius: 10px;
        font-size: 14px;
        outline: none;
        font-family: inherit;
        color: #222;
        background: #fff;
        transition: border-color .2s;
    }
    .sf input:focus, .sf select:focus { border-color: #C85A2A; }

    .btn-search-flight {
        width: 100%; background: #C85A2A; color: #fff; border: none;
        padding: 14px; border-radius: 10px; font-size: 16px; font-weight: 700;
        cursor: pointer; margin-top: 8px; transition: background .2s; font-family: inherit;
    }
    .btn-search-flight:hover { background: #a84820; }

    .return-row { display: none; }
    .return-row.show { display: grid; }

    /* Features */
    .features-row {
        display: grid; grid-template-columns: repeat(3,1fr);
        gap: 20px; max-width: 860px; margin: 40px auto 0; padding: 0 20px;
    }
    .feature-card {
        background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.15);
        border-radius: 14px; padding: 22px 20px; text-align: center;
    }
    .feature-card i { font-size: 26px; color: #C85A2A; margin-bottom: 10px; display: block; }
    .feature-card h4 { font-size: 15px; font-weight: 700; color: #fff; margin-bottom: 6px; }
    .feature-card p  { font-size: 13px; color: rgba(255,255,255,.6); line-height: 1.6; }

    @media (max-width: 768px) {
        .search-grid, .search-grid.four { grid-template-columns: 1fr; }
        .flights-hero h1 { font-size: 26px; }
        .search-card { padding: 22px 18px; margin: 0 16px; }
        .features-row { grid-template-columns: 1fr; }
    }
</style>

<section class="flights-hero">
    <div class="container">
        <h1><i class="fas fa-plane" style="color:#C85A2A;margin-right:12px"></i>Search Flights</h1>
        <p>Find the best flights worldwide and let our team handle your booking</p>

        <div class="search-card">
            <div class="trip-toggle">
                <button type="button" class="trip-btn active" id="btn-oneway" onclick="setTripType('oneway')">
                    <i class="fas fa-arrow-right" style="margin-right:6px"></i>One Way
                </button>
                <button type="button" class="trip-btn" id="btn-round" onclick="setTripType('round')">
                    <i class="fas fa-exchange-alt" style="margin-right:6px"></i>Round Trip
                </button>
            </div>

            <form action="{{ route('guest.flights.results') }}" method="GET" id="flightSearchForm">
                <input type="hidden" name="trip_type" id="trip_type" value="oneway">

                <div class="search-grid">
                    <div class="sf">
                        <label><i class="fas fa-plane-departure" style="color:#C85A2A;margin-right:4px"></i> From</label>
                        <input type="text" name="from" placeholder="City or airport code, e.g. Kigali" required value="{{ old('from') }}">
                    </div>
                    <div class="sf">
                        <label><i class="fas fa-plane-arrival" style="color:#C85A2A;margin-right:4px"></i> To</label>
                        <input type="text" name="to" placeholder="City or airport code, e.g. London" required value="{{ old('to') }}">
                    </div>
                </div>

                <div class="search-grid four">
                    <div class="sf">
                        <label><i class="fas fa-calendar-alt" style="color:#C85A2A;margin-right:4px"></i> Departure</label>
                        <input type="date" name="depart_date" required min="{{ date('Y-m-d') }}" value="{{ old('depart_date') }}">
                    </div>
                    <div class="sf return-row" id="returnDateRow">
                        <label><i class="fas fa-calendar-check" style="color:#C85A2A;margin-right:4px"></i> Return</label>
                        <input type="date" name="return_date" id="return_date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('return_date') }}">
                    </div>
                    <div class="sf">
                        <label><i class="fas fa-user" style="color:#C85A2A;margin-right:4px"></i> Adults</label>
                        <input type="number" name="adults" min="1" max="9" value="{{ old('adults', 1) }}" required>
                    </div>
                    <div class="sf">
                        <label><i class="fas fa-couch" style="color:#C85A2A;margin-right:4px"></i> Cabin Class</label>
                        <select name="cabin_class">
                            @foreach(['ECONOMY' => 'Economy', 'PREMIUM_ECONOMY' => 'Premium Economy', 'BUSINESS' => 'Business', 'FIRST' => 'First Class'] as $val => $label)
                                <option value="{{ $val }}" {{ old('cabin_class','ECONOMY') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-search-flight">
                    <i class="fas fa-search" style="margin-right:8px"></i>Search Flights
                </button>
            </form>
        </div>

        <div class="features-row">
            <div class="feature-card">
                <i class="fas fa-globe"></i>
                <h4>Global Coverage</h4>
                <p>Hundreds of airlines and destinations across the world</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-headset"></i>
                <h4>Handled by Our Team</h4>
                <p>Submit your request and we confirm and ticket for you</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-tags"></i>
                <h4>Best Available Rates</h4>
                <p>We search live prices to find you the best deal</p>
            </div>
        </div>
    </div>
</section>

<script>
function setTripType(type) {
    document.getElementById('trip_type').value = type;
    document.getElementById('btn-oneway').classList.toggle('active', type === 'oneway');
    document.getElementById('btn-round').classList.toggle('active', type === 'round');
    var returnRow = document.getElementById('returnDateRow');
    var returnInput = document.getElementById('return_date');
    if (type === 'round') {
        returnRow.classList.add('show');
        returnInput.required = true;
    } else {
        returnRow.classList.remove('show');
        returnInput.required = false;
        returnInput.value = '';
    }
}
// Restore state on page load (for validation errors)
@if(old('trip_type') === 'round')
    document.addEventListener('DOMContentLoaded', function() { setTripType('round'); });
@endif
</script>
@endsection
