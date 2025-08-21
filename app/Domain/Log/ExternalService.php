<?php

namespace App\Domain\Log;

enum ExternalService: string
{
    case Example = 'example';
    case Instagram = 'instagram';
    case Life = 'life';
    case Rutracker = 'rto';
    case Telegram = 'telegram';
    case Unknown = '';
    case Vk = 'vk';
    case Wanikani = 'wanikani';
}
