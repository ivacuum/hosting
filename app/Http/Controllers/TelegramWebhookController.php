<?php

namespace App\Http\Controllers;

use App\Http\Requests\TelegramWebhook;
use App\Jobs\TelegramPhotoCommandJob;
use App\Jobs\TelegramPhotoOnMapCallbackQueryJob;
use App\Jobs\TelegramStartCommandJob;
use Illuminate\Log\Logger;

class TelegramWebhookController
{
    public function __invoke(Logger $logger, TelegramWebhook $request)
    {
        if ($request->shouldIgnoreWebhook) {
            return;
        }

        if ($request->message && str_starts_with($request->message->text, '/')) {
            match ($request->message->text) {
                '/photo' => $this->onCommandPhoto($request),
                '/start' => $this->onCommandStart($request),
                default => null,
            };
        }

        if ($request->callbackQuery) {
            $data = $request->callbackQuery->data;

            if (str_contains($data, ':')) {
                match (str($data)->before(':')->toString()) {
                    'photoOnMap' => $this->onCallbackQueryPhotoOnMap($request),
                    default => null,
                };
            }
        }

        if (app()->isLocal()) {
            $logger->info(json_encode($request->all(), \JSON_PRETTY_PRINT));
        }

        event(new \App\Events\Stats\TelegramWebhookReceived);
    }

    private function onCallbackQueryPhotoOnMap(TelegramWebhook $request)
    {
        $photoId = str($request->callbackQuery->data)->after('photoOnMap:')->toString();

        dispatch(new TelegramPhotoOnMapCallbackQueryJob($request->chatId, $photoId, $request->messageId));
    }

    private function onCommandPhoto(TelegramWebhook $request)
    {
        dispatch(new TelegramPhotoCommandJob($request->chatId));
    }

    private function onCommandStart(TelegramWebhook $request)
    {
        dispatch(new TelegramStartCommandJob($request->chatId));
    }
}
