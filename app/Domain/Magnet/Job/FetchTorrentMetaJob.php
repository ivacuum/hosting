<?php

namespace App\Domain\Magnet\Job;

use App\Attributes\WithoutFailedJobLog;
use App\Domain\Magnet\MagnetStatus;
use App\Domain\Magnet\Models\Magnet;
use App\Domain\Magnet\Notification\MagnetDuplicateDeletedAdminNotification;
use App\Domain\Magnet\Notification\MagnetNotFoundAndDeletedAdminNotification;
use App\Domain\Rto\Rto;
use App\Jobs\AbstractJob;

#[WithoutFailedJobLog]
class FetchTorrentMetaJob extends AbstractJob
{
    public $tries = 1;

    public array $rtoIds;

    public function __construct(int ...$rtoIds)
    {
        $this->rtoIds = $rtoIds;
    }

    public function handle(Rto $rto)
    {
        $magnets = Magnet::query()
            ->whereIn('rto_id', $this->rtoIds)
            ->get();

        foreach ($rto->topicDataByIds($this->rtoIds)->topics as $id => $response) {
            /** @var \App\Domain\Magnet\Models\Magnet $magnet */
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

                $magnet->notify(new MagnetNotFoundAndDeletedAdminNotification($magnet));

                continue;
            }

            // Раздача закрыта как повтор
            if ($response->status->isDuplicate()) {
                $magnet->status = MagnetStatus::Deleted;
                $magnet->save();

                event(new \App\Events\Stats\TorrentDuplicateDeleted);

                $magnet->notify(new MagnetDuplicateDeletedAdminNotification($magnet));

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
