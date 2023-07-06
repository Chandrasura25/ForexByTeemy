<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user(); 
        $productCount = Product::count();
        $userCount = User::count();
        $productCountFormatted = ($productCount < 10) ? '0' . $productCount : $productCount;
        $userCountFormatted = ($userCount < 10) ? '0' . $userCount : $userCount;
        return view('admin.dashboard', ['admin' => $admin, 'productCount' => $productCountFormatted, 'userCount' => $userCountFormatted]);
    }
}

