@extends('frontend.layouts.master')

@section('content')

  <!-- About Us Section -->
  <section class="container my-5">
    <div class="text-center mb-4">
      <h1 class="display-5 fw-bold">About Heavy Duty Hire</h1>
      <p class="lead text-muted">Powering Progress with Reliable Equipment</p>
    </div>

    <div class="row align-items-center mb-5">
      <div class="col-md-6">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQG5KAsyYbu45DEQbJMyNgcFfBwURHG_k-g5A&s" class="img-fluid rounded" alt="Our Mission">
      </div>
      <div class="col-md-6">
        <h3>Our Mission</h3>
        <p class="fs-5">
          At Heavy Duty Hire, our mission is to empower construction, transport, and logistics companies with access to high-performance equipment on-demand. We pride ourselves on availability, trust, and operational excellence.
        </p>
      </div>
    </div>

    <div class="row align-items-center flex-md-row-reverse mb-5">
      <div class="col-md-6">
        <img src="https://www.familyhandyman.com/wp-content/uploads/2023/08/GettyImages-105646181.jpg?fit=700%2C465" class="img-fluid rounded" alt="Vision">
      </div>
      <div class="col-md-6">
        <h3>Our Vision</h3>
        <p class="fs-5">
          We aim to be Sri Lanka's most trusted name in heavy-duty machinery rental. <br>
          delivering value, durability, and 24/7 support to help you build the future.
        </p>
      </div>
    </div>

    <!-- Highlights or Timeline -->
    <div class="bg-dark text-white p-4 rounded">
      <h4 class="text-center">Our Journey</h4>
      <ul class="timeline list-unstyled">
        <li class="mb-3">
          <strong>2020</strong> - Founded with 5 core vehicles and a team of 3.
        </li>
        <li class="mb-3">
          <strong>2022</strong> - Crossed 500 successful rental jobs across 4 provinces.
        </li>
        <li class="mb-3">
          <strong>2024</strong> - Over 100+ machines and counting. Trusted by top contractors.
        </li>
        <li>
          <strong>2025</strong> - Launched online booking.
        </li>
      </ul>
    </div>
  </section>

  <!-- Our Values -->
  <section class="container my-5">
    <div class="text-center mb-4">
      <h2 class="fw-bold">What We Stand For</h2>
    </div>
    <div class="row text-center">
      <div class="col-md-4">
        <i class="fa-solid fa-shield-halved fs-1 mb-3 text-primary"></i>
        <h5>Safety First</h5>
        <p>We ensure all equipment is inspected and serviced before each hire.</p>
      </div>
      <div class="col-md-4">
        <i class="fa-solid fa-headset fs-1 mb-3 text-success"></i>
        <h5>24/7 Support</h5>
        <p>Round-the-clock customer assistance, whenever you need us.</p>
      </div>
      <div class="col-md-4">
        <i class="fa-solid fa-gears fs-1 mb-3 text-warning"></i>
        <h5>Technical Excellence</h5>
        <p>Only the best-in-class machines from trusted manufacturers.</p>
      </div>
    </div>
  </section>

@endsection