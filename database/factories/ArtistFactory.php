<?php

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Artist::class, function (Faker\Generator $faker) {
    $title = $faker->word;

    return [
        'slug' => $title,
        'title' => $title,
    ];
});
