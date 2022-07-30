<?php namespace App\Jobs;

use Ivacuum\Generic\Telegram\TelegramClient;

class TelegramStartCommandJob extends AbstractJob
{
    public function __construct(private int $chatId)
    {
    }

    public function handle(TelegramClient $telegram)
    {
        $telegram
            ->chat($this->chatId)
            ->sendMessage('Рановато вы на огонек, потому что инструкций по боту еще нет. Предлагаю в качестве развлечения посмотреть случайную фотографию /photo.');

        event(new \App\Events\Stats\TelegramStartCommand);
    }
}
