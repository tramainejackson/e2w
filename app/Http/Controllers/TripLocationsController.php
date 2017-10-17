<?php

namespace App\Http\Controllers;

use App\DistributionList;
use App\TripLocations;
use App\TripActivities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TripLocationsController extends Controller
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
        $getLocations = TripLocations::all();
		return view('admin.locations.index', compact('getLocations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getYear = DB::table('vacation_year')->get();
		$getMonth = DB::table('vacation_month')->get();
		
		return view('admin.locations.create', compact('getYear', 'getMonth'));
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
     * @param  \App\Trip_Locations  $trip_Locations
     * @return \Illuminate\Http\Response
     */
    public function show(Trip_Locations $trip_Locations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip_Locations  $trip_Locations
     * @return \Illuminate\Http\Response
     */
    public function edit(TripLocations $tripLocations, $id)
    {
		$showLocations = TripLocations::find($id);
		$getCurrentEvents = TripActivities::where('trip_id', $id)->get();
		$getEventUsers = DistributionList::where('trip_location', $id)->get();
		$getLocations = TripLocations::all();
        $getYear = DB::table('vacation_year')->get();
		$getMonth = DB::table('vacation_month')->get();
		
		return view('admin.locations.edit', compact('getYear', 'getMonth', 'showLocations', 'getLocations', 'getCurrentEvents', 'getEventUsers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip_Locations  $trip_Locations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip_Locations $trip_Locations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip_Locations  $trip_Locations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip_Locations $trip_Locations)
    {
        //
    }
}
