@extends('layouts.guest')

@section('title')
    {{ $tour->title }} - Ubuvivi Tours
@endsection

@section('body-class', 'hero-page')

@php
    // Safely handle images - they're auto-cast to array by Eloquent
    $images = $tour->images ?? [];
    if (is_string($images)) {
        $images = json_decode($images, true) ?? [];
    }
    $galleryImages = is_array($images) ? array_values(array_filter($images)) : [];
    $heroImage = (!empty($galleryImages) && !empty($galleryImages[0]))
        ? $galleryImages[0]
        : asset('assets/images/backgrounds/bg_11.jpg');
    $sectionImages = count($galleryImages) > 1 ? array_slice($galleryImages, 1) : [];
    $bookingLink = route('guest.tours_booking_options', ['tour' => $tour->id]);

    // Model auto-decodes JSON via accessors, so just extract titles
    $inclusionItems = collect($tour->inclusions ?? [])->pluck('title')->filter()->values();
    $exclusionItems = collect($tour->exclusions ?? [])->pluck('title')->filter()->values();
    $highlightItems = collect($tour->highlights ?? [])->pluck('title')->filter()->values();
    $agendaItems = collect($tour->days_description ?? [])
        ->filter(function ($item) {
            return !empty($item['title']) || !empty($item['description']);
        })
        ->values();
@endphp

@section('meta')
    <meta name="description" content="Ubuvivi offers {{ $tour->title }} bookings in Rwanda. Book online or contact us for custom planning.">
    <meta name="keywords" content="ubuvivi, {{ $tour->title }}, Rwanda tours, {{ $tour->title }} booking">
@endsection

@section('css')
<style>
    .tour-detail-hero {
        position: relative;
        min-height: 520px;
        background-image: url('{{ htmlspecialchars($heroImage ?? '', ENT_QUOTES, 'UTF-8') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: flex-end;
    }

    .tour-detail-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(7, 23, 33, .22) 0%, rgba(7, 23, 33, .18) 40%, rgba(7, 23, 33, .58) 100%);
    }

    .tour-detail-hero::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: -1px;
        height: 18px;
        background:
            radial-gradient(circle at 10px -4px, transparent 12px, #fff 13px) repeat-x;
        background-size: 20px 20px;
    }

    .tour-detail-caption {
        position: relative;
        z-index: 2;
        padding: 0 0 56px;
        color: #fff;
    }

    .tour-detail-caption h1 {
        margin: 0 0 8px;
        color: #fff;
        font-size: clamp(36px, 6vw, 56px);
        line-height: 1.05;
        text-shadow: 0 3px 18px rgba(0, 0, 0, .28);
    }

    .tour-detail-price {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: rgba(255,255,255,.96);
        font-size: 20px;
        font-weight: 600;
    }

    .tour-detail-price::after {
        content: '';
        width: 1px;
        height: 58px;
        background: rgba(255,255,255,.75);
        margin-left: 10px;
    }

    .tour-detail-main {
        background: #fff;
        padding: 26px 0 58px;
    }

    .tour-detail-wrap {
        width: 100%;
        max-width: 940px;
        margin: 0 auto;
        color: #1f2937;
    }

    .tour-detail-intro {
        font-size: 17px;
        line-height: 1.65;
        color: #1f2937;
    }

    .tour-detail-intro p {
        margin: 0 0 12px;
    }

    .tour-detail-label {
        display: block;
        margin: 20px 0 4px;
        color: #171f2a;
        font-size: 16px;
        font-weight: 700;
        font-family: 'Poppins', sans-serif !important;
    }

    .tour-detail-copy {
        color: #1f2937;
        font-size: 17px;
        line-height: 1.65;
    }

    .tour-booking-cta {
        display: flex;
        justify-content: center;
        margin: 26px 0 10px;
    }

    .tour-booking-btn {
        border: 0;
        background: #ff6124;
        color: #fff;
        min-width: 190px;
        height: 46px;
        padding: 0 28px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        transition: background .18s ease, transform .18s ease;
    }

    .tour-booking-btn:hover {
        background: #e35620;
        color: #fff;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .tour-booking-note {
        margin: 0 0 28px;
        color: #667085;
        font-size: 14px;
        text-align: center;
    }

    .tour-stop {
        margin-top: 26px;
    }

    .tour-stop h2 {
        margin: 0 0 10px;
        color: #171f2a;
        font-size: clamp(28px, 4vw, 38px);
        line-height: 1.15;
    }

    .tour-stop p {
        margin: 0 0 16px;
        color: #1f2937;
        font-size: 17px;
        line-height: 1.65;
    }

    .tour-stop-image {
        width: 100%;
        border-radius: 0;
        display: block;
        object-fit: cover;
        max-height: 420px;
    }

    .tour-fallback-panel {
        margin-top: 26px;
    }

    .tour-fallback-panel h2 {
        margin: 0 0 12px;
        color: #171f2a;
        font-size: clamp(28px, 4vw, 38px);
        line-height: 1.15;
    }

    .tour-fallback-list {
        margin: 0;
        padding-left: 22px;
        color: #1f2937;
        font-size: 17px;
        line-height: 1.7;
    }

    .tour-fallback-list li {
        margin-bottom: 8px;
    }

    @media (max-width: 991px) {
        .tour-detail-hero {
            min-height: 460px;
        }

        .tour-detail-caption {
            padding-bottom: 40px;
        }

        .tour-detail-price {
            font-size: 18px;
        }

        .tour-detail-price::after {
            height: 46px;
        }
    }

    @media (max-width: 767px) {
        .tour-detail-hero {
            min-height: 360px;
        }

        .tour-detail-caption {
            padding-bottom: 28px;
        }

        .tour-detail-caption h1 {
            font-size: 40px;
        }

        .tour-detail-price {
            font-size: 16px;
        }

        .tour-detail-price::after {
            height: 34px;
        }

        .tour-detail-main {
            padding: 22px 0 42px;
        }

        .tour-detail-intro,
        .tour-detail-copy,
        .tour-stop p,
        .tour-fallback-list {
            font-size: 16px;
        }

        .tour-stop h2,
        .tour-fallback-panel h2 {
            font-size: 30px;
        }
    }
