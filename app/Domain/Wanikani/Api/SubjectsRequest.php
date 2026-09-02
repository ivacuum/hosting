<?php

namespace App\Domain\Wanikani\Api;

use App\Http\HttpRequest;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class SubjectsRequest implements HttpRequest
{
    public function __construct(private int $level) {}

    public function send(PendingRequest $http): Response
    {
        return $http->get('subjects', [
            'hidden' => 'false',
            'levels' => $this->level,
        ]);
    }
}
