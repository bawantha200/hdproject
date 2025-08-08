@extends('admin.layouts.master')
@section('content')
<div class="p-4 w-full md:w-9/12 lg:w-10/12">
    <h2 class="text-2xl font-bold">Users</h2>
</div>

@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        {{session('success')}}
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif 

<button type="button" class="bg-gray-800 text-white px-4 py-2 rounded mb-4 hover:bg-gray-700 transition-colors" onclick="openModal('addUserModal')">
    Add New User
</button>

<!-- Add User Modal -->
<div id="addUserModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 opacity-0 invisible transition-all duration-300 ease-in-out">
    <div class="bg-white rounded-lg shadow-xl transform transition-all duration-300 ease-in-out max-w-md w-full scale-95">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-lg font-medium">Add New User</h3>
        </div>
        <form action="/saveUser" method="POST" enctype="multipart/form-data" class="p-4">
            @csrf
            <div class="space-y-1">
                <!--first name-->
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Enter First Name" 
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!--last name-->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name" 
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!--email-->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">User E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Enter User E-mail" 
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!--password-->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">User Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter User Password" 
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!--phone-->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone No</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter Phone No" 
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!--address-->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" id="address" name="address" placeholder="Enter Address" 
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!--roles-->
                <div>
                    <label for="roles" class="block text-sm font-medium text-gray-700">User Roles</label>
                    <select name="roles[]" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                        <option value="{{$role}}">{{$role}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex justify-end space-x-2 mt-4 border-t pt-4">
                <button type="button" onclick="closeModal('addUserModal')" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                    Close
                </button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                    Add User
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Users Table -->
<div class="bg-white shadow rounded-lg overflow-hidden mb-4">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User E-mail</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Roles</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($users as $user)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$user->id}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$user->first_name}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$user->email}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    @foreach($user->roles as $role)
                    {{$role->name}}
                    @endforeach
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <button type="button" onclick="openModal('editUserModal{{$user->id}}')" class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">Edit</button>
                    <button type="button" onclick="openModal('deleteUserModal{{$user->id}}')" class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">Delete</button>
                    <!-- <a href="/deleteUser/{{$user->id}}" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Delete</a> -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Edit User Modals -->
@foreach($users as $user)
<div id="editUserModal{{$user->id}}" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 opacity-0 invisible transition-all duration-300 ease-in-out">
    <div class="bg-white rounded-lg shadow-xl transform transition-all duration-300 ease-in-out max-w-md w-full scale-95">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-lg font-medium">Edit User {{$user->name}}</h3>
        </div>
        <form method="POST" action="/updateUser" class="p-4">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">User Role</label>
                <select name="role" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Select Role</option>
                    @foreach($roles as $role)
                        <option value="{{ $role }}" {{ $user->hasRole($role) ? 'selected' : '' }}>
                            {{ $role }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="flex justify-end space-x-2 mt-4 border-t pt-4">
                <button type="button" onclick="closeModal('editUserModal{{$user->id}}')" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                    Close
                </button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach


<!-- Delete User Modals -->
@foreach($users as $user)
<div id="deleteUserModal{{$user->id}}" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 opacity-0 invisible transition-all duration-300 ease-in-out">
    <div class="bg-white rounded-lg shadow-xl transform transition-all duration-300 ease-in-out scale-50">
        <div class="flex justify-center items-center border-b p-4">
            <div>
                <div class="flex justify-center items-center mb-2">
                    <h3 class="text-lg font-medium">Delete User {{$user->name}}</h3>
                </div>
                
                <div class="flex gap-5">
                    <a href="/deleteUser/{{ $user->id }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors inline-block">
                        Yes
                    </a>
                    <button type="button" onclick="closeModal('deleteUserModal{{$user->id}}')" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                            No
                    </button>
                </div>
            </div>
            
            
        </div>
        
    </div>
</div>
@endforeach

<script>
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('invisible', 'opacity-0');
        modal.classList.add('visible', 'opacity-100');
        
        const modalContent = modal.querySelector('div');
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('visible', 'opacity-100');
        modal.classList.add('invisible', 'opacity-0');
        
        const modalContent = modal.querySelector('div');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
    }
</script>

@endsection