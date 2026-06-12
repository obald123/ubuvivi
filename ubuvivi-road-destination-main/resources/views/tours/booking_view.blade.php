@extends('layouts.guest')
@section('title')
    @if(empty($booking))
        Booking Error — Ubuvivi Tours
    @elseif($itinerary)
        Tour Booking — {{ $booking->names }} | Ubuvivi Tours
    @else
        Event Booking — {{ $booking->names }} | Ubuvivi Tours
    @endif
@endsection

@section('content')

<style>
    .bv-hero { background:#0D1F35; padding:50px 0 30px; }
    .bv-hero-badge { display:inline-flex; align-items:center; gap:8px; padding:6px 16px; border-radius:50px; font-size:13px; font-weight:700; margin-bottom:14px; }
    .bv-hero-badge.pending  { background:#fff5cc; color:#92640a; }
    .bv-hero-badge.approved { background:#d1fae5; color:#065f46; }
    .bv-hero-badge.rejected { background:#fee2e2; color:#991b1b; }
    .bv-hero h2 { color:#fff; font-size:26px; font-weight:800; margin-bottom:6px; }
    .bv-hero p  { color:rgba(255,255,255,.6); font-size:14px; }

    .bv-body { background:#f5f6fa; padding:40px 0 60px; }
    .bv-grid { display:grid; grid-template-columns:1fr 380px; gap:26px; align-items:start; }

    .bv-card { background:#fff; border-radius:16px; border:1px solid #e4e8f0; box-shadow:0 2px 12px rgba(13,31,53,.06); overflow:hidden; margin-bottom:20px; }
    .bv-card:last-child { margin-bottom:0; }
    .bv-card-head { background:#0D1F35; padding:18px 24px; display:flex; align-items:center; gap:12px; }
    .bv-card-head h3 { color:#fff; font-size:16px; font-weight:700; margin:0; }
    .bv-card-head i { color:#C85A2A; font-size:18px; }
    .bv-card-body { padding:24px; }

    .bv-detail-row { display:flex; align-items:flex-start; padding:14px 0; border-bottom:1px solid #f4f4f4; gap:14px; }
    .bv-detail-row:last-child { border-bottom:none; padding-bottom:0; }
    .bv-detail-icon { width:34px; height:34px; background:#f0f5ff; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .bv-detail-icon i { color:#C85A2A; font-size:14px; }
    .bv-detail-label { font-size:11px; font-weight:700; color:#aaa; text-transform:uppercase; letter-spacing:.5px; margin-bottom:3px; }
    .bv-detail-value { font-size:15px; color:#1a1a2e; font-weight:600; }

    .bv-contact-field { margin-bottom:14px; }
    .bv-contact-field label { display:block; font-size:11px; font-weight:700; color:#aaa; text-transform:uppercase; letter-spacing:.5px; margin-bottom:5px; }
    .bv-contact-field .field-val { background:#f7f8fb; border:1px solid #e8e8e8; border-radius:8px; padding:10px 14px; font-size:14px; color:#333; }

    .bv-ref-box { background:#f0f5ff; border:1px solid #dde7ff; border-radius:10px; padding:16px 18px; text-align:center; margin-bottom:18px; }
    .bv-ref-box .ref-label { font-size:11px; color:#aaa; text-transform:uppercase; letter-spacing:.5px; margin-bottom:4px; }
    .bv-ref-box .ref-value { font-size:22px; font-weight:800; color:#0D1F35; }

    .status-pill { display:inline-flex; align-items:center; gap:7px; padding:8px 18px; border-radius:50px; font-size:14px; font-weight:700; }
    .status-pill.pending  { background:#fff5cc; color:#92640a; border:1px solid #fde68a; }
    .status-pill.approved { background:#d1fae5; color:#065f46; border:1px solid #6ee7b7; }
    .status-pill.rejected { background:#fee2e2; color:#991b1b; border:1px solid #fca5a5; }

    .bv-meta-row { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:13px; color:#666; }
    .bv-meta-row span:last-child { font-weight:600; color:#0D1F35; }

    .bv-tour-img { width:100%; height:200px; object-fit:cover; border-radius:10px; margin-bottom:14px; }
    .bv-tag { display:inline-block; background:#f0f5ff; color:#0D1F35; border-radius:50px; padding:4px 12px; font-size:12px; font-weight:600; margin:3px 3px 3px 0; }

    .bv-error { display:flex; flex-direction:column; align-items:center; justify-content:center; padding:80px 24px; text-align:center; }
    .bv-error i { font-size:56px; color:#e74c3c; margin-bottom:20px; opacity:.7; }
    .bv-error h3 { font-size:22px; font-weight:800; color:#1a1a2e; margin-bottom:10px; }
    .bv-error p { font-size:15px; color:#666; max-width:420px; line-height:1.7; }

    @media (max-width: 991px) { .bv-grid { grid-template-columns:1fr; } }
    @media (max-width: 576px) { .bv-hero h2 { font-size:20px; } }
</style>

@if(empty($booking))
    <div class="bv-hero">
        <div class="container">
            <div class="bv-hero-badge rejected"><i class="fas fa-times-circle"></i> Error</div>
            <h2><i class="fas fa-compass" style="color:#C85A2A;margin-right:10px"></i>Booking Not Found</h2>
            <p>We were unable to load this booking.</p>
        </div>
    </div>
    <div class="bv-body">
        <div class="container">
            <div class="bv-card">
                <div class="bv-card-body">
                    <div class="bv-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <h3>An Error Occurred</h3>
                        <p>{{ $message }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    {{-- Hero --}}
    <div class="bv-hero">
        <div class="container">
            <a href="{{ url('/tours') }}" style="display:inline-flex;align-items:center;gap:8px;color:rgba(255,255,255,.9);font-weight:600;font-size:14px;text-decoration:none;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.28);padding:8px 20px;border-radius:50px;margin-bottom:16px;">
                <i class="fas fa-arrow-left" style="font-size:12px;"></i> Go back to Tours
            </a>
            @if(null === $booking->approved)
                <div class="bv-hero-badge pending"><i class="fas fa-clock"></i> Booking Pending</div>
            @elseif(true === $booking->approved)
                <div class="bv-hero-badge approved"><i class="fas fa-check-circle"></i> Booking Approved</div>
            @else
                <div class="bv-hero-badge rejected"><i class="fas fa-times-circle"></i> Booking Rejected</div>
            @endif
            <h2>
                <i class="fas fa-{{ $itinerary ? 'map-marked-alt' : 'calendar-star' }}" style="color:#C85A2A;margin-right:10px"></i>
                {{ $itinerary ? 'Tour Booking Details' : 'Event Booking Details' }}
            </h2>
            <p>Booking #{{ $booking->id }} &bull; Submitted {{ $booking->created_at?->format('M d, Y') }}</p>
        </div>
    </div>

    <div class="bv-body">
        <div class="container">
            <div class="bv-grid">

                {{-- Left column --}}
                <div>
                    @if($itinerary)
                        {{-- Tour info card --}}
                        <div class="bv-card">
                            <div class="bv-card-head">
                                <i class="fas fa-map-marked-alt"></i>
                                <h3>Tour Information</h3>
                            </div>
                            <div class="bv-card-body">
                                @php
                                    $imgs = is_array($itinerary->images) ? $itinerary->images : (is_string($itinerary->images) ? json_decode($itinerary->images, true) : []);
                                @endphp
                                @if(count($imgs) && isset($imgs[0]))
                                    <img src="{{ $imgs[0] }}" class="bv-tour-img" alt="{{ $itinerary->title }}" onerror="this.style.display='none'">
                                @endif
                                <div class="bv-detail-row" style="padding-top:0;">
                                    <div class="bv-detail-icon"><i class="fas fa-compass"></i></div>
                                    <div>
                                        <div class="bv-detail-label">Tour / Package</div>
                                        <div class="bv-detail-value">{{ $itinerary->title }}</div>
                                    </div>
                                </div>
                                @if($itinerary->duration)
                                <div class="bv-detail-row">
                                    <div class="bv-detail-icon"><i class="fas fa-clock"></i></div>
                                    <div>
                                        <div class="bv-detail-label">Duration</div>
                                        <div class="bv-detail-value">{{ $itinerary->duration }}</div>
                                    </div>
                                </div>
                                @endif
                                @if($itinerary->location ?? $itinerary->country ?? null)
                                <div class="bv-detail-row">
                                    <div class="bv-detail-icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <div>
                                        <div class="bv-detail-label">Destination</div>
                                        <div class="bv-detail-value">{{ $itinerary->location ?? $itinerary->country ?? '' }}</div>
                                    </div>
                                </div>
                                @endif
                                @if(count($itinerary->highlights))
                                <div class="bv-detail-row">
                                    <div class="bv-detail-icon"><i class="fas fa-star"></i></div>
                                    <div>
                                        <div class="bv-detail-label">Highlights</div>
                                        <div style="margin-top:4px;">
                                            @foreach(array_slice((array)$itinerary->highlights, 0, 5) as $h)
                                                <span class="bv-tag"><i class="fas fa-check" style="color:#C85A2A;margin-right:4px;font-size:10px;"></i>{{ is_array($h) ? ($h['title'] ?? $h[0] ?? '') : $h }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Booking details card --}}
                    <div class="bv-card">
                        <div class="bv-card-head">
                            <i class="fas fa-calendar-check"></i>
                            <h3>{{ $itinerary ? 'Tour Details' : 'Event Details' }}</h3>
                        </div>
                        <div class="bv-card-body">
                            @if($booking->date)
                            <div class="bv-detail-row">
                                <div class="bv-detail-icon"><i class="fas fa-calendar-alt"></i></div>
                                <div>
                                    <div class="bv-detail-label">{{ $itinerary ? 'Tour Date' : 'Event Date & Time' }}</div>
                                    <div class="bv-detail-value">{{ $booking->date }}</div>
                                </div>
                            </div>
                            @endif
                            @if($booking->number_of_people)
                            <div class="bv-detail-row">
                                <div class="bv-detail-icon"><i class="fas fa-users"></i></div>
                                <div>
                                    <div class="bv-detail-label">Number of People</div>
                                    <div class="bv-detail-value">{{ $booking->number_of_people }} person{{ $booking->number_of_people != 1 ? 's' : '' }}</div>
                                </div>
                            </div>
                            @endif
                            @if($booking->price && $booking->price > 0)
                            <div class="bv-detail-row">
                                <div class="bv-detail-icon"><i class="fas fa-dollar-sign"></i></div>
                                <div>
                                    <div class="bv-detail-label">Total Price</div>
                                    <div class="bv-detail-value">${{ number_format($booking->price, 2) }}</div>
                                </div>
                            </div>
                            @endif
                            @if($booking->message)
                            <div class="bv-detail-row">
                                <div class="bv-detail-icon"><i class="fas fa-comment"></i></div>
                                <div>
                                    <div class="bv-detail-label">{{ $itinerary ? 'Special Requests' : 'Event Details & Notes' }}</div>
                                    <div class="bv-detail-value" style="font-weight:400;font-size:14px;color:#555;white-space:pre-line;">{{ $booking->message }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Status card --}}
                    <div class="bv-card">
                        <div class="bv-card-head">
                            <i class="fas fa-info-circle"></i>
                            <h3>Booking Status</h3>
                        </div>
                        <div class="bv-card-body">
                            <div style="margin-bottom:16px;">
                                @if(null === $booking->approved)
                                    <span class="status-pill pending"><i class="fas fa-clock"></i> Pending Review</span>
                                    <p style="font-size:13px;color:#888;margin-top:10px;">Our team is reviewing your booking and will confirm within 24 hours.</p>
                                @elseif(true === $booking->approved)
                                    <span class="status-pill approved"><i class="fas fa-check-circle"></i> Approved</span>
                                    <p style="font-size:13px;color:#065f46;margin-top:10px;">Your booking has been confirmed! Our team will contact you with further details.</p>
                                @else
                                    <span class="status-pill rejected"><i class="fas fa-times-circle"></i> Not Available</span>
                                    <p style="font-size:13px;color:#991b1b;margin-top:10px;">Unfortunately this booking could not be confirmed. Please contact us for alternatives.</p>
                                @endif
                            </div>
                            <div class="bv-meta-row"><span>Booking Reference</span><span>#{{ $booking->id }}</span></div>
                            <div class="bv-meta-row"><span>Submitted</span><span>{{ $booking->created_at?->format('M d, Y h:i A') }}</span></div>
                        </div>
                    </div>
                </div>

                {{-- Right: Guest info --}}
                <div>
                    <div class="bv-card">
                        <div class="bv-card-head">
                            <i class="fas fa-user"></i>
                            <h3>Guest Information</h3>
                        </div>
                        <div class="bv-card-body">
                            <div class="bv-ref-box">
                                <div class="ref-label">Booking Reference</div>
                                <div class="ref-value">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</div>
                            </div>
                            <div class="bv-contact-field">
                                <label>Full Name</label>
                                <div class="field-val">{{ $booking->names }}</div>
                            </div>
                            <div class="bv-contact-field">
                                <label>Email Address</label>
                                <div class="field-val">{{ $booking->email }}</div>
                            </div>
                            <div class="bv-contact-field">
                                <label>Phone Number</label>
                                <div class="field-val">{{ $booking->phone_number }}</div>
                            </div>
                            <div class="bv-contact-field">
                                <label>Booking Date</label>
                                <div class="field-val">{{ $booking->created_at?->format('M d, Y \a\t h:i A') }}</div>
                            </div>

                            <div style="margin-top:20px;padding-top:16px;border-top:1px solid #f0f0f0;">
                                <p style="font-size:12px;color:#aaa;text-align:center;line-height:1.7;">
                                    <i class="fas fa-lock" style="color:#C85A2A;margin-right:4px"></i>
                                    This page is private. Do not share this link with others.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top:16px;background:#fff8f4;border:1px solid #f5d5c2;border-radius:12px;padding:16px 18px;">
                        <p style="font-size:13px;color:#7a3815;line-height:1.7;margin:0;">
                            <i class="fas fa-headset" style="color:#C85A2A;margin-right:6px"></i>
                            <strong>Need help?</strong> Contact us at
                            <a href="mailto:ubuvivitours@gmail.com" style="color:#C85A2A;font-weight:600;">ubuvivitours@gmail.com</a>
                            or call <a href="tel:+250789044222" style="color:#C85A2A;font-weight:600;">+250 789 044 222</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endif

@endsection
