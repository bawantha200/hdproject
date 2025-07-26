<nav class="flex items-center justify-between bg-[#212529] text-white h-16 w-full px-4">
    <div class="flex items-center h-full py-3">
      <a href="/">
        <img src="{{asset('frontend/images/logo.jpg')}}" alt="Logo" class="w-8 h-8">
      </a>
        <h1 class="text-lg font-semibold ml-3">Heavy Duty Hire</h1>
    </div>
    <div class="flex items-center gap-2 h-full py-3">
      <i class="ph ph-user-circle text-xl"></i>
      <span class="text-white">
        {{ Auth::user()->first_name ?? Auth::user()->name }}
      </span>
      <span class="badge bg-light text-dark">
        {{ Auth::user()->getRoleNames()->first() }}
      </span>
    </div>
</nav>