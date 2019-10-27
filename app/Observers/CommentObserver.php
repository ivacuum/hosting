<?php namespace App\Observers;

use App\Comment as Model;
use App\Events\CommentPublished;
use App\Mail\CommentConfirmMail;

class CommentObserver
{
    public function created(Model $model)
    {
        if ($model->status === Model::STATUS_PENDING) {
            \Mail::to($model->user)
                ->send(new CommentConfirmMail($model));
        }

        event(new \App\Events\Stats\CommentAdded);
    }

    public function saving(Model $model)
    {
        if ($model->isDirty('status')) {
            $was = $model->getOriginalWithCast('status');

            if ($was === Model::STATUS_PENDING && $model->status === Model::STATUS_PUBLISHED) {
                $model->created_at = now();
            }
        }
    }

    public function saved(Model $model)
    {
        if ($model->isDirty('status')) {
            if (in_array($model->getOriginalWithCast('status'), [null, Model::STATUS_PENDING], true) &&
                $model->status === Model::STATUS_PUBLISHED) {
                event(new CommentPublished($model));
            }
        }
    }
}
