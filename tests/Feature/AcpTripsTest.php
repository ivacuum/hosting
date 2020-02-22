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

        $this->getJson("acp/trips/{$trip->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $trip->id]]);
    }

    public function testIndex()
    {
        TripFactory::new()->create();

        $this->getJson('acp/trips')
            ->assertOk();
    }

    public function testShow()
    {
        $trip = TripFactory::new()->create();

        $this->getJson("acp/trips/{$trip->id}")
            ->assertOk()
            ->assertJson(['data' => ['id' => $trip->id]]);
    }

    public function testStore()
    {
        $this->postJson('acp/trips', TripFactory::new()->make()->toArray())
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
        $trip = TripFactory::new()->create();

        $this->putJson("acp/trips/{$trip->id}", TripFactory::new()->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }
}
