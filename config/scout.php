<?php

return [
    'driver' => env('SCOUT_DRIVER', 'sphinx'),
    'prefix' => env('SCOUT_PREFIX', 'vac_'),
    'queue' => env('SCOUT_QUEUE', false),
    'after_commit' => true,

    'chunk' => [
        'searchable' => 500,
        'unsearchable' => 500,
    ],

    'soft_delete' => false,

    'meilisearch' => [
        'host' => env('MEILISEARCH_HOST', 'http://127.0.0.1:7700'),
        'key' => env('MEILISEARCH_KEY'),
        'index-settings' => [
            App\Magnet::class => [
                'filterableAttributes' => ['id', 'category_id'],
            ],
        ],
    ],
];
