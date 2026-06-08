@extends('layouts.guest')

@section('title')
    Terms & Conditions - Ubuvivi Tours & Safaris
@endsection

@section('meta')
    <meta name="description" content="Terms, conditions, and cookie policy for Ubuvivi Tours & Safaris.">
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
        max-width: 620px;
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
    .terms-images {
        display: grid;
        gap: 18px;
    }
    .terms-image {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        background: #fff;
    }
    .legal-divider {
        margin: 48px 0;
        border: 0;
        border-top: 1px solid #e5e7eb;
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
    .missing-terms {
        padding: 18px;
        border-radius: 10px;
        background: #fff7ed;
        color: #9a3412;
        font-size: 14px;
        line-height: 1.7;
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
            <h1>Terms &amp; Conditions</h1>
            <p>Please read these terms and our cookie policy before using our services.</p>
        </div>
    </section>

    <section class="legal-section">
        <div class="container">
            <div class="legal-container">
                @if($termsImages->isNotEmpty())
                    <div class="terms-images">
                        @foreach($termsImages as $index => $image)
                            <img
                                src="{{ asset($image) }}"
                                alt="Terms and conditions page {{ $index + 1 }}"
                                class="terms-image"
                                loading="lazy">
                        @endforeach
                    </div>
                @else
                    <div class="missing-terms">
                        Terms and conditions images were not found. Add images 1 to 15 to
                        <strong>public/assets/images/terms-and-condition</strong> and this page will display them automatically.
                    </div>
                @endif

                <hr class="legal-divider">

                <div class="legal-content">
                    {!! $cookieContent ?: '<p>Cookie policy content is currently unavailable.</p>' !!}
                </div>
            </div>
        </div>
    </section>
@endsection
