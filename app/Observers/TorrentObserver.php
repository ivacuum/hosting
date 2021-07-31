<?php namespace App\Observers;

use App\Events\TorrentAddedAnonymously;
use App\Torrent as Model;

class TorrentObserver
{
    public function created(Model $model)
    {
        event(new \App\Events\Stats\TorrentAdded);

        if ($model->isAnonymous()) {
            event(new TorrentAddedAnonymously($model));
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
