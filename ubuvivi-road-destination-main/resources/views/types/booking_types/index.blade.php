@extends('layouts.app')
@section('title')
    Booking Types
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Booking Types</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('types.bookingTypes.create') }}" class="btn btn-primary form-btn">Booking Type <i
                        class="fas fa-plus"></i></a>
            </div>
        </div>
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body pt-0 px-0">
                    @include('types.booking_types.table')
                </div>
            </div>
        </div>

    </section>
@endsection
