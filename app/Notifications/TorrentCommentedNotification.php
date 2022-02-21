<?php namespace App\Notifications;

use App\Comment;
use App\Magnet;
use Illuminate\Notifications\Notification;

class TorrentCommentedNotification extends Notification
{
    public function __construct(public Magnet $magnet, public Comment $comment)
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
            'id' => $this->magnet->id,
            'title' => $this->magnet->shortTitle(),
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
