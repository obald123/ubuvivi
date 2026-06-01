@extends('layouts.guest')
@section('title') Hotels in {{ $destination }} - Ubuvivi Tours @endsection

@section('content')
<style>
    .results-hero {
        background: linear-gradient(135deg, #0D1F35 0%, #1e3a5f 100%);
        padding: 40px 0 30px;
        color: #fff;
    }
    .results-hero h2 { font-size: 26px; font-weight: 800; margin-bottom: 6px; }
    .results-hero p  { font-size: 14px; color: rgba(255,255,255,.7); }

    /* Inline search bar */
    .results-search-bar {
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.15);
        border-radius: 14px;
        padding: 16px 20px;
        margin-top: 20px;
    }
    .results-search-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr auto;
        gap: 10px;
        align-items: end;
    }
    .rsf { display: flex; flex-direction: column; }
    .rsf label { font-size: 11px; font-weight: 700; color: rgba(255,255,255,.6); text-transform: uppercase; letter-spacing:.4px; margin-bottom: 5px; }
    .rsf input {
        padding: 9px 12px;
        border: 1.5px solid rgba(255,255,255,.2);
        border-radius: 8px;
        font-size: 13px;
        background: rgba(255,255,255,.1);
        color: #fff;
        outline: none;
        font-family: inherit;
    }
    .rsf input:focus { border-color: #C85A2A; }
    .btn-re-search {
        background: #C85A2A; color: #fff; border: none;
        padding: 10px 20px; border-radius: 8px; font-size: 13px;
        font-weight: 700; cursor: pointer; white-space: nowrap;
        transition: background .2s;
    }
    .btn-re-search:hover { background: #a84820; }

    /* Results section */
    .results-section { padding: 40px 0 60px; background: #f5f6fa; }

    .results-meta {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 24px; flex-wrap: wrap; gap: 12px;
    }
    .results-meta h3 { font-size: 18px; font-weight: 700; color: #0D1F35; }
    .results-meta span { font-size: 14px; color: #888; }

    .hotels-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
    }
    .hotel-result-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e4e8f0;
        box-shadow: 0 2px 12px rgba(13,31,53,.06);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform .2s, box-shadow .2s;
    }
    .hotel-result-card:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(13,31,53,.12); }
    .hotel-img { width: 100%; height: 190px; object-fit: cover; display: block; background: #e8eaf0; }
    .hotel-img-placeholder { width: 100%; height: 190px; display: flex; align-items: center; justify-content: center; background: #e8eaf0; color: #bbb; font-size: 36px; }
    .hotel-body { padding: 18px 18px 16px; flex: 1; display: flex; flex-direction: column; }
    .hotel-name { font-size: 16px; font-weight: 700; color: #0D1F35; margin-bottom: 4px; line-height: 1.3; }
    .hotel-location { font-size: 12px; color: #888; margin-bottom: 8px; }
    .hotel-location i { color: #C85A2A; margin-right: 4px; }
    .hotel-stars { color: #f5c518; font-size: 12px; margin-bottom: 8px; }
    .hotel-rating {
        display: inline-flex; align-items: center; gap: 6px;
        background: #0D1F35; color: #fff; padding: 4px 10px;
        border-radius: 6px; font-size: 12px; font-weight: 700;
        margin-bottom: 10px; width: fit-content;
    }
    .hotel-price { font-size: 18px; font-weight: 800; color: #C85A2A; margin-bottom: 4px; }
    .hotel-price-label { font-size: 11px; color: #aaa; margin-bottom: 14px; }
    .hotel-foot { margin-top: auto; }
    .btn-book-hotel {
        display: block; width: 100%; background: #C85A2A; color: #fff;
        text-align: center; padding: 11px 16px; border-radius: 10px;
        font-size: 14px; font-weight: 700; text-decoration: none;
        transition: background .2s;
    }
    .btn-book-hotel:hover { background: #a84820; color: #fff; }

    /* Empty / error states */
    .no-results {
        text-align: center; padding: 80px 20px;
        background: #fff; border-radius: 16px;
        border: 1px solid #e4e8f0; grid-column: 1/-1;
    }
    .no-results i { font-size: 48px; color: #ddd; display: block; margin-bottom: 16px; }
    .no-results h4 { font-size: 20px; font-weight: 700; color: #333; margin-bottom: 8px; }
    .no-results p  { font-size: 14px; color: #888; margin-bottom: 20px; }
    .btn-try-again {
        display: inline-block; background: #0D1F35; color: #fff;
        padding: 11px 28px; border-radius: 10px; font-size: 14px;
        font-weight: 700; text-decoration: none;
    }
    .btn-try-again:hover { background: #1e3a5f; color: #fff; }

    .error-banner {
        background: #fff8f4; border: 1px solid #f5d5c2; border-radius: 12px;
        padding: 20px 24px; text-align: center; color: #7a3815;
        font-size: 14px; line-height: 1.7; margin-bottom: 24px;
    }
    .error-banner i { font-size: 24px; display: block; margin-bottom: 8px; color: #C85A2A; }

    @media (max-width: 991px) { .hotels-grid { grid-template-columns: repeat(2, 1fr); } .results-search-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 767px) { .hotels-grid { grid-template-columns: 1fr; } .results-search-grid { grid-template-columns: 1fr; } }
</style>

<section class="results-hero">
    <div class="container">
        <h2><i class="fas fa-hotel" style="color:#C85A2A;margin-right:10px"></i>Hotels in {{ $destination }}</h2>
        <p>
            {{ $check_in }} &rarr; {{ $check_out }} &nbsp;&bull;&nbsp; {{ $adults }} adult{{ $adults > 1 ? 's' : '' }}
        </p>

        <form action="{{ route('guest.hotels.results') }}" method="GET" class="results-search-bar">
            <div class="results-search-grid">
                <div class="rsf">
                    <label>Destination</label>
                    <input type="text" name="destination" value="{{ $destination }}" required>
                </div>
                <div class="rsf">
                    <label>Check-in</label>
                    <input type="date" name="check_in" value="{{ $check_in }}" required min="{{ date('Y-m-d') }}">
                </div>
                <div class="rsf">
                    <label>Check-out</label>
                    <input type="date" name="check_out" value="{{ $check_out }}" required>
                </div>
                <div class="rsf">
                    <label>Adults</label>
                    <input type="number" name="adults" value="{{ $adults }}" min="1" max="30" required>
                </div>
                <button type="submit" class="btn-re-search">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </form>
    </div>
</section>

<section class="results-section">
    <div class="container">

        @if($error)
            <div class="error-banner">
                <i class="fas fa-info-circle"></i>
                {{ $error }}
                <br>
                <a href="{{ route('guest.hotel_booking') }}" style="color:#C85A2A;font-weight:700;">
                    View our own hotels &rarr;
                </a>
            </div>
        @endif

        <div class="results-meta">
            <h3>
                @if(!$error && count($hotels) > 0)
                    {{ count($hotels) }} hotel{{ count($hotels) !== 1 ? 's' : '' }} found
                @elseif(!$error)
                    No hotels found for "{{ $destination }}"
                @else
                    Search Results
                @endif
            </h3>
            <a href="{{ route('guest.hotels.search') }}" style="font-size:13px;color:#C85A2A;font-weight:600;">
                <i class="fas fa-arrow-left" style="margin-right:4px"></i> New Search
            </a>
        </div>

        <div class="hotels-grid">
            @forelse($hotels as $hotel)
            @php
                $property   = $hotel['property'] ?? [];
                $name       = $property['name'] ?? 'Hotel';
                $location   = $property['wishlistName'] ?? ($property['countryCode'] ?? '');
                $stars      = intval($property['propertyClass'] ?? 0);
                $rating     = $property['reviewScore'] ?? null;
                $reviewCount= $property['reviewCount'] ?? null;
                $photo      = $property['photoUrls'][0] ?? null;
                $currency   = $property['priceBreakdown']['grossPrice']['currency'] ?? 'USD';
                $price      = $property['priceBreakdown']['grossPrice']['value'] ?? null;
                $bookingUrl = 'https://www.booking.com/hotel/' . ($property['countryCode'] ?? 'rw') . '/' . \Illuminate\Support\Str::slug($name) . '.html';
            @endphp
            <div class="hotel-result-card">
                @if($photo)
                    <img src="{{ $photo }}" alt="{{ $name }}" class="hotel-img">
                @else
                    <div class="hotel-img-placeholder"><i class="fas fa-hotel"></i></div>
                @endif
                <div class="hotel-body">
                    <div class="hotel-name">{{ $name }}</div>
                    @if($location)
                        <div class="hotel-location"><i class="fas fa-map-marker-alt"></i>{{ $location }}</div>
                    @endif
                    @if($stars > 0)
                        <div class="hotel-stars">
                            @for($s = 0; $s < $stars; $s++) <i class="fas fa-star"></i> @endfor
                        </div>
                    @endif
                    @if($rating)
                        <div class="hotel-rating">
                            <i class="fas fa-star" style="color:#f5c518;font-size:10px"></i>
                            {{ number_format($rating, 1) }}
                            @if($reviewCount) <span style="font-weight:400;opacity:.8">({{ number_format($reviewCount) }})</span> @endif
                        </div>
                    @endif
                    @if($price)
                        <div class="hotel-price">{{ $currency }} {{ number_format($price, 0) }}</div>
                        <div class="hotel-price-label">total for stay</div>
                    @endif
                    <div class="hotel-foot">
                        <a href="{{ $bookingUrl }}" target="_blank" rel="noopener" class="btn-book-hotel">
                            Book on Booking.com <i class="fas fa-external-link-alt" style="font-size:11px;margin-left:4px"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            @if(!$error)
            <div class="no-results">
                <i class="fas fa-search"></i>
                <h4>No hotels found</h4>
                <p>We couldn't find hotels for "{{ $destination }}" with the selected dates. Try a different city or dates.</p>
                <a href="{{ route('guest.hotels.search') }}" class="btn-try-again">Try Again</a>
            </div>
            @endif
            @endforelse
        </div>

        @if(!$error && count($hotels) === 0)
        @elseif(!$error)
        <p style="text-align:center;font-size:12px;color:#bbb;margin-top:30px;">
            Hotel results provided by Booking.com. Ubuvivi Tours is not responsible for third-party booking terms.
        </p>
        @endif

    </div>
</section>
@endsection
