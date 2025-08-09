@extends('frontend.layouts.master')

@section('content')
<!-- Vehicle Header Section -->
<section class="vehicle-header bg-dark text-white py-5 mb-4" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{asset('storage/'.$vehicle->image)}}') center/cover no-repeat;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 fw-bold mb-3">{{ $vehicle->name }}</h1>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge bg-success fs-6 py-2 px-3">
                        <i class="fas fa-check-circle me-2"></i>Available
                    </span>
                    <span class="badge bg-primary fs-6 py-2 px-3">
                        <i class="fas fa-tag me-2"></i>{{ $vehicle->category->name }}
                    </span>
                    @if($vehicle->is_featured)
                        <span class="badge bg-warning text-dark fs-6 py-2 px-3">
                            <i class="fas fa-star me-2"></i>Featured
                        </span>
                    @endif
                </div>
                <p class="lead mb-0">{{ $vehicle->short_description }}</p>
            </div>
            <div class="col-md-4 text-md-end">
                <h2 class="text-success fw-bold">LKR {{ number_format($vehicle->price_per_day, 2) }} <small class="fs-6 text-white-50">/ day</small></h2>
                <button class="btn btn-primary btn-lg px-4 py-2 mt-2">
                    <i class="fas fa-calendar-alt me-2"></i>Book Now
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<div class="container">
    <div class="row g-4">
        <!-- Left Column - Gallery and Details -->
        <div class="col-lg-8">
            <!-- Image Gallery -->
            <div class="card shadow-sm mb-4">
                <div class="card-body p-0">
                    <div class="ratio ratio-16x9">
                        <img src="{{ asset($vehicle->featured_image) }}" class="img-fluid rounded-top" alt="{{ $vehicle->name }}" id="mainVehicleImage">
                    </div>
                </div>
                @if(count($vehicle->gallery) > 0)
                <div class="card-footer bg-light">
                    <h5 class="mb-3"><i class="fas fa-images text-primary me-2"></i>Gallery</h5>
                    <div class="row g-2">
                        @foreach($vehicle->gallery as $image)
                        <div class="col-4 col-md-3">
                            <img src="{{ asset($image) }}" class="img-thumbnail cursor-pointer" style="height: 100px; object-fit: cover;" onclick="document.getElementById('mainVehicleImage').src = this.src">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Specifications Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-list-alt text-primary me-2"></i>Specifications</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong><i class="fas fa-tag text-muted me-2"></i>Type:</strong> {{ $vehicle->type }}</li>
                                <li class="mb-2"><strong><i class="fas fa-industry text-muted me-2"></i>Brand:</strong> {{ $vehicle->brand }}</li>
                                <li class="mb-2"><strong><i class="fas fa-barcode text-muted me-2"></i>Model:</strong> {{ $vehicle->model }}</li>
                                <li class="mb-2"><strong><i class="fas fa-calendar text-muted me-2"></i>Year:</strong> {{ $vehicle->year }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong><i class="fas fa-weight text-muted me-2"></i>Operating Weight:</strong> {{ $vehicle->weight }} kg</li>
                                <li class="mb-2"><strong><i class="fas fa-bolt text-muted me-2"></i>Engine Power:</strong> {{ $vehicle->power }} kW</li>
                                <li class="mb-2"><strong><i class="fas fa-shovel text-muted me-2"></i>Bucket Capacity:</strong> {{ $vehicle->bucket_capacity }} m³</li>
                                <li class="mb-2"><strong><i class="fas fa-clock text-muted me-2"></i>Hours:</strong> {{ $vehicle->operating_hours }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-align-left text-primary me-2"></i>Description</h5>
                </div>
                <div class="card-body">
                    <p>{{ $vehicle->description }}</p>
                </div>
            </div>

            <!-- Features Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-cogs text-primary me-2"></i>Features</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($vehicle->features as $feature)
                        <div class="col-md-6 mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>{{ $feature }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Booking and Contact -->
        <div class="col-lg-4">
            <!-- Pricing Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-tags me-2"></i>Pricing</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Daily Rate
                            <span class="badge bg-primary rounded-pill">LKR {{ number_format($vehicle->price_per_day, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Weekly Rate
                            <span class="badge bg-primary rounded-pill">LKR {{ number_format($vehicle->price_per_week, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Monthly Rate
                            <span class="badge bg-primary rounded-pill">LKR {{ number_format($vehicle->price_per_month, 2) }}</span>
                        </li>
                    </ul>
                    <button class="btn btn-primary w-100 mt-3 py-2">
                        <i class="fas fa-calendar-check me-2"></i>Check Availability
                    </button>
                </div>
            </div>

            <!-- Contact Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-phone-alt me-2"></i>Contact</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6><i class="fas fa-phone me-2"></i>Phone</h6>
                        <p class="ms-4">{{ $vehicle->contact_phone }}</p>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-envelope me-2"></i>Email</h6>
                        <p class="ms-4">{{ $vehicle->contact_email }}</p>
                    </div>
                    <div class="mb-3">
                        <h6><i class="fas fa-map-marker-alt me-2"></i>Location</h6>
                        <p class="ms-4">{{ $vehicle->location }}</p>
                    </div>
                    <button class="btn btn-success w-100 py-2" data-bs-toggle="modal" data-bs-target="#contactModal">
                        <i class="fas fa-paper-plane me-2"></i>Send Inquiry
                    </button>
                </div>
            </div>

            <!-- Similar Vehicles -->
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-truck-monster text-primary me-2"></i>Similar Vehicles</h5>
                </div>
                <div class="card-body">
                    @foreach($similarVehicles as $similar)
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset($similar->thumbnail) }}" class="img-fluid rounded-start" alt="{{ $similar->name }}" style="height: 100%; object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body py-2">
                                    <h6 class="card-title">{{ $similar->name }}</h6>
                                    <p class="card-text text-success mb-1">LKR {{ number_format($similar->price_per_day, 2) }}/day</p>
                                    <a href="{{ route('vehicles.show', $similar->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="contactModalLabel">Send Inquiry</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('inquiries.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3">I'm interested in the {{ $vehicle->name }}. Please contact me with more details.</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
    .vehicle-header {
        padding: 5rem 0;
    }
    .cursor-pointer {
        cursor: pointer;
    }
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    .list-group-item {
        padding: 0.75rem 0;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Gallery image click handler
    document.querySelectorAll('.gallery-thumb').forEach(thumb => {
        thumb.addEventListener('click', function() {
            document.getElementById('mainVehicleImage').src = this.src;
        });
    });
</script>
@endsection