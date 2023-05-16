<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Proposal extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($project, $message)
    {
        $this->project = $project;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user.proposal');
    }
}
