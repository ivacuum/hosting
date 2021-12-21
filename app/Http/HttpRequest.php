<?php namespace App\Http;

interface HttpRequest extends \JsonSerializable
{
    public function endpoint(): string;
}
