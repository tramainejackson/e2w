<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\TripCosts;

class TripLocations extends Model
{
	/**
	 * Get the deposit date for the vacation.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getDepositDateAttribute($value)
	{
		return $value == null ? $value : new Carbon($value);
	}

	/**
	 * Get the due date for the vacation.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getDueDateAttribute($value)
	{
		return $value == null ? $value : new Carbon($value);
	}

	/**
	 * Get the conditions for the trip.
	 */
	public function conditions()
	{
		return $this->hasMany('App\TripConditions');
	}

	/**
	 * Get the inclusions for the trip.
	 */
	public function inclusion()
	{
		return $this->hasMany('App\TripInclusions', 'trip_id');
	}

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
     * Get the payment options for the trip.
     */
    public function payment_options()
    {
        return $this->hasMany('App\TravelPayments');
    }

	/**
     * Get the cost for the trip.
     */
    public function costs()
    {
        return $this->hasMany('App\TripCosts');
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
