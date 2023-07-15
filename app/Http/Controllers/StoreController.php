<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        $admin = Auth::guard('admin')->user(); // Check if user is an admin
        $products = Product::with('productType', 'images')->get();
        if ($admin) {
            // User is an admin
            return view('store', ['products' => $products, 'isAdmin' => true]);
        } else {
            // User is not an admin
            return view('store', ['products' => $products,'isAdmin' => false]);
        }
    }
}
