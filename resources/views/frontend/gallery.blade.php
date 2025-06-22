@extends('frontend.layouts.master')

@section('content')

  <div class="container my-5">
    <h2 class="text-center mb-4">Our Work Gallery</h2>
    <div class="row g-4">

      <!-- Gallery Item -->
      @include('frontend.home.image')

      

      <!-- Add more items as needed -->
    </div>
  </div>

  <!-- Image Modals -->
  <div class="modal fade" id="modal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <img src="images/gallery/img1.jpg" class="img-fluid rounded" alt="Full view">
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <img src="images/gallery/img2.jpg" class="img-fluid rounded" alt="Full view">
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal3" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <img src="images/gallery/img3.jpg" class="img-fluid rounded" alt="Full view">
      </div>
    </div>
  </div>

@endsection