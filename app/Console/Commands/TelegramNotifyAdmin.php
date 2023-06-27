<?php

namespace App\Console\Commands;

use Ivacuum\Generic\Commands\Command;
use Ivacuum\Generic\Services\Telegram;

class TelegramNotifyAdmin extends Command
{
    protected $signature = 'telegram:notify-admin {text}';
    protected $description = 'Notify admin via telegram';

    public function handle(Telegram $telegram)
    {
        $telegram->notifyAdmin($this->argument('text'));
    }
}
