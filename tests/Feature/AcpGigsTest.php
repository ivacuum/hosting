<?php namespace Tests\Feature;

use App\Domain\GigStatus;
use App\Factory\GigFactory;
use App\Factory\UserFactory;
use App\Gig;
use App\Http\Livewire\Acp\GigForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpGigsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

    public function testCreate()
    {
        $this->get('acp/gigs/create')
            ->assertOk()
            ->assertSeeLivewire(GigForm::class);
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
        $gig = GigFactory::new()->make();

        \Livewire::test(GigForm::class, ['gig' => new Gig])
            ->set('gig.city_id', $gig->city_id)
            ->set('gig.artist_id', $gig->artist_id)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/gigs');

        $this->get('acp/gigs')
            ->assertSee($gig->artist->title);
    }

    public function testUpdate()
    {
        $gig = GigFactory::new()->create();

        \Livewire::test(GigForm::class, ['gig' => $gig])
            ->set('gig.status', GigStatus::Hidden)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/gigs');

        $gig->refresh();

        $this->assertSame(GigStatus::Hidden, $gig->status);
    }
}
