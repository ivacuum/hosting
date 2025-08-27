<?php

namespace App\Console\Commands;

use App\Domain\Steam\SteamApi;
use App\Domain\Steam\SteamCountryCode;
use App\Domain\Steam\SteamLanguage;
use Illuminate\Contracts\Console\Isolatable;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\search;

#[AsCommand('app:find-steam-game')]
class FindSteamGame extends Command implements Isolatable
{
    protected $signature = 'app:find-steam-game';
    protected $description = 'Get steam game data for seeder';

    public function handle(SteamApi $steam)
    {
        $steamId = search(
            label: 'Game title',
            options: fn (string $q) => mb_strlen($q) > 3
                ? $steam->gameList()->games->filter(fn ($title) => str_contains($title, $q))->all()
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
