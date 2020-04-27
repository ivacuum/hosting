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

        $this->get("acp/tags/{$tag->id}/edit")
            ->assertOk();
    }

    public function testIndex()
    {
        TagFactory::new()->create();

        $this->get('acp/tags')
            ->assertOk();
    }

    public function testShow()
    {
        $tag = TagFactory::new()->create();

        $this->get("acp/tags/{$tag->id}")
            ->assertOk();
    }

    public function testStore()
    {
        $this->post('acp/tags', TagFactory::new()->make()->toArray())
            ->assertRedirect('acp/tags');
    }

    public function testUpdate()
    {
        $tag = TagFactory::new()->create();

        $this->put("acp/tags/{$tag->id}", TagFactory::new()->make()->toArray())
            ->assertRedirect('acp/tags');
    }
}
