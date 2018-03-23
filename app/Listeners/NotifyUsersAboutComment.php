<?php namespace App\Listeners;

use App\Events\CommentPublished;
use App\Notifications\NewsCommented;
use App\Notifications\TorrentCommented;
use App\Notifications\TripCommented;

class NotifyUsersAboutComment
{
    public function handle(CommentPublished $event)
    {
        $model = $event->comment->rel;
        $comment = $event->comment;

        $type = $model->getMorphClass();
        $users = $comment->usersForNotification($model);

        if ($type === 'News') {
            event(new \App\Events\Stats\NewsCommented);

            \Notification::send($users, new NewsCommented($model, $comment));
        } elseif ($type === 'Torrent') {
            event(new \App\Events\Stats\TorrentCommented);

            \Notification::send($users, new TorrentCommented($model, $comment));
        } elseif ($type === 'Trip') {
            event(new \App\Events\Stats\TripCommented);

            \Notification::send($users, new TripCommented($model, $comment));
        }
    }
}
