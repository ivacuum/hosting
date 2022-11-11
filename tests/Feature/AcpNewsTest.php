<?php namespace Tests\Feature;

use App\Domain\Locale;
use App\Domain\NewsStatus;
use App\Factory\NewsFactory;
use App\Http\Livewire\Acp\NewsForm;
use App\News;
use Illuminate\Foundation\Testing\DatabaseTransactions;
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

    public function testIndex()
    {
        NewsFactory::new()->create();

        $this->get('acp/news')
            ->assertOk();
    }

    public function testShow()
    {
        $news = NewsFactory::new()->create();

        $this->get("acp/news/{$news->id}")
            ->assertOk();
    }

    public function testStore()
    {
        $news = NewsFactory::new()
            ->withTitle('Store Russian Post Like It Is Done In ACP')
            ->make();

        \Livewire::test(NewsForm::class, ['news' => new News])
            ->set('news.title', $news->title)
            ->set('news.markdown', $news->markdown)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/news');

        $model = News::firstWhere(['title' => $news->title]);

        $this->assertSame(Locale::Rus, $model->locale);

        $this->get('acp/news')
            ->assertSee($news->title);
    }

    public function testStoreEnglish()
    {
        $news = NewsFactory::new()
            ->withTitle('Store English Post Like It Is Done In ACP')
            ->make();

        $this->app->setLocale(Locale::Eng->value);

        \Livewire::test(NewsForm::class, ['news' => new News])
            ->withHeaders(['LARAVEL_LOCALE' => 'en'])
            ->set('news.title', $news->title)
            ->set('news.markdown', $news->markdown)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/news');

        $model = News::firstWhere(['title' => $news->title]);

        $this->assertSame(Locale::Eng, $model->locale);

        $this->get('acp/news')
            ->assertSee($news->title);
    }

    public function testUpdate()
    {
        $news = NewsFactory::new()->create();

        \Livewire::test(NewsForm::class, ['news' => $news])
            ->set('news.title', 'Lyrics')
            ->set('news.status', NewsStatus::Hidden)
            ->set('news.markdown', '**strong text**')
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
