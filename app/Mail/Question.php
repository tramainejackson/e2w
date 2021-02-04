<?php

namespace App\Mail;

use App\TravelQuestions;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Question extends Mailable
{
    use Queueable, SerializesModels;

    /**
	* The travel question instance
	*
	* @var question
	*/
	public $question;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TravelQuestions $question) {
        $this->question = $question;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
		
        return $this->subject('E2W Comment Received')->view('emails.new_question', compact('question'));
    }
}
