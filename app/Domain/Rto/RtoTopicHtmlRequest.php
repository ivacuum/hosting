<?php

namespace App\Domain\Rto;

use App\Http\HttpRequest;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class RtoTopicHtmlRequest implements HttpRequest
{
    public function __construct(private int $topicId) {}

    public function send(PendingRequest $http): Response
    {
        return $http->get('https://rutracker.org/forum/viewtopic.php', [
            't' => $this->topicId,
        ]);
    }
}
