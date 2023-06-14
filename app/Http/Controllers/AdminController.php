<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.register');
    }
    public function register(Request $request){
        $request->validate([
            'username'=>'required|min:6',
            'email'=>'required,email|unique:admins',
            'password'=>'required|min:8',
        ]);
        return $request->all();
        // return view('admin.register');
    }
    public function dashboard(){
        return view('admin.dashboard');
    }
}
