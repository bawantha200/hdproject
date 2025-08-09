@extends('admin.layouts.master')
@section('content')

<div class="p-4 w-full md:w-9/12 lg:w-10/12">
    <h2 class="text-2xl font-bold">Category</h2>
</div>

<button type="button" class="bg-gray-800 text-white px-4 py-2 rounded mb-4 hover:bg-gray-700 transition-colors" onclick="openModal('addCategoryModal')">
    Add New Category
</button>

@if (session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" Category="alert">
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

<!-- Add Category Modal -->
<div id="addCategoryModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 opacity-0 invisible transition-all duration-300 ease-in-out">
    <div class="bg-white rounded-lg shadow-xl transform transition-all duration-300 ease-in-out max-w-md w-full scale-95">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-lg font-medium">Add New Category</h3>
        </div>
        <form action="/saveCategory" method="POST" enctype="multipart/form-data" class="p-4">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter Category Name"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <div class="mb-4">
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <input type="text" id="slug" name="slug" placeholder="Enter Slug"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <input type="text" id="description" name="description" placeholder="Enter Description"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <div class="flex justify-end space-x-2 border-t pt-4">
                <button type="button" onclick="closeModal('addCategoryModal')" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                    Close
                </button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                    Add Category
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Categorys Table -->
<div class="bg-white shadow rounded-lg overflow-hidden mb-4">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category Slug</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category Description</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($categories as $category)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$category->id}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$category->name}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$category->slug}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$category->description}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 space-x-2">
                    <button type="button" onclick="openModal('editCategoryModal{{$category->id}}')" class="px-3 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">Edit</button>
                    <a href="/deleteCategory/{{$category->id}}" class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Edit Category Modals -->
@foreach($categories as $category)
<div id="editCategoryModal{{$category->id}}" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50 opacity-0 invisible transition-all duration-300 ease-in-out">
    <div class="bg-white rounded-lg shadow-xl transform transition-all duration-300 ease-in-out max-w-md w-full scale-95">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-lg font-medium">Edit Category {{$category->name}}</h3>
        </div>
        <form method="POST" action="/updateCategory" enctype="multipart/form-data" class="p-4">
            @csrf
            <input type="hidden" name="category_id" value="{{$category->id}}">
            <div class="mb-4">
                <label for="category_name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" id="category_name" name="category_name" value="{{$category->name}}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <div class="mb-4">
                <label for="category_slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <input type="text" id="category_slug" name="category_slug" value="{{$category->slug}}
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <div class="mb-4">
                <label for="category_description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <input type="text" id="category_description" name="category_description" value="{{$category->description}}
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>
            <div class="flex justify-end space-x-2 border-t pt-4">
                <button type="button" onclick="closeModal('editCategoryModal{{$category->id}}')" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
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