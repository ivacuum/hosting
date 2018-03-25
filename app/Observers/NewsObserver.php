<?php namespace App\Observers;

use App\News as Model;

class NewsObserver
{
    public function deleting(Model $model)
    {
        \DB::transaction(function () use ($model) {
            $model->comments->each->delete();
        });
    }
}
