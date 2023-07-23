<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $admin = Auth::guard('admin')->user(); 
        $productCount = Product::count();
        $userCount = User::count();
        $users = User::latest()->get();
        $productCountFormatted = ($productCount < 10) ? '0' . $productCount : $productCount; 
        $userCountFormatted = ($userCount < 10) ? '0' . $userCount : $userCount;
        $sumTotalAmount = Payment::sum('amount');
        $sumTotalAmountFormatted = ($sumTotalAmount < 10) ? '0' . $sumTotalAmount : $sumTotalAmount;
        return view('admin.dashboard', ['admin' => $admin, 'productCount' => $productCountFormatted, 'userCount' => $userCountFormatted, 'users' => $users, 'sumTotalAmount' => $sumTotalAmountFormatted]);
    }
    public function edit()
    {
        $admin = Auth::guard('admin')->user(); 
        return view('admin.edit', ['admin' => $admin]);
    }
    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user(); 
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->save();
        flash('Your profile has been updated!')->success();
        return redirect()->back();
    }
    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user(); 
        $admin->password = Hash::make($request->password);
        $admin->save();
        flash('Your password has been updated!')->success();
        return redirect()->back();
    }
    public function updateImage(Request $request)
    {
        $admin = Auth::guard('admin')->user(); 
        $image_path = Cloudinary::upload($request->file('image_path')->getRealPath())->getSecurePath();
        $admin->image_path = $image_path;
        $admin->save();
        flash('Your Profile Picture has been updated!')->success();
        return redirect()->back();
    }
}

