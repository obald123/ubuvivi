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
        min-height: 320px;
        background: url('{{ asset("assets/images/backgrounds/bg_03.jpg") }}') center center / cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 60px 20px;
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
        padding: 0 16px;
        width: 100%;
        max-width: 720px;
    }
    .legal-hero-content h1 {
        font-size: clamp(26px, 5vw, 52px);
        font-weight: 800;
        color: #fff !important;
        text-shadow: 0 2px 16px rgba(0,0,0,.4);
        margin-bottom: 10px;
        line-height: 1.2;
    }
    .legal-hero-content p {
        font-size: clamp(14px, 2vw, 17px);
        color: rgba(255,255,255,.82);
        max-width: 560px;
        margin: 0 auto;
        line-height: 1.6;
    }
    .legal-section {
        background: #f7f8fb;
        padding: 60px 0 80px;
    }
    .legal-container {
        max-width: 960px;
        margin: 0 auto;
        background: #fff;
        padding: 56px 50px;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(13,31,53,.08);
        overflow-wrap: anywhere;
        word-break: break-word;
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
    .legal-content h1 { font-size: clamp(22px, 3vw, 30px) !important; }
    .legal-content h2 { font-size: clamp(17px, 2.5vw, 22px) !important; margin-top: 28px; }
    .legal-content h3 { font-size: clamp(15px, 2vw, 18px) !important; margin-top: 20px; }
    .legal-content p,
    .legal-content li,
    .legal-content span,
    .legal-content div {
        line-height: 1.8;
    }
    .legal-content table {
        width: 100% !important;
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin-bottom: 24px;
    }
    .legal-content table td,
    .legal-content table th {
        min-width: 100px;
    }
    .legal-content section[data-custom-class] {
        width: 100% !important;
        max-width: 100%;
        overflow-x: auto;
        box-sizing: border-box;
    }

    /* ── Tablet landscape ── */
    @media (max-width: 1024px) {
        .legal-container { padding: 48px 40px; }
    }

    /* ── Tablet portrait ── */
    @media (max-width: 768px) {
        .legal-hero { min-height: 260px; padding: 50px 16px; }
        .legal-section { padding: 40px 0 60px; }
        .legal-container {
            padding: 32px 24px;
            border-radius: 12px;
        }
    }

    /* ── Large phones ── */
    @media (max-width: 576px) {
        .legal-hero { min-height: 220px; padding: 40px 14px; }
        .legal-section { padding: 28px 0 48px; }
        .legal-container {
            padding: 24px 16px;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(13,31,53,.06);
        }
        .legal-content h1 { font-size: 20px !important; }
        .legal-content h2 { font-size: 16px !important; margin-top: 22px; }
        .legal-content h3 { font-size: 14px !important; margin-top: 16px; }
        .legal-content p,
        .legal-content li,
        .legal-content span,
        .legal-content div { font-size: 13px; line-height: 1.75; }
    }

    /* ── Small phones ── */
    @media (max-width: 400px) {
        .legal-container { padding: 18px 12px; }
        .legal-content table td,
        .legal-content table th { min-width: 80px; font-size: 11px; }
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
