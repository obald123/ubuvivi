@extends('layouts.app')
@section('title')
    Car Transfers
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Car Transfers</h1>
        </div>
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body pt-0 px-0">
                    @include('car_transfers.table')
                </div>
            </div>
        </div>

    </section>
@endsection
