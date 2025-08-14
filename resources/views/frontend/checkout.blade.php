@extends('frontend.layouts.master')
@section('content')
  <main class="pt-5 mb-5">
    <div class="mb-4 pb-4"></div>
    <section class="container">
      <h2 class="mb-4">Complete Your Booking</h2>
      
      <!-- Checkout Steps -->
      <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
        <div class="d-flex align-items-center mb-3 mb-md-0 text-muted">
          <span class="badge bg-secondary rounded-circle me-2">01</span>
          <span>
              <div>Booking Summary</div>
              <small class="text-muted">Manage your reservation details</small>
          </span>
        </div>
        <div class="d-flex align-items-center mb-3 mb-md-0 text-primary">
          <span class="badge bg-primary rounded-circle me-2">02</span>
          <span>
              <div class="fw-bold">Payment & Booking</div>
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
        <!-- Checkout Form -->
        <div class="col-lg-8 pe-lg-4">
          <div class="card mb-4">
            <div class="card-header bg-white">
              <h5 class="mb-0">Billing & Rental Details</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('cart.place.order') }}" method="POST" id="checkoutForm">
                @csrf
                
                <!-- Rental Period -->
                <div class="mb-4 p-3 bg-light rounded">
                  <h6 class="mb-3">Rental Period</h6>
                  <div class="row">
                    <div class="col-md-6">
                      <p class="mb-1"><strong>Pickup:</strong> {{ \Carbon\Carbon::parse($bookingDates['from_date'])->format('M d, Y h:i A') }}</p>
                    </div>
                    <div class="col-md-6">
                      <p class="mb-1"><strong>Return:</strong> {{ \Carbon\Carbon::parse($bookingDates['to_date'])->format('M d, Y h:i A') }}</p>
                    </div>
                    <div class="col-12">
                      <p class="mb-0"><strong>Duration:</strong> {{ $calculations['days'] }} day(s)</p>
                    </div>
                  </div>
                </div>

                <!-- Billing Information -->
                <h6 class="mb-3">Billing Information</h6>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label for="firstName" class="form-label">First name</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="{{ Auth::user()->first_name ?? '' }}" required>
                  </div>
                  <div class="col-12">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone"
                           value="{{ $address->phone ?? '' }}" required>
                  </div>
                  
                  <!-- Address Fields -->
                  <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                           value="{{ $address->address ?? '' }}" required>
                  </div>
                  <div class="col-md-6">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city"
                           value="{{ $address->city ?? '' }}" required>
                  </div>

                  <!-- Payment Method -->
                  <hr class="my-4">
                  <h5 class="mb-3">Payment Method</h5>

                  <div class="form-check mb-2">
                    <input id="credit" name="mode" type="radio" value="card" 
                           class="form-check-input" checked required>
                    <label class="form-check-label" for="credit">Credit card</label>
                  </div>
                  
                  <!-- <div class="row mt-3" id="creditCardFields">
                    <div class="col-12">
                      <label for="cc-name" class="form-label">Name on card</label>
                      <input type="text" class="form-control" id="cc-name" name="cc_name" required>
                      <small class="text-muted">Full name as displayed on card</small>
                    </div>
                    <div class="col-12 mt-3">
                      <label for="cc-number" class="form-label">Credit card number</label>
                      <input type="text" class="form-control" id="cc-number" name="cc_number" required>
                    </div>
                    <div class="col-md-6 mt-3">
                      <label for="cc-expiration" class="form-label">Expiration</label>
                      <input type="text" class="form-control" id="cc-expiration" 
                             name="cc_expiration" placeholder="MM/YY" required>
                    </div>
                    <div class="col-md-6 mt-3">
                      <label for="cc-cvv" class="form-label">CVV</label>
                      <input type="text" class="form-control" id="cc-cvv" name="cc_cvv" required>
                    </div>
                  </div> -->


                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4 mt-4 mt-lg-0">
          <div class="card border-primary">
            <div class="card-header bg-white">
              <h5 class="mb-0">Booking Summary</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-borderless">
                  <tbody>
                    @foreach($items as $item)
                    <tr>
                      <td>
                        <img src="{{ $item->options->image }}" alt="{{ $item->name }}" 
                             class="img-thumbnail" style="width: 80px; height: auto;">
                      </td>
                      <td>
                        <h6 class="mb-1">{{ $item->name }}</h6>
                        <small class="text-muted">{{ $item->options->category }}</small>
                      </td>
                      <td class="text-start">
                        <h6 class="mb-1">LKR</h6>
                        <small class="text-muted">{{ number_format($item->price, 2) }}</small>

                      </td>
                      <td class="text-start">
                        <h6 class="mb-1">Days</h6>
                        <small class="text-muted">{{ $calculations['days'] }}</small>

                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <table class="table table-borderless mt-3">
                <tbody>
                  <tr>
                    <td>Subtotal</td>
                    <td class="text-end">LKR {{ number_format($calculations['subtotal'], 2) }}</td>
                  </tr>
                  <tr>
                    <td>Tax ({{ config('cart.tax', 15) }}%)</td>
                    <td class="text-end">LKR {{ number_format($calculations['tax'], 2) }}</td>
                  </tr>
                  <tr class="border-top">
                    <th>Total</th>
                    <th class="text-end">LKR {{ number_format($calculations['total'], 2) }}</th>
                  </tr>
                  <tr class="border-top">
                    <th>Advance Payment (30%)</th>
                    <th class="text-end text-primary">LKR {{ number_format($calculations['advance_payment'], 2) }}</th>
                  </tr>
                  <tr>
                    <td>Balance to Pay Later</td>
                    <td class="text-end">LKR {{ number_format($calculations['balance'], 2) }}</td>
                  </tr>
                </tbody>
              </table>

              <div class="bg-light p-3 mt-3 mb-4 rounded">
                <h5 class="text-primary">Pay Now</h5>
                <h4 class="text-primary">LKR {{ number_format($calculations['payable_amount'], 2) }}</h4>
              </div>

              <button type="submit" form="checkoutForm" class="btn btn-primary w-100 py-3">
                COMPLETE BOOKING
              </button>
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
        <a href="{{route('vehicles')}}" class="btn btn-primary">
          Browse Vehicles
        </a>
      </div>
      @endif
    </section>
  </main>
@endsection

@push('scripts')
    <script>
        $(function(){
            // Toggle payment method fields
            $('input[name="payment_method"]').change(function(){
                if($(this).val() === 'credit_card') {
                    $('#creditCardFields').show();
                } else {
                    $('#creditCardFields').hide();
                }
            });

            // Form validation
            $('#checkoutForm').validate({
                rules: {
                    first_name: "required",
                    last_name: "nullable",
                    email: {
                        required: true,
                        email: true
                    },
                    phone: "required",
                    address: "required",
                    city: "required",
                    zip: "required",
                    cc_name: "required",
                    cc_number: {
                        required: true,
                        creditcard: true
                    },
                    cc_expiration: "required",
                    cc_cvv: {
                        required: true,
                        minlength: 3
                    }
                },
                messages: {
                    cc_cvv: {
                        minlength: "CVV must be at least 3 characters"
                    }
                }
            });
        });
    </script>    
@endpush