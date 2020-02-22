<?php namespace Tests\Feature;

use App\Artist;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpArtistsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

    public function testCreate()
    {
        $this->get('acp/artists/create')
            ->assertOk();
    }

    public function testEdit()
    {
        $artist = $this->createArtist();

        $this->getJson("acp/artists/{$artist->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $artist->id]]);
    }

    public function testIndex()
    {
        $this->createArtist();

        $this->getJson('acp/artists')
            ->assertOk();
    }

    public function testShow()
    {
        $artist = $this->createArtist();

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
        $artist = $this->createArtist();

        $this->putJson("acp/artists/{$artist->id}", factory(Artist::class)->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }

    private function createArtist(): Artist
    {
        return factory(Artist::class)->create();
    }
}
