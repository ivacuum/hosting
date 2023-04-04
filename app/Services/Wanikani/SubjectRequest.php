<?php namespace App\Services\Wanikani;

use App\Http\HttpRequest;

class SubjectRequest implements HttpRequest
{
    public function __construct(private int $id)
    {
    }

    public function endpoint(): string
    {
        return "subjects/{$this->id}";
    }

    public function jsonSerialize(): array
    {
        return [];
    }
}
