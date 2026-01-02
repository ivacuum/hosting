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

    private UserFactory|null $userFactory = null;
    private CommentFactory|null $commentFactory = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        $this->commentFactory
            ?->withTrip($model)
            ->create();

        return $model;
    }

    public function make()
    {
        $trip = new Trip;

        $title = fake()->city() . ' ' . fake()->numberBetween(2000, 3000);
        $dateStart = CarbonImmutable::instance(fake()->dateTimeBetween('2015-01-01'))->startOfHour();
        $dateEnd = CarbonImmutable::instance($dateStart)->addDays(random_int(0, 3));

        $trip->html = '';
        $trip->slug = $this->slug ?? \Str::slug($this->englishTitle ?? $title);
        $trip->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $trip->status = $this->status;
        $trip->city_id = $this->cityId ?? CityFactory::new()->create()->id;
        $trip->user_id = $this->userId ?? $this->userFactory?->create()->id ?? 1;
        $trip->date_end = $dateEnd;
        $trip->markdown = '';
        $trip->title_en = $this->englishTitle ?? $title;
        $trip->title_ru = $this->russianTitle ?? $title;
        $trip->date_start = $dateStart;
        $trip->meta_image = $this->metaImage ?? '';

        return $trip;
    }

    public function metaImage()
    {
        return $this->withMetaImage(fake()->numerify('test/IMG_####.jpg'));
    }

    public static function new(): self
    {
        return new self;
    }

    public function withCity(int|City $city)
    {
        $factory = clone $this;

        if ($city instanceof City) {
            $factory->cityId = $city->id;
            $factory->englishTitle = $city->title_en;
            $factory->russianTitle = $city->title_ru;
        } else {
            $factory->cityId = $city;
        }

        return $factory;
    }

    public function withComment(CommentFactory|null $commentFactory = null)
    {
        $factory = clone $this;
        $factory->commentFactory = $commentFactory ?? CommentFactory::new();

        return $factory;
    }

    public function withMetaImage(string $metaImage)
    {
        $factory = clone $this;
        $factory->metaImage = $metaImage;

        return $factory;
    }

    public function withSlug(string $slug)
    {
        $factory = clone $this;
        $factory->slug = $slug;

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
            $factory->userFactory = $user ?? UserFactory::new();
        }

        return $factory;
    }
}
