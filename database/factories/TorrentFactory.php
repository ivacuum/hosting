<?php

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Torrent::class, function (Faker\Generator $faker) {
    return [
        'html' => '<p>HTML</p>',
        'size' => $faker->numberBetween(1000, 100000000000),
        'title' => $faker->words(3, true),
        'views' => $faker->optional(0.9, 0)->numberBetween(1, 10000),
        'clicks' => $faker->optional(0.9, 0)->numberBetween(1, 10000),
        'rto_id' => $faker->numberBetween(1000000, 5000000),
        'status' => App\Torrent::STATUS_PUBLISHED,
        'info_hash' => $faker->regexify('[A-F0-9]{40}'),
        'announcer' => 'http://example.com',
        'registered_at' => $faker->dateTimeBetween('-4 years'),
        'related_query' => '',

        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'category_id' => $faker->randomElement([2, 3, 4, 5, 7, 8, 9, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35]),
    ];
});
