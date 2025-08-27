<?php

namespace App\Exceptions;

use App\Domain\Telegram\Action\NotifyAdminViaTelegramAction;

class TelegramAnyException
{
    public function __construct(private NotifyAdminViaTelegramAction $notifyAdminViaTelegram) {}

    public function __invoke(\Throwable $e): void
    {
        $this->notifyAdminViaTelegram->execute($this->summary($e));

        if ($previous = $e->getPrevious()) {
            $this->__invoke($previous);
        }
    }

    private function normalize(\Throwable $e): array
    {
        return [
            'class' => $e::class,
            'message' => mb_substr($e->getMessage(), 0, 3000),
            'code' => $e->getCode(),
            'file' => "{$e->getFile()}:{$e->getLine()}",
        ];
    }

    private function summary(\Throwable $e): string
    {
        $data = $this->normalize($e);

        /**
         * Короткое сообщение для лога
         *
         * Пример:
         * ErrorException (code: 1)
         * Maximum execution time of 30 seconds exceeded
         * /public/index.php:124
         */
        return sprintf(
            "%s\n%s%s\n%s\n%s\n%s",
            str_replace('App\Http\Controllers\\', '', \Route::currentRouteAction() ?? ''),
            $data['class'],
            $data['code'] ? " (code: {$data['code']})" : '',
            $data['message'],
            $data['file'],
            fullUrl()
        );
    }
}
