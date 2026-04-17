@extends('layouts.guest')
@section('title')
    Tour Booking - Ubuvivi
@endsection

@section('css')
    <style>
        .input_title {
            font-size: 16px;
        }

        .card-img-top {
            display: none
        }

        h1,
        h3,
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
    <section class="px-4 py-5 clearfix">

        @if (empty($booking) || empty($booking->tour))
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
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-xl-7">
                        @include('itineraries.show_fields')
                    </div>
                    <div class="col-12 col-md-6 col-xl-5">
                        <div class="py-4 px-3">
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
                        <div class="">
                            <div class="row m-auto">
                                <!-- Name Field -->
                                <div class="form-group col-sm-12">
                                    <h4 class="input_title">Full names:</h4>
                                    {!! Form::text('name', $booking->names, ['class' => 'form-control', 'placeholder' => 'Names', 'maxlength' => 255, 'readonly' => true]) !!}
                                </div>

                                <div class="form-group col-sm-12">
                                    <h4 class="input_title">Email Address:</h4>
                                    {!! Form::text('email', $booking->email, ['class' => 'form-control', 'placeholder' => 'Email', 'maxlength' => 255, 'readonly' => true]) !!}
                                </div>

                                <div class="form-group col-sm-12">
                                    <h4 class="input_title">Phone Number:</h4>
                                    {!! Form::tel('phone_number', $booking->phone_number, ['class' => 'form-control', 'placeholder' => 'Email', 'maxlength' => 255, 'readonly' => true]) !!}
                                </div>

                                <div class="form-group col-sm-12">
                                    <h4 class="input_title">Phone Number:</h4>
                                    {!! Form::number('number_of_people', $booking->number_of_people, ['class' => 'form-control', 'placeholder' => 'Email', 'maxlength' => 255, 'readonly' => true]) !!}
                                </div>

                                <div class="form-group col-12">
                                    <h4 class="input_title">Tour Date:</h4>
                                    <div class="position-relative">
                                        {!! Form::date('date', $booking->date, ['class' => 'form-control', 'maxlength' => 255, 'readonly' => true]) !!}
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <h4 class="input_title">Additional Message:</h4>
                                    <div class="position-relative">
                                        {!! Form::textarea('message', $booking->message, ['class' => 'form-control', 'maxlength' => 255, 'rows' => 5, 'readonly' => true]) !!}
                                    </div>
                                </div>
                                {{-- @if ($booking->approved)
                                    <div class="form-group col-12">
                                        <div class="position-relative">
                                            <a href="{{ route('tour.payment.form', $booking->id) }}"
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
