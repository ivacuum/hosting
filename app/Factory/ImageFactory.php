<?php

namespace App\Factory;

use App\Image;
use App\User;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;

class ImageFactory
{
    private int|null $userId = null;
    private CarbonInterface|null $updatedAt = null;

    private UserFactory|null $userFactory = null;

    public function create()
    {
        $model = $this->make();
        $model->user_id ??= ($this->userFactory ?? UserFactory::new())->create()->id;
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Image;
        $model->slug = \Str::random(10) . fake()->randomElement(['.jpg', '.png']);
        $model->date = CarbonImmutable::instance(fake()->dateTimeBetween('-4 years'))->format('ymd');
        $model->size = fake()->numberBetween(1000, 1_000_000);
        $model->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $model->user_id = $this->userId;
        $model->updated_at = $this->updatedAt;

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function obsolete()
    {
        return $this->withUpdatedAt(now()->subMonths(7));
    }

    public function withUpdatedAt(CarbonInterface $updatedAt)
    {
        return clone ($this, ['updatedAt' => $updatedAt]);
    }

    public function withUser(int|User|UserFactory|null $user = null)
    {
        $factory = clone $this;

        if ($user instanceof User) {
            $factory->userId = $user->id;
        } elseif (is_int($user)) {
            $factory->userId = $user;
        } else {
            $factory->userFactory = $user ?? UserFactory::new();
        }

        return $factory;
    }
}
