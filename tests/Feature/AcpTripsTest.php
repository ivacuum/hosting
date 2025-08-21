<?php

namespace Tests\Feature;

use App\Domain\Life\Factory\TripFactory;
use App\Domain\Life\TripStatus;
use App\Livewire\Acp\TripForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpTripsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->get('acp/trips/create')
            ->assertOk()
            ->assertSeeLivewire(TripForm::class);
    }

    public function testEdit()
    {
        $trip = TripFactory::new()->create();

        $this->get("acp/trips/{$trip->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(TripForm::class);
    }

    public function testIndex()
    {
        TripFactory::new()->create();

        $this->get('acp/trips')
            ->assertOk();
    }

    public function testShow()
    {
        $trip = TripFactory::new()->create();

        $this->get("acp/trips/{$trip->id}")
            ->assertOk();
    }

    public function testStore()
    {
        $trip = TripFactory::new()->make();

        \Livewire::test(TripForm::class)
            ->set('cityId', $trip->city_id)
            ->set('dateStart', '2024-03-01T00:00')
            ->set('dateEnd', '2024-03-03T00:00')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/trips');

        $this->get('acp/trips')
            ->assertSee($trip->city->title);
    }

    public function testUpdate()
    {
        $trip = TripFactory::new()->create();

        \Livewire::test(TripForm::class, ['id' => $trip->id])
            ->set('status', TripStatus::Hidden->value)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/trips');

        $trip->refresh();

        $this->assertTrue($trip->status->isHidden());
    }
}
