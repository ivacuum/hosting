<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\Models\City;
use App\Domain\Life\Models\Trip;
use App\Domain\Life\TripStatus;
use App\Factory\CommentFactory;
use App\Factory\UserFactory;
use App\User;
use Carbon\CarbonImmutable;

class TripFactory
{
    private int|null $cityId = null;
    private int|null $userId = null;
    private string|null $slug = null;
    private string|null $metaImage = null;
    private string|null $englishTitle = null;
    private string|null $russianTitle = null;
    private TripStatus $status = TripStatus::Published;

    private CityFactory|null $cityFactory = null;
    private UserFactory|null $userFactory = null;
    private CommentFactory|null $commentFactory = null;

    public function create(): Trip
    {
        $trip = $this->make();
        $trip->city_id ??= ($this->cityFactory ?? CityFactory::new())->create()->id;
        $trip->user_id ??= $this->userFactory?->create()->id ?? 1;
        $trip->save();

        $this->commentFactory
            ?->withTrip($trip)
            ->create();

        return $trip;
    }

    public function make(): Trip
    {
        $trip = new Trip;

        $title = fake()->city() . ' ' . fake()->numberBetween(2000, 3000);
        $dateStart = CarbonImmutable::instance(fake()->dateTimeBetween('2015-01-01'))->startOfHour();
        $dateEnd = CarbonImmutable::instance($dateStart)->addDays(random_int(0, 3));

        $trip->html = '';
        $trip->slug = $this->slug ?? \Str::slug($this->englishTitle ?? $title);
        $trip->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $trip->status = $this->status;
        $trip->city_id = $this->cityId;
        $trip->user_id = $this->userId;
        $trip->date_end = $dateEnd;
        $trip->markdown = '';
        $trip->title_en = $this->englishTitle ?? $title;
        $trip->title_ru = $this->russianTitle ?? $title;
        $trip->date_start = $dateStart;
        $trip->meta_image = $this->metaImage ?? '';

        return $trip;
    }

    #[\NoDiscard]
    public function metaImage(): self
    {
        return $this->withMetaImage(fake()->numerify('test/IMG_####.jpg'));
    }

    public static function new(): self
    {
        return new self;
    }

    #[\NoDiscard]
    public function withCity(int|City|CityFactory $city): self
    {
        return match (true) {
            $city instanceof City => clone ($this, [
                'cityId' => $city->id,
                'cityFactory' => null,
                'englishTitle' => $city->title_en,
                'russianTitle' => $city->title_ru,
            ]),
            $city instanceof CityFactory => clone ($this, [
                'cityId' => null,
                'cityFactory' => $city,
                'englishTitle' => null,
                'russianTitle' => null,
            ]),
            default => clone ($this, [
                'cityId' => $city,
                'cityFactory' => null,
                'englishTitle' => null,
                'russianTitle' => null,
            ]),
        };
    }

    #[\NoDiscard]
    public function withComment(CommentFactory|null $commentFactory = null): self
    {
        return clone ($this, ['commentFactory' => $commentFactory ?? CommentFactory::new()]);
    }

    #[\NoDiscard]
    public function withMetaImage(string $metaImage): self
    {
        return clone ($this, ['metaImage' => $metaImage]);
    }

    #[\NoDiscard]
    public function withSlug(string $slug): self
    {
        return clone ($this, ['slug' => $slug]);
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
