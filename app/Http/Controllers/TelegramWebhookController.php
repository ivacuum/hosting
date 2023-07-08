<?php

namespace App\Http\Controllers;

use App\Action\Telegram\OnCallbackQueryPhotoOnMapAction;
use App\Action\Telegram\OnCommandPhotoAction;
use App\Action\Telegram\OnCommandStartAction;
use App\Http\Requests\TelegramWebhook;
use Illuminate\Log\Logger;

class TelegramWebhookController
{
    public function __construct(
        private OnCommandStartAction $onCommandStart,
        private OnCommandPhotoAction $onCommandPhoto,
        private OnCallbackQueryPhotoOnMapAction $onCallbackQueryPhotoOnMap,
    ) {
    }

    public function __invoke(Logger $logger, TelegramWebhook $request)
    {
        if ($request->shouldIgnoreWebhook) {
            return null;
        }

        event(new \App\Events\Stats\TelegramWebhookReceived);

        if (app()->isLocal()) {
            $logger->info(json_encode($request->all(), \JSON_PRETTY_PRINT));
        }

        $response = null;

        if ($request->message?->isCommand()) {
            $response = match ($request->message->text) {
                '/photo' => $this->onCommandPhoto($request),
                '/start' => $this->onCommandStart($request),
                default => null,
            };
        }

        if ($request->callbackQuery) {
            $data = $request->callbackQuery->data;

            if (str_contains($data, ':')) {
                $response = match (str($data)->before(':')->toString()) {
                    'photoOnMap' => $this->onCallbackQueryPhotoOnMap($request),
                    default => null,
                };
            }
        }

        return $response;
    }

    private function onCallbackQueryPhotoOnMap(TelegramWebhook $request)
    {
        $photoId = str($request->callbackQuery->data)->after('photoOnMap:')->toString();

        return $this->onCallbackQueryPhotoOnMap
            ->execute($request->chatId, $photoId, $request->messageId);
    }

    private function onCommandPhoto(TelegramWebhook $request)
    {
        return $this->onCommandPhoto->execute($request->chatId);
    }

    private function onCommandStart(TelegramWebhook $request)
    {
        return $this->onCommandStart->execute($request->chatId);
    }
}
