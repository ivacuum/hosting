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
    private string|null $lat = null;
    private string|null $lon = null;
    private string|null $slug = null;
    private PhotoStatus $status = PhotoStatus::Published;

    private Tag|TagFactory|null $tag = null;
    private int|Trip|TripFactory|null $trip = null;
    private int|User|UserFactory|null $user = 1;

    public function create(): Photo
    {
        $photo = $this->make();
        $photo->user_id ??= ($this->user instanceof UserFactory ? $this->user : UserFactory::new())->create()->id;

        if ($this->trip instanceof TripFactory) {
            $trip = $this->trip->withUser($photo->user_id)->create();

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
        $photo->rel_id = match (true) {
            $this->trip instanceof Trip => $this->trip->id,
            is_int($this->trip) => $this->trip,
            default => null,
        };
        $photo->status = $this->status;
        $photo->user_id = match (true) {
            $this->user instanceof User => $this->user->id,
            is_int($this->user) => $this->user,
            default => null,
        };
        $photo->rel_type = match (true) {
            $this->trip instanceof Trip => $this->trip->getMorphClass(),
            is_int($this->trip) => new Trip()->getMorphClass(),
            default => null,
        };

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
        return clone ($this, ['trip' => $trip ?? TripFactory::new()->metaImage()]);
    }

    #[\NoDiscard]
    public function withUser(int|User|UserFactory|null $user = null): self
    {
        return clone ($this, ['user' => $user ?? UserFactory::new()]);
    }
}
