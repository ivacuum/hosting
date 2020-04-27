<?php namespace Tests\Feature;

use App\Factory\NewsFactory;
use App\Factory\UserFactory;
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
        $this->post('acp/news', NewsFactory::new()->make()->toArray())
            ->assertRedirect('acp/news');
    }

    public function testUpdate()
    {
        $news = NewsFactory::new()->create();

        $this->put("acp/news/{$news->id}", NewsFactory::new()->make()->toArray())
            ->assertRedirect('acp/news');
    }
}
