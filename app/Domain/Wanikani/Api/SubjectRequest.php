<?php

namespace App\Domain\Wanikani\Api;

use App\Http\HttpRequestV2;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class SubjectRequest implements HttpRequestV2
{
    public function __construct(private int $id) {}

    public function send(PendingRequest $http): Response
    {
        return $http->get("subjects/{$this->id}");
    }
}
