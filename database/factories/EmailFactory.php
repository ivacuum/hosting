<?php

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Email::class, function (Faker\Generator $faker) {
    return [
        'to' => $faker->safeEmail,
        'locale' => 'ru',
        'user_id' => factory(App\User::class),
        'template' => '',
    ];
});

$factory->state(App\Email::class, 'comment', function () {
    return [
        'rel_id' => 1,
        'rel_type' => 'Comment',
        'template' => 'CommentConfirmMail',
    ];
});
