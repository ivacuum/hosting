<?php

namespace App\Domain\Instagram;

use App\Http\HttpRequest;
use Carbon\CarbonInterval;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Throwable;

readonly class InstagramPublishMediaRequest implements HttpRequest
{
    public function __construct(private string $creationId) {}

    public function send(PendingRequest $http): Response
    {
        return $http
            ->retry([
                CarbonInterval::seconds(2)->totalMilliseconds,
                CarbonInterval::seconds(4)->totalMilliseconds,
                CarbonInterval::seconds(8)->totalMilliseconds,
            ], when: static fn (Throwable $exception): bool => $exception instanceof RequestException
                && $exception->response->json('error.error_subcode') === 2207027)
            ->post('me/media_publish', [
                'creation_id' => $this->creationId,
            ]);
    }
}
