@extends('layouts.app')
@section('title')
    Tour Booking Details
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tour Booking Details</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('tourBookings.index') }}" class="btn btn-primary form-btn float-right">Back</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @include('tour_bookings.show_fields')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
