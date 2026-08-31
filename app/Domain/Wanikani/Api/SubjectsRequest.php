<?php

namespace App\Domain\Wanikani\Api;

use App\Http\HttpRequestV2;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class SubjectsRequest implements HttpRequestV2
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
