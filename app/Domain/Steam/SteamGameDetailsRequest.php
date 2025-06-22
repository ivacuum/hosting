<?php

namespace App\Domain\Steam;

use App\Http\HttpRequest;

readonly class SteamGameDetailsRequest implements HttpRequest
{
    public function __construct(
        private int $appId,
        private SteamCountryCode $countryCode,
        private SteamLanguage $language,
    ) {}

    #[\Override]
    public function endpoint(): string
    {
        return 'https://store.steampowered.com/api/appdetails';
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return [
            'cc' => $this->countryCode->value,
            'l' => $this->language->value,
            'appids' => $this->appId,
        ];
    }
}
