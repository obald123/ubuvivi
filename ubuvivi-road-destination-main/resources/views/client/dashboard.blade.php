@extends('layouts.app')
@section('title')
    Client Dashboard
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="page__heading">Welcome, {{ $user->name }}</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info">
                        This is your client dashboard. You can view your bookings and profile here.
                    </div>
                </div>
            </div>
            <!-- Add more client-specific widgets/info here -->
        </div>
    </section>
@endsection
