<?php namespace Tests\Feature;

use App\Factory\TagFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpTagsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

    public function testCreate()
    {
        $this->get('acp/tags/create')
            ->assertOk();
    }

    public function testEdit()
    {
        $tag = TagFactory::new()->create();

        $this->getJson("acp/tags/{$tag->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $tag->id]]);
    }

    public function testIndex()
    {
        TagFactory::new()->create();

        $this->getJson('acp/tags')
            ->assertOk();
    }

    public function testShow()
    {
        $tag = TagFactory::new()->create();

        $this->getJson("acp/tags/{$tag->id}")
            ->assertOk()
            ->assertJson(['data' => ['id' => $tag->id]]);
    }

    public function testStore()
    {
        $this->postJson('acp/tags', TagFactory::new()->make()->toArray())
            ->assertCreated()
            ->assertLocation('acp/tags');
    }

    public function testVue()
    {
        $this->get('acp/tags')
            ->assertOk()
            ->assertViewIs('acp.index');
    }

    public function testUpdate()
    {
        $tag = TagFactory::new()->create();

        $this->putJson("acp/tags/{$tag->id}", TagFactory::new()->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }
}
