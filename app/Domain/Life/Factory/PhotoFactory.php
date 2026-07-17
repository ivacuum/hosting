<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\Models\Photo;
use App\Domain\Life\Models\Trip;
use App\Domain\Life\PhotoStatus;
use App\Domain\Spatial\Point;
use App\Factory\UserFactory;
use App\User;

class PhotoFactory
{
    private int|null $relId = null;
    private int|null $userId = 1;
    private string|null $lat = null;
    private string|null $lon = null;
    private string|null $slug = null;
    private string|null $relType = null;
    private PhotoStatus $status = PhotoStatus::Published;

    private TagFactory|null $tagFactory = null;
    private TripFactory|null $tripFactory = null;
    private UserFactory|null $userFactory = null;

    public function create()
    {
        $model = $this->make();
        $model->user_id ??= ($this->userFactory ?? UserFactory::new())->create()->id;

        if ($this->tripFactory) {
            $trip = $this->tripFactory->withUser($model->user_id)->create();

            $model->rel_id = $trip->id;
            $model->rel_type = $trip->getMorphClass();
        }

        $model->save();

        if ($this->tagFactory) {
            $model->tags()->attach($this->tagFactory->create()->getKey());
        }

        return $model;
    }

    public function hidden()
    {
        return $this->withStatus(PhotoStatus::Hidden);
    }

    public function make()
    {
        $lat = $this->lat ?? (string) fake()->optional(0.9, '')->latitude();
        $lon = $this->lon ?? ($lat !== '' ? (string) fake()->longitude() : '');

        $photo = new Photo;
        $photo->slug = $this->slug ?? 'test/' . fake()->uuid() . '.jpg';
        $photo->point = $lat !== ''
            ? new Point($lat, $lon)
            : null;
        $photo->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $photo->rel_id = $this->relId;
        $photo->status = $this->status;
        $photo->user_id = $this->userId;
        $photo->rel_type = $this->relType;

        return $photo;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withPoint(string|int $lat, string|int $lon)
    {
        $factory = clone $this;
        $factory->lat = $lat;
        $factory->lon = $lon;

        return $factory;
    }

    public function withSlug(string $slug)
    {
        $factory = clone $this;
        $factory->slug = $slug;

        return $factory;
    }

    public function withStatus(PhotoStatus $status)
    {
        $factory = clone $this;
        $factory->status = $status;

        return $factory;
    }

    public function withTag(TagFactory|null $tagFactory = null)
    {
        $factory = clone $this;
        $factory->tagFactory = $tagFactory ?? TagFactory::new();

        return $factory;
    }

    public function withTrip(int|Trip|TripFactory|null $trip = null)
    {
        $factory = clone $this;

        if ($trip instanceof Trip) {
            $factory->relId = $trip->id;
            $factory->relType = $trip->getMorphClass();
        } elseif (is_int($trip)) {
            $factory->relId = $trip;
            $factory->relType = new Trip()->getMorphClass();
        } else {
            $factory->tripFactory = $trip ?? TripFactory::new()->metaImage();
        }

        return $factory;
    }

    public function withUser(int|User|UserFactory|null $user = null)
    {
        $factory = clone $this;

        if ($user instanceof User) {
            $factory->userId = $user->id;
        } elseif (is_int($user)) {
            $factory->userId = $user;
        } else {
            $factory->userId = null;
            $factory->userFactory = $user ?? UserFactory::new();
        }

        return $factory;
    }
}
