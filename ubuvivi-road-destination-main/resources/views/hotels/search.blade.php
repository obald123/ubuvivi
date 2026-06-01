@extends('layouts.guest')
@section('title') Search Hotels - Ubuvivi Tours @endsection

@section('content')
<style>
    .hotels-search-hero {
        background: linear-gradient(135deg, #0D1F35 0%, #1e3a5f 100%);
        padding: 80px 0 60px;
        text-align: center;
        color: #fff;
    }
    .hotels-search-hero h1 { font-size: 38px; font-weight: 800; margin-bottom: 12px; }
    .hotels-search-hero p  { font-size: 16px; color: rgba(255,255,255,.7); margin-bottom: 40px; }

    .search-card {
        background: #fff;
        border-radius: 20px;
        padding: 32px 36px;
        max-width: 820px;
        margin: 0 auto;
        box-shadow: 0 8px 40px rgba(0,0,0,.18);
    }
    .search-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 14px;
        align-items: end;
    }
    .search-field { display: flex; flex-direction: column; }
    .search-field label { font-size: 12px; font-weight: 700; color: #555; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 6px; }
    .search-field input {
        padding: 12px 14px;
        border: 1.5px solid #e0e0e0;
        border-radius: 10px;
        font-size: 14px;
        outline: none;
        font-family: inherit;
        color: #222;
        transition: border-color .2s;
    }
    .search-field input:focus { border-color: #C85A2A; }
    .btn-search {
        background: #C85A2A;
        color: #fff;
        border: none;
        padding: 13px 28px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        width: 100%;
        transition: background .2s;
    }
    .btn-search:hover { background: #a84820; }

    .search-info {
        max-width: 820px;
        margin: 40px auto 0;
        padding: 0 20px;
    }
    .search-info-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .info-card {
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.15);
        border-radius: 14px;
        padding: 22px 20px;
        text-align: center;
    }
    .info-card i { font-size: 26px; color: #C85A2A; margin-bottom: 10px; display: block; }
    .info-card h4 { font-size: 15px; font-weight: 700; color: #fff; margin-bottom: 6px; }
    .info-card p  { font-size: 13px; color: rgba(255,255,255,.6); line-height: 1.6; }

    @media (max-width: 768px) {
        .search-grid { grid-template-columns: 1fr; }
        .hotels-search-hero h1 { font-size: 28px; }
        .search-card { padding: 22px 18px; margin: 0 16px; }
        .search-info-grid { grid-template-columns: 1fr; }
    }
</style>

<section class="hotels-search-hero">
    <div class="container">
        <h1>Find Hotels Worldwide</h1>
        <p>Search thousands of hotels from Booking.com and book your perfect stay</p>

        <div class="search-card">
            <form action="{{ route('guest.hotels.results') }}" method="GET">
                <div class="search-grid">
                    <div class="search-field">
                        <label><i class="fas fa-map-marker-alt" style="color:#C85A2A;margin-right:4px"></i> Destination</label>
                        <input type="text" name="destination" placeholder="e.g. Kigali, Paris, Dubai..." required value="{{ old('destination') }}">
                    </div>
                    <div class="search-field">
                        <label><i class="fas fa-calendar" style="color:#C85A2A;margin-right:4px"></i> Check-in</label>
                        <input type="date" name="check_in" required min="{{ date('Y-m-d') }}" value="{{ old('check_in') }}">
                    </div>
                    <div class="search-field">
                        <label><i class="fas fa-calendar-check" style="color:#C85A2A;margin-right:4px"></i> Check-out</label>
                        <input type="date" name="check_out" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('check_out') }}">
                    </div>
                    <div class="search-field">
                        <label><i class="fas fa-user" style="color:#C85A2A;margin-right:4px"></i> Adults</label>
                        <input type="number" name="adults" min="1" max="30" value="{{ old('adults', 2) }}" required>
                    </div>
                </div>
                <div style="margin-top:16px;">
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search" style="margin-right:8px"></i>Search Hotels
                    </button>
                </div>
            </form>
        </div>

        <div class="search-info">
            <div class="search-info-grid">
                <div class="info-card">
                    <i class="fas fa-globe"></i>
                    <h4>Worldwide Coverage</h4>
                    <p>Access thousands of hotels in destinations across the globe</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-shield-alt"></i>
                    <h4>Secure Booking</h4>
                    <p>Book safely through Booking.com's trusted platform</p>
                </div>
                <div class="info-card">
                    <i class="fas fa-tags"></i>
                    <h4>Best Prices</h4>
                    <p>Compare rates and find the best deals for your stay</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
