<?php

namespace App\Domain\Telegram\Job;

use App\Domain\Telegram\Api\TelegramClient;
use App\Domain\Telegram\Api\TelegramException;
use App\Jobs\AbstractJob;

class SendTelegramMessageJob extends AbstractJob
{
    public $tries = 10;
    public $backoff = 30;
    public $timeout = 20;
    public $maxExceptions = 1;

    public function __construct(
        private int $chatId,
        private string $text,
        private bool $disableWebPagePreview,
    ) {}

    public function handle(TelegramClient $telegram)
    {
        $telegram = $telegram
            ->chat($this->chatId)
            ->disableWebPagePreview($this->disableWebPagePreview);

        try {
            $telegram->sendMessage($this->text);
        } catch (TelegramException $e) {
            $code = $e->getCode();

            if ($code === 413) {
                $text = mb_substr($this->text, 0, 4000);

                $telegram->sendMessage($text);

                $text = mb_substr($e->getMessage(), 0, 4000);

                $telegram->sendMessage($text);
            } elseif ($code === 429) {
                $this->release(3600);

                return;
            } else {
                throw $e;
            }
        }

        event(new \App\Events\Stats\TelegramSent);
    }
}
