<?php namespace App;

class CacheKey
{
    const DOMAINS_WHOIS = 'domains.whois.{key}';

    const PHOTOS_POINTS = 'photos.points.all';
    const PHOTOS_POINTS_FOR_TRIP = 'photos.points.trip'; // Отключено

    const TORRENTS_STATS_BY_CATEGORIES = 'torrents.stats.by-categories';

    const TRIPS_PUBLISHED_BY_CITY = 'trips.published.by-cities';
    const TRIPS_PUBLISHED_BY_COUNTRY = 'trips.published.by-country';

    const VK_WALL_GET = 'vk.wall.get.{key}';

    /**
     * Динамическое название ключа для кэша
     *
     * @param  string $cache_entry
     * @param  string $replace
     * @return string
     */
    public static function key($cache_entry, $replace)
    {
        return str_replace('{key}', $replace, $cache_entry);
    }
}
