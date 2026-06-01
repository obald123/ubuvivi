@extends('layouts.guest')
@section('title') {{ $detail['hotel_name'] ?? $cardData['hotel_name'] }} - Book Hotel - Ubuvivi Tours @endsection

@section('content')
@php
    $hotelName   = $detail['hotel_name']    ?? $cardData['hotel_name'];
    $address     = trim(($detail['address'] ?? '') . ', ' . ($detail['city'] ?? ''), ', ');
    $country     = $detail['country_trans'] ?? strtoupper($cardData['currency'] ?? '');
    $stars       = intval($detail['quality_class'] ?? $cardData['stars']);
    $reviewCount = $detail['review_nr']     ?? null;
    $checkIn     = $cardData['check_in'];
    $checkOut    = $cardData['check_out'];
    $adults      = $cardData['adults'];
    $hotelId     = $cardData['hotel_id'];
    $nights      = $checkIn && $checkOut
        ? \Carbon\Carbon::parse($checkIn)->diffInDays(\Carbon\Carbon::parse($checkOut))
        : 1;

    // Price — prefer per-night from detail API, fallback to card total
    $pricePerNight = $detail['product_price_breakdown']['gross_amount_per_night']['amount_rounded']
        ?? ($cardData['price'] ? $cardData['currency'] . ' ' . number_format($cardData['price'] / max($nights,1), 0) : null);
    $totalPrice    = $detail['product_price_breakdown']['gross_amount']['amount_rounded']
        ?? ($cardData['price'] ? $cardData['currency'] . ' ' . number_format($cardData['price'], 0) : null);
    $oldPrice      = $detail['product_price_breakdown']['strikethrough_amount']['amount_rounded'] ?? null;

    $description  = $detail['hotel_text']['description'] ?? ($detail['hotel_text']['important_information'] ?? null);
    $mainPhoto    = $photos[0] ?? null;
    $thumbPhotos  = array_slice($photos, 1, 4);

    $rating = $cardData['rating'];
@endphp

