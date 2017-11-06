<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributionList extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'first_name', 
		'last_name', 
		'email', 
		'phone',
		'notes',
		'paid_in_full'
	];
	
    /**
     * Get the trip for the participant.
     */
    public function trip()
    {
        return $this->belongsTo('App\TripLocations');
    }
}
