<?php namespace App\Observers;

use App\Tag as Model;

class TagObserver
{
    public function deleting(Model $model)
    {
        \DB::transaction(function () use ($model) {
            foreach ($model->photos as $photo) {
                $photo->tags()->detach($model->id);
            }
        });
    }
}
