<?php

namespace App\Domain\Telegram\Action;

use Ivacuum\Generic\Telegram\TelegramClient;

class OnCommandStartAction
{
    public function __construct(private TelegramClient $telegram) {}

    public function execute(int $chatId, string|null $startParameter): array
    {
        event(new \App\Events\Stats\TelegramStartCommand);

        return $this->telegram
            ->asResponse()
            ->chat($chatId)
            ->sendMessage('Рановато вы на огонек, потому что инструкций по боту еще нет. Предлагаю в качестве развлечения посмотреть случайную фотографию /photo.');
    }
}
