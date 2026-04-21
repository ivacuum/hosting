<?php

return [
    'connections' => [
        'redis' => [
            'driver' => 'redis',
            'connection' => env('REDIS_QUEUE_CONNECTION', 'default'),
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => (int) env('REDIS_QUEUE_RETRY_AFTER', 90),
            // 3 секунды ожидания задачи эффективнее 3 секунд сна
            // Если block_for=null, sleep=3 и задача поступила через 0,05 сек после начала сна, то она будет обработана через 2,95 сек
            // Если block_for=3 и задача поступила через 0,05 сек после блокировки, то она будет обработана сразу
            'block_for' => 3,
            'after_commit' => true,
        ],
    ],
];
