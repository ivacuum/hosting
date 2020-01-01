<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Email::class, fn (Faker\Generator $faker) => [
    'to' => $faker->safeEmail,
    'locale' => 'ru',
    'user_id' => factory(App\User::class),
    'template' => '',
]);

$factory->state(App\Email::class, 'comment', fn () => [
    'rel_id' => 1,
    'rel_type' => 'Comment',
    'template' => 'CommentConfirmMail',
]);
