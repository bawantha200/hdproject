@extends('customer.layouts.master')
@section('content')


<div class="col-12 col-md-9 col-lg-10 p-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <!-- Stats Cards -->
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-500">Active Bookings</h3>
            <p class="text-2xl font-bold">3</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-500">Pending Payments</h3>
            <p class="text-2xl font-bold">LKR 45,000</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-500">Vehicles Booked</h3>
            <p class="text-2xl font-bold">7</p>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="bg-white p-4 rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Recent Bookings</h2>
            <a href="/bookings" class="text-blue-500 hover:underline">View All</a>
        </div>
        
        <div class="table-responsive">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4">Booking ID</th>
                        <th class="py-2 px-4">Vehicle</th>
                        <th class="py-2 px-4">Dates</th>
                        <th class="py-2 px-4">Status</th>
                        <th class="py-2 px-4">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t">
                        <td class="py-2 px-4">#B00125</td>
                        <td class="py-2 px-4">CAT Bulldozer</td>
                        <td class="py-2 px-4">15-20 Jul 2023</td>
                        <td class="py-2 px-4"><span class="bg-green-100 text-green-800 px-2 py-1 rounded">Confirmed</span></td>
                        <td class="py-2 px-4">LKR 120,000</td>
                    </tr>
                    <!-- More rows -->
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="/book-vehicle" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded shadow flex items-center justify-center gap-2">
            <i class="ph ph-plus-circle text-xl"></i>
            <span>Book New Vehicle</span>
        </a>
        <a href="/documents" class="bg-gray-500 hover:bg-gray-600 text-white p-4 rounded shadow flex items-center justify-center gap-2">
            <i class="ph ph-file-text text-xl"></i>
            <span>Upload Documents</span>
        </a>
        <a href="/support" class="bg-orange-500 hover:bg-orange-600 text-white p-4 rounded shadow flex items-center justify-center gap-2">
            <i class="ph ph-question text-xl"></i>
            <span>Get Help</span>
        </a>
    </div>
</div>

@endsection
        