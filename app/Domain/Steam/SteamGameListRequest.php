<?php

namespace App\Domain\Steam;

use App\Http\HttpRequest;

readonly class SteamGameListRequest implements HttpRequest
{
    #[\Override]
    public function endpoint(): string
    {
        return 'https://api.steampowered.com/ISteamApps/GetAppList/v0002/';
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return [];
    }
}
