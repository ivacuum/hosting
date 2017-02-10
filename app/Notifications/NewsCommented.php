<?php namespace App\Notifications;

use App\Comment;
use App\News;
use Illuminate\Notifications\Notification;

class NewsCommented extends Notification
{
    public $comment;
    public $news;

    public function __construct(News $news, Comment $comment)
    {
        $this->news = $news;
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return $notifiable->id !== $this->comment->user_id ? ['database'] : [];
    }

    public function toArray($notifiable)
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
