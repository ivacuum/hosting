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
            ->assertStatus(200);
    }

    public function testShow()
    {
        $news = NewsFactory::new()->create();

        $this->expectsEvents(\App\Events\Stats\NewsViewed::class)
            ->get("news/{$news->id}")
            ->assertStatus(200);
    }

    /**
     * @dataProvider oldUrls
     * @param string $url
     */
    public function testBackwardCompatibility(string $url)
    {
        $this->get($url)
            ->assertStatus(301)
            ->assertRedirect('news');
    }

    public function testRedirectToNewsLocale()
    {
        $news = NewsFactory::new()->withLocale('en')->create();

        $this->get("news/{$news->id}")
            ->assertStatus(301)
            ->assertRedirect("en/news/{$news->id}");
    }

    public function oldUrls()
    {
        yield ['news/2010/01'];
        yield ['news/2010/01/01'];
        yield ['news/2010/01/01/slug'];
    }
}
