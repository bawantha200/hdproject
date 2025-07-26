<?php

namespace App\Observers;

use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class VehicleObserver
{
    public function creating(Vehicle $vehicle)
    {
        // Only set added_by if user is authenticated
        if (Auth::check()) {
            $vehicle->added_by = Auth::id();
        } else {
            // Handle unauthenticated case - either:
            // 1. Throw an exception
            throw new \RuntimeException('Cannot create vehicle: no authenticated user');
            
            // OR 2. Set to null (if column is nullable)
            // $vehicle->added_by = null;
            
            // OR 3. Set to a default user ID
            // $vehicle->added_by = 1; // Admin user
        }
    }

    // ... keep other methods as is ...
}