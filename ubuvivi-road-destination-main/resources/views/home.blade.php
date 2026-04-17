@extends('layouts.app')
@section('title')
    Dashboard
@endsection

@section('css')
    <style>
        table td {
            min-width: max-content;
        }
    </style>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1 class="page__heading">Dashboard</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-sm-6 col-xl-3 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-car"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>vehicles</h4>
                            </div>
                            <div class="card-body">
                                {{ $vehicles ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-taxi"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Self Drive</h4>
                            </div>
                            <div class="card-body">
                                {{ $carBookings ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-train"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>With Driver</h4>
                            </div>
                            <div class="card-body">
                                {{ $carTransfers ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-bus"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tour Bookings</h4>
                            </div>
                            <div class="card-body">
                                {{ $tourBookings ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Latest Bookings</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="bg-light">Names</th>
                                    <th class="bg-light">Phone number</th>
                                    <th class="bg-light">Booking Type</th>
                                    <th class="text-left bg-light w-auto">Date</th>
                                </tr>
                            </thead>
                            @if (count($payments) > 0)
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td class="font-weight-600">{{ $payment->booking->names ?? '-' }}</td>
                                            <td>{{ $payment->booking->phone_number ?? '-' }}</td>
                                            <td>{{ $payment->booking->bookingType ?? '-' }}</td>
                                            <td class="w-auto">
                                                {{ date('jS F, Y', strtotime($payment->booking->updated_at ?? null)) ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center">No bookings found</td>
                                    </tr>
                                <tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
@endsection
