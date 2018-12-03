<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TripLocations;
use App\TripPictures;
use App\TripActivities;
use Illuminate\Support\Facades\DB;
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
		$trips = TripLocations::all();
		$activeTrips = TripLocations::active();
		$inactiveTrips = TripLocations::inactive();
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
		$trips = TripLocations::all();
		$activeTrips = TripLocations::active();
		$inactiveTrips = TripLocations::inactive();
		$tripsPics = TripPictures::all();
		
		return view('past', compact('trips', 'inactiveTrips', 'tripsPics', 'activeTrips'));
    }
}
