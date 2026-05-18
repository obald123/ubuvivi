<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlightBooking;
use Illuminate\Http\Request;

class FlightBookingController extends Controller
{
    public function index()
    {
        $bookings = FlightBooking::latest()->get();
        return view('admin.flight_bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:Approved,Pending,Rejected']);
        $booking = FlightBooking::findOrFail($id);

        $booking->approved = match($request->status) {
            'Approved' => true,
            'Rejected' => false,
            default    => null,
        };
        $booking->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        FlightBooking::findOrFail($id)->delete();
        return redirect()->route('admin.flight_bookings.index')->with('success', 'Booking deleted.');
    }
}
