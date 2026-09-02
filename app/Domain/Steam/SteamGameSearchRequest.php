<?php

namespace App\Domain\Steam;

use App\Http\HttpRequest;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class SteamGameSearchRequest implements HttpRequest
{
    public function __construct(
        private string $query,
    ) {}

    public function send(PendingRequest $http): Response
    {
        return $http->get('https://store.steampowered.com/api/storesearch', [
            'term' => $this->query,
            'l' => SteamLanguage::English->value,
            'cc' => SteamCountryCode::Kyrgyzstan->value,
        ]);
    }
}
