<?php

namespace App\Domain\Rto;

use App\Http\HttpRequest;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class RtoTopicDataRequest implements HttpRequest
{
    /** @param list<int> $ids */
    public function __construct(private array $ids) {}

    public function send(PendingRequest $http): Response
    {
        return $http->get('https://api-rto.vacuum.name/v1/get_tor_topic_data', [
            'by' => 'topic_id',
            'val' => implode(',', $this->ids),
        ]);
    }
}
