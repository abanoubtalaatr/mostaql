<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationUrl;
    public $message = '';

    public function __construct($verificationUrl, $message = null)
    {
        $this->message = $message;
        $this->verificationUrl = $verificationUrl;
    }

    public function build()
    {
        return $this->subject($this->message ?? 'تفعيل حسابك')
            ->markdown('emails.user.verify-email');
    }
}
