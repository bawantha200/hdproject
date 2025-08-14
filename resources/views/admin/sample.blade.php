@extends('admin.layouts.master')
@section('content')
<div class="col-12 col-md-9 col-lg-10 p-4">
    <h2>Slider</h2>
</div>



@if (session('success'))
    <div class="alert alert-success alet-dismissible fade show" role="alert">
        {{session('success')}}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>
                {{$error}}
            </li>
            @endforeach
        </ul>
    </div>
@endif

@endsection

<!-- modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Slider</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/saveSlider" method="POST" enctype="multipart/form-data">

        @csrf
            <div class="modal-body">
                <!--heading-->
                <div class="mb-3">
                    <label for="heading" class="form-label">Heading</label>
                    <input type="text" class="form-control" id="heading" name="heading" placeholder="Enter Heading">
                </div>
                <!--sub heading-->
                <div class="mb-3">
                    <label for="sub_heading" class="form-label">Sub Heading</label>
                    <input type="text" class="form-control" id="sub_heading" name="sub_heading" placeholder="Enter Sub Heading">
                </div>
                <!--button name-->
                <div class="mb-3">
                    <label for="btn_name" class="form-label">Button Name</label>
                    <input type="text" class="form-control" id="btn_name" name="btn_name" placeholder="Enter Button Name">
                </div>
                <!--Image upload-->
                <div class="mb-3">
                    <label for="image_upload" class="form-label">Image Upload</label>
                    <input type="file" class="form-control" id="image_upload" name="image_upload">
                </div>
                <!--URL link-->
                <div class="mb-3">
                    <label for="more_info_link" class="form-label">More info link</label>
                    <input type="text" class="form-control" id="more_info_link" name="more_info_link" placeholder="More Info">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Slider</button>
            </div>
      </form>
      
    </div>
  </div>
</div>
<!--end modal -->



<!--add delete edit button-->
<div class="mt-5">
                    <h4>Home Page Carousel Slides</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Heading</th>
                                <th>Description</th>
                                
                                <th>Image</th>
                             
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($galleries as $gallery)
                                <tr>
                                    <td>{{$gallery->id}}</td>
                                    <td>{{$gallery->title}}</td>
                                    <td>{{$gallery->description}}</td>
                                    
                                    <td><img width="100" src="{{asset('storage/'.$gallery->image_link)}}" alt=""></td>
                                    
                                    <td><button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#galleryModal{{$gallery->id}}">Edit</button>
                                    <a href="{{ route('gallery.delete', $gallery->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>


                                <!-- modal-->
                                <div class="modal fade" id="galleryModal{{$gallery->id}}" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="galleryModalLabel">Edit Slide {{$gallery->id}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="/sliderUpdate" method="POST" enctype="multipart/form-data">

                                        @csrf
                                        <input type="hidden" name="gallery" value="{{$gallery->id}}">
                                            <div class="modal-body">
                                                <!--heading-->
                                                <div class="mb-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="title" name="title" value="{{$gallery->title}}">
                                                </div>
                                                <!--sub heading-->
                                                <div class="mb-3">
                                                    <label for="sub_heading" class="form-label">Sub Heading</label>
                                                    <input type="text" class="form-control" id="sub_heading" name="sub_heading" value="{{$gallery->sub_heading}}">
                                                </div>
                                                <!--button name-->
                                                <div class="mb-3">
                                                    <label for="btn_name" class="form-label">Button Name</label>
                                                    <input type="text" class="form-control" id="btn_name" name="btn_name" value="{{$gallery->btn_name}}">
                                                </div>
                                                <!--Image upload-->
                                                <div class="mb-3">
                                                    <label for="image_upload" class="form-label">Image Upload</label>
                                                    <input type="file" class="form-control" id="image_upload" name="image_upload">
                                                </div>
                                                <!--URL link-->
                                                <div class="mb-3">
                                                    <label for="more_info_link" class="form-label">More info link</label>
                                                    <input type="url" class="form-control" id="more_info_link" name="more_info_link" value="{{$slider->more_info_link}}">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                    </form>
                                    
                                    </div>
                                </div>
                                </div>
                                <!--end modal -->

                                @endforeach

                            <!-- Add more booking rows here -->
                            </tbody>
                        </table>
                    </div>
</div>


<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::instance('cart')->content();
        
        // Get booking dates from session or set defaults
        $bookingDates = [
            'from_date' => session('booking_from_date', Carbon::today()->toDateString()),
            'to_date' => session('booking_to_date', Carbon::tomorrow()->toDateString())
        ];
        
        // Calculate cart totals with advance payment
        $calculations = $this->calculateCartWithAdvance($bookingDates);
        
        return view('frontend.cart', compact('items', 'calculations', 'bookingDates'));
    }
    
    protected function calculateCartWithAdvance($bookingDates, $advancePercentage = 30)
    {
        $fromDate = Carbon::parse($bookingDates['from_date']);
        $toDate = Carbon::parse($bookingDates['to_date']);
        $days = $fromDate->diffInDays($toDate);
        
        // Minimum 1 day rental
        $days = max(1, $days);
        
        // Get the daily rate (subtotal for one day)
        $dailyRate = floatval(Cart::instance('cart')->subtotal(0, '', ''));
        
        // Calculate total for the rental period
        $subtotal = $dailyRate * $days;
        $tax = ($subtotal * config('cart.tax')) / 100; // Assuming tax is a percentage
        $total = $subtotal + $tax;
        $advanceAmount = ($total * $advancePercentage) / 100;
        
        return [
            'daily_rate' => $dailyRate,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'advance_payment' => $advanceAmount,
            'payable_amount' => $advanceAmount,
            'balance' => $total - $advanceAmount,
            'days' => $days
        ];
    }

    // ... (keep your other methods the same: addToCart, removeItem, checkout)
    
    public function updateDates(Request $request)
    {
        $validated = $request->validate([
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:pickup_date',
        ]);

        // Store dates in session
        session([
            'booking_from_date' => $validated['pickup_date'],
            'booking_to_date' => $validated['return_date'],
        ]);

        // Update cart items with new dates
        foreach (Cart::instance('cart')->content() as $item) {
            Cart::instance('cart')->update($item->rowId, [
                'options' => array_merge($item->options->toArray(), [
                    'from_date' => $validated['pickup_date'],
                    'to_date' => $validated['return_date'],
                ])
            ]);
        }

        return back()->with('success', 'Booking dates updated successfully!');
    }
}