<?php namespace App\Domain;

use App\Magnet;
use App\Services\Rto;

class TorrentUpdater
{
    public function __construct(private Rto $rto)
    {
    }

    public function update(Magnet $magnet)
    {
        $data = $this->rto->topicDataById($magnet->rto_id);

        if ($magnet->status !== MagnetStatus::Published) {
            $magnet->status = MagnetStatus::Published;
        }

        if ($magnet->info_hash !== $data->infoHash) {
            $response = $this->rto->parseTopicBody($magnet->rto_id);

            $magnet->html = $response->body;
            $magnet->announcer = $response->announcer;
        }

        if ($data->registeredAt->gt($magnet->registered_at)) {
            $magnet->registered_at = now();
        }

        $magnet->size = $data->size;
        $magnet->title = $data->title;
        $magnet->info_hash = $data->infoHash;
        $magnet->save();
    }
}
