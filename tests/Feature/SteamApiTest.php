<?php

namespace Tests\Feature;

use App\Domain\Steam\SteamApi;
use App\Domain\Steam\SteamCountryCode;
use App\Domain\Steam\SteamGameDetailsResponse;
use App\Domain\Steam\SteamGameEntity;
use App\Domain\Steam\SteamGameListResponse;
use App\Domain\Steam\SteamLanguage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SteamApiTest extends TestCase
{
    use DatabaseTransactions;

    public function testGameDetails()
    {
        \Http::fake([
            ...SteamGameDetailsResponse::fakeSuccess(646570),
        ]);

        $response = $this->app
            ->make(SteamApi::class)
            ->gameDetails(646570, SteamCountryCode::Kyrgyzstan, SteamLanguage::English);

        $this->assertTrue($response->successful);
        $this->assertInstanceOf(SteamGameEntity::class, $response->game);

        $this->assertSame(646570, $response->game->appId);
        $this->assertTrue(true);
    }

    public function testGameDetailsNotFound()
    {
        \Http::fake([
            ...SteamGameDetailsResponse::fakeNotFound(111),
        ]);

        $response = $this->app
            ->make(SteamApi::class)
            ->gameDetails(111, SteamCountryCode::Kyrgyzstan, SteamLanguage::English);

        $this->assertFalse($response->successful);
    }

    public function testGameList()
    {
        \Http::fake([
            ...SteamGameListResponse::fakeSuccess(),
        ]);

        $response = $this->app
            ->make(SteamApi::class)
            ->gameList();

        $this->assertCount(2, $response->games);
        $this->assertSame('Half-Life 2', $response->games[220]);
        $this->assertSame('Yakuza: Like a Dragon', $response->games[1235140]);
    }
}
