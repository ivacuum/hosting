<?php namespace App\Jobs;

use App\Notifications\TripPublishedNotification;
use App\Trip;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyTripSubscribers implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $trip;

    public function __construct(Trip $trip)
    {
        $this->trip = $trip;
    }

    public function handle()
    {
        $users = User::where('notify_trips', 1)
            ->where('status', User::STATUS_ACTIVE)
            ->get();

        \Notification::send($users, new TripPublishedNotification($this->trip));
    }
}
