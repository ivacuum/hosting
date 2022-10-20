<?php namespace App\Factory;

use App\City;
use App\Spatial\Point;

class CityFactory
{
    private $countryId;
    private ?CountryFactory $countryFactory = null;

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
        $model->lat = (string) fake()->latitude();
        $model->lon = (string) fake()->longitude();
        $model->iata = '';
        $model->slug = \Str::slug($title);
        $model->point = new Point($model->lat, $model->lon);
        $model->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $model->title_en = $title;
        $model->title_ru = $title;
        $model->country_id = $this->countryId;

        if (!$model->country_id) {
            $model->country_id = ($this->countryFactory ?? CountryFactory::new())
                ->create()
                ->id;
        }

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
}
