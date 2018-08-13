<?php namespace App\Observers;

use App\Torrent as Model;

class TorrentObserver
{
    public function created(Model $model)
    {
        event(new \App\Events\Stats\TorrentAdded);
    }

    public function deleting(Model $model)
    {
        \DB::transaction(function () use ($model) {
            $model->comments->each->delete();
        });
    }

    public function saving(Model $model)
    {
        if ($model->isDirty('title') && 0 === mb_strpos($model->title, '[ATV')) {
            $model->title = preg_replace('/^\[ATV ?3\] /', '', $model->title);
        }
    }
}
