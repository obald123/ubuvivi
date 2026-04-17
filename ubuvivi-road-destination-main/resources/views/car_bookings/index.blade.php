@extends('layouts.app')
@section('title')
    Car Bookings
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Car Bookings</h1>
        </div>
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body pt-0 px-0">
                    @include('car_bookings.table')
                </div>
            </div>
        </div>

    </section>
@endsection
