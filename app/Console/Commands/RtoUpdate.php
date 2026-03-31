<?php

namespace App\Console\Commands;

use App\Domain\Magnet\Job\FetchTorrentMetaJob;
use App\Domain\Magnet\Models\Magnet;
use App\Domain\Magnet\Scope\MagnetPublishedScope;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Support\Collection;

#[Signature('app:rto-update')]
#[Description('Update magnet releases info from rto')]
class RtoUpdate extends Command
{
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
