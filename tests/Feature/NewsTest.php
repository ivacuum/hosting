<?php

namespace Tests\Feature;

use App\Domain\Locale;
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

    #[TestWith([Locale::Eng, '', 'en/'])]
    #[TestWith([Locale::Rus, 'en/', ''])]
    public function testRedirectToNewsLocale(Locale $locale, string $sourcePrefix, string $targetPrefix): void
    {
        $news = NewsFactory::new()->withLocale($locale)->create();

        $this->get("{$sourcePrefix}news/{$news->id}")
            ->assertMovedPermanently()
            ->assertRedirect("{$targetPrefix}news/{$news->id}");
    }
}
