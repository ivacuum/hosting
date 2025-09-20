<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class RssTest extends TestCase
{
    use DatabaseTransactions;

    #[TestWith(['life/gigs/rss'])]
    #[TestWith(['life/rss'])]
    #[TestWith(['news/rss'])]
    public function testFeeds(string $url)
    {
        $this->get($url)
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml');
    }
}
