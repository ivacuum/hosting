<?php namespace App\Http\Controllers;

use App\Comment;
use App\Limits\CommentsTodayLimit;
use App\News;
use App\Notifications\NewsCommented;
use App\Notifications\TorrentCommented;
use App\Notifications\TripCommented;
use App\Torrent;
use App\Trip;

class AjaxComment extends Controller
{
    public function store($type, $id)
    {
        $text = e(request('text'));
        $user_id = request()->user()->id;

        $validator = \Validator::make(compact('id', 'text', 'type'), [
            'id' => 'integer|min:1',
            'text' => 'required|max:1000',
            'type' => 'in:news,torrent,trip'
        ]);

        $this->validateWith($validator);

        $model = $this->notifiableModel($type, $id);

        $limits = new CommentsTodayLimit;

        if ($limits->ipExceeded() || $limits->userExceeded()) {
            return redirect($model->www())->with('message', trans('limits.comment'));
        }

        /* @var Comment $comment */
        $comment = $model->comments()->create([
            'html' => $text,
            'status' => Comment::STATUS_PUBLISHED,
            'user_id' => $user_id,
        ]);

        $this->notifyUsersAboutComment($type, $model, $comment);

        return $this->redirectToComment($type, $model, $comment);
    }

    /**
     * @param  string  $type
     * @param  integer $id
     * @return \App\News|\App\Trip|\App\Torrent
     * @throws \Exception
     */
    protected function notifiableModel(string $type, int $id)
    {
        if ($type === 'news') {
            return News::published()->findOrFail($id);
        } elseif ($type === 'trip') {
            return Trip::published()->findOrFail($id);
        } elseif ($type === 'torrent') {
            return Torrent::published()->findOrFail($id);
        }

        throw new \Exception('Не выбран объект для комментирования');
    }

    protected function notifyUsersAboutComment(string $type, $model, Comment $comment): bool
    {
        event(new \App\Events\Stats\CommentAdded);

        if ($type === 'news') {
            event(new \App\Events\Stats\NewsCommented);

            \Notification::send($comment->usersForNotification($model), new NewsCommented($model, $comment));

            return true;
        }

        if ($type === 'trip') {
            event(new \App\Events\Stats\TripCommented);

            \Notification::send($comment->usersForNotification($model), new TripCommented($model, $comment));

            return true;
        }

        if ($type === 'torrent') {
            event(new \App\Events\Stats\TorrentCommented);

            \Notification::send($comment->usersForNotification($model), new TorrentCommented($model, $comment));

            return true;
        }

        return false;
    }

    protected function redirectToComment(string $type, $model, Comment $comment)
    {
        $anchor = "#comment-{$comment->id}";
        if ($type === 'news') {
            return redirect(path('News@show', [$model->id, $anchor]));
        } elseif ($type === 'trip') {
            return redirect(path('Life@page', [$model->slug, $anchor]));
        } elseif ($type === 'torrent') {
            return redirect(path('Torrents@show', [$model->id, $anchor]));
        }

        return back()->with('message', trans('comments.posted'));
    }
}
