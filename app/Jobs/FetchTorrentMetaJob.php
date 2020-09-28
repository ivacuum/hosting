<?php namespace App\Jobs;

use App\Services\Rto;
use App\Torrent;
use Ivacuum\Generic\Services\Telegram;

class FetchTorrentMetaJob extends AbstractJob
{
    private array $rtoIds;

    public function __construct(int ...$rtoIds)
    {
        $this->rtoIds = $rtoIds;
    }

    public function handle(Rto $rto, Telegram $telegram)
    {
        $torrents = Torrent::query()
            ->whereIn('rto_id', $this->rtoIds)
            ->get();

        foreach ($rto->topicDataByIds($this->rtoIds)->getTopics() as $id => $response) {
            /** @var Torrent $torrent */
            $torrent = $torrents->firstWhere('rto_id', $id);

            // Раздача не найдена
            if ($response === null) {
                $torrent->softDelete();

                event(new \App\Events\Stats\TorrentNotFoundDeleted);

                $telegram->notifyAdmin("🧲️ Раздача не найдена и удалена\n\n{$torrent->title}\n{$torrent->externalLink()}\n\n{$torrent->novaLink()}");

                continue;
            }

            // Раздача закрыта как повтор
            if ($response->isDuplicate()) {
                $torrent->softDelete();

                event(new \App\Events\Stats\TorrentDuplicateDeleted);

                $telegram->notifyAdmin("🧲️ Раздача закрыта как повторная и удалена\n\n{$torrent->title}\n{$torrent->externalLink()}\n\n{$torrent->novaLink()}");

                continue;
            }

            // Ждем завершения модерации
            if ($response->isPremoderation()) {
                continue;
            }

            $torrent->size = $response->size;
            $torrent->title = $response->title;

            if ($response->infoHash !== $torrent->info_hash) {
                dispatch(new FetchTorrentBodyJob($torrent->rto_id));
            }

            $torrent->info_hash = $response->infoHash;
            $torrent->save();
        }
    }
}
