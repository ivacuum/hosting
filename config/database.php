<?php

use Illuminate\Support\Str;
use Predis\Retry\Strategy\ExponentialBackoff;

return [
    'connections' => [
        // Только переопределенное подключение ради `mysql.options`.
        // Остальные подключения берутся из конфига фреймворка.
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_0900_ai_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => [
                \PDO::ATTR_EMULATE_PREPARES => true,
            ],
        ],
    ],
    'redis' => [
        'client' => env('REDIS_CLIENT', 'phpredis'),
        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')) . '-database-'),
            'persistent' => env('REDIS_PERSISTENT', false),
        ],
        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            // Настройки только для PhpRedis.
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
            'command_retries' => env('REDIS_COMMAND_RETRIES', 0),
            // Только Predis: задержки в микросекундах, число повторов берется из max_retries.
            'retry' => [
                ExponentialBackoff::class => [
                    100_000,
                    1_000_000,
                    // Jitter в Predis 3.6.1 вызывал предупреждение о потере точности float → int.
                    false,
                ],
            ],
        ],
        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            // Настройки только для PhpRedis.
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
            'command_retries' => env('REDIS_COMMAND_RETRIES', 0),
            // Только Predis: задержки в микросекундах, число повторов берется из max_retries.
            'retry' => [
                ExponentialBackoff::class => [
                    100_000,
                    1_000_000,
                    // Jitter в Predis 3.6.1 вызывал предупреждение о потере точности float → int.
                    false,
                ],
            ],
        ],
    ],
];
