<?php namespace App\Factory;

use App\Domain\TripStatus;
use App\Trip;
use Carbon\CarbonImmutable;

class TripFactory
{
    private $slug;
    private $cityId;
    private $userId;
    private $metaImage;
    private TripStatus $status = TripStatus::Published;

    private ?UserFactory $userFactory = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Trip;

        $title = fake()->city() . ' ' . fake()->numberBetween(2000, 3000);
        $dateStart = CarbonImmutable::instance(fake()->dateTimeBetween('-4 years'))->startOfHour();
        $dateEnd = CarbonImmutable::instance($dateStart)->addDays(random_int(0, 3));

        $model->html = '';
        $model->slug = $this->slug ?? \Str::slug($title);
        $model->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $model->status = $this->status;
        $model->city_id = $this->cityId ?? CityFactory::new()->create()->id;
        $model->date_end = $dateEnd;
        $model->markdown = '';
        $model->title_ru = $title;
        $model->title_en = $title;
        $model->date_start = $dateStart;
        $model->meta_image = $this->metaImage ?? '';

        if ($this->userFactory && !$this->userId) {
            $model->user_id = $this->userFactory->create()->id;
        } else {
            $model->user_id = $this->userId ?? 1;
        }

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

    public function withCityId(int $cityId)
    {
        $factory = clone $this;
        $factory->cityId = $cityId;

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

    public function withUser(UserFactory $userFactory = null)
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
