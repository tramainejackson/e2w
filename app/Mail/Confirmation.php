<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Confirmation extends Mailable
{
    use Queueable, SerializesModels;

	public $firstname;
	public $trip;
	public $lastname;
	public $email;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($trip, $firstname, $lastname, $email)
    {
        $this->trip = $trip;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('E2W ' . $this->trip->trip_location . ' Sign Up')->view('emails.confirmation', compact('trip', 'firstname', 'lastname', 'email'));
    }
}
