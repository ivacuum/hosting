<?php namespace Tests\Feature;

use App\Factory\NewsFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        NewsFactory::new()->create();

        $this->get('news')
            ->assertOk();
    }

    public function testShow()
    {
        $news = NewsFactory::new()->create();

        \Event::fake(\App\Events\Stats\NewsViewed::class);

        $this->get("news/{$news->id}")
            ->assertOk();

        \Event::assertDispatched(\App\Events\Stats\NewsViewed::class);
    }

    /** @dataProvider oldUrls */
    public function testBackwardCompatibility(string $url)
    {
        $this->get($url)
            ->assertStatus(301)
            ->assertRedirect('news');
    }

    public function testHidden()
    {
        $news = NewsFactory::new()->hidden()->create();

        $this->get("news/{$news->id}")
            ->assertNotFound();
    }

    public function testRedirectToNewsLocale()
    {
        $news = NewsFactory::new()->english()->create();

        $this->get("news/{$news->id}")
            ->assertStatus(301)
            ->assertRedirect("en/news/{$news->id}");
    }

    public static function oldUrls()
    {
        yield ['news/2010/01'];
        yield ['news/2010/01/01'];
        yield ['news/2010/01/01/slug'];
    }
}
