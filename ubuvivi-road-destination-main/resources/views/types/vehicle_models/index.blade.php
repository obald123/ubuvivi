@extends('layouts.app')
@section('title')
    Vehicle Models
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Vehicle Models</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('types.vehicleModels.create') }}" class="btn btn-primary form-btn">Vehicle Model <i
                        class="fas fa-plus"></i></a>
            </div>
        </div>
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body pt-0 px-0">
                    @include('types.vehicle_models.table')
                </div>
            </div>
        </div>

    </section>
@endsection
