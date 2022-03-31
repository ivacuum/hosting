<?php namespace Tests\Feature;

use App\Domain\Locale;
use App\Factory\NewsFactory;
use App\Factory\UserFactory;
use App\News;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpNewsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

    public function testCreate()
    {
        $this->get('acp/news/create')
            ->assertOk();
    }

    public function testEdit()
    {
        $news = NewsFactory::new()->create();

        $this->get("acp/news/{$news->id}/edit")
            ->assertOk();
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

        $this->post('acp/news', $news->toArray())
            ->assertRedirect('acp/news');

        $model = News::firstWhere(['title' => $news->title]);

        $this->assertSame(Locale::Rus, $model->locale);
    }

    public function testStoreEnglish()
    {
        $news = NewsFactory::new()
            ->withTitle('Store English Post Like It Is Done In ACP')
            ->make();

        $this->withServerVariables(['LARAVEL_LOCALE' => 'en'])
            ->post('acp/news', $news->toArray())
            ->assertRedirect('acp/news');

        $model = News::firstWhere(['title' => $news->title]);

        $this->assertSame(Locale::Eng, $model->locale);
    }

    public function testUpdate()
    {
        $news = NewsFactory::new()->create();

        $this->put("acp/news/{$news->id}", NewsFactory::new()->make()->toArray())
            ->assertRedirect('acp/news');
    }
}
