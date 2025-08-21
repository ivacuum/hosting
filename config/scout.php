<?php

return [
    'driver' => env('SCOUT_DRIVER', 'collection'),
    'prefix' => env('SCOUT_PREFIX', 'vac_'),
    'after_commit' => true,

    'meilisearch' => [
        'host' => env('MEILISEARCH_HOST', 'http://127.0.0.1:7700'),
        'key' => env('MEILISEARCH_KEY'),
        'index-settings' => [
            App\Domain\Magnet\Models\Magnet::class => [
                'filterableAttributes' => ['id', 'category_id'],
                // 'displayedAttributes' => ['*'],
                // 'searchableAttributes' => ['*'],
            ],
        ],
    ],
];
