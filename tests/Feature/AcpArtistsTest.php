<?php namespace Tests\Feature;

use App\Factory\ArtistFactory;
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
        $artist = ArtistFactory::new()->create();

        $this->getJson("acp/artists/{$artist->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $artist->id]]);
    }

    public function testIndex()
    {
        ArtistFactory::new()->create();

        $this->getJson('acp/artists')
            ->assertOk();
    }

    public function testShow()
    {
        $artist = ArtistFactory::new()->create();

        $this->getJson("acp/artists/{$artist->id}")
            ->assertOk()
            ->assertJson(['data' => ['id' => $artist->id]]);
    }

    public function testStore()
    {
        $this->postJson('acp/artists', ArtistFactory::new()->make()->toArray())
            ->assertCreated()
            ->assertLocation('acp/artists');
    }

    public function testUpdate()
    {
        $artist = ArtistFactory::new()->create();

        $this->putJson("acp/artists/{$artist->id}", ArtistFactory::new()->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }
}
