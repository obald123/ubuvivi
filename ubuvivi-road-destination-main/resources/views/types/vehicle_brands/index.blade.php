@extends('layouts.app')
@section('title')
    Vehicle Brands
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Vehicle Brands</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('types.vehicleBrands.create') }}" class="btn btn-primary form-btn">Vehicle Brand <i
                        class="fas fa-plus"></i></a>
            </div>
        </div>
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body pt-0 px-0">
                    @include('types.vehicle_brands.table')
                </div>
            </div>
        </div>

    </section>
@endsection
