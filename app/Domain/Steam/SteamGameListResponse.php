<?php

namespace App\Domain\Steam;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

readonly class SteamGameListResponse
{
    public Collection $games;

    public function __construct(Response $response)
    {
        $this->games = $response
            ->collect('applist.apps')
            ->mapWithKeys(fn ($data) => [$data['appid'] => $data['name']]);
    }

    public static function fakeSuccess()
    {
        return [
            'api.steampowered.com/ISteamApps/GetAppList/v0002/' => Factory::response([
                'applist' => [
                    'apps' => [
                        [
                            'appid' => 220,
                            'name' => 'Half-Life 2',
                        ],
                        [
                            'appid' => 1235140,
                            'name' => 'Yakuza: Like a Dragon',
                        ],
                    ],
                ],
            ]),
        ];
    }
}
