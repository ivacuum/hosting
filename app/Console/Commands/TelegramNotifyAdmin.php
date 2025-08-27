<?php

namespace App\Console\Commands;

use Ivacuum\Generic\Services\Telegram;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('telegram:notify-admin')]
class TelegramNotifyAdmin extends Command
{
    protected $signature = 'telegram:notify-admin {text}';
    protected $description = 'Notify admin via telegram';

    public function handle(Telegram $telegram)
    {
        $telegram->notifyAdmin($this->argument('text'));
    }
}
