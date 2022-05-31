<?php namespace App\Services\Wanikani;

use App\Http\HttpRequest;

class SubjectsRequest implements HttpRequest
{
    public function __construct(private int $level)
    {
    }

    public function endpoint(): string
    {
        return 'subjects';
    }

    public function jsonSerialize()
    {
        return [
            'hidden' => 'false',
            'levels' => $this->level,
        ];
    }
}
