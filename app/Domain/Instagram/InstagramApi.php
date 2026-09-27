<?php

namespace App\Domain\Instagram;

use App\Http\HttpRequest;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class InstagramApi
{
    public function __construct(
        private Factory $http,
    ) {}

    public function createMedia(#[\SensitiveParameter] string $accessToken, string $imageUrl, string $caption): InstagramCreateMediaResponse
    {
        $request = new InstagramCreateMediaRequest($imageUrl, $caption);

        return new InstagramCreateMediaResponse($this->sendRequest($request, $accessToken));
    }

    public function me(#[\SensitiveParameter] string $accessToken): InstagramMeResponse
    {
        $request = new InstagramMeRequest;

        return new InstagramMeResponse($this->sendRequest($request, $accessToken));
    }

    public function publishMedia(#[\SensitiveParameter] string $accessToken, string $creationId): InstagramPublishMediaResponse
    {
        $request = new InstagramPublishMediaRequest($creationId);

        return new InstagramPublishMediaResponse($this->sendRequest($request, $accessToken));
    }

    public function refreshAccessToken(#[\SensitiveParameter] string $accessToken): InstagramRefreshAccessTokenResponse
    {
        $request = new InstagramRefreshAccessTokenRequest;

        return new InstagramRefreshAccessTokenResponse($this->sendRequest($request, $accessToken));
    }

    private function http(#[\SensitiveParameter] string $accessToken): PendingRequest
    {
        return $this->http
            ->createPendingRequest()
            ->baseUrl('https://graph.instagram.com/v23.0/')
            ->connectTimeout(3)
            ->timeout(30)
            ->throw()
            ->withQueryParameters(['access_token' => $accessToken]);
    }

    private function sendRequest(HttpRequest $request, #[\SensitiveParameter] string $accessToken): Response
    {
        return $request->send($this->http($accessToken));
    }
}
