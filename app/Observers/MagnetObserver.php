<?php

namespace App\Observers;

use App\Magnet;
use App\Notifications\AnonymousMagnetNotification;

class MagnetObserver
{
    public function created(Magnet $magnet)
    {
        event(new \App\Events\Stats\TorrentAdded);

        if ($magnet->isAnonymous()) {
            $magnet->notify(new AnonymousMagnetNotification($magnet));
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
