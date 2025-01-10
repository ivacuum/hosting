<?php

return [
    // TODO: Файл можно будет удалить после переноса всех моделей в папку Models
    'providers' => [
        'users' => [
            // database, eloquent
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],
    ],
];
