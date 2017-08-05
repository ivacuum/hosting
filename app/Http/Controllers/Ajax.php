<?php namespace App\Http\Controllers;

use App\ChatMessage;
use App\Comment;
use App\News;
use App\Notifications\NewsCommented;
use App\Notifications\TorrentCommented;
use App\Notifications\TripCommented;
use App\Torrent;
use App\Trip;

class Ajax extends Controller
{
    public function chat()
    {
        $messages = ChatMessage::with('user')
            ->where('status', ChatMessage::STATUS_PUBLISHED)
            ->orderBy('id', 'desc')
            ->take(20)
            ->get()
            ->reverse()
            ->map(function ($item) {
                /* @var \App\ChatMessage $item */
                return [
                    'date' => $item->created_at->toDateString(),
                    'time' => $item->created_at->toTimeString(),
                    'html' => $item->html,
                    'author' => $item->user->publicName(),
                ];
            })
            ->values();

        return compact('messages');
    }

    public function chatPost()
    {
        $this->validate($this->request, [
            'mail' => 'empty',
            'text' => 'required|max:1000',
        ]);

        $text = trim($this->request->input('text'));

        $chat_message = ChatMessage::create([
            'ip' => $this->request->ip(),
            'text' => $text,
            'status' => ChatMessage::STATUS_PUBLISHED,
            'user_id' => \Auth::user()->id,
        ]);

        $message = [
            'date' => $chat_message->created_at->toDateString(),
            'time' => $chat_message->created_at->toTimeString(),
            'html' => $chat_message->html,
            'author' => \Auth::user()->publicName(),
        ];

        broadcast(new \App\Events\ChatMessage($message));

        return compact('message');
    }

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
    protected function notifiableModel($type, $id)
    {
        if ($type === 'news') {
            return News::published()->findOrFail($id);
        }

        if ($type === 'trip') {
            return Trip::published()->findOrFail($id);
        }

        if ($type === 'torrent') {
            return Torrent::published()->findOrFail($id);
        }

        throw new \Exception('Не выбран объект для комментирования');
    }

    protected function notifyUsersAboutComment($type, $model, Comment $comment)
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

    protected function redirectToComment($type, $model, Comment $comment)
    {
        if ($type === 'news') {
            return redirect(path('News@show', [$model->id, "#comment-{$comment->id}"]));
        }

        if ($type === 'trip') {
            return redirect(path('Life@page', [$model->slug, "#comment-{$comment->id}"]));
        }

        if ($type === 'torrent') {
            return redirect(path('Torrents@torrent', [$model->id, "#comment-{$comment->id}"]));
        }

        return back()->with('message', trans('comments.posted'));
    }
}
