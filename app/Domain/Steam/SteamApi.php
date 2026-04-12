<?php

namespace App\Domain\Steam;

use App\Http\HttpRequest;
use Illuminate\Http\Client\Factory;

class SteamApi
{
    public function __construct(
        private Factory $http,
    ) {}

    public function gameDetails(int $appId, SteamCountryCode $countryCode, SteamLanguage $language)
    {
        $request = new SteamGameDetailsRequest($appId, $countryCode, $language);

        return new SteamGameDetailsResponse($this->sendRequest($request));
    }

    public function searchGames(string $query)
    {
        $request = new SteamGameSearchRequest($query);

        return new SteamGameSearchResponse($this->sendRequest($request));
    }

    private function configureClient()
    {
        return $this->http
            ->timeout(10)
            ->throw();
    }

    private function sendRequest(HttpRequest $request)
    {
        return $this->configureClient()
            ->get($request->endpoint(), $request->jsonSerialize());
    }
}
