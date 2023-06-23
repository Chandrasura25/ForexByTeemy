<?php

namespace App\Http\Controllers;

use App\Models\Coupon;

class CreditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $coupons = Coupon::where('username', auth()->user()->username)->with('couponChannel')->get();  
        $user = auth()->user();
        return view('credit', ['coupons' => $coupons, 'user' => $user]);
    }
}
