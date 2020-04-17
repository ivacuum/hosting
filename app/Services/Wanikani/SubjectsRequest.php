<?php namespace App\Services\Wanikani;

class SubjectsRequest implements RequestInterface
{
    private int $level;

    public function __construct(int $level)
    {
        $this->level = $level;
    }

    public function endpoint(): string
    {
        return 'subjects';
    }

    public function httpMethod(): string
    {
        return 'GET';
    }

    public function jsonSerialize()
    {
        return [
            'hidden' => 'false',
            'levels' => $this->level,
        ];
    }
}
