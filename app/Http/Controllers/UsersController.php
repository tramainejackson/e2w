<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$getAllusers = User::all();
        return view('admin.users.index', compact('getAllusers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getAllusers = User::all();
        return view('admin.users.create', compact('getAllusers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip_Pictures  $trip_Pictures
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip_Pictures  $trip_Pictures
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $id)
    {
		$user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip_Pictures  $trip_Pictures
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip_Pictures  $trip_Pictures
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip_Pictures  $trip_Pictures
     * @return \Illuminate\Http\Response
     */
    public function questions()
    {
        return view('admin.questions');
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip_Pictures  $trip_Pictures
     * @return \Illuminate\Http\Response
     */
    public function suggestions()
    {
        return view('admin.suggestions');
    }
}

