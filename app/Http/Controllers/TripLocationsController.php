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
    public function show(TripLocations $tripLocation, $id)
    {
        $tripLocation = TripLocations::find($id);
		return view('admin.locations.show', compact('tripLocation'));
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
		$getEventUsers = DistributionList::where('trip_id', $id)->get();
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
		$events = $tripLocation->activities;
		$participants = $tripLocation->participants;
		$this->validate($request, [
			'trip_location' => ['required', Rule::unique('trip_locations')->ignore($tripLocation->id), 'max:50']
		]);
		
		if($request->hasFile('trip_photo')) {
			$path = $request->file('trip_photo')->store('public/images');
			$tripLocation->trip_photo = $path;
		}
		
		if($request->hasFile('flyer_name')) {
		// dd($tripLocation);
			$path = $request->file('flyer_name')->store('public/flyers');
			$tripLocation->flyer_name = $path;
		}

		// Update trip location information
		$tripLocation->description = $request->description;
		$tripLocation->cost = implode("; ", array_filter($request->cost));
		$tripLocation->payments = implode("; ", array_filter($request->payments));
		$tripLocation->inclusions = implode("; ", array_filter($request->inclusions));
		$tripLocation->conditions = implode("; ", array_filter($request->conditions));
		$tripLocation->trip_complete = $request->trip_completed;
		$tripLocation->show_trip = $request->show_trip;
        $tripLocation->trip_location = $request->trip_location;
		$tripLocation->trip_month = $request->trip_month;
		$tripLocation->trip_year = $request->trip_year;
		$tripActivityID = $request->activity_id;
		$tripActivityCount = count($tripActivityID);
		$tripPartipantID = $request->participant_id;
		$tripParticipantCount = count($tripPartipantID);
		
		// Rearrange the requested dates
		if($request->deposit_date != '') {
			$depositDate = explode('/', $request->deposit_date);
			$depositDateMonth = array_splice($depositDate, 1, 1);
			$depositDate = array_reverse($depositDate);
			array_push($depositDate, $depositDateMonth[0]);
			$tripLocation->deposit_date = implode('-', $depositDate);
		}
		
		if($request->due_date != '') {
			$dueDate = explode('/', $request->due_date);
			$dueDateMonth = array_splice($dueDate, 1, 1);
			$dueDate = array_reverse($dueDate);
			array_push($dueDate, $dueDateMonth[0]);
			$tripLocation->due_date = implode('-', $dueDate);
		}
		
		// Update active trip activities
		for($i=0; $i < count($tripActivityID); $i++) {
			if($tripActivityID[$i] == $events[$i]->id) {
				$events[$i]->trip_event = $request->trip_event[$i];
				
				// Rearrange date for db entry
				$activityDate = explode('/', $request->activity_date[$i]);
				$activityDateMonth = array_splice($activityDate, 1, 1);
				$activityDate = array_reverse($activityDate);
				array_push($activityDate, $activityDateMonth[0]);
				$events[$i]->activity_date = implode('-', $activityDate);
				
				$events[$i]->activity_location = $request->activity_location[$i];
				$events[$i]->show_activity = $request->show_activity[$i];
				
				$events[$i]->save();
			}
		}
		
		// Add new trip activities
		while($tripActivityCount < (count($request->trip_event) - 1)) {
			$newEventCounter = $tripActivityCount + 1;
			$newEvent = $tripLocation->activities()->create([
				'trip_event' => $request->trip_event[$newEventCounter],
				'activity_date' => $request->activity_date[$newEventCounter],
				'activity_location' => $request->activity_location[$newEventCounter],
				'show_activity' => $request->show_activity[$newEventCounter],
			]);

			$tripActivityCount++;
		}
		
		// Update active trip participants
		for($i=0; $i < count($tripPartipantID); $i++) {
			if($tripPartipantID[$i] == $participants[$i]->id) {
				$participants[$i]->first_name = $request->first_name[$i];
				$participants[$i]->last_name = $request->last_name[$i];
				$participants[$i]->email = $request->email[$i];
				$participants[$i]->phone = $request->phone[$i];
				$participants[$i]->notes = $request->notes[$i];
				$participants[$i]->paid_in_full = $request->pif[$i];
				
				$participants[$i]->save();
			}
		}
		
		// Add new trip participants
		while($tripParticipantCount < (count($request->first_name) - 1)) {
			$newParticipantCounter = $tripParticipantCount + 1;
			$newParticipant = $tripLocation->participants()->create([
				'first_name' => $request->first_name[$newParticipantCounter],
				'last_name' => $request->last_name[$newParticipantCounter],
				'email' => $request->email[$newParticipantCounter],
				'phone' => $request->phone[$newParticipantCounter],
				'notes' => $request->notes[$newParticipantCounter],
				'paid_in_full' => $request->pif[$newParticipantCounter],
			]);

			$tripParticipantCount++;
		}
		// dd($request);
		
		$tripLocation->save();
		
		return redirect()->action('TripLocationsController@edit', $tripLocation)->with('status', 'Trip Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip_Locations  $trip_Locations
     * @return \Illuminate\Http\Response
     */
    public function destroy(TripLocations $tripLocations)
    {
        //
    }
}
