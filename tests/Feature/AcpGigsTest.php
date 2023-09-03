<?php

namespace Tests\Feature;

use App\Domain\GigStatus;
use App\Factory\GigFactory;
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

        \Livewire::test(GigForm::class)
            ->set('cityId', $gig->city_id)
            ->set('artistId', $gig->artist_id)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/gigs');

        $this->get('acp/gigs')
            ->assertSee($gig->artist->title);
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
