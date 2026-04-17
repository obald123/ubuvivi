@extends('layouts.app')
@section('title')
    Edit Tour Booking
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-0 text-white">Approve Tour Booking</h3>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                <a href="{{ route('tourBookings.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            @include('flash::message')
            <div class="section-body">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="card shadow" style="max-width: 500px">
                            <div class="card-body ">
                                {!! Form::model($tourBooking, ['route' => ['tourBookings.update', $tourBooking->id], 'method' => 'patch']) !!}
                                <div class="row">
                                    @include('tour_bookings.fields')
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
