@extends('admin.layouts.master')
@section('content')

<div class="col-12 col-md-9 col-lg-10 p-4">
    <h2>Gallery</h2>
</div>
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add New Photo
</button>

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

<!-- modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Slider</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/saveGallery" method="POST" enctype="multipart/form-data">

        @csrf
            <div class="modal-body">
                <!--heading-->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                </div>
                <!--sub heading-->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
                </div>
                <!--Image upload-->
                <div class="mb-3">
                    <label for="image_upload" class="form-label">Image Upload</label>
                    <input type="file" class="form-control" id="image_upload" name="image_upload">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Image</button>
            </div>
      </form>
      
    </div>
  </div>
</div>
<!--end modal -->

<div class="mt-5">
                    <h4>Home Page Carousel Slides</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                            <tr>
                                
                                <th>Title</th>
                                <th>Description</th>
                                
                                <th>Image</th>
                             
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($galleries as $gallery)
                                <tr>
                           
                                    <td>{{$gallery->title}}</td>
                                    <td>{{$gallery->description}}</td>
                                    
                                    <td><img width="100" src="{{asset('storage/'.$gallery->image_link)}}" alt=""></td>
                                    
                                    <td><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#galleryModal{{$gallery->id}}">Edit</button>
                                    <a href="{{ route('gallery.delete', $gallery->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>


                                <!-- modal-->
                                <div class="modal fade" id="galleryModal{{$gallery->id}}" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="galleryModalLabel">Edit Slide {{$gallery->id}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/galleryUpdate" method="POST" enctype="multipart/form-data">

                                        @csrf
                                        <input type="hidden" name="gallery_id" value="{{$gallery->id}}">
                                            <div class="modal-body">
                                                <!--title-->
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="title" name="title" value="{{$gallery->title}}">
                                                </div>
                                                <!--description-->
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <input type="text" class="form-control" id="description" name="description" value="{{$gallery->description}}">
                                                </div>
                                               
                                                <!--Image upload-->
                                                <div class="mb-3">
                                                    <label for="image_upload" class="form-label">Image Upload</label>
                                                    <input type="file" class="form-control" id="image_upload" name="image_upload">
                                                </div>
                                                

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                    </form>
                                    
                                    </div>
                                </div>
                                </div>
                                <!--end modal -->

                                @endforeach

                            <!-- Add more booking rows here -->
                            </tbody>
                        </table>
                    </div>
</div>
@endsection