</style>
@endsection

@section('content')
    <section class="tour-detail-hero">
        <div class="container">
            <div class="tour-detail-caption">
                <h1>{{ $tour->title }}</h1>
                @if(!empty($tour->price) && $tour->price > 0)
                    <div class="tour-detail-price">${{ number_format($tour->price) }} / person</div>
                @endif
            </div>
        </div>
    </section>

    <section class="tour-detail-main">
        <div class="container">
            <div class="tour-detail-wrap">
                <div class="tour-detail-intro">
                    @if(!empty($tour->description))
                        <p>{!! nl2br(e($tour->description)) !!}</p>
                    @endif

                    @if($inclusionItems->isNotEmpty())
                        <span class="tour-detail-label">Includes:</span>
                        <div class="tour-detail-copy">{{ $inclusionItems->implode(', ') }}</div>
                    @endif

                    @if($exclusionItems->isNotEmpty())
                        <span class="tour-detail-label">Excludes:</span>
                        <div class="tour-detail-copy">{{ $exclusionItems->implode(', ') }}</div>
                    @endif
                </div>

                <div class="tour-booking-cta">
                    <a href="{{ $bookingLink }}" class="tour-booking-btn">Book Now</a>
                </div>
                <p class="tour-booking-note">Choose your booking option on the next step and continue as guest or with an account.</p>

                @if($agendaItems->isNotEmpty())
                    @foreach($agendaItems as $index => $agendaItem)
                        @php
                            $sectionImage = $sectionImages[$index] ?? null;
                        @endphp

                        <article class="tour-stop">
                            @if(!empty($agendaItem['title']))
                                <h2>{{ $agendaItem['title'] }}</h2>
                            @endif

                            @if(!empty($agendaItem['description']))
                                <p>{!! nl2br(e($agendaItem['description'])) !!}</p>
                            @endif

                            @if($sectionImage)
                                <img src="{{ $sectionImage }}" alt="{{ $agendaItem['title'] ?? $tour->title }}" class="tour-stop-image">
                            @endif
                        </article>
                    @endforeach
                @elseif($highlightItems->isNotEmpty())
                    <section class="tour-fallback-panel">
                        <h2>Tour Highlights</h2>
                        <ul class="tour-fallback-list">
                            @foreach($highlightItems as $highlight)
                                <li>{{ $highlight }}</li>
                            @endforeach
                        </ul>
                    </section>
                @endif

                @if($sectionImages && $agendaItems->isEmpty())
                    @foreach($sectionImages as $extraImage)
                        <article class="tour-stop">
                            <img src="{{ $extraImage }}" alt="{{ $tour->title }}" class="tour-stop-image">
                        </article>
                    @endforeach
                @endif

                <div class="tour-booking-cta" style="margin-top: 38px;">
                    <a href="{{ $bookingLink }}" class="tour-booking-btn">Book Now</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    Array.from(document.querySelectorAll('.tour-stop-image')).forEach(function (image) {
        image.addEventListener('error', function () {
            image.src = '{{ asset('assets/images/vehicles/not_found.png') }}';
        });
    });
});
</script>
@endsection
