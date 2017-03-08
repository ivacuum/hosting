<?php namespace App\Http\Controllers;

use App\Comment;
use App\News;
use App\Notifications\NewsCommented;
use App\Notifications\TorrentCommented;
use App\Notifications\TripCommented;
use App\Torrent;
use App\Trip;
use App\User;

class Ajax extends Controller
{
    public function comment($type, $id)
    {
        $mail = $this->request->input('mail');
        $text = e($this->request->input('text'));
        $user_id = $this->request->user()->id;

        $validator = \Validator::make(compact('id', 'mail', 'text', 'type'), [
            'id' => 'integer|min:1',
            'mail' => 'empty',
            'text' => 'required|max:1000',
            'type' => 'in:news,torrent,trip'
        ]);

        $this->validateWith($validator);

        $model = $this->notifiableModel($type, $id);

        $comment = $model->comments()->create([
            'html' => $text,
            'user_id' => $user_id,
        ]);

        $this->notifyUsersAboutComment($type, $model, $comment);

        return back()->with('message', trans('comments.posted'));
    }

    protected function notifiableModel($type, $id)
    {
        if ($type === 'news') {
            return News::published()->findOrFail($id);
        }

        if ($type === 'trip') {
            return Trip::published()->findOrFail($id);
        }

        if ($type === 'torrent') {
            return Torrent::findOrFail($id);
        }

        throw new \Exception('Не выбран объект для комментирования');
    }

    protected function notifyUsersAboutComment($type, $model, Comment $comment)
    {
        event(new \App\Events\Stats\CommentAdded());

        if ($type === 'news') {
            event(new \App\Events\Stats\NewsCommented());

            \Notification::send($comment->usersForNotification($model), new NewsCommented($model, $comment));

            return true;
        }

        if ($type === 'trip') {
            event(new \App\Events\Stats\TripCommented());

            \Notification::send($comment->usersForNotification($model), new TripCommented($model, $comment));

            return true;
        }

        if ($type === 'torrent') {
            event(new \App\Events\Stats\TorrentCommented());

            \Notification::send($comment->usersForNotification($model), new TorrentCommented($model, $comment));

            return true;
        }

        return false;
    }
}
