<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelBooking;
use Illuminate\Http\Request;

class HotelBookingController extends Controller
{
    public function index()
    {
        $bookings = HotelBooking::with('hotel')->latest()->get();
        return view('admin.hotel_bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:Approved,Pending,Rejected']);
        $booking = HotelBooking::findOrFail($id);

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
        HotelBooking::findOrFail($id)->delete();
        return redirect()->route('admin.hotel_bookings.index')->with('success', 'Booking deleted.');
    }
}
