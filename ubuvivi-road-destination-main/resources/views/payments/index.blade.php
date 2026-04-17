@extends('layouts.app')
@section('title')
    Payments
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Payments</h1>
        </div>
        @include('flash::message')
        <div class="section-body">
            <div class="card">
                <div class="card-body pt-0 px-0">
                    @include('payments.table')
                </div>
            </div>
        </div>

    </section>
@endsection
