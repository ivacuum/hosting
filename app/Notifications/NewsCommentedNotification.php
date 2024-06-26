<?php

namespace App\Notifications;

use App\Comment;
use App\News;
use Illuminate\Notifications\Notification;

class NewsCommentedNotification extends Notification
{
    public function __construct(public News $news, public Comment $comment) {}

    public function via($notifiable)
    {
        return $notifiable->id !== $this->comment->user_id
            ? ['database']
            : [];
    }

    public function toArray()
    {
        return [
            'id' => $this->news->id,
            'title' => $this->news->title,
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
