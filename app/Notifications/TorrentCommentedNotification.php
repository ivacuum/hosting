<?php namespace App\Notifications;

use App\Comment;
use App\Torrent;
use Illuminate\Notifications\Notification;

class TorrentCommentedNotification extends Notification
{
    public function __construct(public Torrent $torrent, public Comment $comment)
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
            'id' => $this->torrent->id,
            'title' => $this->torrent->shortTitle(),
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
