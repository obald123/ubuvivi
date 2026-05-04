<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Itinerary;
use App\Models\Vehicle;

class ServiceController extends Controller
{
    public function index()
    {
        $tours = Itinerary::all();
        $vehicles = Vehicle::with(['brand', 'model'])->get();
        
        return view('admin.services.index', compact('tours', 'vehicles'));
    }
    
    public function create()
    {
        return view('admin.services.create');
    }
    
    public function store(Request $request)
    {
        // This will be implemented based on service type
        return redirect()->route('services.index')->with('success', 'Service created successfully');
    }
    
    public function edit($id)
    {
        // This will be implemented based on service type
        return view('admin.services.edit', compact('id'));
    }
    
    public function update(Request $request, $id)
    {
        // This will be implemented based on service type
        return redirect()->route('services.index')->with('success', 'Service updated successfully');
    }
    
    public function destroy($id)
    {
        // This will be implemented based on service type
        return redirect()->route('services.index')->with('success', 'Service deleted successfully');
    }
}
