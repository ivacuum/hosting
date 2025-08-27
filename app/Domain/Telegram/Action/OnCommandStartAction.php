<?php

namespace App\Domain\Telegram\Action;

use App\Domain\Telegram\Api\TelegramClient;
use App\LinkRequest;

class OnCommandStartAction
{
    public function __construct(private TelegramClient $telegram) {}

    public function execute(int $chatId, string|null $startParameter): array
    {
        event(new \App\Events\Stats\TelegramStartCommand);

        if ($startParameter) {
            $linkRequest = LinkRequest::query()
                ->firstWhere('token', $startParameter);

            if ($linkRequest) {
                $linkRequest->user->telegram_id = $chatId;
                $linkRequest->user->telegram_linked_at = now();
                $linkRequest->user->save();
                $linkRequest->delete();

                event(new \App\Events\Stats\TelegramAccountLinked);

                return $this->telegram
                    ->asResponse()
                    ->chat($chatId)
                    ->sendMessage('Запомнили ваш аккаунт. Теперь мы можете получать уведомления от сайта прямо в этот диалог.');
            }

            return $this->telegram
                ->asResponse()
                ->chat($chatId)
                ->sendMessage('Не удалось найти ваш запрос на привязку аккаунта. Пожалуйста, повторите попытку на сайте.');
        }

        return $this->telegram
            ->asResponse()
            ->chat($chatId)
            ->sendMessage('Рановато вы на огонек, потому что инструкций по боту еще нет. Предлагаю в качестве развлечения посмотреть случайную фотографию /photo.');
    }
}
