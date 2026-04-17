@extends('layouts.app')
@section('title')
    Vehicles
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Vehicles</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('vehicles.create') }}" class="btn btn-primary form-btn">Vehicle <i
                        class="fas fa-plus"></i></a>
            </div>
        </div>
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body pt-0 px-0">
                    @include('vehicles.table')
                </div>
            </div>
        </div>

    </section>
@endsection
