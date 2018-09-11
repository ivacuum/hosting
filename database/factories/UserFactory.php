<?php

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->safeEmail,
        'login' => '',
        'locale' => 'ru',
        'status' => App\User::STATUS_ACTIVE,
    ];
});
