<?php

namespace App\Http\Controllers;

use App\Models\CarBooking;
use App\Models\CarTransfer;
use App\Models\TourBooking;
use App\Models\Vehicle;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vehicles = Vehicle::count();
        $carBookings = CarBooking::count();
        $carTransfers = CarTransfer::count();
        $tourBookings = TourBooking::count();

        return view('home', with(compact("vehicles", "carBookings", "carTransfers", "tourBookings")));
    }
}
