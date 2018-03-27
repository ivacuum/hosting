<?php namespace App\Observers;

use App\Comment as Model;
use App\Events\CommentPublished;
use App\Mail\CommentConfirm;

class CommentObserver
{
    public function created(Model $model)
    {
        if ($model->status === Model::STATUS_PENDING) {
            \Mail::to($model->user->email)
                ->queue(new CommentConfirm($model));
        }
    }

    public function saved(Model $model)
    {
        if ($model->isDirty('status')) {
            if (in_array($model->getOriginal('status'), [null, Model::STATUS_PENDING], true) &&
                $model->status === Model::STATUS_PUBLISHED) {
                event(new CommentPublished($model));
            }
        }
    }
}