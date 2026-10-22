<?php

namespace App\Console\Commands;

use App\Domain\Telegram\Action\NotifyAdminViaTelegramAction;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;

#[Signature('telegram:notify-admin {text}')]
#[Description('Notify admin via telegram')]
class TelegramNotifyAdmin extends Command
{
    public function handle(NotifyAdminViaTelegramAction $notifyAdminViaTelegram): void
    {
        $notifyAdminViaTelegram->execute($this->argument('text'));
    }
}
