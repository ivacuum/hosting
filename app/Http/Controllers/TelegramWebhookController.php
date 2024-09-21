<?php

namespace App\Http\Controllers;

use App\Domain\Telegram\OnCallbackQueryPhotoOnMap;
use App\Domain\Telegram\OnCommandPhoto;
use App\Domain\Telegram\OnCommandStart;
use App\Http\Requests\TelegramWebhook;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Pipeline;

class TelegramWebhookController
{
    public function __invoke(Logger $logger, TelegramWebhook $request)
    {
        if ($request->shouldIgnoreWebhook) {
            return null;
        }

        event(new \App\Events\Stats\TelegramWebhookReceived);

        if (app()->isLocal()) {
            $logger->info(json_encode($request->all(), \JSON_PRETTY_PRINT));
        }

        $response = Pipeline::send($request)
            ->through([
                OnCommandPhoto::class,
                OnCommandStart::class,
                OnCallbackQueryPhotoOnMap::class,
            ])
            ->then(fn (array|TelegramWebhook $result) => $result);

        if ($response instanceof TelegramWebhook) {
            return [];
        }

        return $response;
    }
}
