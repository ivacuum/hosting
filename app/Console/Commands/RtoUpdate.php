<?php namespace App\Console\Commands;

use App\Notifications\TorrentUpdatedNotification;
use App\Services\Rto;
use App\Torrent;
use Illuminate\Support\Collection;
use Ivacuum\Generic\Commands\Command;
use Ivacuum\Generic\Services\Telegram;

class RtoUpdate extends Command
{
    protected $signature = 'app:rto-update';
    protected $description = 'Update torrent releases info from rto';

    public function handle(Rto $rto, Telegram $telegram)
    {
        Torrent::published()->orderByDesc('id')->chunk(100, function (Collection $torrents) use ($rto, $telegram) {
            $ids = $torrents->pluck('rto_id')->all();

            foreach ($rto->topicDataByIds($ids)->getTopics() as $id => $response) {
                /** @var Torrent $torrent */
                $torrent = $torrents->where('rto_id', $id)->first();

                // Раздача не найдена
                if (null === $response) {
                    $torrent->softDelete();

                    $this->info("Раздача {$id} не найдена и удалена: {$torrent->title}");

                    event(new \App\Events\Stats\TorrentNotFoundDeleted);

                    $telegram->notifyAdmin("🧲️ Раздача не найдена и удалена\n\n{$torrent->title}\n{$torrent->externalLink()}\n\n{$torrent->novaLink()}");

                    continue;
                }

                // Раздача закрыта как повтор
                if ($response->isDuplicate()) {
                    $torrent->softDelete();

                    $this->info("Раздача {$id} закрыта как повторная и удалена");

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
                    $topicData = $rto->parseTopicBody($id);

                    $torrent->html = $topicData->body;
                    $torrent->announcer = $topicData->announcer;
                    $torrent->registered_at = now();

                    // Раздача обновлена
                    $this->info("Раздача {$id} обновлена");

                    event(new \App\Events\Stats\TorrentUpdated);
                    $torrent->user->notify(new TorrentUpdatedNotification($torrent));

                    // Ограничение количества запросов в секунду
                    sleep(1);
                }

                $torrent->info_hash = $response->infoHash;
                $torrent->save();
            }
        });
    }
}
