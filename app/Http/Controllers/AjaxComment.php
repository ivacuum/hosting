<?php namespace App\Http\Controllers;

use App\Action\FindUserByEmailOrCreateAction;
use App\Comment;
use App\Domain\Commentable;
use App\Domain\CommentStatus;
use App\Exceptions\CommentLimitExceededException;
use App\Http\Requests\CommentStoreForm;
use App\Http\Resources;
use App\Limits\CommentsTodayLimit;
use App\Magnet;
use App\News;
use App\Trip;
use Ivacuum\Generic\Exceptions\FloodException;

class AjaxComment extends Controller
{
    public function store(
        Commentable $commentable,
        int $id,
        CommentsTodayLimit $limits,
        CommentStoreForm $request,
        FindUserByEmailOrCreateAction $findUserByEmailOrCreate
    ) {
        $user = $request->user;
        $isGuest = $request->isGuest();

        if ($isGuest) {
            $user = $findUserByEmailOrCreate->execute($request->email);

            if ($user->wasRecentlyCreated) {
                event(new \App\Events\Stats\UserRegisteredAutoWhenCommentAdded);
            } else {
                event(new \App\Events\Stats\UserFoundByEmailWhenCommentAdded);
            }
        }

        $model = $this->notifiableModel($commentable, $id);

        if ($limits->flood($user->id)) {
            throw new FloodException;
        } elseif ($limits->ipExceeded() || $limits->userExceeded($user->id)) {
            throw new CommentLimitExceededException;
        }

        $comment = new Comment;
        $comment->html = $request->text;
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

    protected function notifiableModel(Commentable $commentable, int $id): Magnet|News|Trip
    {
        return match ($commentable) {
            Commentable::Magnet => Magnet::query()->published()->findOrFail($id),
            Commentable::News => News::query()->published()->findOrFail($id),
            Commentable::Trip => Trip::query()->published()->findOrFail($id),
        };
    }

    protected function redirectToComment(Magnet|News|Trip $model, ?Comment $comment)
    {
        if (method_exists($model, 'www')) {
            return $comment === null
                ? redirect($model->www())->with('message', __('Комментарий ожидает активации. Мы отправили вам ссылку на электронную почту.'))
                : redirect($model->www($comment->anchor()));
        }

        return back()->with('message', __($comment === null ? 'Комментарий ожидает активации. Мы отправили вам ссылку на электронную почту.' : 'Комментарий опубликован'));
    }
}
