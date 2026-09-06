<?php

namespace App\Domain\Steam;

use App\Domain\CacheKey;
use App\Http\CacheableRequest;
use App\Http\HttpRequest;
use Carbon\CarbonInterval;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

readonly class SteamGameDetailsRequest implements CacheableRequest, HttpRequest
{
    public function __construct(
        private int $appId,
        private SteamCountryCode $countryCode,
        private SteamLanguage $language,
    ) {}

    public function cacheKey(): string
    {
        return CacheKey::SteamGameDetails->key("{$this->appId}.{$this->countryCode->value}.{$this->language->value}");
    }

    public function cacheTtl(): CarbonInterval
    {
        return CacheKey::SteamGameDetails->ttl();
    }

    public function send(PendingRequest $http): Response
    {
        return $http->get('https://store.steampowered.com/api/appdetails', [
            'cc' => $this->countryCode->value,
            'l' => $this->language->value,
            'appids' => $this->appId,
        ]);
    }

    public function shouldCache(Response $response): bool
    {
        return $response->json("{$this->appId}.success") === true;
    }
}
