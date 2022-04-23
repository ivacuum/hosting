<?php namespace App\Services;

class RtoTorrentData
{
    public readonly int $id;
    public readonly int $size;
    public readonly string $body;
    public readonly string $title;
    public readonly string $infoHash;
    public readonly string $announcer;

    public function __construct(RtoTopicData $meta, RtoTopicHtmlResponse $body)
    {
        $this->id = $meta->id;
        $this->body = $body->body;
        $this->size = $meta->size;
        $this->title = $meta->title;
        $this->infoHash = $meta->infoHash;
        $this->announcer = $body->announcer;
    }
}
