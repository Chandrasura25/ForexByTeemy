<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.dashboard', ['admin' => $admin, 'productCount' => $productCountFormatted, 'userCount' => $userCountFormatted, 'users' => $users]);
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
        return redirect()->route('admin.dashboard');
    }
    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user(); 
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect()->route('admin.dashboard');
    }
    public function updateImage(Request $request)
    {
        $admin = Auth::guard('admin')->user(); 
        $admin->image_path = $request->image_path;
        $admin->save();
        return redirect()->route('admin.dashboard');
    }
}

