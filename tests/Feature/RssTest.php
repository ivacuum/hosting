<?php namespace Tests\Feature;

use Tests\TestCase;

class RssTest extends TestCase
{
    /**
     * @dataProvider feeds
     * @param string $url
     */
    public function testFeeds(string $url)
    {
        $this->get($url)
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/xml');
    }

    public function feeds()
    {
        yield ['life/gigs/rss'];
        yield ['life/rss'];
        yield ['news/rss'];
    }
}
