<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\GigStatus;
use App\Domain\Life\Models\Gig;
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

        $gig = new Gig;
        $gig->date = CarbonImmutable::instance(fake()->dateTimeBetween('-4 years'))->startOfDay();
        $gig->slug = $this->slug ?? \Str::slug($title);
        $gig->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $gig->status = $this->status;
        $gig->city_id = $this->cityId ?? CityFactory::new()->create()->id;
        $gig->title_en = $title;
        $gig->title_ru = $title;
        $gig->artist_id = $this->artistId ?? ArtistFactory::new()->create()->id;

        return $gig;
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
