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

        $this->get(action('News@index'))
            ->assertStatus(200);
    }

    public function testShow()
    {
        $news = factory(News::class)->state('user')->create();

        $this->expectsEvents(\App\Events\Stats\NewsViewed::class);

        $this->get(action('News@show', $news))
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
            ->assertRedirect(action('News@index'));
    }

    public function testRedirectToNewsLocale()
    {
        $locale = 'en';

        $news = factory(News::class)->state('user')->create(compact('locale'));

        $this->get(action('News@show', $news))
            ->assertStatus(301)
            ->assertRedirect($locale.path('News@show', $news));
    }

    public function oldUrls()
    {
        return [
            ['/news/2010/01'],
            ['/news/2010/01/01'],
            ['/news/2010/01/01/slug'],
        ];
    }
}
