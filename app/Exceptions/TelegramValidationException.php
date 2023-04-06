<?php namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Ivacuum\Generic\Services\Telegram;
use Ivacuum\Generic\Utilities\UserAgent;

class TelegramValidationException
{
    public function __construct(private Telegram $telegram, private Request $request)
    {
    }

    public function __invoke(ValidationException $e): bool
    {
        $this->logValidation($e);

        return true;
    }

    private function isSpammerTrapped(ValidationException $e): bool
    {
        if (isset($e->validator->failed()['mail']['Empty'])) {
            return true;
        }

        if ($e->validator->errors()->first('mail')) {
            return true;
        }

        return false;
    }

    private function logValidation(ValidationException $e): void
    {
        if ($this->isSpammerTrapped($e)) {
            return;
        }

        $this->telegram->notifyAdmin($this->validationSummary($e));
    }

    private function validationSummary(ValidationException $e): string
    {
        $text = 'Ошибка валидации ' . fullUrl() . "\n";

        return $text . json_encode([
            'validator' => $e->validator->failed(),
            'request' => $this->request->all(),
            'browser' => UserAgent::tidy(\Request::userAgent()),
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
