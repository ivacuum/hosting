<?php namespace App\Action;

use App\Domain\MagnetStatus;
use App\Magnet;
use App\Services\Rto;

class UpdateMagnetAction
{
    public function __construct(private Rto $rto)
    {
    }

    public function execute(Magnet $magnet, int $topicId)
    {
        $data = $this->rto->topicDataById($topicId);

        if ($magnet->status !== MagnetStatus::Published) {
            $magnet->status = MagnetStatus::Published;
        }

        if ($magnet->info_hash !== $data->infoHash) {
            $response = $this->rto->parseTopicBody($topicId);

            $magnet->html = $response->body;
            $magnet->announcer = $response->announcer;
        }

        if ($data->registeredAt->gt($magnet->registered_at)) {
            $magnet->registered_at = now();
        }

        $magnet->size = $data->size;
        $magnet->title = $data->title;
        $magnet->rto_id = $data->id;
        $magnet->info_hash = $data->infoHash;
        $magnet->save();
    }
}
