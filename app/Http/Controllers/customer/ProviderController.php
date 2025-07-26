<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function dashboard()
    {
        return view('provider.dashboard');
    }
    
    public function vehicles()
    {
        $user = Auth::user()->vehicles; // Assuming relationship is set up
        return view('provider.vehicles.index', compact('vehicles'));
    }
    public function index(Request $request)
    {
        // Get all distinct vehicle types for the filter dropdown
        $types = Vehicle::select('type')->distinct()->pluck('type');
        
        // Filter vehicles based on type if selected
        $vehicles = Vehicle::when($request->type, function($query, $type) {
                return $query->where('type', $type);
            })
            ->paginate(9); // 9 items per page

        return view('vehicles.index', compact('vehicles', 'types'));
    }

    
    // public function bookingRequests()
    // {
    //     $requests = Auth::user()->bookingRequests()->pending()->get();
    //     return view('provider.bookings.requests', compact('requests'));
    // }
    
    // Add other methods for earnings, payments, etc.
}