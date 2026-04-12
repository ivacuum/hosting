<?php

namespace App\Domain\Steam;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

readonly class SteamGameSearchResponse
{
    public Collection $games;

    public function __construct(Response $response)
    {
        $this->games = $response
            ->collect('items')
            ->mapWithKeys(fn ($data) => [$data['id'] => $data['name']]);
    }

    public static function fakeSuccess()
    {
        return [
            'store.steampowered.com/api/storesearch*' => Factory::response([
                'total' => 2,
                'items' => [
                    [
                        'id' => 220,
                        'name' => 'Half-Life 2',
                    ],
                    [
                        'id' => 1235140,
                        'name' => 'Yakuza: Like a Dragon',
                    ],
                ],
            ]),
        ];
    }
}
