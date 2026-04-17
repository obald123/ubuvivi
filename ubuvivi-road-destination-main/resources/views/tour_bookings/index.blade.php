@extends('layouts.app')
@section('title')
    Tour Bookings
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tour Bookings</h1>
        </div>
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body pt-0 px-0">
                    @include('tour_bookings.table')
                </div>
            </div>
        </div>

    </section>
@endsection
