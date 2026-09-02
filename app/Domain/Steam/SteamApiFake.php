<?php

namespace App\Domain\Steam;

class SteamApiFake
{
    public static function gameDetails(int $appId, SteamLanguage $language = SteamLanguage::English): array
    {
        return [
            'store.steampowered.com/api/appdetails*' => SteamGameDetailsResponse::fakeSuccess($appId, $language),
        ];
    }

    public static function gameDetailsNotFound(int $appId): array
    {
        return [
            'store.steampowered.com/api/appdetails*' => SteamGameDetailsResponse::fakeNotFound($appId),
        ];
    }

    public static function searchGames(): array
    {
        return [
            'store.steampowered.com/api/storesearch*' => SteamGameSearchResponse::fakeSuccess(),
        ];
    }
}
