<?php namespace App\Notifications;

use App\Gig as Model;
use App\Mail\GigPublished as Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class GigPublished extends Notification implements ShouldQueue
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
