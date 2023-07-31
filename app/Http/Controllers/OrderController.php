<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $orders = Order::where('user_id', auth()->user()->id)->with('product')->get();
        return view('order')->with('orders', $orders);
    }
}
