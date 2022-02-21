<?php namespace App\Jobs;

use App\Magnet;
use App\Notifications\TorrentUpdatedNotification;
use App\Services\Rto;

class FetchTorrentBodyJob extends AbstractJob
{
    public $delay = 5;

    public function __construct(private int $rtoId)
    {
    }

    public function handle(Rto $rto)
    {
        $magnet = Magnet::firstWhere('rto_id', $this->rtoId);

        $topicData = $rto->parseTopicBody($magnet->rto_id);

        $magnet->html = $topicData->body;
        $magnet->announcer = $topicData->announcer;
        $magnet->registered_at = now();
        $magnet->save();

        event(new \App\Events\Stats\TorrentUpdated);

        $magnet->user->notify(new TorrentUpdatedNotification($magnet));
    }
}
