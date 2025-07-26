@extends('customer.layouts.master')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Animated Header -->
        <div class="text-center mb-10 animate-fade-in-down">
            <h2 class="text-4xl font-bold text-[#212529] mb-2 transform transition-all hover:scale-105">
                Hello, {{ Auth::user()->first_name }}
            </h2>
            <p class="text-lg text-gray-600">Update your profile details below</p>
        </div>

        @if(session('success'))
            <div class="mb-8 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg shadow-md animate-bounce-in">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Profile Card with Floating Animation -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow duration-500 animate-float">
            <div class="p-8">

                <!-- Main Form with Staggered Animations -->
                <form method="POST" action="/profileUpdate" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Personal Information Section -->
                    <div class="animate-fade-in-up" style="animation-delay: 0.1s">
                        <h3 class="text-xl font-semibold text-[#212529] mb-6 pb-2 border-b border-gray-200 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#212529]" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Personal Information
                        </h3>
                    </div>

                    <!-- Animated Form Fields -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="animate-fade-in-up" style="animation-delay: 0.2s">
                            <label for="first_name" class="block text-sm font-medium text-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                First Name
                            </label>
                            <input 
                                type="text" 
                                id="first_name" 
                                name="first_name" 
                                value="{{ old('first_name', $user->first_name) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#212529] focus:border-[#212529] transition duration-300 hover:border-[#212529]"
                            >
                            @error('first_name')
                                <p class="mt-1 text-sm text-red-600 animate-shake">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="animate-fade-in-up" style="animation-delay: 0.3s">
                            <label for="last_name" class="block text-sm font-medium text-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Last Name
                            </label>
                            <input 
                                type="text" 
                                id="last_name" 
                                name="last_name" 
                                value="{{ old('last_name', $user->last_name) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#212529] focus:border-[#212529] transition duration-300 hover:border-[#212529]"
                            >
                            @error('last_name')
                                <p class="mt-1 text-sm text-red-600 animate-shake">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="animate-fade-in-up" style="animation-delay: 0.4s">
                        <label for="email" class="block text-sm font-medium text-gray-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Email Address
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', $user->email) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#212529] focus:border-[#212529] transition duration-300 hover:border-[#212529]"
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-600 animate-shake">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="animate-fade-in-up" style="animation-delay: 0.5s">
                        <label for="phone" class="block text-sm font-medium text-gray-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Phone Number
                        </label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="phone" 
                            value="{{ old('phone', $user->phone) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#212529] focus:border-[#212529] transition duration-300 hover:border-[#212529]"
                        >
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600 animate-shake">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="animate-fade-in-up" style="animation-delay: 0.6s">
                        <label for="address" class="block text-sm font-medium text-gray-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Address
                        </label>
                        <textarea 
                            id="address" 
                            name="address" 
                            rows="3"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#212529] focus:border-[#212529] transition duration-300 hover:border-[#212529]"
                        >{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600 animate-shake">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-4 pt-4 animate-fade-in-up" style="animation-delay: 0.7s">
                        <button 
                            type="button" 
                            onclick="window.location.reload()"
                            class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#212529] transition duration-300 transform hover:-translate-y-1"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#212529] hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#212529] transition duration-300 transform hover:-translate-y-1 hover:shadow-lg"
                        >
                            Save Changes
                        </button>
                    </div>
                </form>

                <!-- Password Section with Slide-in Animation -->
                <div class="mt-12 pt-8 border-t border-gray-200 animate-slide-in-right">
                    <h3 class="text-xl font-semibold text-[#212529] mb-6 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#212529]" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        Change Password
                    </h3>
                    
                    <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="animate-fade-in-up" style="animation-delay: 0.8s">
                            <label for="current_password" class="block text-sm font-medium text-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Current Password
                            </label>
                            <input 
                                type="password" 
                                id="current_password" 
                                name="current_password" 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#212529] focus:border-[#212529] transition duration-300 hover:border-[#212529]"
                            >
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600 animate-shake">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div class="animate-fade-in-up" style="animation-delay: 0.9s">
                                <label for="password" class="block text-sm font-medium text-gray-700 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    New Password
                                </label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#212529] focus:border-[#212529] transition duration-300 hover:border-[#212529]"
                                >
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600 animate-shake">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="animate-fade-in-up" style="animation-delay: 1.0s">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Confirm Password
                                </label>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#212529] focus:border-[#212529] transition duration-300 hover:border-[#212529]"
                                >
                            </div>
                        </div>

                        <div class="flex justify-end animate-fade-in-up" style="animation-delay: 1.1s">
                            <button 
                                type="submit" 
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#212529] hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#212529] transition duration-300 transform hover:-translate-y-1 hover:shadow-lg"
                            >
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection