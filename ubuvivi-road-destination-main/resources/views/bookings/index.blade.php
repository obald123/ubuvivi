@extends('layouts.app')
@section('title')
    Bookings
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Bookings</h1>
        </div>
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('bookings.table')
                </div>
            </div>
        </div>

    </section>
@endsection
