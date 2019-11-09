<?php namespace Tests\Feature;

use App\News;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpNewsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(User::find(1));
    }

    public function testCreate()
    {
        $this->get('acp/news/create')
            ->assertOk();
    }

    public function testEdit()
    {
        $news = $this->createNews();

        $this->getJson("acp/news/{$news->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $news->id]]);
    }

    public function testIndex()
    {
        $this->createNews();

        $this->getJson('acp/news')
            ->assertOk();
    }

    public function testShow()
    {
        $news = $this->createNews();

        $this->getJson("acp/news/{$news->id}")
            ->assertOk()
            ->assertJson(['data' => ['id' => $news->id]]);
    }

    public function testStore()
    {
        $this->postJson('acp/news', factory(News::class)->state('user')->make()->toArray())
            ->assertCreated()
            ->assertLocation('acp/news');
    }

    public function testUpdate()
    {
        $news = $this->createNews();

        $this->putJson("acp/news/{$news->id}", factory(News::class)->state('user')->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }

    private function createNews(): News
    {
        return factory(News::class)->state('user')->create();
    }
}
