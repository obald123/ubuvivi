@extends('layouts.guest')

@section('title')
    Privacy Policy - Ubuvivi Tours & Safaris
@endsection

@section('meta')
    <meta name="description" content="Privacy Policy for Ubuvivi Tours & Safaris. Learn how we collect, use, and protect your personal information.">
@endsection

@section('body-class', 'hero-page')

@section('css')
<style>
    .legal-hero {
        position: relative;
        height: 380px;
        background: url('{{ asset("assets/images/backgrounds/bg_03.jpg") }}') center center / cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .legal-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(13, 31, 53, 0.70);
    }
    .legal-hero-content {
        position: relative;
        z-index: 2;
        color: #fff;
        padding: 0 18px;
    }
    .legal-hero-content h1 {
        font-size: clamp(30px, 5vw, 56px);
        font-weight: 800;
        color: #fff !important;
        text-shadow: 0 2px 16px rgba(0,0,0,.4);
        margin-bottom: 12px;
    }
    .legal-hero-content p {
        font-size: 17px;
        color: rgba(255,255,255,.82);
        max-width: 560px;
        margin: 0 auto;
    }
    .legal-section {
        background: #f7f8fb;
        padding: 80px 0 100px;
    }
    .legal-container {
        max-width: 960px;
        margin: 0 auto;
        background: #fff;
        padding: 56px 50px;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(13,31,53,.08);
        overflow-wrap: anywhere;
    }
    .legal-content,
    .legal-content [data-custom-class='body'],
    .legal-content [data-custom-class='body'] * {
        font-family: 'Poppins', sans-serif !important;
    }
    .legal-content h1,
    .legal-content h2,
    .legal-content h3 {
        color: #172033 !important;
        line-height: 1.35;
    }
    .legal-content h1 {
        font-size: 30px !important;
    }
    .legal-content h2 {
        font-size: 22px !important;
        margin-top: 30px;
    }
    .legal-content h3 {
        font-size: 18px !important;
        margin-top: 22px;
    }
    .legal-content p,
    .legal-content li,
    .legal-content span,
    .legal-content div {
        line-height: 1.8;
    }
    .legal-content table {
        width: 100%;
    }
    @media (max-width: 768px) {
        .legal-container {
            padding: 36px 22px;
        }
    }
</style>
@endsection

@section('content')
    <section class="legal-hero">
        <div class="legal-hero-content">
            <h1>Privacy Policy</h1>
            <p>How Ubuvivi Tours &amp; Travel handles your personal information.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="container">
            <div class="legal-container">
                <div class="legal-content">
                    {!! $privacyContent ?: '<p>Privacy policy content is currently unavailable.</p>' !!}
                </div>
            </div>
        </div>
    </section>
@endsection
