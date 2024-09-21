<?php

namespace App\Domain\Telegram;

use App\Http\Requests\TelegramWebhook;

class OnCallbackQueryPhotoOnMap
{
    public function __construct(private Action\OnCallbackQueryPhotoOnMapAction $onCallbackQueryPhotoOnMap) {}

    public function handle(TelegramWebhook $request, \Closure $next)
    {
        if ($this->shouldHandle($request)) {
            $photoId = str($request->callbackQuery->data)
                ->after('photoOnMap:')
                ->toString();

            return $this
                ->onCallbackQueryPhotoOnMap
                ->execute($request->chatId, $photoId, $request->messageId);
        }

        return $next($request);
    }

    private function shouldHandle(TelegramWebhook $request): bool
    {
        if ($request->callbackQuery?->data) {
            return str_starts_with($request->callbackQuery->data, 'photoOnMap:');
        }

        return false;
    }
}
