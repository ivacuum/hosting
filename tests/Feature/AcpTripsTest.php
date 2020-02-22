<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use App\Trip;
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
        $trip = $this->createTrip();

        $this->getJson("acp/trips/{$trip->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $trip->id]]);
    }

    public function testIndex()
    {
        $this->createTrip();

        $this->getJson('acp/trips')
            ->assertOk();
    }

    public function testShow()
    {
        $trip = $this->createTrip();

        $this->getJson("acp/trips/{$trip->id}")
            ->assertOk()
            ->assertJson(['data' => ['id' => $trip->id]]);
    }

    public function testStore()
    {
        $this->postJson('acp/trips', factory(Trip::class)->state('city')->make()->toArray())
            ->assertCreated()
            ->assertLocation('acp/trips');
    }

    public function testVue()
    {
        $this->get('acp/trips')
            ->assertOk()
            ->assertViewIs('acp.index');
    }

    public function testUpdate()
    {
        $trip = $this->createTrip();

        $this->putJson("acp/trips/{$trip->id}", factory(Trip::class)->state('city')->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }

    private function createTrip(): Trip
    {
        return factory(Trip::class)->state('city')->create();
    }
}
