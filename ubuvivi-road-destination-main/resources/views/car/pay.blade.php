@extends("layouts.guest")
@section('title')
    Car Rental Booking Payment - Ubuvivi Car Rental
@endsection

@section('css')
    <style>
        .input_title {
            font-size: 16px;
        }

    </style>
@endsection

@section('content')
    <section class="search_section sec_ptb_100 clearfix" data-bg-color="#161829"
        style="background-color: rgb(22, 24, 41);padding-top: 40px">
    </section>
    <section class="px-4 py-5 clearfix" style="background-color: rgb(255, 245, 175)">
        @if ($error)
            <div class="container py-5 mb-4">
                <div class="row justify-content-center flex-column align-items-center ">
                    <h3 class="text-center font-primary mb-3">An Error Occured!</h3>
                    <h5 class="text-center mb-5 font-primary font-weight-bold">
                        {{ $message }}
                    </h5>
                </div>
            </div>
        @else
            <div class="container mb-4">
                <div class="row justify-content-center align-items-center flex-column ">
                    <h2 class="text-center font-primary font-weight-bold">Car Booking Payment</h2>
                    <h4 class="font-primary font-weight-bold">{{ $booking->vehicle->brand->name ?? '-' }}
                        {{ $booking->vehicle->model->name ?? '-' }}
                        {{ $booking->vehicle->production_year }}</h4>
                </div>
            </div>
            {!! Form::open(['route' => [$booking_type == 1 ? 'car.booking.pay' : 'car.transfer.pay', $booking->id]]) !!}
            <div class="container">
                <div class="row m-auto" style="max-width: 550px">
                    <!-- Name Field -->
                    <div class="form-group col-sm-12">
                        <h4 class="input_title">Phone number:</h4>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+250</span>
                            </div>
                            {!! Form::tel('phone_number', null, ['class' => 'form-control', 'placeholder' => 'Phone number', 'maxlength' => 9]) !!}
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <h4 class="input_title">Price:</h4>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            {!! Form::number(null, $booking->price, ['class' => 'form-control', 'maxlength' => 255, 'readonly' => true]) !!}
                        </div>
                    </div>
                </div>
                <div class="row m-auto" style="max-width: 550px">
                    <div class="form-group col-12">
                        <div class="row justify-content-end mt-3">
                            <div class="col-auto px-0">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        @endif
    </section>
@endsection
