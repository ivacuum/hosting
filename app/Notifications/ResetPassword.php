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
            ->subject('Восстановление пароля')
            ->line('Нажмите на кнопку для перехода к процедуре восстановления пароля')
            ->action('Восстановить пароль', url('/auth/password/reset/'.$this->token));
    }
}
