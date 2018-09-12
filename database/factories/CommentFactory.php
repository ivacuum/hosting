<?php

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'html' => $faker->text,
        'status' => App\Comment::STATUS_PUBLISHED,
        'rel_id' => 0,
        'rel_type' => 'News',
    ];
});
