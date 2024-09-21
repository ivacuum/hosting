<?php

namespace App\Domain\Telegram;

use App\Http\Requests\TelegramWebhook;

class OnCommandStart
{
    public function __construct(private Action\OnCommandStartAction $onCommandStart) {}

    public function handle(TelegramWebhook $request, \Closure $next)
    {
        if ($this->shouldHandle($request)) {
            return $this
                ->onCommandStart
                ->execute($request->chatId, $request->message->startParameter());
        }

        return $next($request);
    }

    private function shouldHandle(TelegramWebhook $request): bool
    {
        return $request->message?->text === '/start'
            || $request->message?->hasStartParameter();
    }
}
