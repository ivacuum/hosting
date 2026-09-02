<?php

namespace App\Domain\Steam;

use App\Http\HttpRequestV2;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class SteamGameDetailsRequest implements HttpRequestV2
{
    public function __construct(
        private int $appId,
        private SteamCountryCode $countryCode,
        private SteamLanguage $language,
    ) {}

    public function send(PendingRequest $http): Response
    {
        return $http->get('https://store.steampowered.com/api/appdetails', [
            'cc' => $this->countryCode->value,
            'l' => $this->language->value,
            'appids' => $this->appId,
        ]);
    }
}
