<?php

namespace App\Domain\Steam;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

readonly class SteamGameDetailsResponse
{
    public bool $successful;
    public SteamGameEntity|null $game;

    public function __construct(Response $response)
    {
        $appId = array_key_first($response->json());

        $this->successful = $response->json("{$appId}.success") ?? false;

        $this->game = $this->successful
            ? SteamGameEntity::fromArray($response->json("{$appId}.data"))
            : null;
    }

    public static function fakeNotFound(int $appId)
    {
        return [
            'store.steampowered.com/api/appdetails*' => Factory::response([
                $appId => [
                    'success' => false,
                ],
            ]),
        ];
    }

    public static function fakeSuccess(int $appId, SteamLanguage $language = SteamLanguage::English)
    {
        return [
            'store.steampowered.com/api/appdetails*' => Factory::response([
                $appId => [
                    'success' => true,
                    'data' => [
                        'name' => 'Game Name',
                        'steam_appid' => $appId,
                        'short_description' => match ($language) {
                            SteamLanguage::English => 'Short Description',
                            SteamLanguage::Russian => 'Краткое описание',
                        },
                        'release_date' => [
                            'date' => match ($language) {
                                SteamLanguage::English => '26 Jul, 2024',
                                SteamLanguage::Russian => '26 июл. 2024 г.',
                            },
                        ],
                        'genres' => [
                            [
                                'id' => '2',
                                'description' => match ($language) {
                                    SteamLanguage::English => 'Strategy',
                                    SteamLanguage::Russian => 'Стратегии',
                                },
                            ],
                        ],
                    ],
                ],
            ]),
        ];
    }
}
