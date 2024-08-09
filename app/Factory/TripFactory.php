<?php

namespace App\Factory;

use App\City;
use App\Domain\TripStatus;
use App\Trip;
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
            ?->withTripId($model->id)
            ->create();

        return $model;
    }

    public function make()
    {
        $model = new Trip;

        $title = fake()->city() . ' ' . fake()->numberBetween(2000, 3000);
        $dateStart = CarbonImmutable::instance(fake()->dateTimeBetween('2015-01-01'))->startOfHour();
        $dateEnd = CarbonImmutable::instance($dateStart)->addDays(random_int(0, 3));

        $model->html = '';
        $model->slug = $this->slug ?? \Str::slug($this->englishTitle ?? $title);
        $model->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $model->status = $this->status;
        $model->city_id = $this->cityId ?? CityFactory::new()->create()->id;
        $model->user_id = $this->userId ?? $this->userFactory?->create()->id ?? 1;
        $model->date_end = $dateEnd;
        $model->markdown = '';
        $model->title_en = $this->englishTitle ?? $title;
        $model->title_ru = $this->russianTitle ?? $title;
        $model->date_start = $dateStart;
        $model->meta_image = $this->metaImage ?? '';

        return $model;
    }

    public function metaImage()
    {
        return $this->withMetaImage(fake()->numerify('test/IMG_####.jpg'));
    }

    public static function new(): self
    {
        return new self;
    }

    public function withCity(City $city)
    {
        $factory = clone $this;
        $factory->cityId = $city->id;
        $factory->englishTitle = $city->title_en;
        $factory->russianTitle = $city->title_ru;

        return $factory;
    }

    public function withCityId(int $cityId)
    {
        $factory = clone $this;
        $factory->cityId = $cityId;

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

    public function withUser(UserFactory|null $userFactory = null)
    {
        $factory = clone $this;
        $factory->userFactory = $userFactory ?? UserFactory::new();

        return $factory;
    }

    public function withUserId(int $userId)
    {
        $factory = clone $this;
        $factory->userId = $userId;

        return $factory;
    }
}
