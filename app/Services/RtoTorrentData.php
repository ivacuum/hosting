<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class RtoTorrentData
{
    private $body;
    private $meta;

    public function __construct(RtoTopicData $meta, RtoTopicHtmlResponse $body)
    {
        $this->meta = $meta;
        $this->body = $body;
    }

    public function getAnnouncer(): string
    {
        return $this->body->getAnnouncer();
    }

    public function getId(): int
    {
        return $this->meta->getId();
    }

    public function getBody(): string
    {
        return $this->body->getBody();
    }

    public function getInfoHash(): string
    {
        return $this->meta->getInfoHash();
    }

    public function getRegisteredAt(): Carbon
    {
        return $this->meta->getRegisteredAt();
    }

    public function getSize(): int
    {
        return $this->meta->getSize();
    }

    public function getTitle(): string
    {
        return $this->meta->getTitle();
    }
}
