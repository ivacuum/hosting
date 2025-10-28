<?php

namespace App\Domain\Life\Job;

use App\Domain\Life\Models\Trip;
use App\Domain\Life\Notification\TripPublishedNotification;
use App\Domain\NotificationDeliveryMethod;
use App\Domain\UserStatus;
use App\Jobs\AbstractJob;
use App\User;
use Illuminate\Queue\Attributes\WithoutRelations;

#[WithoutRelations]
class NotifyTripSubscribersJob extends AbstractJob
{
    public function __construct(private Trip $trip) {}

    public function handle()
    {
        $users = User::query()
            ->where('notify_trips', NotificationDeliveryMethod::Mail)
            ->where('status', UserStatus::Active)
            ->get();

        \Notification::send($users, new TripPublishedNotification($this->trip));
    }
}
