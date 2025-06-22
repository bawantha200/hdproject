@extends('admin.layouts.master')
@section('content')

<div class="col-12 col-md-9 col-lg-10 p-4">
    <h2>Slider Manager</h2>
</div>
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add New Slide
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
                <!--Image upload-->
                <div class="mb-3">
                    <label for="image_upload" class="form-label">Image Upload</label>
                    <input type="file" class="form-control" id="image_upload" name="image_upload">
                </div>
                <!--URL link-->
                <div class="mb-3">
                    <label for="more_info_link" class="form-label">More info link</label>
                    <input type="url" class="form-control" id="more_info_link" name="more_info_link" placeholder="More Info">
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

<div class="mt-5">
                    <h4>Recent Bookings</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                            <tr>
                                <th>Heading</th>
                                <th>Sub Heading</th>
                                <th>Image</th>
                                <th>More Info Link</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{$slider->heading}}</td>
                                    <td>{{$slider->sub_heading}}</td>
                                    <td><img width="100" src="{{asset('storage/'.$slider->image_link)}}" alt=""></td>
                                    <td>{{$slider->more_info_link}}</td>
                                    <td><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#slideModal{{$slider->id}}">Edit</button>
                                    <a href="{{ route('slider.delete', $slider->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>


                                <!-- modal-->
                                <div class="modal fade" id="slideModal{{$slider->id}}" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="slideModalLabel">Edit Slide {{$slider->id}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/sliderUpdate" method="POST" enctype="multipart/form-data">

                                        @csrf
                                        <input type="hidden" name="slider_id" value="{{$slider->id}}">
                                            <div class="modal-body">
                                                <!--heading-->
                                                <div class="mb-3">
                                                    <label for="heading" class="form-label">Heading</label>
                                                    <input type="text" class="form-control" id="heading" name="heading" value="{{$slider->heading}}">
                                                </div>
                                                <!--sub heading-->
                                                <div class="mb-3">
                                                    <label for="sub_heading" class="form-label">Sub Heading</label>
                                                    <input type="text" class="form-control" id="sub_heading" name="sub_heading" value="{{$slider->sub_heading}}">
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

@endsection