@extends('admin.layouts.master')
@section('content')

<div class="p-4 md:p-6 lg:p-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Permissions</h2>
        <button type="button" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition-colors" 
                data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add New Permission
        </button>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            <div class="flex justify-between items-center">
                <p>{{session('success')}}</p>
                <button type="button" class="text-green-700 hover:text-green-900" data-bs-dismiss="alert">
                    &times;
                </button>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- Add Permission Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-white rounded-lg shadow-xl">
                <div class="modal-header border-b p-4">
                    <h1 class="text-xl font-semibold text-gray-800" id="exampleModalLabel">Add New Permission</h1>
                    <button type="button" class="text-gray-500 hover:text-gray-700" data-bs-dismiss="modal">
                        &times;
                    </button>
                </div>
                <form action="/savePermission" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-4">
                            <label for="permission_name" class="block text-gray-700 font-medium mb-2">Name</label>
                            <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   id="permission_name" name="permission_name" placeholder="Enter Permission Name">
                        </div>
                    </div>
                    <div class="modal-footer border-t p-4 flex justify-end space-x-2">
                        <button type="button" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md transition-colors" 
                                data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors">
                            Add Permission
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-8">
        <h4 class="text-lg font-semibold text-gray-700 mb-4">Permissions List</h4>
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Permission Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($permissions as $permission)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$permission->id}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$permission->name}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <button type="button" class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors"
                                        data-bs-toggle="modal" data-bs-target="#slideModal{{$permission->id}}">
                                    Edit
                                </button>
                                <a href="/deletePermission/{{$permission->id}}" 
                                   class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md transition-colors">
                                    Delete
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Permission Modal -->
                    <div class="modal fade" id="slideModal{{$permission->id}}" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-white rounded-lg shadow-xl">
                                <div class="modal-header border-b p-4">
                                    <h5 class="text-xl font-semibold text-gray-800">Edit Permission {{$permission->name}}</h5>
                                    <button type="button" class="text-gray-500 hover:text-gray-700" data-bs-dismiss="modal">
                                        &times;
                                    </button>
                                </div>
                                <form method="POST" action="/updatePermission">
                                    @csrf
                                    <input type="hidden" name="permission_id" value="{{$permission->id}}">
                                    <div class="modal-body p-4">
                                        <div class="mb-4">
                                            <label for="permission_name" class="block text-gray-700 font-medium mb-2">Name</label>
                                            <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                                   id="permission_name" name="permission_name" value="{{$permission->name}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer border-t p-4 flex justify-end space-x-2">
                                        <button type="button" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md transition-colors" 
                                                data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection