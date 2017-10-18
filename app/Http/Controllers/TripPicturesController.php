<?php

namespace App\Http\Controllers;

use App\TripPictures;
use App\TripLocations;
use Illuminate\Http\Request;

class TripPicturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pictutes = TripPictures::all();
		$getLocations = TripLocations::all();
		
		return view('admin.pictures.index', compact('pictures', 'getLocations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pictutes = TripPictures::all();
		$getLocations = TripLocations::all();
		
		return view('admin.pictures.create', compact('pictures', 'getLocations'));
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
    public function show(Trip_Pictures $trip_Pictures)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip_Pictures  $trip_Pictures
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip_Pictures $trip_Pictures)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip_Pictures  $trip_Pictures
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip_Pictures $trip_Pictures)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip_Pictures  $trip_Pictures
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip_Pictures $trip_Pictures)
    {
        //
    }
}
