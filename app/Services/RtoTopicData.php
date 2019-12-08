<?php namespace App\Services;

use Illuminate\Support\Carbon;

class RtoTopicData
{
    const STATUS_APPROVED = 2;
    const STATUS_DUPLICATE = 5;
    const STATUS_PREMODERATION = 11;

    const TITLE_REPLACE_FROM = [' )', ' ,', 'HD (1080p)'];
    const TITLE_REPLACE_TO = [')', ',', 'HD 1080p'];

    private $id;
    private $size;
    private $title;
    private $status;
    private $forumId;
    private $seeders;
    private $infoHash;
    private $posterId;
    private $registeredAt;
    private $seederLastSeenAt;

    public function __construct(
        int $id,
        string $title,
        string $infoHash,
        Carbon $registeredAt,
        int $status,
        int $size,
        int $forumId,
        int $posterId,
        int $seeders,
        Carbon $seederLastSeenAt
    ) {
        $this->id = $id;
        $this->size = $size;
        $this->title = $title;
        $this->status = $status;
        $this->forumId = $forumId;
        $this->seeders = $seeders;
        $this->infoHash = $infoHash;
        $this->posterId = $posterId;
        $this->registeredAt = $registeredAt;
        $this->seederLastSeenAt = $seederLastSeenAt;
    }

    public static function fromJson(int $id, $json): self
    {
        return new self(
            $id,
            $json->topic_title,
            $json->info_hash,
            Carbon::parse($json->reg_time, 'Europe/Moscow'),
            $json->tor_status,
            $json->size,
            $json->forum_id,
            $json->poster_id,
            $json->seeders,
            Carbon::parse($json->seeder_last_seen, 'Europe/Moscow')
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getInfoHash(): string
    {
        return $this->infoHash;
    }

    public function getRegisteredAt(): Carbon
    {
        return $this->registeredAt;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getTitle(): string
    {
        return str_replace(self::TITLE_REPLACE_FROM, self::TITLE_REPLACE_TO, $this->title);
    }

    public function isDuplicate(): bool
    {
        return $this->getStatus() === self::STATUS_DUPLICATE;
    }

    public function isPremoderation(): bool
    {
        return $this->getStatus() === self::STATUS_PREMODERATION;
    }
}
