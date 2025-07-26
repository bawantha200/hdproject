<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard | Heavy Duty Hire</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
   <link rel="stylesheet" href="{{asset('frontend/css/styles.css')}}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans">
    @include('customer.layouts.navbar')
    <!-- Mobile Toggle Button -->
    <button id="menuToggle" class="lg:hidden fixed top-4 left-4 z-50 bg-[#212529] text-white p-2 rounded">
        <i class="ph ph-list text-2xl"></i>
    </button>
    <!-- Page Layout -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
            
            @include('customer.layouts.sidebar')

            <!-- Main content -->
             <div class="col-12 col-md-9 col-lg-10 p-4">
             @yield('content')
</div>

        </div>
    </div>
    <footer class="bg-[#212529] text-gray-400 text-sm py-4 px-6 border-t border-gray-700">
  <div class="flex flex-col sm:flex-row justify-between items-center">
    <div class="mb-2 sm:mb-0">
      &copy; 2023 Heavy Duty Hire. All rights reserved.
    </div>
    <div class="flex items-center space-x-4">
      <span>v1.0.0</span>
      <span class="hidden sm:inline">|</span>
      <a href="#" class="hover:text-white transition-colors">Support</a>
    </div>
  </div>
</footer>

    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
