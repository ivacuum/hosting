<?php namespace App\Services\YandexPdd;

class RequestException extends \Exception
{
    public static function make(string $errorCode)
    {
        return new self($errorCode);
    }
}
