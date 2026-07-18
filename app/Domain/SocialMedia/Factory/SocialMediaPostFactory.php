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

    public function create(): SocialMediaPost
    {
        $post = $this->make();

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

        $post->user_id = $photo->user_id;
        $post->photo_id = $photo->id;
        $post->save();

        $this->socialMediaTokenFactory
            ?->withUser($post->user_id)
            ->create();

        return $post;
    }

    #[\NoDiscard]
    public function excluded(): self
    {
        return $this->withStatus(SocialMediaPostStatus::Excluded);
    }

    public function make(): SocialMediaPost
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

    #[\NoDiscard]
    public function published(): self
    {
        return $this->withStatus(SocialMediaPostStatus::Published);
    }

    #[\NoDiscard]
    public function withCaption(string $caption): self
    {
        return clone ($this, ['caption' => $caption]);
    }

    #[\NoDiscard]
    public function withPhoto(int|Photo|PhotoFactory|null $photo = null): self
    {
        return clone ($this, ['photo' => $photo ?? PhotoFactory::new()]);
    }

    #[\NoDiscard]
    public function withPublishedAt(CarbonInterface $publishedAt): self
    {
        return clone ($this, ['publishedAt' => $publishedAt]);
    }

    #[\NoDiscard]
    public function withSocialMediaToken(string|SocialMediaTokenFactory|null $token = null): self
    {
        return clone ($this, [
            'socialMediaTokenFactory' => is_string($token)
                ? SocialMediaTokenFactory::new()->withToken($token)
                : $token ?? SocialMediaTokenFactory::new(),
        ]);
    }

    #[\NoDiscard]
    public function withStatus(SocialMediaPostStatus $status): self
    {
        return clone ($this, ['status' => $status]);
    }
}
