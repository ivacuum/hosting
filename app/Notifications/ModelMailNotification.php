<?php namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

abstract class ModelMailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $model;

    public function via($notifiable)
    {
        return ['mail'];
    }
}
