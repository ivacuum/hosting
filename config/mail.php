<?php

return [

    // smtp, sendmail, mailgun, mandrill, ses, sparkpost, postmark, log, array
    'driver'     => env('MAIL_DRIVER', 'smtp'),
    'host'       => env('MAIL_HOST', 'localhost'),
    'port'       => env('MAIL_PORT', 25),
    'from'       => [
        'address' => env('MAIL_FROM_ADDRESS', null),
        'name'    => env('MAIL_FROM_NAME', 'vacuum.kaluga'),
    ],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username'   => env('MAIL_USERNAME'),
    'password'   => env('MAIL_PASSWORD'),
    'sendmail'   => '/usr/sbin/sendmail -bs',

    'markdown' => [
        'theme' => 'my',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];
