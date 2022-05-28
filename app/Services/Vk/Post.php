<?php namespace App\Services\Vk;

class Post
{
    public function __construct(
        private int $id,
        private int $ownerId,
        int $timestamp,
        private bool $canLike,
        private bool $isUserLiked,
        private bool $isPinned = false,
        private bool $isAd = false
    ) {
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
