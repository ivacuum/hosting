<?php namespace Tests\Feature;

use App\Factory\CityFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpCitiesTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

    public function testCreate()
    {
        $this->get('acp/cities/create')
            ->assertOk();
    }

    public function testEdit()
    {
        $city = CityFactory::new()->withCountry()->create();

        $this->get("acp/cities/{$city->id}/edit")
            ->assertOk()
            ->assertSee($city->title);
    }

    public function testIndex()
    {
        CityFactory::new()->withCountry()->create();

        $this->get('acp/cities')
            ->assertOk();
    }

    public function testShow()
    {
        $city = CityFactory::new()->withCountry()->create();

        $this->get("acp/cities/{$city->id}")
            ->assertOk()
            ->assertSee($city->title);
    }

    public function testStore()
    {
        $this->post('acp/cities', CityFactory::new()->withCountry()->make()->toArray())
            ->assertRedirect('acp/cities');
    }

    public function testUpdate()
    {
        $city = CityFactory::new()->withCountry()->create();

        $this->put("acp/cities/{$city->id}", CityFactory::new()->withCountry()->make()->toArray())
            ->assertRedirect('acp/cities');
    }
}
