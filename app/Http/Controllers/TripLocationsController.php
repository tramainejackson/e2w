<?php

namespace App\Http\Controllers;

use App\DistributionList;
use App\TripLocations;
use App\TripActivities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
		$this->validate($request, [
			'trip_name' => 'required|max:50|unique:trip_locations,trip_location',
		]);
		
		if($request->hasFile('trip_photo')) {
			$path = $request->file('trip_photo')->store('public/images');
			$tripLocation->trip_photo = $path;
		}
		
		$tripLocation = new TripLocations();

        $tripLocation->trip_location = $request->trip_name;
		$tripLocation->trip_month = $request->trip_month;
		$tripLocation->trip_year = $request->trip_year;

		$tripLocation->save();
		
		return redirect()->action('TripLocationsController@edit', $tripLocation)->with('status', 'New Trip Added Successfully');
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
		$showLocation = TripLocations::find($id);
		$getCurrentEvents = TripActivities::where('trip_id', $id)->get();
		$getEventUsers = DistributionList::where('trip_location', $id)->get();
		$getLocations = TripLocations::all();
        $getYear = DB::table('vacation_year')->get();
		$getMonth = DB::table('vacation_month')->get();
		
		return view('admin.locations.edit', compact('getYear', 'getMonth', 'showLocation', 'getLocations', 'getCurrentEvents', 'getEventUsers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip_Locations  $trip_Locations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$tripLocation = TripLocations::find($id);
		$getCurrentEvents = TripActivities::where('trip_id', $id)->get();
		$getEventUsers = DistributionList::where('trip_location', $id)->get();
		
		$this->validate($request, [
			'trip_location' => ['required', Rule::unique('trip_locations')->ignore($tripLocation->id), 'max:50']
		]);
        dd($tripLocation);
		
		if($request->hasFile('trip_photo')) {
			$path = $request->file('trip_photo')->store('public/images');
			$tripLocation->trip_photo = $path;
		}

        $tripLocation->trip_location = $request->trip_name;
		$tripLocation->trip_month = $request->trip_month;
		$tripLocation->trip_year = $request->trip_year;

		$tripLocation->save();
		
		return redirect()->action('TripLocationsController@edit', $tripLocation)->with('status', 'New Trip Added Successfully');
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
