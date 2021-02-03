<?php

namespace App\Mail;

use App\Contact;
use App\DistributionList;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Update extends Mailable
{
    use Queueable, SerializesModels;

    /**
	* The contact instance
	*
	* @var contact
	*/
	public $contact;
	public $participant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact, DistributionList $participant) {
        $this->contact = $contact;
        $this->participant = $participant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
		
        return $this->subject('E2W')->view('emails.new_message', compact('contact', 'participant'));
    }
}
