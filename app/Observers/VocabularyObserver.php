<?php namespace App\Observers;

use App\Vocabulary as Model;

class VocabularyObserver
{
    public function deleting(Model $model)
    {
        \DB::transaction(function () use ($model) {
            $model->burnables()->delete();
        });
    }
}
