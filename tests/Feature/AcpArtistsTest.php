<?php namespace Tests\Feature;

use App\Artist;
use App\Factory\ArtistFactory;
use App\Factory\UserFactory;
use App\Http\Livewire\Acp\ArtistForm;
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
            ->assertOk()
            ->assertSeeLivewire(ArtistForm::class);
    }

    public function testEdit()
    {
        $artist = ArtistFactory::new()->create();

        $this->get("acp/artists/{$artist->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(ArtistForm::class);
    }

    public function testIndex()
    {
        ArtistFactory::new()->create();

        $this->get('acp/artists')
            ->assertOk();
    }

    public function testShow()
    {
        $artist = ArtistFactory::new()->create();

        $this->get("acp/artists/{$artist->id}")
            ->assertOk();
    }

    public function testStore()
    {
        $artist = ArtistFactory::new()->make();

        \Livewire::test(ArtistForm::class, ['artist' => new Artist])
            ->set('artist.title', $artist->title)
            ->set('artist.slug', $artist->slug)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/artists');

        $this->get('acp/artists')
            ->assertSee($artist->title);
    }

    public function testUpdate()
    {
        $artist = ArtistFactory::new()->create();

        \Livewire::test(ArtistForm::class, ['artist' => $artist])
            ->set('artist.title', 'Eyes 👀')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/artists');

        $artist->refresh();

        $this->assertSame('Eyes 👀', $artist->title);
    }
}
