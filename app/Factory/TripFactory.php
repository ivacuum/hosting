<?php namespace App\Factory;

use App\Trip;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Testing\WithFaker;

class TripFactory
{
    use WithFaker;

    private $cityId;
    private $userId;
    private $metaImage;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $model = new Trip;

        $title = "{$this->faker->city} {$this->faker->numberBetween(2000, 3000)}";
        $dateStart = CarbonImmutable::instance($this->faker->dateTimeBetween('-4 years'))->startOfHour();
        $dateEnd = CarbonImmutable::instance($dateStart)->addDays(random_int(0, 3));

        $model->html = '';
        $model->slug = \Str::slug($title);
        $model->views = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);
        $model->status = Trip::STATUS_PUBLISHED;
        $model->city_id = $this->cityId ?? CityFactory::new()->withCountry()->create()->id;
        $model->user_id = $this->userId ?? 1;
        $model->date_end = $dateEnd;
        $model->markdown = '';
        $model->title_ru = $title;
        $model->title_en = $title;
        $model->date_start = $dateStart;
        $model->meta_image = $this->metaImage ?? '';

        return $model;
    }

    public function metaImage()
    {
        return $this->withMetaImage("test/IMG_{$this->faker->numberBetween(1000, 9999)}.jpg");
    }

    public static function new(): self
    {
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
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

    public function withUserId(int $userId)
    {
        $factory = clone $this;
        $factory->userId = $userId;

        return $factory;
    }
}
