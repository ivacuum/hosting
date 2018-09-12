<?php

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Gig::class, function (Faker\Generator $faker) {
    $title = $faker->word;

    return [
        'date' => Illuminate\Support\Carbon::instance($faker->dateTimeBetween('-4 years'))->startOfDay(),
        'slug' => $title,
        'views' => $faker->optional(0.9, 0)->numberBetween(1, 10000),
        'status' => App\Gig::STATUS_PUBLISHED,
        'title_ru' => $title,
        'title_en' => $title,
    ];
});
