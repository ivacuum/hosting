<?php namespace App\Console\Commands;

use App\Notifications\TorrentNotFoundDeleted;
use App\Notifications\TorrentUpdated;
use App\Services\Rto;
use App\Torrent;
use App\User;
use Illuminate\Support\Collection;
use Ivacuum\Generic\Commands\Command;

class RtoUpdate extends Command
{
    protected $signature = 'app:rto-update';
    protected $description = 'Update torrent releases info from rto';

    public function handle(Rto $rto)
    {
        Torrent::published()->orderBy('id', 'desc')->chunk(100, function (Collection $torrents) use ($rto) {
            $ids = implode(',', $torrents->pluck('rto_id')->toArray());

            foreach ($rto->topicDataByIds($ids) as $id => $json) {
                /* @var Torrent $torrent */
                $torrent = $torrents->where('rto_id', $id)->first();

                // Раздача не найдена
                if (null === $json) {
                    $torrent->softDelete();

                    $this->info("Раздача {$id} не найдена и удалена: {$torrent->title}");

                    event(new \App\Events\Stats\TorrentNotFoundDeleted);

                    $user = $torrent->user_id !== 1 ? User::find(1) : $torrent->user;
                    $user->notify(new TorrentNotFoundDeleted($torrent));

                    continue;
                }

                // Раздача закрыта как повтор
                if ($json->tor_status == Torrent::RTO_STATUS_DUPLICATE) {
                    $torrent->softDelete();

                    $this->info("Раздача {$id} закрыта как повторная и удалена");

                    event(new \App\Events\Stats\TorrentDuplicateDeleted);

                    $user = $torrent->user_id !== 1 ? User::find(1) : $torrent->user;
                    $user->notify(new TorrentNotFoundDeleted($torrent));

                    continue;
                }

                // Ждем завершения модерации
                if ($json->tor_status == Torrent::RTO_STATUS_PREMODERATION) {
                    continue;
                }

                $torrent->title = $json->topic_title;

                if ($json->info_hash !== $torrent->info_hash) {
                    $torrent->size = $json->size;
                    $torrent->info_hash = $json->info_hash;
                    $torrent->registered_at = now();

                    if (!is_array($topic_data = $rto->parseTopicBody($id))) {
                        throw new \Exception("Проблема обновления раздачи {$id} [parseTopicBody]");
                    }

                    $torrent->html = $topic_data['body'];
                    $torrent->announcer = $topic_data['announcer'];

                    // Раздача обновлена
                    $this->info("Раздача {$id} обновлена");

                    event(new \App\Events\Stats\TorrentUpdated);
                    $torrent->user->notify(new TorrentUpdated($torrent));

                    // Ограничение количества запросов в секунду
                    sleep(1);
                }

                $torrent->save();
            }
        });
    }
}
