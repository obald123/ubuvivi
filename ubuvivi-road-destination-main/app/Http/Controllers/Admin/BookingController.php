<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourBooking;
use App\Models\CarBooking;
use App\Models\CarTransfer;

class BookingController extends Controller
{
    public function index()
    {
        // Get all bookings from different types
        $tourBookings = TourBooking::with('tour')->get();
        $carBookings = CarBooking::with('vehicle')->get();
        $carTransfers = CarTransfer::with('vehicle')->get();
        
        // Combine all bookings
        $allBookings = collect();
        
        foreach ($tourBookings as $booking) {
            $allBookings->push([
                'id' => $booking->id,
                'type' => 'Tour & Travel',
                'service' => $booking->tour->title ?? 'Unknown Tour',
                'date' => $booking->date,
                'client' => $booking->names,
                'email' => $booking->email,
                'phone' => $booking->phone_number,
                'status' => $this->getBookingStatus($booking),
                'details' => $booking->message,
                'model_type' => 'TourBooking',
                'model_id' => $booking->id,
                'approved_date' => $booking->updated_at
            ]);
        }
        
        foreach ($carBookings as $booking) {
            $allBookings->push([
                'id' => $booking->id,
                'type' => 'Car Rental',
                'service' => $booking->vehicle->brand->name . ' ' . $booking->vehicle->model->name ?? 'Unknown Car',
                'date' => $booking->pickup_date,
                'client' => $booking->names,
                'email' => $booking->email,
                'phone' => $booking->phone_number,
                'status' => $this->getBookingStatus($booking),
                'details' => $booking->message,
                'model_type' => 'CarBooking',
                'model_id' => $booking->id,
                'approved_date' => $booking->updated_at
            ]);
        }
        
        foreach ($carTransfers as $transfer) {
            $allBookings->push([
                'id' => $transfer->id,
                'type' => 'Transfers',
                'service' => $transfer->vehicle->brand->name . ' ' . $transfer->vehicle->model->name ?? 'Unknown Transfer',
                'date' => $transfer->pickup_date,
                'client' => $transfer->names,
                'email' => $transfer->email,
                'phone' => $transfer->phone_number,
                'status' => $this->getBookingStatus($transfer),
                'details' => $transfer->message,
                'model_type' => 'CarTransfer',
                'model_id' => $transfer->id,
                'approved_date' => $transfer->updated_at
            ]);
        }
        
        // Sort by date
        $allBookings = $allBookings->sortByDesc('date');
        
        // Get counts for filters
        $allCount = $allBookings->count();
        $activeCount = $allBookings->where('status', 'Active')->count();
        $upcomingCount = $allBookings->where('status', 'Upcoming')->count();
        $completedCount = $allBookings->where('status', 'Completed')->count();
        
        return view('admin.bookings.index', compact('allBookings', 'allCount', 'activeCount', 'upcomingCount', 'completedCount'));
    }
    
    public function show($type, $id)
    {
        $booking = null;
        
        switch ($type) {
            case 'TourBooking':
                $booking = TourBooking::with('tour')->findOrFail($id);
                break;
            case 'CarBooking':
                $booking = CarBooking::with('vehicle')->findOrFail($id);
                break;
            case 'CarTransfer':
                $booking = CarTransfer::with('vehicle')->findOrFail($id);
                break;
        }
        
        if (!$booking) {
            abort(404);
        }
        
        return response()->json($booking);
    }
    
    public function updateStatus(Request $request, $type, $id)
    {
        $model = null;
        
        switch ($type) {
            case 'TourBooking':
                $model = TourBooking::findOrFail($id);
                break;
            case 'CarBooking':
                $model = CarBooking::findOrFail($id);
                break;
            case 'CarTransfer':
                $model = CarTransfer::findOrFail($id);
                break;
        }
        
        if (!$model) {
            return response()->json(['error' => 'Booking not found'], 404);
        }
        
        $status = $request->input('status');
        
        // We'll implement status updates based on the status
        switch ($status) {
            case 'Completed':
                // Mark as completed
                $model->approved = true;
                $model->completed = true;
                $model->save();
                break;
            case 'Cancelled':
                // Cancel the booking
                $model->approved = false;
                $model->cancelled = true;
                $model->save();
                break;
            case 'Active':
                $model->approved = true;
                $model->save();
                break;
        }
        
        return response()->json(['success' => true]);
    }
    
    private function getBookingStatus($model)
    {
        // Check if booking is completed
        if (isset($model->completed) && $model->completed) {
            return 'Completed';
        }
        
        // Check if booking is cancelled
        if (isset($model->cancelled) && $model->cancelled) {
            return 'Cancelled';
        }
        
        // Check if booking is approved and date is in the past or today
        if ($model->approved) {
            $bookingDate = $model->date ?? $model->pickup_date;
            if ($bookingDate) {
                $date = \Carbon\Carbon::parse($bookingDate);
                $today = \Carbon\Carbon::today();
                
                if ($date->isToday() || $date->isPast()) {
                    return 'Active';
                } else {
                    return 'Upcoming';
                }
            }
        }
        
        return 'Pending';
    }
}
