<?php

namespace App\Domain;

enum ExternalService: string
{
    case Example = 'example';
    case Rutracker = 'rto';
    case Telegram = 'telegram';
    case Vk = 'vk';
    case Wanikani = 'wanikani';
}
