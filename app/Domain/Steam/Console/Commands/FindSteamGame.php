<?php

namespace App\Domain\Steam\Console\Commands;

use App\Console\Commands\Command;
use App\Domain\Steam\SteamApi;
use App\Domain\Steam\SteamCountryCode;
use App\Domain\Steam\SteamLanguage;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Support\Str;

use function Laravel\Prompts\search;

#[Signature('app:find-steam-game')]
#[Description('Get steam game data for seeder')]
class FindSteamGame extends Command implements Isolatable
{
    public function handle(SteamApi $steam)
    {
        $steamId = search(
            label: 'Game title',
            options: static fn (string $q) => mb_strlen($q) > 3
                ? $steam->searchGames($q)->games->all()
                : [],
        );

        $english = $steam->gameDetails($steamId, SteamCountryCode::Kyrgyzstan, SteamLanguage::English)->game;
        $russian = $steam->gameDetails($steamId, SteamCountryCode::Kyrgyzstan, SteamLanguage::Russian)->game;

        $slug = Str::slug($english->name);

        echo <<<"TEXT"
GameFactory::new()
    ->withSteamId({$english->appId})
    ->withTitle("{$english->name}")
    ->withSlug("{$slug}")
    ->withShortDescriptionEn("{$english->shortDescription}")
    ->withShortDescriptionRu("{$russian->shortDescription}")
    ->withReleasedAt('{$english->releasedAt->toDateString()}')
    ->create();

TEXT;

        return self::SUCCESS;
    }
}
