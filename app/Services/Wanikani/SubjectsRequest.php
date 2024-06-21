<?php

namespace App\Services\Wanikani;

use App\Http\HttpRequest;

class SubjectsRequest implements HttpRequest
{
    public function __construct(private int $level) {}

    #[\Override]
    public function endpoint(): string
    {
        return 'subjects';
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return [
            'hidden' => 'false',
            'levels' => $this->level,
        ];
    }
}
