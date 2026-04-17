@extends('layouts.app')
@section('title')
    Vehicle Details
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Vehicle Details</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('vehicles.index') }}" class="btn btn-primary form-btn float-right">Back</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    @include('vehicles.show_fields')
                </div>
            </div>
        </div>
    </section>
@endsection
