@extends('layouts.guest')

@section('title')
    {{ $vehicle->brand->name ?? '' }} {{ $vehicle->model->name ?? 'Vehicle' }} - Ubuvivi Car Rental
@endsection

@section('meta')
    <meta name="description"
        content="Providing hassle-free Rwanda airport transfers services seven days a week, Our services are 24/7 so any time you get to the airport">
    <meta name="keywords" content="ubuvivi, Rwanda Airport Transfers, Airport Transfer Services Rwanda, Airport Car Services Rwanda, {{ $vehicle->brand->name ?? '' }}, {{ $vehicle->model->name ?? '' }}">
@endsection

@section('content')
    <section class="search_section sec_ptb_100 clearfix" data-bg-color="#161829"
        style="background-color: rgb(22, 24, 41);padding-top: 40px">
    </section>
    <div class="section-body clearfix py-5" style="background-color: rgb(255, 245, 175)">
        <div class="container">
            <h3 class="section-title font-sserif mb-3 mt-1">{{ $vehicle->brand->name ?? '' }}
                {{ $vehicle->model->name ?? '' }}
                {{ $vehicle->production_year }}</h3>

            <div class="row">
                <div class="col-12 col-sm-6 col-lg-6 mb-4">
                    <div class="d-flex flex-column h-100 my-0 border shadow-sm">
                        <div class="card-body">
                            <div class="owl-carousel owl-theme">
                                @php
                                    $vImages = is_array($vehicle->images) ? $vehicle->images : (is_string($vehicle->images) ? json_decode($vehicle->images, true) : []);
                                @endphp
                                @if(count($vImages))
                                    @foreach ($vImages as $image)
                                        <div class="item">
                                            <img alt="image" src="{{ $image }}">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="item">
                                        <img alt="image" src="{{ asset('assets/images/vehicles/not_found.png') }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-6 mb-4">
                    <div class="d-flex flex-column h-100 my-0 border shadow-sm">
                        <div class="card-header border-bottom mb-3 py-3">
                            <h4 class="font-sserif">Details</h4>
                        </div>
                        <div class="card-body py-0">
                            <h6 class="font-sserif mb-3">Car Brand: <span
                                    class="font-weight-normal">{{ $vehicle->brand->name ?? 'N/A' }}</span></h6>
                            <h6 class="font-sserif mb-3">Car Model: <span
                                    class="font-weight-normal">{{ $vehicle->model->name ?? 'N/A' }}</span></h6>
                            <h6 class="font-sserif mb-3">Production Year: <span
                                    class="font-weight-normal">{{ $vehicle->production_year }}</span></h6>
                            <h6 class="font-sserif mb-3">Number of seats: <span
                                    class="font-weight-normal">{{ $vehicle->seats }}</span></h6>
                            <h6 class="font-sserif mb-3">Transmission: <span
                                    class="font-weight-normal">{{ $vehicle->transmission->name ?? 'N/A' }}</span></h6>
                            <h6 class="font-sserif mb-3">Fuel type: <span
                                    class="font-weight-normal">{{ $vehicle->fuelType->name ?? 'N/A' }}</span></h6>
                            <h6 class="font-sserif mb-3">One Day Caution: <span class="font-weight-normal">$
                                    {{ $vehicle->one_day_caution }}</span></h6>
                            <h6 class="font-sserif mb-3">More than one Day Caution: <span class="font-weight-normal">$
                                    {{ $vehicle->other_caution }}</span></h6>
                        </div>
                    </div>
                </div>
                @if ($vehicle->description)
                    <div class="col-12">
                        <div class="d-flex flex-column border shadow-sm">
                            <div class="card-header border-bottom mb-3 py-3">
                                <h4 class="font-sserif">Description</h4>
                            </div>
                            <div class="card-body">
                                {{ $vehicle->description }}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-12">
                    <div class="abtn_wrap clearfix text-right" data-aos="fade-up" data-aos-delay="100">
                        <a class="custom_btn bg_default_red btn_width text-uppercase"
                            href="{{ route('car.booking', $vehicle->id) }}">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .font-sserif {
            font-family: var(----font-family-sans-serif)
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
                loop: true,
                items: 1,
                nav: false,
                dots: true,
                singleItem: true,
                autoHeight: true,
            });
        });
    </script>
@endsection
