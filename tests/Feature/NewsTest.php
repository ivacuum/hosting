<?php namespace Tests\Feature;

use App\News;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        factory(News::class)->create();

        $this->get('news')
            ->assertStatus(200);
    }

    public function testShow()
    {
        /** @var News $news */
        $news = factory(News::class)->state('user')->create();

        $this->expectsEvents(\App\Events\Stats\NewsViewed::class);

        $this->get("news/{$news->id}")
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
        $locale = 'en';
        $news = factory(News::class)->state('user')->create(['locale' => $locale]);

        $this->get("news/{$news->id}")
            ->assertStatus(301)
            ->assertRedirect("{$locale}/news/{$news->id}");
    }

    public function oldUrls()
    {
        yield ['news/2010/01'];
        yield ['news/2010/01/01'];
        yield ['news/2010/01/01/slug'];
    }
}
