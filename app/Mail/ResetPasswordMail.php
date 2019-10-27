<?php namespace App\Mail;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class ResetPasswordMail extends Mailable implements ShouldQueue
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function build()
    {
        return $this->subject(trans('auth.password_remind_title'))
            ->markdown('emails.auth.reset-password');
    }
}
