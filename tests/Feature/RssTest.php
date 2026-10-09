<?php

namespace Tests\Feature;

use App\Factory\NewsFactory;
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

    public function testNewsFeedPreservesHtmlEntitiesInsideValidXml(): void
    {
        $title = 'Rock & Roll <live>';
        $html = "<p>Rock&nbsp;&amp; roll &lt;live&gt;</p>\n";
        $news = NewsFactory::new()->withTitle($title)->withMarkdown($html)->create();

        $response = $this->get('news/rss')->assertOk();
        $feed = simplexml_load_string($response->getContent());

        $this->assertNotFalse($feed);

        $items = $feed->xpath('//item[guid="' . url($news->www()) . '"]');

        $this->assertCount(1, $items);
        $this->assertSame($title, (string) $items[0]->title);
        $this->assertSame($html, (string) $items[0]->description);
    }
}
