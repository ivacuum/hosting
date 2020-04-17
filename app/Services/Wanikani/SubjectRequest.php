<?php namespace App\Services\Wanikani;

class SubjectRequest implements RequestInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
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
