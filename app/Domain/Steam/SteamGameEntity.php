<?php

namespace App\Domain\Steam;

use Carbon\CarbonImmutable;

readonly class SteamGameEntity
{
    public function __construct(
        public int $appId,
        public string $name,
        public string $shortDescription,
        public CarbonImmutable $releasedAt,
        public array $genres,
    ) {}

    public static function fromArray(array $data)
    {
        return new self(
            $data['steam_appid'],
            $data['name'],
            $data['short_description'],
            self::parseReleaseDate($data['release_date']['date']),
            collect($data['genres'])
                ->pluck('description')
                ->all(),
        );
    }

    private static function parseReleaseDate(string $releaseDate): CarbonImmutable|null
    {
        try {
            // 23 Jan, 2019
            return CarbonImmutable::createFromLocaleIsoFormat('!D MMM, YYYY', 'en', $releaseDate);
        } catch (\Throwable) {
        }

        try {
            // 23 янв. 2019 г.
            return CarbonImmutable::createFromLocaleIsoFormat('!D MMM. YYYY г.', 'ru', $releaseDate);
        } catch (\Throwable) {
        }

        return null;
    }
}
