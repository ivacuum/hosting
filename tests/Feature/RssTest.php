<?php namespace Tests\Feature;

use Tests\TestCase;

class RssTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\DataProvider('feeds')]
    public function testFeeds(string $url)
    {
        $this->get($url)
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml');
    }

    public static function feeds()
    {
        yield ['life/gigs/rss'];
        yield ['life/rss'];
        yield ['news/rss'];
    }
}
