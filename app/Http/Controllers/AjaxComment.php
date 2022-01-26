<?php namespace App\Http\Controllers;

use App\Comment;
use App\Domain\CommentStatus;
use App\Exceptions\CommentLimitExceededException;
use App\Http\Requests\CommentStoreForm;
use App\Http\Resources;
use App\Limits\CommentsTodayLimit;
use App\News;
use App\Torrent;
use App\Trip;
use App\User;
use Ivacuum\Generic\Exceptions\FloodException;

class AjaxComment extends Controller
{
    public function store(string $type, int $id, CommentsTodayLimit $limits, CommentStoreForm $request)
    {
        $text = $request->input('text');
        $user = $request->userModel();
        $email = $request->input('email');
        $isGuest = $request->isGuest();

        if ($isGuest) {
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

        $comment = new Comment;
        $comment->html = $text;
        $comment->status = $isGuest
            ? CommentStatus::Pending
            : CommentStatus::Published;
        $comment->user_id = $user->id;
        $comment->setRelation('user', $user);

        $model->comments()->save($comment);

        if ($request->expectsJson()) {
            return new Resources\Comment($comment);
        }

        return $this->redirectToComment($model, $isGuest ? null : $comment);
    }

    /**
     * @param string $type
     * @param int $id
     * @return \App\News|\App\Torrent|\App\Trip
     */
    protected function notifiableModel(string $type, int $id)
    {
        if ($type === 'news') {
            return News::query()->published()->findOrFail($id);
        } elseif ($type === 'trip') {
            return Trip::query()->published()->findOrFail($id);
        } elseif ($type === 'torrent') {
            return Torrent::query()->published()->findOrFail($id);
        }

        throw new \Exception('Не выбран объект для комментирования');
    }

    protected function redirectToComment($model, ?Comment $comment)
    {
        if (method_exists($model, 'www')) {
            return $comment === null
                ? redirect($model->www())->with('message', __('Комментарий ожидает активации. Мы отправили вам ссылку на электронную почту.'))
                : redirect($model->www($comment->anchor()));
        }

        return back()->with('message', __($comment === null ? 'Комментарий ожидает активации. Мы отправили вам ссылку на электронную почту.' : 'Комментарий опубликован'));
    }
}
