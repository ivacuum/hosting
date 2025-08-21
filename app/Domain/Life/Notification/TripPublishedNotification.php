<?php

namespace App\Domain\Life\Notification;

use App\Domain\Life\Mail\TripPublishedMail;
use App\Domain\Life\Models\Trip;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class TripPublishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Trip $trip) {}

    public function via()
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return new TripPublishedMail($this->trip, $notifiable)
            ->to($notifiable);
    }
}
