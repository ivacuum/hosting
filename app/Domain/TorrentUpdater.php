<?php namespace App\Domain;

use App\Services\Rto;
use App\Torrent;

class TorrentUpdater
{
    private $rto;

    public function __construct(Rto $rto)
    {
        $this->rto = $rto;
    }

    public function update(Torrent $torrent)
    {
        $data = $this->rto->topicDataById($torrent->rto_id);

        if ($torrent->isNotPublished()) {
            $torrent->status = $torrent::STATUS_PUBLISHED;
        }

        if ($torrent->info_hash !== $data->getInfoHash()) {
            $response = $this->rto->parseTopicBody($torrent->rto_id);

            $torrent->html = $response->getBody();
            $torrent->announcer = $response->getAnnouncer();
        }

        if ($data->getRegisteredAt()->gt($torrent->registered_at)) {
            $torrent->registered_at = now();
        }

        $torrent->size = $data->getSize();
        $torrent->title = $data->getTitle();
        $torrent->info_hash = $data->getInfoHash();
        $torrent->save();

    }
}
