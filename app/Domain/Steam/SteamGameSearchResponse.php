<?php

namespace App\Domain\Steam;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

readonly class SteamGameSearchResponse
{
    public Collection $games;

    public function __construct(public Response $response)
    {
        $this->games = $response
            ->collect('items')
            ->mapWithKeys(static fn ($data) => [$data['id'] => $data['name']]);
    }

    public static function fakeSuccess(): PromiseInterface
    {
        return Factory::response([
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
        ]);
    }
}
