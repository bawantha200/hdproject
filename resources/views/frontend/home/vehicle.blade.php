 @forelse($vehicles as $vehicle)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="position-relative">
                            <img src="{{asset('storage/'.$vehicle->image)}}" class="card-img-top" alt="Dozer" style="height: 200px; object-fit: cover;">
                            <span class="badge position-absolute top-0 end-0 m-2 
    {{ $vehicle->status == 'available' ? 'bg-success' : 
       ($vehicle->status == 'maintenance' ? 'bg-warning' : 'bg-danger') }}">
    {{ ucfirst($vehicle->status) }}
</span>
                            
                            <span class="badge bg-primary position-absolute top-0 start-0 m-2">{{$vehicle->category->name}}</span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$vehicle->brand}} {{$vehicle->model}}</h5>
                            <p class="card-text text-muted">
                                <i class="fa-solid fa-circle-info"></i></i> {{$vehicle->description}}  
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="h5 text-primary">LKR {{$vehicle->daily_rate}}</span>
                                    <small class="text-muted d-block">per day</small>
                                </div>
                                <form name="addtocart-form" method="POST" action="{{ route('cart.add') }}">
                                    @csrf
                                    <div class="vehicle-single__addtocart">
                                        <input type="hidden" name="id" value="{{ $vehicle->id }}" />
                                        <input type="hidden" name="name" value="{{ $vehicle->brand }} {{ $vehicle->model }}" />
                                        <input type="hidden" name="price" value="{{ $vehicle->daily_rate }}" />                        
                                        <input type="hidden" name="category" value="{{ $vehicle->category->name }}" />
                                        <!-- Add the image path from storage -->
                                        <input type="hidden" name="image" value="{{ asset('storage/' . $vehicle->image) }}" />
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-shopping-cart"></i> Add to Cart
                                        </button>
                                    </div>
                                </form>
                                <!-- <a href="{{route('cart.add')}}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a> -->
                            </div>
                        </div>
                    </div>
                </div>
 @empty
                    <div class="col-12">
                        <div class="alert alert-info">No vehicles found matching your criteria.</div>
                    </div>
                @endforelse
