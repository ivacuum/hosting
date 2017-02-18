<?php namespace App\Notifications;

use App\News;
use Illuminate\Notifications\Notification;

class NewsPublished extends Notification
{
    public $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->news->id,
            'title' => $this->news->title,
        ];
    }
}
