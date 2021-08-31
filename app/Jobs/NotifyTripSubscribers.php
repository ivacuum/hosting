<?php namespace App\Jobs;

use App\Notifications\TripPublishedNotification;
use App\Trip;
use App\User;

class NotifyTripSubscribers extends AbstractJob
{
    public function __construct(private Trip $trip)
    {
    }

    public function handle()
    {
        $users = User::where('notify_trips', 1)
            ->where('status', User::STATUS_ACTIVE)
            ->get();

        \Notification::send($users, new TripPublishedNotification($this->trip));
    }
}
