@extends('frontend.layouts.master')
@section('content')
  <main class="pt-5 text-light mb-5">
    <div class="mb-4 pb-4"></div>
    <section class="container">
      <h2 class="text-dark mb-4">Booking Summary</h2>
      
      <!-- Checkout Steps -->
      <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
        <div class="d-flex align-items-center mb-3 mb-md-0 text-primary">
          <span class="badge bg-primary rounded-circle me-2">01</span>
          <span>
              <div class="fw-bold">Booking Summary</div>
              <small class="text-muted">Manage your reservation details</small>
          </span>
        </div>
        <div class="d-flex align-items-center text-muted">
          <span class="badge bg-secondary rounded-circle me-2">02</span>
          <span>
              <div>Payment & Booking</div>
              <small class="text-muted">Secure Your Booking</small>
          </span>
        </div>
        <div class="d-flex align-items-center text-muted">
          <span class="badge bg-secondary rounded-circle me-2">03</span>
          <span>
              <div>Confirmation</div>
              <small class="text-muted">Review & Confirm Your Booking</small>
          </span>
        </div>
      </div>

      @if($items->count()>0)
      <div class="row">
        <!-- Cart Items -->
        <div class="col-lg-8 pe-lg-4">
          <!-- Booking Dates Section -->
          <div class="card bg-white mb-4">
              <div class="card-header bg-white">
                  <h5 class="mb-0">Select Booking Dates</h5>
              </div>
              <div class="card-body">
                  <form method="POST" action="{{ route('cart.updateDates') }}" id="bookingDatesForm">
                      @csrf
                      <div class="row">
                          <div class="col-md-6 mb-3">
                              <label for="pickupDate" class="form-label">Pickup Date</label>
                              <input type="date" class="form-control" id="pickupDate" name="pickup_date" 
                                    value="{{ $bookingDates['from_date'] }}" required>
                          </div>
                          <div class="col-md-6 mb-3">
                              <label for="returnDate" class="form-label">Return Date</label>
                              <input type="date" class="form-control" id="returnDate" name="return_date" 
                                    value="{{ $bookingDates['to_date'] }}" required>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Update Booking Dates</button>
                  </form>
                  
                  @if(isset($calculations['days']))
                  <div class="mt-3">
                      <p>Booking Duration: {{ $calculations['days'] }} day(s)</p>
                  </div>
                  <div class="d-flex gap-3 text-primary">
                    <div>
                        <p class="mb-1">From: {{ \Carbon\Carbon::parse($bookingDates['from_date'])->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="mb-0">To: {{ \Carbon\Carbon::parse($bookingDates['to_date'])->format('M d, Y') }}</p>
                    </div>
                  </div>
                  @endif
              </div>
          </div>
          
          <div class="table-responsive">
            <table class="table table-white table-hover">
              <thead class="bg-black">
                <tr>
                  <th>Image</th>
                  <th>Vehicle</th>
                  <th>Vehicle Category</th>
                  <th>Price</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($items as $item)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img 
                                src="{{ $item->options->image }}" 
                                alt="{{ $item->name }}" 
                                class="img-thumbnail" 
                                style="width: 150px; height: auto;"
                            >
                        </div>
                    </td>
                    <td class="align-middle"><h5 class="mb-1">{{ $item->name }}</h5></td>
                    <td class="align-middle">{{ $item->options->category }}</td>
                    <td class="align-middle">LKR {{ $item->price }}</td>
                    <td class="align-middle">
                        <form method="POST" action="{{ route('cart.remove', $item->rowId) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link p-0 remove-cart" title="Remove item">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="#dc3545" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.259435 12.8551L13.1145 0L14 0.885506L1.14494 13.7406L0.259435 12.8551Z"/>
                                    <path d="M0.885506 0.0889838L13.7406 12.944L12.8551 13.8295L0 0.97449L0.885506 0.0889838Z"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="d-flex justify-content-between mt-3">
            <a href="{{route('vehicles')}}" class="btn btn-outline-light bg-secondary">
              UPDATE CART
            </a>
          </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4 mt-4 mt-lg-0">
          <div class="card bg-white border-secondary">
            <div class="card-header bg-white">
              <h5 class="mb-0">Cart Totals</h5>
            </div>
            <div class="card-body">
              <table class="table table-borderless table-white mb-0">
                <tbody>
                  <tr>
                    <td>Subtotal</td>
                    <td class="text-end">LKR {{ number_format($calculations['subtotal'], 2) }}</td>
                  </tr>
                  <tr>
                    <td>Tax</td>
                    <td class="text-end">LKR {{ number_format($calculations['tax'], 2) }}</td>
                  </tr>
                  <tr class="border-top border-secondary">
                    <th>Total</th>
                    <th class="text-end text-primary">LKR {{ number_format($calculations['total'], 2) }}</th>
                  </tr>
                  <tr class="border-top border-secondary">
                    <th></th>
                  </tr>
                  <tr class="border-top border-secondary">
                    <th>Advance Payment (30%)</th>
                    <th class="text-end text-primary">LKR {{ number_format($calculations['advance_payment'], 2) }}</th>
                  </tr>
                  <tr class="border-top border-secondary">
                    <td>Balance to Pay Later</td>
                    <td class="text-end">LKR {{ number_format($calculations['balance'], 2) }}</td>
                  </tr>
                </tbody>
              </table>
              <div class="pay-advance text-primary">
                <h4>Pay Now</h4>
                <b>LKR {{ number_format($calculations['payable_amount'], 2) }}</b>
              </div>

              <a href="{{route('cart.checkout')}}" class="btn btn-secondary w-100 mt-4 py-3">
                PROCEED TO CHECKOUT
              </a>
            </div>
          </div>
        </div>
      </div>
      @else
      <div class="text-center py-5">
        <div class="display-4 text-muted mb-4">
          <i class="bi bi-cart-x"></i>
        </div>
        <h4 class="mb-4 text-secondary">No item found in your cart</h4>
        <a href="{{route('vehicles')}}" class="btn btn-dark">
          Shop Now
        </a>
      </div>
      @endif
    </section>
  </main>
@endsection

@push('scripts')
    <script>
        $(function(){
            // Set minimum date for pickup (today)
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('pickupDate').min = today;
            
            // When pickup date changes, update return date min
            $('#pickupDate').change(function() {
                const pickupDate = $(this).val();
                $('#returnDate').attr('min', pickupDate);
                
                // If return date is before pickup date, reset it
                if ($('#returnDate').val() && $('#returnDate').val() < pickupDate) {
                    $('#returnDate').val(pickupDate);
                }
            });
            
            $('.remove-cart').on('click',function(){                
                $(this).closest('form').submit();
            });
            
            // Handle booking dates form submission
            $('#bookingDatesForm').submit(function(e) {
                e.preventDefault();
                // Here you would typically send the dates to your backend
                // For now, we'll just show a success message
                alert('Booking dates updated successfully!');
            });
        });
    </script>    
@endpush