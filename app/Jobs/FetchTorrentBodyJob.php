<?php namespace App\Jobs;

use App\Notifications\TorrentUpdatedNotification;
use App\Services\Rto;
use App\Torrent;

class FetchTorrentBodyJob extends AbstractJob
{
    public $delay = 5;

    public function __construct(private int $rtoId)
    {
    }

    public function handle(Rto $rto)
    {
        $torrent = Torrent::firstWhere('rto_id', $this->rtoId);

        $topicData = $rto->parseTopicBody($torrent->rto_id);

        $torrent->html = $topicData->body;
        $torrent->announcer = $topicData->announcer;
        $torrent->registered_at = now();
        $torrent->save();

        event(new \App\Events\Stats\TorrentUpdated);

        $torrent->user->notify(new TorrentUpdatedNotification($torrent));
    }
}
