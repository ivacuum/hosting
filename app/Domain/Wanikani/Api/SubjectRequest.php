<?php

namespace App\Domain\Wanikani\Api;

use App\Http\HttpRequest;

class SubjectRequest implements HttpRequest
{
    public function __construct(private int $id) {}

    #[\Override]
    public function endpoint(): string
    {
        return "subjects/{$this->id}";
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return [];
    }
}
