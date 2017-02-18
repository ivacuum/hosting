<?php namespace App\Http\Controllers;

use App\Mail\Feedback;
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

        return redirect()->back()->with('message', trans('comments.posted'));
    }

    /*
    public function feedback()
    {
        $this->validate($this->request, [
            'mail' => 'empty',
            'text' => 'required',
        ]);

        $text = $this->request->input('text');
        $referer = $this->request->server('HTTP_REFERER');
        $question = $this->request->input('question');

        register_shutdown_function(function () use ($question, $referer, $text) {
            \Mail::send(new Feedback($referer, $question, $text));
        });

        return [
            'message' => trans('ajax.feedback.ok'),
            'status'  => 'OK',
        ];
    }
    */

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

    protected function notifyUsersAboutComment($type, $model, $comment)
    {
        event(new \App\Events\Stats\CommentAdded());

        if ($type === 'news') {
            event(new \App\Events\Stats\NewsCommented());

            return $model->user->notify(new NewsCommented($model, $comment));
        }

        if ($type === 'trip') {
            event(new \App\Events\Stats\TripCommented());

            return User::find(Trip::AUTHOR_ID)->notify(new TripCommented($model, $comment));
        }

        if ($type === 'torrent') {
            event(new \App\Events\Stats\TorrentCommented());
            
            return $model->user->notify(new TorrentCommented($model, $comment));
        }
    }
}
