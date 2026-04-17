@extends('layouts.app')
@section('title')
    Itineraries
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Itineraries</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('itineraries.create') }}" class="btn btn-primary form-btn">Itinerary <i
                        class="fas fa-plus"></i></a>
            </div>
        </div>
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body pt-0 px-0">
                    @include('itineraries.table')
                </div>
            </div>
        </div>

    </section>
@endsection
