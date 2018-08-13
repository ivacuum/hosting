<?php namespace App\Notifications;

use App\Mail\NewsPublished as Mailable;
use App\News as Model;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewsPublished extends Notification implements ShouldQueue
{
    use Queueable;

    public $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new Mailable($this->model, $notifiable))
            ->to($notifiable->email);
    }
}
