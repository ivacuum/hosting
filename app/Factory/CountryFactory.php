<?php

namespace App\Factory;

use App\Country;

class CountryFactory
{
    public function create()
    {
        $country = $this->make();
        $country->save();

        return $country;
    }

    public function make()
    {
        $title = fake()->country() . ' ' . fake()->randomDigit();

        $country = new Country;
        $country->slug = \Str::slug($title);
        $country->emoji = '';
        $country->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $country->title_en = $title;
        $country->title_ru = $title;

        return $country;
    }

    public static function new(): self
    {
        return new self;
    }
}
