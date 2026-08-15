<?php

namespace Tests\Feature;

use App\Domain\Life\Factory\ArtistFactory;
use App\Domain\Life\Factory\CityFactory;
use App\Domain\Life\Factory\GigFactory;
use App\Domain\Life\GigStatus;
use App\Livewire\Acp\GigForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpGigsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->get('acp/gigs/create')
            ->assertOk()
            ->assertSeeLivewire(GigForm::class);
    }

    public function testCreatePrefilled()
    {
        $artist = ArtistFactory::new()
            ->withSlug('phpunit-artist')
            ->withTitle('Phpunit Artist')
            ->create();

        $city = CityFactory::new()->create();

        $source = GigFactory::new()
            ->withArtist($artist)
            ->withCity($city)
            ->withDate('2024-03-01 20:00:00')
            ->withMetaDescription(
                russianMetaDescription: 'Описание концерта на русском',
                englishMetaDescription: 'English concert description',
            )
            ->withMetaImage('https://example.com/phpunit-artist.jpg')
            ->withSlug('phpunit-artist.2024.03.01')
            ->withTitle(
                russianTitle: 'Концерт Phpunit Artist в Городе',
                englishTitle: 'Phpunit Artist in City',
            )
            ->create();

        \Livewire::test(GigForm::class, ['sourceId' => $source->id])
            ->assertSet('id', null)
            ->assertSet('sourceId', $source->id)
            ->assertSet('artistId', $artist->id)
            ->assertSet('cityId', $city->id)
            ->assertSet('titleEn', 'Phpunit Artist in City')
            ->assertSet('titleRu', 'Концерт Phpunit Artist в Городе')
            ->assertSet('metaImage', 'https://example.com/phpunit-artist.jpg')
            ->assertSet('metaDescriptionEn', 'English concert description')
            ->assertSet('metaDescriptionRu', 'Описание концерта на русском')
            ->assertSet('date', '2024-03-01T20:00:00')
            ->assertSet('slug', 'phpunit-artist.2024.03.01')
            ->assertSet('status', GigStatus::Hidden);
    }

    public function testEdit()
    {
        $gig = GigFactory::new()->create();

        $this->get("acp/gigs/{$gig->id}/edit")
            ->assertOk()
            ->assertSee($gig->title)
            ->assertSeeLivewire(GigForm::class);
    }

    public function testIndex()
    {
        GigFactory::new()->create();

        $this->get('acp/gigs')
            ->assertOk();
    }

    public function testShow()
    {
        $gig = GigFactory::new()->create();

        $this->get("acp/gigs/{$gig->id}")
            ->assertOk()
            ->assertSee($gig->title);
    }

    public function testStore()
    {
        $artist = ArtistFactory::new()->withTitle('phpunit artist')->create();
        $city = CityFactory::new()->create();

        \Livewire::test(GigForm::class)
            ->set('cityId', $city->id)
            ->set('artistId', $artist->id)
            ->set('date', '2024-03-01T00:00')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/gigs');

        $this->get('acp/gigs')
            ->assertSee('phpunit artist');
    }

    public function testUpdate()
    {
        $gig = GigFactory::new()->create();

        \Livewire::test(GigForm::class, ['id' => $gig->id])
            ->set('status', GigStatus::Hidden->value)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/gigs');

        $gig->refresh();

        $this->assertSame(GigStatus::Hidden, $gig->status);
    }
}
