<?php namespace App\Services;

use App\Domain\RtoTopicStatus;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;

class RtoTopicData
{
    const TITLE_REPLACE_FROM = [' )', ' ,', 'HD (1080p)'];
    const TITLE_REPLACE_TO = [')', ',', 'HD 1080p'];

    public function __construct(
        public int $id,
        public string $title,
        public string $infoHash,
        public CarbonInterface $registeredAt,
        public RtoTopicStatus $status,
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
            RtoTopicStatus::from($payload['tor_status']),
            $payload['size'],
            $payload['forum_id'],
            $payload['poster_id'],
            $payload['seeders'],
            CarbonImmutable::parse($payload['seeder_last_seen'], 'Europe/Moscow')
        );
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
            'tor_status' => $this->status->value,
            'topic_title' => $this->title,
            'seeder_last_seen' => $this->seederLastSeenAt->getTimestamp(),
        ];
    }
}
