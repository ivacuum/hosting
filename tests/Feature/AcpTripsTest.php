<?php namespace Tests\Feature;

use App\Factory\TripFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpTripsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

    public function testCreate()
    {
        $this->get('acp/trips/create')
            ->assertOk();
    }

    public function testEdit()
    {
        $trip = TripFactory::new()->create();

        $this->get("acp/trips/{$trip->id}/edit")
            ->assertOk();
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
        $this->post('acp/trips', TripFactory::new()->make()->toArray())
            ->assertRedirect('acp/trips');
    }

    public function testUpdate()
    {
        $trip = TripFactory::new()->create();

        $this->put("acp/trips/{$trip->id}", TripFactory::new()->make()->toArray())
            ->assertRedirect('acp/trips');
    }
}
