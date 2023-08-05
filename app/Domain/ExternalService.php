<?php

namespace App\Domain;

enum ExternalService: string
{
    case Example = 'example';
    case Life = 'life';
    case Rutracker = 'rto';
    case Telegram = 'telegram';
    case Unknown = '';
    case Vk = 'vk';
    case Wanikani = 'wanikani';
}
