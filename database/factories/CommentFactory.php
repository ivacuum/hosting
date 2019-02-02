<?php

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'html' => $faker->text,
        'status' => App\Comment::STATUS_PUBLISHED,
        'rel_id' => 0,
        'rel_type' => 'News',

        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});

$factory->state(App\Comment::class, 'news', function () {
    return [
        'rel_id' => function () {
            return factory(App\News::class)->create()->id;
        },
        'rel_type' => 'News',
    ];
});

$factory->state(App\Comment::class, 'torrent', function () {
    return [
        'rel_id' => function () {
            return factory(App\Torrent::class)->create()->id;
        },
        'rel_type' => 'Torrent',
    ];
});
