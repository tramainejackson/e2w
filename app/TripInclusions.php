<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripInclusions extends Model
{
    /**
     * Get the trip for the picture.
     */
    public function trip()
    {
        return $this->belongsTo('App\TripLocations');
    }
}
