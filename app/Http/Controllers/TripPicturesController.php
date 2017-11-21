<?php

namespace App\Http\Controllers;

use App\TripPictures;
use App\TripLocations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;

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
		$trip = TripLocations::find($request->trip_id);
		$pictures = TripPictures::all();
		$getLocations = TripLocations::all();
		$addImage = new TripPictures();
		$error = "";

		if($request->hasFile('upload_photo')) {
			foreach($request->file('upload_photo') as $newImage) {
				// Check to see if images is too large
				if($newImage->getError() == 1) {
					$fileName = $request->file('upload_photo')[0]->getClientOriginalName();
					$error .= "<li class='errorItem'>The file " . $fileName . " is too large and could not be uploaded</li>";
				} elseif($newImage->getError() == 0) {
					// Check to see if images is about 25MB
					// If it is then resize it
					if($newImage->getClientSize() < 25000000) {
						$image = Image::make($newImage->getRealPath())->orientate();
						$path = $newImage->store('public/images');
						$image->save(storage_path('app/'. $path));

						$addImage->trip_id = $request->trip_id;
						$addImage->picture_name = $path;
						
						$addImage->save();
					} else {
						// Resize the image before storing. Will need to hash the filename first
						$path = $newImage->store('public/images');
						$image = Image::make($newImage)->orientate()->resize(1500, null, function ($constraint) {
							$constraint->aspectRatio();
							$constraint->upsize();
						});
						$image->save(storage_path('app/'. $path));

						$addImage->trip_id = $request->trip_id;
						$addImage->picture_name = $path;
						
						$addImage->save();
					}
				} else {
					$error .= "The file " . $fileName . " may be corrupt and could not be uploaded.";
				}
			}
		} else {
			foreach($request->file('upload_photo') as $newImage) {
				$fileName = $newImage->getClientOriginalName();
				if($newImage->getError() == 1) {
					$error .= "<li class='errorItem'>The file " . $fileName . " is too large and could not be uploaded</li>";
					// $image = Image::make($newImage)->orientate();
				} elseif($newImage->getError() == 0) {
					// Change if statement to check size of images and make sure smaller than 5kb
					// If not resize to a smaller size
					if($newImage->getClientSize() < $newImage->getMaxFileSize()) {
						$path = $newImage->store('public/images');
						$image = Image::make($newImage)->orientate();
						$image->save(storage_path('app/'. $path));

						$addImage->trip_id = $request->trip_id;
						$addImage->picture_name = $path;
						
						$addImage->save();
					} else {
						// Resize the image before storing. Will need to hash the filename first
						$path = $newImage->store('public/images');
						$image = Image::make($newImage)->orientate()->resize(1500, null, function ($constraint) {
							$constraint->aspectRatio();
							$constraint->upsize();
						});
						$image->save(storage_path('app/'. $path));

						$addImage->trip_id = $request->trip_id;
						$addImage->picture_name = $path;
						
						$addImage->save();
					}
				} else {
					$error .= "The file " . $fileName . " may be corrupt and could not be uploaded.";
				}
			}
		}
		
		if($error != "") {
			return redirect()->action('TripPicturesController@create')->with('status', $error);
		} else {
			return redirect()->action('TripPicturesController@edit', $trip)->with('status', 'Pictures Added/Updated Successfully');
		}
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
        return view('admin.pictures.show', compact('trip', 'getPictures'));
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
		$status = "You have removed all of the photos for this trip";
		$getLocations = TripLocations::all();
		
		// Remove Picture
		Storage::delete(str_ireplace('public/images/', '', $remove->picture_name));
		$remove->delete();
		
		// After deleting picture retrieve current pictures
		$getPictures = $trip->pictures;
		
		if($trip->pictures()->count() < 1) {
			return view('admin.pictures.create', compact('status', 'getLocations'));
		} else {
			return view('admin.pictures.edit', compact('trip', 'getPictures'));
		}
    }
}
