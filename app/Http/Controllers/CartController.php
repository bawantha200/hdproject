<?php

namespace App\Http\Controllers;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartController extends Controller
{
    //
    public function index()
{
    $items = Cart::instance('cart')->content();
    return view('frontend.cart',compact('items'));
}

    
public function addToCart(Request $request)
{
    
    $validated = $request->validate([
        'id' => 'required|integer',
        'name' => 'required|string',
        'category' => 'required|string',
        'daily_rate' => 'required|numeric',
        'image' => 'required|string' // Validate the image path
    ]);

    try {
        Cart::instance('cart')->add(
            $validated['id'],
            $validated['name'],
            1,
            $validated['daily_rate'],
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



}
