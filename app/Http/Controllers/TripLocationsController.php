<?php

namespace App\Http\Controllers;

use App\DistributionList;
use App\TripLocations;
use App\TripActivities;
use App\TripCosts;
use App\TripPictures;
use function GuzzleHttp\Psr7\parse_query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;
use Carbon\Carbon;
use phpDocumentor\Reflection\DocBlock\Description;

class TripLocationsController extends Controller
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
		$tripLocation = new TripLocations();
		$error = '';

		$this->validate($request, [
			'trip_name' => 'required|max:50|unique:trip_locations,trip_location',
		]);

	    if($request->hasFile('trip_photo')) {
		    $newImage = $request->file('trip_photo');

		    // Check to see if upload is an image
		    if($newImage->guessExtension() == 'jpeg' || $newImage->guessExtension() == 'png' || $newImage->guessExtension() == 'gif' || $newImage->guessExtension() == 'webp' || $newImage->guessExtension() == 'jpg') {

			    // Check to see if images is too large
			    if ($newImage->getError() == 1) {
				    $fileName = $request->file('media')[0]->getClientOriginalName();
				    $error = "<li class='errorItem'>The file " . $fileName . " is too large and could not be uploaded</li>";
			    } elseif ($newImage->getError() == 0) {
				    // Check to see if images is about 25MB
				    // If it is then resize it
				    if ($newImage->getClientSize() < 25000000) {
					    $image = Image::make($newImage->getRealPath())->orientate();
					    $path = $newImage->store('public/images');

					    if ($image->save(storage_path('app/' . $path))) {
						    // prevent possible upsizing
						    // Create a larger version of the image
						    // and save to large image folder
						    $image->resize(1920, null, function ($constraint) {
							    $constraint->aspectRatio();
							    // $constraint->upsize();
						    });


						    if ($image->save(storage_path('app/' . str_ireplace('images', 'background', $path)))) {

						    }
					    }

					    $tripLocation->trip_photo = $path;

				    } else {
					    // Resize the image before storing. Will need to hash the filename first
					    $path = $newImage->store('public/images');
					    $image = Image::make($newImage)->orientate()->resize(1920, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
					    });
					    $image->save(storage_path('app/' . $path));
				    }
			    } else {
				    $error = "<li class='errorItem'>The file " . $newImage->filename . " may be corrupt and could not be uploaded</li>";
			    }
		    }
	    }

        $tripLocation->trip_location = $request->trip_name;
		$tripLocation->trip_month = $request->trip_month;
		$tripLocation->trip_year = $request->trip_year;

		if($tripLocation->save()) {
			$tripLocation->costs()->create([]);
		}

		return redirect()->action('TripLocationsController@edit', $tripLocation)->with('status', 'New Trip Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip_Locations  $location
     * @return \Illuminate\Http\Response
     */
    public function show(TripLocations $location)
    {
        $tripLocation = $location;

		return view('admin.locations.show', compact('tripLocation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip_Locations  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(TripLocations $location)
    {
		$showLocation       = $location;
	    $costs              = $showLocation->costs;
	    $getCurrentEvents   = $showLocation->activities;
	    $getEventUsers      = $showLocation->participants;
	    $getPaymentOptions  = $showLocation->payment_options;
	    $getInclusions      = $showLocation->inclusion;
	    $getConditions      = $showLocation->conditions;
	    $getYear            = DB::table('vacation_year')->get();
	    $getMonth           = DB::table('vacation_month')->get();

		return view('admin.locations.edit', compact('getConditions', 'getInclusions', 'getPaymentOptions', 'costs', 'getYear', 'getMonth', 'showLocation', 'getCurrentEvents', 'getEventUsers'));
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
		$tripLocation   = TripLocations::find($id);
		$fileUpdated = '';
		
		if($request->hasFile('trip_photo')) {
			$newImage = $request->file('trip_photo');
			$fileUpdated = 'Trip Photo';
			$error = '';

			// Check to see if upload is an image
			if($newImage->guessExtension() == 'jpeg' || $newImage->guessExtension() == 'png' || $newImage->guessExtension() == 'gif' || $newImage->guessExtension() == 'webp' || $newImage->guessExtension() == 'jpg') {

				// Check to see if images is too large
				if ($newImage->getError() == 1) {
					$fileName = $request->file('media')[0]->getClientOriginalName();
					$error = "<li class='errorItem'>The file " . $fileName . " is too large and could not be uploaded</li>";
				} elseif ($newImage->getError() == 0) {
					// Check to see if images is about 25MB
					// If it is then resize it
					if ($newImage->getClientSize() < 25000000) {
						$image = Image::make($newImage->getRealPath())->orientate();
						$path = $newImage->store('public/images');

						if ($image->save(storage_path('app/' . $path))) {
							// prevent possible upsizing
							// Create a larger version of the image
							// and save to large image folder
							$image->resize(1920, null, function ($constraint) {
								$constraint->aspectRatio();
								// $constraint->upsize();
							});


							if ($image->save(storage_path('app/' . str_ireplace('images', 'background', $path)))) {

							}
						}

						$tripLocation->trip_photo = $path;

					} else {
						// Resize the image before storing. Will need to hash the filename first
						$path = $newImage->store('public/images');
						$image = Image::make($newImage)->orientate()->resize(1920, null, function ($constraint) {
							$constraint->aspectRatio();
							$constraint->upsize();
						});
						$image->save(storage_path('app/' . $path));
					}
				} else {
					$error = "<li class='errorItem'>The file " . $newImage->filename . " may be corrupt and could not be uploaded</li>";
				}
			}
		}
		
		if($request->hasFile('flyer_name')) {
			$newImage = $request->file('flyer_name');

			// Check to see if upload is an image
			if($newImage->guessExtension() == 'jpeg' || $newImage->guessExtension() == 'png' || $newImage->guessExtension() == 'gif' || $newImage->guessExtension() == 'webp' || $newImage->guessExtension() == 'jpg') {
				$error = "The file uploaded for the flyer was an image. Please upload a document for the flyer";

				return redirect()->back()->with('error', $error);
			} else {
				$path = $request->file('flyer_name')->store('public/flyers');
				$tripLocation->flyer_name = $path;
				$fileUpdated = 'Trip Flyer';
			}
		}
		
		if($tripLocation->save()) {
			return redirect()->back()->with('status', $fileUpdated . ' Updated Successfully');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip_Locations  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(TripLocations $location)
    {
        //
    }

    /**
     * Add the specified resource to storage from Ajax request.
     *
     * @param  \App\Trip_Locations  $trip_Locations
     * @return \Illuminate\Http\Response
     */
    public function ajax_add(Request $request)
    {
	    $results = (object) parse_query($request->trip_additions);
	    $trip = $showLocation = TripLocations::find($request->trip_id);

	    if(isset($results->trip_includes)) {

		    $newValue = $create_include = $trip->inclusion()->create([
		    	'description' => $results->description,
		    ]);


	    } elseif(isset($results->trip_conditions)) {

		    $newValue = $create_condition = $trip->conditions()->create([
			    'description' => $results->description,
		    ]);

	    } elseif(isset($results->trip_payments)) {

		    $newValue = $create_payment = $trip->payment_options()->create([
			    'payment_description'   => $results->description,
			    'occurrence'            => $results->occurrence,
		    ]);

	    } elseif(isset($results->trip_activities)) {

		    $newValue = $create_activity = $trip->activities()->create([
			    'trip_event'        => $results->trip_event,
			    'activity_location' => $results->activity_location,
			    'show_activity'     => $results->show_activity
		    ]);

	    } else {
		    $contact = new DistributionList();

		    $contact->first_name    = $results->first_name;
		    $contact->last_name     = $results->last_name;
		    $contact->email         = $results->email;
		    $contact->phone         = $results->phone;

		    if($contact->save()) {
			    $newValue = $create_participant = $trip->participants()->create([
				    'first_name'        => $contact->first_name,
				    'last_name'         => $contact->last_name,
				    'paid_in_full'      => $results->pif,
				    'email'             => $contact->email,
				    'phone'             => $contact->phone,
				    'notes'             => $results->notes,
				    'parent_acct_id'    => $contact->id
			    ]);
		    }

	    }

	    return $newValue;
    }

    /**
     * Update the specified resource from storage.
     *
     * @param  \App\Trip_Locations  $trip_Locations
     * @return \Illuminate\Http\Response
     */
    public function ajax_update(Request $request)
    {
	    $results = (object) parse_query($request->trip_updates);
	    $trip = TripLocations::find($request->trip_id);

	    if(isset($results->trip_includes)) {
		    // Get the inclusion
		    $inclusion = $trip->inclusion()->find($results->inclusion_option);

		    // Update the inclusion fields
		    $inclusion->description = $results->description;

		    if($inclusion->save()) {
			    return 'Trip inclusions information updated';
		    }

	    } elseif(isset($results->trip_conditions)) {
		    // Get the condition
		    $condition = $trip->conditions()->find($results->condition_option);

		    // Update the condition fields
		    $condition->description = $results->description;

		    if($condition->save()) {
			    return 'Terms and conditions information updated';
		    }

	    } elseif(isset($results->trip_payments)) {
		    // Get the payment
		    $payment = $trip->payment_options()->find($results->payment_option);
		    $occurrence = array_values((array)$results);

		    // Update the payment fields
		    $payment->payment_description = $results->description;
		    $payment->occurrence = $occurrence[1];

		    if($payment->save()) {
			    return 'Trip payment information updated';
		    }

	    } elseif(isset($results->trip_activities)) {
		    // Get the activity
		    $activity = $trip->activities()->find($results->activity_option);

		    // Update the activity fields
		    $activity->trip_event = $results->trip_event;
		    $activity->activity_location = $results->activity_location;
		    $activity->show_activity = $results->show_activity;

		    if($activity->save()) {
			    return 'Trip activity information updated';
		    }

	    } elseif(isset($results->trip_participants)) {
			// Get the participant
		    $participant = $trip->participants()->find($results->participant_option);

		    // Update the participant fields
		    $participant->first_name = $results->first_name;
		    $participant->last_name = $results->last_name;
		    $participant->paid_in_full = $results->pif;
		    $participant->email = $results->email;
		    $participant->phone = $results->phone;
		    $participant->notes = $results->notes;

		    if($participant->save()) {
				return 'Participant information updated';
		    }
	    } else {
			$results = explode('=', $request->trip_updates);
		    $key = $results[0];
		    $value = $results[1];

		    if($key == 'deposit_date') {
		    	$deposit_date = explode('/', $value);
			    $trip->deposit_date = $deposit_date[2].'-'.$deposit_date[0].'-'.$deposit_date[1];
		    } elseif($key == 'due_date') {
			    $due_date = explode('/', $value);
			    $trip->due_date = $due_date[2].'-'.$due_date[0].'-'.$due_date[1];
		    } elseif(substr_count($key, 'trip_cost')) {
			    $key = str_ireplace('trip_cost_', '', $key);
			    $trip->costs->$key = $value;

			    if($trip->costs->save()) {}
		    } elseif($key == 'trip_photo') {

		    } else {
			    $trip->$key = $value;
		    }

		    if($trip->save()) {
			    return str_ireplace('_', ' ', ucfirst($key)) . ' updated successfully';
		    }
	    }

    }

	/**
	 * Update the specified resource from storage.
	 *
	 * @param  \App\Trip_Locations  $location
	 * @param  \App\DistributionList  $participant
	 * @return \Illuminate\Http\Response
	 */
	public function add_contact(Request $request, DistributionList $participant, TripLocations $location)
	{
		$location->participants()->create([
			'first_name'        => $participant->first_name,
			'last_name'         => $participant->last_name,
			'email'             => $participant->email,
			'phone'             => $participant->phone,
			'parent_acct_id'    => $participant->id
		]);

		return 'Successful';
	}

	/**
	 * Delete the specified resource to storage from Ajax request.
	 *
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function ajax_delete(Request $request)
	{
		$results = (object) parse_query($request->trip_deletions);
		$trip = TripLocations::find($request->trip_id);

		if(isset($results->trip_includes)) {
			// Get the inclusion
			$inclusion = $trip->inclusion()->find($results->inclusion_option);

			if($inclusion->delete()) {
				return 'Trip inclusions information removed';
			}

		} elseif(isset($results->trip_conditions)) {
			// Get the condition
			$condition = $trip->conditions()->find($results->condition_option);

			if($condition->delete()) {
				return 'Terms and conditions information removed';
			}

		} elseif(isset($results->trip_payments)) {
			// Get the payment
			$payment = $trip->payment_options()->find($results->payment_option);

			if($payment->delete()) {
				return 'Trip payment information removed';
			}

		} elseif(isset($results->trip_activities)) {
			// Get the activity
			$activity = $trip->activities()->find($results->activity_option);

			if($activity->delete()) {
				return 'Trip activity information removed';
			}

		} elseif(isset($results->trip_participants)) {
			// Get the participant
			$participant = $trip->participants()->find($results->participant_option);

			if($participant->delete()) {
				return 'Participant information removed';
			}
		}
	}
}
