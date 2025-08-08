<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Add this import

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */ // This helps your IDE understand the type
        $user = Auth::user(); // Using facade instead of auth() helper
        
        if ($user->hasAnyRole(['admin', 'manager'])) {
            return view('admin.dashboard', [
                'user' => $user,
                'isAdmin' => $user->hasRole('admin'),
                'isManager' => $user->hasRole('manager')
            ]);
        }
        
        if ($user->hasAnyRole(['provider', 'renter'])) {
            return view('admin.dashboard', [
                'user' => $user,
                'isProvider' => $user->hasRole('provider'),
                'isRenter' => $user->hasRole('renter')
            ]);
            return view('admin.vehicles', [
                'user' => $user,
                'isProvider' => $user->hasRole('provider'),
                'isRenter' => $user->hasRole('renter')
            ]);
        }
        
        abort(403, 'Unauthorized access - No valid role assigned');
    }
}