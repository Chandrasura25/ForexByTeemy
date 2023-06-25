<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $couponCount = $this->getTotalCouponCount();
        $user = auth()->user();
        // return $user->username;
        return view('affiliate',['user'=>$user,'couponCount'=>$couponCount]);
        //
    }
    private function getTotalCouponCount()
    {
        $couponCount = Coupon::count();

        if ($couponCount == 0) {
            return '00';
        } elseif ($couponCount < 10) {
            return '0' . $couponCount;
        } else {
            return (string) $couponCount;
        }
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
        //
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
