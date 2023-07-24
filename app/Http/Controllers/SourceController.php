<?php

namespace App\Http\Controllers;
use App\Models\RefSource;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request){
        $user = auth()->user();
        $refsource = new RefSource();
        $refsource->source = $request->source;
        $refsource->user_id = $user->id;
        $refsource->username = $user->username;
        $refsource->save();
        if ($refsource->save()) {
            flash('Referral Source added successfully')->success();
            return redirect()->back();
        } else {
            flash('Referral Source not added')->error();
            return redirect()->back();
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
       return view('refsource.edit', ['refsource' => RefSource::find($id)]);
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
       $refsource = RefSource::find($id);
         $refsource->delete();
        if ($refsource->delete()) {
            flash('Referral Source deleted successfully')->success();
            return redirect()->back();
        } else {
            flash('An Error Occured')->error();
            return redirect()->back();
        }
    }
}
