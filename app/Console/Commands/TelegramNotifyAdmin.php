<?php

namespace App\Console\Commands;

use App\Domain\Telegram\Action\NotifyAdminViaTelegramAction;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('telegram:notify-admin')]
class TelegramNotifyAdmin extends Command
{
    protected $signature = 'telegram:notify-admin {text}';
    protected $description = 'Notify admin via telegram';

    public function handle(NotifyAdminViaTelegramAction $notifyAdminViaTelegram)
    {
        $notifyAdminViaTelegram->execute($this->argument('text'));
    }
}
