<?php

namespace App\Domain\SocialMedia\Factory;

use App\Domain\Life\Factory\PhotoFactory;
use App\Domain\Life\Models\Photo;
use App\Domain\SocialMedia\Models\SocialMediaPost;
use App\Domain\SocialMedia\SocialMediaPostStatus;
use App\Factory\UserFactory;
use Carbon\CarbonInterface;

class SocialMediaPostFactory
{
    private int $userId = 1;
    private int|null $photoId = null;
    private string|null $caption = null;
    private SocialMediaPostStatus $status = SocialMediaPostStatus::Queued;
    private CarbonInterface|null $publishedAt = null;

    private PhotoFactory|null $photoFactory = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function excluded()
    {
        return $this->withStatus(SocialMediaPostStatus::Excluded);
    }

    public function make()
    {
        $post = new SocialMediaPost;
        $post->status = $this->status;
        $post->caption = $this->caption ?? fake()->text();
        $post->user_id = $this->userId ?? UserFactory::new()->create()->id;
        $post->photo_id = $this->photoId ?? ($this->photoFactory ?? PhotoFactory::new())->withTrip()->create()->id;
        $post->published_at = $this->publishedAt;

        $post->published_at ??= match ($post->status) {
            SocialMediaPostStatus::Queued => now(),
            default => null,
        };

        return $post;
    }

    public static function new(): self
    {
        return new self;
    }

    public function published()
    {
        return $this->withStatus(SocialMediaPostStatus::Published);
    }

    public function withCaption(string $caption)
    {
        $factory = clone $this;
        $factory->caption = $caption;

        return $factory;
    }

    public function withPhoto(int|Photo|PhotoFactory|null $photo = null)
    {
        $factory = clone $this;

        if ($photo instanceof Photo) {
            $factory->photoId = $photo->id;
        } elseif (is_int($photo)) {
            $factory->photoId = $photo;
        } else {
            $factory->photoFactory = $photo ?? PhotoFactory::new();
        }

        return $factory;
    }

    public function withPublishedAt(CarbonInterface $publishedAt)
    {
        $factory = clone $this;
        $factory->publishedAt = $publishedAt;

        return $factory;
    }

    public function withStatus(SocialMediaPostStatus $status)
    {
        $factory = clone $this;
        $factory->status = $status;

        return $factory;
    }
}
