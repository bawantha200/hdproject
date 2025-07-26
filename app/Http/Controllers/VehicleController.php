<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Added import

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);  // Fixed syntax
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        // Your existing store logic
    }
}