<?php

namespace App\Domain\Rto;

use App\Http\HttpRequest;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class RtoTopicIdRequest implements HttpRequest
{
    public function __construct(private string $hash) {}

    public function send(PendingRequest $http): Response
    {
        return $http->get('https://api-rto.vacuum.name/v1/get_topic_id', [
            'by' => 'hash',
            'val' => $this->hash,
        ]);
    }
}
