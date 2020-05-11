<?php

return [
    'default' => env('MAIL_MAILER', 'smtp'),

    'mailers' => [
        // smtp, sendmail, mailgun, ses, postmark, log, array
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'localhost'),
            'port' => env('MAIL_PORT', 25),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => '/usr/sbin/sendmail -bs',
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],
    ],

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS'),
        'name' => env('MAIL_FROM_NAME', 'vacuum.kaluga'),
    ],

    'markdown' => [
        'theme' => 'my',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],
];
