@extends('layouts.app')
@section('title')
    Car Booking Details
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Car Booking Details</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('carBookings.index') }}" class="btn btn-primary form-btn float-right">Back</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row flex-wrap">
                        @include('car_bookings.show_fields')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
