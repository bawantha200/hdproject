<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    //
    public function Index()
    {
        $vehicles = Vehicle::query()
            ->when(request('type'), function($query, $type) {
                return $query->where('type', $type);
            })
            ->when(request('status'), function($query, $status) {
                return $query->where('status', $status);
            })
            ->paginate(10);

        return view('customer.vehicles', [
            'vehicles' => $vehicles,
            'types' => ['Bulldozers', 'Excavators', 'Backhoes', 'Trucks', 'Rollers', 'Cranes', 'Forklifts'],
            'statuses' => ['available', 'unavailable', 'maintenance']
        ]);
    }

    public function storeVehicle(Request $request)
    {
        // $validatedData = $request->validate([
        //     'brand' => 'required|string|max:255',
        //     'model' => 'required|string|max:255',
        //     'type' => 'required|string|max:255',
        //     'registration_number' => 'required|string|max:50|unique:vehicles',
        //     'daily_rate' => 'required|numeric|min:0',
        //     'status' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'images.*' => 'nullable|image|max:2048'
        // ]);

        $validatedData = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type' => 'required|in:Bulldozers,Excavators,Backhoes,Trucks,Rollers,Cranes,Forklifts',
            'registration_number' => 'required|string|max:50|unique:vehicles',
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable,maintenance',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $validatedData['added_by'] = Auth::id();

        $vehicle = Vehicle::create($validatedData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('vehicles', 'public');
                $vehicle->images()->create(['path' => $path]);
            }
        } else {
        $vehicle->image = 'default-vehicle.jpg'; // Default image
    }
    $vehicle->save();

        return redirect()->back()->with('success', 'Vehicle added successfully!');
    }

    public function updateVehicle(Request $request)
    {
        $validatedData = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'registration_number' => 'required|string|max:50|unique:vehicles,registration_number,' . $request->vehicle_id,
            'daily_rate' => 'required|numeric|min:0',
            'status' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|max:2048'
        ]);

        $vehicle = Vehicle::find($request->vehicle_id);
        $vehicle->update($validatedData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('vehicles', 'public');
                $vehicle->images()->create(['path' => $path]);
            }
        }

        return redirect()->back()->with('success', 'Vehicle updated successfully!');
    }

    public function deleteVehicle($id)
    {
        $vehicle = Vehicle::find($id);

        // Delete associated images
        foreach($vehicle->images as $image) {
            Storage::delete('public/' . $image->path);
            $image->delete();
        }

        $vehicle->delete();

        return redirect()->back()->with('success', 'Vehicle deleted successfully!');
    }
}