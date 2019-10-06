<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Image::class, function (Faker\Generator $faker) {
    return [
        'slug' => Str::random(10).$faker->randomElement(['.jpg', '.png']),
        'date' => Illuminate\Support\Carbon::instance($faker->dateTimeBetween('-4 years'))->format('ymd'),
        'size' => $faker->numberBetween(1000, 1000000),
        'views' => $faker->optional(0.9, 0)->numberBetween(1, 10000),
    ];
});
