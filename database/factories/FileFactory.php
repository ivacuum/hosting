<?php

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\File::class, function (Faker\Generator $faker) {
    $title = $faker->word;

    return [
        'size' => $faker->numberBetween(1000, 1000000),
        'slug' => Str::slug($title),
        'title' => $title,
        'folder' => $faker->word,
        'status' => App\File::STATUS_PUBLISHED,
        'extension' => $faker->fileExtension,
        'downloads' => $faker->optional(0.9, 0)->numberBetween(1, 10000),
    ];
});
