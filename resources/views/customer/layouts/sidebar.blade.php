<aside id="sidebar" class="w-64 bg-[#212529] text-white flex flex-col fixed lg:static inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40 border-t border-gray-700">
    <div class="px-4 py-6 space-y-2 text-sm">
        <!-- Common for all customers -->
        <a href="/dashboard" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800 active">
            <i class="ph ph-gauge"></i> Dashboard
        </a>
        
        <!-- For Vehicle Renters -->
        @if(auth()->user()->hasRole('renter'))
            <a href="/bookings" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
                <i class="ph ph-calendar-check"></i> My Bookings
            </a>
            <a href="/vehicles" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
                <i class="ph ph-magnifying-glass"></i> Browse Vehicles
            </a>
        @endif
        
        <!-- For Vehicle Providers -->
        @if(auth()->user()->hasRole('provider'))
            <a href="/vehicles" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
                <i class="ph ph-truck"></i> My Vehicles
            </a>
            <a href="/booking-requests" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
                <i class="ph ph-list-checks"></i> Booking Requests
            </a>
            <a href="/earnings" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
                <i class="ph ph-currency-circle-dollar"></i> Earnings
            </a>
        @endif
        
        <!-- Common for all customers -->
        <a href="/payments" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
            <i class="ph ph-credit-card"></i> Payments
        </a>
        <a href="/profileIndex" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
            <i class="ph ph-user"></i> Profile
        </a>
    </div>
    
    <div class="px-4 py-6">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                <i class="ph ph-sign-out"></i> Logout
            </button>
        </form>
    </div>
</aside>