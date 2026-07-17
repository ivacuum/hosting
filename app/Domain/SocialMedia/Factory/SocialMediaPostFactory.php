<?php

namespace App\Domain\SocialMedia\Factory;

use App\Domain\Life\Factory\PhotoFactory;
use App\Domain\Life\Models\Photo;
use App\Domain\SocialMedia\Models\SocialMediaPost;
use App\Domain\SocialMedia\SocialMediaPostStatus;
use Carbon\CarbonInterface;

class SocialMediaPostFactory
{
    private string|null $caption = null;
    private SocialMediaPostStatus $status = SocialMediaPostStatus::Queued;
    private CarbonInterface|null $publishedAt = null;

    private int|Photo|PhotoFactory|null $photo = null;
    private SocialMediaTokenFactory|null $socialMediaTokenFactory = null;

    public function create()
    {
        $model = $this->make();

        if ($this->photo instanceof Photo) {
            $photo = $this->photo;
        } elseif (is_int($this->photo)) {
            $photo = Photo::query()->findOrFail($this->photo);
        } else {
            $photoFactory = $this->photo instanceof PhotoFactory
                ? $this->photo
                : PhotoFactory::new();

            $photo = $photoFactory
                ->withTrip()
                ->create();
        }

        $model->user_id = $photo->user_id;
        $model->photo_id = $photo->id;
        $model->save();

        $this->socialMediaTokenFactory
            ?->withUser($model->user_id)
            ->create();

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
        return clone ($this, ['caption' => $caption]);
    }

    public function withPhoto(int|Photo|PhotoFactory|null $photo = null)
    {
        return clone ($this, ['photo' => $photo ?? PhotoFactory::new()]);
    }

    public function withPublishedAt(CarbonInterface $publishedAt)
    {
        return clone ($this, ['publishedAt' => $publishedAt]);
    }

    public function withSocialMediaToken(string|SocialMediaTokenFactory|null $token = null)
    {
        $factory = clone $this;

        if (is_string($token)) {
            $factory->socialMediaTokenFactory = SocialMediaTokenFactory::new()
                ->withToken($token);
        } else {
            $factory->socialMediaTokenFactory = $token ?? SocialMediaTokenFactory::new();
        }

        return $factory;
    }

    public function withStatus(SocialMediaPostStatus $status)
    {
        return clone ($this, ['status' => $status]);
    }
}
