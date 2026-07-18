<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\Models\Photo;
use App\Domain\Life\Models\Tag;
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

    private Tag|TagFactory|null $tag = null;
    private TripFactory|null $tripFactory = null;
    private UserFactory|null $userFactory = null;

    public function create(): Photo
    {
        $photo = $this->make();
        $photo->user_id ??= ($this->userFactory ?? UserFactory::new())->create()->id;

        if ($this->tripFactory) {
            $trip = $this->tripFactory->withUser($photo->user_id)->create();

            $photo->rel_id = $trip->id;
            $photo->rel_type = $trip->getMorphClass();
        }

        $photo->save();

        if ($this->tag) {
            $tag = $this->tag instanceof Tag
                ? $this->tag
                : $this->tag->create();

            $photo->tags()->attach($tag->getKey());
        }

        return $photo;
    }

    #[\NoDiscard]
    public function hidden(): self
    {
        return $this->withStatus(PhotoStatus::Hidden);
    }

    public function make(): Photo
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

    #[\NoDiscard]
    public function withPoint(string|int $lat, string|int $lon): self
    {
        return clone ($this, [
            'lat' => $lat,
            'lon' => $lon,
        ]);
    }

    #[\NoDiscard]
    public function withSlug(string $slug): self
    {
        return clone ($this, ['slug' => $slug]);
    }

    #[\NoDiscard]
    public function withStatus(PhotoStatus $status): self
    {
        return clone ($this, ['status' => $status]);
    }

    #[\NoDiscard]
    public function withTag(Tag|TagFactory|null $tag = null): self
    {
        return clone ($this, ['tag' => $tag ?? TagFactory::new()]);
    }

    #[\NoDiscard]
    public function withTrip(int|Trip|TripFactory|null $trip = null): self
    {
        return match (true) {
            $trip instanceof Trip => clone ($this, [
                'relId' => $trip->id,
                'relType' => $trip->getMorphClass(),
                'tripFactory' => null,
            ]),
            is_int($trip) => clone ($this, [
                'relId' => $trip,
                'relType' => new Trip()->getMorphClass(),
                'tripFactory' => null,
            ]),
            default => clone ($this, [
                'relId' => null,
                'relType' => null,
                'tripFactory' => $trip ?? TripFactory::new()->metaImage(),
            ]),
        };
    }

    #[\NoDiscard]
    public function withUser(int|User|UserFactory|null $user = null): self
    {
        return match (true) {
            $user instanceof User => clone ($this, [
                'userId' => $user->id,
                'userFactory' => null,
            ]),
            is_int($user) => clone ($this, [
                'userId' => $user,
                'userFactory' => null,
            ]),
            default => clone ($this, [
                'userId' => null,
                'userFactory' => $user ?? UserFactory::new(),
            ]),
        };
    }
}
