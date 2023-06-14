<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class AdminAuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('admin.register');
    }
    public function register(Request $request){
        $request->validate([
            'username'=>'required|min:6|max:15',
            'email' => 'required|string|email|max:255|unique:admins',
            'password'=>'required|min:8',
        ]);
        $admin= Admin::create([
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        Auth::guard('admin')->login($admin);

        // Redirect to the admin dashboard
        return redirect()->route('admin.dashboard');
    }
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Attempt to authenticate the admin user
        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed
            return redirect()->route('admin.dashboard');
        } else {
            // Authentication failed
            return redirect()->route('admin.login')->withErrors([
                'username' => 'Invalid credentials.',
            ]);
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
