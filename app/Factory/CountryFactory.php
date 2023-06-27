<?php

namespace App\Factory;

use App\Country;

class CountryFactory
{
    public function create()
    {
        $model = $this->make();
        $model->save();

        return $model;
    }

    public function make()
    {
        $title = fake()->country() . ' ' . fake()->randomDigit();

        $model = new Country;
        $model->slug = \Str::slug($title);
        $model->emoji = '';
        $model->views = fake()->optional(0.9, 0)->numberBetween(1, 10000);
        $model->title_en = $title;
        $model->title_ru = $title;

        return $model;
    }

    public static function new(): self
    {
        return new self;
    }
}
