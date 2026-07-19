<?php

namespace App\Factory;

use App\Image;
use App\User;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;

class ImageFactory
{
    private CarbonInterface|null $updatedAt = null;

    private int|User|UserFactory|null $user = null;

    public function create(): Image
    {
        $image = $this->make();
        $image->user_id ??= ($this->user instanceof UserFactory ? $this->user : UserFactory::new())->create()->id;
        $image->save();

        return $image;
    }

    public function make(): Image
    {
        $image = new Image;
        $image->slug = \Str::random(10) . fake()->randomElement(['.jpg', '.png']);
        $image->date = CarbonImmutable::instance(fake()->dateTimeBetween('-4 years'))->format('ymd');
        $image->size = fake()->numberBetween(1000, 1_000_000);
        $image->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $image->user_id = match (true) {
            $this->user instanceof User => $this->user->id,
            is_int($this->user) => $this->user,
            default => null,
        };
        $image->updated_at = $this->updatedAt;

        return $image;
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function obsolete(): self
    {
        return $this->withUpdatedAt(now()->subMonths(7));
    }

    #[\NoDiscard]
    public function withUpdatedAt(CarbonInterface $updatedAt): self
    {
        return clone ($this, ['updatedAt' => $updatedAt]);
    }

    #[\NoDiscard]
    public function withUser(int|User|UserFactory|null $user = null): self
    {
        return clone ($this, ['user' => $user ?? UserFactory::new()]);
    }
}
