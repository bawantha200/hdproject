@extends('frontend.layouts.master')
@section('content')
<main class="pt-5 mb-5">
  <div class="mb-4 pb-4"></div>
  <section class="container">
    <!-- Checkout Steps -->
    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
      <div class="d-flex align-items-center mb-3 mb-md-0 text-muted">
        <span class="badge bg-secondary rounded-circle me-2">01</span>
        <span>
          <div>Booking Summary</div>
          <small class="text-muted">Manage your reservation details</small>
        </span>
      </div>
      <div class="d-flex align-items-center mb-3 mb-md-0 text-muted">
        <span class="badge bg-secondary rounded-circle me-2">02</span>
        <span>
          <div>Payment & Booking</div>
          <small class="text-muted">Secure Your Booking</small>
        </span>
      </div>
      <div class="d-flex align-items-center text-primary">
        <span class="badge bg-primary rounded-circle me-2">03</span>
        <span>
          <div class="fw-bold">Confirmation</div>
          <small class="text-muted">Review & Confirm Your Booking</small>
        </span>
      </div>
    </div>

    <div class="card border-success mb-4">
      <div class="card-header bg-success text-white">
        <h4 class="mb-0"><i class="bi bi-check-circle-fill me-2"></i> Booking Confirmed</h4>
      </div>
      <div class="card-body">
        <div class="alert alert-success">
          <h5 class="alert-heading">Thank you for your booking!</h5>
          <p class="mb-0">Your booking reference number is: <strong>{{ $order->id }}</strong></p>
          <p>We've sent a confirmation phone to <strong>{{ $order->phone }}</strong></p>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4">
              <div class="card-header bg-white">
                <h5 class="mb-0">Booking Details</h5>
              </div>
              <div class="card-body">
                <h6>Order Summary</h6>
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <td>Booking Reference:</td>
                      <td class="text-end"><strong>{{ $order->id }}</strong></td>
                    </tr>
                    <tr>
                      <td>Booking Date:</td>
                      <td class="text-end">{{ $order->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                    <tr>
                      <td>Payment Status:</td>
                      <td class="text-end">
                        <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                          {{ ucfirst($order->transaction->status) }}
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td>Payment Method:</td>
                      <td class="text-end">{{ ucfirst($order->transaction->mode) }}</td>
                    </tr>
                  </tbody>
                </table>

                <h6 class="mt-4">Rental Period</h6>
                <div class="p-3 bg-light rounded">
                  <div class="row">
                    <div class="col-md-6">
                      <p class="mb-1"><strong>Pickup:</strong> {{ \Carbon\Carbon::parse($order->from_date)->format('M d') }}</p>
                     
                    </div>
                    <div class="col-md-6">
                      <p class="mb-1"><strong>Return:</strong> {{ \Carbon\Carbon::parse($order->to_date)->format('M d') }}</p>
                   
                    </div>
                    <div class="col-12">
                      <p class="mb-0"><strong>Duration:</strong> {{ $order->days }} day(s)</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card mb-4">
              <div class="card-header bg-white">
                <h5 class="mb-0">Customer Information</h5>
              </div>
              <div class="card-body">
                <h6>Billing Details</h6>
                <address>
                  <strong>{{ $order->name }}</strong><br>
                  {{ $order->email }}<br>
                  {{ $order->phone }}<br>
                  {{ $order->address }}<br>
                  {{ $order->city }}<br>
                </address>

                @if($order->special_requests)
                <h6 class="mt-4">Special Requests</h6>
                <p>{{ $order->special_requests }}</p>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header bg-white">
            <h5 class="mb-0">Vehicle Details</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Vehicle</th>
                    <th>Rental Period</th>
                    <th class="text-end">Price</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($cartItems as $item)
                  <tr>
                    <td>
                      <div class="d-flex">
                        <img src="{{ $item->options->image }}" alt="{{ $item->name }}" 
                             class="img-thumbnail me-3" style="width: 100px; height: auto;">
                        <div>
                          <h6 class="mb-1">{{ $item->name }}</h6>
                          <small class="text-muted">{{ $item->options->category }}</small>
                        </div>
                      </div>
                    </td>
                    <td>
                      {{ \Carbon\Carbon::parse($item->options->pickup_date)->format('M d, Y') }}<br>
                      to<br>
                      {{ \Carbon\Carbon::parse($item->options->return_date)->format('M d, Y') }}<br>
                      <small>{{ $order->days }} day(s)</small>
                    </td>
                    <td class="text-end">LKR {{ number_format($item->total, 2) }}</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2" class="text-end">Subtotal:</td>
                    <td class="text-end">LKR {{ number_format($order->subtotal, 2) }}</td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-end">Tax ({{ config('cart.tax', 15) }}%):</td>
                    <td class="text-end">LKR {{ number_format($order->tax, 2) }}</td>
                  </tr>
                  <tr class="border-top">
                    <td colspan="2" class="text-end"><strong>Total:</strong></td>
                    <td class="text-end"><strong>LKR {{ number_format($order->total, 2) }}</strong></td>
                  </tr>
                  <tr class="border-top">
                    <td colspan="2" class="text-end"><strong>Advance Paid (30%):</strong></td>
                    <td class="text-end text-primary"><strong>LKR {{ number_format($order->amount, 2) }}</strong></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-end">Balance Due:</td>
                    <td class="text-end">LKR {{ number_format($order->balance, 2) }}</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>

        <div class="mt-4 text-center">
          <a href="{{ route('home') }}" class="btn btn-secondary me-2">
            <i class="bi bi-person-circle me-1"></i> View in Dashboard
          </a>
          <a href="{{ route('vehicles') }}" class="btn btn-outline-secondary">
            <i class="bi bi-car-front me-1"></i> Book Another Vehicle
          </a>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection