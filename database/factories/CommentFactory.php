<?php

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'html' => $faker->text,
        'status' => App\Comment::STATUS_PUBLISHED,
        'rel_id' => 0,
        'rel_type' => 'News',

        'user_id' => factory(App\User::class),
    ];
});

$factory->state(App\Comment::class, 'news', function () {
    return [
        'rel_id' => factory(App\News::class),
        'rel_type' => 'News',
    ];
});

$factory->state(App\Comment::class, 'torrent', function () {
    return [
        'rel_id' => factory(App\Torrent::class),
        'rel_type' => 'Torrent',
    ];
});
