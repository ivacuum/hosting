<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Radical::class, function (Faker\Generator $faker) {
    return [
        'image' => '',
        'level' => $faker->numberBetween(1, 60),
        'meaning' => $faker->words(2, true),
        'character' => $faker->unique()->word,
    ];
});
