<?php namespace App\Services\Wanikani;

interface RequestInterface extends \JsonSerializable
{
    public function endpoint(): string;

    public function httpMethod(): string;
}
