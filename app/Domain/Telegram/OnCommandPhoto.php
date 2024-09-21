<?php

namespace App\Domain\Telegram;

use App\Http\Requests\TelegramWebhook;

class OnCommandPhoto
{
    public function __construct(private Action\OnCommandPhotoAction $onCommandPhoto) {}

    public function handle(TelegramWebhook $request, \Closure $next)
    {
        if ($this->shouldHandle($request)) {
            return $this
                ->onCommandPhoto
                ->execute($request->chatId);
        }

        return $next($request);
    }

    private function shouldHandle(TelegramWebhook $request): bool
    {
        return $request->message?->text === '/photo';
    }
}
