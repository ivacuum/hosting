<?php

namespace App\Action\Telegram;

use Ivacuum\Generic\Telegram\TelegramClient;

class OnCommandStartAction
{
    public function __construct(private TelegramClient $telegram)
    {
    }

    public function execute(int $chatId): array
    {
        event(new \App\Events\Stats\TelegramStartCommand);

        return $this->telegram
            ->asResponse()
            ->chat($chatId)
            ->sendMessage('Рановато вы на огонек, потому что инструкций по боту еще нет. Предлагаю в качестве развлечения посмотреть случайную фотографию /photo.');
    }
}
