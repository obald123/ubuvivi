@extends('layouts.guest')

@section('title')
    Tours Booking - Ubuvivi Tours & Safaris
@endsection

@section('meta')
    <meta name="description" content="Choose how to book your tour with Ubuvivi Tours & Safaris - continue with account or as guest.">
@endsection

@section('css')
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .booking-options-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .booking-options-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            padding: 3rem;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .booking-icon {
            width: 80px;
            height: 80px;
            background: var(--orange);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 2rem;
            color: white;
        }

        .booking-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--navy);
            font-family: 'Playfair Display', serif;
        }

        .booking-subtitle {
            color: #666;
            margin-bottom: 3rem;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .booking-options {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .booking-option {
            background: #f8f9fa;
            border: 2px solid transparent;
            border-radius: 12px;
            padding: 2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }

        .booking-option:hover {
            border-color: var(--orange);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            text-decoration: none;
            color: inherit;
        }

        .booking-option-icon {
            width: 60px;
            height: 60px;
            background: var(--navy);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .booking-option-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--navy);
        }

        .booking-option-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            text-decoration: none;
            margin-top: 2rem;
            font-weight: 500;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: var(--orange);
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .booking-options-card {
                padding: 2rem;
                margin: 1rem;
            }
            
            .booking-title {
                font-size: 1.5rem;
            }
            
            .booking-option {
                padding: 1.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="booking-options-container">
        <div class="booking-options-card">
            <div class="booking-icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            
            <h1 class="booking-title">Tours & Travel</h1>
            <p class="booking-subtitle">Choose how you'd like to proceed with your tour booking</p>
            
            <div class="booking-options">
                <a href="{{ route('guest.tours_booking') }}?type=account" class="booking-option">
                    <div class="booking-option-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3 class="booking-option-title">Continue with Account</h3>
                    <p class="booking-option-description">
                        Sign in to your account to access your booking history, manage preferences, and enjoy a faster checkout experience.
                    </p>
                </a>
                
                <a href="{{ route('guest.tours_booking') }}?type=guest" class="booking-option">
                    <div class="booking-option-icon">
                        <i class="fas fa-user-secret"></i>
                    </div>
                    <h3 class="booking-option-title">Continue as Guest</h3>
                    <p class="booking-option-description">
                        Book your tour without creating an account. Quick and easy booking process for one-time travelers.
                    </p>
                </a>
            </div>
            
            <a href="{{ url('/tours') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Tours
            </a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Add any interactive functionality if needed
        document.addEventListener('DOMContentLoaded', function() {
            // Animation on scroll or other interactions can be added here
        });
    </script>
@endsection
