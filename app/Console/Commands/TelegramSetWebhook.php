<?php

namespace App\Console\Commands;

use App\Http\Controllers\TelegramWebhookController;
use Ivacuum\Generic\Commands\Command;
use Ivacuum\Generic\Telegram\TelegramClient;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('telegram:set-webhook')]
class TelegramSetWebhook extends Command
{
    protected $signature = 'telegram:set-webhook {host?} {--secret}';
    protected $description = 'Set webhook address';

    public function handle(TelegramClient $telegram): never
    {
        $secretToken = $this->option('secret')
            ? \Str::random()
            : null;

        $response = $telegram->setWebhook($this->endpoint($this->argument('host')), $secretToken);

        dd($response, "Secret token: {$secretToken}");
    }

    private function endpoint(string|null $host): string
    {
        if ($host === null) {
            return action(TelegramWebhookController::class);
        }

        return $host . action(TelegramWebhookController::class, absolute: false);
    }
}
