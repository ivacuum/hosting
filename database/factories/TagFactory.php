<?php

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    $title = "{$faker->word} {$faker->randomDigit}";

    return [
        'views' => $faker->optional(0.9, 0)->numberBetween(1, 10000),
        'title_en' => $title,
        'title_ru' => $title,
    ];
});
