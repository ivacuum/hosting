<?php namespace App\Console\Commands;

use App\Http\Controllers\TelegramWebhookController;
use Ivacuum\Generic\Commands\Command;
use Ivacuum\Generic\Telegram\TelegramClient;

class TelegramSetWebhook extends Command
{
    protected $signature = 'telegram:set-webhook {host?}';
    protected $description = 'Set webhook address';

    public function handle(TelegramClient $telegram)
    {
        dd($telegram->setWebhook($this->endpoint($this->argument('host'))));
    }

    private function endpoint(?string $host): string
    {
        if ($host === null) {
            return action(TelegramWebhookController::class);
        }

        return $host . action(TelegramWebhookController::class, absolute: false);
    }
}
