@extends('layouts.guest')

@section('title')
    {{ $tour->title }} - Ubuvivi
@endsection

@section('meta')
    <meta name="description"
        content="Ubuvivi - offer best {{ $tour->title }}. For booking online visit our website here: ubuvivitours.com call at: +250 789 044 222">
    <meta name="keywords" content="ubuvivi, {{ $tour->title }}, {{ $tour->title }} Rwanda, {{ $tour->title }} booking">
@endsection

@section('content')
    <section class="search_section sec_ptb_100 clearfix" data-bg-color="#161829"
        style="background-color: rgb(22, 24, 41);padding-top: 40px">
    </section>
    <div>
        <img class="w-100" src="{{ $tour->images ? $tour->images[0] : asset('/assets/images/vehicles/not_found.png') }}"
            alt="" style="height: 400px;object-fit: cover;object-position: top;">

        <div class="container px-5 pb-5" style="font-size: 16px">
            <div class="card-body">
                <h1 class="text-primary font-weight-bold mt-3">{{ $tour->title }}</h1>
                <h4 class="text-primary font-weight-600 mt-4">$ {{ $tour->price }} / per person</h4>

                @if ($tour->description)
                    <section class="mb-5 mt-5">
                        <h3 class="font-weight-600 text-primary">Tour Description</h3>
                        <article>
                            {{ $tour->description }}
                        </article>

                    </section>
                @endif

                @if (!empty($tour->highlights))
                    <section class="mb-5">
                        <h3 class="font-weight-600 text-primary">Tour Highlights</h3>
                        <ul>
                            @foreach ($tour->highlights as $highlight)
                                <li>{{ $highlight['title'] }}</li>
                            @endforeach
                        </ul>
                    </section>
                @endif


                @if (!empty($tour->days_description))
                    <section class="pb-5">
                        <h3 class="font-weight-600 text-primary">Tour Agenda</h3>
                        <div class="container px-0">
                            <div class="timeline">
                                @foreach ($tour->days_description as $description)
                                    <div class="timeline-section">
                                        <div class="timeline-date">
                                            Day {{ $loop->iteration }}
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6>{{ $description['title'] }}</h6>
                                                <article>{{ $description['description'] }}</article>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </section>
                @endif

                <div class="row">
                    @if (!empty($tour->inclusions))
                        <div class="col-12 col-md-6">
                            <h3 class="font-weight-600 text-primary">Inclusions</h3>
                            <ul>
                                @foreach ($tour->inclusions as $inclusion)
                                    <li>{{ $inclusion['title'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (!empty($tour->exclusions))
                        <div class="col-12 col-md-6">
                            <h3 class="font-weight-600 text-primary">Exclusions</h3>
                            <ul>
                                @foreach ($tour->exclusions as $exclusion)
                                    <li>{{ $exclusion['title'] }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>


            <div class="d-flex justify-content-end mt-3">
                <a class="custom_btn bg_default_red btn_width text-uppercase"
                    href="{{ route('guest.tours_booking_options') }}">
                    Book Now
                </a>
            </div>
        </div>

    </div>
@endsection

@section('css')
    <style>
        .card-body li {
            list-style-type: square;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #000C21;
            font-family: var(--font-family-sans-serif);
        }

        .font-sserif {
            font-family: var(----font-family-sans-serif)
        }

        .d-flex flex-column li {
            list-style-type: square;
        }

        .timeline {
            margin-top: 20px;
            position: relative;

        }

        .timeline:before {
            position: absolute;
            content: '';
            width: 4px;
            height: calc(100% + 25px);
            background: #6c757d;
            left: 14px;
            top: 5px;
            border-radius: 4px;
        }

        .timeline-section {
            padding-left: 35px;
            display: block;
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-date {
            margin-bottom: 15px;
            padding: 2px 15px;
            background: var(--gray-dark);
            position: relative;
            display: inline-block;
            border-radius: 5px;
            border: 1px solid var(--gray-dark);
            color: #fff;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
        }

        .timeline-section:before {
            content: '';
            position: absolute;
            width: 30px;
            height: 1px;
            background-color: #6c757d;
            top: 12px;
            left: 20px;
        }

        .timeline-section:after {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            background: #6c757d;
            top: 7px;
            left: 11px;
            border: 1px solid #6c757d;
            border-radius: 100%;
        }

        .timeline-section .col-sm-4 {
            margin-bottom: 15px;
        }
    </style>
    <link href="{{ asset('assets/owl-carousel/assets/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/owl-carousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web/js/stisla.js') }}"></script>
    <script src="{{ asset('web/js/scripts.js') }}"></script>
    <script src="{{ mix('assets/js/profile.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                center: true,
                loop: false,
                items: 1,
                nav: true,
                singleItem: true,
                autoHeight: true,
                dotsEach: true,
                dots: true,
            });
        });
    </script>
@endsection
