<?php

namespace App\Observers;

use App\Events\MagnetAddedAnonymously;
use App\Magnet;

class MagnetObserver
{
    public function created(Magnet $magnet)
    {
        event(new \App\Events\Stats\TorrentAdded);

        if ($magnet->isAnonymous()) {
            event(new MagnetAddedAnonymously($magnet));
        }
    }

    public function deleting(Magnet $magnet)
    {
        \DB::transaction(function () use ($magnet) {
            $magnet->comments->each->delete();
        });
    }

    public function saving(Magnet $magnet)
    {
        if ($magnet->isDirty('title') && str_starts_with($magnet->title, '[ATV')) {
            $magnet->title = preg_replace('/^\[ATV ?3\] /', '', $magnet->title);
        }
    }
}
