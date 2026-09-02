<?php

namespace App\Domain\Telegram\Api;

use Illuminate\Http\Client\RequestException;

class TelegramException extends \Exception
{
    public static function fromLaravelRequestException(RequestException $e): self
    {
        $code = $e->response->getStatusCode();
        $description = $e->response->json('description', 'no description given');

        return new static("Telegram responded with an error `{$code} - {$description}`", $code, $e);
    }

    public static function generalError(\Throwable $e): self
    {
        return new static('The communication with Telegram failed.', 0, $e);
    }
}
