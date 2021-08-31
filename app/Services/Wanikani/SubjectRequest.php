<?php namespace App\Services\Wanikani;

class SubjectRequest implements RequestInterface
{
    public function __construct(private int $id)
    {
    }

    public function endpoint(): string
    {
        return "subjects/{$this->id}";
    }

    public function httpMethod(): string
    {
        return 'GET';
    }

    public function jsonSerialize()
    {
        return [];
    }
}
