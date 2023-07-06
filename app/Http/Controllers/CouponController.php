<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponChannel;
use Illuminate\Http\Request;

class CouponController extends Controller
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
        $coupons = Coupon::where('username', auth()->user()->username)->with('couponChannel')->paginate(10);
        $couponCount = $this->getTotalCouponCount();
        $user = auth()->user();
        return view('coupon.index', ['coupons' => $coupons, 'user' => $user, 'couponCount' => $couponCount]);
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
        $user = auth()->user();
        $coupon_code = $this->generateCouponCode($user->username, $user->id);
        $channels = CouponChannel::get();
        return view('coupon.create', ['channels' => $channels, 'coupon_code' => $coupon_code]);
    }

    private function generateCouponCode($username, $userId)
    {
        $code = substr($username, 0, 3); // Take the first three characters of the username
        $code .= str_pad($userId, 3, '0', STR_PAD_LEFT) + mt_rand(100, 999); // Append a three-digit padded user ID
        $code .= mt_rand(10, 99); // Append a two-digit random number

        return $code;
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $channels = CouponChannel::get();
    //     $request->validate([
    //         'coupon_code' => 'required',
    //         'coupon_channel_id' => 'required',
    //         'coupon_type' => 'required',
    //         'description' => 'required|min:6',
    //         'effectivity' => 'required',
    //     ]);
    //     $coupon = Coupon::create([
    //         'coupon_code' => $request->coupon_code,
    //         'coupon_channel_id' => $request->coupon_channel_id,
    //         'coupon_type' => $request->coupon_type,
    //         'percentage_off' => $request->percentage_off,
    //         'fixed_amount' => $request->fixed_amount,
    //         'description' => $request->description,
    //         'effectivity' => $request->effectivity,
    //         'username' => auth()->user()->username,
    //         'start_date' => $request->start_date,
    //         'end_date' => $request->end_date,
    //         'minimum_purchase' => $request->minimum_purchase,
    //     ]);
    //     $user = auth()->user();

    //     $coupon_code = $this->generateCouponCode($user->username, $user->id);
    //     if ($coupon) {
    //         return view('coupon.create')->with('message', 'Coupon created successfully.')->with('success', true)->with('channels', $channels)->with('coupon_code', $coupon_code);
    //     } else {
    //         return view('coupon.create')->with('message', 'An error occured')->with('success', false)->with('channels', $channels)->with('coupon_code', $coupon_code);
    //     }
    // }
    public function store(Request $request)
    {
        $user = auth()->user();
        $channels = CouponChannel::get();
        $request->validate([
            'coupon_code' => 'required',
            'coupon_channel_id' => 'required',
            'coupon_type' => 'required',
            'description' => 'required|min:6',
            'effectivity' => 'required',
        ]);
    
        $couponType = $request->coupon_type;
        $percentageOff = $request->percentage_off;
    
        if ($couponType === 'percentage' && $percentageOff > $user->coupon_percent) {
            return redirect()->back()->with('error', 'Percentage off should be less than or equal to 20%.')->withInput();
        }
    
        
        $couponCode = $this->generateCouponCode($user->username, $user->id);
    
        // Calculate personal discount based on specified percentage
        $personalDiscount = $couponType === 'percentage' ? ($user->coupon_percent - $percentageOff) : 0;
    
        $coupon = Coupon::create([
            'coupon_code' => $request->coupon_code,
            'coupon_channel_id' => $request->coupon_channel_id,
            'coupon_type' => $couponType,
            'percentage_off' => $percentageOff,
            'fixed_amount' => $request->fixed_amount,
            'description' => $request->description,
            'effectivity' => $request->effectivity,
            'username' => $user->username,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'minimum_purchase' => $request->minimum_purchase,
        ]);
    
        if ($coupon) {
            // Deduct personal discount from personal coupon
            $user->coupon_percent -= $personalDiscount;
            $user->save();
    
            return view('coupon.create')->with('message', 'Coupon created successfully.')->with('success', true)->with('channels', $channels)->with('coupon_code', $couponCode);
        } else {
            return view('coupon.create')->with('message', 'An error occurred.')->with('success', false)->with('channels', $channels)->with('coupon_code', $couponCode);
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
        $channels = CouponChannel::get();
        return view('coupon.edit')->with('coupon', Coupon::findOrFail($id))->with('channels', $channels);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'coupon_channel_id' => 'required',
            'coupon_type' => 'required',
            'description' => 'required|min:6',
            'effectivity' => 'required',
        ]);
        $coupon = Coupon::findOrFail($id);
        $coupon->update([
            'coupon_channel_id' => $request->coupon_channel_id,
            'coupon_type' => $request->coupon_type,
            'percentage_off' => $request->percentage_off,
            'fixed_amount' => $request->fixed_amount,
            'description' => $request->description,
            'effectivity' => $request->effectivity,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'minimum_purchase' => $request->minimum_purchase,
        ]);
        if ($coupon) {
            return redirect('/credit');
        } else {
            return view('coupon.edit')->with('message', 'An error occured')->with('success', false);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->back()->with('success', 'Coupon deleted successfully.');
    }
    public function toggleStatus($couponId)
    {
        $coupon = Coupon::findOrFail($couponId);

        if ($coupon->status === 'active') {
            $coupon->status = 'inactive';
        } else {
            $coupon->status = 'active';
        }

        $coupon->save();

        return redirect()->back()->with('success', 'Coupon status toggled successfully.');
    }
   public function transfer(){}
}
