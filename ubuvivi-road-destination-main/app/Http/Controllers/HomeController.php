<?php

namespace App\Http\Controllers;

use App\Models\CarBooking;
use App\Models\CarTransfer;
use App\Models\TourBooking;
use App\Models\Vehicle;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $carBookings   = CarBooking::count();
        $carTransfers  = CarTransfer::count();
        $tourBookings  = TourBooking::count();
        $totalBookings = $carBookings + $carTransfers + $tourBookings;

        $vehicles      = Vehicle::count();
        $activeServices = $vehicles;

        $totalClients = User::where('role', 'client')->count();

        $pendingRequests = CarTransfer::whereNull('approved')->count()
                         + CarBooking::whereNull('approved')->count()
                         + TourBooking::whereNull('approved')->count();

        $recentRequests = collect()
            ->merge(
                TourBooking::with('tour')->latest()->take(5)->get()->map(fn ($b) => [
                    'name'    => $b->names,
                    'service' => 'Tour & Travel',
                    'date'    => $b->date,
                    'sub'     => optional($b->tour)->title ?? 'Tour Booking',
                ])
            )
            ->merge(
                CarBooking::latest()->take(5)->get()->map(fn ($b) => [
                    'name'    => $b->names,
                    'service' => 'Car Rental',
                    'date'    => $b->delivery_date,
                    'sub'     => $b->delivery_location ?? '',
                ])
            )
            ->merge(
                CarTransfer::latest()->take(5)->get()->map(fn ($b) => [
                    'name'    => $b->names,
                    'service' => 'Transfers',
                    'date'    => $b->pickup_date,
                    'sub'     => ($b->pickup_location ?? '') . ' to ' . ($b->destination ?? ''),
                ])
            )
            ->sortByDesc('date')
            ->take(3)
            ->values();

        $upcomingBookings = collect()
            ->merge(
                TourBooking::with('tour')->where('approved', true)->latest()->take(5)->get()->map(fn ($b) => [
                    'name'    => $b->names,
                    'service' => 'Tour & Travel',
                    'date'    => $b->date,
                    'sub'     => optional($b->tour)->title ?? 'Tour Booking',
                ])
            )
            ->merge(
                CarBooking::where('approved', true)->latest()->take(5)->get()->map(fn ($b) => [
                    'name'    => $b->names,
                    'service' => 'Car Rental',
                    'date'    => $b->delivery_date,
                    'sub'     => $b->delivery_location ?? '',
                ])
            )
            ->merge(
                CarTransfer::where('approved', true)->latest()->take(5)->get()->map(fn ($b) => [
                    'name'    => $b->names,
                    'service' => 'Transfers',
                    'date'    => $b->pickup_date,
                    'sub'     => ($b->pickup_location ?? '') . ' to ' . ($b->destination ?? ''),
                ])
            )
            ->sortByDesc('date')
            ->take(3)
            ->values();

        // Monthly booking counts for the chart (last 7 months)
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $count = CarTransfer::whereYear('created_at', $month->year)
                       ->whereMonth('created_at', $month->month)->count()
                   + CarBooking::whereYear('created_at', $month->year)
                       ->whereMonth('created_at', $month->month)->count()
                   + TourBooking::whereYear('created_at', $month->year)
                       ->whereMonth('created_at', $month->month)->count();
            $chartData[] = ['month' => $month->format('F'), 'count' => $count];
        }

        return view('home', compact(
            'totalBookings', 'activeServices', 'totalClients', 'pendingRequests',
            'recentRequests', 'upcomingBookings', 'chartData'
        ));
    }
}
