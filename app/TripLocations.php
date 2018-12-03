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
     * Get the pictures for the trip.
     */
    public function pictures()
    {
        return $this->hasMany('App\TripPictures', 'trip_id');
    }

	/**
     * Get the cost for the trip.
     */
    public function costs()
    {
        return $this->hasMany('App\TripCost');
    }

	/**
     * Get the inclusions for the trip.
     */
    public function inclusions()
    {
        return $this->hasMany('App\TripInclusions');
    }

	/**
     * Get the the active trips.
     */
    public function scopeActive($query)
    {
        return $query->where([
	        ['show_trip', 'Y'],
	        ['trip_complete', 'N'],
        ])
        ->orderBy('trip_year', 'desc')
        ->orderBy('trip_month', 'desc')
        ->get();
    }

	/**
     * Get the the inactive trips.
     */
    public function scopeInactive($query)
    {
        return $query->where([
	        ['show_trip', 'Y'],
	        ['trip_complete', 'Y'],
        ])
        ->orderBy('trip_year', 'desc')
        ->orderBy('trip_month', 'desc')
        ->get();
    }
}
