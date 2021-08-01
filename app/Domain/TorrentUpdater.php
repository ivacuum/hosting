<?php namespace App\Domain;

use App\Services\Rto;
use App\Torrent;

class TorrentUpdater
{
    private Rto $rto;

    public function __construct(Rto $rto)
    {
        $this->rto = $rto;
    }

    public function update(Torrent $torrent)
    {
        $data = $this->rto->topicDataById($torrent->rto_id);

        if ($torrent->isNotPublished()) {
            $torrent->status = TorrentStatus::PUBLISHED;
        }

        if ($torrent->info_hash !== $data->infoHash) {
            $response = $this->rto->parseTopicBody($torrent->rto_id);

            $torrent->html = $response->body;
            $torrent->announcer = $response->announcer;
        }

        if ($data->registeredAt->gt($torrent->registered_at)) {
            $torrent->registered_at = now();
        }

        $torrent->size = $data->size;
        $torrent->title = $data->title;
        $torrent->info_hash = $data->infoHash;
        $torrent->save();
    }
}
