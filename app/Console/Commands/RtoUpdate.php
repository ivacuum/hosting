<?php

namespace App\Console\Commands;

use App\Jobs\FetchTorrentMetaJob;
use App\Magnet;
use App\Scope\MagnetPublishedScope;
use Illuminate\Support\Collection;
use Ivacuum\Generic\Commands\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:rto-update', 'Update magnet releases info from rto')]
class RtoUpdate extends Command
{
    protected $signature = 'app:rto-update';

    public function handle()
    {
        Magnet::query()
            ->tap(new MagnetPublishedScope)
            ->select(['id', 'rto_id'])
            ->orderByDesc('id')
            ->chunk(100, function (Collection $magnets) {
                $rtoIds = $magnets->pluck('rto_id')->all();

                dispatch(new FetchTorrentMetaJob(...$rtoIds));
            });
    }
}
