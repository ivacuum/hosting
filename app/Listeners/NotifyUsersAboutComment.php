<?php namespace App\Listeners;

use App\Events\CommentPublished;
use App\Magnet;
use App\News;
use App\Notifications\NewsCommentedNotification;
use App\Notifications\TorrentCommentedNotification;
use App\Notifications\TripCommentedNotification;
use App\Trip;

class NotifyUsersAboutComment
{
    public function handle(CommentPublished $event)
    {
        $model = $event->comment->rel;
        $users = $event->comment->usersForNotification($model);

        if ($model instanceof News) {
            event(new \App\Events\Stats\NewsCommented);

            \Notification::send($users, new NewsCommentedNotification($model, $event->comment));
        } elseif ($model instanceof Magnet) {
            event(new \App\Events\Stats\TorrentCommented);

            \Notification::send($users, new TorrentCommentedNotification($model, $event->comment));
        } elseif ($model instanceof Trip) {
            event(new \App\Events\Stats\TripCommented);

            \Notification::send($users, new TripCommentedNotification($model, $event->comment));
        }
    }
}
