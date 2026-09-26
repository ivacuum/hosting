<?php

namespace Tests\Feature;

use App\Domain\Life\Factory\ArtistFactory;
use App\Livewire\Acp\ArtistForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpArtistsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

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

    public function testStore(): void
    {
        \Livewire::test(ArtistForm::class)
            ->set('title', 'phpunit artist')
            ->set('slug', 'phpunit-acp-artist')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/artists');

        $this->assertDatabaseHas('artists', [
            'title' => 'phpunit artist',
            'slug' => 'phpunit-acp-artist',
        ]);
    }

    public function testUpdate()
    {
        $artist = ArtistFactory::new()->create();

        \Livewire::test(ArtistForm::class, ['id' => $artist->id])
            ->set('title', 'Eyes 👀')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/artists');

        $artist->refresh();

        $this->assertSame('Eyes 👀', $artist->title);
    }
}
