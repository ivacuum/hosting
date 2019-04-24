<?php

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\City::class, function (Faker\Generator $faker) {
    $title = "{$faker->city} {$faker->randomDigit}";

    return [
        'lat' => (string) $faker->latitude,
        'lon' => (string) $faker->longitude,
        'iata' => '',
        'slug' => str_slug($title),
        'views' => $faker->optional(0.9, 0)->numberBetween(1, 10000),
        'title_ru' => $title,
        'title_en' => $title,
        'country_id' => 0,
    ];
});

$factory->state(App\City::class, 'country', function () {
    return ['country_id' => factory(App\Country::class)];
});
