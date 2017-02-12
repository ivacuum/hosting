<?php namespace App\Mail;

use Illuminate\Mail\Mailable;

class ResetPassword extends Mailable
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
