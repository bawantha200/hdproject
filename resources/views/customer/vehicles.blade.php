@extends('admin.layouts.master')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold">Heavy Vehicles Management</h1>
        
        <div class="flex gap-3 w-full md:w-auto">
            <a href="#" onclick="openModal()" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Add New Vehicle
            </a>
            
            <form method="GET" action="{{ route('index') }}" class="flex-1 md:w-64">
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
            
            <form method="GET" action="{{ route('index') }}" class="flex-1 md:w-64">
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
                        <div class="font-medium text-gray-900">{{ $vehicle->brand }} {{ $vehicle->model }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $vehicle->type }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $vehicle->registration_number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">RM {{ number_format($vehicle->daily_rate, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $vehicle->status == 'available' ? 'bg-green-100 text-green-800' : 
                               ($vehicle->status == 'maintenance' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ ucfirst($vehicle->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" onclick="openEditModal({{ $vehicle->id }})" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                        <form action="{{ route('vehicle.delete', $vehicle->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
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

<!-- Add New Vehicle Modal -->
<div id="addVehicleModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
        <div class="flex justify-between items-center border-b px-6 py-4">
            <h3 class="text-lg font-semibold">Add New Vehicle</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <form method="POST" action="/storeVehicle" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Brand -->
                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                    <input type="text" name="brand" id="brand" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <!-- Model -->
                <div>
                    <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                    <input type="text" name="model" id="model" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <!-- Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type" id="type" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <!-- <option value="">Select Type</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach -->
                        <option value="">Select Vehicle Type</option>
                        <option value="Bulldozers">Bulldozers</option>
                        <option value="Excavators">Excavators</option>
                        <option value="Backhoes">Backhoes</option>
                        <option value="Trucks">Trucks</option>
                        <option value="Rollers">Rollers</option>
                        <option value="Cranes">Cranes</option>
                        <option value="Forklifts">Forklifts</option>
                    </select>
                </div>
                
                <!-- Registration Number -->
                <div>
                    <label for="registration_number" class="block text-sm font-medium text-gray-700">Registration Number</label>
                    <input type="text" name="registration_number" id="registration_number" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <!-- Daily Rate -->
                <div>
                    <label for="daily_rate" class="block text-sm font-medium text-gray-700">Daily Rate (RM)</label>
                    <input type="number" step="0.01" name="daily_rate" id="daily_rate" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @foreach($statuses as $status)
                            <option value="{{ $status }}" {{ $status == 'available' ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>
                
                <!-- Images -->
                <!-- <div class="md:col-span-2">
                    <label for="images" class="block text-sm font-medium text-gray-700">Vehicle Images</label>
                    <input type="file" name="images[]" id="images" multiple accept="image/*"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Upload multiple images of the vehicle</p>
                </div> -->

               
    <!-- other fields -->
    <div class="form-group">
        <label for="image">Vehicle Image</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
   
            </div>
            
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Save Vehicle
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Vehicle Modal -->
<div id="editVehicleModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <!-- Modal content will be loaded via AJAX -->
</div>

<!-- JavaScript to handle modals -->
<script>
    function openModal() {
        document.getElementById('addVehicleModal').classList.remove('hidden');
    }
    
    function closeModal() {
        document.getElementById('addVehicleModal').classList.add('hidden');
        document.getElementById('editVehicleModal').classList.add('hidden');
    }
    
    function openEditModal(vehicleId) {
        fetch(`/vehicleIndex/${vehicleId}/edit`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('editVehicleModal').innerHTML = html;
                document.getElementById('editVehicleModal').classList.remove('hidden');
            });
    }
</script>

@endsection