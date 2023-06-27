<?php

namespace App\Jobs;

use App\Domain\MagnetStatus;
use App\Magnet;
use App\Services\Rto;
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
        $magnets = Magnet::query()
            ->whereIn('rto_id', $this->rtoIds)
            ->get();

        foreach ($rto->topicDataByIds($this->rtoIds)->topics as $id => $response) {
            /** @var Magnet $magnet */
            $magnet = $magnets->firstWhere('rto_id', $id);

            // Раздача уже заменена
            if ($magnet === null) {
                continue;
            }

            // Раздача не найдена
            if ($response === null) {
                $magnet->status = MagnetStatus::Deleted;
                $magnet->save();

                event(new \App\Events\Stats\TorrentNotFoundDeleted);

                $telegram->notifyAdmin("🧲️ Раздача не найдена и удалена\n\n{$magnet->title}\n{$magnet->externalLink()}\n\n" . url($magnet->wwwAcp()));

                continue;
            }

            // Раздача закрыта как повтор
            if ($response->status->isDuplicate()) {
                $magnet->status = MagnetStatus::Deleted;
                $magnet->save();

                event(new \App\Events\Stats\TorrentDuplicateDeleted);

                $telegram->notifyAdmin("🧲️ Раздача закрыта как повторная и удалена\n\n{$magnet->title}\n{$magnet->externalLink()}\n\n" . url($magnet->wwwAcp()));

                continue;
            }

            // Ждем завершения модерации
            if ($response->status->isPremoderation()) {
                continue;
            }

            $magnet->size = $response->size;
            $magnet->title = $response->title;

            if ($response->infoHash !== $magnet->info_hash) {
                dispatch(new FetchTorrentBodyJob($magnet->rto_id));
            }

            $magnet->info_hash = $response->infoHash;
            $magnet->save();
        }
    }
}
