 @forelse($vehicles as $vehicle)
<!-- <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Excavator" data-brand="Caterpillar" data-price="450" data-availability="available" data-location="north">
                    <div class="card h-100 vehicle-card">
                        <div class="card-body">
                            <h5 class="vehicle-title">{{$vehicle->brand}} {{$vehicle->model}}</h5>
                            <img src="{{asset('storage/'.$vehicle->image)}}" class="vehicle-img rounded mb-3" alt="">
                            <p class="card-text small text-muted">{{$vehicle->description}}</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                              <span class="badge bg-success badge-availability">{{$vehicle->status}}</span>
                              <span class="vehicle-price">LKR {{$vehicle->daily_rate}}/day</span>
                            </div>
                        </div>
                    </div>
                </div> -->
            <!-- other -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="position-relative">
                            <img src="{{asset('storage/'.$vehicle->image)}}" class="card-img-top" alt="Dozer" style="height: 200px; object-fit: cover;">
                            <span class="badge bg-success position-absolute top-0 end-0 m-2">{{$vehicle->status}}</span>
                            <span class="badge bg-primary position-absolute top-0 start-0 m-2">{{$vehicle->type}}</span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$vehicle->brand}} {{$vehicle->model}}</h5>
                            <p class="card-text text-muted">
                                <i class="fas fa-calendar-alt me-1"></i> 2018 Model
                                <br>
                                <i class="fas fa-horse-power me-1"></i> 190 HP
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h5 text-primary">LKR {{$vehicle->daily_rate}}</span>
                                    <small class="text-muted d-block">per day</small>
                                </div>
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
 @empty
                    <div class="col-12">
                        <div class="alert alert-info">No vehicles found matching your criteria.</div>
                    </div>
                @endforelse
