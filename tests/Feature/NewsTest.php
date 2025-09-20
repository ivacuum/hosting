<?php

namespace Tests\Feature;

use App\Factory\NewsFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
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

    #[TestWith(['news/2010/01'])]
    #[TestWith(['news/2010/01/01'])]
    #[TestWith(['news/2010/01/01/slug'])]
    public function testBackwardCompatibility(string $url)
    {
        $this->get($url)
            ->assertMovedPermanently()
            ->assertRedirect('news');
    }

    public function testHidden()
    {
        $news = NewsFactory::new()->hidden()->create();

        $this->get("news/{$news->id}")
            ->assertNotFound();
    }

    public function testRedirectToIndex()
    {
        $this->get('news/0')
            ->assertMovedPermanently()
            ->assertRedirect('news');
    }

    public function testRedirectToNewsLocale()
    {
        $news = NewsFactory::new()->english()->create();

        $this->get("news/{$news->id}")
            ->assertMovedPermanently()
            ->assertRedirect("en/news/{$news->id}");
    }
}
