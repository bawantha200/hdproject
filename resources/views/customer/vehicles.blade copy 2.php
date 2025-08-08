@extends('admin.layouts.master')

@section('content')
@if (session('success'))
    <div class="alert alert-success alet-dismissible fade show" role="alert">
        {{session('success')}}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>
                {{$error}}
            </li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold">Heavy Vehicles Management</h1>
        
        <div class="flex gap-3 w-full md:w-auto">
            <button onclick="openModal('addVehicleModal')" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Add New Vehicle
            </button>
            
            <form method="GET" action="{{ route('vehicles.my') }}" class="flex-1 md:w-64">
                <select name="type" onchange="this.form.submit()" 
                    class="w-full rounded border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    <option value="">All Types</option>
                    <option value="Bulldozers" {{ request('type') == 'Bulldozers' ? 'selected' : '' }}>Bulldozers</option>
    <option value="Excavators" {{ request('type') == 'Excavators' ? 'selected' : '' }}>Excavators</option>
                </select>
            </form>
            
            <form method="GET" action="{{ route('vehicles.my') }}" class="flex-1 md:w-64">
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
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">LKR {{ number_format($vehicle->daily_rate, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $vehicle->status == 'available' ? 'bg-green-100 text-green-800' : 
                               ($vehicle->status == 'maintenance' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                            {{ ucfirst($vehicle->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button onclick="openModal('editVehicleModal{{ $vehicle->id }}')" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</button>
                        <button onclick="openModal('deleteVehicleModal{{ $vehicle->id }}')" class="text-red-600 hover:text-red-900">Delete</button>
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
                
                <!-- Image -->
                <div class="md:col-span-2">
                    <label for="image" class="block text-sm font-medium text-gray-700">Vehicle Image</label>
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

<!-- Edit Vehicle Modals -->
@foreach($vehicles as $vehicle)
<div id="editVehicleModal{{ $vehicle->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
        <div class="flex justify-between items-center border-b px-6 py-4">
            <h3 class="text-lg font-semibold">Edit Vehicle</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <form method="POST" action="/updateVehicle" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('POST')
            <input type="hidden" name="vehicle_id" value="{{$vehicle->id}}">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Brand -->
                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
                    <input type="text" name="brand" id="brand" value="{{ $vehicle->brand }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <!-- Model -->
                <div>
                    <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                    <input type="text" name="model" id="model" value="{{ $vehicle->model }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <!-- Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type" id="type" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="Bulldozers" {{ $vehicle->type == 'Bulldozers' ? 'selected' : '' }}>Bulldozers</option>
                        <option value="Excavators" {{ $vehicle->type == 'Excavators' ? 'selected' : '' }}>Excavators</option>
                        <option value="Backhoes" {{ $vehicle->type == 'Backhoes' ? 'selected' : '' }}>Backhoes</option>
                        <option value="Trucks" {{ $vehicle->type == 'Trucks' ? 'selected' : '' }}>Trucks</option>
                        <option value="Rollers" {{ $vehicle->type == 'Rollers' ? 'selected' : '' }}>Rollers</option>
                        <option value="Cranes" {{ $vehicle->type == 'Cranes' ? 'selected' : '' }}>Cranes</option>
                        <option value="Forklifts" {{ $vehicle->type == 'Forklifts' ? 'selected' : '' }}>Forklifts</option>
                    </select>
                </div>
                
                <!-- Registration Number -->
                <div>
                    <label for="registration_number" class="block text-sm font-medium text-gray-700">Registration Number</label>
                    <input type="text" name="registration_number" id="registration_number" value="{{ $vehicle->registration_number }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <!-- Daily Rate -->
                <div>
                    <label for="daily_rate" class="block text-sm font-medium text-gray-700">Daily Rate (LKR)</label>
                    <input type="number" step="0.01" name="daily_rate" id="daily_rate" value="{{ $vehicle->daily_rate }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                
                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @foreach($statuses as $status)
                            <option value="{{ $status }}" {{ $vehicle->status == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $vehicle->description }}</textarea>
                </div>
                
                <!-- Image -->
                <div class="md:col-span-2">
                    <label for="image" class="block text-sm font-medium text-gray-700">Vehicle Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($vehicle->image)
                        <div class="mt-2">
                            <span class="text-sm text-gray-500">Current Image:</span>
                            <img src="{{ asset('storage/' . $vehicle->image) }}" alt="Vehicle Image" class="h-20 mt-1">
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update Vehicle
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- Delete Vehicle Modals -->
@foreach($vehicles as $vehicle)
<div id="deleteVehicleModal{{ $vehicle->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <div class="p-6">
            <h3 class="text-lg font-semibold">Delete Vehicle</h3>
            <p class="text-gray-700 mb-4">Are you sure you want to delete this vehicle?</p>
            <div class="bg-gray-100 p-4 rounded">
                <h4 class="font-medium">{{ $vehicle->brand }} {{ $vehicle->model }}</h4>
                <p class="text-sm text-gray-600">Registration: {{ $vehicle->registration_number }}</p>
                <p class="text-sm text-gray-600">Type: {{ $vehicle->type }}</p>
            </div>
            
            <form method="GET" action="/deleteVehicle/{{ $vehicle->id }}" class="mt-6 flex justify-end space-x-3">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Delete Vehicle
                </button>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- JavaScript to handle modals -->
<script>
    function openModal() {
        document.getElementById('addVehicleModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('addVehicleModal').classList.add('hidden');
    }

    // Prevent clicks inside the modal from closing it (optional but good practice)
    document.querySelector('#addVehicleModal > div').addEventListener('click', function(e) {
        e.stopPropagation();
    });
</script>
<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }
    
    function closeModal() {
        document.querySelectorAll('[id^="addVehicleModal"], [id^="editVehicleModal"], [id^="deleteVehicleModal"]').forEach(modal => {
            modal.classList.add('hidden');
        });
    }
    
    // Close modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('fixed')) {
            closeModal();
        }
    });
</script>
@endsection