<?php namespace App\Domain;

use Carbon\CarbonInterval;

enum CacheKey: string
{
    case CitiesById = 'cities.id.v2';
    case CitiesBySlug = 'cities.slug.v2';

    case CountriesById = 'countries.id';
    case CountriesBySlug = 'countries.slug';

    case DomainsWhois = 'domains.whois.{key}';

    case PhotosPoints = 'photos.points.all';
    case PhotosPointsForTrip = 'photos.points.trip'; // Отключено

    case TorrentsStatsByCategories = 'torrents.stats.by-categories';

    case TripsPublishedByCity = 'trips.published.by-cities';
    case TripsPublishedByCountry = 'trips.published.by-country';
    case TripsPublishedWithCover = 'trips.published.with-cover';

    case VkWallGet = 'vk.wall.get.{key}';

    public function key(string $replace): string
    {
        return str_replace('{key}', $replace, $this->value);
    }

    public function ttl()
    {
        return match ($this) {
            self::PhotosPointsForTrip => CarbonInterval::minutes(0),

            self::DomainsWhois,
            self::TorrentsStatsByCategories => CarbonInterval::minutes(15),

            self::PhotosPoints => CarbonInterval::minutes(30),

            self::TripsPublishedWithCover => CarbonInterval::week(),
        };
    }
}
