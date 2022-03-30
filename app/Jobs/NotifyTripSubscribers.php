<?php namespace App\Jobs;

use App\Domain\NotificationDeliveryMethod;
use App\Domain\UserStatus;
use App\Notifications\TripPublishedNotification;
use App\Trip;
use App\User;
use Illuminate\Queue\SerializesModels;

class NotifyTripSubscribers extends AbstractJob
{
    use SerializesModels;

    public function __construct(private Trip $trip)
    {
    }

    public function handle()
    {
        $users = User::where('notify_trips', NotificationDeliveryMethod::Mail)
            ->where('status', UserStatus::Active)
            ->get();

        \Notification::send($users, new TripPublishedNotification($this->trip));
    }
}
