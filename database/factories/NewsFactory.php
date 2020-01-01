<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\News::class, fn (Faker\Generator $faker) => [
    'title' => $faker->words(3, true),
    'views' => $faker->optional(0.9, 0)->numberBetween(1, 10000),
    'locale' => 'ru',
    'status' => App\News::STATUS_PUBLISHED,
    'markdown' => $faker->text,
]);

$factory->state(App\News::class, 'user', fn () => [
    'user_id' => factory(App\User::class),
]);
