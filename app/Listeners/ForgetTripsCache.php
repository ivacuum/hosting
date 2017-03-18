<?php namespace App\Listeners;

use Illuminate\Cache\Repository;

class ForgetTripsCache
{
    protected $cache;

    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    public function handle()
    {
        $this->cache->forget('published-trips-by-country');
        $this->cache->forget('published-trips-by-city');
    }
}
