<?php

namespace App\Domain\Magnet\Observer;

use App\Domain\Magnet\Models\Magnet;
use App\Utilities\CacheHelper;
use Illuminate\Support\Str;

class MagnetObserver
{
    public function __construct(private CacheHelper $cache) {}

    public function created(Magnet $magnet): void
    {
        event(new \App\Events\Stats\TorrentAdded);

        $this->cache->forgetMagnets();
    }

    public function deleted(): void
    {
        $this->cache->forgetMagnets();
    }

    public function deleting(Magnet $magnet): void
    {
        \DB::transaction(static function () use ($magnet) {
            $magnet->comments->each->delete();
        });
    }

    public function saving(Magnet $magnet): void
    {
        if ($magnet->isDirty('title') && str_starts_with($magnet->title, '[ATV')) {
            $magnet->title = preg_replace('/^\[ATV ?3\] /', '', $magnet->title);
        }

        $this->maintainConsistency($magnet);
    }

    public function updated(Magnet $magnet): void
    {
        if ($magnet->wasChanged(['category_id', 'status'])) {
            $this->cache->forgetMagnets();
        }
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
