<?php namespace App\Services;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;

class RtoTopicData
{
    const STATUS_APPROVED = 2;
    const STATUS_DUPLICATE = 5;
    const STATUS_PREMODERATION = 11;

    const TITLE_REPLACE_FROM = [' )', ' ,', 'HD (1080p)'];
    const TITLE_REPLACE_TO = [')', ',', 'HD 1080p'];

    public function __construct(
        public int $id,
        public string $title,
        public string $infoHash,
        public CarbonInterface $registeredAt,
        public int $status,
        public int $size,
        public int $forumId,
        public int $posterId,
        public int $seeders,
        public CarbonInterface $seederLastSeenAt
    ) {
    }

    public static function fromJson(int $id, $json): self
    {
        return new self(
            $id,
            str_replace(self::TITLE_REPLACE_FROM, self::TITLE_REPLACE_TO, $json->topic_title),
            $json->info_hash,
            CarbonImmutable::parse($json->reg_time, 'Europe/Moscow'),
            $json->tor_status,
            $json->size,
            $json->forum_id,
            $json->poster_id,
            $json->seeders,
            CarbonImmutable::parse($json->seeder_last_seen, 'Europe/Moscow')
        );
    }

    public function isDuplicate(): bool
    {
        return $this->status === self::STATUS_DUPLICATE;
    }

    public function isPremoderation(): bool
    {
        return $this->status === self::STATUS_PREMODERATION;
    }

    public function toJson()
    {
        return [
            'size' => $this->size,
            'seeders' => $this->seeders,
            'forum_id' => $this->forumId,
            'reg_time' => $this->registeredAt->getTimestamp(),
            'info_hash' => $this->infoHash,
            'poster_id' => $this->posterId,
            'tor_status' => $this->status,
            'topic_title' => $this->title,
            'seeder_last_seen' => $this->seederLastSeenAt->getTimestamp(),
        ];
    }
}
