<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourBooking;
use App\Models\CarBooking;
use App\Models\CarTransfer;

class RequestController extends Controller
{
    public function index()
    {
        // Get all requests from different booking types
        $tourBookings = TourBooking::with('tour')->get();
        $carBookings = CarBooking::with('vehicle')->get();
        $carTransfers = CarTransfer::with('vehicle')->get();
        
        // Combine all requests
        $allRequests = collect();
        
        foreach ($tourBookings as $booking) {
            $allRequests->push([
                'id' => $booking->id,
                'type' => 'Tour & Travel',
                'service' => $booking->tour->title ?? 'Unknown Tour',
                'date' => $booking->date,
                'client' => $booking->names,
                'email' => $booking->email,
                'phone' => $booking->phone_number,
                'status' => $booking->approved ? 'Approved' : 'Pending',
                'details' => $booking->message,
                'model_type' => 'TourBooking',
                'model_id' => $booking->id
            ]);
        }
        
        foreach ($carBookings as $booking) {
            $allRequests->push([
                'id' => $booking->id,
                'type' => 'Car Rental',
                'service' => $booking->vehicle->brand->name . ' ' . $booking->vehicle->model->name ?? 'Unknown Car',
                'date' => $booking->pickup_date,
                'client' => $booking->names,
                'email' => $booking->email,
                'phone' => $booking->phone_number,
                'status' => $booking->approved ? 'Approved' : 'Pending',
                'details' => $booking->message,
                'model_type' => 'CarBooking',
                'model_id' => $booking->id
            ]);
        }
        
        foreach ($carTransfers as $transfer) {
            $allRequests->push([
                'id' => $transfer->id,
                'type' => 'Transfers',
                'service' => $transfer->vehicle->brand->name . ' ' . $transfer->vehicle->model->name ?? 'Unknown Transfer',
                'date' => $transfer->pickup_date,
                'client' => $transfer->names,
                'email' => $transfer->email,
                'phone' => $transfer->phone_number,
                'status' => $transfer->approved ? 'Approved' : 'Pending',
                'details' => $transfer->message,
                'model_type' => 'CarTransfer',
                'model_id' => $transfer->id
            ]);
        }
        
        // Sort by date
        $allRequests = $allRequests->sortByDesc('date');
        
        // Get counts for filters
        $allCount = $allRequests->count();
        $pendingCount = $allRequests->where('status', 'Pending')->count();
        $approvedCount = $allRequests->where('status', 'Approved')->count();
        $rejectedCount = 0; // We'll implement rejection later
        
        return view('admin.requests.index', compact('allRequests', 'allCount', 'pendingCount', 'approvedCount', 'rejectedCount'));
    }
    
    public function show($type, $id)
    {
        $request = null;
        
        switch ($type) {
            case 'TourBooking':
                $request = TourBooking::with('tour')->findOrFail($id);
                break;
            case 'CarBooking':
                $request = CarBooking::with('vehicle')->findOrFail($id);
                break;
            case 'CarTransfer':
                $request = CarTransfer::with('vehicle')->findOrFail($id);
                break;
        }
        
        if (!$request) {
            abort(404);
        }
        
        return response()->json($request);
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
            return response()->json(['error' => 'Request not found'], 404);
        }
        
        $status = $request->input('status');
        
        if ($status === 'Approved') {
            $model->approved = true;
            $model->save();
        } elseif ($status === 'Rejected') {
            // We'll implement rejection logic later
            $model->approved = false;
            $model->save();
        }
        
        return response()->json(['success' => true]);
    }
}
