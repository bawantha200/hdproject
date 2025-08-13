<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    // Existing methods...
    
    public function index()
    {
        $items = Cart::instance('cart')->content();
        
        // Calculate cart totals with advance payment
        $calculations = $this->calculateCartWithAdvance();
        
        return view('frontend.cart', compact('items', 'calculations'));
    }
    
    // Add this new method to your controller
    protected function calculateCartWithAdvance($advancePercentage = 30)
{
    // Get raw subtotal (without formatting)
    $subtotal = Cart::instance('cart')->subtotal(0, '', ''); // Returns unformatted value
    $tax = (float) Cart::instance('cart')->tax(0, '', ''); //tax
    // Convert to proper amount (multiply by 100 if needed)
    $subtotal = floatval($subtotal); // Adjust based on your actual stored values
    $total = ($subtotal + $tax);
    $advanceAmount = ($subtotal * $advancePercentage) / 100;
    
    
    return [
        'subtotal' => $subtotal,
        'advance_payment' => $advanceAmount,
        'tax' => $tax,
        'total' => $total,
        'payable_amount' => $advanceAmount,
        'balance' => $total - $advanceAmount,
    ];
}
    // Your existing addToCart, removeItem, updateDates methods...

    
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
        'from_date' => 'required|date|after_or_equal:today',
        'to_date' => 'required|date|after:from_date',
    ]);

    // Store dates in session
    session([
        'booking_from_date' => $validated['from_date'],
        'booking_to_date' => $validated['to_date'],
    ]);

    // Update cart items with new dates (implementation depends on your cart system)
    foreach (Cart::instance('cart')->content() as $item) {
        Cart::instance('cart')->update($item->rowId, [
            'options' => array_merge($item->options->toArray(), [
                'from_date' => $validated['from_date'],
                'to_date' => $validated['to_date'],
            ])
        ]);
    }

    return back()->with('success', 'Booking dates updated');
}


}
