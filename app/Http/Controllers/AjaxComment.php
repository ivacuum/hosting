<?php namespace App\Http\Controllers;

use App\Comment;
use App\Exceptions\CommentLimitExceededException;
use App\Http\Requests\CommentStore;
use App\Http\Resources\Comment as CommentResource;
use App\Limits\CommentsTodayLimit;
use App\News;
use App\Torrent;
use App\Trip;
use App\User;
use Ivacuum\Generic\Exceptions\FloodException;

class AjaxComment extends Controller
{
    public function store(string $type, int $id, CommentsTodayLimit $limits, CommentStore $request)
    {
        $text = $request->input('text');
        $email = $request->input('email');

        /* @var User $user */
        $user = $request->user();
        $is_guest = null === $user;

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
        $comment = new Comment([
            'html' => $text,
            'status' => $is_guest ? Comment::STATUS_PENDING : Comment::STATUS_PUBLISHED,
            'user_id' => $user->id,
        ]);

        $comment->setRelation('user', $user);

        $model->comments()->save($comment);

        if ($request->expectsJson()) {
            return new CommentResource($comment);
        }

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
