<?php

namespace App\Http\Controllers;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        return view('home',['user'=>$user]);
    }
    public function uploadImg(Request $request)
    {
        $request->validate([
            'profile_pic' => 'required',
        ]);
        $profile_pic = Cloudinary::upload($request->file('profile_pic')->getRealPath())->getSecurePath();
        // update the user profile
        $user = auth()->user();
        $user->profile_pic = $profile_pic;
        $user->save();
        return redirect()->route('home')->with('success', 'Picture updated successfully');
    }
}
