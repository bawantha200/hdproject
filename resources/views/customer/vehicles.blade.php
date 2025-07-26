@extends('customer.layouts.master')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold">Available Heavy Vehicles</h1>
        
        <div class="flex gap-3 w-full md:w-auto">
            <form method="GET" class="flex-1 md:w-64">
                @if(request()->has('type'))
                    <input type="hidden" name="type" value="{{ request('type') }}">
                @endif
                <select name="type" onchange="this.form.submit()" 
                    class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    <option value="">All Types</option>
                    @isset($types)
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    @endisset
                </select>
            </form>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($vehicles as $vehicle)
        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
            <div class="h-48 bg-gray-200 overflow-hidden">
                @if($vehicle->primary_image && Storage::exists($vehicle->primary_image))
                    <img src="{{ asset('storage/'.$vehicle->primary_image) }}" 
                         alt="{{ $vehicle->name }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                        <span class="text-gray-500">No Image Available</span>
                    </div>
                @endif
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start">
                    <h3 class="font-bold text-lg">{{ $vehicle->name ?? 'Unnamed Vehicle' }}</h3>
                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                        {{ $vehicle->type ?? 'N/A' }}
                    </span>
                </div>
                <p class="text-gray-600 mt-2">{{ $vehicle->short_description ?? 'No description available' }}</p>
                
                <div class="mt-4 flex justify-between items-center">
                    <div>
                        <span class="font-bold text-lg">LKR {{ number_format($vehicle->daily_rate ?? 0) }}</span>
                        <span class="text-gray-500 text-sm">/day</span>
                    </div>
                    @if(isset($vehicle->id))
                        <a href="{{ route('renter.vehicles.show', $vehicle->id) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                            View Details
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-10">
            <p class="text-gray-500">No vehicles found.</p>
            @if(request('type'))
                <a href="{{ url()->current() }}" class="text-blue-500 hover:underline">Clear filters</a>
            @endif
        </div>
        @endforelse
    </div>
    
    @if($vehicles->count())
    <div class="mt-6">
        {{ $vehicles->links() }}
    </div>
    @endif
</div>
@endsection