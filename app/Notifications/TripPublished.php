<?php namespace App\Notifications;

use App\Trip;
use Illuminate\Notifications\Notification;

class TripPublished extends Notification
{
    public $trip;

    public function __construct(Trip $trip)
    {
        $this->trip = $trip;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->trip->id,
            'slug' => $this->trip->slug,
            'title' => "{$this->trip->title} &middot; {$this->trip->localizedDate()}",
        ];
    }
}
