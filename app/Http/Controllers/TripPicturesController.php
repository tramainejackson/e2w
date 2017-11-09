<?php

namespace App\Http\Controllers;

use App\TripPictures;
use App\TripLocations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TripPicturesController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pictures = TripPictures::all();
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
        $pictures = TripPictures::all();
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
        // dd($request);
		
		$pictures = TripPictures::all();
		$getLocations = TripLocations::all();
		
		if($request->hasFile('upload_photo')) {
			if(count($request->file('upload_photo')) > 0) {
				foreach($request->file('upload_photo') as $newImage) {
					$path = $newImage->store('public/images');
					$addImage = new TripPictures();
					$addImage->trip_id = $request->trip_id;
					$addImage->picture_name = $path;
					
					$addImage->save();
				}
			}
		}
		
		return view('admin.pictures.index', compact('pictures', 'getLocations'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip_Pictures  $trip_Pictures
     * @return \Illuminate\Http\Response
     */
    public function show(TripPictures $tripPictures, $id)
    {
		$trip = TripLocations::find($id);
		$getPictures = $trip->pictures;
		// dd($id);
        return view('admin.pictures.show', compact('getPictures'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip_Pictures  $trip_Pictures
     * @return \Illuminate\Http\Response
     */
    public function edit(TripPictures $tripPictures, $id)
    {
        $trip = TripLocations::find($id);
		$getPictures = $trip->pictures;
		// dd($id);
        return view('admin.pictures.edit', compact('trip', 'getPictures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip_Pictures  $trip_Pictures
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $trip = TripLocations::find($id);
		$pictures = $trip->pictures;
		$picturesID = $request->picture_id;
		// dd($request);
		
		// Update active trip participants
		for($i=0; $i < count($picturesID); $i++) {
			if($picturesID[$i] == $pictures[$i]->id) {
				$pictures[$i]->picture_caption = $request->picture_caption[$i];
				
				$pictures[$i]->save();
			}
		}

		return redirect()->action('TripPicturesController@edit', $trip)->with('status', 'Pictures Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip_Pictures  $trip_Pictures
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get picture to remove
		$remove = TripPictures::find($id);
		$trip = $remove->trip;
		
		// Remove Picture
		Storage::delete(str_ireplace('public/images/', '', $remove->picture_name));
		$remove->delete();
		
		// After deleting picture retrieve current pictures
		$getPictures = $trip->pictures;
		
		return view('admin.pictures.edit', compact('trip', 'getPictures'));
    }
}
