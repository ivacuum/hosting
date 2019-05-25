<?php namespace App\Jobs;

use App\Notifications\TripPublished;
use App\Trip;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyTripSubscribers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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

        \Notification::send($users, new TripPublished($this->trip));
    }
}