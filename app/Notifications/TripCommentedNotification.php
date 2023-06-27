<?php

namespace App\Notifications;

use App\Comment;
use App\Trip;
use Illuminate\Notifications\Notification;

class TripCommentedNotification extends Notification
{
    public function __construct(public Trip $trip, public Comment $comment)
    {
    }

    public function via($notifiable)
    {
        return $notifiable->id !== $this->comment->user_id
            ? ['database']
            : [];
    }

    public function toArray()
    {
        return [
            'id' => $this->trip->id,
            'slug' => $this->trip->slug,
            'title' => "{$this->trip->title} · {$this->trip->localizedDate()}",
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
