<?php

namespace App\Domain\Telegram\Api;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Client\RequestException;

class TelegramException extends \Exception
{
    public static function fromLaravelRequestException(RequestException $e): self
    {
        $code = $e->response->getStatusCode();
        $description = $e->response->json('description', 'no description given');

        return new static("Telegram responded with an error `{$code} - {$description}`", $code, $e);
    }

    public static function errorResponse(ClientException $e): self
    {
        $code = $e->getResponse()->getStatusCode();

        if (!$e->hasResponse()) {
            return new static('Telegram responded with an error but no response body found', $code, $e);
        }

        $json = json_decode($e->getResponse()->getBody());
        $description = $json->description ?? 'no description given';

        return new static("Telegram responded with an error `{$code} - {$description}`", $code, $e);
    }

    public static function generalError(\Throwable $e): self
    {
        return new static('The communication with Telegram failed.', 0, $e);
    }
}
