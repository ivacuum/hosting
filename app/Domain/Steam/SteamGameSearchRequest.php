<?php

namespace App\Domain\Steam;

use App\Http\HttpRequest;

readonly class SteamGameSearchRequest implements HttpRequest
{
    public function __construct(
        private string $query,
    ) {}

    #[\Override]
    public function endpoint(): string
    {
        return 'https://store.steampowered.com/api/storesearch';
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return [
            'term' => $this->query,
            'l' => SteamLanguage::English->value,
            'cc' => SteamCountryCode::Kyrgyzstan->value,
        ];
    }
}
