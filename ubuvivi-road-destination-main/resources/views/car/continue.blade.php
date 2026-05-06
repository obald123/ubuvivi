@extends('layouts.guest')

@section('title')
    Continue Booking | Ubuvivi
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    .continue-hero {
        position: relative;
        height: 50vh;
        min-height: 360px;
        background: url('{{ asset("assets/images/backgrounds/bg_8.jpg") }}') center center / cover no-repeat;
    }
    .continue-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,.45);
    }

    .continue-section {
        background: #f8f9fa;
        padding: 0 0 80px;
        position: relative;
        margin-top: -120px;
    }

    .continue-card {
        position: relative;
        z-index: 2;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 12px 40px rgba(0,0,0,.10);
        padding: 2.5rem 2.5rem 2rem;
        max-width: 760px;
        margin: 0 auto;
    }

    .continue-tab {
        display: inline-block;
        width: 60px;
        height: 3px;
        background: var(--orange);
        border-radius: 3px;
        margin: 0 auto 14px;
    }

    .continue-card h1 {
        font-size: 1.7rem;
        font-weight: 700;
        color: var(--navy);
        font-family: 'Playfair Display', serif;
        margin: 0 0 4px;
    }
    .continue-card .subtitle {
        font-size: 14px;
        color: #777;
        margin: 0 0 1.75rem;
    }

    .option-card {
        border: 1px solid #e8e8e8;
        border-radius: 12px;
        padding: 18px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 14px;
        transition: border-color .2s, box-shadow .2s;
    }
    .option-card:hover {
        border-color: var(--orange);
        box-shadow: 0 4px 16px rgba(200,90,42,.10);
    }
    .option-card .opt-text h3 {
        font-size: 16px;
        font-weight: 700;
        color: var(--navy);
        margin: 0 0 4px;
        font-family: 'Poppins', sans-serif !important;
    }
    .option-card .opt-text p {
        font-size: 13px;
        color: #777;
        margin: 0;
    }

    .opt-btn {
        background: var(--orange);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 12px 26px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: background .2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .opt-btn:hover {
        background: #a84520;
        color: #fff;
        text-decoration: none;
    }

    @media (max-width: 600px) {
        .option-card { flex-direction: column; align-items: stretch; }
        .opt-btn { justify-content: center; }
        .continue-card { padding: 2rem 1.5rem; }
    }
</style>
@endsection

@section('content')

    <section class="continue-hero"></section>

    <section class="continue-section">
        <div class="container">
            <div class="continue-card">
                <div style="text-align:center;"><span class="continue-tab"></span></div>
                <h1>How would you like to continue?</h1>
                <p class="subtitle">You can always create an account later.</p>

                <div class="option-card">
                    <div class="opt-text">
                        <h3>Track &amp; Manage Your Booking</h3>
                        <p>View history, manage bookings, and get faster service.</p>
                    </div>
                    <a href="{{ route('car.booking.login', $vehicle->id) }}" class="opt-btn">
                        Continue with Account
                    </a>
                </div>

                <div class="option-card">
                    <div class="opt-text">
                        <h3>Quick Booking (No Account)</h3>
                        <p>Book in seconds &mdash; we'll contact you to confirm.</p>
                    </div>
                    <a href="{{ route('car.booking', $vehicle->id) }}" class="opt-btn">
                        Continue as Guest
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
