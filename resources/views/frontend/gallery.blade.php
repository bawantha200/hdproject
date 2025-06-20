@extends('frontend.layouts.master')

@section('content')

  <div class="container my-5">
    <h2 class="text-center mb-4">Our Work Gallery</h2>
    <div class="row g-4">

      <!-- Gallery Item -->
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <img src="https://cdn.buttercms.com/GJcknVUYRL2nFieD8ZGG" class="card-img-top" alt="Excavator at work" data-bs-toggle="modal" data-bs-target="#modal1">
          <div class="card-body">
            <h5 class="card-title">Excavator on Site</h5>
            <p class="card-text">A CAT 320D clearing a construction area in Colombo.</p>
          </div>
        </div>
      </div>

      <!-- Gallery Item -->
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <img src="https://i.ytimg.com/vi/jT6mIucMyBs/maxresdefault.jpg" class="card-img-top" alt="Concrete mixer pouring" data-bs-toggle="modal" data-bs-target="#modal2">
          <div class="card-body">
            <h5 class="card-title">Concrete Mixer in Action</h5>
            <p class="card-text">Supplying concrete for a multi-storey building project.</p>
          </div>
        </div>
      </div>

      <!-- Gallery Item -->
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <img src="https://waltet.co.uk/wp-content/uploads/2023/10/PXL_20230809_105654537.jpg" class="card-img-top" alt="Tipper unloading soil" data-bs-toggle="modal" data-bs-target="#modal3">
          <div class="card-body">
            <h5 class="card-title">Tipper Truck Job</h5>
            <p class="card-text">Delivering red soil to a rural site in Kurunegala.</p>
          </div>
        </div>
      </div>

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