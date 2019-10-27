<?php namespace App\Notifications;

use App\Mail\NewsPublishedMail;
use App\News;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewsPublishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new NewsPublishedMail($this->news, $notifiable))
            ->to($notifiable);
    }
}
