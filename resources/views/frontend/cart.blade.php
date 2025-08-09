@extends('frontend.layouts.master')
@section('content')
  <main class="pt-5 text-light mb-5">
    <div class="mb-4 pb-4"></div>
    <section class="container">
      <h2 class="text-dark mb-4">Booking Summary</h2>
      
      <!-- Checkout Steps -->
      <div class="d-flex justify-content-between mb-5">
        <div class="d-flex align-items-center text-secondary">
          <span class="badge bg-secondary rounded-circle me-2">01</span>
          <span>
              <div>Booking Summary</div>
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
                                <!-- Display the image from cart options -->
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
                        <td class="align-middle">LKR {{ $item->subtotal }}</td>
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
                    <td class="text-end">LKR {{Cart::instance('cart')->subtotal()}}</td>
                  </tr>
                  <tr>
                    <!-- <td colspan="2">
                      <div>
                        <a href="#" class="text-primary text-decoration-none">CHANGE ADDRESS</a>
                      </div>
                    </td> -->
                  </tr>
                  <tr>
                    <td>Advance Payment</td>
                    <td class="text-end">LKR {{Cart::instance('cart')->tax()}}</td>
                  </tr>
                  <tr class="border-top border-secondary">
                    <th>Total</th>
                    <th class="text-end text-primary">LKR {{Cart::instance('cart')->total()}}</th>
                  </tr>
                    <tr class="border-top border-secondary">
                    <td>Pay Advance</td>
                    <td class="text-end">LKR {{Cart::instance('cart')->tax()}}</td>
                  </tr>
                </tbody>
              </table>

              <a href="checkout.html" class="btn btn-secondary w-100 mt-4 py-3">
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
            $('.remove-cart').on('click',function(){                
                $(this).closest('form').submit();
            });                         
        });
    </script>    
@endpush