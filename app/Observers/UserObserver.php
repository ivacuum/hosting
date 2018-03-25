<?php namespace App\Observers;

use App\User as Model;

class UserObserver
{
    public function deleting(Model $model)
    {
        \DB::transaction(function () use ($model) {
            $model->chatMessages->each->delete();
            $model->comments->each->delete();
            $model->externalIdentities->each->delete();
            $model->images->each->delete();
            $model->news->each->delete();
            $model->torrents->each->delete();
            $model->trips->each->delete();
        });
    }
}
