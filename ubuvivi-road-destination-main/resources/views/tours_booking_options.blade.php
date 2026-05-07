@extends('layouts.guest')

@section('title')
    {{ $tour ? $tour->title . ' | Continue Booking' : 'Continue Booking' }} - Ubuvivi Tours
@endsection

@section('body-class', 'hero-page')

@php
    $heroImage = $tour && !empty($tour->images)
        ? $tour->images[0]
        : asset('assets/images/backgrounds/bg_11.jpg');

    $guestRoute = $tour
        ? route('tour.booking', ['id' => $tour->id, 'type' => 'guest'])
        : url('/tours');

    $accountRoute = $tour
        ? route('tour.booking.account', $tour->id)
        : route('login');
@endphp

@section('meta')
    <meta name="description" content="Choose how to continue your booking with Ubuvivi Tours.">
@endsection

@section('css')
<style>
    .tour-choice-hero {
        position: relative;
        min-height: 430px;
        background-image: url('{{ $heroImage }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .tour-choice-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background:
            linear-gradient(180deg, rgba(11, 31, 46, .28) 0%, rgba(11, 31, 46, .18) 28%, rgba(11, 31, 46, .34) 100%);
    }

    .tour-choice-shell {
        position: relative;
        z-index: 2;
        margin-top: -78px;
        padding-bottom: 44px;
    }

    .tour-choice-card {
        background: #fff;
        border-radius: 34px 34px 0 0;
        box-shadow: 0 22px 50px rgba(14, 42, 56, .10);
        padding: 48px 44px 26px;
        overflow: hidden;
    }

    .tour-choice-accent {
        width: 48px;
        height: 6px;
        border-radius: 999px;
        background: #ff6a2a;
        margin: 0 auto 18px;
    }

    .tour-choice-heading h1 {
        margin: 0 0 6px;
        color: #161f2d;
        font-size: clamp(30px, 4vw, 42px);
        font-weight: 700;
        line-height: 1.15;
        font-family: 'Poppins', sans-serif !important;
    }

    .tour-choice-heading p {
        margin: 0 0 14px;
        color: #667085;
        font-size: 16px;
    }

    .tour-choice-meta {
        margin-bottom: 18px;
        color: #183247;
        font-size: 14px;
        font-weight: 600;
    }

    .tour-choice-options {
        display: grid;
        gap: 14px;
    }

    .tour-choice-option {
        border: 1px solid #bac4d0;
        border-radius: 16px;
        padding: 26px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        background: #fff;
    }

    .tour-choice-text h2 {
        margin: 0 0 8px;
        color: #171f2a;
        font-size: 18px;
        font-weight: 700;
        font-family: 'Poppins', sans-serif !important;
    }

    .tour-choice-text p {
        margin: 0;
        color: #495565;
        font-size: 15px;
        line-height: 1.55;
    }

    .tour-choice-btn {
        border: 0;
        background: #ff6124;
        color: #fff;
        min-width: 224px;
        height: 46px;
        padding: 0 24px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: background .18s ease, transform .18s ease;
    }

    .tour-choice-btn:hover {
        background: #e35620;
        color: #fff;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .tour-choice-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 18px;
        color: #1d5b88;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
    }

    .tour-choice-back:hover {
        color: #0f4a73;
        text-decoration: none;
    }

    @media (max-width: 991px) {
        .tour-choice-shell {
            margin-top: -56px;
        }

        .tour-choice-card {
            padding: 38px 28px 24px;
        }

        .tour-choice-option {
            flex-direction: column;
            align-items: flex-start;
        }

        .tour-choice-btn {
            min-width: 0;
            width: 100%;
        }
    }

    @media (max-width: 767px) {
        .tour-choice-hero {
            min-height: 320px;
        }

        .tour-choice-shell {
            margin-top: -40px;
            padding-bottom: 28px;
        }

        .tour-choice-card {
            border-radius: 24px 24px 0 0;
            padding: 30px 18px 20px;
        }

        .tour-choice-option {
            padding: 20px 16px;
        }
    }
</style>
@endsection

@section('content')
    <section class="tour-choice-hero"></section>

    <section class="tour-choice-shell">
        <div class="container">
            <div class="tour-choice-card">
                <div class="tour-choice-accent"></div>

                <div class="tour-choice-heading">
                    <h1>How would you like to continue?</h1>
                    <p>You can always create an account later.</p>
                </div>

                @if($tour)
                    <div class="tour-choice-meta">
                        {{ $tour->title }}
                        @if(!empty($tour->price) && $tour->price > 0)
                            &middot; ${{ number_format($tour->price) }} / per person
                        @endif
                    </div>
                @endif

                <div class="tour-choice-options">
                    <div class="tour-choice-option">
                        <div class="tour-choice-text">
                            <h2>Track &amp; Manage Your Booking</h2>
                            <p>View history, manage bookings, and get faster service.</p>
                        </div>
                        <a href="{{ $accountRoute }}" class="tour-choice-btn">
                            Continue with Account
                        </a>
                    </div>

                    <div class="tour-choice-option">
                        <div class="tour-choice-text">
                            <h2>Quick Booking (No Account)</h2>
                            <p>Book in seconds - we'll contact you to confirm.</p>
                        </div>
                        <a href="{{ $guestRoute }}" class="tour-choice-btn">
                            Continue as Guest
                        </a>
                    </div>
                </div>

                <a href="{{ $tour ? route('tour.view', $tour->id) : url('/tours') }}" class="tour-choice-back">
                    <i class="fas fa-arrow-left"></i>
                    {{ $tour ? 'Back to Tour Details' : 'Back to Tours' }}
                </a>
            </div>
        </div>
    </section>
@endsection
