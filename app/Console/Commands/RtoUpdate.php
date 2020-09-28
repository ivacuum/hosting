<?php namespace App\Console\Commands;

use App\Jobs\FetchTorrentMetaJob;
use App\Torrent;
use Illuminate\Support\Collection;
use Ivacuum\Generic\Commands\Command;

class RtoUpdate extends Command
{
    protected $signature = 'app:rto-update';
    protected $description = 'Update torrent releases info from rto';

    public function handle()
    {
        Torrent::published()
            ->select(['id', 'rto_id'])
            ->orderByDesc('id')
            ->chunk(100, function (Collection $torrents) {
                $rtoIds = $torrents->pluck('rto_id')->all();

                dispatch(new FetchTorrentMetaJob(...$rtoIds));
            });
    }
}
