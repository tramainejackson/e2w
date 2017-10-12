<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TripLocations;
use App\TripPictures;
use App\TripActivities;

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
		$tripsPics = TripPictures::all();
		$tripsActivities = TripActivities::all();
        return view('welcome', compact('trips', 'tripsPics', 'tripsActivities'));
    }
}
