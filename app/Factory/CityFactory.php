<?php

namespace App\Factory;

use App\City;
use App\Spatial\Point;

class CityFactory
{
    private int|null $countryId = null;
    private Point|null $point = null;
    private string|null $slug = null;

    private CountryFactory|null $countryFactory = null;

    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $title = fake()->city() . ' ' . fake()->randomDigit();

        $model = new City;
        $model->iata = '';
        $model->slug = $this->slug ?? \Str::slug($title);
        $model->point = $this->point ?? new Point(fake()->latitude(), fake()->longitude());
        $model->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $model->title_en = $title;
        $model->title_ru = $title;
        $model->country_id = $this->countryId ?? ($this->countryFactory ?? CountryFactory::new())->create()->id;

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }

    public function withCountry(CountryFactory $countryFactory)
    {
        $factory = clone $this;
        $factory->countryFactory = $countryFactory;

        return $factory;
    }

    public function withCountryId(int $countryId)
    {
        $factory = clone $this;
        $factory->countryId = $countryId;

        return $factory;
    }

    public function withPoint(Point $point)
    {
        $factory = clone $this;
        $factory->point = $point;

        return $factory;
    }

    public function withSlug(string $slug)
    {
        $factory = clone $this;
        $factory->slug = $slug;

        return $factory;
    }
}
