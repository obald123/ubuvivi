@extends('layouts.guest')
@section('title') Hotel Booking — {{ $booking->names }} - Ubuvivi Tours @endsection

@section('content')
@php
    $checkIn  = $booking->check_in instanceof \Carbon\Carbon ? $booking->check_in : \Carbon\Carbon::parse($booking->check_in);
    $checkOut = $booking->check_out instanceof \Carbon\Carbon ? $booking->check_out : \Carbon\Carbon::parse($booking->check_out);
    $nights   = $checkOut->diffInDays($checkIn);
    $hotelName = ($booking->booking_com_hotel_name ?? null)
              ?? (optional($booking->hotel)->name ?? null);
    $isBookingCom = ($booking->source ?? 'internal') === 'booking_com';
@endphp

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

    .bv-card { background:#fff; border-radius:16px; border:1px solid #e4e8f0; box-shadow:0 2px 12px rgba(13,31,53,.06); overflow:hidden; }
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

    @media (max-width: 991px) { .bv-grid { grid-template-columns:1fr; } }
</style>

<div class="bv-hero">
    <div class="container">
        @if(null === $booking->approved)
            <div class="bv-hero-badge pending"><i class="fas fa-clock"></i> Booking Pending</div>
        @elseif(true === $booking->approved)
            <div class="bv-hero-badge approved"><i class="fas fa-check-circle"></i> Booking Approved</div>
        @else
            <div class="bv-hero-badge rejected"><i class="fas fa-times-circle"></i> Booking Rejected</div>
        @endif
        <h2><i class="fas fa-hotel" style="color:#C85A2A;margin-right:10px"></i>Hotel Booking Details</h2>
        <p>Booking #{{ $booking->id }} &bull; Submitted {{ $booking->created_at?->format('M d, Y') }}</p>
    </div>
</div>

<div class="bv-body">
    <div class="container">
        <div class="bv-grid">

            {{-- Left: Booking details --}}
            <div style="display:flex;flex-direction:column;gap:20px;">

                {{-- Hotel & Stay Info --}}
                <div class="bv-card">
                    <div class="bv-card-head">
                        <i class="fas fa-hotel"></i>
                        <h3>Hotel & Stay Information</h3>
                    </div>
                    <div class="bv-card-body">
                        @if($hotelName)
                        <div class="bv-detail-row">
                            <div class="bv-detail-icon"><i class="fas fa-hotel"></i></div>
                            <div>
                                <div class="bv-detail-label">Hotel</div>
                                <div class="bv-detail-value">
                                    {{ $hotelName }}
                                    @if($isBookingCom)
                                        <span style="font-size:11px;background:#e8f0fe;color:#1a56db;padding:2px 8px;border-radius:50px;margin-left:6px;font-weight:600;">via Booking.com</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="bv-detail-row">
                            <div class="bv-detail-icon"><i class="fas fa-sign-in-alt"></i></div>
                            <div>
                                <div class="bv-detail-label">Check-in</div>
                                <div class="bv-detail-value">{{ $checkIn->format('l, M d, Y') }}</div>
                            </div>
                        </div>
                        <div class="bv-detail-row">
                            <div class="bv-detail-icon"><i class="fas fa-sign-out-alt"></i></div>
                            <div>
                                <div class="bv-detail-label">Check-out</div>
                                <div class="bv-detail-value">{{ $checkOut->format('l, M d, Y') }}</div>
                            </div>
                        </div>
                        <div class="bv-detail-row">
                            <div class="bv-detail-icon"><i class="fas fa-moon"></i></div>
                            <div>
                                <div class="bv-detail-label">Duration</div>
                                <div class="bv-detail-value">{{ $nights }} night{{ $nights != 1 ? 's' : '' }}</div>
                            </div>
                        </div>
                        <div class="bv-detail-row">
                            <div class="bv-detail-icon"><i class="fas fa-users"></i></div>
                            <div>
                                <div class="bv-detail-label">Guests</div>
                                <div class="bv-detail-value">{{ $booking->number_of_guests }} guest{{ $booking->number_of_guests != 1 ? 's' : '' }}</div>
                            </div>
                        </div>
                        @if($booking->room_type)
                        <div class="bv-detail-row">
                            <div class="bv-detail-icon"><i class="fas fa-bed"></i></div>
                            <div>
                                <div class="bv-detail-label">Room Type</div>
                                <div class="bv-detail-value">{{ $booking->room_type }}</div>
                            </div>
                        </div>
                        @endif
                        @if($booking->message)
                        <div class="bv-detail-row">
                            <div class="bv-detail-icon"><i class="fas fa-comment"></i></div>
                            <div>
                                <div class="bv-detail-label">Special Requests</div>
                                <div class="bv-detail-value" style="font-weight:400;font-size:14px;color:#555;">{{ $booking->message }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Status --}}
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

            {{-- Right: Contact info --}}
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
@endsection
