<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::with('product', 'product.images')->where('user_id', Auth::user()->id)->get();
        return view('cart', ['carts' => $carts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()) {
            flash('You must be logged in to add items to your cart')->error();
            return redirect()->route('login');
        } else if (auth()->user()) {
            $user = Auth::user();

            // Get the product ID and quantity from the request
            $product_id = $request->input('product_id');

            // Check if the product already exists in the user's cart
            $existingCartItem = Cart::where('user_id', $user->id)
                ->where('product_id', $product_id)
                ->first();

            if ($existingCartItem) {
                flash('Item already exist in the cart')->info();
            } else {
                // If the product doesn't exist, create a new cart item for the user
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->product_id = $product_id;
                $cart->quantity = 1;
                // Retrieve the product price based on the product_id
                $product = Product::find($product_id);
                if (!$product) {
                    flash('Product not found')->error();
                    return redirect()->back();
                }

                // Calculate the total_price by multiplying the product price with the quantity
                $cart->total_price = $product->price * $request->quantity;

                $cart->save();
                flash('Item added to cart successfully')->success();
            }

            // Redirect back
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        flash('Item removed from cart successfully')->success();
        return redirect()->back();
    }
    // CartController.php

    public function updateQuantity(Request $request)
    {
        // Validate the request data
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Check if the user is authenticated
        if (!auth()->check()) {
            flash('You must be logged in to update cart quantity')->error();
            return redirect()->route('login');
        }
    
        // Get the authenticated user
        $user = auth()->user();
    
        // Get the product ID and quantity from the request
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
    
        // Find the cart item for the current user and the specified product
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product_id)
            ->first();
    
        if ($cartItem) {
            // If the cart item exists, update the quantity and calculate the total price
            $cartItem->quantity = $quantity;
            $cartItem->total_price = $cartItem->product->price * $quantity; // Assuming the price is stored in the 'price' column of the 'products' table
            $cartItem->save();
    
            // Load the updated cart items and return as JSON response
            $carts = Cart::with('product', 'product.images')->where('user_id', Auth::user()->id)->get();
            return response()->json(['carts' => $carts]);
        } else {
            // For this example, we'll show an error flash message
            flash('Cart item not found')->error();
        }
    }
    
}
