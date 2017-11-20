<?php

namespace App\Http\Controllers;

use App\DistributionList;
use Illuminate\Http\Request;

class DistributionListController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tripLocation = \App\TripLocations::find($request->trip_id);

		$this->validate($request, [
			'first_name' => 'required|max:50',
			'last_name' => 'required|max:50',
			'email' => 'required|max:100'
		]);
		
		$tripLocation->participants()->create([
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'email_address' => $request->email
		]);
		
		return redirect()->action('TripLocationsController@show', $tripLocation)->with('status', 'Thanks for signing up for the trip to' . $tripLocation->trip_location);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distribution_List  $distribution_List
     * @return \Illuminate\Http\Response
     */
    public function show(DistributionList $distributionList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distribution_List  $distribution_List
     * @return \Illuminate\Http\Response
     */
    public function edit(Distribution_List $distribution_List)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distribution_List  $distribution_List
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distribution_List $distribution_List)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distribution_List  $distribution_List
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distribution_List $distribution_List)
    {
        //
    }
}
