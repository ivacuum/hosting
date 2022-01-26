<?php namespace App\Observers;

use App\Comment as Model;
use App\Domain\CommentStatus;
use App\Events\CommentPublished;
use App\Mail\CommentConfirmMail;

class CommentObserver
{
    public function created(Model $model)
    {
        if ($model->status->isPending()) {
            \Mail::to($model->user)
                ->send(new CommentConfirmMail($model));
        }

        event(new \App\Events\Stats\CommentAdded);
    }

    public function saving(Model $model)
    {
        if ($model->isDirty('status')) {
            /** @var CommentStatus $was */
            $was = $model->getOriginal('status');

            if ($was?->isPending() && $model->status->isPublished()) {
                $model->created_at = now();
            }
        }
    }

    public function saved(Model $model)
    {
        if ($model->isDirty('status')) {
            if (in_array($model->getOriginal('status'), [null, CommentStatus::Pending], true) &&
                $model->status->isPublished()) {
                event(new CommentPublished($model));
            }
        }
    }
}
