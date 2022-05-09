<?php namespace App\Factory;

use App\City;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Foundation\Testing\WithFaker;

class CityFactory
{
    use WithFaker;

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
        $title = "{$this->faker->city} {$this->faker->randomDigit()}";

        $model = new City;
        $model->lat = (string) $this->faker->latitude;
        $model->lon = (string) $this->faker->longitude;
        $model->iata = '';
        $model->slug = \Str::slug($title);
        $model->point = new Point($model->lat, $model->lon, 4326);
        $model->views = $this->faker->optional(0.9, 0)->numberBetween(1, 10000);
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
        return tap(new self, function (self $factory) {
            $factory->setUpFaker();
        });
    }

    public function withCountry(CountryFactory $countryFactory)
    {
        $factory = clone $this;
        $factory->countryFactory = $countryFactory;

        return $factory;
    }
}
