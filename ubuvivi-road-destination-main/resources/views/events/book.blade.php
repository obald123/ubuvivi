@extends('layouts.guest')

@section('title')
    Book {{ $package['label'] }} - Ubuvivi Event Planning
@endsection

@section('meta')
    <meta name="description" content="Book your {{ $package['label'] }} with Ubuvivi. Professional event planning services in Rwanda.">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    /* ── Hero ── */
    .eb-hero {
        position: relative;
        height: 380px;
        background: url('{{ asset("assets/images/backgrounds/bg_01.jpg") }}') center center / cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .eb-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(13, 31, 53, 0.65);
    }
    .eb-hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
    }
    .eb-hero-content h1 {
        font-size: clamp(28px, 4.5vw, 52px);
        font-weight: 800;
        color: #fff !important;
        text-shadow: 0 2px 16px rgba(0,0,0,.4);
        margin-bottom: 10px;
        line-height: 1.2;
    }
    .eb-hero-content p {
        font-size: 16px;
        color: rgba(255,255,255,.85);
        max-width: 480px;
        margin: 0 auto;
    }

    /* ── Form Section ── */
    .eb-section {
        background: #fff;
        padding: 70px 0 90px;
    }

    .eb-section-header {
        text-align: center;
        margin-bottom: 44px;
    }
    .eb-section-header h2 {
        font-size: clamp(22px, 3vw, 30px);
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 0;
    }
    .eb-underline {
        width: 52px;
        height: 3px;
        background: #C85A2A;
        border-radius: 2px;
        margin: 10px auto 0;
    }

    /* ── Form card ── */
    .eb-form-wrap {
        max-width: 780px;
        margin: 0 auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 32px rgba(13,31,53,.08);
        padding: 40px 44px 48px;
    }

    /* Package badge */
    .eb-pkg-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(200,90,42,.09);
        border: 1.5px solid rgba(200,90,42,.22);
        border-radius: 50px;
        padding: 8px 18px;
        font-size: 14px;
        font-weight: 600;
        color: #C85A2A;
        margin-bottom: 28px;
    }
    .eb-pkg-badge i { font-size: 15px; }

    /* Form rows */
    .eb-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 18px;
    }
    .eb-form-row.single { grid-template-columns: 1fr; }
    .eb-form-group {
        display: flex;
        flex-direction: column;
    }
    .eb-form-group label {
        font-size: 13px;
        font-weight: 500;
        color: #444;
        margin-bottom: 7px;
    }
    .eb-form-group input,
    .eb-form-group textarea,
    .eb-form-group select {
        padding: 11px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 9px;
        font-size: 14px;
        font-family: inherit;
        color: #1a1a2e;
        outline: none;
        background: #fff;
        transition: border-color .2s;
    }
    .eb-form-group input:focus,
    .eb-form-group textarea:focus { border-color: #0D1F35; }
    .eb-form-group input[readonly] {
        background: #f8f9fb;
        color: #666;
        cursor: default;
    }
    .eb-form-group textarea { resize: vertical; min-height: 110px; }

    /* Date + time row */
    .eb-datetime-row {
        display: grid;
        grid-template-columns: 1fr auto auto;
        gap: 10px;
        align-items: end;
    }
    .eb-datetime-row input[type=date] {
        padding: 11px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 9px;
        font-size: 14px;
        font-family: inherit;
        color: #1a1a2e;
        outline: none;
        background: #fff;
        width: 100%;
    }
    .eb-datetime-row input[type=date]:focus { border-color: #0D1F35; }
    .eb-datetime-row input[type=time] {
        padding: 11px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 9px;
        font-size: 14px;
        font-family: inherit;
        color: #1a1a2e;
        outline: none;
        background: #fff;
        width: 120px;
    }
    .eb-datetime-row input[type=time]:focus { border-color: #0D1F35; }
    .eb-datetime-row select {
        padding: 11px 12px;
        border: 1.5px solid #e2e8f0;
        border-radius: 9px;
        font-size: 14px;
        font-family: inherit;
        color: #1a1a2e;
        outline: none;
        background: #fff;
        cursor: pointer;
    }
    .eb-datetime-row select:focus { border-color: #0D1F35; }

    /* Submit */
    .eb-submit {
        width: 100%;
        background: #C85A2A;
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 15px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        margin-top: 10px;
        transition: background .2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .eb-submit:hover { background: #a84520; }
    .eb-submit-note {
        text-align: center;
        font-size: 13px;
        color: #999;
        margin-top: 14px;
    }

    @media(max-width: 767px) {
        .eb-form-wrap { padding: 24px 18px 28px; }
        .eb-form-row { grid-template-columns: 1fr; }
        .eb-datetime-row { grid-template-columns: 1fr; }
        .eb-datetime-row input[type=time] { width: 100%; }
    }
</style>
@endsection

@section('content')

    {{-- Hero --}}
    <section class="eb-hero">
        <div class="eb-hero-content">
            <h1>Make Your Event Memorable</h1>
            <p>From idea to execution — we handle every detail.</p>
        </div>
    </section>

    {{-- Form section --}}
    <section class="eb-section">
        <div class="container">

            <div class="eb-section-header">
                <h2>Quick Booking</h2>
                <div class="eb-underline"></div>
            </div>

            <div class="eb-form-wrap">

                @if($errors->any())
                    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:14px 18px;margin-bottom:22px;font-size:14px;color:#dc2626;">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                {{-- Package badge --}}
                <div class="eb-pkg-badge">
                    <i class="fas fa-calendar-check"></i>
                    {{ $package['label'] }} — {{ $package['tagline'] }}
                </div>

                <form action="{{ route('event.book.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="package_label" value="{{ $package['label'] }}">

                    {{-- Row 1: Name + Email --}}
                    <div class="eb-form-row">
                        <div class="eb-form-group">
                            <label>Full Name <span style="color:#e74c3c">*</span></label>
                            <input type="text" name="names" value="{{ old('names') }}" placeholder="Your full name" required>
                        </div>
                        <div class="eb-form-group">
                            <label>Email <span style="color:#e74c3c">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                        </div>
                    </div>

                    {{-- Row 2: Phone + Guests --}}
                    <div class="eb-form-row">
                        <div class="eb-form-group">
                            <label>Phone number <span style="color:#e74c3c">*</span></label>
                            <input type="tel" name="phone_number" value="{{ old('phone_number') }}" placeholder="+250 7XX XXX XXX" required>
                        </div>
                        <div class="eb-form-group">
                            <label>Number of Guests</label>
                            <input type="number" name="number_of_people" value="{{ old('number_of_people', 1) }}" min="1">
                        </div>
                    </div>

                    {{-- Row 3: Service + Service Type (readonly) --}}
                    <div class="eb-form-row">
                        <div class="eb-form-group">
                            <label>Service</label>
                            <input type="text" value="Event Planning" readonly>
                        </div>
                        <div class="eb-form-group">
                            <label>Service Type</label>
                            <input type="text" value="{{ $package['label'] }}" readonly>
                        </div>
                    </div>

                    {{-- Row 4: Event Date & Time --}}
                    <div class="eb-form-row single">
                        <div class="eb-form-group">
                            <label>Event Date &amp; Time <span style="color:#e74c3c">*</span></label>
                            <div class="eb-datetime-row">
                                <input type="date" name="date" value="{{ old('date') }}" min="{{ date('Y-m-d') }}" required>
                                <input type="time" name="event_time" value="{{ old('event_time') }}">
                                <select name="event_meridiem">
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Row 5: Event Details --}}
                    <div class="eb-form-row single">
                        <div class="eb-form-group">
                            <label>Event Details</label>
                            <textarea name="event_details" placeholder="Describe your event — theme, agenda, any specific needs...">{{ old('event_details') }}</textarea>
                        </div>
                    </div>

                    {{-- Row 6: Special Requests --}}
                    <div class="eb-form-row single">
                        <div class="eb-form-group">
                            <label>Special Requests</label>
                            <textarea name="message" placeholder="Any special requirements or requests...">{{ old('message') }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="eb-submit">Submit Request</button>
                    <p class="eb-submit-note">Our team will contact you shortly to confirm your booking.</p>
                </form>

            </div>
        </div>
    </section>

@endsection
