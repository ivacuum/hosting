<?php namespace App\Listeners;

use App\Events\CommentPublished;
use App\Notifications\NewsCommentedNotification;
use App\Notifications\TorrentCommentedNotification;
use App\Notifications\TripCommentedNotification;

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

            \Notification::send($users, new NewsCommentedNotification($model, $comment));
        } elseif ($type === 'Torrent') {
            event(new \App\Events\Stats\TorrentCommented);

            \Notification::send($users, new TorrentCommentedNotification($model, $comment));
        } elseif ($type === 'Trip') {
            event(new \App\Events\Stats\TripCommented);

            \Notification::send($users, new TripCommentedNotification($model, $comment));
        }
    }
}
