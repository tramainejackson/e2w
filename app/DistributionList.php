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
     * Get the trip for the participant.
     */
    public function trip()
    {
        return $this->belongsTo('App\TripLocations');
    }
}
