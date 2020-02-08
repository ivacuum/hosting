<?php namespace Tests\Feature;

use App\Factory\CityFactory;
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
        $city = CityFactory::new()->withCountry()->create();;

        $this->getJson("acp/cities/{$city->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $city->id]]);
    }

    public function testIndex()
    {
        CityFactory::new()->withCountry()->create();

        $this->getJson('acp/cities')
            ->assertOk();
    }

    public function testShow()
    {
        $city = CityFactory::new()->withCountry()->create();

        $this->getJson("acp/cities/{$city->id}")
            ->assertOk()
            ->assertJson(['data' => ['id' => $city->id]]);
    }

    public function testStore()
    {
        $this->postJson('acp/cities', CityFactory::new()->withCountry()->make()->toArray())
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
        $city = CityFactory::new()->withCountry()->create();

        $this->putJson("acp/cities/{$city->id}", CityFactory::new()->withCountry()->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }
}
