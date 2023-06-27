<?php

namespace App\Mail;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class ResetPasswordMail extends Mailable implements ShouldQueue
{
    public function __construct(public string $token)
    {
    }

    public function build()
    {
        return $this->subject(__('auth.password_remind_title'))
            ->markdown('emails.auth.reset-password');
    }
}
