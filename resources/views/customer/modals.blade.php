@section('modals')
    <!-- View Vehicle Modal -->
    <div id="viewVehicleModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Vehicle Details</h3>
                    <div id="vehicleDetailsContent" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Content will be loaded via AJAX -->
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closeModal('viewVehicleModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Vehicle Modal -->
    <div id="editVehicleModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- Similar structure to view modal -->
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Backdrop -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <!-- Modal content -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <form id="editVehicleForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Edit Vehicle</h3>
                        <div id="editVehicleContent" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Content will be loaded via AJAX -->
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Save Changes
                        </button>
                        <button type="button" onclick="closeModal('editVehicleModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Archive Vehicle Modal -->
    <div id="archiveVehicleModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="archiveVehicleForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Archive Vehicle</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500" id="archiveVehicleMessage">
                                        Are you sure you want to archive this vehicle? This action cannot be undone.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Archive
                        </button>
                        <button type="button" onclick="closeModal('archiveVehicleModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@section('scripts')
<script>
    // Modal control functions
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // View Vehicle
    document.querySelectorAll('[data-view-vehicle]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const vehicleId = this.getAttribute('data-vehicle-id');
            
            // Fetch vehicle details via AJAX
            fetch(`/renter/vehicles/${vehicleId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('vehicleDetailsContent').innerHTML = `
                        <div>
                            <h4 class="font-semibold">Basic Information</h4>
                            <p><span class="font-medium">Brand:</span> ${data.brand}</p>
                            <p><span class="font-medium">Model:</span> ${data.model}</p>
                            <p><span class="font-medium">Type:</span> ${data.type}</p>
                            <p><span class="font-medium">Registration:</span> ${data.registration_number}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold">Pricing & Status</h4>
                            <p><span class="font-medium">Daily Rate:</span> $${data.daily_rate}</p>
                            <p><span class="font-medium">Status:</span> <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusClass(data.status)}">${data.status.charAt(0).toUpperCase() + data.status.slice(1)}</span></p>
                            <p><span class="font-medium">Description:</span> ${data.description || 'N/A'}</p>
                        </div>
                        <div class="md:col-span-2">
                            <h4 class="font-semibold">Images</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                ${data.images.length > 0 ? 
                                    data.images.map(image => `<img src="/storage/${image.path}" alt="Vehicle Image" class="rounded h-24 object-cover">`).join('') : 
                                    '<p>No images available</p>'}
                            </div>
                        </div>
                    `;
                    openModal('viewVehicleModal');
                });
        });
    });

    // Edit Vehicle
    document.querySelectorAll('[data-edit-vehicle]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const vehicleId = this.getAttribute('data-vehicle-id');
            
            fetch(`/renter/vehicles/${vehicleId}/edit`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('editVehicleContent').innerHTML = html;
                    document.getElementById('editVehicleForm').action = `/renter/vehicles/${vehicleId}`;
                    openModal('editVehicleModal');
                });
        });
    });

    // Archive Vehicle
    document.querySelectorAll('[data-archive-vehicle]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const vehicleId = this.getAttribute('data-vehicle-id');
            const vehicleName = this.getAttribute('data-vehicle-name');
            
            document.getElementById('archiveVehicleMessage').textContent = 
                `Are you sure you want to archive ${vehicleName}? This action cannot be undone.`;
            document.getElementById('archiveVehicleForm').action = `/renter/vehicles/${vehicleId}`;
            openModal('archiveVehicleModal');
        });
    });

    // Helper function for status classes
    function getStatusClass(status) {
        switch(status) {
            case 'available': return 'bg-green-100 text-green-800';
            case 'maintenance': return 'bg-yellow-100 text-yellow-800';
            default: return 'bg-red-100 text-red-800';
        }
    }
</script>
@endsection

@endsection