<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TripLocations;
use App\TripPictures;
use App\TripActivities;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$agent = new Agent();
		$trips = TripLocations::all();
		$activeTrips = TripLocations::where([
			['show_trip', 'Y'],
			['trip_complete', 'N'],
		])
		->orderBy('id', 'desc')
		->get();
		$inactiveTrips = TripLocations::where([
			['show_trip', 'Y'],
			['trip_complete', 'Y'],
		])
		->get();
		$tripsPics = TripPictures::all();
		
		return view('welcome', compact('trips', 'inactiveTrips', 'tripsPics', 'activeTrips'));
    }
	
	 /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function past()
    {
		$agent = new Agent();
		$trips = TripLocations::all();
		$activeTrips = TripLocations::where([
			['show_trip', 'Y'],
			['trip_complete', 'N'],
		])
		->get();
		$inactiveTrips = TripLocations::where([
			['show_trip', 'Y'],
			['trip_complete', 'Y'],
		])
		->get();
		$tripsPics = TripPictures::all();
		
		return view('past', compact('trips', 'inactiveTrips', 'tripsPics', 'activeTrips'));
    }
}
