<aside id="sidebar"
      class="w-64 bg-[#212529] text-white flex flex-col fixed lg:static inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40 border-t border-gray-700">
      
    <div class="px-4 py-6 space-y-2 text-sm">
            @if(auth()->user()->hasAnyRole(['admin|manager']))
              <a href="/dashboard" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800 active"><i
                  class="ph ph-gauge"></i> Overview</a>
              <a href="#" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800"><i
                  class="ph ph-calendar-check"></i> Bookings</a>
              <a href="/vehicleIndex" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800"><i class="ph ph-truck"></i>
                Vehicles</a>
              <a href="/customer" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800"><i class="ph ph-users"></i>
                Customers</a>
              <a href="#" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800"><i
                  class="ph ph-credit-card"></i> Payments</a>
              <a href="#" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800"><i class="ph ph-chart-bar"></i>
                Reports</a>
              <a href="/profileIndex" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
                <i class="ph ph-user"></i> Profile</a>
              <a href="/CategoryIndex" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
                <i class="ph ph-user"></i> Category</a>
                
              <a href="/SliderIndex" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800"><i
                  class="ph ph-sliders-horizontal"></i> Page Settings</a>
              <a href="/GalleryIndex" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800"><i class="ph ph-image"></i>
                Gallery</a>
            @endif

            @if(auth()->user()->hasAnyRole(['admin']))
                    <!-- Show admin-only menu items -->
                     <!-- HTML Structure -->
                <div x-data="{ isOpen: false }" class="relative">
                  <!-- Toggle Button -->
                  <button @click="isOpen = !isOpen" 
                          class="flex items-center w-full px-4 py-2 rounded hover:bg-gray-800 text-blue-400">
                      <div class="flex items-center gap-1">
                      <i class="ph ph-shield-check"></i>
                      <span>User Role Management</span>
                      </div>
                      <i class="ph ph-caret-down transition-transform duration-200" 
                      :class="{ 'rotate-180': isOpen }"></i>
                  </button>

                  <!-- Collapsible Content -->
                  <div x-show="isOpen" x-collapse class="ml-4">
                      <nav class="flex flex-col">
                      <a class="px-4 py-2 hover:bg-gray-800 text-blue-400" href="/userIndex">Users</a>
                      <a class="px-4 py-2 hover:bg-gray-800 text-blue-400" href="/roleIndex">Roles</a>
                      <a class="px-4 py-2 hover:bg-gray-800 text-blue-400" href="/permissionIndex">Permission</a>
                      </nav>
                  </div>
                </div>

                <!-- Required Alpine.js (lightweight JS for interactivity) -->
                <script src="//unpkg.com/alpinejs" defer></script>
            @endif

            @if(auth()->user()->hasAnyRole(['renter|provider']))
              <!-- Common for all renter|provider -->
              <a href="/dashboard" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800 active">
                  <i class="ph ph-gauge"></i> Overview
              </a>

              <a href="/bookings" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
                  <i class="ph ph-calendar-check"></i> My Bookings
              </a>

              <a href="/profileIndex" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
                  <i class="ph ph-user"></i> Profile
              </a>

              <a href="/payments" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
                    <i class="ph ph-credit-card"></i> Payments
              </a>
            @endif

            <!-- For Vehicle Providers -->
            @if(auth()->user()->hasRole('provider'))
                <a href="/myVehicles" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
                    <i class="ph ph-truck"></i> My Vehicles
                </a>
                <a href="/booking-requests" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
                    <i class="ph ph-list-checks"></i> Booking Requests
                </a>
                <a href="/earnings" class="flex items-center gap-2 px-4 py-2 rounded hover:bg-gray-800">
                    <i class="ph ph-currency-circle-dollar"></i> Earnings
                </a>
            @endif
        
          <div class="px-4 py-6">
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                      <i class="ph ph-sign-out"></i> Logout
                  </button>
              </form>
          </div>
  </div>

    </aside>