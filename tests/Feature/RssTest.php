<?php namespace Tests\Feature;

use Tests\TestCase;

class RssTest extends TestCase
{
    /** @dataProvider feeds */
    public function testFeeds(string $url)
    {
        $this->get($url)
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml');
    }

    public function feeds()
    {
        yield ['life/gigs/rss'];
        yield ['life/rss'];
        yield ['news/rss'];
    }
}
