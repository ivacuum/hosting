<?php namespace App\Observers;

use App\Kanji as Model;

class KanjiObserver
{
    public function deleting(Model $model)
    {
        \DB::transaction(function () use ($model) {
            $model->burnables()->delete();
            $model->radicals()->detach();
        });
    }
}