<style>
    .detail-hero { background:#0D1F35; padding:22px 0 0; }
    .detail-back { color:rgba(255,255,255,.6); font-size:13px; text-decoration:none; display:inline-flex; align-items:center; gap:6px; margin-bottom:16px; }
    .detail-back:hover { color:#C85A2A; }

    .detail-layout { display:grid; grid-template-columns:1fr 400px; gap:28px; align-items:start; padding:36px 0 60px; background:#f5f6fa; }

    /* Gallery */
    .gallery-main { width:100%; height:420px; object-fit:cover; border-radius:16px; display:block; background:#e0e3ea; }
    .gallery-placeholder { width:100%; height:420px; border-radius:16px; background:#e0e3ea; display:flex; align-items:center; justify-content:center; color:#bbb; font-size:52px; }
    .gallery-thumbs { display:flex; gap:10px; margin-top:10px; }
    .gallery-thumb { width:80px; height:60px; object-fit:cover; border-radius:8px; border:2px solid transparent; cursor:pointer; transition:border-color .2s; }
    .gallery-thumb:hover, .gallery-thumb.active { border-color:#C85A2A; }

    /* Info */
    .hotel-info-card { background:#fff; border-radius:16px; padding:28px; border:1px solid #e4e8f0; margin-top:20px; }
    .hotel-name { font-size:26px; font-weight:800; color:#0D1F35; margin-bottom:6px; }
    .hotel-stars { color:#f5c518; font-size:14px; margin-bottom:8px; }
    .hotel-address { font-size:14px; color:#777; margin-bottom:14px; }
    .hotel-address i { color:#C85A2A; margin-right:5px; }
    .rating-row { display:flex; align-items:center; gap:12px; margin-bottom:18px; flex-wrap:wrap; }
    .rating-badge { background:#0D1F35; color:#fff; font-size:15px; font-weight:800; padding:6px 14px; border-radius:8px; }
    .rating-count { font-size:13px; color:#888; }

    .price-box { background:#fff8f4; border:1px solid #f5d5c2; border-radius:12px; padding:16px 20px; margin-bottom:20px; }
    .price-night { font-size:22px; font-weight:800; color:#C85A2A; }
    .price-label { font-size:12px; color:#aaa; }
    .price-total { font-size:14px; color:#555; font-weight:600; margin-top:4px; }
    .price-old { font-size:13px; color:#bbb; text-decoration:line-through; }

    .section-heading { font-size:16px; font-weight:700; color:#0D1F35; margin-bottom:12px; padding-bottom:8px; border-bottom:2px solid #f0f0f0; }
    .description-text { font-size:14px; color:#555; line-height:1.8; }
    .highlights-list { display:flex; flex-wrap:wrap; gap:10px; margin-bottom:4px; }
    .highlight-chip { background:#f0f5ff; border:1px solid #dde7ff; color:#1a3a6f; padding:6px 14px; border-radius:50px; font-size:13px; display:inline-flex; align-items:center; gap:6px; }
    .facilities-grid { display:grid; grid-template-columns:1fr 1fr; gap:8px; }
    .facility-item { font-size:13px; color:#555; display:flex; align-items:center; gap:7px; }
    .facility-item i { color:#C85A2A; font-size:12px; width:14px; }

    /* Booking form card */
    .booking-card { background:#fff; border-radius:16px; border:1px solid #e4e8f0; box-shadow:0 4px 24px rgba(13,31,53,.08); position:sticky; top:24px; }
    .booking-card-head { background:#0D1F35; border-radius:16px 16px 0 0; padding:20px 24px; }
    .booking-card-head h3 { color:#fff; font-size:18px; font-weight:700; margin:0; }
    .booking-card-head p  { color:rgba(255,255,255,.6); font-size:13px; margin:4px 0 0; }
    .booking-card-body { padding:22px 24px; }
    .stay-summary { background:#f7f8fb; border-radius:10px; padding:14px 16px; margin-bottom:18px; }
    .stay-row { display:flex; justify-content:space-between; align-items:center; font-size:13px; color:#555; margin-bottom:6px; }
    .stay-row:last-child { margin-bottom:0; }
    .stay-row span:last-child { font-weight:700; color:#0D1F35; }
    .form-group-b { margin-bottom:14px; }
    .form-group-b label { display:block; font-size:12px; font-weight:700; color:#444; text-transform:uppercase; letter-spacing:.4px; margin-bottom:5px; }
    .form-group-b input,
    .form-group-b select,
    .form-group-b textarea { width:100%; padding:10px 13px; border:1.5px solid #e0e0e0; border-radius:8px; font-size:14px; outline:none; font-family:inherit; color:#222; background:#fff; transition:border-color .2s; }
    .form-group-b input:focus,
    .form-group-b select:focus,
    .form-group-b textarea:focus { border-color:#0D1F35; }
    .form-group-b textarea { resize:vertical; min-height:80px; }
    .btn-request { width:100%; background:#C85A2A; color:#fff; border:none; padding:14px; border-radius:10px; font-size:15px; font-weight:700; cursor:pointer; transition:background .2s; margin-top:6px; }
    .btn-request:hover { background:#a84820; }
    .booking-note { font-size:12px; color:#aaa; text-align:center; margin-top:10px; line-height:1.6; }

    @media (max-width: 991px) {
        .detail-layout { grid-template-columns:1fr; }
        .booking-card { position:static; }
        .gallery-main { height:280px; }
    }
    @media (max-width: 576px) {
        .gallery-main { height:220px; }
        .hotel-name { font-size:20px; }
    }
</style>

<div class="detail-hero">
    <div class="container">
        <a href="javascript:history.back()" class="detail-back">
            <i class="fas fa-arrow-left"></i> Back to results
        </a>
    </div>
</div>

<div style="background:#f5f6fa; padding:36px 0 60px;">
    <div class="container">
        <div class="detail-layout">

            {{-- Left: Hotel Info --}}
            <div>
                {{-- Gallery --}}
                @if($mainPhoto)
                    <img src="{{ $mainPhoto }}" alt="{{ $hotelName }}" class="gallery-main" id="mainPhoto">
                    @if(count($thumbPhotos))
                        <div class="gallery-thumbs">
                            <img src="{{ $mainPhoto }}" class="gallery-thumb active" onclick="switchPhoto(this, '{{ $mainPhoto }}')">
                            @foreach($thumbPhotos as $thumb)
                                <img src="{{ $thumb }}" class="gallery-thumb" onclick="switchPhoto(this, '{{ $thumb }}')">
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="gallery-placeholder"><i class="fas fa-hotel"></i></div>
                @endif

                {{-- Hotel Name & Stars --}}
                <div class="hotel-info-card">
                    <div class="hotel-name">{{ $hotelName }}</div>
                    @if($stars > 0)
                        <div class="hotel-stars">
                            @for($s=0; $s<$stars; $s++) <i class="fas fa-star"></i> @endfor
                            @for($s=$stars; $s<5; $s++) <i class="far fa-star" style="color:#ddd"></i> @endfor
                            <span style="font-size:12px;color:#aaa;margin-left:6px;">{{ $stars }}-star hotel</span>
                        </div>
                    @endif
                    @if($address)
                        <div class="hotel-address"><i class="fas fa-map-marker-alt"></i>{{ $address }}{{ $country ? ', ' . $country : '' }}</div>
                    @endif

                    <div class="rating-row">
                        @if($rating)
                            <span class="rating-badge"><i class="fas fa-star" style="color:#f5c518;margin-right:4px;font-size:12px"></i>{{ number_format($rating, 1) }}</span>
                            <span style="font-size:14px;color:#555;">{{ $reviewCount ? number_format($reviewCount) . ' reviews' : '' }}</span>
                        @endif
                        @if(!empty($detail['hotel_include_breakfast']))
                            <span class="highlight-chip"><i class="fas fa-coffee"></i> Breakfast included</span>
                        @endif
                        @if(!empty($detail['available_rooms']))
                            <span style="font-size:13px;color:#e74c3c;font-weight:600;">
                                <i class="fas fa-fire" style="margin-right:4px"></i>Only {{ $detail['available_rooms'] }} rooms left!
                            </span>
                        @endif
                    </div>

                    {{-- Price summary --}}
                    @if($pricePerNight || $totalPrice)
                        <div class="price-box">
                            @if($oldPrice)
                                <div class="price-old">{{ $oldPrice }}</div>
                            @endif
                            @if($pricePerNight)
                                <div class="price-night">{{ $pricePerNight }}<span style="font-size:13px;font-weight:400;color:#aaa"> / night</span></div>
                            @endif
                            @if($totalPrice && $nights > 1)
                                <div class="price-total">Total for {{ $nights }} night{{ $nights > 1 ? 's' : '' }}: <strong>{{ $totalPrice }}</strong></div>
                            @endif
                            <div class="price-label" style="margin-top:4px">Taxes and fees may apply at checkout</div>
                        </div>
                    @endif

                    {{-- Highlights --}}
                    @if(count($highlights))
                        <div style="margin-bottom:20px;">
                            <div class="section-heading">Property Highlights</div>
                            <div class="highlights-list">
                                @foreach($highlights as $h)
                                    <span class="highlight-chip"><i class="fas fa-check" style="color:#15803d"></i>{{ $h['name'] }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Description --}}
                    @if($description)
                        <div style="margin-bottom:20px;">
                            <div class="section-heading">About This Hotel</div>
                            <div class="description-text">{{ $description }}</div>
                        </div>
                    @endif

                    {{-- Facilities --}}
                    @if(count($facilities))
                        <div>
                            <div class="section-heading">Facilities & Amenities</div>
                            <div class="facilities-grid">
                                @foreach(array_slice($facilities, 0, 20) as $fac)
                                    <div class="facility-item"><i class="fas fa-check-circle"></i>{{ $fac }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($apiError)
                        <p style="font-size:12px;color:#bbb;margin-top:16px;text-align:center;">
                            <i class="fas fa-info-circle"></i> Full hotel details could not be loaded — you can still complete your booking request below.
                        </p>
                    @endif
                </div>
            </div>

            {{-- Right: Booking Form --}}
            <div>
                <div class="booking-card">
                    <div class="booking-card-head">
                        <h3><i class="fas fa-calendar-check" style="color:#C85A2A;margin-right:8px"></i>Book This Hotel</h3>
                        <p>Submit a request — our team confirms within 24 hours</p>
                    </div>
                    <div class="booking-card-body">

                        {{-- Stay summary (read-only) --}}
                        <div class="stay-summary">
                            <div class="stay-row">
                                <span><i class="fas fa-sign-in-alt" style="color:#C85A2A;margin-right:5px"></i>Check-in</span>
                                <span>{{ $checkIn ? \Carbon\Carbon::parse($checkIn)->format('M d, Y') : '—' }}</span>
                            </div>
                            <div class="stay-row">
                                <span><i class="fas fa-sign-out-alt" style="color:#C85A2A;margin-right:5px"></i>Check-out</span>
                                <span>{{ $checkOut ? \Carbon\Carbon::parse($checkOut)->format('M d, Y') : '—' }}</span>
                            </div>
                            <div class="stay-row">
                                <span><i class="fas fa-moon" style="color:#C85A2A;margin-right:5px"></i>Nights</span>
                                <span>{{ $nights }}</span>
                            </div>
                            <div class="stay-row">
                                <span><i class="fas fa-user" style="color:#C85A2A;margin-right:5px"></i>Guests</span>
                                <span>{{ $adults }} adult{{ $adults > 1 ? 's' : '' }}</span>
                            </div>
                        </div>

                        @if($errors->any())
                            <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:12px 14px;margin-bottom:14px;font-size:13px;color:#dc2626;">
                                @foreach($errors->all() as $error)
                                    <div><i class="fas fa-exclamation-circle" style="margin-right:5px"></i>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('guest.hotels.book.store') }}" method="POST">
                            @csrf
                            {{-- Hidden fields --}}
                            <input type="hidden" name="booking_com_hotel_id"   value="{{ $hotelId }}">
                            <input type="hidden" name="booking_com_hotel_name" value="{{ $hotelName }}">
                            <input type="hidden" name="check_in"               value="{{ $checkIn }}">
                            <input type="hidden" name="check_out"              value="{{ $checkOut }}">
                            <input type="hidden" name="number_of_guests"       value="{{ $adults }}">

                            <div class="form-group-b">
                                <label>Full Name <span style="color:#e74c3c">*</span></label>
                                <input type="text" name="names" placeholder="Your full name" value="{{ old('names') }}" required>
                            </div>
                            <div class="form-group-b">
                                <label>Email Address <span style="color:#e74c3c">*</span></label>
                                <input type="email" name="email" placeholder="your@email.com" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group-b">
                                <label>Phone Number <span style="color:#e74c3c">*</span></label>
                                <input type="tel" name="phone_number" placeholder="+250 7XX XXX XXX" value="{{ old('phone_number') }}" required>
                            </div>
                            <div class="form-group-b">
                                <label>Room Type</label>
                                <select name="room_type">
                                    <option value="">— Select room type —</option>
                                    @foreach(['Single', 'Double', 'Twin', 'Suite', 'Family Room'] as $rt)
                                        <option value="{{ $rt }}" {{ old('room_type') === $rt ? 'selected' : '' }}>{{ $rt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group-b">
                                <label>Special Requests</label>
                                <textarea name="message" placeholder="Any special requests or preferences...">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" class="btn-request">
                                <i class="fas fa-paper-plane" style="margin-right:8px"></i>Request Booking
                            </button>
                        </form>

                        <p class="booking-note">
                            <i class="fas fa-shield-alt" style="color:#15803d"></i>
                            Our team will review your request and confirm within <strong>24 hours</strong>.<br>
                            You will receive a confirmation email with next steps.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function switchPhoto(thumb, url) {
    document.getElementById('mainPhoto').src = url;
    document.querySelectorAll('.gallery-thumb').forEach(function(t) { t.classList.remove('active'); });
    thumb.classList.add('active');
}
</script>
@endsection
