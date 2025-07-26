@extends('admin.layouts.master')
@section('content')
<div class="col-12 col-md-9 col-lg-10 p-4">
    <h2>Slider</h2>
</div>



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

@endsection

<!-- modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Slider</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/saveSlider" method="POST" enctype="multipart/form-data">

        @csrf
            <div class="modal-body">
                <!--heading-->
                <div class="mb-3">
                    <label for="heading" class="form-label">Heading</label>
                    <input type="text" class="form-control" id="heading" name="heading" placeholder="Enter Heading">
                </div>
                <!--sub heading-->
                <div class="mb-3">
                    <label for="sub_heading" class="form-label">Sub Heading</label>
                    <input type="text" class="form-control" id="sub_heading" name="sub_heading" placeholder="Enter Sub Heading">
                </div>
                <!--button name-->
                <div class="mb-3">
                    <label for="btn_name" class="form-label">Button Name</label>
                    <input type="text" class="form-control" id="btn_name" name="btn_name" placeholder="Enter Button Name">
                </div>
                <!--Image upload-->
                <div class="mb-3">
                    <label for="image_upload" class="form-label">Image Upload</label>
                    <input type="file" class="form-control" id="image_upload" name="image_upload">
                </div>
                <!--URL link-->
                <div class="mb-3">
                    <label for="more_info_link" class="form-label">More info link</label>
                    <input type="text" class="form-control" id="more_info_link" name="more_info_link" placeholder="More Info">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Slider</button>
            </div>
      </form>
      
    </div>
  </div>
</div>
<!--end modal -->



<!--add delete edit button-->
<div class="mt-5">
                    <h4>Home Page Carousel Slides</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Heading</th>
                                <th>Description</th>
                                
                                <th>Image</th>
                             
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($galleries as $gallery)
                                <tr>
                                    <td>{{$gallery->id}}</td>
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
                                    <form action="/sliderUpdate" method="POST" enctype="multipart/form-data">

                                        @csrf
                                        <input type="hidden" name="gallery" value="{{$gallery->id}}">
                                            <div class="modal-body">
                                                <!--heading-->
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="title" name="title" value="{{$gallery->title}}">
                                                </div>
                                                <!--sub heading-->
                                                <div class="mb-3">
                                                    <label for="sub_heading" class="form-label">Sub Heading</label>
                                                    <input type="text" class="form-control" id="sub_heading" name="sub_heading" value="{{$gallery->sub_heading}}">
                                                </div>
                                                <!--button name-->
                                                <div class="mb-3">
                                                    <label for="btn_name" class="form-label">Button Name</label>
                                                    <input type="text" class="form-control" id="btn_name" name="btn_name" value="{{$gallery->btn_name}}">
                                                </div>
                                                <!--Image upload-->
                                                <div class="mb-3">
                                                    <label for="image_upload" class="form-label">Image Upload</label>
                                                    <input type="file" class="form-control" id="image_upload" name="image_upload">
                                                </div>
                                                <!--URL link-->
                                                <div class="mb-3">
                                                    <label for="more_info_link" class="form-label">More info link</label>
                                                    <input type="url" class="form-control" id="more_info_link" name="more_info_link" value="{{$slider->more_info_link}}">
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