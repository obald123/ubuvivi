@extends("layouts.guest")

@section('title')
    Booking Confirmed - Ubuvivi Tours
@endsection

@section('css')
<style>
    .success-section {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 80px 20px;
        background: #f7f8fb;
    }
    .success-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 40px rgba(13,31,53,.10);
        padding: 56px 48px;
        max-width: 560px;
        width: 100%;
        text-align: center;
    }
    .success-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(34,197,94,.12);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
    }
    .success-icon i { font-size: 38px; color: #22c55e; }
    .error-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(239,68,68,.10);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
    }
    .error-icon i { font-size: 38px; color: #ef4444; }
    .success-card h2 {
        font-size: 28px;
        font-weight: 800;
        color: #0D1F35;
        margin-bottom: 10px;
    }
    .success-card .sub {
        font-size: 16px;
        color: #555;
        line-height: 1.7;
        margin-bottom: 32px;
    }
    .success-card .sub a {
        color: #C85A2A;
        font-weight: 600;
        text-decoration: none;
    }
    .success-card .sub a:hover { text-decoration: underline; }
    .success-btn {
        display: inline-block;
        background: #C85A2A;
        color: #fff;
        font-weight: 600;
        font-size: 15px;
        padding: 13px 34px;
        border-radius: 50px;
        text-decoration: none;
        transition: background .2s;
    }
    .success-btn:hover { background: #a84520; color: #fff; text-decoration: none; }
    .back-home {
        display: block;
        margin-top: 16px;
        font-size: 14px;
        color: #888;
        text-decoration: none;
    }
    .back-home:hover { color: #0D1F35; }
</style>
@endsection

@section('content')
<section class="success-section">
    <div class="success-card">

        @if(empty($booking) || empty($booking->tour))
            <div class="error-icon">
                <i class="fas fa-times"></i>
            </div>
            <h2>Something Went Wrong</h2>
            <p class="sub">{{ $message ?? 'We could not find your booking. Please try again or contact us.' }}</p>
            <a href="{{ route('tours_list') ?? route('guest.home') }}" class="success-btn">Browse Tours</a>
        @else
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h2>Booking Confirmed!</h2>
            <p class="sub">
                Thank you for booking with us. One of our tour consultants will contact you as soon as possible at
                <a href="mailto:{{ $booking->email }}">{{ $booking->email }}</a>.
            </p>
            <a href="{{ route('tour.booking.view', $booking->id) }}" class="success-btn">View Booking Details</a>
        @endif

        <a href="{{ route('guest.home') }}" class="back-home">← Back to Home</a>
    </div>
</section>
@endsection
