<?php namespace Tests\Feature;

use App\Artist;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpArtistsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(User::find(1));
    }

    public function testCreate()
    {
        $this->get('acp/artists/create')
            ->assertOk();
    }

    public function testEdit()
    {
        /** @var Artist $artist */
        $artist = factory(Artist::class)->create();

        $this->getJson("acp/artists/{$artist->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $artist->id]]);
    }

    public function testIndex()
    {
        factory(Artist::class)->create();

        $this->getJson('acp/artists')
            ->assertOk();
    }

    public function testShow()
    {
        /** @var Artist $artist */
        $artist = factory(Artist::class)->create();

        $this->getJson("acp/artists/{$artist->id}")
            ->assertOk()
            ->assertJson(['data' => ['id' => $artist->id]]);
    }

    public function testStore()
    {
        $this->postJson('acp/artists', factory(Artist::class)->make()->toArray())
            ->assertCreated()
            ->assertLocation('acp/artists');
    }

    public function testVue()
    {
        $this->get('acp/artists')
            ->assertOk()
            ->assertViewIs('acp.index');
    }

    public function testUpdate()
    {
        /** @var Artist $artist */
        $artist = factory(Artist::class)->create();

        $this->putJson("acp/artists/{$artist->id}", factory(Artist::class)->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }
}
