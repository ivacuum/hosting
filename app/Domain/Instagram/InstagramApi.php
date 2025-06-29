<?php

namespace App\Domain\Instagram;

use App\Http\HttpPost;
use App\Http\HttpRequest;
use Illuminate\Http\Client\Factory;

class InstagramApi
{
    public function __construct(
        private Factory $http,
    ) {}

    public function createMedia(string $accessToken, string $imageUrl, string $caption)
    {
        $request = new InstagramCreateMediaRequest($imageUrl, $caption);

        return new InstagramCreateMediaResponse($this->sendRequest($request, $accessToken));
    }

    public function me(string $accessToken)
    {
        $request = new InstagramMeRequest;

        return new InstagramMeResponse($this->sendRequest($request, $accessToken));
    }

    public function publishMedia(string $accessToken, string $creationId)
    {
        $request = new InstagramPublishMediaRequest($creationId);

        return new InstagramPublishMediaResponse($this->sendRequest($request, $accessToken));
    }

    public function refreshAccessToken(string $accessToken)
    {
        $request = new InstagramRefreshAccessTokenRequest;

        return new InstagramRefreshAccessTokenResponse($this->sendRequest($request, $accessToken));
    }

    private function configureClient(string $accessToken)
    {
        return $this->http
            ->baseUrl('https://graph.instagram.com/v23.0/')
            ->timeout(10)
            ->withQueryParameters(['access_token' => $accessToken]);
    }

    private function sendRequest(HttpRequest $request, string $accessToken)
    {
        $http = $this->configureClient($accessToken);

        $method = match (true) {
            $request instanceof HttpPost => $http->post(...),
            default => $http->get(...),
        };

        return $method($request->endpoint(), $request->jsonSerialize());
    }
}
