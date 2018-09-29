<?php

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Country::class, function (Faker\Generator $faker) {
    $title = $faker->country;

    return [
        'slug' => str_slug($title),
        'emoji' => '',
        'views' => $faker->optional(0.9, 0)->numberBetween(1, 10000),
        'title_ru' => $title,
        'title_en' => $title,
    ];
});
