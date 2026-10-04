<?php

namespace App\Http\Controllers;

use App\Domain\Telegram\Api\TelegramClient;
use App\Domain\Telegram\Api\TelegramException;
use App\Domain\Telegram\OnCallbackQueryPhotoOnMap;
use App\Domain\Telegram\OnCommandPhoto;
use App\Domain\Telegram\OnCommandStart;
use App\Http\Requests\TelegramWebhook;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Pipeline;

class TelegramWebhookController
{
    public function __invoke(
        Logger $logger,
        TelegramWebhook $request,
        TelegramClient $telegram,
    ): array {
        event(new \App\Events\Stats\TelegramWebhookReceived);

        if (app()->isLocal()) {
            $logger->info('telegram.webhook_received', ['payload' => $request->all()]);
        }

        if ($request->callbackQuery !== null) {
            try {
                $telegram->answerCallbackQuery($request->callbackQuery->id);
            } catch (TelegramException $exception) {
                report($exception);
            }
        }

        return Pipeline::send($request)
            ->through([
                OnCommandPhoto::class,
                OnCommandStart::class,
                OnCallbackQueryPhotoOnMap::class,
            ])
            ->then(static fn (): null => null) ?? [];
    }
}
