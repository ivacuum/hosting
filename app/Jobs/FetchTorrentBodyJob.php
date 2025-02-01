<?php

namespace App\Jobs;

use App\Magnet;
use App\Notifications\MagnetUpdatedNotification;
use App\Services\Rto;
use Carbon\CarbonInterval;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class FetchTorrentBodyJob extends AbstractJob implements ShouldBeUnique
{
    public $delay = 5;

    public function __construct(public int $rtoId) {}

    public function handle(Rto $rto)
    {
        $magnet = Magnet::query()->firstWhere('rto_id', $this->rtoId);

        $topicData = $rto->parseTopicBody($magnet->rto_id);

        $magnet->html = $topicData->body;
        $magnet->announcer = $topicData->announcer;
        $magnet->registered_at = now();
        $magnet->save();

        event(new \App\Events\Stats\TorrentUpdated);

        $magnet->user->notify(new MagnetUpdatedNotification($magnet));
    }

    public function uniqueFor(): int
    {
        return CarbonInterval::day()->totalSeconds;
    }

    public function uniqueId()
    {
        return $this->rtoId;
    }
}
