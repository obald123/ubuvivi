@extends('layouts.guest')

@section('title')
    Request Submitted - Ubuvivi
@endsection

@section('css')
<style>
    .bc-section {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 80px 20px;
        background: #f7f8fb;
    }
    .bc-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 40px rgba(13,31,53,.10);
        padding: 56px 48px;
        max-width: 560px;
        width: 100%;
        text-align: center;
    }
    .bc-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(34,197,94,.12);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
    }
    .bc-icon i { font-size: 38px; color: #22c55e; }
    .bc-card h2 {
        font-size: 28px;
        font-weight: 800;
        color: #0D1F35;
        margin-bottom: 10px;
    }
    .bc-service-tag {
        display: inline-block;
        background: rgba(200,90,42,.1);
        color: #C85A2A;
        font-size: 13px;
        font-weight: 600;
        padding: 4px 14px;
        border-radius: 50px;
        margin-bottom: 18px;
    }
    .bc-card .sub {
        font-size: 15px;
        color: #555;
        line-height: 1.75;
        margin-bottom: 32px;
    }
    .bc-card .sub strong { color: #0D1F35; }
    .bc-btn {
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
    .bc-btn:hover { background: #a84520; color: #fff; text-decoration: none; }
    .bc-back {
        display: block;
        margin-top: 16px;
        font-size: 14px;
        color: #888;
        text-decoration: none;
    }
    .bc-back:hover { color: #0D1F35; }

    @media (max-width: 576px) {
        .bc-card { padding: 36px 22px 40px; }
        .bc-card h2 { font-size: 22px; }
    }
</style>
@endsection

@section('content')
<section class="bc-section">
    <div class="bc-card">
        <div class="bc-icon">
            <i class="fas fa-check"></i>
        </div>

        @if(!empty($service))
            <div class="bc-service-tag">{{ $service }}</div>
        @endif

        <h2>Request Submitted!</h2>

        <p class="sub">
            Thank you{{ !empty($names) ? ', <strong>' . e($names) . '</strong>' : '' }}!
            Your booking request has been received. Our team will contact you shortly
            @if(!empty($email))
                at <strong>{{ e($email) }}</strong>
            @endif
            to confirm availability and pricing.
        </p>

        <a href="{{ route('guest.all_services') }}" class="bc-btn">Explore More Services</a>
        <a href="{{ route('guest.home') }}" class="bc-back">← Back to Home</a>
    </div>
</section>
@endsection
