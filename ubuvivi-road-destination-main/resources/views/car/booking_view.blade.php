@extends('layouts.guest')
@section('title')
   {{ $vehicle->brand->name ?? 'Vehicle' }} {{ $vehicle->model->name ?? 'Vehicle' }} | Car Booking - Ubuvivi Car Rental
@endsection

@section('css')
    <style>
        .input_title {
            font-size: 16px;
            color: #ffffff;
        }

        .show_image {
            display: none !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: var(--font-family-sans-serif) !important;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <section class="search_section sec_ptb_100 clearfix" data-bg-color="#161829"
        style="background-color: rgb(22, 24, 41);padding-top: 40px">
    </section>
    <section class="px-4 py-5 clearfix" style="background-color: rgb(255, 245, 175)">
        @if ($error)
            <div class="container mb-5 py-5">
                <div class="row justify-content-center align-items-center flex-column">
                    <h4 class="mb-3 font-primary font-weight-bold">
                        An Error Occured!
                    </h4>

                    <h5 class="font-primary text-danger">
                        {{ $message }}
                    </h5>

                </div>
            </div>
        @else
            <div class="container px-0">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-6 mb-3 py-0">
                        <h3 class="section-title py-2 mb-1">
                            {{ $vehicle->brand->name ?? '' }}
                            {{ $vehicle->model->name ?? '' }}
                            {{ $vehicle->production_year ?? '' }}
                        </h3>
                        <div class="card border-0 shadow-none">
                            <div class="card-body px-0">
                                <div class="owl-carousel owl-theme">
                                    @isset($vehicle->images)
                                        @foreach ($vehicle->images as $image)
                                            <div>
                                                <img class="rounded" style="max-height: 400px;object-fit: cover"
                                                    alt="image" src="{{ $image }}">
                                            </div>
                                        @endforeach
                                    @endisset
                                </div>
                            </div>
                            @if ($vehicle->description)
                                <h4 class="px mt-3">Vehicle Details</h4>
                                <div class="card-body px-0">
                                    {{ $vehicle->description }}
                                </div>
                            @endif
                            <div class="card-body px-0">
                                <div class="row no-gutters">
                                    <div class="col-12 col-xl-2 col-sm-2 col-md-4 border">
                                        <div class="">
                                            <h6 class="bg-primary font-primary text-truncate text-white p-2">Year</h6>
                                            <p class="mb-1 font-15 px-2 font-primary"> {{ $vehicle->production_year }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-2 col-sm-2 col-md-4 border">
                                        <div>
                                            <h6 class="bg-primary font-primary text-truncate text-white p-2">Transmission
                                            </h6>
                                            <p class="mb-1 font-15 px-2 font-primary">
                                                {{ $vehicle->transmission->name ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-2 col-sm-2 col-md-4 border">
                                        <div>
                                            <h6 class="bg-primary font-primary text-truncate text-white p-2">Fuel Type</h6>
                                            <p class="mb-1 font-15 px-2 font-primary">
                                                {{ $vehicle->fuelType->name ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-2 col-sm-2 col-md-4 border">
                                        <div>
                                            <h6 class="bg-primary font-primary text-truncate text-white p-2">Seats</h6>
                                            <p class="mb-1 font-15 px-2 font-primary"> {{ $vehicle->seats ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-2 col-sm-2 col-md-4 border">
                                        <div>
                                            <h6 class="bg-primary font-primary text-truncate text-white p-2">Price / Day
                                            </h6>
                                            <p class="mb-1 font-15 px-2 font-primary"> $ {{ $vehicle->price ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-2 col-sm-2 col-md-4 border">
                                        <div>
                                            <h6 class="bg-primary font-primary text-truncate text-white p-2">Caution</h6>
                                            <p class="mb-1 font-15 px-2 font-primary">
                                                $ {{ $vehicle->one_day_caution ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-5">
                        <div class="py-3 px-3">
                            <div class="row justify-content-start align-items-end flex-column no-gutters">
                                <h3 class="font-primary font-weight-bold text-left ">
                                    Status:
                                    @if (null === $booking->approved)
                                        <span class="text-warning">Booking Pending</span>
                                    @elseif (true === $booking->approved)
                                        <span class="text-success">Booking Approved</span>
                                    @elseif (false === $booking->approved)
                                        <span class="text-danger">Booking Disapproved</span>
                                    @else
                                        <span class="text-danger">Booking Cancelled</span>
                                    @endif
                                </h3>
                            </div>
                        </div>
                        <div class="bg-dark-1 py-4 rounded">
                            <div class="row m-auto" style="max-width:600px">
                                <!-- Name Field -->
                                <div class="form-group col-sm-12">
                                    <h4 class="input_title">Full names:</h4>
                                    {!! Form::text('name', $booking->names, ['class' => 'form-control', 'placeholder' => 'Names', 'readonly' => true]) !!}
                                </div>

                                <div class="form-group col-sm-12">
                                    <h4 class="input_title">Email Address:</h4>
                                    {!! Form::text('email', $booking->email, ['class' => 'form-control', 'placeholder' => 'Email', 'readonly' => true]) !!}
                                </div>

                                <div class="form-group col-sm-12">
                                    <h4 class="input_title">Phone Number:</h4>
                                    {!! Form::tel('phone_number', $booking->phone_number, ['class' => 'form-control', 'placeholder' => 'Email', 'readonly' => true]) !!}
                                </div>

                                <div class="form-group col-sm-12">
                                    <h4 class="input_title">Booking Type:</h4>
                                    {!! Form::text('booking_type', $booking->booking_type == '1' ? 'Self Drive' : 'With Driver', ['class' => 'form-control', 'placeholder' => 'Email', 'readonly' => true]) !!}
                                </div>

                                <div class="form-group col-12">
                                    <h4 class="input_title">Location:</h4>
                                    <div class="position-relative">
                                        {!! Form::text('location', $booking->booking_type == '2' ? $booking->pickup_location : $booking->delivery_location, ['class' => 'form-control', 'placeholder' => 'KK 120 Kigali,Rwanda', 'readonly' => true]) !!}
                                    </div>
                                </div>
                                <div class="form-group col-12 col-sm-8">
                                    <h4 class="input_title">Date:</h4>
                                    <div class="position-relative">
                                        {!! Form::date('date', $booking->booking_type == '2' ? $booking->pickup_date : $booking->delivery_date, ['class' => 'form-control', 'readonly' => true]) !!}
                                    </div>
                                </div>
                                <div class="form-group col-12 col-sm-4">
                                    <h4 class="input_title">Time:</h4>
                                    <div class="position-relative">
                                        {!! Form::time('time', $booking->booking_type == '2' ? $booking->pickup_time : $booking->delivery_time, ['class' => 'form-control', 'readonly' => true]) !!}
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <h4 class="input_title">Number of Days:</h4>
                                    <div class="position-relative">
                                        {!! Form::number('number_of_days', $booking->number_of_days, ['class' => 'form-control', 'readonly' => true]) !!}
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <h4 class="input_title">Additional Message:</h4>
                                    <div class="position-relative">
                                        {!! Form::textarea('message', $booking->message, ['class' => 'form-control', 'rows' => 5, 'readonly' => true]) !!}
                                    </div>
                                </div>
                                {{-- @if ($booking->approved)
                                    <div class="form-group col-12">
                                        <div class="position-relative">
                                            <a href="{{ route($booking->booking_type == 1 ? 'car.booking.payment.form' : 'car.transfer.payment.form', $booking->id) }}"
                                                class="btn btn-primary btn-block font-weight-bold">Pay</a>
                                        </div>
                                    </div>
                                @endif --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                center: true,
                loop: true,
                items: 1,
                nav: false,
                singleItem: true,
                autoHeight: true,
                dotsEach: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
            });

            $('img').on("error", function() {
                this.src = `{{ asset('/assets/images/vehicles/not_found.png') }}`;
                this.style = this.style + "object-fit: contain; background-size: contain;"
            })
        });
    </script>
@endsection
