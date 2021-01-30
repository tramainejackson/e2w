<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
		'paid_in_full',
		'parent_acct_id'
	];

	/**
	 * Get the first name for the participant.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getFirstNameAttribute($value)
	{
		return mb_convert_case(mb_strtolower($value, "UTF-8"), MB_CASE_TITLE, "UTF-8");
	}

	/**
	 * Get the last name for the participant.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getLastNameAttribute($value)
	{
		return mb_convert_case(mb_strtolower($value, "UTF-8"), MB_CASE_TITLE, "UTF-8");
	}

	/**
	 * Get the email address for the participant.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getEmailAttribute($value)
	{
		return strtolower($value);
	}

	/**
	 * Get the phone number for the participant.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getPhoneAttribute($value)
	{
		return $value != null ? $value : 'No Phone Number Added';
	}

	/**
	 * Set the phone number for the participant.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function setPhoneAttribute($value)
	{
		return $value == 'No Phone Number Added' ? null : $value;
	}

	/**
	 * Set the first name for the participant.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function setFirstNameAttribute($value)
	{
		$this->attributes['first_name'] = mb_convert_case(mb_strtolower($value, "UTF-8"), MB_CASE_TITLE, "UTF-8");
	}

	/**
	 * Set the last name for the participant.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function setLastNameAttribute($value)
	{
		$this->attributes['last_name'] = mb_convert_case(mb_strtolower($value, "UTF-8"), MB_CASE_TITLE, "UTF-8");
	}

	/**
	 * Set the email address for the participant.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function setEmailAttribute($value)
	{
		$this->attributes['email'] = strtolower($value);
	}

	/**
	 * Set the email address for the participant.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function full_name()
	{
		return $this->first_name . " " . $this->last_name;
	}

	/**
	 * Scope a query to only include unique users.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeUniqueContacts($query)
	{
		return $query->where('trip_id', null)->get();
	}

	/**
	 * Scope a query to get all trips user has been added to.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeAllTrips($query, $parent_id)
	{
		return $query->where('parent_acct_id', $parent_id)->get();
	}

	/**
     * Get the trip for the participant.
     */
    public function trip()
    {
        return $this->belongsTo('App\TripLocations');
    }
}
