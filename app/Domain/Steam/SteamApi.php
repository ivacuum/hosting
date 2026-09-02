<?php

namespace App\Domain\Steam;

use App\Http\HttpRequest;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class SteamApi
{
    public function __construct(
        private Factory $http,
    ) {}

    public function gameDetails(int $appId, SteamCountryCode $countryCode, SteamLanguage $language): SteamGameDetailsResponse
    {
        $request = new SteamGameDetailsRequest($appId, $countryCode, $language);

        return new SteamGameDetailsResponse($this->sendRequest($request));
    }

    public function searchGames(string $query): SteamGameSearchResponse
    {
        $request = new SteamGameSearchRequest($query);

        return new SteamGameSearchResponse($this->sendRequest($request));
    }

    private function http(): PendingRequest
    {
        return $this->http
            ->createPendingRequest()
            ->connectTimeout(3)
            ->timeout(10)
            ->throw();
    }

    private function sendRequest(HttpRequest $request): Response
    {
        return $request->send($this->http());
    }
}
