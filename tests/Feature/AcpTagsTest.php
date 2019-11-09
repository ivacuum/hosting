<?php namespace Tests\Feature;

use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpTagsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(User::find(1));
    }

    public function testCreate()
    {
        $this->get('acp/tags/create')
            ->assertOk();
    }

    public function testEdit()
    {
        $tag = $this->createTag();

        $this->getJson("acp/tags/{$tag->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $tag->id]]);
    }

    public function testIndex()
    {
        $this->createTag();

        $this->getJson('acp/tags')
            ->assertOk();
    }

    public function testShow()
    {
        $tag = $this->createTag();

        $this->getJson("acp/tags/{$tag->id}")
            ->assertOk()
            ->assertJson(['data' => ['id' => $tag->id]]);
    }

    public function testStore()
    {
        $this->postJson('acp/tags', factory(Tag::class)->make()->toArray())
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
        $tag = $this->createTag();

        $this->putJson("acp/tags/{$tag->id}", factory(Tag::class)->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }

    private function createTag(): Tag
    {
        return factory(Tag::class)->create();
    }
}
