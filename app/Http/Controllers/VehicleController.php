<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the vehicles.
     */
    public function index(Request $request)
    {
        // Get filter values from request
        $type = $request->query('type');
        $status = $request->query('status');
        
        // Start building the query
        $query = Vehicle::query();
        
        // Apply filters if they exist
        if ($type) {
            $query->where('type', $type);
        }
        
        if ($status) {
            $query->where('status', $status);
        }
        
        // Get all unique types for filter dropdown
        $types = Vehicle::distinct()->pluck('type');
        
        // Define possible statuses
        $statuses = ['available', 'rented', 'maintenance'];
        
        // Paginate the results
        $vehicles = $query->paginate(10)->withQueryString();
        
        
        return view('customer.vehicles', compact('vehicles', 'types', 'statuses'));
    }
    

    /**
     * Show the form for creating a new vehicle.
     */
    public function create()
    {
        // Not needed since we're using a modal
        return redirect()->route('customer.vehicles');
    }

    /**
     * Store a newly created vehicle in storage.
     */
    public function storeVehicle(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255|unique:vehicles',
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|string|in:available,rented,maintenance',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'added_by' => '$user->id',
        ]);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/vehicles');
            $validated['image'] = str_replace('public/', '', $imagePath);
        }
        
        $validated['added_by'] = FacadesAuth::id();
        // Create the vehicle
        Vehicle::create($validated);
        
        return redirect()->back()->with('success', 'Vehicle added successfully!');
    }

    /**
     * Display the specified vehicle.
     */
    public function show(Vehicle $vehicle)
    {
        $vehicles = Vehicle::all();
        return view('forntend.home.vehicles', compact('vehicle'));
    }

    public function frontendVehicles()
    {
        $vehicles = Vehicle::all(); // Only show available vehicles
        return view('frontend.vehicle', compact('vehicles'));
    }
    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit(Vehicle $vehicle)
    {
        // Not needed since we're using a modal
        return redirect()->route('customer.vehicles');
    }

    /**
     * Update the specified vehicle in storage.
     */
    public function updateVehicle(Request $request) {
    $validatedData = $request->validate([
        'vehicle_id' => 'required|exists:vehicles,id',
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'registration_number' => 'required|string|max:255',
        'daily_rate' => 'required|numeric|min:0',
        'status' => 'required|string|in:available,rented,maintenance',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $update = Vehicle::findOrfail($request->vehicle_id);
    $update->brand = $validatedData['brand'];
    $update->model = $validatedData['model'];
    $update->type = $validatedData['type'];
    $update->registration_number = $validatedData['registration_number'];
    $update->daily_rate = $validatedData['daily_rate'];
    $update->status = $validatedData['status'];
    $update->description = $validatedData['description'];

    if($request->hasFile('image')) {
        // Delete old image if it exists
        if ($update->image) {
            Storage::delete('public/' . $update->image);
        }
        
        $imagePath = $request->file('image')->store('vehicles', 'public');
        $update->image = $imagePath;
    }

    $update->save();

    return redirect()->back()->with('success', 'Vehicle updated successfully!');
}

    /**
     * Remove the specified vehicle from storage.
     */
    public function deleteVehicle($id)
{
    $delete = Vehicle::find($id);
    
    if ($delete->image) {
        Storage::delete('public/' . $delete->image);
    }
    
    $delete->delete();

    return redirect()->back()->with('success', 'Vehicle deleted successfully!');
}
}