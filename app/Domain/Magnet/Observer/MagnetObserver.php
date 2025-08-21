<?php

namespace App\Domain\Magnet\Observer;

use App\Domain\Magnet\Models\Magnet;
use Illuminate\Support\Str;

class MagnetObserver
{
    public function created(Magnet $magnet)
    {
        event(new \App\Events\Stats\TorrentAdded);
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

        $this->maintainConsistency($magnet);
    }

    private function maintainConsistency(Magnet $magnet): void
    {
        $magnet->html = Str::trim($magnet->html);
        $magnet->title = Str::trim($magnet->title);
        $magnet->announcer = Str::trim($magnet->announcer);
        $magnet->info_hash = Str::trim($magnet->info_hash);
        $magnet->related_query = Str::trim($magnet->related_query);
    }
}
