<?php

namespace App\Services\Vk;

use Illuminate\Support\Carbon;

class Post
{
    private $id;
    private $date;
    private $isAd;
    private $likes;
    private $canLike;
    private $ownerId;
    private $isPinned;
    private $isUserLiked;

    public function __construct(
        int $id,
        int $ownerId,
        int $timestamp,
        int $likes,
        bool $canLike,
        bool $isUserLiked,
        bool $isPinned = false,
        bool $isAd = false
    ) {
        $this->id = $id;
        $this->date = Carbon::createFromTimestamp($timestamp);
        $this->isAd = $isAd;
        $this->likes = $likes;
        $this->canLike = $canLike;
        $this->ownerId = $ownerId;
        $this->isPinned = $isPinned;
        $this->isUserLiked = $isUserLiked;
    }

    public function canLike(): bool
    {
        return $this->canLike;
    }

    public static function fromJson($json): self
    {
        return new self(
            $json->id,
            $json->owner_id,
            $json->date,
            $json->likes->count,
            $json->likes->can_like,
            $json->likes->user_likes,
            $json->is_pinned ?? false,
            $json->marked_as_ads ?? false
        );
    }

    public function id(): int
    {
        return $this->id;
    }

    public function isAd(): bool
    {
        return $this->isAd;
    }

    public function isPinned(): bool
    {
        return $this->isPinned;
    }

    public function isUserLiked(): bool
    {
        return $this->isUserLiked;
    }

    public function ownerId(): int
    {
        return $this->ownerId;
    }
}
