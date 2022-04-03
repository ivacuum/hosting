<?php namespace App\Domain;

enum ExternalService: string
{
    case Rutracker = 'rto';
    case Telegram = 'telegram';
    case Vk = 'vk';
    case Wanikani = 'wanikani';
    case Yandex = 'yandex';
}
