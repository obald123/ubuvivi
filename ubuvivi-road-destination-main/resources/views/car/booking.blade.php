@extends('layouts.guest')
@section('title')
 {{ $vehicle->brand->name ?? 'Vehicle' }} {{ $vehicle->model->name ?? 'Vehicle' }} | Car Booking - Ubuvivi Car Rental
@endsection

@section('css')
    <style>
        .input_title text-white {
            font-size: 16px;
        }
    </style>
@endsection

@section('content')
    <section class="search_section sec_ptb_100 clearfix" data-bg-color="#161829"
        style="background-color: rgb(22, 24, 41);padding-top: 40px">
    </section>
    <section class="px-4 py-5 clearfix" style="background-color: rgb(255, 245, 175)">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 show_image mb-3 py-0">
                    <h3 class="section-title mt-1 mb-4">
                        {{ $vehicle->brand->name ?? '' }}
                        {{ $vehicle->model->name ?? '' }}
                        {{ $vehicle->production_year ?? '' }}
                    </h3>
                    <div class="d-flex flex-column border-0 shadow-none">
                        <div class="card-body p-0">
                            <div class="owl-carousel owl-theme">
                                @isset($vehicle->images)
                                    @foreach ($vehicle->images as $image)
                                        <div>
                                            <img class="rounded" style="max-height: 400px;object-fit: cover" alt="image"
                                                src="{{ $image }}">
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                        <h4 class="px mt-3">Vehicle Details</h4>
                        <div class="card-body px-0">
                            <div class="row no-gutters">
                                <div class="col-12 bg-light col-xl-2 col-sm-2 col-md-4 border">
                                    <div class="">
                                        <h6 class="bg-primary font-primary text-truncate text-white p-2">Year</h6>
                                        <p class="mb-1 font-15 px-2 font-primary"> {{ $vehicle->production_year }}</p>
                                    </div>
                                </div>
                                <div class="col-12 bg-light col-xl-2 col-sm-2 col-md-4 border">
                                    <div>
                                        <h6 class="bg-primary font-primary text-truncate text-white p-2">Transmission</h6>
                                        <p class="mb-1 font-15 px-2 font-primary">
                                            {{ $vehicle->transmission->name ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-12 bg-light col-xl-2 col-sm-2 col-md-4 border">
                                    <div>
                                        <h6 class="bg-primary font-primary text-truncate text-white p-2">Fuel Type</h6>
                                        <p class="mb-1 font-15 px-2 font-primary"> {{ $vehicle->fuelType->name ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 bg-light col-xl-2 col-sm-2 col-md-4 border">
                                    <div>
                                        <h6 class="bg-primary font-primary text-truncate text-white p-2">Seats</h6>
                                        <p class="mb-1 font-15 px-2 font-primary"> {{ $vehicle->seats ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-12 bg-light col-xl-2 col-sm-2 col-md-4 border">
                                    <div>
                                        <h6 class="bg-primary font-primary text-truncate text-white p-2">Price / Day</h6>
                                        <p class="mb-1 font-15 px-2 font-primary">$ {{ $vehicle->price ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-12 bg-light col-xl-2 col-sm-2 col-md-4 border">
                                    <div>
                                        <h6 class="bg-primary font-primary text-truncate text-white p-2">Caution</h6>
                                        <p class="mb-1 font-15 px-2 font-primary">
                                            $ {{ $vehicle->one_day_caution ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($vehicle->description)
                            <div>
                                <div class="card">
                                    <div class="card-body">
                                        <pre class="font-primary mb-0">{{ $vehicle->description }}</pre>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col mb-3 mt-0 pt-2 mt-md-5">
                    <div class="d-flex flex-column border-0 shadow-none">
                        @if (!empty($errors))
                            @if ($errors->any())
                                <ul class="alert bg-danger text-white font-15" style="list-style-type: none">
                                    @foreach ($errors->all() as $error)
                                        <li>{!! $error !!}</li>
                                    @endforeach
                                </ul>
                            @endif
                        @endif
                        @include('flash::message')
                        <div class="card-body bg-dark-1  border rounded-lg">
                            <h4 class="mb-4 text-center text-white font-weight-bold">Book This Car</h4>
                            {!! Form::open(['route' => ['car.book', $vehicle->id]]) !!}
                            <div>
                                <div class="row m-auto" style="max-width: 550px">
                                    <!-- Name Field -->
                                    <div class="form-group col-sm-12">
                                        <h4 class="input_title text-white">Full names:</h4>
                                        {!! Form::text('name', isset($name) ? $name : null, ['class' => 'form-control', 'required' => true, 'maxlength' => 255]) !!}
                                    </div>

                                    <!-- Email Field -->
                                    <div class="form-group col-sm-12">
                                        <h4 class="input_title text-white">Email:</h4>
                                        {!! Form::email('email', isset($email) ? $email : null, ['class' => 'form-control', 'required' => true, 'maxlength' => 255]) !!}
                                    </div>

                                    <!-- Phone Number Field -->
                                    <div class="form-group col-sm-12">
                                        <h4 class="input_title text-white">Phone Number:</h4>
                                        {!! Form::tel('phone_number', isset($phone_number) ? $phone_number : null, ['class' => 'form-control', 'required' => true, 'maxlength' => 13]) !!}
                                    </div>
                                    <div class="form-group col-12">
                                        <h4 class="input_title text-white">Booking Option:</h4>
                                        <div class="d-flex flex-column">
                                            {!! Form::select('booking_type', ['1' => 'Self Drive', '2' => 'With a driver'], isset($booking_type) ? $booking_type : null, ['id' => 'booking_type', 'class' => 'form-control pt-0', 'required' => true]) !!}
                                            <div class="text-white font-15 mt-2" id="booking-message">
                                                Self drive starting from 3 days
                                            </div>
                                            <div class="text-white font-15 mt-2" id="transfer-message"
                                                style="display: none">
                                                Fuel exclusive
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-auto" style="max-width: 550px">
                                    <div class="form-group col-12">
                                        <h4 class="input_title text-white">Location:</h4>
                                        <div class="position-relative">
                                            {!! Form::text('location', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
                                        </div>
                                    </div>

                                    <div class="form-group col-12" id="destination">
                                        <h4 class="input_title text-white">Destination:</h4>
                                        <div class="position-relative">
                                            {!! Form::text('destination', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
                                        </div>
                                    </div>

                                    <div class="form-group col-12 col-sm-8">
                                        <h4 class="input_title text-white">Date:</h4>
                                        <div class="position-relative">
                                            {!! Form::date('date', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-sm-4">
                                        <h4 class="input_title text-white">Time:</h4>
                                        <div class="position-relative">
                                            {!! Form::time('time', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <h4 class="input_title text-white">Number of Days:</h4>
                                        <div class="position-relative">
                                            {!! Form::number('number_of_days', null, ['id' => 'number_of_days', 'class' => 'form-control', 'maxlength' => 3]) !!}
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <h4 class="input_title text-white">Additional Message:</h4>
                                        <div class="position-relative">
                                            {!! Form::textarea('message', null, ['class' => 'form-control', 'rows' => 5, 'maxlength' => 255]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-auto" style="max-width: 550px">
                                    <div class="form-group col-12">
                                        <div class="row justify-content-end mt-3">
                                            <div class="col-auto px-0">
                                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-primary">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>
@endsection

@section('scripts')
    <script>
        $('img').on("error", function() {
            this.src = `{{ asset('/assets/images/vehicles/not_found.png') }}`;
            this.style = "object-fit: contain;object-position: center;"
            this.classList.add("border-bottom");
        })
    </script>
    <script>
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                center: true,
                loop: true,
                items: 1,
                nav: false,
                singleItem: true,
                dotsEach: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
            });

            if ($("#booking_type").val() == 2) {
                $("#destination").show();
                $("booking-message").hide();
                $("transfer-message").show();
                $("#number_of_days").attr('min', 1);
            } else {
                $("#destination").hide();
                $("booking-message").show()
                $("transfer-message").hide()
                $("#number_of_days").attr('min', 3);
            }

            $("#booking_type").on('change', function() {
                if (this.value == 1) {
                    $('#destination').hide();
                    $("#booking-message").show()
                    $("#transfer-message").hide()
                    $("#number_of_days").attr('min', 3);
                } else if (this.value == 2) {
                    $('#destination').show();
                    $("#booking-message").hide()
                    $("#transfer-message").show()
                    $("#number_of_days").attr('min', 1);
                }
            })

        });
    </script>
@endsection
