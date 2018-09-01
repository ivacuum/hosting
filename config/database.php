<?php

return [

    'default' => env('DB_CONNECTION', 'mysql'),

    'connections' => [

        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix'   => '',
        ],

        'mysql' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', 'localhost'),
            'port'      => env('DB_PORT', '3306'),
            'database'  => env('DB_DATABASE', 'forge'),
            'username'  => env('DB_USERNAME', 'forge'),
            'password'  => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'engine'    => null,
            'options' => [
                \PDO::ATTR_EMULATE_PREPARES => true,
            ],
        ],

        'remote_mysql' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST_REMOTE', 'localhost'),
            'port'      => env('DB_PORT_REMOTE', '3306'),
            'database'  => env('DB_DATABASE_REMOTE', 'forge'),
            'username'  => env('DB_USERNAME_REMOTE', 'forge'),
            'password'  => env('DB_PASSWORD_REMOTE', ''),
            'unix_socket' => env('DB_SOCKET_REMOTE', ''),
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
            'engine'    => null,
        ],

        'pgsql' => [
            'driver'   => 'pgsql',
            'host'     => env('DB_HOST', 'localhost'),
            'port'     => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
            'sslmode'  => 'prefer',
        ],

    ],

    'migrations' => 'migrations',

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host'     => env('REDIS_HOST', '127.0.0.1'),
            'port'     => env('REDIS_PORT', 6379),
            'password' => env('REDIS_PASSWORD', null),
            'database' => 0,
        ],

    ],

];
