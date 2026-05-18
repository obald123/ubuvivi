@extends('layouts.guest')

@section('title')
    Book {{ $service['label'] }} - Ubuvivi
@endsection

@section('meta')
    <meta name="description" content="Book your {{ $service['label'] }} with Ubuvivi Tours. Fast, reliable, and comfortable transport across Rwanda.">
@endsection

@section('css')
<style>
    /* ── Page wrapper ── */
    .tb-page {
        background: #f4f7fb;
        min-height: 100vh;
        padding: 60px 0 80px;
    }

    /* ── Back link ── */
    .tb-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #666;
        font-size: 14px;
        text-decoration: none;
        margin-bottom: 28px;
        transition: color .2s;
    }
    .tb-back:hover { color: #0D1F35; }

    /* ── Page title ── */
    .tb-page-title {
        font-size: clamp(22px, 3.5vw, 32px);
        font-weight: 800;
        color: #0D1F35;
        margin-bottom: 6px;
    }
    .tb-page-sub {
        font-size: 15px;
        color: #666;
        margin-bottom: 36px;
    }

    /* ── Summary card ── */
    .tb-summary {
        background: #0D1F35;
        border-radius: 18px;
        padding: 32px 28px;
        color: #fff;
        position: sticky;
        top: 110px;
    }
    .tb-summary-badge {
        display: inline-block;
        background: #C85A2A;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 50px;
        margin-bottom: 16px;
    }
    .tb-summary h3 {
        font-size: 22px;
        font-weight: 700;
        color: #fff !important;
        margin-bottom: 10px;
        line-height: 1.3;
    }
    .tb-summary p {
        font-size: 14px;
        color: rgba(255,255,255,.72);
        line-height: 1.7;
        margin-bottom: 24px;
    }
    .tb-includes-title {
        font-size: 13px;
        font-weight: 700;
        color: rgba(255,255,255,.5);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }
    .tb-includes-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .tb-includes-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        color: rgba(255,255,255,.85);
        padding: 7px 0;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }
    .tb-includes-list li:last-child { border-bottom: none; }
    .tb-includes-list li::before {
        content: '';
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #C85A2A;
        flex-shrink: 0;
    }
    .tb-note {
        margin-top: 24px;
        padding: 14px 16px;
        background: rgba(255,255,255,.07);
        border-radius: 10px;
        font-size: 13px;
        color: rgba(255,255,255,.6);
        line-height: 1.6;
    }
    .tb-note strong { color: rgba(255,255,255,.9); }

    /* ── Form card ── */
    .tb-form-card {
        background: #fff;
        border-radius: 18px;
        padding: 36px 32px 40px;
        box-shadow: 0 4px 28px rgba(13,31,53,.07);
    }
    .tb-form-section-title {
        font-size: 14px;
        font-weight: 700;
        color: #0D1F35;
        text-transform: uppercase;
        letter-spacing: .8px;
        margin-bottom: 18px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }
    .tb-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 18px;
    }
    .tb-form-row.single { grid-template-columns: 1fr; }
    .tb-form-group {
        display: flex;
        flex-direction: column;
    }
    .tb-form-group label {
        font-size: 13px;
        font-weight: 600;
        color: #444;
        margin-bottom: 7px;
    }
    .tb-form-group input,
    .tb-form-group textarea,
    .tb-form-group select {
        padding: 11px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 9px;
        font-size: 14px;
        font-family: inherit;
        color: #1a1a2e;
        outline: none;
        transition: border-color .2s;
        background: #fff;
    }
    .tb-form-group input:focus,
    .tb-form-group textarea:focus,
    .tb-form-group select:focus { border-color: #0D1F35; }
    .tb-form-group textarea { resize: vertical; min-height: 90px; }

    /* Readonly service type field */
    .tb-service-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(200,90,42,.08);
        border: 1.5px solid rgba(200,90,42,.2);
        border-radius: 9px;
        padding: 10px 16px;
        font-size: 14px;
        font-weight: 600;
        color: #C85A2A;
    }
    .tb-service-tag i { font-size: 16px; }

    /* Time row */
    .tb-time-row {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 10px;
        align-items: end;
    }
    .tb-meridiem select {
        padding: 11px 12px;
        border: 1.5px solid #e2e8f0;
        border-radius: 9px;
        font-size: 14px;
        font-family: inherit;
        color: #1a1a2e;
        outline: none;
        cursor: pointer;
        background: #fff;
    }
    .tb-meridiem select:focus { border-color: #0D1F35; }

    /* Submit */
    .tb-submit {
        width: 100%;
        background: #0D1F35;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 15px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 8px;
        transition: background .2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .tb-submit:hover { background: #1e3a5f; }

    @media(max-width: 767px) {
        .tb-form-row { grid-template-columns: 1fr; }
        .tb-form-card { padding: 24px 18px 28px; }
        .tb-summary { position: static; margin-bottom: 28px; }
    }
</style>
@endsection

@section('content')
<div class="tb-page">
    <div class="container">

        <a href="{{ route('guest.transfer') }}" class="tb-back">
            <i class="fas fa-arrow-left"></i> Back to Transfer Services
        </a>

        <h1 class="tb-page-title">Book Your {{ $service['label'] }}</h1>
        <p class="tb-page-sub">Fill in your details below and we'll confirm your booking shortly.</p>

        <div class="row">

            {{-- ── Summary card ── --}}
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <div class="tb-summary">
                    <span class="tb-summary-badge">Selected Service</span>
                    <h3>{{ $service['label'] }}</h3>
                    <p>{{ $service['description'] }}</p>

                    <div class="tb-includes-title">What's Included</div>
                    <ul class="tb-includes-list">
                        @foreach($service['includes'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>

                    <div class="tb-note">
                        <strong>Price:</strong> Our team will confirm the final price based on your route and requirements after reviewing your booking.
                    </div>
                </div>
            </div>

            {{-- ── Booking form ── --}}
            <div class="col-12 col-md-8">
                <div class="tb-form-card">

                    @if($errors->any())
                        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:14px 18px;margin-bottom:20px;font-size:14px;color:#dc2626;">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('transfer.book.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="service_label" value="{{ $service['label'] }}">

                        {{-- Service type (read-only display) --}}
                        <div class="tb-form-section-title">Service Selected</div>
                        <div class="tb-form-row single" style="margin-bottom:26px;">
                            <div class="tb-service-tag">
                                @if($typeKey === 'airport')
                                    <i class="fas fa-plane"></i>
                                @elseif($typeKey === 'hotel')
                                    <i class="fas fa-hotel"></i>
                                @else
                                    <i class="fas fa-road"></i>
                                @endif
                                {{ $service['label'] }}
                            </div>
                        </div>

                        {{-- Personal info --}}
                        <div class="tb-form-section-title">Your Information</div>
                        <div class="tb-form-row">
                            <div class="tb-form-group">
                                <label>Full Name <span style="color:#e74c3c">*</span></label>
                                <input type="text" name="names" value="{{ old('names') }}" placeholder="Your full name" required>
                            </div>
                            <div class="tb-form-group">
                                <label>Email Address <span style="color:#e74c3c">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                            </div>
                        </div>
                        <div class="tb-form-row single" style="margin-bottom:26px;">
                            <div class="tb-form-group">
                                <label>Phone Number <span style="color:#e74c3c">*</span></label>
                                <input type="tel" name="phone_number" value="{{ old('phone_number') }}" placeholder="+250 7XX XXX XXX" required>
                            </div>
                        </div>

                        {{-- Trip details --}}
                        <div class="tb-form-section-title">Trip Details</div>
                        <div class="tb-form-row">
                            <div class="tb-form-group">
                                <label>Pickup Location <span style="color:#e74c3c">*</span></label>
                                <input type="text" name="pickup_location" value="{{ old('pickup_location') }}" placeholder="{{ $service['pickup_hint'] }}" required>
                            </div>
                            <div class="tb-form-group">
                                <label>Drop-off / Destination <span style="color:#e74c3c">*</span></label>
                                <input type="text" name="destination" value="{{ old('destination') }}" placeholder="{{ $service['dest_hint'] }}" required>
                            </div>
                        </div>
                        <div class="tb-form-row">
                            <div class="tb-form-group">
                                <label>Pickup Date <span style="color:#e74c3c">*</span></label>
                                <input type="date" name="pickup_date" value="{{ old('pickup_date') }}" min="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="tb-form-group">
                                <label>Pickup Time <span style="color:#e74c3c">*</span></label>
                                <div class="tb-time-row">
                                    <input type="time" name="pickup_time" value="{{ old('pickup_time') }}" required>
                                    <div class="tb-meridiem">
                                        <select name="pickup_meridiem">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tb-form-row single" style="margin-bottom:26px;">
                            <div class="tb-form-group">
                                <label>Number of Days</label>
                                <input type="number" name="number_of_days" value="{{ old('number_of_days', 1) }}" min="1" max="30">
                            </div>
                        </div>

                        {{-- Additional message --}}
                        <div class="tb-form-section-title">Additional Information</div>
                        <div class="tb-form-row single">
                            <div class="tb-form-group">
                                <label>Message / Special Requests</label>
                                <textarea name="message" placeholder="Any special requirements, number of passengers, luggage, etc.">{{ old('message') }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="tb-submit">
                            <i class="fas fa-paper-plane"></i>
                            Confirm Booking Request
                        </button>
                        <p style="text-align:center;font-size:13px;color:#999;margin-top:14px;">
                            <i class="fas fa-lock" style="color:#C85A2A;margin-right:4px;"></i>
                            Our team will contact you to confirm pricing and availability.
                        </p>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
