<?php

namespace App\Console\Commands;

use Ivacuum\Generic\Commands\Command;
use Ivacuum\Generic\Services\Telegram;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('telegram:notify-admin', 'Notify admin via telegram')]
class TelegramNotifyAdmin extends Command
{
    protected $signature = 'telegram:notify-admin {text}';

    public function handle(Telegram $telegram)
    {
        $telegram->notifyAdmin($this->argument('text'));
    }
}
