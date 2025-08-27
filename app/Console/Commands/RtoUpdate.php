<?php

namespace App\Console\Commands;

use App\Domain\Magnet\Job\FetchTorrentMetaJob;
use App\Domain\Magnet\Models\Magnet;
use App\Domain\Magnet\Scope\MagnetPublishedScope;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:rto-update')]
class RtoUpdate extends Command
{
    protected $signature = 'app:rto-update';
    protected $description = 'Update magnet releases info from rto';

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
