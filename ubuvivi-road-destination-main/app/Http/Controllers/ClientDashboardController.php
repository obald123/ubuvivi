<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ClientDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'client']);
    }

    public function index()
    {
        $user = Auth::user();
        // Add more client-specific data as needed
        return view('client.dashboard', compact('user'));
    }
}
