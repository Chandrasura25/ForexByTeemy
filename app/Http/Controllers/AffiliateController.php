<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Credit;
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
     private function updateTotalCredits(User $user)
    {
        $totalCredits = Credit::where('username', $user->username)->sum('amount'); 
        $user->update(['credits' => $totalCredits]);
    }
    public function index()
    {
        $couponCount = $this->getTotalCouponCount();
        $user = auth()->user();
        $this->updateTotalCredits($user);
        $referredUsers = $user->referredUsers()->get();
        return view('affiliate',['user'=>$user,'couponCount'=>$couponCount, 'referredUsers'=>$referredUsers ]);
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
