<?php

namespace App\Console\Commands;

use App\Domain\Telegram\Api\TelegramClient;
use App\Http\Controllers\TelegramWebhookController;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;

#[Signature('telegram:set-webhook {host?} {--secret}')]
#[Description('Set webhook address')]
class TelegramSetWebhook extends Command
{
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
