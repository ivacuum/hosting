<?php namespace App\Services\YandexPdd;

interface RequestInterface extends \JsonSerializable
{
    public function endpoint(): string;

    public function httpMethod(): string;
}
