<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Itinerary;
use App\Models\Vehicle;
use App\Models\Transfer;
use App\Models\Event;

class ServiceController extends Controller
{
    public function index()
    {
        $tours = Itinerary::all();
        $vehicles = Vehicle::with(['brand', 'model'])->get();
        $transfers = Transfer::with(['vehicle', 'driver'])->get();
        $events = Event::all();
        
        return view('admin.services.index', compact('tours', 'vehicles', 'transfers', 'events'));
    }
    
    public function create()
    {
        return view('admin.services.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'service_type' => 'required|in:tour,car,transfer,event'
        ]);

        try {
            switch ($validated['service_type']) {
                case 'tour':
                    $service = Itinerary::create([
                        'title' => $validated['title'],
                        'price' => $validated['price'],
                        'description' => $validated['description'],
                        'images' => json_encode([]),
                        'highlights' => json_encode([]),
                        'days_description' => $validated['description'],
                        'inclusions' => json_encode([]),
                        'exclusions' => json_encode([])
                    ]);
                    break;
                    
                case 'car':
                    $service = Vehicle::create([
                        'brand_id' => 1, // Default brand
                        'model_id' => 1, // Default model
                        'production_year' => date('Y'),
                        'plate_number' => 'NEW-' . rand(1000, 9999),
                        'seats' => 4,
                        'price' => $validated['price'],
                        'currency' => 'USD',
                        'description' => $validated['description'],
                        'images' => json_encode([]),
                        'properties' => $validated['description'],
                        'approved' => true,
                        'for_sale' => true
                    ]);
                    break;
                    
                case 'transfer':
                    $service = Transfer::create([
                        'pickup_location' => $validated['title'],
                        'destination' => 'Airport Transfer',
                        'pickup_date' => now()->format('Y-m-d'),
                        'pickup_time' => now()->format('H:i'),
                        'number_of_days' => 1,
                        'message' => $validated['description'],
                        'price' => $validated['price'],
                        'approved' => true,
                        'transfer_type' => 'airport'
                    ]);
                    break;
                    
                case 'event':
                    $service = Event::create([
                        'title' => $validated['title'],
                        'price' => $validated['price'],
                        'description' => $validated['description'],
                        'event_type' => 'corporate',
                        'location' => 'Kigali',
                        'start_date' => now()->addDays(7)->format('Y-m-d'),
                        'end_date' => now()->addDays(14)->format('Y-m-d'),
                        'capacity' => 100
                    ]);
                    break;
            }

            return redirect()->route('services.index')->with('success', ucfirst($validated['service_type']) . ' service created successfully');
        } catch (\Exception $e) {
            return redirect()->route('services.index')->with('error', 'Failed to create service: ' . $e->getMessage());
        }
    }
    
    public function edit($id)
    {
        // This will be implemented based on service type
        return view('admin.services.edit', compact('id'));
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'service_type' => 'required|in:tour,car,transfer,event'
        ]);

        try {
            switch ($validated['service_type']) {
                case 'tour':
                    $service = Itinerary::find($id);
                    if ($service) {
                        $service->update([
                            'title' => $validated['title'],
                            'price' => $validated['price'],
                            'description' => $validated['description']
                        ]);
                    }
                    break;
                    
                case 'car':
                    $service = Vehicle::find($id);
                    if ($service) {
                        $service->update([
                            'brand_id' => $service->brand_id,
                            'model_id' => $service->model_id,
                            'production_year' => $service->production_year,
                            'plate_number' => $service->plate_number,
                            'seats' => $service->seats,
                            'price' => $validated['price'],
                            'currency' => $service->currency,
                            'description' => $validated['description'],
                            'properties' => $validated['description']
                        ]);
                    }
                    break;
                    
                case 'transfer':
                    $service = Transfer::find($id);
                    if ($service) {
                        $service->update([
                            'pickup_location' => $validated['title'],
                            'destination' => $validated['title'],
                            'pickup_date' => $service->pickup_date,
                            'pickup_time' => $service->pickup_time,
                            'number_of_days' => $service->number_of_days,
                            'message' => $validated['description'],
                            'price' => $validated['price']
                        ]);
                    }
                    break;
                    
                case 'event':
                    $service = Event::find($id);
                    if ($service) {
                        $service->update([
                            'title' => $validated['title'],
                            'price' => $validated['price'],
                            'description' => $validated['description']
                        ]);
                    }
                    break;
            }

            return redirect()->route('services.index')->with('success', ucfirst($validated['service_type']) . ' service updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('services.index')->with('error', 'Failed to update service: ' . $e->getMessage());
        }
    }
    
    public function destroy($id)
    {
        try {
            // Find the service type and ID from the request
            // For now, we'll handle deletion based on existing data structure
            
            // Try to find as tour/itinerary first
            $service = Itinerary::find($id);
            if ($service) {
                $service->delete();
                return redirect()->route('services.index')->with('success', 'Tour service deleted successfully');
            }
            
            // Try to find as vehicle
            $service = Vehicle::find($id);
            if ($service) {
                $service->delete();
                return redirect()->route('services.index')->with('success', 'Car service deleted successfully');
            }
            
            // Try to find as transfer
            $service = Transfer::find($id);
            if ($service) {
                $service->delete();
                return redirect()->route('services.index')->with('success', 'Transfer service deleted successfully');
            }
            
            // Try to find as event
            $service = Event::find($id);
            if ($service) {
                $service->delete();
                return redirect()->route('services.index')->with('success', 'Event service deleted successfully');
            }
            
            return redirect()->route('services.index')->with('error', 'Service not found');
            
        } catch (\Exception $e) {
            return redirect()->route('services.index')->with('error', 'Failed to delete service: ' . $e->getMessage());
        }
    }
}
