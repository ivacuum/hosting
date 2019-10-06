<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Kanji::class, function (Faker\Generator $faker) {
    return [
        'level' => $faker->numberBetween(1, 60),
        'nanori' => '',
        'onyomi' => $faker->word,
        'meaning' => $faker->words(2, true),
        'character' => $faker->unique()->word,
        'kunyomi' => $faker->word,
        'important_reading' => $faker->randomElement(['onyomi', 'kunyomi']),
    ];
});
