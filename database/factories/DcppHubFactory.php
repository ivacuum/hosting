<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\DcppHub::class, fn (Faker\Generator $faker) => [
    'port' => 411,
    'title' => $faker->words(3, true),
    'clicks' => $faker->optional(0.9, 0)->numberBetween(1, 10000),
    'status' => App\DcppHub::STATUS_PUBLISHED,
    'address' => $faker->domainName,
]);
