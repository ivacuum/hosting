<?php namespace App\Factory;

use App\Domain\GigStatus;
use App\Gig;
use Carbon\CarbonImmutable;

class GigFactory
{
    private int|null $cityId = null;
    private int|null $artistId = null;
    private string|null $slug = null;
    private GigStatus $status = GigStatus::Published;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $title = fake()->word() . ' ' . fake()->numberBetween(2000, 3000);

        $model = new Gig;
        $model->date = CarbonImmutable::instance(fake()->dateTimeBetween('-4 years'))->startOfDay();
        $model->slug = $this->slug ?? \Str::slug($title);
        $model->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $model->status = $this->status;
        $model->city_id = $this->cityId ?? CityFactory::new()->create()->id;
        $model->title_en = $title;
        $model->title_ru = $title;
        $model->artist_id = $this->artistId ?? ArtistFactory::new()->create()->id;

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withArtistId(int $artistId)
    {
        $factory = clone $this;
        $factory->artistId = $artistId;

        return $factory;
    }

    public function withCityId(int $cityId)
    {
        $factory = clone $this;
        $factory->cityId = $cityId;

        return $factory;
    }

    public function withSlug(string $slug)
    {
        $factory = clone $this;
        $factory->slug = $slug;

        return $factory;
    }
}
