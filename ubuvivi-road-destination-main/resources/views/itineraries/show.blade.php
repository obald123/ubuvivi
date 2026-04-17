@extends('layouts.app')
@section('title')
    Itinerary Details 
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
        <h1>Itinerary Details</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('itineraries.index') }}"
                 class="btn btn-primary form-btn float-right">Back</a>
        </div>
      </div>
   @include('stisla-templates::common.errors')
   @include('flash::message')
    <div class="section-body">
           <div class="card">
               @include('itineraries.show_fields')
            </div>
    </div>
    </section>
@endsection
