<?php

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Vocabulary::class, function (Faker\Generator $faker) {
    return [
        'kana' => $faker->word,
        'level' => $faker->numberBetween(1, 60),
        'meaning' => $faker->words(2, true),
        'character' => $faker->unique()->word,
        'sentences' => $faker->sentence,
    ];
});
