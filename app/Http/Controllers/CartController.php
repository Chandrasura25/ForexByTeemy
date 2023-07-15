<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', Auth::user()->id)->get();
        return view('cart',['cart' => $cart]);
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
       if(!auth()->user()){
            flash('You must be logged in to add items to your cart')->error();
            return redirect()->route('login');
       }else if(auth()->user()){ 
        $user = Auth::user();

        // Get the product ID and quantity from the request
        $product_id = $request->input('product_id');

        // Create a new cart item for the user
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->product_id = $product_id;
        $cart->quantity = 1;
        $cart->save();

        // Redirect or return a response
        flash('Item added to cart successfully')->success();
        return redirect()->back();
    };
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
        //
    }
}
