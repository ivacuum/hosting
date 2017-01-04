<?php namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail()
    {
        return (new MailMessage)
            ->subject(trans('auth.password_remind_title'))
            ->line(trans('auth.change_password_email'))
            ->action(trans('auth.change_password'), action('Auth@passwordReset', $this->token));
    }
}
