<?php namespace App\Observers;

use App\Trip as Model;

class TripObserver
{
    public function deleting(Model $model)
    {
        \DB::transaction(function () use ($model) {
            $model->comments->each->delete();
        });
    }
}
