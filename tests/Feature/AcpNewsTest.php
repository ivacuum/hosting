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

        $this->getJson("acp/news/{$news->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $news->id]]);
    }

    public function testIndex()
    {
        NewsFactory::new()->create();

        $this->getJson('acp/news')
            ->assertOk();
    }

    public function testShow()
    {
        $news = NewsFactory::new()->create();

        $this->getJson("acp/news/{$news->id}")
            ->assertOk()
            ->assertJson(['data' => ['id' => $news->id]]);
    }

    public function testStore()
    {
        $this->postJson('acp/news', NewsFactory::new()->make()->toArray())
            ->assertCreated()
            ->assertLocation('acp/news');
    }

    public function testUpdate()
    {
        $news = NewsFactory::new()->create();

        $this->putJson("acp/news/{$news->id}", NewsFactory::new()->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }
}
