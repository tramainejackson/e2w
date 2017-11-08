<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripLocations extends Model
{
    /**
     * Get the activities for the trip.
     */
    public function activities()
    {
        return $this->hasMany('App\TripActivities', 'trip_id');
    }
	
	/**
     * Get the participants for the trip.
     */
    public function participants()
    {
        return $this->hasMany('App\DistributionList', 'trip_id');
    }
	
	/**
     * Get the participants for the trip.
     */
    public function pictures()
    {
        return $this->hasMany('App\TripPictures', 'trip_id');
    }
}
