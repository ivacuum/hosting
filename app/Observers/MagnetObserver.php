<?php namespace App\Observers;

use App\Events\MagnetAddedAnonymously;
use App\Magnet as Model;

class MagnetObserver
{
    public function created(Model $model)
    {
        event(new \App\Events\Stats\TorrentAdded);

        if ($model->isAnonymous()) {
            event(new MagnetAddedAnonymously($model));
        }
    }

    public function deleting(Model $model)
    {
        \DB::transaction(function () use ($model) {
            $model->comments->each->delete();
        });
    }

    public function saving(Model $model)
    {
        if ($model->isDirty('title') && str_starts_with($model->title, '[ATV')) {
            $model->title = preg_replace('/^\[ATV ?3\] /', '', $model->title);
        }
    }
}
