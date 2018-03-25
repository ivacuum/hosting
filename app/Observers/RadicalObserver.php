<?php namespace App\Observers;

use App\Radical as Model;

class RadicalObserver
{
    public function deleting(Model $model)
    {
        \DB::transaction(function () use ($model) {
            $model->burnables()->delete();
            $model->kanjis()->detach();
        });
    }
}
