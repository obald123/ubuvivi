@extends('layouts.guest')
@section('title')
    {{ $booking->names }} - Hotel Booking - Ubuvivi Tours
@endsection

@section('css')
    <style>
        .input_title {
            font-size: 16px;
            color: #ffffff;
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
        <div class="container px-0">
            <div class="row justify-content-between">
                <div class="col-12 col-md-6 mb-3 py-0">
                    <h3 class="section-title py-2 mb-1">
                        Hotel Booking Details
                    </h3>
                    <div class="card border-0 shadow-none">
                        <div class="card-body px-0">
                            <div class="row no-gutters">
                                @if($booking->hotel && $booking->hotel->name)
                                    <div class="col-12 border-bottom py-3">
                                        <h6 class="bg-primary font-primary text-white p-2 mb-2">Hotel Name</h6>
                                        <p class="mb-1 font-15 px-2 font-primary">
                                            {{ $booking->hotel->name ?? 'N/A' }}
                                        </p>
                                    </div>
                                @endif
                                <div class="col-12 border-bottom py-3">
                                    <h6 class="bg-primary font-primary text-white p-2 mb-2">Check-in Date</h6>
                                    <p class="mb-1 font-15 px-2 font-primary">
                                        {{ $booking->check_in?->format('M d, Y') ?? 'N/A' }}
                                    </p>
                                </div>
                                <div class="col-12 border-bottom py-3">
                                    <h6 class="bg-primary font-primary text-white p-2 mb-2">Check-out Date</h6>
                                    <p class="mb-1 font-15 px-2 font-primary">
                                        {{ $booking->check_out?->format('M d, Y') ?? 'N/A' }}
                                    </p>
                                </div>
                                <div class="col-12 border-bottom py-3">
                                    <h6 class="bg-primary font-primary text-white p-2 mb-2">Number of Guests</h6>
                                    <p class="mb-1 font-15 px-2 font-primary">
                                        {{ $booking->number_of_guests ?? 'N/A' }}
                                    </p>
                                </div>
                                @if($booking->room_type)
                                    <div class="col-12 border-bottom py-3">
                                        <h6 class="bg-primary font-primary text-white p-2 mb-2">Room Type</h6>
                                        <p class="mb-1 font-15 px-2 font-primary">
                                            {{ $booking->room_type }}
                                        </p>
                                    </div>
                                @endif
                                @if($booking->message)
                                    <div class="col-12 py-3">
                                        <h6 class="bg-primary font-primary text-white p-2 mb-2">Special Requests</h6>
                                        <p class="mb-1 font-15 px-2 font-primary">
                                            {{ $booking->message }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-5">
                    <div class="py-3 px-3">
                        <div class="row justify-content-start align-items-end flex-column no-gutters">
                            <h3 class="font-primary font-weight-bold text-left">
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
                            <div class="form-group col-sm-12">
                                <h4 class="input_title">Full Names:</h4>
                                {!! Form::text('names', $booking->names, ['class' => 'form-control', 'placeholder' => 'Names', 'readonly' => true]) !!}
                            </div>

                            <div class="form-group col-sm-12">
                                <h4 class="input_title">Email Address:</h4>
                                {!! Form::text('email', $booking->email, ['class' => 'form-control', 'placeholder' => 'Email', 'readonly' => true]) !!}
                            </div>

                            <div class="form-group col-sm-12">
                                <h4 class="input_title">Phone Number:</h4>
                                {!! Form::tel('phone_number', $booking->phone_number, ['class' => 'form-control', 'placeholder' => 'Phone', 'readonly' => true]) !!}
                            </div>

                            <div class="form-group col-12">
                                <h4 class="input_title">Booking Reference:</h4>
                                <div class="position-relative">
                                    {!! Form::text('reference', $booking->id, ['class' => 'form-control', 'readonly' => true]) !!}
                                </div>
                            </div>

                            @php
                                $checkInDate = $booking->check_in instanceof \Carbon\Carbon ? $booking->check_in : \Carbon\Carbon::parse($booking->check_in);
                                $checkOutDate = $booking->check_out instanceof \Carbon\Carbon ? $booking->check_out : \Carbon\Carbon::parse($booking->check_out);
                                $nights = $checkOutDate->diffInDays($checkInDate);
                            @endphp
                            <div class="form-group col-12">
                                <h4 class="input_title">Number of Nights:</h4>
                                <div class="position-relative">
                                    {!! Form::text('nights', $nights, ['class' => 'form-control', 'readonly' => true]) !!}
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <h4 class="input_title">Booking Date:</h4>
                                <div class="position-relative">
                                    {!! Form::text('created_at', $booking->created_at?->format('M d, Y H:i A'), ['class' => 'form-control', 'readonly' => true]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
