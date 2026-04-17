@extends('layouts.app')
@section('title')
    Car Transfer Details
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Car Transfer Details</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('carTransfers.index') }}" class="btn btn-primary form-btn float-right">Back</a>
            </div>
        </div>
        @include('stisla-templates::common.errors')
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @include('car_transfers.show_fields')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
