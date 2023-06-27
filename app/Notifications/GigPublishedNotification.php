<?php

namespace App\Notifications;

use App\Gig;
use App\Mail\GigPublishedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class GigPublishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Gig $gig)
    {
    }

    public function via()
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new GigPublishedMail($this->gig, $notifiable))
            ->to($notifiable);
    }
}
