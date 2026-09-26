<?php

namespace Tests\Feature;

use App\Domain\Locale;
use App\Domain\NewsStatus;
use App\Factory\NewsFactory;
use App\Livewire\Acp\NewsForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class AcpNewsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->get('acp/news/create')
            ->assertOk()
            ->assertSeeLivewire(NewsForm::class);
    }

    public function testEdit()
    {
        $news = NewsFactory::new()->create();

        $this->get("acp/news/{$news->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(NewsForm::class);
    }

    #[TestWith([Locale::Rus], 'Russian')]
    #[TestWith([Locale::Eng], 'English')]
    public function testIndex(Locale $locale): void
    {
        $factory = NewsFactory::new()->withLocale($locale);
        $first = $factory->withTitle('First phpunit post')->create();
        $second = $factory->withTitle('Second phpunit post')->create();

        $this->get(match ($locale) {
            Locale::Eng => 'en/acp/news',
            default => 'acp/news',
        })
            ->assertOk()
            ->assertSee([$first->title, $second->title]);
    }

    public function testShow()
    {
        $news = NewsFactory::new()->create();

        $this->get("acp/news/{$news->id}")
            ->assertOk();
    }

    #[TestWith([Locale::Rus], 'Russian')]
    #[TestWith([Locale::Eng], 'English')]
    public function testStore(Locale $locale): void
    {
        $this->app->setLocale($locale->value);

        \Livewire::test(NewsForm::class)
            ->set('title', 'phpunit news')
            ->set('markdown', '**New body**')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect(match ($locale) {
                Locale::Eng => '/en/acp/news',
                default => '/acp/news',
            });

        $this->assertDatabaseHas('news', [
            'title' => 'phpunit news',
            'markdown' => '**New body**',
            'html' => "<p><strong>New body</strong></p>\n",
            'locale' => $locale->value,
            'user_id' => auth()->id(),
        ]);
    }

    public function testUpdate()
    {
        $news = NewsFactory::new()->create();

        \Livewire::test(NewsForm::class, ['id' => $news->id])
            ->set('title', 'Lyrics')
            ->set('status', NewsStatus::Hidden->value)
            ->set('markdown', '**strong text**')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/news');

        $news->refresh();

        $this->assertSame('Lyrics', $news->title);
        $this->assertSame(NewsStatus::Hidden, $news->status);
        $this->assertSame('**strong text**', $news->markdown);
        $this->assertSame("<p><strong>strong text</strong></p>\n", $news->html);
    }
}
