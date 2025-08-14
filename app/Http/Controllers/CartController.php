<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Existing methods...
    
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


    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|string' // Validate the image path
        ]);
        // Cart::instance('cart')->setGlobalTax(30);

        try {
            Cart::instance('cart')->add(
                $validated['id'],
                $validated['name'],
                1,
                $validated['price'],
                [
                    'category' => $validated['category'],
                    'image' => $validated['image'] // Store the full image URL
                ]
            )->associate('App\Models\Vehicle');
            
            return redirect()->back()->with('success', 'Vehicle added to cart successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding vehicle to cart: ' . $e->getMessage());
        }
    }

    public function removeItem($rowId)
    {
        try {
            // Check if item exists in cart before attempting removal
            $cartItem = Cart::instance('cart')->get($rowId);
            
            if (!$cartItem) {
                return redirect()->back()->with('error', 'Item not found in cart!');
            }

            Cart::instance('cart')->remove($rowId);
            
            return redirect()->back()->with('success', 'Item removed from cart successfully!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error removing item: ' . $e->getMessage());
        }
    }



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


    public function checkout()
    {
        if(!Auth::check()) {
            return redirect()->route('login');
        }
        
        $address = Address::where('user_id', Auth::user()->id)
                        ->where('isdefault', 1)
                        ->first(); 
        
        $items = Cart::instance('cart')->content();
        
        if($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $bookingDates = [
            'from_date' => session('booking_from_date'),
            'to_date' => session('booking_to_date')
        ];

        $calculations = $this->calculateCartWithAdvance($bookingDates);

        return view('frontend.checkout', compact('address', 'items', 'calculations', 'bookingDates'));
    }



    public function place_order(Request $request)
{
    // dd(request()->all());
    $user_id = Auth::user()->id;
    $address = Address::where('user_id',$user_id)->where('isdefault',true)->first();
    if(!$address)
    {
        $request->validate([                
            'name' => 'required|max:100',
            'phone' => 'required|numeric|digits:10',
            'city' => 'required',
            'address' => 'required',        
        ]);
        $address = new Address();    
        $address->user_id = $user_id;    
        $address->name = $request->name;
        $address->phone = $request->phone;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->isdefault = true;
        $address->save();
    }

    // Calculate rental prices (new addition)
    $rentalCalculation = $this->calculateCartWithAdvance([
        'from_date' => $request->from_date, 
        'to_date' => $request->to_date
    ]);

    // $this->setAmountForCheckout();
    $order = new Order();
    $order->user_id = $user_id;

    // Use rental calculation instead of session checkout
    $order->subtotal = $rentalCalculation['subtotal'];
    $order->tax = $rentalCalculation['tax'];
    $order->total = $rentalCalculation['total'];
    $order->amount = $rentalCalculation['advance_payment']; // new field
    $order->balance = $rentalCalculation['balance']; // new field
    $order->days = $rentalCalculation['days']; // new field

    $order->name = $address->name;
    $order->phone = $address->phone;
    $order->address = $address->address;
    $order->city = $address->city;
    $order->save();   

    foreach(Cart::instance('cart')->content() as $item)
    {
        $orderitem = new OrderItem();
        $orderitem->vehicle_id = $item->id;
        $orderitem->order_id = $order->id;
        $orderitem->price = $item->price;
        $orderitem->save();        
    }

    if($request->mode == "paypal")
    {
        // PayPal logic
    }
    else if($request->mode == "card")
    {
        $transaction = new Transaction();
        $transaction->user_id = $user_id;
        $transaction->order_id = $order->id;
        $transaction->status = 'pending';
        $transaction->save();
    }
    
    $cartItems = Cart::instance('cart')->content();
    Cart::instance('cart')->destroy();
    session()->forget('checkout'); 

    session()->put('order_id',$order->id);
    return view('frontend.order-confirmation',compact('order','cartItems'));
}

    


    public function confirmation()
    {
        
        if (!session()->has('order_id')) {
            return redirect()->route('cart.index');
        }

        $order = Order::with('items')->find(session()->get('order_id'));

        if (!$order) {
            session()->forget('order_id');
            return redirect()->route('cart.index')->with('error', 'Order not found');
        }

        return view('frontend.order-confirmation', compact('order','cartItems'));
    }


}
