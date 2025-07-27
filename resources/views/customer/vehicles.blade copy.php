@extends('customer.layouts.master')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold">Heavy Vehicles Management</h1>
        
        <div class="flex gap-3 w-full md:w-auto">
            <a href="" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Add New Vehicle
            </a>
            
            <form method="GET" class="flex-1 md:w-64">
                <select name="type" onchange="this.form.submit()" 
                    class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    <option value="">All Types</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </form>
            
            <form method="GET" class="flex-1 md:w-64">
                <select name="status" onchange="this.form.submit()" 
                    class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand/Model</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reg No.</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Daily Rate</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($vehicles as $vehicle)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-medium text-gray-900">{{ $vehicle->full_name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $vehicle->type }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $vehicle->registration_number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $vehicle->formatted_daily_rate }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $vehicle->status == 'available' ? 'bg-green-100 text-green-800' : 
                               ($vehicle->status == 'maintenance' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ ucfirst($vehicle->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('renter.vehicles.show', $vehicle) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                        <a href="{{ route('renter.vehicles.edit', $vehicle) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                        <form action="{{ route('renter.vehicles.destroy', $vehicle) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Archive</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No vehicles found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($vehicles->hasPages())
    <div class="mt-4">
        {{ $vehicles->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsection