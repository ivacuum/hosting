<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\User::class, fn (Faker\Generator $faker) => [
    'email' => $faker->safeEmail,
    'login' => '',
    'locale' => 'ru',
    'status' => App\User::STATUS_ACTIVE,
]);

$factory->state(App\User::class, 'id', fn () => ['id' => 1]);
