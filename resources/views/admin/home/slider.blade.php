@extends('admin.layouts.master')
@section('content')

<div class="p-4 md:p-6 lg:p-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Slider Manager</h2>
        <button type="button" 
                class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition-colors shadow-sm"
                data-bs-toggle="modal" 
                data-bs-target="#exampleModal">
            Add New Slide
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
    
    <!-- Add Slider Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-white rounded-lg shadow-xl">
                <div class="modal-header border-b p-4">
                    <h1 class="text-xl font-semibold text-gray-800" id="exampleModalLabel">Add New Slider</h1>
                    <button type="button" class="text-gray-500 hover:text-gray-700" data-bs-dismiss="modal">
                        &times;
                    </button>
                </div>
                <form action="/saveSlider" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Heading -->
                            <div class="mb-4">
                                <label for="heading" class="block text-gray-700 font-medium mb-2">Heading</label>
                                <input type="text" 
                                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       id="heading" 
                                       name="heading" 
                                       placeholder="Enter Heading">
                            </div>
                            
                            <!-- Sub Heading -->
                            <div class="mb-4">
                                <label for="sub_heading" class="block text-gray-700 font-medium mb-2">Sub Heading</label>
                                <input type="text" 
                                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       id="sub_heading" 
                                       name="sub_heading" 
                                       placeholder="Enter Sub Heading">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Button Name -->
                            <div class="mb-4">
                                <label for="btn_name" class="block text-gray-700 font-medium mb-2">Button Name</label>
                                <input type="text" 
                                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       id="btn_name" 
                                       name="btn_name" 
                                       placeholder="Enter Button Name">
                            </div>
                            
                            <!-- More Info Link -->
                            <div class="mb-4">
                                <label for="more_info_link" class="block text-gray-700 font-medium mb-2">More Info Link</label>
                                <input type="url" 
                                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                       id="more_info_link" 
                                       name="more_info_link" 
                                       placeholder="https://example.com">
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label for="image_upload" class="block text-gray-700 font-medium mb-2">Image Upload</label>
                            <input type="file" 
                                   class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                   id="image_upload" 
                                   name="image_upload">
                            <p class="mt-1 text-sm text-gray-500">Recommended size: 1920x1080 pixels</p>
                        </div>
                    </div>
                    <div class="modal-footer border-t p-4 flex justify-end space-x-2">
                        <button type="button" 
                                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md transition-colors" 
                                data-bs-dismiss="modal">Close</button>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors">
                            Add Slider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-8">
        <h4 class="text-lg font-semibold text-gray-700 mb-4">Home Page Carousel Slides</h4>
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Heading</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sub Heading</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Button</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($sliders as $slider)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$slider->heading}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$slider->sub_heading}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$slider->btn_name}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img class="h-16 w-auto object-cover rounded" src="{{asset('storage/'.$slider->image_link)}}" alt="Slider Image">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-500 hover:text-blue-700">
                            <a href="{{$slider->more_info_link}}" target="_blank" class="truncate max-w-xs block">
                                {{ Str::limit($slider->more_info_link, 20) }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <div class="flex space-x-2">
                                <button type="button" 
                                        class="px-3 py-1 bg-gray-800 hover:bg-gray-700 text-white rounded-md transition-colors"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#slideModal{{$slider->id}}">
                                    Edit
                                </button>
                                <!-- Uncomment to enable delete -->
                                <!-- <a href="{{ route('slider.delete', $slider->id) }}" 
                                   class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md transition-colors">
                                    Delete
                                </a> -->
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Slider Modal -->
                    <div class="modal fade" id="slideModal{{$slider->id}}" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content bg-white rounded-lg shadow-xl">
                                <div class="modal-header border-b p-4">
                                    <h5 class="text-xl font-semibold text-gray-800">Edit Slide #{{$slider->id}}</h5>
                                    <button type="button" class="text-gray-500 hover:text-gray-700" data-bs-dismiss="modal">
                                        &times;
                                    </button>
                                </div>
                                <form action="/sliderUpdate" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="slider_id" value="{{$slider->id}}">
                                    <div class="modal-body p-4 space-y-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <!-- Heading -->
                                            <div class="mb-4">
                                                <label for="heading" class="block text-gray-700 font-medium mb-2">Heading</label>
                                                <input type="text" 
                                                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                                       id="heading" 
                                                       name="heading" 
                                                       value="{{$slider->heading}}">
                                            </div>
                                            
                                            <!-- Sub Heading -->
                                            <div class="mb-4">
                                                <label for="sub_heading" class="block text-gray-700 font-medium mb-2">Sub Heading</label>
                                                <input type="text" 
                                                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                                       id="sub_heading" 
                                                       name="sub_heading" 
                                                       value="{{$slider->sub_heading}}">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <!-- Button Name -->
                                            <div class="mb-4">
                                                <label for="btn_name" class="block text-gray-700 font-medium mb-2">Button Name</label>
                                                <input type="text" 
                                                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                                       id="btn_name" 
                                                       name="btn_name" 
                                                       value="{{$slider->btn_name}}">
                                            </div>
                                            
                                            <!-- More Info Link -->
                                            <div class="mb-4">
                                                <label for="more_info_link" class="block text-gray-700 font-medium mb-2">More Info Link</label>
                                                <input type="url" 
                                                       class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                                       id="more_info_link" 
                                                       name="more_info_link" 
                                                       value="{{$slider->more_info_link}}">
                                            </div>
                                        </div>

                                        <!-- Image Upload -->
                                        <div class="mb-4">
                                            <label for="image_upload" class="block text-gray-700 font-medium mb-2">Image Upload</label>
                                            <input type="file" 
                                                   class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                                   id="image_upload" 
                                                   name="image_upload">
                                            <p class="mt-1 text-sm text-gray-500">Current image: 
                                                <a href="{{asset('storage/'.$slider->image_link)}}" target="_blank" class="text-blue-500 hover:text-blue-700">
                                                    View Image
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-t p-4 flex justify-end space-x-2">
                                        <button type="button" 
                                                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md transition-colors" 
                                                data-bs-dismiss="modal">Close</button>
                                        <button type="submit" 
                                                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors">
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