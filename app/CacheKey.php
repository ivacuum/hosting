<?php namespace App;

class CacheKey
{
    const CITIES_BY_ID = 'cities.id.v2';
    const CITIES_BY_SLUG = 'cities.slug.v2';

    const COUNTRIES_BY_ID = 'countries.id';
    const COUNTRIES_BY_SLUG = 'countries.slug';

    const DOMAINS_WHOIS = 'domains.whois.{key}';

    const PHOTOS_POINTS = 'photos.points.all';
    const PHOTOS_POINTS_FOR_TRIP = 'photos.points.trip'; // Отключено

    const TORRENTS_STATS_BY_CATEGORIES = 'torrents.stats.by-categories';

    const TRIPS_PUBLISHED_BY_CITY = 'trips.published.by-cities';
    const TRIPS_PUBLISHED_BY_COUNTRY = 'trips.published.by-country';
    const TRIPS_PUBLISHED_WITH_COVER = 'trips.published.with-cover';

    const VK_WALL_GET = 'vk.wall.get.{key}';

    public static function key(string $cacheEntry, string $replace): string
    {
        return str_replace('{key}', $replace, $cacheEntry);
    }
}
