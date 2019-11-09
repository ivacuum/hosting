<?php namespace Tests\Feature;

use App\City;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpCitiesTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(User::find(1));
    }

    public function testCreate()
    {
        $this->get('acp/cities/create')
            ->assertOk();
    }

    public function testEdit()
    {
        $city = $this->createCity();

        $this->getJson("acp/cities/{$city->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $city->id]]);
    }

    public function testIndex()
    {
        $this->createCity();

        $this->getJson('acp/cities')
            ->assertOk();
    }

    public function testShow()
    {
        $city = $this->createCity();

        $this->getJson("acp/cities/{$city->id}")
            ->assertOk()
            ->assertJson(['data' => ['id' => $city->id]]);
    }

    public function testStore()
    {
        $this->postJson('acp/cities', factory(City::class)->state('country')->make()->toArray())
            ->assertCreated()
            ->assertLocation('acp/cities');
    }

    public function testVue()
    {
        $this->get('acp/cities')
            ->assertOk()
            ->assertViewIs('acp.index');
    }

    public function testUpdate()
    {
        $city = $this->createCity();

        $this->putJson("acp/cities/{$city->id}", factory(City::class)->state('country')->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }

    private function createCity(): City
    {
        return factory(City::class)->state('country')->create();
    }
}
