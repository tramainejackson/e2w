<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripActivities extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'trip_event', 
		'activity_date', 
		'activity_location', 
		'show_activity'
	];
	
    /**
     * Get the trip for the activity.
     */
    public function trip()
    {
        return $this->belongsTo('App\TripLocations');
    }
}
