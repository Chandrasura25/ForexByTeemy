<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        $products = Product::with('productType', 'images')->get();
        return view('store', ['products' => $products]);
    }
}
