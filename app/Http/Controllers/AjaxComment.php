<?php namespace App\Http\Controllers;

use App\Comment;
use App\Exceptions\CommentLimitExceededException;
use App\Limits\CommentsTodayLimit;
use App\News;
use App\Torrent;
use App\Trip;
use App\User;
use Ivacuum\Generic\Exceptions\FloodException;

class AjaxComment extends Controller
{
    public function store($type, $id, CommentsTodayLimit $limits)
    {
        $text = e(request('text'));
        $email = request('email');

        /* @var User $user */
        $user = request()->user();
        $is_guest = null === $user;

        $this->validateWith(\Validator::make(compact('id', 'text', 'type', 'email'), [
            'id' => 'integer|min:1',
            'text' => 'required|max:1000',
            'type' => 'in:news,torrent,trip',
            'email' => $is_guest ? 'required|email|max:125' : '',
        ]));

        if ($is_guest) {
            $user = (new User)->findByEmailOrCreate([
                'email' => $email,
                'status' => User::STATUS_INACTIVE,
            ]);

            if ($user->wasRecentlyCreated) {
                event(new \App\Events\Stats\UserRegisteredAutoWhenCommentAdded);
            } else {
                event(new \App\Events\Stats\UserFoundByEmailWhenCommentAdded);
            }
        }

        $model = $this->notifiableModel($type, $id);

        if ($limits->flood($user->id)) {
            throw new FloodException;
        } elseif ($limits->ipExceeded() || $limits->userExceeded($user->id)) {
            throw new CommentLimitExceededException;
        }

        /* @var Comment $comment */
        $comment = $model->comments()->create([
            'html' => $text,
            'status' => $is_guest ? Comment::STATUS_PENDING : Comment::STATUS_PUBLISHED,
            'user_id' => $user->id,
        ]);

        event(new \App\Events\Stats\CommentAdded);

        return $this->redirectToComment($model, $is_guest ? null : $comment);
    }

    /**
     * @param  string  $type
     * @param  integer $id
     * @return \App\News|\App\Torrent|\App\Trip
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

    protected function redirectToComment($model, ?Comment $comment)
    {
        if (method_exists($model, 'www')) {
            return $comment === null
                ? redirect($model->www())->with('message', trans('comments.pending'))
                : redirect($model->www($comment->anchor()));
        }

        return back()->with('message', trans($comment === null ? 'comments.pending' : 'comments.posted'));
    }
}
