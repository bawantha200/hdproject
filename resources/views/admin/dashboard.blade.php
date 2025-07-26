@extends('admin.layouts.master')
@section('content')
                
<!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <main class="p-6">
        <!-- Heading -->
        <div class="mb-6">
          <h2 class="text-2xl font-bold">Dashboard Overview</h2>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
          <div class="bg-blue-600 text-white p-6 rounded-lg shadow flex items-center gap-4">
            <i class="ph ph-clipboard-text text-4xl"></i>
            <div>
              <p class="text-sm">Total Bookings</p>
              <p class="text-3xl font-semibold">128</p>
            </div>
          </div>
          <div class="bg-green-600 text-white p-6 rounded-lg shadow flex items-center gap-4">
            <i class="ph ph-truck text-4xl"></i>
            <div>
              <p class="text-sm">Available Vehicles</p>
              <p class="text-3xl font-semibold">35</p>
            </div>
          </div>
          <div class="bg-yellow-400 text-white p-6 rounded-lg shadow flex items-center gap-4">
            <i class="ph ph-hourglass text-4xl"></i>
            <div>
              <p class="text-sm">Pending Approvals</p>
              <p class="text-3xl font-semibold">6</p>
            </div>
          </div>
        </div>

        <!-- Recent Bookings -->
        <div class="bg-white p-6 rounded-lg shadow">
          <h3 class="text-xl font-semibold mb-4">Recent Bookings</h3>
          <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
              <thead>
                <tr class="bg-gray-200 text-gray-700">
                  <th class="px-4 py-2 text-left">Booking ID</th>
                  <th class="px-4 py-2 text-left">User</th>
                  <th class="px-4 py-2 text-left">Vehicle</th>
                  <th class="px-4 py-2 text-left">Status</th>
                  <th class="px-4 py-2 text-left">Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-b">
                  <td class="px-4 py-2">#B00123</td>
                  <td class="px-4 py-2">Rohan Sampath</td>
                  <td class="px-4 py-2">CAT Bulldozer D6</td>
                  <td class="px-4 py-2">
                    <span
                      class="bg-green-200 text-green-800 text-xs px-2 py-1 rounded-full">Confirmed</span>
                  </td>
                  <td class="px-4 py-2">LKR 120,000</td>
                </tr>
                <tr>
                  <td class="px-4 py-2">#B00124</td>
                  <td class="px-4 py-2">Sam Fernandp</td>
                  <td class="px-4 py-2">Hyundai Excavator</td>
                  <td class="px-4 py-2">
                    <span
                      class="bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded-full">Pending</span>
                  </td>
                  <td class="px-4 py-2">LKR 95,000</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>
        
@endsection