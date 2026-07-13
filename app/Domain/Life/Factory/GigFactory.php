<?php

namespace App\Domain\Life\Factory;

use App\Domain\Life\GigStatus;
use App\Domain\Life\Models\Artist;
use App\Domain\Life\Models\City;
use App\Domain\Life\Models\Gig;
use Carbon\CarbonImmutable;

class GigFactory
{
    private int|null $cityId = null;
    private int|null $artistId = null;
    private string|null $slug = null;
    private GigStatus $status = GigStatus::Published;

    private CityFactory|null $cityFactory = null;
    private ArtistFactory|null $artistFactory = null;

    public function create()
    {
        $model = $this->make();
        $model->city_id ??= ($this->cityFactory ?? CityFactory::new())->create()->id;
        $model->artist_id ??= ($this->artistFactory ?? ArtistFactory::new())->create()->id;
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
        $gig->city_id = $this->cityId;
        $gig->title_en = $title;
        $gig->title_ru = $title;
        $gig->artist_id = $this->artistId;

        return $gig;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withArtist(int|Artist $artist)
    {
        $factory = clone $this;

        if ($artist instanceof Artist) {
            $factory->artistId = $artist->id;
        } else {
            $factory->artistId = $artist;
        }

        return $factory;
    }

    public function withCity(int|City $city)
    {
        $factory = clone $this;

        if ($city instanceof City) {
            $factory->cityId = $city->id;
        } else {
            $factory->cityId = $city;
        }

        return $factory;
    }

    public function withSlug(string $slug)
    {
        $factory = clone $this;
        $factory->slug = $slug;

        return $factory;
    }
}
