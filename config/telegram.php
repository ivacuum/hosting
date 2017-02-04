<?php

return [
    'bot_token' => env('TELEGRAM_BOT_TOKEN', 'YOUR-BOT-TOKEN'),
    'async_requests' => env('TELEGRAM_ASYNC_REQUESTS', true),
    'http_client_handler' => null,
    'commands' => [
        Telegram\Bot\Commands\HelpCommand::class,
    ],
];
