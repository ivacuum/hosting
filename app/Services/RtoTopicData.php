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

    public static function fromArray(int $id, array $payload): self
    {
        return new self(
            $id,
            str_replace(self::TITLE_REPLACE_FROM, self::TITLE_REPLACE_TO, $payload['topic_title']),
            $payload['info_hash'],
            CarbonImmutable::parse($payload['reg_time'], 'Europe/Moscow'),
            $payload['tor_status'],
            $payload['size'],
            $payload['forum_id'],
            $payload['poster_id'],
            $payload['seeders'],
            CarbonImmutable::parse($payload['seeder_last_seen'], 'Europe/Moscow')
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
