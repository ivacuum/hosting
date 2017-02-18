<?php namespace App\Notifications;

use App\Comment;
use App\Trip;
use Illuminate\Notifications\Notification;

class TripCommented extends Notification
{
    public $trip;
    public $comment;

    public function __construct(Trip $trip, Comment $comment)
    {
        $this->trip = $trip;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return $notifiable->id !== $this->comment->user_id ? ['database'] : [];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->trip->id,
            'slug' => $this->trip->slug,
            'title' => "{$this->trip->title} &middot; {$this->trip->localizedDate()}",
            'comment' => [
                'id' => $this->comment->id,
                'html' => $this->comment->html,
                'user' => [
                    'id' => $this->comment->user_id,
                    'name' => $this->comment->user->publicName(),
                ],
            ],
        ];
    }
}
