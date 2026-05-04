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

        $pendingRequests = CarTransfer::where('approved', 0)->count()
                         + CarBooking::where('approved', 0)->count()
                         + TourBooking::where('approved', 0)->count();

        $recentRequests = CarTransfer::latest()->take(3)->get()->map(function ($t) {
            return [
                'name'    => $t->names,
                'service' => 'Hotel Transfer',
                'date'    => $t->pickup_date,
                'sub'     => $t->pickup_location . ' to ' . $t->destination,
            ];
        });

        $upcomingBookings = CarTransfer::where('approved', 1)->latest()->take(3)->get()->map(function ($t) {
            return [
                'name'    => $t->names,
                'service' => 'Hotel Transfer',
                'date'    => $t->pickup_date,
                'sub'     => $t->pickup_location . ' to ' . $t->destination,
            ];
        });

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
            $chartData[] = ['month' => $month->format('M'), 'count' => $count];
        }

        return view('home', compact(
            'totalBookings', 'activeServices', 'totalClients', 'pendingRequests',
            'recentRequests', 'upcomingBookings', 'chartData'
        ));
    }
}
