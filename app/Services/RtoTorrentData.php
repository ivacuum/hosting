<?php namespace App\Services;

class RtoTorrentData
{
    public int $id;
    public int $size;
    public string $body;
    public string $title;
    public string $infoHash;
    public string $announcer;

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
