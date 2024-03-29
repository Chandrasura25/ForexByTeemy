<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Credit;
use Illuminate\Http\Request;
use App\Models\RefSource;
class ClickController extends Controller
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
        $user = auth()->user();
        $myRefLink = url('/register/' . $user->username);
        if (empty($user->referral_link)) {
            $user->update([
                'referral_link' => $myRefLink,
                'coupon_percent' => $user->coupon_percent + 20,
                'personal_coupon' => $user->personal_coupon + 1
            ]);
        }
        $this->updateTotalCredits($user);
        $referrer = $user->username;

        $referringUser = User::where('username', $referrer)->first();

        if ($referringUser) {
            $totalReferred = $referringUser->referredUsers()->count();
            $formattedReferrerNumber = ($totalReferred < 10) ? '0' . $totalReferred : $totalReferred;

        }
        $ref_sources = RefSource::where('user_id', $user->id)->get();
        return view('click', ['user' => $user, 'myRefLink' => $myRefLink, 'totalReferred' => $formattedReferrerNumber, 'ref_sources' => $ref_sources]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
